<?php

use App\Models\Type;
use App\Utilities\TypeUtility;
use Illuminate\Database\Seeder;

class TypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->command->info('///////////////////////////////////////////////////////////////////////////');
        $this->command->info('//                                                                       //');
        $this->command->info('//                  Creating Types for the platform                      //');
        $this->command->info('//                                                                       //');
        $this->command->info('///////////////////////////////////////////////////////////////////////////');
        $this->command->info('');

        foreach (config('seeder.types') as $type) {
            $this->command->info('>> Creating service type <fg=yellow> ' . ucfirst($type[Type::SCHEMA_NAME]) . '</>');
            TypeUtility::create($type);
        }
        $this->command->info('');
        $this->command->info('///////////////////////////////////////////////////////////////////////////');
        $this->command->info('');
    }
}
