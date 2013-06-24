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

        // Create the poster role.
        $commentRole = new Role;
        $commentRole->name = 'poster';
        $commentRole->save();

        // Attach the admin role to the admin user.
        $user = User::where('username','=','admin')->first();
        $user->attachRole( $adminRole );

        // Attach the poster role to the regular user.
        $user = User::where('username','=','user')->first();
        $user->attachRole( $commentRole );
    }

}