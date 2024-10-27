<?php

namespace Database\Seeders;

use App\Enum\CategoryTypeEnum;
use App\Models\CategoryType;
use Illuminate\Database\Seeder;

class CategoryTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $types = CategoryTypeEnum::all();

        foreach ($types as $type) {
            CategoryType::create($type);
        }
    }
}
