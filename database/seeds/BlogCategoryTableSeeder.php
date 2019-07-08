<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class BlogCategoryTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $categories = [];
        $cname = 'Без категории';
        $categories[] = [
            'title' => $cname,
            'slug' => Str::slug($cname),
            'parent_id' => 0,
        ];
        
        for ($i=0;  $i <=10; $i++){
            $cname = 'Категория #'.$i;
            $parent_id = ($i>4)?rand(1,4):1;
            $categories[] = [
                'title' => $cname,
                'slug' => Str::slug($cname),
                'parent_id' => $parent_id,
            ];
        }
        Db::table('blog_categories')->insert($categories);
    }
}
