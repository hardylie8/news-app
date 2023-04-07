<?php

namespace Tests\Feature\Api;

use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\News;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class NewsTest extends TestCase
{
    use DatabaseMigrations;

    /**
     * Current endpoint url which being tested.
     *
     * @var string
     */
    protected $endpoint = '/api/news/';

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
     * Setup the test environment.
     *
     * return void
     */
    public function setUp(): void
    {
        parent::setUp();

        $this->model = News::factory()->create();
    }

    /** @test */
    public function index_endpoint_works_as_expected()
    {
        $this->getJson($this->endpoint)
            ->assertStatus(200)
            ->assertJsonFragment([
                'title' => $this->model->getAttribute('title'),
                'news' => $this->model->getAttribute('news'),
                'published_at' => $this->model->getAttribute('published_at'),
            ]);
    }

    /** @test */
    public function show_endpoint_works_as_expected()
    {
        $this->getJson($this->endpoint.$this->model->getKey())
            ->assertStatus(200)
            ->assertJsonFragment([
                'title' => $this->model->getAttribute('title'),
                'news' => $this->model->getAttribute('news'),
                'published_at' => $this->model->getAttribute('published_at'),
            ]);
    }
}
