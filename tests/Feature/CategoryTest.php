<?php

namespace Tests\Feature;

use App\Entities\Category;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\Response;
use Tests\TestCase;

class CategoryTest extends TestCase
{
    use RefreshDatabase;

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
        $title = 'New Category Title';
        $response = $this->post('/api/categories', [
            'title' => $title
        ]);
        $response->assertJsonFragment(['title' => $title]);
        $response->assertStatus(Response::HTTP_CREATED);
        $this->assertCount(1, Category::all());
    }

    /** @test */
    public function a_category_can_be_updated()
    {
        $category = factory(Category::class)->create();
        $newTitle = 'New Category Title';
        $response = $this->patch("/api/categories/{$category->id}", [
            'title' => $newTitle
        ]);
        $response->assertStatus(Response::HTTP_OK);
        $response->assertJsonFragment(['title' => $newTitle]);
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
        $title = '';
        $response = $this->post('/api/categories', [
            'title' => $title
        ]);
        $response->assertJsonCount(1, 'errors');
        $response->assertStatus(Response::HTTP_UNPROCESSABLE_ENTITY);
    }

    /** @test */
    public function a_category_cannot_be_added_with_not_unique_title()
    {
        $title = 'Not Unique Category Title';
        factory(Category::class)->create(['title' => $title]);
        $response = $this->post('/api/categories', [
            'title' => $title
        ]);
        $response->assertJsonCount(1, 'errors');
        $response->assertStatus(Response::HTTP_UNPROCESSABLE_ENTITY);
    }

    /** @test */
    public function a_category_cannot_be_deleted_if_it_not_exists()
    {
        $notExistedId = 1;
        $response = $this->delete("/api/categories/{$notExistedId}");
        $response->assertJsonCount(1, 'errors');
        $response->assertStatus(Response::HTTP_NOT_FOUND);
    }

    /** @test */
    public function a_category_cannot_be_updated_if_it_not_exists()
    {
        $notExistedId = 1;
        $newTitle = 'New Category Title';
        $response = $this->patch("/api/categories/{$notExistedId}", [
            'title' => $newTitle
        ]);
        $response->assertJsonCount(1, 'errors');
        $response->assertStatus(Response::HTTP_NOT_FOUND);
    }
}
