<?php

namespace Tests\Feature\Livewire\Productos;

use App\Livewire\Productos\Index;
use App\Models\Producto;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Livewire\Livewire;
use Tests\TestCase;

class IndexTest extends TestCase
{
    use RefreshDatabase;

    private function actingAsUser(): static
    {
        return $this->actingAs(User::factory()->create());
    }

    public function test_component_renders(): void
    {
        $this->actingAsUser();

        Livewire::test(Index::class)
            ->assertStatus(200);
    }

    public function test_default_per_page_comes_from_model(): void
    {
        $this->actingAsUser();

        Livewire::test(Index::class)
            ->assertSet('perPage', (new Producto)->getPerPage());
    }

    public function test_per_page_options_always_include_model_default(): void
    {
        $this->actingAsUser();
        $modelDefault = (new Producto)->getPerPage();

        Livewire::test(Index::class)
            ->assertViewHas('perPageOptions', fn (array $options) => in_array($modelDefault, $options));
    }

    public function test_changing_per_page_updates_pagination(): void
    {
        $this->actingAsUser();
        Producto::factory()->count(20)->create();

        Livewire::test(Index::class)
            ->set('perPage', 5)
            ->assertSet('perPage', 5)
            ->assertViewHas('productos', fn ($productos) => $productos->perPage() === 5);
    }

    public function test_todos_option_shows_all_records(): void
    {
        $this->actingAsUser();
        Producto::factory()->count(15)->create();

        Livewire::test(Index::class)
            ->set('perPage', 0)
            ->assertViewHas('productos', fn ($productos) => $productos->total() === $productos->count());
    }

    public function test_per_page_change_resets_to_first_page(): void
    {
        $this->actingAsUser();
        Producto::factory()->count(20)->create();

        Livewire::test(Index::class)
            ->set('perPage', 5)
            ->call('gotoPage', 2)
            ->set('perPage', 10)
            ->assertViewHas('productos', fn ($productos) => $productos->currentPage() === 1);
    }

    public function test_search_resets_to_first_page(): void
    {
        $this->actingAsUser();
        Producto::factory()->count(20)->create();

        Livewire::test(Index::class)
            ->set('perPage', 5)
            ->call('gotoPage', 2)
            ->set('search', '')
            ->assertViewHas('productos', fn ($productos) => $productos->currentPage() === 1);
    }
}
