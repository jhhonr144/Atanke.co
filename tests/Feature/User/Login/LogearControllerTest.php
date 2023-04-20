<?php

namespace Tests\Feature\User\Login;

use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class LogearControllerTest extends TestCase
{
    use DatabaseTransactions, WithFaker;
    /**
     * Si la ruta responde ok
     * @return void
     */
    public function test_RutaHabilitadaOK()
    {
        $response = $this->post(route('login'));
        $response->assertStatus(200);
    }
    /**
     * user y clave vacia
     * @return void
     */
    public function test_datosVacios()
    {
        $response = $this->post(route('login'), [
            'email' => '',
            'password' => ''
        ]);
        $response->assertStatus(200)
            ->assertJson([
                'id' => 1,
                'mensaje' => 'Error al logearse.'
            ]);
    }
    /**
     * claave no llega
     * @return void
     */
    public function test_claveVacia()
    {
        $user = User::factory()->make();
        $response = $this->post(route('login'), [
            'email' => $user->email,
            'password' => ''
        ]);
        $response->assertStatus(200)
            ->assertJson([
                'id' => 1,
                'mensaje' => 'Error al logearse.'
            ]);
    }
    /**
     * Cleve erronea
     * @return void
     */
    public function test_claveErronea()
    {
        $user = User::factory()->UserAdmin();
        $response = $this->post(route('login'), [
            'email' => $user->email,
            'password' => 'wrongpassword'
        ]);
        $response->assertStatus(200)
            ->assertJson([
                'id' => 1,
                'mensaje' => 'Error al logearse.'
            ]);
    }
    /**
     * user esta inacrivo
     * @return void
     */
    public function test_UserInactivo()
    {
        $user = User::factory()->UserAdminDesactivo();
        $response = $this->postJson(route('login'), [
            'email' => $user->email,
            'password' => 'password',
        ]);
        $response->assertStatus(200)
            ->assertJson([
                'id' => 1,
                'mensaje' => 'usuario Inactivo'
            ]);
    }
    /**
     * login ok
     * @return void
     */
    public function test_loginOk()
    {
        $user = User::factory()->UserAdmin();
        $response = $this->post(route('login'), [
            'email' => $user->email,
            'password' => 'password'
        ]);
        $response->assertStatus(200)
            ->assertJson([
                'id' => 0,
                'mensaje' => $response->json()['mensaje'],
                'datos' => $response->json()['datos'],
                'datos_len' => $response->json()['datos_len'],
            ]);
    }
}
