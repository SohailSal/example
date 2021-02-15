<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Permission;
use App\Models\Role;
use App\Models\Post;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();
//        \App\Models\Role::factory(5)->create();

        //New Posts
        Post::factory(5)->create();
        $view_post = Permission::factory()->create(['name' => 'view-post']);

  //New Users
        $jane = User::factory()->create(['name' => 'Jane']);
        $john = User::factory()->create(['name' => 'John']);
        $frank = User::factory()->create(['name' => 'Frank']);
        $maria = User::factory()->create(['name' => 'Maria']);

        //New Permissions
        $create_user = Permission::factory()->create(['name' => 'create-user']);
        $update_user = Permission::factory()->create(['name' => 'update-user']);
        $delete_user = Permission::factory()->create(['name' => 'delete-user']);

        //New Roles
        $customer_service = Role::factory()->create(['name' => 'customer-service']);
        $team_lead = Role::factory()->create(['name' => 'team-lead']);
        $admin = Role::factory()->create(['name' => 'admin']);
        $customer = Role::factory()->create(['name' => 'customer']);

        //Assign Each Role with Permissions
        $customer_service->allowTo($create_user);
        $customer_service->allowTo($update_user);
        $team_lead->allowTo($update_user);
        $admin->allowTo($view_post);

        //Assign Each User with Roles
        $jane->attachRole($customer);
        $john->attachRole($customer_service);
        $frank->attachRole($team_lead);
        $maria->attachRole($admin);

    }
}
