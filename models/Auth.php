<?php 
	include_once 'Connection.php';;

	/**
	 * 
	 */
	class Auth
	{
		
		var $auth;
		function __construct()
		{
			$connection = new Connection();
			$this->auth = $connection->conn;
		}

		function check($email,$pass){
			
			$query="SELECT * FROM [dbo].[user] WHERE email='".$email."' AND password='".$pass."'";

			$stmt = sqlsrv_query( $this->auth, $query );
			if( $stmt === false) {
				echo "Khong ton tai";
			    die( print_r( sqlsrv_errors(), true) );
			}

			// while( $row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC) ) {
			     
			// }
			$result = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC);
			
			return $result;
		}
	}
 ?>