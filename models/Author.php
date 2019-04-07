<?php 
	include_once 'Connection.php';
	/**
	 * 
	 */
	class Author
	{
		var $author_conn;
		function __construct()
		{
			$object= new Connection();
			$this->author_conn= $object->conn;
		}

		function list()
		{
			$query= "SELECT [dbo].[author].*
					FROM [dbo].[author];";

			$stmt = sqlsrv_query( $this->author_conn, $query );
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