<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\BlogNew;
use App\Models\Comment;
use App\Models\NewsComment;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Vinkla\Hashids\Facades\Hashids;
class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::factory()
            ->has(BlogNew::factory(10)->has(Comment::factory(6)))
        ->create([
            'email' => 'jorge@gmail.com.br',
            'password' => Hash::make(123),
        ]);
    }
}
