<?php

namespace Database\Seeders;

use App\Models\Post;
use App\Models\User;
use App\Models\Timeline;
use Illuminate\Database\Seeder;

class PostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::factory()->count(10)->create()->each(function ($user) {
            $user->timeline()->save(Timeline::factory()->hasPosts(500,['user_id'=>$user->id])->create());
        });
    }
}
