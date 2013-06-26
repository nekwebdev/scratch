<?php

/**
 * Repository for the User model
 */
class EloquentUserRepository implements UserRepositoryInterface
{

    /**
     * Store a newly created user in storage.
     *
     * @param  input from POST $data POST data from the create form.
     * @return redirect       redirect to the admin edit page of the new user, or back to the form in case of validation error.
     */
    public function store($data)
    {
        // Validate the input.
        $this->validate($data);

        // Following is adapted from Confide generated controller.
        $user = $this->instance();

        $user->username = Input::get( 'username' );
        $user->email = Input::get( 'email' );
        $user->password = Input::get( 'password' );

        // The password confirmation will be removed from model
        // before saving. This field will be used in Ardent's
        // auto validation.
        $user->password_confirmation = Input::get( 'password_confirmation' );

        // Save if valid. Password field will be hashed before save.
        $user->save();

        if ( $user->id )
        {
            // Our user was created return it!
            return $user;
        }
        else
        {
            // Should not really happen...
            return false;
        }
    }

    /**
     * Create a new Confide user object
     * @param  array  $data User data
     * @return object       User object
     */
    public function instance($data = array())
    {
        return new User($data);
    }

    /**
     * validate data according to the User model rules
     * @param  Input $data  Input to be validated
     * @return varies       True or an Exception
     */
    public function validate($data)
    {
        $validator = Validator::make($data, User::$rules);

        if($validator->fails()) throw new ValidationException($validator);
        return true;
    }
}