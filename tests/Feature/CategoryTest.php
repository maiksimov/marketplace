<?php

namespace Tests\Feature;

use App\Entities\Category;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\Response;
use Tests\TestCase;

class CategoryTest extends TestCase
{
    use RefreshDatabase;
    const NEW_TITLE = 'New Category Title';
    const NOT_UNIQUE_TITLE = 'Not Unique Category Title';
    const EMPTY_TITLE = '';
    const NOT_EXISTED_ID = 1;

    protected function setUp(): void
    {
        parent::setUp();
        $this->refreshDatabase();
    }

    /** @test */
    public function categories_page_has_exists()
    {
        factory(Category::class, 10)->create();
        $response = $this->json('GET','/api/categories');
        $response->assertStatus(Response::HTTP_OK);
        $response->assertJsonCount(10, 'categories');
    }

    /** @test */
    public function category_page_has_exists()
    {
        $category = factory(Category::class)->create();
        $response = $this->json('GET',"/api/categories/{$category->id}");
        $response->assertStatus(Response::HTTP_OK);
        $response->assertJsonFragment(['title' => $category->title]);
    }

    /** @test */
    public function a_category_can_be_added()
    {
        $response = $this->post('/api/categories', [
            'title' => self::NEW_TITLE
        ]);
        $response->assertJsonFragment(['title' => self::NEW_TITLE]);
        $response->assertStatus(Response::HTTP_CREATED);
        $this->assertCount(1, Category::all());
    }

    /** @test */
    public function a_category_can_be_updated()
    {
        $category = factory(Category::class)->create();
        $response = $this->patch("/api/categories/{$category->id}", [
            'title' => self::NEW_TITLE
        ]);
        $response->assertStatus(Response::HTTP_OK);
        $response->assertJsonFragment(['title' => self::NEW_TITLE]);
    }

    /** @test */
    public function a_category_can_be_deleted()
    {
        $category = factory(Category::class)->create();
        $response = $this->delete("/api/categories/{$category->id}");
        $response->assertStatus(Response::HTTP_OK);
        $response->assertJsonFragment(['deleted' => true]);
    }

    /** @test */
    public function a_category_cannot_be_added_with_empty_title()
    {
        $response = $this->post('/api/categories', [
            'title' => self::EMPTY_TITLE
        ]);
        $response->assertJsonCount(1, 'errors');
        $response->assertStatus(Response::HTTP_UNPROCESSABLE_ENTITY);
    }

    /** @test */
    public function a_category_cannot_be_added_with_not_unique_title()
    {
        factory(Category::class)->create(['title' => self::NOT_UNIQUE_TITLE]);
        $response = $this->post('/api/categories', [
            'title' => self::NOT_UNIQUE_TITLE
        ]);
        $response->assertJsonCount(1, 'errors');
        $response->assertStatus(Response::HTTP_UNPROCESSABLE_ENTITY);
    }

    /** @test */
    public function a_category_cannot_be_deleted_if_it_not_exists()
    {
        $response = $this->delete('/api/categories/' . self::NOT_EXISTED_ID);
        $response->assertJsonCount(1, 'errors');
        $response->assertStatus(Response::HTTP_NOT_FOUND);
    }

    /** @test */
    public function a_category_cannot_be_updated_if_it_not_exists()
    {
        $response = $this->patch('/api/categories/' . self::NOT_EXISTED_ID, [
            'title' => self::NEW_TITLE
        ]);
        $response->assertJsonCount(1, 'errors');
        $response->assertStatus(Response::HTTP_NOT_FOUND);
    }
}
