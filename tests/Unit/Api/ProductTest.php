<?php

namespace Tests\Unit\Api;

use Tests\TestCase;
use App\Models\User;
use App\Models\StoreOwner;
use App\Models\Store;
use App\Models\Product;


class ProductTest extends TestCase
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
     * Test para crear un producto correctamente
     */
    public function testCrearNuevoProducto()
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
        $this->postJson('/api/v1/stores', [
            'store_name' => 'La Tienda Prueba', 
            'slogan' => 'Vendemos cosas :D',
            'nit' => '10203020',
            'owner_id' => $lastUserId,
            'description' => 'Tienda de juguetes experimentales',
            'schedule' => 'Toda la semana de 1 a 9 PM',
            'address' => 'Cra 102',
            'phone_number' => '8910000']);
        $lastStoreId = Store::max('id');
        
        $response = $this->postJson('/api/v1/products', [
            'name' => 'Sopa para gatos', 
            'price' => '10000',
            'discount' => '10',
            'quantity' => '100',
            'store_id' => $lastStoreId,
            'description' => 'Es una sopa hecha de comida para gatos']);
            
        $lastProductId = Product::max('id');
        $response->assertStatus(200);
        $response->assertJsonStructure([
             'data' => [
                'ID', 'Name', 'Store ID', 'Price','Discount','Quantiy Available', 'Description'
             ]
        ]);
        
        $response->assertJson(['data' =>
             [
                'ID' => $lastProductId,
                'Name' => 'Sopa para gatos', 
                'Store ID' => $lastStoreId,
                'Price' => '10000',
                'Quantiy Available' => '100',
                'Description' => 'Es una sopa hecha de comida para gatos'
             ]
        ]);
    }

    /**
     * Test para crear un producto con el nombre incorrecto
     */
    public function testCrearProductoNombreIncorrecto()
    {
        $lastStoreId = Store::max('id');
        
        $response = $this->postJson('/api/v1/products', [
            'name' => '', 
            'price' => '10000',
            'discount' => '10',
            'quantity' => '100',
            'store_id' => $lastStoreId,
            'description' => 'Es una sopa hecha de comida para gatos']);
            
        $response->assertStatus(422);
    }

    /**
     * Test para crear un producto con un precio escrito en letras en lugar de números
     */
    public function testCrearProductoPrecioIncorrecto()
    {
        $lastStoreId = Store::max('id');
        
        $response = $this->postJson('/api/v1/products', [
            'name' => 'Sopa para gatos', 
            'price' => 'Muy cara',
            'discount' => '10',
            'quantity' => '100',
            'store_id' => $lastStoreId,
            'description' => 'Es una sopa hecha de comida para gatos']);
            
        $response->assertStatus(422);
    }
    
    /**
     * Test para crear un producto con descuento nulo
     */
    public function testCrearProductoDescuentoIncorrecto()
    {
        $lastStoreId = Store::max('id');
        
        $response = $this->postJson('/api/v1/products', [
            'name' => 'Sopa para gatos', 
            'price' => '10000',
            'discount' => '',
            'quantity' => '100',
            'store_id' => $lastStoreId,
            'description' => 'Es una sopa hecha de comida para gatos']);
            
        $response->assertStatus(422);
    }
    
    /**
     * Test para crear un producto con cantidad escrita en letras y no en números
     */
    public function testCrearProductoCantidadIncorrecta()
    {
        $lastStoreId = Store::max('id');
        
        $response = $this->postJson('/api/v1/products', [
            'name' => 'Sopa para gatos', 
            'price' => '10000',
            'discount' => '10',
            'quantity' => 'No hay',
            'store_id' => $lastStoreId,
            'description' => 'Es una sopa hecha de comida para gatos']);
            
        $response->assertStatus(422);
    }
    
    /**
     * Test para crear un producto con descripción nula
     */
    public function testCrearProductoDescripcionIncorrecta()
    {
        $lastStoreId = Store::max('id');
        
        $response = $this->postJson('/api/v1/products', [
            'name' => 'Sopa para gatos', 
            'price' => '10000',
            'discount' => '10',
            'quantity' => '100',
            'store_id' => $lastStoreId,
            'description' => '']);
            
        $response->assertStatus(422);
    }

    /**
     * Test para eliminar un producto correctamente
     */
    public function testBorrarProducto(){
        $lastUserId = User::max('id');
        $lastStoreId = Store::max('id');
        $lastProductId = Product::max('id');
        $response = $this->deleteJson('api/v1/products/'.$lastProductId);
        $response->assertStatus(200);
        $this->deleteJson('api/v1/stores/'.$lastStoreId);
        $this->deleteJson('api/v1/users/'.$lastUserId);
        
    }
}
