<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Project;
use App\Models\Task;
use App\Models\Client;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {

        User::factory(1)->create();
        Client::factory(1)->create();
        Project::factory(1)->create();
        Task::factory(1)->create();
        Role::create([

            'name' => 'admin'
        ]);
        $admin  =  Role::create([

            'name' => 'user'
        ]);


        $permission1 = Permission::create(['name' => 'edit users']);
        $permission2 =  Permission::create(['name' => 'delete users']);
        $permission3 =  Permission::create(['name' => 'create users']);
        $admin->givePermissionTo([$permission1,   $permission2, $permission3]);


        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
    }
}
