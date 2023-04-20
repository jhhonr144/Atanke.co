<?php

namespace Tests\Feature\User\updated;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class updateUserControlllerTest extends TestCase
{
    /**
     * Ruta ok
     * @return void
     */
    public function test_userRolUpdateRoute()
    {
        $user = User::factory()->UserAdmin(); // Creamos un usuario administrador para la prueba
        $response = $this->actingAs($user)->put('api/user/rol');
        $response->assertStatus(200);
    }
    /**
     * usuario sin permiso trata de editar rol
     * @return void
     */
    public function test_editarUsuarioSinPermiso()
    {
        $usuario = User::factory()->UserDefault(); // creamos un usuario de prueba
        $nuevosDatos = [
            'id' => $usuario->id,
            'nombre' => $usuario->name,
            'correo' => $usuario->email,
            'estado' => $usuario->r_users_estados,
            'rol' => 1 // intentamos cambiar el rol del usuario
        ];
        $response = $this->actingAs($usuario)->put('api/user/rol', $nuevosDatos);
        $response->assertStatus(200)
            ->assertJson([
                'id' => -1,
                'mensaje' => "Sin Permiso, para Editar el rol del Usuario"
            ]);
    }
    /**
     * si no envian el id
     * @return void
     */
    public function test_noID()
    {
        $user = User::factory()->UserAdmin();  // Creamos un usuario administrador para la prueba
        $response = $this->actingAs($user)->put('api/user/rol', [
            'r_users_estados' => 1
        ]);
        $response->assertStatus(200)
            ->assertJson([
                'id' => -1,
                'mensaje' => 'Falta datos, para Editar el rol del Usuario'
            ]);
    }
    /**
     * edita a un user que no xiste
     * @return void
     */
    public function test_idUserInexistente()
    {
        $user = User::factory()->UserAdmin();
        $response = $this->actingAs($user)->put('/api/user/rol', [
            'id' => 999,
            'r_users_estados' => 'Activo',
        ]);
        $response->assertStatus(200)
            ->assertJson([
                'id' => -1,
                'mensaje' => 'Usuario no Existe',
            ]);
    }
    /**
     * todo ok
     * @return void
     */
    public function test_editUserEstado(): void
    {
        $user = User::factory()->UserAdmin();
        $user->save();
        $response = $this->actingAs($user)
            ->putJson('/api/user/rol', [
                'id' => $user->id,
                'r_users_estados' => '1'
            ]);
        $response->assertStatus(200)->assertJson([
            'id' => 0,
            'mensaje' => 'Editado el rol del Usuario'
        ]); 
        $user->delete();
    }
}
