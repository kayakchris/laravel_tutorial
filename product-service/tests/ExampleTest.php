<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class ExampleTest extends TestCase
{
    use DatabaseTransactions;

    protected $jsonHeaders = ['Content-Type' => 'application/json', 'Accept' => 'application/json'];
    /**
     * A basic functional test example.
     *
     * @return void
     */
    public function testBasicExample()
    {
        $this->visit('/')
             ->see('Laravel 5');
    }

    public function testProductsList()
    {
        $products = factory(\App\Product::class, 3)->create();

        $this->get(route('api.products.index'))
             ->assertResponseOk();

        array_map(function($product){
            $this->seeJson($product->jsonSerialize());
        }, $products->all());
    }

    public function testProductDescriptionsList()
    {
        $product = factory(\App\Product::class)->create();
        $product->descriptions()->saveMany(factory(\App\Description::class, 3)->make());

        $this->get(route('api.products.descriptions.index', ['productId' => $product->id]))
             ->assertResponseOk();

        array_map(function($description){
            $this->seeJson($description->jsonSerialize());
        }, $product->descriptions->all());
    }

    public function testCreateProduct()
    {
        $product = factory(\App\Product::class)->make(['name' => 'beets']);

        $this->post(route('api.products.store'), $product->jsonSerialize(), $this->jsonHeaders)
             ->seeInDatabase('products', ['name' => $product->name])
             ->assertResponseOk();
    }

//    public function testProductDescriptionCreation()
//    {
//        $product = factory(\App\Product::class)->create(['name' => 'beets']);
//        $description = factory(\App\Description::class)->make();
//
//        $this->post(route('api.products.descriptions.store', ['products' => $product->id]), $product->jsonSerialize(), $this->jsonHeaders)
//                ->seeInDatabase('descriptions', ['body' => $description->body])
//                ->assertResponseOk();
//
//    }
}
