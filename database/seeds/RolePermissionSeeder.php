<?php

use App\Models\Permission;
use App\Models\Role;
use App\User;
use App\Utilities\UserUtility;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Schema;

class RolePermissionSeeder extends Seeder
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
        $this->command->info('//               Creating Roles, Permissions and Users                   //');
        $this->command->info('//                                                                       //');
        $this->command->info('///////////////////////////////////////////////////////////////////////////');
        $this->command->info('');

        $this->command->info('>> Truncating User, Role and Permission tables');
        $this->truncateLaratrustTables();
        $this->command->info('');

        $roles = config('laratrust_seeder.roles_structure');
        $mapPermission = collect(config('laratrust_seeder.permissions_map'));

        foreach ($roles as $key => $modules) {
            $role = Role::create([
                Role::SCHEMA_NAME           => $key,
                Role::SCHEMA_DISPLAY_NAME   => ucwords(str_replace('_', ' ', $key)),
                Role::SCHEMA_DESCRIPTION    => ucwords(str_replace('_', ' ', $key)),
            ]);
            $permissions = [];

            $this->command->info('>> Creating Role, '. ucwords($key));
            foreach ($modules as $module => $value) {
                foreach (explode(',', $value) as $p => $perm) {
                    $permissionValue = $mapPermission->get($perm);

                    $permissions[] = \App\Models\Permission::firstOrCreate([
                        Permission::SCHEMA_NAME          => $permissionValue . '-' . $module,
                        Permission::SCHEMA_DISPLAY_NAME  => ucfirst($permissionValue) . ' ' . ucfirst($module),
                        Permission::SCHEMA_DESCRIPTION   => ucfirst($permissionValue) . ' ' . ucfirst($module),
                    ])->id;

                    $this->command->info('<fg=yellow>+ </> |--- Creating Permission to ' . $permissionValue . ' for ' . $module);
                }
            }

            // Attach all permissions to the role
            $role->permissions()->sync($permissions);

            $this->command->info("   |");
            $this->command->info("<fg=yellow>+ </> |>>> Creating '{$key}' user");
            $this->command->info('');

            $data = [
                User::SCHEMA_FIRST_NAME     => ucwords(str_replace('_', ' ', $key)),
                User::SCHEMA_EMAIL          => 'hello+' . $key . '@grorapid.com',
                User::SCHEMA_ACTIVE         => 1,
                User::SCHEMA_PASSWORD       => 'qwert@44',
                User::PIVOT_ROLE_ID         => $role->id,
            ];

            UserUtility::create($data);
        }

        $this->command->info('');
        $this->command->info('///////////////////////////////////////////////////////////////////////////');
        $this->command->info('');
    }

    /**
     * Truncates all the laratrust tables and the users table
     *
     * @return    void
     */
    public function truncateLaratrustTables()
    {
        Schema::disableForeignKeyConstraints();
        DB::table('permission_role')->truncate();
        DB::table('permission_user')->truncate();
        DB::table('role_user')->truncate();
        \App\User::truncate();
        \App\Models\Role::truncate();
        \App\Models\Permission::truncate();
        Schema::enableForeignKeyConstraints();
    }
}
