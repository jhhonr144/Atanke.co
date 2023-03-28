<?php

namespace Database\Seeders\Permisos;

use App\Models\Permisos;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PermisosDefaultSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $permisos = [
            ['nombre' => 'admin', 'descripcion' => 'Para ser admin'],
            ['nombre' => 'block_palabra', 'descripcion' => 'Para bloquear un usuario de agregar palabra'],
            ['nombre' => 'editar_palabra', 'descripcion' => 'Para modificar el estado de la palabra'],
            ['nombre' => 'crear_palabra', 'descripcion' => 'Para agregar una palabra'],
            
        ];
        
        foreach ($permisos as $permisoData) {
            $permiso = Permisos::where('nombre', $permisoData['nombre'])->first();
            if (!$permiso) {
                $permiso = Permisos::create([
                    'nombre' => $permisoData['nombre'],
                    'descripcion' => $permisoData['descripcion']
                ]);
            }
        }
    }
}
