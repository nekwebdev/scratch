<?php

class RolesTableSeeder extends Seeder {

    public function run()
    {
    	// Uncomment the below to wipe the table clean before populating
    	DB::table('roles')->delete();

    	// Create the admin role.
        $adminRole = new Role;
        $adminRole->name = 'admin';
        $adminRole->save();

        // Create the user role.
        $userRole = new Role;
        $userRole->name = 'user';
        $userRole->save();

        // Attach the admin role to the admin user.
        $user = User::where('username','=','admin')->first();
        $user->attachRole( $adminRole );

        // Attach the user role to the regular user.
        $user = User::where('username','=','user')->first();
        $user->attachRole( $userRole );
    }

}