<?php
namespace admin;

use BaseController;
use UserRepositoryInterface;
use Auth;
use Lang;
use View;
use Confide;
use Redirect;
use API;
use User;

/*
|--------------------------------------------------------------------------
| Admin User Controller
|--------------------------------------------------------------------------
|
| User resource management.
|
*/

class UserController extends BaseController {

	/**
     * User Repository Interface
     *
     * @var UserRepositoryInterface
     */
    protected $users;

    /**
     * Create a new controller instance
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
     * User profile edit form
     *
     * @return View
     */
    public function getIndex()
    {
        // If we are not logged in redirect us to login.
        if(Auth::guest()) return Redirect::action('UserController@getLogin');

        // Get the data needed for the view.
        $user = Auth::user();
        $rules = $user->getUpdateRules();
        $title = Lang::get('user/title.user_management');

        return View::make('user/index', compact('user','rules', 'title'));
    }
}