<?php 
	include_once 'Connection.php';
	/**
	 * 
	 */
	class User
	{
		var $user_conn;
		function __construct()
		{
			$object= new Connection();
			$this->user_conn= $object->conn;
		}

		function list()
		{
			$query= "SELECT [dbo].[user].*, [dbo].[site].[name] as site_name, [dbo].[role].[name] as role_name
				FROM [dbo].[user], [dbo].[site], [dbo].[role]
				WHERE [dbo].[user].site_id = [dbo].[site].id
				AND [dbo].[user].role_id = [dbo].[role].id
				AND [dbo].[user].id !=".$_SESSION['user']['id'];

			$stmt = sqlsrv_query( $this->user_conn, $query );
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

		function insert($data)
		{	
			$query="INSERT INTO [dbo].[user](code,name, phone, email,username,password, role_id,site_id)
				values('".$data['code']."','".$data['name']."','".$data['phone']."','".$data['email']."','".$data['username']."','".md5($data['password'])."',".$data['role_id'].",".$data['site_id'].")";

				// print_r($query);
				// die();
			$result = sqlsrv_query($this->user_conn, $query);
			return $result;
		}

		function find($id)
		{
			$query = "SELECT [dbo].[user].*, [dbo].[site].[name] as site_name, [dbo].[role].[name] as role_name
				FROM [dbo].[user], [dbo].[site], [dbo].[role]
				WHERE [dbo].[user].site_id = [dbo].[site].id
				AND [dbo].[user].role_id = [dbo].[role].id
				AND [dbo].[user].id =".$id;

			$stmt = sqlsrv_query($this->user_conn, $query);
			if(!$stmt) {
				echo "Khong ton tai";
			    die( print_r( sqlsrv_errors(), true) );
			}
			// $result = array();
			while( $row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC) ) {
				$result = $row;

			}
			return $result;
		}

		function update($data,$id)
		{
			$query="UPDATE [dbo].[user] SET code='".$data['code']."',email='".$data['email']."',name='".$data['name']."',phone='".$data['phone']."',role_id=".$data['role_id'].",site_id=".$data['site_id'].",username='".$data['username']."' WHERE id=".$id;
			$stmt= sqlsrv_query($this->user_conn, $query);
			if(!$stmt) {
				echo "Khong ton tai";
			    die( print_r( sqlsrv_errors(), true) );
			}
			return $stmt;
		}

		function delete($id)
		{
			$query= "DELETE FROM [dbo].[user] WHERE id=" .$id;
			$stmt= sqlsrv_query($this->user_conn, $query);
			if(!$stmt) {
				echo "Khong ton tai";
			    die( print_r( sqlsrv_errors(), true) );
			}
			return $stmt;
		}
	}
?>