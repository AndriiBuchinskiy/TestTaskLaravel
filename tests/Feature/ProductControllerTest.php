<?php

namespace Tests\Feature;


use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;
use App\Models\Product;

class ProductControllerTest extends TestCase
{
    use WithFaker;
    use DatabaseTransactions;

    public function testCreate()
    {
        $response = $this->get(route('products.create'));

        $response->assertStatus(200);
        $response->assertViewIs('products.create');
    }

    public function testIndex()
    {
        $response = $this->get(route('products.index'));

        $response->assertStatus(200);
        $response->assertViewIs('products.index');
    }

    public function testShow()
    {
        $product = Product::factory()->create();

        $response = $this->get(route('products.show', $product->id));

        $response->assertStatus(200);
        $response->assertViewIs('products.show');
    }

    public function testStore()
    {
        // Create the user first
        $user = User::factory()->create();

        $data = [
            'title' => $this->faker->word,
            'description' => $this->faker->sentence,
            'price' => $this->faker->randomFloat(2, 1, 100),
        ];


        $response = $this->post(route('products.store'), $data);


        $response->assertRedirect(route('products.index'))->assertSessionHas('success', 'Product created successfully');


        $this->assertDatabaseHas('products', [
            'title' => $data['title'],
            'description' => $data['description'],
            'price' => $data['price'],
        ]);


        $this->assertDatabaseHas('user_products', [
            'product_id' => Product::where('title', $data['title'])->first()->id,
            'user_id' => $user->id,
        ]);


        $this->assertDatabaseHas('users', [
            'id' => $user->id,

        ]);



    }

    public function testEdit()
    {
        $product = Product::factory()->create();

        $response = $this->get(route('products.edit', $product->id));

        $response->assertStatus(200);
        $response->assertViewIs('products.edit');
    }

    public function testUpdate()
    {
        $user = User::factory()->create();
        $product = Product::factory()->create();

        $data = [
            'title' => $this->faker->word,
            'description' => $this->faker->sentence,
            'price' => $this->faker->randomFloat(2, 1, 100),
            'user_id' => [$user->id],
        ];

        $response = $this->put(route('products.update', $product->id), $data);

        $response->assertRedirect(route('products.index'));
        $this->assertDatabaseHas('products', $data);
        $this->assertDatabaseHas('user_products', [
            'user_id' => $user->id,
            'product_id' => $product->id,
        ]);
    }

    public function testDestroy()
    {
        $product = Product::factory()->create();

        $response = $this->delete(route('products.destroy', $product->id));

        $response->assertRedirect(route('products.index'));
        $this->assertDatabaseMissing('products', ['id' => $product->id]);
    }
}