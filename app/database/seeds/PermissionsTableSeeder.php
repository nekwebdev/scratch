<?php

class PermissionsTableSeeder extends Seeder {

    public function run()
    {
    	// Uncomment the below to wipe the table clean before populating
    	DB::table('permissions')->delete();

        $permissions = array(
        	array(
                'name'      	=> 'manage_users',
                'display_name'	=> 'Manage users'
            ),
            array(
                'name'      	=> 'manage_roles',
                'display_name'	=> 'Manage roles'
            ),
            array(
                'name'      	=> 'manage_permissions',
                'display_name'	=> 'Manage permissions'
            ),
            array(
                'name'      	=> 'manage_posts',
                'display_name'  => 'manage posts'
            )
        );

        // Uncomment the below to run the seeder
        DB::table('permissions')->insert($permissions);

        // Uncomment the below to wipe the table clean before populating
        DB::table('permission_role')->delete();

        $permissions = array(
            array(
                'role_id'      	=> 1,
                'permission_id' => 1
            ),
            array(
                'role_id'      	=> 1,
                'permission_id' => 2
            ),
            array(
                'role_id'      	=> 1,
                'permission_id' => 3
            ),
            array(
                'role_id'      	=> 1,
                'permission_id' => 4
            ),
            array(
                'role_id'      	=> 2,
                'permission_id' => 4
            ),
        );

        DB::table('permission_role')->insert( $permissions );
    }

}