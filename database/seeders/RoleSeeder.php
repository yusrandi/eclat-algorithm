<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $roles = collect([
            ['id' => 1, 'title' => 'Admin'],
            ['id' => 2, 'title' => 'Kasir'],
            ['id' => 3, 'title' => 'Customer'],
        ]);
        
        $roles->each(function($role){
            Role::create([
                'id' => $role['id'],
                'title' => $role['title'],
            ]);
        });
    }
}
