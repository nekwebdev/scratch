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
use Input;
use Session;

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
     * Display a listing of the users.
     *
     * @return View
     */
    public function index()
    {
        // Set the page title.
        $title = Lang::get('admin/users/title.user_management');

        // There is no need to send any data to the view.
        // The datatables will be calling the getData method.
        return View::make('admin.users.index', compact('title'));
    }

}