<?php
namespace api\v1;

use BaseController;
use UserRepositoryInterface;
use Input;
use View;
use Auth;
use Redirect;

class UserController extends \BaseController {



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
	 * Get the logged in user data.
	 *
	 * @return Response
	 */
	public function index()
	{
		// Get the authentified user
        return Auth::user();
        // \API::createResponse(Auth::user());

	}

	/**
	 * Get a blank user for creation.
	 *
	 * @return Response
	 */
	public function create()
	{
		// If we are already authentified, redirect to the index.
		if(Auth::user()) return Redirect::action('api\v1\UserController@index');

		return $this->users->instance();
	}

	/**
	 * Store a newly created user in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		return $this->users->store(Input::all());
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		//
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		//
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		//
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		//
	}

}