<?php namespace App\Controllers\Home;
use App\Kernel\ControllerAbstract;
class HomeController extends ControllerAbstract
{
	/**
	* Index Action
	*
	* @return string
	*/
	public function index()
	{
		return $this->render('Home/index.twig');
	}
}
