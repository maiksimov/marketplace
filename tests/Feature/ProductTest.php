<?php

namespace Tests\Feature;

use App\Entities\Category;
use App\Entities\Product;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\Response;
use Tests\TestCase;

class ProductTest extends TestCase
{
    use RefreshDatabase;
    const TITLE = 'New Product Title';
    const DESCRIPTION = 'New Product Description';
    const PRICE = 66.6;
    const IN_STOCK = 1;
    const EMPTY_STRING = '';
    const NOT_EXISTED_ID = 1;

    protected function setUp(): void
    {
        parent::setUp();
        $this->refreshDatabase();
    }

    /** @test */
    public function products_page_has_exists()
    {
        factory(Category::class, 2)->create()->each(function($category){
            factory(Product::class, 10)->create(['category_id' => $category->id]);
        });

        $response = $this->json('GET','/api/products');
        $response->assertStatus(Response::HTTP_OK);
        $response->assertJsonCount(20, 'products');
    }

    /** @test */
    public function product_page_has_exists()
    {
        factory(Category::class)->create()->each(function($category){
            factory(Product::class)->create(['category_id' => $category->id]);
        });
        $product = Product::first();
        $response = $this->json('GET',"/api/products/{$product->id}");
        $response->assertStatus(Response::HTTP_OK);
        $response->assertJsonFragment(['title' => $product->title]);
    }

    /** @test */
    public function a_product_can_be_added()
    {
        $category = factory(Category::class)->create();
        $productData = [
            'title' => self::TITLE,
            'description' => self::DESCRIPTION,
            'price' => self::PRICE,
            'in_stock' => self::IN_STOCK,
            'category_id' => $category->id
        ];
        $response = $this->post('/api/products', $productData);
        $response->assertJsonFragment(['title' => $productData['title']]);
        $response->assertStatus(Response::HTTP_CREATED);
        $this->assertCount(1, Product::all());
    }

    /** @test */
    public function a_product_can_be_updated()
    {
        $this->withExceptionHandling();
        $category = factory(Category::class)->create();
        $productData = [
            'title' => self::TITLE,
            'description' => self::DESCRIPTION,
            'price' => self::PRICE,
            'in_stock' => self::IN_STOCK,
        ];
        $product = factory(Product::class)->create(['category_id' => $category->id]);
        $response = $this->patch("/api/products/{$product->id}", $productData);
        $response->assertStatus(Response::HTTP_OK);
        $response->assertJsonFragment($productData);
    }

    /** @test */
    public function a_product_can_be_deleted()
    {
        $category = factory(Category::class)->create();
        $product = factory(Product::class)->create(['category_id' => $category->id]);
        $response = $this->delete("/api/products/{$product->id}");
        $response->assertStatus(Response::HTTP_OK);
        $response->assertJsonFragment(['deleted' => true]);
    }

    /** @test */
    public function a_product_cannot_be_added_with_empty_title()
    {
        $category = factory(Category::class)->create();
        $productData = [
            'title' => self::EMPTY_STRING,
            'description' => self::DESCRIPTION,
            'price' => self::PRICE,
            'in_stock' => self::IN_STOCK,
            'category_id' => $category->id
        ];
        $response = $this->post('/api/products', $productData);
        $response->assertJsonCount(1, 'errors');
        $response->assertStatus(Response::HTTP_UNPROCESSABLE_ENTITY);
    }

    /** @test */
    public function a_product_cannot_be_added_with_empty_price()
    {
        $category = factory(Category::class)->create();
        $productData = [
            'title' => self::TITLE,
            'description' => self::DESCRIPTION,
            'price' => self::EMPTY_STRING,
            'in_stock' => self::IN_STOCK,
            'category_id' => $category->id
        ];
        $response = $this->post('/api/products', $productData);
        $response->assertJsonCount(1, 'errors');
        $response->assertStatus(Response::HTTP_UNPROCESSABLE_ENTITY);
    }

