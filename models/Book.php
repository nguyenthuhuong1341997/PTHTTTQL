<?php 
	include_once 'Connection.php';
	/**
	 * 
	 */
	class Book
	{
		var $book_conn;
		function __construct()
		{
			$object= new Connection();
			$this->book_conn= $object->conn;
		}

		function list()
		{
			$query= "SELECT [dbo].[book].*,
						[dbo].[author].[name] AS author_name, 
						[dbo].[publisher].[name] as publisher_name, 
						[dbo].[type].[name] as type 
					FROM [dbo].[book], [dbo].[author], [dbo].[publisher],[dbo].[type]
					where [dbo].[type].[id]= [dbo].[book].[type_id]
					AND [dbo].[author].[id]= [dbo].[book].[author_id]
					AND [dbo].[publisher].[id]= [dbo].[book].[publisher_id];";

			

			$stmt = sqlsrv_query( $this->book_conn, $query );
			if( $stmt === false) {
				echo "Khong ton tai";
			    die( print_r( sqlsrv_errors(), true) );
			}
			$result = array();
			while( $row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC) ) {
			     
			     $query2 = "Select [dbo].[site].[id] as id, [dbo].[book].[name], [dbo].[site].[name], [dbo].[site_book].quantity
						FROM [dbo].[book],[dbo].[site_book],[dbo].[site]
						WHERE [dbo].[book].[id] = [dbo].[site_book].[book_id]
						AND [dbo].[site_book].[site_id]= [dbo].[site].[id]
						AND [dbo].[book].[id]=" .$row['id'];
						
					$stmt1 = sqlsrv_query( $this->book_conn, $query2 );
					if( $stmt1 === false) {
						echo "Khong ton tai";
					    die( print_r( sqlsrv_errors(), true) );
					}
					$row['quantity']=array();
					while( $row1 = sqlsrv_fetch_array( $stmt1, SQLSRV_FETCH_ASSOC) ) {
						$row['quantity'][$row1['id']] = $row1;
					}
				$result[$row['id']] = $row;

			}
			
			return $result;
		}

		function find($id)
		{
			$query= "SELECT [dbo].[book].*,
						[dbo].[author].[name] AS author_name, 
						[dbo].[publisher].[name] as publisher_name, 
						[dbo].[type].[name] as type 
					FROM [dbo].[book], [dbo].[author], [dbo].[publisher],[dbo].[type]
					where [dbo].[type].[id]= [dbo].[book].[type_id]
					AND [dbo].[author].[id]= [dbo].[book].[author_id]
					AND [dbo].[publisher].[id]= [dbo].[book].[publisher_id]
					AND [dbo].[book].[id] = ".$id;

			

			$stmt = sqlsrv_query( $this->book_conn, $query );
			if( $stmt === false) {
				echo "Khong ton tai";
			    die( print_r( sqlsrv_errors(), true) );
			}
			$result;
			while( $row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC) ) {
			     
			     $query2 = "Select [dbo].[site].[id] as id, [dbo].[book].[name], [dbo].[site].[name], [dbo].[site_book].quantity
						FROM [dbo].[book],[dbo].[site_book],[dbo].[site]
						WHERE [dbo].[book].[id] = [dbo].[site_book].[book_id]
						AND [dbo].[site_book].[site_id]= [dbo].[site].[id]
						AND [dbo].[book].[id]=" .$row['id'];
						
					$stmt1 = sqlsrv_query( $this->book_conn, $query2 );
					if( $stmt1 === false) {
						echo "Khong ton tai";
					    die( print_r( sqlsrv_errors(), true) );
					}
					$row['quantity']=array();
					while( $row1 = sqlsrv_fetch_array( $stmt1, SQLSRV_FETCH_ASSOC) ) {
						$row['quantity'][$row1['id']] = $row1;
					}
				$result = $row;

			}
			
			return $result;
		}

		function ajaxInforBookForAddQuantity($book_id, $quantity)
		{
			$query = "SELECT * FROM [dbo].[site_book] WHERE [dbo].[site_book].book_id =".$book_id." AND [dbo].[site_book].site_id = ".$_SESSION['user']['site_id'];
			$stmt = sqlsrv_query($this->book_conn, $query);

			if($stmt) {
				$query2 = "INSERT INTO [dbo].[site_book](book_id,site_id, quantity)
						values(".$book_id.", ".$_SESSION['user']['site_id'].",".$quantity.")";
				// print_r($query2);
				// die();
				$result = sqlsrv_query($this->book_conn, $query2);
				return $result;
			}else {
 
				$book_site;
				while( $row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC) ) {
					$book_site = $row;

				}
				$book_site['quantity'] = $book_site['quantity']+ $quantity;
				$query3 = "UPDATE [dbo].[site_book] 
						SET quantity = ".$book_site['quantity']."
						WHERE book_id =".$book_id." AND site_id = ".$_SESSION['user']['site_id'];
				$result = sqlsrv_query($this->book_conn, $query3);
				return $result;
			}
		}

		function insert($data)
		{	
			$query="INSERT INTO [dbo].[book](code,name, type_id, author_id,publisher_id,image, description)
				values('".$data['code']."','".$data['name']."',".$data['type'].",".$data['author'].",".$data['publisher'].",'".$data['image']."','".$data['description']."')";

			$result = sqlsrv_query($this->book_conn, $query);
			return $result;
		}

		function update($data,$id)
		{
			$query="UPDATE users SET name='".$data['name']."',code='".$data['code']."',email='".$data['email']."',phone_number='".$data['phone_number']."',role='".$data['role']."',birthday='".$data['birthday']."',address='".$data['address']."',joined_date='".$data['joined_date']."' WHERE id=".$id;

			$result= $this->book_conn->query($query);
			return $result;
		}

		function updateProfile($string,$id)
		{
			$query="UPDATE users SET image='".$string."' WHERE id=".$id;
			print_r($query);
			$result= $this->book_conn->query($query);
			return $result;
		}

		function delete($id)
		{
			$query= "DELETE FROM users WHERE id=" .$id;
			$result= $this->book_conn->query($query);
			return $result;
		}

		function checkpassword($id, $password)
		{
			$query= "SELECT * FROM users WHERE password='".md5($password)."' AND id= ".$id;
			
			$result=  $this->book_conn->query($query)->fetch_assoc();
			
			return $result;
		}

		function editpassword($id, $password)
		{
			$query="UPDATE users SET password='".md5($password)."'WHERE id=".$id;
			print_r($query);
			$result= $this->book_conn->query($query);
			return $result;
		}

		function insertWorkingDay($date, $user)
		{
			
			$query="INSERT INTO users_working_days(user, workingday)
				values('".$user."','".$date."')";
			print_r($query);
			$result= $this->book_conn->query($query);
			return $result;
		}
	}
?>