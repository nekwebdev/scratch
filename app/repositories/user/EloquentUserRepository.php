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

        // Following is from Confide generated controller

        $user = $this->instance();

        $user->username = Input::get( 'username' );
        $user->email = Input::get( 'email' );
        $user->password = Input::get( 'password' );

        // The password confirmation will be removed from model
        // before saving. This field will be used in Ardent's
        // auto validation.
        $user->password_confirmation = Input::get( 'password_confirmation' );

        // Validate the input.
        $v = Validator::make(Input::all(), User::$rules);

        if ($v->fails()) {
            if(Request::ajax())
            {
                $response_values = array(
                    'validation_failed' => 1,
                    'errors' =>  $v->errors()->toArray());
                return Response::json($response_values);
            }
            else
            {
                die(var_dump($v));
            }
        }

        // Save if valid. Password field will be hashed before save
        $user->save();

        if ( $user->id )
        {
            // Redirect with success message, You may replace "Lang::get(..." for your custom message.
                        return Redirect::to('user/login')
                            ->with( 'notice', Lang::get('confide::confide.alerts.account_created') );
        }
        else
        {
            // Get validation errors (see Ardent package)
            $error = $user->errors()->all(':message');

                        return Redirect::to('user/create')
                            ->withInput(Input::except('password'))
                            ->with( 'error', $error );
        }

        // $validator = Validator::make($data, User::$rules);
        // // if($validator->fails()) throw new ValidationException($validator);
        // if($validator->fails()) {
        //     $errors = $validator->messages();
        //     if(Request::ajax()){
        //         return $errors;
        //     }
        //     throw new ValidationException($validator);
        // }

        // $validator = Validator::make($data, User::$rules);

        // if ($validator->fails()) {
           // if(Request::ajax()) {
                // $response_values = array(
                //     'validation_failed' => 1,
                //     'errors' =>  $validator->errors()->toArray());
                //     return $response_values;
                // $errors = $validator->messages();
                // return $errors;

                    // $errors = $validator->messages()->all(':message');
                    // return API::createResponse(compact('errors'), 400);
                    //return API::createResponse($response_values);
           // }
            // Redirect back to the user create form with input and errors.
            // return Redirect::to('user/create')
            //     ->withInput($data)
            //     ->withErrors($validator)
            //     ->send();
            // exit;
        // }

        // Save the new user
        $user = User::create($data);

        // Save roles.
        $user->saveRoles(Input::get('roles'));

        // Redirect to the admin edit page of the user.
        Redirect::to('admin/users/' . $user->id . '/edit')
            ->with('success', Lang::get('admin/users/messages.create.success'))
            ->send();
        exit;
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

    public function validate($data)
    {
        // $validator = Validator::make($data, User::$rules);
        // // if($validator->fails()) throw new ValidationException($validator);
        // if($validator->fails()) {
        //     $errors = $validator->messages();
        //     if(Request::ajax()){
        //         //$type = 'ajax';
        //         return $errors;
        //     }
        // }
        // return true;

        $validator = Validator::make($data, User::$rules);

        if($validator->fails()) throw new ValidationException($validator);
        return true;
    }
}