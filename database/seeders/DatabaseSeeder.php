<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Book;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        Book::factory(20)->create([
            'book_type' => 0,
            'tags' => 'Fantasy',
            'remaining_books' => 12,
        ]);
        Book::factory(20)->create([
            'book_type' => 0,
            'tags' => 'Horor',
            'remaining_books' => 12,
        ]);
        Book::factory(20)->create([
            'book_type' => 1,
            'tags' => 'Matematika',
            'remaining_books' => 12,
        ]);
        Book::factory(20)->create([
            'book_type' => 1,
            'tags' => 'Bahasa Indonesia',
            'remaining_books' => 12,
        ]);

        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
    }
}