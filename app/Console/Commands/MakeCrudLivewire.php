<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Filesystem\Filesystem;
use Illuminate\Support\Str;

class MakeCrudLivewire extends Command
{
    protected $signature = 'make:crud-livewire
                            {name : Table name}
                            {--route= : Custom route name}';

    protected $description = 'Generate Livewire CRUD + Policy + Routes in one step';

    public function __construct(protected Filesystem $files)
    {
        parent::__construct();
    }

    public function handle(): int
    {
        $table = $this->argument('name');
        $modelName = Str::studly(Str::singular($table));
        $route = $this->option('route') ?? Str::kebab(Str::plural($modelName));
        $modelKebab = Str::kebab($modelName);

        // 1. Generate Livewire CRUD
        $this->info('Generating Livewire CRUD...');
        $this->call('make:crud', ['name' => $table, 'stack' => 'livewire']);

        // 2. Generate Policy
        $this->info('Generating Policy...');
        $this->generatePolicy($modelName, $route);

        // 3. Add Routes to web.php
        $this->info('Adding routes to web.php...');
        $this->addRoutes($route, $modelKebab);

        $this->newLine();
        $this->info('✓ Done! Next steps:');
        $this->line('  1. Add to RolesAndPermissionsSeeder:');
        $this->line("       'ver {$route}', 'crear {$route}', 'editar {$route}', 'eliminar {$route}'");
        $this->line('  2. Run: php artisan db:seed --class=RolesAndPermissionsSeeder');

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
            $this->warn("Policy already exists: app/Policies/{$modelName}Policy.php");

            return;
        }

        $this->makeDirectory($path);
        $this->files->put($path, $content);
        $this->line("  Created: app/Policies/{$modelName}Policy.php");
    }

    private function addRoutes(string $route, string $modelKebab): void
    {
        $webPath = base_path('routes/web.php');
        $content = $this->files->get($webPath);

        if (str_contains($content, "Route::prefix('{$route}')")) {
            $this->warn("Routes for [{$route}] already exist in routes/web.php");

            return;
        }

        $routeBlock = "\n    Route::prefix('{$route}')->name('{$route}.')->group(function () {\n"
            ."        Route::livewire('/', '{$route}.index')->name('index');\n"
            ."        Route::livewire('/create', '{$route}.create')->name('create');\n"
            ."        Route::livewire('/{{$modelKebab}}', '{$route}.show')->name('show');\n"
            ."        Route::livewire('/{{$modelKebab}}/edit', '{$route}.edit')->name('edit');\n"
            .'    });';

        // Insert the route group before the closing of the auth middleware group.
        // We look for the last `});` that is followed by the require statement.
        $marker = "\n});\n\nrequire __DIR__.'/settings.php';";
        $replacement = "{$routeBlock}\n\n});\n\nrequire __DIR__.'/settings.php';";

        $updated = str_replace($marker, $replacement, $content);

        if ($updated === $content) {
            $this->warn('Could not automatically inject routes. Add manually to routes/web.php inside the auth middleware group:');
            $this->line("    Route::prefix('{$route}')->name('{$route}.')->group(function () {");
            $this->line("        Route::livewire('/', '{$route}.index')->name('index');");
            $this->line("        Route::livewire('/create', '{$route}.create')->name('create');");
            $this->line("        Route::livewire('/{{$modelKebab}}', '{$route}.show')->name('show');");
            $this->line("        Route::livewire('/{{$modelKebab}}/edit', '{$route}.edit')->name('edit');");
            $this->line('    });');

            return;
        }

        $this->files->put($webPath, $updated);
        $this->line("  Updated: routes/web.php (added route group [{$route}])");
    }

    private function makeDirectory(string $path): void
    {
        if (! $this->files->isDirectory(dirname($path))) {
            $this->files->makeDirectory(dirname($path), 0777, true, true);
        }
    }
}
