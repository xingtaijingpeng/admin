<?php

use Illuminate\Database\Seeder;
use \App\Models\User;
class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {

//        factory(App\User::class, 50)->create()->each(function($u) {
//            $u->posts()->save(factory(App\Post::class)->make());
//        });
//         $this->call(UsersTableSeeder::class);

        DB::table('users')->insert([
            'mobile' => '18310319013',
            'name' => 'Manager',
            'email' => '89340545@qq.com',
            'password' => bcrypt('123456'),
            'type' => User::ADMIN_TYPE + User::TENANT_TYPE + User::MEMBER_TYPE,
            'created_at' => date('Y-m-d H:i:s'),
        ]);
    }
}
