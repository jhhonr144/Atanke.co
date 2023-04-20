<?php

namespace Tests\Feature\Palabra\Editar;

use App\Models\Palabras;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class editarPalabraControllerTest extends TestCase
{
    /**
     * Ruta OK: La ruta responde bien. 
     * @return void
     */
    public function test_rutaOK()
    {
        $user = User::factory()->UserAdmin(); // Creamos un usuario administrador para la prueba
        $response = $this->actingAs($user)->get('api/Palabras/Estado?id=1&a=1'); 
        $response->assertStatus(200)
            ->assertJson([
                'id' => 0,
                'mensaje' => 'Palabra Editada'
            ]);
    }
    /**
     * User sin permiso: No es un usuario administrador o con permiso para editar.
     * @return void
     */
    public function test_userSinPermiso()
    {
        $user = User::factory()->UserDefault(); // Creamos un usuario no administrador para la prueba
        $response = $this->actingAs($user)->get('api/Palabras/Estado?id=1&a=0');
        $response->assertStatus(200)
            ->assertJson([
                'id' => -1,
                'mensaje' => 'Sin Permiso para editar Estado de la Palabra'
            ]);
    }
    /**
     * Palabra no encontrada: El usuario edita una palabra no existente.
     * @return void
     */
    public function test_palabraNoEncontrada()
    {
        $user = User::factory()->UserAdmin(); // Creamos un usuario administrador para la prueba
        $response = $this->actingAs($user)->get('api/Palabras/Estado?id=999&a=0');
        $response->assertStatus(200)
            ->assertJson([
                'id' => 1,
                'mensaje' => 'Palabra no encontrada'
            ]);
    }
    /**
     * No pasa ID de palabra: Solo pasa el token. 
     * @return void
     */
    public function test_noPasaIDPalabra()
    {
        $user = User::factory()->UserAdmin()->make(); // Creamos un usuario administrador para la prueba
        $response = $this->actingAs($user)->get('/Palabras/Estado?a=0');
        $response->assertStatus(404); // Esperamos un error de validación por no pasar el ID de la palabra
    }
    /**
     * ID de palabra null: Solo pasa el token. 
     * @return void
     */
    public function test_PasaIDNullPalabra()
    {
        $user = User::factory()->UserAdmin()->make(); // Creamos un usuario administrador para la prueba
        $response = $this->actingAs($user)->get('/Palabras/Estado?a=0&id');
        $response->assertStatus(404); // Esperamos un error de validación por no pasar el ID de la palabra
    }
    /**
     * Todo OK: Edita el estado de la palabra.
     * @return void
     */
    public function test_todoOK()
    {
        $user = User::factory()->UserAdmin();  // Creamos un usuario administrador para la prueba
        $palabra = Palabras::factory()->create();
        $response = $this->actingAs($user)->get('api/Palabras/Estado?id='.$palabra->id.'&a=0');
        $response->assertStatus(200)
            ->assertJson([
                'id' => 0,
                'mensaje' => 'Palabra Editada'
            ]);
        $palabra->delete();
        $user->delete();
    }
}
