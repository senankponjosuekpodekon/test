<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Post;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
// use Database\Seeders\User;
use App\Models\User;

class PostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        $categories = Category::all();
        $users = User::all();

        Post::factory(20)
        
            ->sequence(fn() => [
                'category_id' => $categories->random(),
            ])

            ->hasComments(5, fn () => ['user_id' => $users->random()])
        
            ->create();
            // ->each(fn ($post) => $post->tags()->attach($tags->random(rand(0, 3))))
    }
}
