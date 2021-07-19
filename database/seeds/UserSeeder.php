<?php

/**
 * UserSeeder.php
 * 
 * @since 23 Aug, 2020
 * @copyright Grorapid @ 2020
 * @author Manish Sahani <rec.manish.sahani@gmail.com>
 */

use App\Utilities\UserUtility;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->command->info('');
        $this->command->info('///////////////////////////////////////////////////////////////////////////');
        $this->command->info('//                                                                       //');
        $this->command->info('//                    Creating Default User for the platform             //');
        $this->command->info('//                                                                       //');
        $this->command->info('///////////////////////////////////////////////////////////////////////////');
        $this->command->info('');

        UserUtility::create(config('testing.user.fake'));

        $this->command->info('');
        $this->command->info('///////////////////////////////////////////////////////////////////////////');
        $this->command->info('');
    }
}
