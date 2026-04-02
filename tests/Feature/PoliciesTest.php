<?php

namespace Tests\Feature;

use App\Models\Categoria;
use App\Models\Producto;
use App\Models\Prueba;
use App\Models\User;
use Database\Seeders\RolesAndPermissionsSeeder;
use Illuminate\Foundation\Testing\LazilyRefreshDatabase;
use Spatie\Permission\Models\Role;
use Tests\TestCase;

class PoliciesTest extends TestCase
{
    use LazilyRefreshDatabase;

    protected User $admin;

    protected User $editor;

    protected User $viewer;

    protected User $sinRol;

    protected function setUp(): void
    {
        parent::setUp();
        $this->seed(RolesAndPermissionsSeeder::class);

        $this->admin = User::factory()->create()->assignRole('admin');
        $this->editor = User::factory()->create()->assignRole('editor');
        $this->viewer = User::factory()->create()->assignRole('viewer');
        $this->sinRol = User::factory()->create();
    }

    // --- ProductoPolicy ---

    public function test_admin_puede_ver_crear_editar_eliminar_productos(): void
    {
        $producto = Producto::factory()->create();

        $this->assertTrue($this->admin->can('viewAny', Producto::class));
        $this->assertTrue($this->admin->can('create', Producto::class));
        $this->assertTrue($this->admin->can('update', $producto));
        $this->assertTrue($this->admin->can('delete', $producto));
    }

    public function test_editor_puede_ver_crear_editar_pero_no_eliminar_productos(): void
    {
        $producto = Producto::factory()->create();

        $this->assertTrue($this->editor->can('viewAny', Producto::class));
        $this->assertTrue($this->editor->can('create', Producto::class));
        $this->assertTrue($this->editor->can('update', $producto));
        $this->assertFalse($this->editor->can('delete', $producto));
    }

    public function test_viewer_solo_puede_ver_productos(): void
    {
        $producto = Producto::factory()->create();

        $this->assertTrue($this->viewer->can('viewAny', Producto::class));
        $this->assertFalse($this->viewer->can('create', Producto::class));
        $this->assertFalse($this->viewer->can('update', $producto));
        $this->assertFalse($this->viewer->can('delete', $producto));
    }

    public function test_usuario_sin_rol_no_puede_acceder_a_productos(): void
    {
        $producto = Producto::factory()->create();

        $this->assertFalse($this->sinRol->can('viewAny', Producto::class));
        $this->assertFalse($this->sinRol->can('create', Producto::class));
        $this->assertFalse($this->sinRol->can('update', $producto));
        $this->assertFalse($this->sinRol->can('delete', $producto));
    }

    // --- PruebaPolicy ---

    public function test_admin_puede_gestionar_pruebas(): void
    {
        $prueba = Prueba::factory()->create();

        $this->assertTrue($this->admin->can('viewAny', Prueba::class));
        $this->assertTrue($this->admin->can('create', Prueba::class));
        $this->assertTrue($this->admin->can('update', $prueba));
        $this->assertTrue($this->admin->can('delete', $prueba));
    }

    public function test_viewer_solo_puede_ver_pruebas(): void
    {
        $prueba = Prueba::factory()->create();

        $this->assertTrue($this->viewer->can('viewAny', Prueba::class));
        $this->assertFalse($this->viewer->can('create', Prueba::class));
        $this->assertFalse($this->viewer->can('update', $prueba));
        $this->assertFalse($this->viewer->can('delete', $prueba));
    }

    // --- CategoriaPolicy ---

    public function test_admin_puede_gestionar_categorias(): void
    {
        $categoria = Categoria::factory()->create();

        $this->assertTrue($this->admin->can('viewAny', Categoria::class));
        $this->assertTrue($this->admin->can('create', Categoria::class));
        $this->assertTrue($this->admin->can('update', $categoria));
        $this->assertTrue($this->admin->can('delete', $categoria));
    }

    public function test_viewer_solo_puede_ver_categorias(): void
    {
        $categoria = Categoria::factory()->create();

        $this->assertTrue($this->viewer->can('viewAny', Categoria::class));
        $this->assertFalse($this->viewer->can('create', Categoria::class));
        $this->assertFalse($this->viewer->can('update', $categoria));
        $this->assertFalse($this->viewer->can('delete', $categoria));
    }

    // --- RolePolicy ---

    public function test_admin_puede_gestionar_roles(): void
    {
        $role = Role::findByName('editor');

        $this->assertTrue($this->admin->can('viewAny', Role::class));
        $this->assertTrue($this->admin->can('create', Role::class));
        $this->assertTrue($this->admin->can('update', $role));
        $this->assertTrue($this->admin->can('delete', $role));
    }

    public function test_editor_no_puede_gestionar_roles(): void
    {
        $role = Role::findByName('viewer');

        $this->assertFalse($this->editor->can('viewAny', Role::class));
        $this->assertFalse($this->editor->can('create', Role::class));
        $this->assertFalse($this->editor->can('update', $role));
        $this->assertFalse($this->editor->can('delete', $role));
    }

    // --- UserPolicy ---

    public function test_admin_puede_gestionar_usuarios(): void
    {
        $this->assertTrue($this->admin->can('viewAny', User::class));
        $this->assertTrue($this->admin->can('create', User::class));
        $this->assertTrue($this->admin->can('update', $this->editor));
        $this->assertTrue($this->admin->can('delete', $this->viewer));
    }

    public function test_editor_no_puede_gestionar_usuarios(): void
    {
        $this->assertFalse($this->editor->can('viewAny', User::class));
        $this->assertFalse($this->editor->can('create', User::class));
        $this->assertFalse($this->editor->can('update', $this->viewer));
        $this->assertFalse($this->editor->can('delete', $this->viewer));
    }
}
