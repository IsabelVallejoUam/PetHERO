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
        $response = $this->postJson('/api/v1/walkers', [
            'slogan' => 'Paseo con cautela y con mortadela', 
            'experience' => '2',
            'user_id' => $lastUserId,
            'score' => '0']);
        // $lastWalkerId= Walker::max('id');
        $response->assertStatus(200);
        $response->assertJsonStructure([
            'data' => [
                'Slogan','Experience','User_Id','Score',
            ]
        ]);
        $response->assertJson(['data' =>
             [
                // "ID" => $lastWalkerId,
                "Slogan" => "Paseo con cautela y con mortadela",
                'Experience' => '2',
                'User_ID' => $lastUserId,
                'score' => '0'
             ]
        ]);
    }

    public function testBorrarPaseador(){
        $lastUserId = User::max('id');
        // $lastWalkerId = Walker::max('id');
        // $response = $this->deleteJson('/api/v1/walkers/'.$lastWalkerId);
        $response = $this->deleteJson('api/v1/users/'.$lastUserId);
        $response->assertStatus(200);
    }
}
