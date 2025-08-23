<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\Product;
use App\Models\Category;
use App\Models\RelatedProduct;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Livewire\Livewire;
use App\Livewire\FrequentlyBoughtTogether;

class FrequentlyBoughtTogetherTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    protected function setUp(): void
    {
        parent::setUp();
        
        // Create test data
        $this->createTestData();
    }

    private function createTestData()
    {
        // Create category
        $category = Category::create([
            'name' => 'Test Category',
            'slug' => 'test-category'
        ]);

        // Create main product
        $this->mainProduct = Product::create([
            'name' => 'Test Product',
            'slug' => 'test-product',
            'description' => 'Test Description',
            'base_price' => 100,
            'category_id' => $category->id,
            'is_available' => true
        ]);

        // Create related products
        $this->relatedProduct1 = Product::create([
            'name' => 'Related Product 1',
            'slug' => 'related-product-1',
            'description' => 'Related Description 1',
            'base_price' => 50,
            'category_id' => $category->id,
            'is_available' => true
        ]);

        $this->relatedProduct2 = Product::create([
            'name' => 'Related Product 2',
            'slug' => 'related-product-2',
            'description' => 'Related Description 2',
            'base_price' => 75,
            'category_id' => $category->id,
            'is_available' => true
        ]);

        // Create relationships
        RelatedProduct::create([
            'product_id' => $this->mainProduct->id,
            'related_product_id' => $this->relatedProduct1->id,
            'type' => 'frequently_bought_together'
        ]);

        RelatedProduct::create([
            'product_id' => $this->mainProduct->id,
            'related_product_id' => $this->relatedProduct2->id,
            'type' => 'frequently_bought_together'
        ]);
    }

    /** @test */
    public function it_can_display_frequently_bought_together_component()
    {
        $response = $this->get("/products/{$this->mainProduct->slug}");
        
        $response->assertStatus(200);
        $response->assertSeeLivewire('frequently-bought-together');
    }

    /** @test */
    public function it_loads_related_products_correctly()
    {
        Livewire::test(FrequentlyBoughtTogether::class, ['product' => $this->mainProduct])
            ->assertSet('relatedProducts.0.name', 'Related Product 1')
            ->assertSet('relatedProducts.1.name', 'Related Product 2')
            ->assertSet('relatedProducts.0.selected', true)
            ->assertSet('relatedProducts.1.selected', true);
    }

    /** @test */
    public function it_calculates_total_price_correctly()
    {
        Livewire::test(FrequentlyBoughtTogether::class, ['product' => $this->mainProduct])
            ->assertSet('mainProductPrice', 100)
            ->assertSet('totalPrice', 225); // 100 + 50 + 75
    }

    /** @test */
    public function it_can_toggle_product_selection()
    {
        Livewire::test(FrequentlyBoughtTogether::class, ['product' => $this->mainProduct])
            ->call('toggleProduct', 0)
            ->assertSet('relatedProducts.0.selected', false)
            ->assertSet('totalPrice', 175); // 100 + 75 (first product unselected)
    }

    /** @test */
    public function it_requires_authentication_to_add_to_cart()
    {
        Livewire::test(FrequentlyBoughtTogether::class, ['product' => $this->mainProduct])
            ->call('addAllToCart')
            ->assertDispatched('show-login-prompt');
    }

    /** @test */
    public function authenticated_user_can_add_products_to_cart()
    {
        $user = User::factory()->create();
        $this->actingAs($user);

        Livewire::test(FrequentlyBoughtTogether::class, ['product' => $this->mainProduct])
            ->call('addAllToCart')
            ->assertDispatched('cart-updated')
            ->assertDispatched('show-success');
    }

    /** @test */
    public function admin_can_create_product_with_related_products()
    {
        $admin = User::factory()->create(['role' => 'admin']);
        $this->actingAs($admin);

        $category = Category::first();
        
        $response = $this->post('/admin/products', [
            'name' => 'New Product',
            'description' => 'New Product Description',
            'category_id' => $category->id,
            'base_price' => 200,
            'is_available' => true,
            'related_products' => [$this->relatedProduct1->id, $this->relatedProduct2->id],
            'related_product_types' => ['frequently_bought_together', 'recommended']
        ]);

        $response->assertRedirect('/admin/products');
        
        $newProduct = Product::where('name', 'New Product')->first();
        $this->assertCount(2, $newProduct->relatedProducts);
    }

    /** @test */
    public function admin_can_update_product_related_products()
    {
        $admin = User::factory()->create(['role' => 'admin']);
        $this->actingAs($admin);

        $response = $this->put("/admin/products/{$this->mainProduct->id}", [
            'name' => $this->mainProduct->name,
            'description' => $this->mainProduct->description,
            'category_id' => $this->mainProduct->category_id,
            'base_price' => $this->mainProduct->base_price,
            'is_available' => true,
            'related_products' => [$this->relatedProduct1->id], // Only one product now
            'related_product_types' => ['frequently_bought_together']
        ]);

        $response->assertRedirect('/admin/products');
        
        $this->mainProduct->refresh();
        $this->assertCount(1, $this->mainProduct->relatedProducts);
    }

    /** @test */
    public function related_products_are_deleted_when_main_product_is_deleted()
    {
        $admin = User::factory()->create(['role' => 'admin']);
        $this->actingAs($admin);

        $relatedProductsCount = RelatedProduct::where('product_id', $this->mainProduct->id)->count();
        $this->assertGreaterThan(0, $relatedProductsCount);

        $response = $this->delete("/admin/products/{$this->mainProduct->id}");
        
        $response->assertRedirect('/admin/products');
        $this->assertDatabaseMissing('products', ['id' => $this->mainProduct->id]);
        $this->assertCount(0, RelatedProduct::where('product_id', $this->mainProduct->id)->get());
    }
}
