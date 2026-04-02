<?php

namespace Tests\Feature;

use App\Livewire\Categorias\Create as CreateCategoria;
use App\Livewire\Categorias\Edit as EditCategoria;
use App\Livewire\Categorias\Index as IndexCategorias;
use App\Livewire\Productos\Create as CreateProducto;
use App\Livewire\Productos\Edit as EditProducto;
use App\Livewire\Productos\Index as IndexProductos;
use App\Livewire\Pruebas\Create as CreatePrueba;
use App\Livewire\Pruebas\Edit as EditPrueba;
use App\Livewire\Pruebas\Index as IndexPruebas;
use App\Models\Categoria;
use App\Models\Producto;
use App\Models\Prueba;
use App\Models\User;
use Database\Seeders\RolesAndPermissionsSeeder;
use Illuminate\Foundation\Testing\LazilyRefreshDatabase;
use Livewire\Livewire;
use Tests\TestCase;

class LivewireAuthorizationTest extends TestCase
{
    use LazilyRefreshDatabase;

    protected User $editor;

    protected User $viewer;

    protected function setUp(): void
    {
        parent::setUp();
        $this->seed(RolesAndPermissionsSeeder::class);

        $this->editor = User::factory()->create()->assignRole('editor');
        $this->viewer = User::factory()->create()->assignRole('viewer');
    }

    // --- Productos ---

    /**
     * delete() es AJAX → el hook intercepta, muestra toast (200) y no elimina.
     */
    public function test_viewer_no_puede_eliminar_producto(): void
    {
        $producto = Producto::factory()->create();

        Livewire::actingAs($this->viewer)
            ->test(IndexProductos::class)
            ->call('delete', $producto->id)
            ->assertOk();

        $this->assertModelExists($producto);
    }

    public function test_editor_no_puede_eliminar_producto(): void
    {
        $producto = Producto::factory()->create();

        Livewire::actingAs($this->editor)
            ->test(IndexProductos::class)
            ->call('delete', $producto->id)
            ->assertOk();

        $this->assertModelExists($producto);
    }

    /**
     * mount() es carga de página → sin X-Livewire header → el hook no intercepta → 403.
     */
    public function test_viewer_no_puede_acceder_a_crear_producto(): void
    {
        Livewire::actingAs($this->viewer)
            ->test(CreateProducto::class, ['producto' => new Producto])
            ->assertForbidden();
    }

    public function test_viewer_no_puede_acceder_a_editar_producto(): void
    {
        $producto = Producto::factory()->create();

        Livewire::actingAs($this->viewer)
            ->test(EditProducto::class, ['producto' => $producto])
            ->assertForbidden();
    }

    public function test_editor_puede_crear_producto(): void
    {
        Livewire::actingAs($this->editor)
            ->test(CreateProducto::class, ['producto' => new Producto])
            ->assertOk();
    }

    // --- Pruebas ---

    public function test_viewer_no_puede_eliminar_prueba(): void
    {
        $prueba = Prueba::factory()->create();

        Livewire::actingAs($this->viewer)
            ->test(IndexPruebas::class)
            ->call('delete', $prueba->id)
            ->assertOk();

        $this->assertModelExists($prueba);
    }

    public function test_editor_no_puede_eliminar_prueba(): void
    {
        $prueba = Prueba::factory()->create();

        Livewire::actingAs($this->editor)
            ->test(IndexPruebas::class)
            ->call('delete', $prueba->id)
            ->assertOk();

        $this->assertModelExists($prueba);
    }

    public function test_viewer_no_puede_acceder_a_crear_prueba(): void
    {
        Livewire::actingAs($this->viewer)
            ->test(CreatePrueba::class, ['prueba' => new Prueba])
            ->assertForbidden();
    }

    public function test_viewer_no_puede_acceder_a_editar_prueba(): void
    {
        $prueba = Prueba::factory()->create();

        Livewire::actingAs($this->viewer)
            ->test(EditPrueba::class, ['prueba' => $prueba])
            ->assertForbidden();
    }

    // --- Categorias ---

    public function test_viewer_no_puede_eliminar_categoria(): void
    {
        $categoria = Categoria::factory()->create();

        Livewire::actingAs($this->viewer)
            ->test(IndexCategorias::class)
            ->call('delete', $categoria->id)
            ->assertOk();

        $this->assertModelExists($categoria);
    }

    public function test_viewer_no_puede_acceder_a_crear_categoria(): void
    {
        Livewire::actingAs($this->viewer)
            ->test(CreateCategoria::class, ['categoria' => new Categoria])
            ->assertForbidden();
    }

    public function test_viewer_no_puede_acceder_a_editar_categoria(): void
    {
        $categoria = Categoria::factory()->create();

        Livewire::actingAs($this->viewer)
            ->test(EditCategoria::class, ['categoria' => $categoria])
            ->assertForbidden();
    }
}
