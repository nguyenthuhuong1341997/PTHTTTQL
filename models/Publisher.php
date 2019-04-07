<?php 
	include_once 'Connection.php';
	/**
	 * 
	 */
	class Publisher
	{
		var $publisher_conn;
		function __construct()
		{
			$object= new Connection();
			$this->publisher_conn= $object->conn;
		}

		function list()
		{
			$query= "SELECT [dbo].[publisher].*
					FROM [dbo].[publisher];";

			$stmt = sqlsrv_query( $this->publisher_conn, $query );
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