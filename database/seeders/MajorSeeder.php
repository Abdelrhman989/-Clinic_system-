<?php

namespace Database\Seeders;

use App\Models\Major;
use Illuminate\Database\Seeder;

class MajorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $majors = [
            ['name' => 'أمراض القلب', 'image' => 'https://images.unsplash.com/photo-1628348068343-c6a848d2b6dd?w=400&h=400&fit=crop'],
            ['name' => 'الأمراض الجلدية', 'image' => 'https://images.unsplash.com/photo-1612349317150-e413f6a5b16d?w=400&h=400&fit=crop'],
            ['name' => 'أمراض الأعصاب', 'image' => 'https://images.unsplash.com/photo-1559757175-5700dde675bc?w=400&h=400&fit=crop'],
            ['name' => 'طب الأطفال', 'image' => 'https://images.unsplash.com/photo-1581594693702-fbdc51b2763b?w=400&h=400&fit=crop'],
            ['name' => 'جراحة العظام', 'image' => 'https://images.unsplash.com/photo-1530497610245-94d3c16cda28?w=400&h=400&fit=crop'],
            ['name' => 'طب العيون', 'image' => 'https://images.unsplash.com/photo-1554244933-d876deb6b2ff?w=400&h=400&fit=crop'],
            ['name' => 'الطب النفسي', 'image' => 'https://images.unsplash.com/photo-1527613426441-4da17471b66d?w=400&h=400&fit=crop'],
            ['name' => 'الجراحة العامة', 'image' => 'https://images.unsplash.com/photo-1551601651-2a8555f1a136?w=400&h=400&fit=crop'],
            ['name' => 'الباطنة', 'image' => 'https://images.unsplash.com/photo-1631217868264-e5b90bb7e133?w=400&h=400&fit=crop'],
            ['name' => 'النساء والتوليد', 'image' => 'https://images.unsplash.com/photo-1584515933487-779824d29309?w=400&h=400&fit=crop'],
        ];

        foreach ($majors as $major) {
            Major::create($major);
        }
    }
}
