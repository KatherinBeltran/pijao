<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $role1 = Role::create(['name' => 'Administrador']);
        $role2 = Role::create(['name' => 'Cobrador']);

        Permission::create(['name' => 'home', 'description' => 'Ver panel principal'])->syncRoles([$role1]);
        
        Permission::create(['name' => 'users.index', 'description' => 'Ver listado de usuarios'])->syncRoles([$role1]); 
        Permission::create(['name' => 'users.edit', 'description' => 'Asignar un rol'])->syncRoles([$role1]);
        Permission::create(['name' => 'users.destroy', 'description' => 'Eliminar usuario'])->syncRoles([$role1]);

        Permission::create(['name' => 'roles.index', 'description' => 'Ver listado de roles'])->syncRoles([$role1]); 
        Permission::create(['name' => 'roles.create', 'description' => 'Registrar nuevo rol'])->syncRoles([$role1]); 
        Permission::create(['name' => 'roles.show', 'description' => 'Ver rol'])->syncRoles([$role1]);
        Permission::create(['name' => 'roles.edit', 'description' => 'Editar rol'])->syncRoles([$role1]);
        Permission::create(['name' => 'roles.destroy', 'description' => 'Eliminar rol'])->syncRoles([$role1]);

        Permission::create(['name' => 'zonas.index', 'description' => 'Ver listado de zonas'])->syncRoles([$role1]); 
        Permission::create(['name' => 'zonas.create', 'description' => 'Registrar nuevo zona'])->syncRoles([$role1]); 
        Permission::create(['name' => 'zonas.show', 'description' => 'Ver zona'])->syncRoles([$role1]);
        Permission::create(['name' => 'zonas.edit', 'description' => 'Editar zona'])->syncRoles([$role1]);
        Permission::create(['name' => 'zonas.destroy', 'description' => 'Eliminar zona'])->syncRoles([$role1]);

        Permission::create(['name' => 'barrios.index', 'description' => 'Ver listado de barrios'])->syncRoles([$role1]); 
        Permission::create(['name' => 'barrios.create', 'description' => 'Registrar nuevo barrio'])->syncRoles([$role1]); 
        Permission::create(['name' => 'barrios.show', 'description' => 'Ver barrio'])->syncRoles([$role1]);
        Permission::create(['name' => 'barrios.edit', 'description' => 'Editar barrio'])->syncRoles([$role1]);
        Permission::create(['name' => 'barrios.destroy', 'description' => 'Eliminar barrio'])->syncRoles([$role1]);

        Permission::create(['name' => 'prestamos.index', 'description' => 'Ver listado de prestamos'])->syncRoles([$role1, $role2]); 
        Permission::create(['name' => 'prestamos.create', 'description' => 'Registrar nuevo prestamo'])->syncRoles([$role1, $role2]); 
        Permission::create(['name' => 'prestamos.show', 'description' => 'Ver prestamo'])->syncRoles([$role1, $role2]);
        Permission::create(['name' => 'prestamos.edit', 'description' => 'Editar prestamo'])->syncRoles([$role1, $role2]);
        Permission::create(['name' => 'prestamos.destroy', 'description' => 'Eliminar prestamo'])->syncRoles([$role1, $role2]);

        Permission::create(['name' => 'cuotas.index', 'description' => 'Ver listado de cuotas'])->syncRoles([$role1, $role2]); 
        Permission::create(['name' => 'cuotas.create', 'description' => 'Registrar nuevo cuota'])->syncRoles([$role1, $role2]); 
        Permission::create(['name' => 'cuotas.show', 'description' => 'Ver cuota'])->syncRoles([$role1, $role2]);
        Permission::create(['name' => 'cuotas.edit', 'description' => 'Editar cuota'])->syncRoles([$role1, $role2]);
        Permission::create(['name' => 'cuotas.destroy', 'description' => 'Eliminar cuota'])->syncRoles([$role1, $role2]);

        Permission::create(['name' => 'cobradores.index', 'description' => 'Ver listado de cobradores'])->syncRoles([$role1]); 
        Permission::create(['name' => 'cobradores.create', 'description' => 'Registrar nuevo cobrador'])->syncRoles([$role1]); 
        Permission::create(['name' => 'cobradores.show', 'description' => 'Ver cobrador'])->syncRoles([$role1]);
        Permission::create(['name' => 'cobradores.edit', 'description' => 'Editar cobrador'])->syncRoles([$role1]);
        Permission::create(['name' => 'cobradores.destroy', 'description' => 'Eliminar cobrador'])->syncRoles([$role1]);

        Permission::create(['name' => 'categorias.index', 'description' => 'Ver listado de categorias'])->syncRoles([$role1]); 
        Permission::create(['name' => 'categorias.create', 'description' => 'Registrar nueva categoria'])->syncRoles([$role1]); 
        Permission::create(['name' => 'categorias.show', 'description' => 'Ver categoria'])->syncRoles([$role1]);
        Permission::create(['name' => 'categorias.edit', 'description' => 'Editar categoria'])->syncRoles([$role1]);
        Permission::create(['name' => 'categorias.destroy', 'description' => 'Eliminar categoria'])->syncRoles([$role1]);

        Permission::create(['name' => 'gastos.index', 'description' => 'Ver listado de gastos'])->syncRoles([$role1]); 
        Permission::create(['name' => 'gastos.create', 'description' => 'Registrar nuevo gasto'])->syncRoles([$role1]); 
        Permission::create(['name' => 'gastos.show', 'description' => 'Ver gasto'])->syncRoles([$role1]);
        Permission::create(['name' => 'gastos.edit', 'description' => 'Editar gasto'])->syncRoles([$role1]);
        Permission::create(['name' => 'gastos.destroy', 'description' => 'Eliminar gasto'])->syncRoles([$role1]);

        Permission::create(['name' => 'reportes.index', 'description' => 'Generar reporte económico'])->syncRoles([$role1]);
    }
}