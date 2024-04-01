<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Like;
use App\Models\User;
use App\Models\Prompt;
use App\Models\Comment;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();



        Category::create([
            'id' => 1,
            'title' => 'Programming',  
            'slug' => 'programming',  
        ]);

        Category::create([
            'id' => 2,
            'title' => 'General',
            'slug' => 'general',
        ]);

        // User::create([
        //     'id' => 1,
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        //     'password'=> bcrypt('1'),
        // ]);

       
        // Prompt::create([
        //     'prompt'=>'from testt',
        //     'user_id'=>1,
        //     'category_id'=>1,
        // ]);

        // Comment::create([
        //     'user_id' => 1,
        //     'prompt_id' => 1,
        //     'comment' => 'This is a sample comment.',
        // ]);

        

    }
}
