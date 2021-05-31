<?php

namespace Tests\Unit\Api;

use Tests\TestCase;
use App\Models\User;
use App\Models\StoreOwner;
use App\Models\Store;

class StoreTest extends TestCase
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
     * Test para crear una tienda correctamente
     */
    public function testCrearNuevaTienda()
    {
        $this->postJson('/api/v1/users', [
            'name' => 'Dueño', 
            'lastname' => 'De Mascotas',
            'email' => 'mascotasD@gmail.com',
            'document' => '2323232323',
            'phone' => '310202021',
            'password' => "hola123"]);
        $lastUserId = User::max('id');   
        $this->postJson('/api/v1/storeOwners', [
            'user_id' => $lastUserId]);
        $response = $this->postJson('/api/v1/stores', [
            'store_name' => 'La Tienda Prueba', 
            'slogan' => 'Vendemos cosas :D',
            'nit' => '10203020',
            'owner_id' => $lastUserId,
            'description' => 'Tienda de juguetes experimentales',
            'schedule' => 'Toda la semana de 1 a 9 PM',
            'address' => 'Cra 102',
            'phone_number' => '8910000']);
        $response->assertStatus(200);
        $response->assertJsonStructure([
             'data' => [
                'ID', 'Owner ID', 'Name', 'Slogan','Nit','Description', 'Schedule', 'Address', 'Phone Number'
             ]
        ]);
        $lastStoreId = Store::max('id');
        $response->assertJson(['data' =>
             [
                'ID' => $lastStoreId,
                'Name' => 'La Tienda Prueba', 
                'Slogan' => 'Vendemos cosas :D',
                'Nit' => '10203020',
                'Owner ID' => $lastUserId,
                'Description' => 'Tienda de juguetes experimentales',
                'Schedule' => 'Toda la semana de 1 a 9 PM',
                'Address' => 'Cra 102',
                'Phone Number' => '8910000'
             ]
        ]);
    }

    /**
     * Test para crear una tienda con nombre nulo
     */
    public function testCrearTiendaNombreIncorrecto()
    {
        $lastUserId = User::max('id');   
        $response = $this->postJson('/api/v1/stores', [
            'store_name' => '', 
            'slogan' => 'Vendemos cosas :D',
            'nit' => '10203020',
            'owner_id' => $lastUserId,
            'description' => 'Tienda de juguetes experimentales',
            'schedule' => 'Toda la semana de 1 a 9 PM',
            'address' => 'Cra 102',
            'phone_number' => '8910000']);
        $response->assertStatus(422);
    }
    
    /**
     * Test para crear una tienda con NIT más corto de lo indicado
     */
    public function testCrearTiendaNitIncorrecto()
    {
        $lastUserId = User::max('id');   
        $response = $this->postJson('/api/v1/stores', [
            'store_name' => 'La Tienda Prueba', 
            'slogan' => 'Vendemos cosas :D',
            'nit' => '1020302',
            'owner_id' => $lastUserId,
            'description' => 'Tienda de juguetes experimentales',
            'schedule' => 'Toda la semana de 1 a 9 PM',
            'address' => 'Cra 102',
            'phone_number' => '8910000']);
        $response->assertStatus(422);
    }

    /**
     * Test para crear una tienda con número de teléfono escrito en letras y no en números
     */
    public function testCrearTiendaNumeroIncorrecto()
    {
        $lastUserId = User::max('id');   
        $response = $this->postJson('/api/v1/stores', [
            'store_name' => 'La Tienda Prueba', 
            'slogan' => 'Vendemos cosas :D',
            'nit' => '10203020',
            'owner_id' => $lastUserId,
            'description' => 'Tienda de juguetes experimentales',
            'schedule' => 'Toda la semana de 1 a 9 PM',
            'address' => 'Cra 102',
            'phone_number' => 'pepe']);
        $response->assertStatus(422);
    }

    /**
     * Test para crear una tienda con dirección nula
     */
    public function testCrearTiendaDireccionIncorrecta()
    {
        $lastUserId = User::max('id');   
        $response = $this->postJson('/api/v1/stores', [
            'store_name' => 'La Tienda Prueba', 
            'slogan' => 'Vendemos cosas :D',
            'nit' => '10203020',
            'owner_id' => $lastUserId,
            'description' => 'Tienda de juguetes experimentales',
            'schedule' => 'Toda la semana de 1 a 9 PM',
            'address' => '',
            'phone_number' => '8910000']);
        $response->assertStatus(422);
    }
 
    /**
     * Test para eliminar una tienda correctamente
     */
    public function testBorrarTienda(){
        $lastUserId = User::max('id');
        $lastStoreId = Store::max('id');
        $response = $this->deleteJson('api/v1/stores/'.$lastStoreId);
        $response->assertStatus(200);
        $this->deleteJson('api/v1/users/'.$lastUserId);
    }

}
