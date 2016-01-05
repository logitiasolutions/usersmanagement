<?php namespace App\Http\Controllers;

use App\User;
use Cartalyst\DataGrid\Laravel\Facades\DataGrid;

class HomeController extends Controller {

	/*
	|--------------------------------------------------------------------------
	| Home Controller
	|--------------------------------------------------------------------------
	|
	| This controller renders your application's "dashboard" for users that
	| are authenticated. Of course, you are free to change or remove the
	| controller as you wish. It is just here to get your app started!
	|
	*/

	/**
	 * Create a new controller instance.
	 *
	 * @return void
	 */
	public function __construct()
	{
		$this->middleware('auth');
	}

	/**
	 * Show the application dashboard to the user.
	 *
	 * @return Response
	 */
	public function getIndex()
	{
		return view('home');
	}

	/**
	 * Datasource for the users Data Grid.
	 *
	 * @return \Cartalyst\DataGrid\DataGrid
	 */
	public function getGrid()
	{
		$columns = [
			'id',
			'email',
			'first_name',
			'last_name',
			'address',
			'city',
			'postcode',
			'company',
			'phone',
		];

		$settings = [
			'sort'      => 'created_at',
			'direction' => 'desc',
		];

		$users = User::where('email','!=','admin@test.com');

		return DataGrid::make($users, $columns, $settings);
	}
}
