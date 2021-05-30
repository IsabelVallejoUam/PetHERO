<?php

namespace Tests\Unit\Api;

use Tests\TestCase;
// use Illuminate\Support\Facades\Hash;
use App\Models\User;


class UserTest extends TestCase
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

    public function testCrearNuevoUsuario()
    {
        $response = $this->postJson('/api/v1/users', [
            'name' => 'Link Creado', 
            'lastname' => 'En Test',
            'email' => 'linkuardo@yahoo.com',
            'document' => '102010201',
            'phone' => '310292929',
            'password' => "hola123"]);
        $lastId = User::max('id');
        $response->assertStatus(200);
        $response->assertJsonStructure([
            'data' => [
                'ID', 'Name','Lastname','Email','Document','Phone','Avatar photo'
            ]
        ]);
        $response->assertJson(['data' =>
             [
                "ID" => $lastId,
                "Name" => "Link Creado",
                "Lastname" => "En Test",
                "Email" => "linkuardo@yahoo.com"
             ]
        ]);
    }

    public function testCrearUsuarioNombreIncorrecto()
    {
        $response = $this->postJson('/api/v1/users', [
            'name' => '', 
            'lastname' => 'En Test',
            'email' => 'linkuardo@yahoo.com',
            'document' => '102010201',
            'phone' => '310292929',
            'password' => "hola123"]);
        $lastId = User::max('id');
        $response->assertStatus(422);
    }

    public function testCrearUsuarioApellidoIncorrecto()
    {
        $response = $this->postJson('/api/v1/users', [
            'name' => 'Link Creado', 
            'lastname' => '',
            'email' => 'linkuardo@yahoo.com',
            'document' => '102010201',
            'phone' => '310292929',
            'password' => "hola123"]);
        $lastId = User::max('id');
        $response->assertStatus(422);
    }

    public function testCrearUsuarioCorreoIncorrecto()
    {
        $response = $this->postJson('/api/v1/users', [
            'name' => 'Link Creado', 
            'lastname' => 'En Test',
            'email' => '112',
            'document' => '102010201',
            'phone' => '310292929',
            'password' => "hola123"]);
        $lastId = User::max('id');
        $response->assertStatus(422);
    }

    public function testCrearUsuarioDocumentoIncorrecto()
    {
        $response = $this->postJson('/api/v1/users', [
            'name' => 'Link Creado', 
            'lastname' => 'En Test',
            'email' => 'linkuardo@yahoo.com',
            'document' => '12',
            'phone' => '310292929',
            'password' => "hola123"]);
        $lastId = User::max('id');
        $response->assertStatus(422);
    }

    public function testCrearUsuarioTelefonoIncorrecto()
    {
        $response = $this->postJson('/api/v1/users', [
            'name' => 'Link Creado', 
            'lastname' => 'En Test',
            'email' => 'linkuardo@yahoo.com',
            'document' => '102010201',
            'phone' => '90900909000909090909090909',
            'password' => "hola123"]);
        $lastId = User::max('id');
        $response->assertStatus(422);
    }

    // public function testCrearUsuarioNoContrasena()
    // {
    //     $response = $this->postJson('/api/v1/users', [
    //         'name' => 'Link Creado', 
    //         'lastname' => 'En Test',
    //         'email' => 'linkuardo@yahoo.com',
    //         'document' => '102010201',
    //         'phone' => '310292929',
    //         'password' => '']);
    //     $lastId = User::max('id');
    //     $response->assertStatus(422);
    // }

    public function testBorrarUsuario(){
        $lastId = User::max('id');
        $response = $this->deleteJson('/api/v1/users/'.$lastId);
        $response->assertStatus(200);
    }
}
