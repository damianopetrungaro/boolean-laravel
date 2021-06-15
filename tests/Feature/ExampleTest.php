<?php

namespace Tests\Feature;

use App\Restaurant;
use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ExampleTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @test
     * @return void
     */
    public function customer_can_see_available_restaurants()
    {
        $restaurants = factory(Restaurant::class, 10)->create();
        $this
            ->get('/api/deliveroo')
            ->assertOk()
            ->assertJson($restaurants->toArray());
    }

    /**
     * @test
     * @return void
     */
    public function user_adds_a_new_restaurant()
    {
        $user = factory(User::class)->create();
        $restaurant = factory(Restaurant::class)->make();
        $data = $restaurant->toArray();
        unset($data['path_img']);
        unset($data['user_id']);
        unset($data['slug']);

        $this
            ->actingAs($user)
            ->post('/admin/restaurants', $data)
            ->assertRedirect();

        $data['user_id'] = $user->id;
        unset($data['id']);
        $this->assertDatabaseHas('restaurants', $data);
    }

    /**
     * @test
     * @return void
     */
    public function user_can_see_restaurant()
    {
        $restaurant = factory(Restaurant::class)->create();
        $this
            ->get("/restaurants/{$restaurant->slug}")
            ->assertOk()
            ->assertSee($restaurant->name)
            ->assertSee($restaurant->email)
            ->assertSee($restaurant->phoneNumber)
            ->assertSee($restaurant->description);
    }
}
