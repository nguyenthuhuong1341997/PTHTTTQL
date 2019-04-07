<?php 
	include_once 'Connection.php';
	/**
	 * 
	 */
	class Role
	{
		var $role_conn;
		function __construct()
		{
			$object= new Connection();
			$this->role_conn= $object->conn;
		}

		function list()
		{
			$query= "SELECT [dbo].[role].*
					FROM [dbo].[role];";

			$stmt = sqlsrv_query( $this->role_conn, $query );
			if( $stmt === false) {
				echo "Khong ton tai";
			    die( print_r( sqlsrv_errors(), true) );
			}
			$result = array();
			while( $row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC) ) {
				$result[$row['id']] = $row;

			}
			
			return $result;
		}
	}
?>