<?php

namespace Database\Seeders;

use App\Models\Profile;
use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $this->createAdmin();

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

    protected function createAdmin() {
        $adminUser = User::create(
            [
                'name'     => 'admin',
                'email'    => 'admin@example.com',
                'password' => Hash::make('123'),
            ]
        );

        Profile::create(
            [
                'first_name'  => 'admin_first_name',
                'second_name' => 'admin_second_name',
                'third_name'  => 'admin_third_name',
                'status'      => Profile::STATUS_ACTIVE,
                'user_id'     => $adminUser->id,
            ]
        );

        $adminRole = Role::create(['title' => 'Admin']);

        /** @var User $adminUser */
        $adminUser->roles()->sync($adminRole->id);
    }
}
