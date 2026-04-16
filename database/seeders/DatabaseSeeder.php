<?php

namespace Database\Seeders;

use Illuminate\Support\Facades\DB;
use App\Models\Post;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0');
        DB::table('comments')->truncate();
        DB::table('posts')->truncate();
        DB::table('users')->truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1');

        for ($i = 1; $i <= 100; $i++) {
            $user = User::factory()->create([
                'name' => 'user' . $i,
                'email' => 'user' . $i . '@example.com',
            ]);

            Post::factory()->create([
                'title' => 'Post ' . $i,
                'user_id' => $user->id,
            ]);
        }
    }
}
