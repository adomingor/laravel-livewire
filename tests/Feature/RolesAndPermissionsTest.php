<?php

namespace Tests\Feature;

use App\Models\User;
use Database\Seeders\RolesAndPermissionsSeeder;
use Filament\Panel;
use Illuminate\Foundation\Testing\LazilyRefreshDatabase;
use Spatie\Permission\Models\Role;
use Tests\TestCase;

class RolesAndPermissionsTest extends TestCase
{
    use LazilyRefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        $this->seed(RolesAndPermissionsSeeder::class);
    }

    public function test_seeder_crea_tres_roles(): void
    {
        $this->assertDatabaseHas('roles', ['name' => 'admin']);
        $this->assertDatabaseHas('roles', ['name' => 'editor']);
        $this->assertDatabaseHas('roles', ['name' => 'viewer']);
    }

    public function test_rol_admin_tiene_todos_los_permisos(): void
    {
        $admin = Role::findByName('admin');
        $this->assertGreaterThanOrEqual(20, $admin->permissions->count());
    }

    public function test_usuario_con_rol_admin_puede_acceder_al_panel(): void
    {
        $panel = Panel::make()->id('admin');
        $user = User::factory()->create();
        $user->assignRole('admin');

        $this->assertTrue($user->canAccessPanel($panel));
    }

    public function test_usuario_sin_rol_admin_no_puede_acceder_al_panel(): void
    {
        $panel = Panel::make()->id('admin');
        $user = User::factory()->create();
        $user->assignRole('editor');

        $this->assertFalse($user->canAccessPanel($panel));
    }

    public function test_rol_editor_no_puede_eliminar_ni_gestionar_roles(): void
    {
        $user = User::factory()->create();
        $user->assignRole('editor');

        $this->assertFalse($user->hasPermissionTo('eliminar productos'));
        $this->assertFalse($user->hasPermissionTo('ver roles'));
        $this->assertFalse($user->hasPermissionTo('ver usuarios'));
    }

    public function test_rol_viewer_solo_tiene_permisos_de_lectura(): void
    {
        $user = User::factory()->create();
        $user->assignRole('viewer');

        $this->assertTrue($user->hasPermissionTo('ver productos'));
        $this->assertFalse($user->hasPermissionTo('crear productos'));
        $this->assertFalse($user->hasPermissionTo('editar productos'));
        $this->assertFalse($user->hasPermissionTo('eliminar productos'));
    }
}
