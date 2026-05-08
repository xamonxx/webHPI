<?php

namespace Tests\Feature;

use App\Models\Portfolio;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class AdminPortfolioUploadTest extends TestCase
{
    use RefreshDatabase;

    private User $admin;

    protected function setUp(): void
    {
        parent::setUp();

        Storage::fake('public');

        $this->admin = User::factory()->create([
            'role' => 'admin',
            'is_active' => true,
        ]);
    }

    public function test_admin_can_create_portfolio_with_five_valid_photos(): void
    {
        $photos = collect(range(1, 5))
            ->map(fn ($i) => UploadedFile::fake()->image("portfolio-{$i}.jpg")->size(512))
            ->all();

        $this->actingAs($this->admin)
            ->post(route('admin.portfolio.store'), [
                'title' => 'Valid Portfolio',
                'category' => 'Interior Design',
                'description' => 'Portfolio dengan lima foto valid.',
                'is_active' => '1',
                'photos' => $photos,
            ])
            ->assertRedirect(route('admin.portfolio.index'))
            ->assertSessionHasNoErrors();

        $portfolio = Portfolio::with('photos')->where('title', 'Valid Portfolio')->firstOrFail();

        $this->assertCount(5, $portfolio->photos);
        $this->assertNotNull($portfolio->image);
        $portfolio->photos->each(fn ($photo) => Storage::disk('public')->assertExists($photo->path));
    }

    public function test_admin_cannot_create_portfolio_with_more_than_five_photos(): void
    {
        $photos = collect(range(1, 6))
            ->map(fn ($i) => UploadedFile::fake()->image("portfolio-{$i}.jpg")->size(512))
            ->all();

        $this->actingAs($this->admin)
            ->from(route('admin.portfolio.create'))
            ->post(route('admin.portfolio.store'), [
                'title' => 'Too Many Photos',
                'photos' => $photos,
            ])
            ->assertRedirect(route('admin.portfolio.create'))
            ->assertSessionHasErrors(['photos']);

        $this->assertDatabaseMissing('portfolios', ['title' => 'Too Many Photos']);
    }

    public function test_admin_cannot_create_portfolio_when_one_photo_exceeds_ten_mb(): void
    {
        $this->actingAs($this->admin)
            ->from(route('admin.portfolio.create'))
            ->post(route('admin.portfolio.store'), [
                'title' => 'Oversized Photo',
                'photos' => [
                    UploadedFile::fake()->image('valid.jpg')->size(512),
                    UploadedFile::fake()->image('too-big.jpg')->size(10241),
                ],
            ])
            ->assertRedirect(route('admin.portfolio.create'))
            ->assertSessionHasErrors(['photos']);

        $this->assertDatabaseMissing('portfolios', ['title' => 'Oversized Photo']);
    }

    public function test_admin_cannot_create_portfolio_with_pdf_file(): void
    {
        $this->actingAs($this->admin)
            ->from(route('admin.portfolio.create'))
            ->post(route('admin.portfolio.store'), [
                'title' => 'Invalid File',
                'photos' => [
                    UploadedFile::fake()->create('brief.pdf', 128, 'application/pdf'),
                ],
            ])
            ->assertRedirect(route('admin.portfolio.create'))
            ->assertSessionHasErrors(['photos.0']);

        $this->assertDatabaseMissing('portfolios', ['title' => 'Invalid File']);
    }
}
