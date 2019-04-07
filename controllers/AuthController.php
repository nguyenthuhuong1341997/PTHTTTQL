<?php 
	include_once 'models/Auth.php';

	/**
	 * 
	 */
	class AuthController
	{
		var $auth_model;
		function __construct()
		{
			$this->auth_model = new Auth();
		}

		public function login()
		{
			require_once('views/login.php');
		}

		public function separation(){
			$email=$_POST['email'];
			$password=md5($_POST['password']);
			$users = $this->auth_model->check($email,$password);

			$response = array(
				'success' =>'fasle'
			);		    
			if(!is_null($users)) {
				$_SESSION['user'] = $users;
				$response['success'] = 'true';
			}
			echo json_encode($response);
			exit;
		}
	}
 ?>