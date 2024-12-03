<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Post;

class PostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $post = Post::create([
            'title' => 'Gallery 1',
            'description' => 'Description Gallery 1',
            'picture' => '672acc211f6181730858017.jpeg'
        ]);
        $post = Post::create([
            'title' => 'Gallery 2',
            'description' => 'Description Gallery 2',
            'picture' => '672acc370eb4e1730858039.jpeg'
        ]);

        $post = Post::create([
            'title' => 'Gallery 3',
            'description' => 'Description Gallery 3',
            'picture' => '672ad27a5fe841730859642.jpeg'
        ]);
    }
}
