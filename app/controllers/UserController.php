<?php
/*
|--------------------------------------------------------------------------
| Confide Controller Template
|--------------------------------------------------------------------------
|
| This is the default Confide controller template for controlling user
| authentication. Feel free to change to your needs.
|
*/

class UserController extends BaseController
{
    /**
     * User Repository Interface
     *
     * @var UserRepositoryInterface
     */
    protected $users;

    /**
     * Create a new controller instance.
     *
     * Inject the repository interfaces.
     *
     * @param UserRepositoryInterface $users
     */
    public function __construct(UserRepositoryInterface $users)
    {
        $this->users = $users;
    }

    /**
     * User profile.
     *
     * @return View
     */
    public function getIndex()
    {
        // If we are not logged in redirect us to login
        if(!Auth::user()) return Redirect::action('UserController@getLogin');

        // Get our currently logged in user.
        $user = API::get('api/v1/user');

        // Get the update validation rules.
        $rules = $user->getUpdateRules();

        // Set the page title.
        $title = Lang::get('user/title.user_management');

        // Show the user profile edit page.
        return View::make('user/index', compact('user','rules', 'title'));
    }

    /**
     * Displays the form for account creation
     *
     */
    public function getCreate()
    {
        // If we are already authentified, redirect to the index.
        if(Auth::user()) return Redirect::action('UserController@getIndex');

        $user = API::get('api/v1/user/create');

        $rules = User::$rules;

        // Set the page title.
        $title = Lang::get('user/title.create_a_new_user');

        return View::make('user/create', compact('user', 'rules', 'title'));
    }

    /**
     * Stores new account
     *
     */
    public function postIndex()
    {
        $user = API::post('api/v1/user', Input::all());

        // If the API throws a ValidationException $user will be a JSON string with our errors.
        if($user[1]) {
            $errors = json_decode($user, true);
            // Will happen when validation is refused because of a unique requirement on the field.
            return Redirect::to('user/create')
                            ->withErrors($errors);
        } else {
            // Redirect with success message, You may replace "Lang::get(..." for your custom message.
            return Redirect::to('user/login')
                            ->with( 'notice', Lang::get('confide::confide.alerts.account_created') );
        }


        // // Store the original input of the request and then replace the input with your request instances input.
        // $originalInput = Request::input();

        // Request::replace($request->input());

        // // Dispatch your request instance with the router.
        // $response = Route::dispatch($request);

        // // Replace the input again with the original request input.
        // Request::replace($originalInput);


        // // create a new request to the API resource
        // $request = Request::create('/api/v1/user', 'POST');

        // $response = Route::dispatch($request)->getOriginalContent();



        // die(var_dump($response));


        // store the original request data and route
        // $originalInput = Request::input();
        // $originalRoute = Route::getCurrentRoute();

        // // create a new request to the API resource
        // $request = Request::create('/api/v1/user', 'POST');

        // // replace the request input...
        // Request::replace($request->input());

        // // ...and dispatch this request instance to the router
        // $response = Route::dispatch($request)->getOriginalContent();



        // // replace the request input and route back to the original state
        // Request::replace($originalInput);
        // Route::setCurrentRoute($originalRoute);
        //return 'yo';

        // $data = Input::all();

        // $originalInput = Request::input();
        // $originalRoute = Route::getCurrentRoute();


        // // Make request.
        // $request = Request::create('/api/v1/user', 'POST');

        // // Replacce input with parameters.
        // // Request::replace($data);
        // Request::replace($request->input());

        // $response = Route::dispatch($request)->getOriginalContent();

        // Request::replace($originalInput);
        // Route::setCurrentRoute($originalRoute);

        // $responseArray = json_decode($response);

        // if($responseArray['validation_failed']) {
        //     return 'yo';
        // }
        // if(Request::ajax()) {
        //     $response_values = array(
        //             'validation_failed' => 1,
        //             'errors' =>  $response->errors()->toArray());
        //     //return Response::json($response_values);
        //     return $response;
        // }
        // return $response;

        // return 'real request';




        // $user = new User;

        // $user->username = Input::get( 'username' );
        // $user->email = Input::get( 'email' );
        // $user->password = Input::get( 'password' );

        // // The password confirmation will be removed from model
        // // before saving. This field will be used in Ardent's
        // // auto validation.
        // $user->password_confirmation = Input::get( 'password_confirmation' );

        // // Validate the input.
        // $v = Validator::make(Input::all(), User::$rules);

        // if ($v->fails()) {
        //     if(Request::ajax())
        //     {
        //         $response_values = array(
        //             'validation_failed' => 1,
        //             'errors' =>  $v->errors()->toArray());
        //         return Response::json($response_values);
        //     }
        //     else
        //     {
        //         die(var_dump($v));
        //     }
        // }

        // // Save if valid. Password field will be hashed before save
        // $user->save();

        // if ( $user->id )
        // {
        //     // Redirect with success message, You may replace "Lang::get(..." for your custom message.
        //                 return Redirect::to('user/login')
        //                     ->with( 'notice', Lang::get('confide::confide.alerts.account_created') );
        // }
        // else
        // {
        //     // Get validation errors (see Ardent package)
        //     $error = $user->errors()->all(':message');

        //                 return Redirect::to('user/create')
        //                     ->withInput(Input::except('password'))
        //                     ->with( 'error', $error );
        // }
    }

