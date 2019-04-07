<?php 
	include_once 'Connection.php';
	/**
	 * 
	 */
	class Site
	{
		var $site_conn;
		function __construct()
		{
			$object= new Connection();
			$this->site_conn= $object->conn;
		}

		function list()
		{
			$query= "SELECT [dbo].[site].*
					FROM [dbo].[site];";

			$stmt = sqlsrv_query( $this->site_conn, $query );
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