    /** @test */
    public function a_product_cannot_be_added_with_empty_in_stock()
    {
        $category = factory(Category::class)->create();
        $productData = [
            'title' => self::TITLE,
            'description' => self::DESCRIPTION,
            'price' => self::PRICE,
            'in_stock' => self::EMPTY_STRING,
            'category_id' => $category->id
        ];
        $response = $this->post('/api/products', $productData);
        $response->assertJsonCount(1, 'errors');
        $response->assertStatus(Response::HTTP_UNPROCESSABLE_ENTITY);
    }

    /** @test */
    public function a_product_cannot_be_added_with_wrong_category_id()
    {
        $productData = [
            'title' => self::TITLE,
            'description' => self::DESCRIPTION,
            'price' => self::PRICE,
            'in_stock' => self::IN_STOCK,
            'category_id' => 1
        ];
        $response = $this->post('/api/products', $productData);
        $response->assertJsonCount(1, 'errors');
        $response->assertStatus(Response::HTTP_UNPROCESSABLE_ENTITY);
    }

    /** @test */
    public function a_product_cannot_be_updated_with_wrong_title()
    {
        $category = factory(Category::class)->create();
        $product = factory(Product::class)->create(['category_id' => $category->id]);
        $productData = [
            'title' => null,
        ];
        $response = $this->patch("/api/products/{$product->id}", $productData);
        $response->assertJsonCount(1, 'errors');
        $response->assertStatus(Response::HTTP_UNPROCESSABLE_ENTITY);
    }

    /** @test */
    public function a_product_cannot_be_updated_with_wrong_description()
    {
        $category = factory(Category::class)->create();
        $product = factory(Product::class)->create(['category_id' => $category->id]);
        $productData = [
            'description' => null,
        ];
        $response = $this->patch("/api/products/{$product->id}", $productData);
        $response->assertJsonCount(1, 'errors');
        $response->assertStatus(Response::HTTP_UNPROCESSABLE_ENTITY);
    }

    /** @test */
    public function a_product_cannot_be_updated_with_wrong_price()
    {
        $category = factory(Category::class)->create();
        $product = factory(Product::class)->create(['category_id' => $category->id]);
        $productData = [
            'price' => null
        ];
        $response = $this->patch("/api/products/{$product->id}", $productData);
        $response->assertJsonCount(1, 'errors');
        $response->assertStatus(Response::HTTP_UNPROCESSABLE_ENTITY);
    }

    /** @test */
    public function a_product_cannot_be_updated_with_wrong_in_stock()
    {
        $category = factory(Category::class)->create();
        $product = factory(Product::class)->create(['category_id' => $category->id]);
        $productData = [
            'in_stock' => null
        ];
        $response = $this->patch("/api/products/{$product->id}", $productData);
        $response->assertJsonCount(1, 'errors');
        $response->assertStatus(Response::HTTP_UNPROCESSABLE_ENTITY);
    }

    /** @test */
    public function a_product_cannot_be_updated_with_wrong_category()
    {
        $category = factory(Category::class)->create();
        $product = factory(Product::class)->create(['category_id' => $category->id]);
        $productData = [
            'category_id' => null
        ];
        $response = $this->patch("/api/products/{$product->id}", $productData);
        $response->assertJsonCount(1, 'errors');
        $response->assertStatus(Response::HTTP_UNPROCESSABLE_ENTITY);
    }

    /** @test */
    public function a_category_cannot_be_deleted_if_it_not_exists()
    {
        $response = $this->delete('/api/products/' .self::NOT_EXISTED_ID);
        $response->assertJsonCount(1, 'errors');
        $response->assertStatus(Response::HTTP_NOT_FOUND);
    }

    /** @test */
    public function a_category_cannot_be_updated_if_it_not_exists()
    {
        $response = $this->patch('/api/products/' . self::NOT_EXISTED_ID);
        $response->assertJsonCount(1, 'errors');
        $response->assertStatus(Response::HTTP_NOT_FOUND);
    }
}
