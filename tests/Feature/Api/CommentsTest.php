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

    /** @test */
    public function update_endpoint_works_as_expected()
    {
        // Submitted data
        $data = Comment::factory([
            "news_id" => $this->model->news_id,
            "users_id"=> $this->model->users_id,
        ])->raw();
        // The data which should be shown
        $seenData = $data;
        $this->patchJson($this->endpoint.$this->model->getKey(), $data)
            ->assertStatus(200)
            ->assertJsonFragment($seenData);
    }

    /** @test */
    public function delete_endpoint_works_as_expected()
    {
        $this->deleteJson($this->endpoint.$this->model->getKey())
            ->assertStatus(200)
            ->assertJsonFragment([
                'message' => 'Success',
            ]);

        $this->assertDatabaseHas('comments', [
            "news_id" => (string)$this->model->news_id,
            "users_id"=>(string) $this->model->users_id,
            "title"=> $this->model->title,
        ]);

        $this->assertDatabaseMissing('comments', [
            "news_id" =>(string) $this->model->news_id,
            "users_id"=> (string)$this->model->users_id,
            "title"=> $this->model->title,
            'deleted_at' => null,
        ]);
    }
}
