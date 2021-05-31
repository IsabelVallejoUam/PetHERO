<?php

namespace Tests\Unit\Api;

use Tests\TestCase;
use App\Models\User;
use App\Models\Walker;

class WalkerTest extends TestCase
{
    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function test_example()
    {
        $this->assertTrue(true);
    }

    /**
     * Test para crear un paseador correctamente
     */
    public function testCrearNuevoPaseador()
    {
        $this->postJson('/api/v1/users', [
            'name' => 'Link Creado', 
            'lastname' => 'En Test',
            'email' => 'linkuarda@email.com',
            'document' => '102010202',
            'phone' => '310292920',
            'password' => "hola123"]);
        $lastUserId = User::max('id');
        var_dump($lastUserId);
        $response = $this->postJson('/api/v1/walkers', [
            'slogan' => 'Paseo con cautela y con mortadela', 
            'experience' => '2',
            'user_id' => $lastUserId]);
        // $lastWalkerId= Walker::max('id');
        $response->assertStatus(200);
        $response->assertJsonStructure([
            'data' => [
                'Walker ID','Slogan','Experience'
            ]
        ]);
        $response->assertJson(['data' =>
             [
                "Slogan" => "Paseo con cautela y con mortadela",
                "Experience" => "2",
             ]
        ]);
    }

    /**
     * Test para crear un paseador con slogan nulo
     */
    public function testCrearPaseadorSloganIncorrecto()
    {
        $lastUserId = User::max('id');
        $response = $this->postJson('/api/v1/walkers', [
            'slogan' => '', 
            'experience' => '2',
            'user_id' => $lastUserId]);
        // $lastWalkerId= Walker::max('id');
        $response->assertStatus(422);
    }

    /**
     * Test para crear un paseador con experiencia negativa
     */
    public function testCrearPaseadorExperienciaIncorrecta()
    {
        $lastUserId = User::max('id');
        $response = $this->postJson('/api/v1/walkers', [
            'slogan' => 'Paseo con cautela y con mortadela', 
            'experience' => '-3',
            'user_id' => $lastUserId]);
        // $lastWalkerId= Walker::max('id');
        $response->assertStatus(422);
    }

    /**
     * Test para eliminar un paseador correctamente
     */
    public function testBorrarPaseador(){
        $lastUserId = User::max('id');
        // $lastWalkerId = Walker::max('id');
        // $response = $this->deleteJson('/api/v1/walkers/'.$lastWalkerId);
        $response = $this->deleteJson('api/v1/users/'.$lastUserId);
        $response->assertStatus(200);
    }
}
