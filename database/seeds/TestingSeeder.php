<?php

use Illuminate\Database\Seeder;

class TestingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call(UserSeeder::class);

        $this->command->info('');
        $this->command->info('///////////////////////////////////////////////////////////////////////////');
        $this->command->info('//                                                                       //');
        $this->command->info('//               Create Containers and other testing things              //');
        $this->command->info('//                                                                       //');
        $this->command->info('///////////////////////////////////////////////////////////////////////////');
        $this->command->info('');
        


        $this->command->info('');
        $this->command->info('///////////////////////////////////////////////////////////////////////////');
        $this->command->info('');
    }
}
