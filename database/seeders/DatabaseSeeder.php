<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Like;
use App\Models\User;
use App\Models\Prompt;
use App\Models\Comment;
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
            'judul' => 'Programming',  
            'slug' => 'programming',  
        ]);

        Category::create([
            'judul' => 'General',
            'slug' => 'general',
        ]);

        User::create([
            'name' => 'Test User',
            'email' => 'test@example.com',
            'password'=> bcrypt('1'),
        ]);

        // User::create([
        //     'name' => 'Test User2',
        //     'email' => 'test2@example.com',
        //     'password'=> bcrypt('1'),
        // ]);

        Prompt::create([
            'prompt' => 'Create a landing page for a new e-commerce platform specializing in sustainable fashion. The landing page should convey the brand s commitment to sustainability, showcase a selection of eco-friendly clothing items, and encourage visitors to sign up for early access to exclusive discounts and updates. Consider incorporating elements like vibrant imagery, concise yet compelling copy, and clear calls-to-action. Ensure the page is responsive and optimized for both desktop and mobile devices.',
            'judul' => 'How to make a ecommerce landing page',
            'user_id' => 1,
            'kategori_id' => 1,
        ]);

        // Prompt::create([
        //     'prompt' => 'Design a landing page for a cutting-edge IoT home security system. This system includes features such as smart cameras with motion detection, door/window sensors, and a mobile app for remote monitoring and control. The landing page should highlight the system s key benefits, such as 24/7 surveillance, instant alerts, and easy installation. Consider incorporating visuals demonstrating the system in action, customer testimonials for credibility, and a clear call-to-action for users to learn more or purchase the product. Emphasize the peace of mind and convenience that the security system brings to homeowners, while ensuring the page is user-friendly and accessible on various devices',
        //     'judul' => 'Smart IoT Security',
        //     'user_id' => 1,
        //     'kategori_id' => 1,
        // ]);

        // Comment::create([
        //     'user_id' => 1,
        //     'prompt_id' => 1,
        //     'komentar' => 'This is a sample comment.',
        // ]);
    }
}
