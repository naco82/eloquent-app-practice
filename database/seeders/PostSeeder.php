<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Post;
use App\Models\User;

class PostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user = User::first(); // 既存のユーザーを取得（最初のユーザーを使用）
        Post::create([
            'user_id' => $user->id,
            'title' => '初めての投稿',
            'content' => 'これはテスト投稿です。',
            'published_at' => now(),
        ]);


        Post::create([
            'user_id' => $user->id,
            'title' => '２つ目の投稿',
            'content' => 'Eloquentで作成しました。',
            'published_at' => now(),
        ]);
    }
}
