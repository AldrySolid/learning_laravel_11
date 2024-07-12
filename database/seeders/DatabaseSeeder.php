<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $this->call([
           ProfileSeeder::class,
           TagSeeder::class,
           RoleSeeder::class,
           CategorySeeder::class,
           PostSeeder::class,
           ArticleSeeder::class,
           CommentSeeder::class,
           PostTagSeeder::class,
        ]);
    }
}
