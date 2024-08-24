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

    protected function createAdmin()
    {
        $adminUsers = [
            'admin'  => 'admin@example.com',
            'admin2' => 'admin2@example.com',
        ];

        foreach ($adminUsers as $adminUserLogin => $adminUserEmail) {
            $adminUser = User::create(
                [
                    'name'     => $adminUserLogin,
                    'email'    => $adminUserEmail,
                    'password' => Hash::make('123'),
                ]
            );

            Profile::create(
                [
                    'first_name'  => $adminUserLogin . '_first_name',
                    'second_name' => $adminUserLogin . '_second_name',
                    'third_name'  => $adminUserLogin . '_third_name',
                    'status'      => Profile::STATUS_ACTIVE,
                    'user_id'     => $adminUser->id,
                ]
            );

            $adminRole = Role::firstOrCreate(['title' => 'Admin']);

            /** @var User $adminUser */
            $adminUser->roles()->sync($adminRole->id);
        }
    }
}
