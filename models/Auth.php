<?php
include_once 'Connection.php';

/**
 *
 */
class Auth {

	var $auth;
	function __construct() {
		$connection = new Connection();
		$this->auth = $connection->conn;
	}

	function check($email, $pass) {

		$query = "SELECT u.id, u.name, u.code, u.username, u.site_id, r.code as rcode, s.code as scode FROM [dbo].[user] u
					join dbo.[role] r on r.id = u.role_id join dbo.[site] s on s.id = u.site_id
					WHERE email='" . $email . "' AND password='" . $pass . "'";

		$stmt = sqlsrv_query($this->auth, $query);
		if ($stmt === false) {
			echo "Khong ton tai";
			die(print_r(sqlsrv_errors(), true));
		}

		// while( $row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC) ) {

		// }
		$result = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC);

		return $result;
	}
}
?>