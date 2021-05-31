<?php

namespace Tests\Unit\Api;

use Tests\TestCase;

use App\Models\User;
use App\Models\PetOwner;
use App\Models\Pet;

class PetTest extends TestCase
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

    public function testCrearNuevaMascota()
    {
        $this->postJson('/api/v1/users', [
            'name' => 'Dueño', 
            'lastname' => 'De Mascotas',
            'email' => 'mascotasD@gmail.com',
            'document' => '2323232323',
            'phone' => '310202021',
            'password' => "hola123"]);
        $lastUserId = User::max('id');   
        $this->postJson('/api/v1/petOwners', [
            'address' => 'Calle 10',
            'user_id' => $lastUserId]);
        $response = $this->postJson('/api/v1/pets', [
            'name' => 'Firulais', 
            'species' => 'dog',
            'race' => 'Cocker spaniel',
            'owner_id' => $lastUserId,
            'sex' => 'Macho',
            'age' => '12',
            'personality' => 'shy',
            'commentary' => 'Le gustan las galletas',
            'size' => 'medium']);
        $response->assertStatus(200);
        $response->assertJsonStructure([
             'data' => [
                'Pet ID', 'Pet Name', 'Type of Pet','Race','Pet Owner ID', 'Sex', 'Age', 'Personality', 'Commentary', 'Size'
             ]
        ]);
        $lastPetId = Pet::max('id');
        $response->assertJson(['data' =>
             [
                "Pet ID" => $lastPetId,
                "Pet Name"=> "Firulais",
                "Type of Pet"=> "dog",
                "Race"=> "Cocker spaniel",
                "Pet Owner ID"=> $lastUserId,
                'Sex' => 'Macho',
                'Age' => '12',
                'Personality' => 'shy',
                'Commentary' => 'Le gustan las galletas',
                'Size' => 'medium',
             ]
        ]);
    }

    public function testCrearMascotaNombreIncorrecto()
    {
        $lastUserId = User::max('id');   
        $response = $this->postJson('/api/v1/pets', [
            'name' => '', 
            'species' => 'dog',
            'race' => 'Cocker spaniel',
            'owner_id' => $lastUserId,
            'sex' => 'Macho',
            'age' => '12',
            'personality' => 'shy',
            'commentary' => 'Le gustan las galletas',
            'size' => 'medium']);
        $response->assertStatus(422);
    }

    public function testCrearMascotaEspecieIncorrecta()
    {
        $lastUserId = User::max('id');   
        $response = $this->postJson('/api/v1/pets', [
            'name' => 'Firulais', 
            'species' => '',
            'race' => 'Cocker spaniel',
            'owner_id' => $lastUserId,
            'sex' => 'Macho',
            'age' => '12',
            'personality' => 'shy',
            'commentary' => 'Le gustan las galletas',
            'size' => 'medium']);
        $response->assertStatus(422);
    }

    public function testCrearMascotaRazaIncorrecta()
    {
        $lastUserId = User::max('id');   
        $response = $this->postJson('/api/v1/pets', [
            'name' => 'Firulais', 
            'species' => 'dog',
            'race' => '',
            'owner_id' => $lastUserId,
            'sex' => 'Macho',
            'age' => '12',
            'personality' => 'shy',
            'commentary' => 'Le gustan las galletas',
            'size' => 'medium']);
        $response->assertStatus(422);
    }

    public function testCrearMascotaSexoIncorrecto()
    {
        $lastUserId = User::max('id');   
        $response = $this->postJson('/api/v1/pets', [
            'name' => 'Firulais', 
            'species' => 'dog',
            'race' => 'Cocker spaniel',
            'owner_id' => $lastUserId,
            'sex' => '',
            'age' => '12',
            'personality' => 'shy',
            'commentary' => 'Le gustan las galletas',
            'size' => 'medium']);
        $response->assertStatus(422);
    }

    public function testCrearMascotaEdadIncorrecta()
    {
        $lastUserId = User::max('id');   
        $response = $this->postJson('/api/v1/pets', [
            'name' => 'Firulais', 
            'species' => 'dog',
            'race' => 'Cocker spaniel',
            'owner_id' => $lastUserId,
            'sex' => 'Macho',
            'age' => '',
            'personality' => 'shy',
            'commentary' => 'Le gustan las galletas',
            'size' => 'medium']);
        $response->assertStatus(422);
    }

    public function testCrearMascotaPersonalidadIncorrecta()
    {
        $lastUserId = User::max('id');   
        $response = $this->postJson('/api/v1/pets', [
            'name' => 'Firulais', 
            'species' => 'dog',
            'race' => 'Cocker spaniel',
            'owner_id' => $lastUserId,
            'sex' => 'Macho',
            'age' => '12',
            'personality' => '',
            'commentary' => 'Le gustan las galletas',
            'size' => 'medium']);
        $response->assertStatus(422);
    }

    public function testCrearMascotaTamanoIncorrecto()
    {
        $lastUserId = User::max('id');   
        $response = $this->postJson('/api/v1/pets', [
            'name' => 'Firulais', 
            'species' => 'dog',
            'race' => 'Cocker spaniel',
            'owner_id' => $lastUserId,
            'sex' => 'Macho',
            'age' => '12',
            'personality' => 'shy',
            'commentary' => 'Le gustan las galletas',
            'size' => '']);
        $response->assertStatus(422);
    }


    public function testBorrarMascota(){
        $lastUserId = User::max('id');
        $lastPetId = Pet::max('id');
        $response = $this->deleteJson('api/v1/pets/'.$lastPetId);
        $response->assertStatus(200);
        $this->deleteJson('api/v1/users/'.$lastUserId);
    }
}
