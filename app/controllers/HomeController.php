<?php

class HomeController extends BaseController {

	/*
	|--------------------------------------------------------------------------
	| Home Controller
	|--------------------------------------------------------------------------
	*/

	public function __construct()
    {
        $this->meta = array(
            'title' => 'DefaulS',
            'author' => 'Me',
            'keywords' => 'Keywords',
            'description' => 'Description'
        );
    }

	public function getIndex()
	{
        $meta = $this->meta;
        $meta['title'] = 'Home Page';
		return View::make('frontend/home', compact('meta'));
	}

}