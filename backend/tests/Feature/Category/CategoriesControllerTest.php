<?php

namespace Tests\Feature\Category;

use App\Models\Categories;
use Illuminate\Http\UploadedFile;
use Illuminate\View;
use Tests\AbstractTestCase;

class CategoriesControllerTest extends AbstractTestCase
{
    public function testIndex()
    {
        $response = $this->get('/categories');
        $response->assertStatus(200);
        $response->assertViewIs('admin.categories.list');

        $categories = factory(Categories::class)->make();

        $categories = Categories::paginate(15);

        $this->assertEquals(
            view(
                'admin.categories.list',
                compact('categories')
            )->render(),
            $response->getContent()
        );
    }

    public function testCreate()
    {
        $response = $this->get('/categories/create');
        $response->assertStatus(200);
        $response->assertViewIs('admin.categories.create');
        $this->assertEquals(
            view('admin.categories.create')->render(),
            $response->getContent()
        );

        $response = $this->get('/categories/create');
        $response->assertStatus(200);
    }

    public function testStore()
    {
        $faker = \Faker\Factory::create();

        $file = UploadedFile::fake()
            ->image(
                $faker->title . '.jpg'
            );

        $response = $this->post(
            '/categories',
            [
                'name' => $faker->title,
                'icon_image' => $file,
            ]
        );

        $response->assertStatus(302);
    }
}
