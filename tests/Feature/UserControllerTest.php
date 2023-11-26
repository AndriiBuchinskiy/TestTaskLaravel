<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\UploadedFile;
use Tests\TestCase;
use App\Models\User;
use App\Models\Product;

class UserControllerTest extends TestCase
{
    use RefreshDatabase;
    use WithFaker;

    public function testIndex()
    {
        $response = $this->get(route('users.index'));

        $response->assertStatus(200);
        $response->assertViewIs('users.index');
    }

    public function testShow()
    {
        $user = User::factory()->create();

        $response = $this->get(route('users.show', $user->id));

        $response->assertStatus(200);
        $response->assertViewIs('users.show');
    }

    public function testEdit()
    {
        $user = User::factory()->create();

        $response = $this->get(route('users.edit', $user->id));

        $response->assertStatus(200);
        $response->assertViewIs('users.edit');
    }

    public function testUpdate()
    {
        $user = User::factory()->create();
        $product = Product::factory()->create();

        $data = [
            'first_name' => $this->faker->firstName,
            'last_name' => $this->faker->lastName,
            'product_id' => [$product->id],
        ];

        $response = $this->put(route('users.update', $user->id), $data);

        $response->assertRedirect(route('users.index'));
        $this->assertDatabaseHas('users', [
            'id' => $user->id,
            'first_name' => $data['first_name'],
            'last_name' => $data['last_name'],
        ]);

        $this->assertDatabaseHas('user_products', [
            'user_id' => $user->id,
            'product_id' => $product->id,
        ]);
    }

    public function testCreate()
    {
        $response = $this->get(route('users.create'));

        $response->assertStatus(200);
        $response->assertViewIs('users.create');
    }

    public function testStore()
    {
        $product = Product::factory()->create();
        $fakeImage = UploadedFile::fake()->image('avatar_file_name.jpg');
        $data = [
            'first_name' => $this->faker->firstName,
            'last_name' => $this->faker->lastName,
            'avatar' => $fakeImage,
            'product_id' => [$product->id],
        ];

        $response = $this->post(route('users.store'), $data);

        $response->assertRedirect(route('users.index'));
        $this->assertDatabaseHas('users', [
            'first_name' => $data['first_name'],
            'last_name' => $data['last_name'],
            'avatar' => 'avatar_file_name.jpg',
        ]);

        $user = User::where('first_name', $data['first_name'])->first();
        $this->assertDatabaseHas('user_products', [
            'user_id' => $user->id,
            'product_id' => $product->id,
        ]);
    }

    public function testDestroy()
    {
        $user = User::factory()->create();

        $response = $this->delete(route('users.destroy', $user->id));

        $response->assertRedirect(route('users.index'));
        $this->assertDatabaseMissing('users', ['id' => $user->id]);
    }
}