<?php

namespace Tests\Feature;

use App\Models\Owner;
use Tests\TestCase;
use App\Models\Repo;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class RepoTest extends TestCase
{
    use RefreshDatabase,
        WithFaker;

    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function get_main_page()
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }

    /** @test */
    public function create_repo()
    {
        $this->assertEquals(0, Repo::count());

        $repoData = [
            'id' => $this->faker->numberBetween(500, 10000),
            'name' => $this->faker->firstName,
            'link' => $this->faker->url,
            'updated_at' => $this->faker->dateTime,
        ];

        Repo::create($repoData);

        $this->assertEquals(1, Repo::count());

        $repo = Repo::first();
        $this->assertEquals($repoData['id'], $repo->id);
        $this->assertEquals($repoData['name'], $repo->name);
        $this->assertEquals($repoData['link'], $repo->link);
    }

    /** @test */
    public function create_owner()
    {
        $this->assertEquals(0, Owner::count());

        $ownerData = [
            'id' => $this->faker->numberBetween(500, 10000),
            'name' => $this->faker->firstName,
            'avatar' => $this->faker->url,
        ];

        Owner::create($ownerData);

        $this->assertEquals(1, Owner::count());

        $owner = Owner::first();
        $this->assertEquals($ownerData['id'], $owner->id);
        $this->assertEquals($ownerData['name'], $owner->name);
        $this->assertEquals($ownerData['avatar'], $owner->avatar);
    }
}
