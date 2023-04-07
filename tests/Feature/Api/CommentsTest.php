<?php

namespace Tests\Feature\Api;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Comment;
use App\Models\User;
use Laravel\Sanctum\Sanctum;

class CommentsTest extends TestCase
{
    use DatabaseMigrations;

    /**
     * Current endpoint url which being tested.
     *
     * @var string
     */
    protected $endpoint = '/api/comments/';

    /**
     * Faker generator instance.
     *
     * @var \Faker\Generator
     */
    protected $faker;

    /**
     * The model which being tested.
     *
     * @var News
     */
    protected $model;

    /**
     * Currently logged in User.
     *
     * @var User
     */
    protected $user;


    /**
     * Setup the test environment.
     *
     * return void
     */
    public function setUp(): void
    {
        parent::setUp();
        
        $this->user = User::factory()->create();
        Sanctum::actingAs($this->user,['*'],'api');

        $this->model = Comment::factory(
            [
                'users_id' => $this->user->getKey(),
            ]
        )->create();
    }

    /** @test */
    public function index_endpoint_works_as_expected()
    {
        $this->getJson($this->endpoint)
            ->assertStatus(200)
            ->assertJsonFragment([
                'users_id' =>(string)  $this->model->getAttribute('users_id'),
                'news_id' => (string) $this->model->getAttribute('news_id'),
                'title' => $this->model->getAttribute('title'),
            ]);
    }

    /** @test */
    public function show_endpoint_works_as_expected()
    {
        $this->getJson($this->endpoint.$this->model->getKey())
            ->assertStatus(200)
            ->assertJsonFragment([
                'users_id' => (string) $this->model->getAttribute('users_id'),
                'news_id' =>(string) $this->model->getAttribute('news_id'),
                "title" => $this->model->getAttribute('title'),
            ]);
    }


    /** @test */
    public function create_endpoint_works_as_expected()
    {
        // Submitted data
        $data = Comment::factory([
              'users_id' => $this->user->getKey(),
        ])->raw();

        // The data which should be shown
        $seenData = $data;

        $this->postJson($this->endpoint, $data)
            ->assertStatus(201)
            ->assertJsonFragment($seenData);
    }
}