    public function postEdit()
    {

    }
    /**
     * Displays the login form
     *
     */
    public function getLogin()
    {
        if( Confide::user() )
        {
            // If user is logged, redirect to internal
            // page, change it to '/admin', '/dashboard' or something
            return Redirect::to('/');
        }
        else
        {
            return View::make(Config::get('confide::login_form'));
        }
    }

    /**
     * Attempt to do login
     *
     */
    public function postLogin()
    {
        $input = array(
            'email'    => Input::get( 'email' ), // May be the username too
            'username' => Input::get( 'email' ), // so we have to pass both
            'password' => Input::get( 'password' ),
            'remember' => Input::get( 'remember' ),
        );

        // If you wish to only allow login from confirmed users, call logAttempt
        // with the second parameter as true.
        // logAttempt will check if the 'email' perhaps is the username.
        if ( Confide::logAttempt( $input ) )
        {
            // If the session 'loginRedirect' is set, then redirect
            // to that route. Otherwise redirect to '/'
            $r = Session::get('loginRedirect');
            if (!empty($r))
            {
                Session::forget('loginRedirect');
                return Redirect::to($r);
            }

            return Redirect::to('/'); // change it to '/admin', '/dashboard' or something
        }
        else
        {
            $user = new User;

            // Check if there was too many login attempts
            if( Confide::isThrottled( $input ) )
            {
                $err_msg = Lang::get('confide::confide.alerts.too_many_attempts');
            }
            elseif( $user->checkUserExists( $input ) and ! $user->isConfirmed( $input ) )
            {
                $err_msg = Lang::get('confide::confide.alerts.not_confirmed');
            }
            else
            {
                $err_msg = Lang::get('confide::confide.alerts.wrong_credentials');
            }

                        return Redirect::to('user/login')
                            ->withInput(Input::except('password'))
                ->with( 'error', $err_msg );
        }
    }

    /**
     * Attempt to confirm account with code
     *
     * @param  string  $code
     */
    public function getConfirm( $code )
    {
        if ( Confide::confirm( $code ) )
        {
            $notice_msg = Lang::get('confide::confide.alerts.confirmation');
                        return Redirect::to('user/login')
                            ->with( 'notice', $notice_msg );
        }
        else
        {
            $error_msg = Lang::get('confide::confide.alerts.wrong_confirmation');
                        return Redirect::to('user/login')
                            ->with( 'error', $error_msg );
        }
    }

    /**
     * Displays the forgot password form
     *
     */
    public function getForgot()
    {
        return View::make(Config::get('confide::forgot_password_form'));
    }

    /**
     * Attempt to send change password link to the given email
     *
     */
    public function postForgot()
    {
        if( Confide::forgotPassword( Input::get( 'email' ) ) )
        {
            $notice_msg = Lang::get('confide::confide.alerts.password_forgot');
                        return Redirect::to('user/login')
                            ->with( 'notice', $notice_msg );
        }
        else
        {
            $error_msg = Lang::get('confide::confide.alerts.wrong_password_forgot');
                        return Redirect::to('user/forgot')
                            ->withInput()
                ->with( 'error', $error_msg );
        }
    }

    /**
     * Shows the change password form with the given token
     *
     */
    public function getReset( $token )
    {
        return View::make(Config::get('confide::reset_password_form'))
                ->with('token', $token);
    }

    /**
     * Attempt change password of the user
     *
     */
    public function postReset()
    {
        $input = array(
            'token'=>Input::get( 'token' ),
            'password'=>Input::get( 'password' ),
            'password_confirmation'=>Input::get( 'password_confirmation' ),
        );

        // By passing an array with the token, password and confirmation
        if( Confide::resetPassword( $input ) )
        {
            $notice_msg = Lang::get('confide::confide.alerts.password_reset');
                        return Redirect::to('user/login')
                            ->with( 'notice', $notice_msg );
        }
        else
        {
            $error_msg = Lang::get('confide::confide.alerts.wrong_password_reset');
                        return Redirect::to('user/reset/'.$input['token'])
                            ->withInput()
                ->with( 'error', $error_msg );
        }
    }

    /**
     * Log the user out of the application.
     *
     */
    public function getLogout()
    {
        Confide::logout();

        return Redirect::to('/');
    }

}