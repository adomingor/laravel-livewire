<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Filesystem\Filesystem;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Str;

class MakeCrudFull extends Command
{
    protected $signature = 'make:crud-full
                            {name : Table name}
                            {--route= : Custom route name}';

    protected $description = 'Generate Livewire CRUD + Filament Resource + Spatie Policy in one step';

    public function __construct(protected Filesystem $files)
    {
        parent::__construct();
    }

    public function handle(): int
    {
        $table = $this->argument('name');
        $modelName = Str::studly(Str::singular($table));
        $route = $this->option('route') ?? Str::kebab(Str::plural($modelName));

        // 1. Generate Livewire CRUD
        $this->info('Generating Livewire CRUD...');
        $this->call('make:crud', ['name' => $table, 'stack' => 'livewire']);

        // 2. Generate Policy
        $this->info('Generating Policy...');
        $this->generatePolicy($modelName, $route);

        // 3. Generate Filament Resource
        $this->info('Generating Filament Resource...');
        $this->generateFilamentResource($modelName, $route, $table);

        // 4. Add permissions to seeder reminder
        $this->newLine();
        $this->info('✓ Done! Next steps:');
        $this->line('  1. Add to RolesAndPermissionsSeeder:');
        $this->line("       'ver {$route}', 'crear {$route}', 'editar {$route}', 'eliminar {$route}'");
        $this->line('  2. Run: php artisan db:seed --class=RolesAndPermissionsSeeder');
        $this->line('  3. Add the route group to routes/web.php:');
        $this->line("       Route::prefix('{$route}')->name('{$route}.')->group(function () {");
        $this->line("           Route::livewire('/', '{$route}.index')->name('index');");
        $this->line("           Route::livewire('/create', '{$route}.create')->name('create');");
        $this->line("           Route::livewire('/{{$modelName}}}', '{$route}.show')->name('show');");
        $this->line("           Route::livewire('/{{$modelName}}}/edit', '{$route}.edit')->name('edit');");
        $this->line('       });');

        return self::SUCCESS;
    }

    private function generatePolicy(string $modelName, string $route): void
    {
        $stubPath = resource_path('stubs/crud/policy.stub');

        if (! $this->files->exists($stubPath)) {
            $this->error("Policy stub not found at {$stubPath}");

            return;
        }

        $stub = $this->files->get($stubPath);

        $content = str_replace(
            ['{{modelNamespace}}', '{{modelName}}', '{{modelNameLowerCase}}', '{{modelRoute}}'],
            [config('crud.model.namespace', 'App\Models'), $modelName, Str::camel($modelName), $route],
            $stub
        );

        $path = app_path("Policies/{$modelName}Policy.php");

        if ($this->files->exists($path)) {
            $this->warn("Policy already exists: {$path}");

            return;
        }

        $this->makeDirectory($path);
        $this->files->put($path, $content);
        $this->line("  Created: app/Policies/{$modelName}Policy.php");
    }

    private function generateFilamentResource(string $modelName, string $route, string $table): void
    {
        $pluralUpper = ucfirst(Str::plural($modelName));
        $modelTitle = Str::title(Str::snake($modelName, ' '));
        $modelTitlePlural = Str::title(Str::snake(Str::plural($modelName), ' '));
        $modelNamespace = config('crud.model.namespace', 'App\Models');

        $replacements = [
            '{{modelName}}' => $modelName,
            '{{modelNameLowerCase}}' => Str::camel($modelName),
            '{{modelNamePluralUpperCase}}' => $pluralUpper,
            '{{modelNamespace}}' => $modelNamespace,
            '{{modelRoute}}' => $route,
            '{{modelTitle}}' => $modelTitle,
            '{{modelTitlePlural}}' => $modelTitlePlural,
            '{{filamentFormFields}}' => $this->buildFilamentFormFields($table),
            '{{filamentTableColumns}}' => $this->buildFilamentTableColumns($table),
        ];

        $baseDir = app_path("Filament/Resources/{$pluralUpper}");

        $filesToGenerate = [
            'filament/Resource.stub' => "{$baseDir}/{$modelName}Resource.php",
            'filament/Form.stub' => "{$baseDir}/Schemas/{$modelName}Form.php",
            'filament/Table.stub' => "{$baseDir}/Tables/{$pluralUpper}Table.php",
            'filament/Pages/List.stub' => "{$baseDir}/Pages/List{$pluralUpper}.php",
            'filament/Pages/Create.stub' => "{$baseDir}/Pages/Create{$modelName}.php",
            'filament/Pages/Edit.stub' => "{$baseDir}/Pages/Edit{$modelName}.php",
        ];

        foreach ($filesToGenerate as $stubRelative => $outputPath) {
            $stubPath = resource_path("stubs/crud/{$stubRelative}");

            if (! $this->files->exists($stubPath)) {
                $this->warn("Stub not found: {$stubPath}");

                continue;
            }

            if ($this->files->exists($outputPath)) {
                $this->warn("Already exists: {$outputPath}");

                continue;
            }

            $content = str_replace(
                array_keys($replacements),
                array_values($replacements),
                $this->files->get($stubPath)
            );

            $this->makeDirectory($outputPath);
            $this->files->put($outputPath, $content);
            $this->line('  Created: '.str_replace(app_path(), 'app', $outputPath));
        }
    }

    private function buildFilamentFormFields(string $table): string
    {
        $unwanted = config('crud.model.unwantedColumns', ['id', 'created_at', 'updated_at', 'deleted_at']);
        $columns = Schema::getColumns($table);
        $fields = [];

        foreach ($columns as $column) {
            if (in_array($column['name'], $unwanted)) {
                continue;
            }

            $label = Str::title(str_replace('_', ' ', $column['name']));
            $required = ! $column['nullable'] ? "\n                    ->required()" : '';

            $fields[] = "TextInput::make('{$column['name']}')\n                    ->label('{$label}'){$required},";
        }

        return implode("\n\n                ", $fields);
    }

    private function buildFilamentTableColumns(string $table): string
    {
        $unwanted = config('crud.model.unwantedColumns', ['id', 'created_at', 'updated_at', 'deleted_at']);
        $columns = Schema::getColumns($table);
        $cols = [];

        foreach ($columns as $column) {
            if (in_array($column['name'], $unwanted)) {
                continue;
            }

            $label = Str::title(str_replace('_', ' ', $column['name']));
            $cols[] = "TextColumn::make('{$column['name']}')\n                    ->label('{$label}')\n                    ->searchable()\n                    ->sortable(),";
        }

        return implode("\n\n                ", $cols);
    }

    private function makeDirectory(string $path): void
    {
        if (! $this->files->isDirectory(dirname($path))) {
            $this->files->makeDirectory(dirname($path), 0777, true, true);
        }
    }
}
