<?php
namespace Database\Seeders;
use Illuminate\Database\Seeder;
use App\Models\Category;

class CategorySeeder extends Seeder {
    public function run()
    {
        Category::truncate();

        Category::create([
            'category_name' => 'A1',
        ]);
        Category::create([
            'category_name' => 'A',
        ]);
        Category::create([
            'category_name' => 'B',
        ]);
        Category::create([
            'category_name' => 'C',
        ]);
        Category::create([
            'category_name' => 'D',
        ]);
        Category::create([
            'category_name' => 'BE',
        ]);
        Category::create([
            'category_name' => 'CE',
        ]);
        Category::create([
            'category_name' => 'DE',
        ]);
    }
}
