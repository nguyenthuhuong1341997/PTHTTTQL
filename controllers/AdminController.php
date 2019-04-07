<?php 
	include_once 'models/Auth.php';

	/**
	 * 
	 */
	class AdminController
	{
		var $auth_model;
		function __construct()
		{
			$this->auth_model = new Auth();
		}

		public function index()
		{
			require_once('views/admin/index.php');
		}
	}
 ?>