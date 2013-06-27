<?php

/**
 * Repository for the User model
 */
class EloquentUserRepository implements UserRepositoryInterface {

    /**
     * Display the specified user.
     *
     * @param  int $id ID of the user.
     * @return object     returns the $user or a redirect to the admin index if no user is found.
     */
    public function findById($id)
    {
        // Look for a user with the corresponding ID.
        $user = User::where('id', $id)->first();

        if (!$user) throw new NotFoundException('User Not Found');

        return $user;
    }

    /**
     * Returns all users.
     * @return Object All users in database.
     */
    public function findAll()
    {
        return User::all();
    }

    /**
     * Store a newly created user in storage.
     *
     * @param  input from POST $data POST data from the create form.
     * @return redirect       redirect to the admin edit page of the new user, or back to the form in case of validation error.
     */
    public function store($data)
    {
        // Validate the input.
        $this->validate($data, User::$rules);

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

        if ($user->id) {
            return $user;
        } else {
            // Should not really happen...
            return false;
        }
    }

    /**
     * Update the specified user in storage.
     *
     * @param  int $id   ID of the user.
     * @param  input from PUT $data data from the edit form.
     * @return redirect       [description]
     */
    public function update($id, $data)
    {
        // Find the user.
        $user = $this->findById($id);

        $this->validate($data, $user->getUpdateRules());

        $oldUser = clone $user;
        $user->username = $data['username'];
        $user->email = $data['email'];

        if(in_array('password', $data)) {
            $user->password = $data['password'];
            // The password confirmation will be removed from model
            // before saving.
            $user->password_confirmation = $data['password_confirmation'];
        } else {
            unset($user->password);
            unset($user->password_confirmation);
        }

        $user->prepareRules($oldUser, $user);

        // Save if valid. Password field will be hashed before save
        $user->amend();

        return $user;
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
    public function validate($data, $rules)
    {
        $validator = Validator::make($data, $rules);

        if($validator->fails()) throw new ValidationException($validator);
        return true;
    }

}