<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Type;
use App\Functions\Helper;

class TypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            "Sviluppo Frontend",
            "Sviluppo Backend",
            "App Mobile",
            "Sviluppo Full Stack",
            "Integrazione API",
            "Sviluppo eCommerce",
            "Sviluppo DevOps",
            "Manutenzione Software",
            "Sviluppo Web",
        ];

        foreach ($data as $types) {
            $new_type = new Type();
            $new_type->name = $types;
            $new_type->slug = Helper::generateSlug($new_type->name, Type::class);
            $new_type->save();
        }
    }
}
