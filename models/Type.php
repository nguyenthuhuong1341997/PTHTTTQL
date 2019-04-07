<?php 
	include_once 'Connection.php';
	/**
	 * 
	 */
	class Type
	{
		var $type_conn;
		function __construct()
		{
			$object= new Connection();
			$this->type_conn= $object->conn;
		}

		function list()
		{
			$query= "SELECT [dbo].[type].*
					FROM [dbo].[type];";

			$stmt = sqlsrv_query( $this->type_conn, $query );
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