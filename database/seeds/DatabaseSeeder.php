<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {

        factory(App\Role::class)->create([
            'name' => 'Admin',
        ]);

        factory(App\Role::class)->create([
            'name' => 'Employee',
        ]);

        factory(App\User::class, 1)->create([
            'name' => 'Admin',
            'email' => 'admin@gmail.com',
        ])->each(function ($u) {
            $u->role()->attach(1);
        });

        factory(App\User::class, 1)->create([
            'name' => 'Employee',
            'email' => 'employee@gmail.com',
        ])->each(function ($u) {
            $u->role()->attach(2);
        });

        factory(App\Department::class)->create([
            'department_name' => 'HR Departments',
            'slug' => 'hr-departments',
            'remark' => '1 head and 2 supervisor',
        ]);

        factory(App\Department::class)->create([
            'department_name' => 'WEB Departments',
            'slug' => 'web-departments',
        ]);
        factory(App\Department::class)->create([
            'department_name' => 'Marketing Departments',
            'slug' => 'marketing-departments',
        ]);
        factory(App\Department::class)->create([
            'department_name' => 'Customer Service Departments',
            'slug' => 'cs-departments',
        ]);

        factory(App\Company::class)->create([
            'company_name' => 'COMPANY A',
            'email' => 'company@companyname.com',
            'address' => 'Building 00, Room 000,MICT Park, Yangon, Myanmar.',
        ])->each(function ($u) {
            $u->departments()->attach([1, 2, 3]);
        });

        factory(App\Company::class, 14)->create()->each(function ($u) {
            $u->departments()->attach(rand(1, 4));
        });;

        factory(App\Employee::class, 15)->create();
    }
}
