<?php

namespace Database\Seeders;

use App\Models\Post;
use App\Models\Tag;
use Illuminate\Database\Seeder;

class PostTagSeeder extends Seeder
{
    public function run(): void
    {
        $posts = Post::all();
        $tags  = Tag::all();
        foreach ($posts as $post) {
            $countTags = random_int(1, 5);
            /** @var Post $post */
            $post->tags()->attach(
                $tags->random($countTags)
                     ->pluck('id')
            );
        }
    }
}
