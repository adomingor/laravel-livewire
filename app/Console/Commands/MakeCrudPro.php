<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Str;

class MakeCrudPro extends Command
{
    protected $signature = 'make:crud-pro {table}';

    protected $description = 'CRUD PRO con detección automática (corregido)';

    public function handle()
    {
        $table = $this->argument('table');

        $model = ucfirst(Str::singular($table));
        $modelVar = Str::camel($model);
        $viewPath = strtolower($model);

        $columns = Schema::getColumnListing($table);

        $filteredColumns = collect($columns)->reject(fn ($c) => in_array($c, ['id', 'fecha_ins', 'fecha_upd', 'id_users'])
        );

        $pivots = $this->detectPivotTables($table);

        $this->generateLivewire($model, $modelVar, $viewPath, $filteredColumns, $pivots);
        $this->generateView($viewPath, $filteredColumns, $pivots);

        $this->info("CRUD PRO generado para {$table} 🚀");
    }

    private function detectPivotTables($table)
    {
        $tables = DB::select("SELECT tablename FROM pg_tables WHERE schemaname='public'");
        $result = [];

        $singular = Str::singular($table);

        foreach ($tables as $t) {
            $pivot = $t->tablename;

            if (! Str::contains($pivot, '_')) {
                continue;
            }

            $cols = Schema::getColumnListing($pivot);

            if (in_array("id_{$table}", $cols) || in_array("id_{$singular}", $cols)) {
                $result[] = $pivot;
            }
        }

        return $result;
    }

    private function generateLivewire($model, $modelVar, $viewPath, $columns, $pivots)
    {
        $dir = app_path("Livewire/{$model}");
        File::ensureDirectoryExists($dir);

        $fields = $columns->map(fn ($c) => "public \${$c};")->implode("\n");

        $dataArray = $columns->map(fn ($c) => "'{$c}' => \$this->{$c},")->implode("\n");

        $pivotProps = $this->pivotProperties($pivots);
        $pivotLogic = $this->pivotLogic($model, $pivots);
        $pivotLoad = $this->pivotLoad($model, $pivots);

        $content = <<<PHP
namespace App\\Livewire\\{$model};

use Livewire\\Component;
use App\\Models\\{$model};
use Illuminate\\Support\\Facades\\DB;

class Index extends Component
{
    public \$items;
    public \$modal = false;
    public \$editingId;

    {$fields}

    {$pivotProps}

    public function mount()
    {
        \$this->loadData();
    }

    public function loadData()
    {
        \$this->items = {$model}::all();
    }

    public function edit(\$id)
    {
        \$item = {$model}::findOrFail(\$id);
        \$this->editingId = \$id;

        foreach (\$item->toArray() as \$k => \$v) {
            if (property_exists(\$this, \$k)) {
                \$this->\$k = \$v;
            }
        }

        {$pivotLoad}

        \$this->modal = true;
    }

    public function save()
    {
        DB::transaction(function () {

            \$data = [
                {$dataArray}
            ];

            if (\$this->editingId) {
                \$model = {$model}::find(\$this->editingId);
                \$data['fecha_upd'] = now();
                \$model->update(\$data);
            } else {
                \$data['id_users'] = auth()->id() ?? 1;
                \$data['fecha_ins'] = now();
                \$model = {$model}::create(\$data);
            }

            {$pivotLogic}
        });

        \$this->reset();
        \$this->loadData();
        \$this->modal = false;
    }

    public function render()
    {
        return view('livewire.{$viewPath}.index');
    }
}
PHP;

        File::put("{$dir}/Index.php", $content);
    }

    private function generateView($viewPath, $columns, $pivots)
    {
        $dir = resource_path("views/livewire/{$viewPath}");
        File::ensureDirectoryExists($dir);

        $inputs = $columns->map(function ($c) {
            if (Str::contains($c, 'descripcion')) {
                return "<flux:textarea wire:model='{$c}' label='{$c}' />";
            }

            if ($c === 'activo') {
                return "<flux:switch wire:model='{$c}' label='{$c}' />";
            }

            return "<flux:input wire:model='{$c}' label='{$c}' />";
        })->implode("\n");

        $pivotSelects = collect($pivots)->map(function ($pivot) {

            $parts = explode('_', $pivot);
            $related = $parts[1];

            return "
<flux:select multiple wire:model='{$related}Seleccionadas' label='{$related}'>
@foreach(\\App\\Models\\".ucfirst($related)."::all() as \$item)
<option value='{{ \$item->id }}'>{{ \$item->id }}</option>
@endforeach
</flux:select>";
        })->implode("\n");

        $view = <<<BLADE
<div class="p-6">

<flux:button wire:click="modal=true">Nuevo</flux:button>

<flux:modal wire:model="modal">

{$inputs}

{$pivotSelects}

<flux:button wire:click="save">Guardar</flux:button>

</flux:modal>

</div>
BLADE;

        File::put("{$dir}/index.blade.php", $view);
    }

    private function pivotProperties($pivots)
    {
        return collect($pivots)->map(function ($pivot) {
            $related = explode('_', $pivot)[1];

            return "public \${$related}Seleccionadas = [];";
        })->implode("\n");
    }

    private function pivotLogic($model, $pivots)
    {
        $table = strtolower($model).'s';

        return collect($pivots)->map(function ($pivot) use ($table) {

            $related = explode('_', $pivot)[1];

            return "
DB::table('{$pivot}')->where('id_{$table}', \$model->id)->delete();

foreach (\$this->{$related}Seleccionadas as \$id) {
    DB::table('{$pivot}')->insert([
        'id_{$table}' => \$model->id,
        'id_{$related}' => \$id,
        'fecha_ins' => now(),
        'id_users' => auth()->id() ?? 1
    ]);
}";
        })->implode("\n");
    }

    private function pivotLoad($model, $pivots)
    {
        $table = strtolower($model).'s';

        return collect($pivots)->map(function ($pivot) use ($table) {

            $related = explode('_', $pivot)[1];

            return "
\$this->{$related}Seleccionadas = DB::table('{$pivot}')
    ->where('id_{$table}', \$id)
    ->pluck('id_{$related}')
    ->toArray();";
        })->implode("\n");
    }
}
