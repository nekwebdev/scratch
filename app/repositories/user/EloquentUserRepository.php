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

        $validator = Validator::make($data, User::$rules);

        if ($validator->fails()) {
           // if(Request::ajax()) {
                // $response_values = array(
                //     'validation_failed' => 1,
                //     'errors' =>  $validator->errors()->toArray());
                //     return $response_values;
                return $validator;

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
        }

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
        $validator = Validator::make($data, User::$rules);
        // if($validator->fails()) throw new ValidationException($validator);
        if($validator->fails()) {
            $message = $validator->errors()->toArray();
            return Response::json($message);
        }
        return true;
    }
}