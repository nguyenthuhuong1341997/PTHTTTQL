<?php 
	/**
	* 
	*/
	class Connection
	{
		var $conn;
		function __construct()
		{
			$serverName="NTHuong";
			$username="sa";
			$password="123456";
			$dbname="QL_BANSACH_HANOI";
			// Tạo ra kết nối đến CSDL connection
			$connectionInfo = array( "Database"=>$dbname, "UID"=>$username, "PWD"=>$password, 'CharacterSet' => 'UTF-8');
			$this->conn = sqlsrv_connect( $serverName, $connectionInfo);
			// Kiểm tra kết nối
			if( !$this->conn ) {
			    echo "Connection could not be established.<br />";
			     die( print_r( sqlsrv_errors(), true));
			}
		}
	}
?>