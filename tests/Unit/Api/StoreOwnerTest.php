<?php

namespace Tests\Unit\Api;

use Tests\TestCase;
use App\Models\User;
use App\Models\StoreOwner;

class StoreOwnerTest extends TestCase
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
     * Test para crear un dueño de tiendas correctamente
     */
    public function testCrearNuevoDuenoTienda()
    {
        $this->postJson('/api/v1/users', [
            'name' => 'Dueño', 
            'lastname' => 'Dueñador',
            'email' => 'dueno@gmail.com',
            'document' => '212121212',
            'phone' => '310202020',
            'password' => "hola123"]);
        $lastUserId = User::max('id');
        var_dump($lastUserId);
        $response = $this->postJson('/api/v1/storeOwners', [
            'user_id' => $lastUserId]);
        $response->assertStatus(200);
        $response->assertJsonStructure([
            'data' => [
                'Store Owner ID', 'Name', 'Apellido','Email','Phone'
            ]
        ]);
        $response->assertJson(['data' =>
             [
                // "ID" => $lastWalkerId,
                "Store Owner ID"=> $lastUserId,
                "Name"=> "Link Creado",
                "Apellido"=> "En Test",
                "Phone Number"=> "8905420",
                "Email"=> "linkuarda@email.com",
             ]
        ]);
    }

    /**
     * Test para eliminar un dueño de tiendas correctamente
     */
    public function testBorrarDuenoTienda(){
        $lastUserId = User::max('id');
        $response = $this->deleteJson('api/v1/users/'.$lastUserId);
        $response->assertStatus(200);
    }
}
