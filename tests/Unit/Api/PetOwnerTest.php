<?php

namespace Tests\Unit\Api;

use Tests\TestCase;
use App\Models\User;
use App\Models\PetOwner;

class PetOwnerTest extends TestCase
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
     * Test para crear un dueño de mascota exitosamente
     */
    public function testCrearNuevoDuenoMascota()
    {
        $this->postJson('/api/v1/users', [
            'name' => 'Dueño', 
            'lastname' => 'De Mascotas',
            'email' => 'mascotasD@gmail.com',
            'document' => '2323232323',
            'phone' => '310202021',
            'password' => "hola123"]);
        $lastUserId = User::max('id');
        var_dump($lastUserId);
        $response = $this->postJson('/api/v1/petOwners', [
            'address' => 'Calle 10',
            'user_id' => $lastUserId]);
        $response->assertStatus(200);
        $response->assertJsonStructure([
            'data' => [
                'Store Owner ID', 'Name', 'Apellido','Email','Phone', 'Address'
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
                "Address" => 'Calle 10'
             ]
        ]);
    }

    /**
     * Crear un dueño de mascota cuya dirección es nula
     */
    public function testCrearDuenoMascotaDireccionIncorrecta()
    {
        $lastUserId = User::max('id');
        $response = $this->postJson('/api/v1/petOwners', [
            'address' => '',
            'user_id' => $lastUserId]);
        // $lastWalkerId= Walker::max('id');
        $response->assertStatus(422);
    }

    /**
     * Test para eliminar un dueño de mascota correctamente
     */
    public function testBorrarDuenoMascota(){
        $lastUserId = User::max('id');
        $response = $this->deleteJson('api/v1/users/'.$lastUserId);
        $response->assertStatus(200);
    }
}
