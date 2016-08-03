<?php
class Plantillas_Controller extends Base_Controller
{

	public function action_index()
	{

		return View::make('plantilla');

	}

	public function action_login()
	{

		return View::make('login');

	}

}