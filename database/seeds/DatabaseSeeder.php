<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Artisan;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(TypeSeeder::class);
        $this->call(RolePermissionSeeder::class);
        
        if ( App::environment(['testing', 'local']) ) {
            $this->call(TestingSeeder::class);
        }

        Artisan::call('passport:install');
    }
}
