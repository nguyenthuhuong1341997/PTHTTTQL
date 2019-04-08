<?php 
	include_once 'Connection.php';
	/**
	 * 
	 */
	class Order
	{
		var $order_conn;
		function __construct()
		{
			$object= new Connection();
			$this->order_conn= $object->conn;
		}

		function list()
		{
			$query= "SELECT [dbo].[order].*, [dbo].[customer].id as customer_id, [dbo].[customer].name as customer_name , [dbo].[site].name as site_name
				FROM [dbo].[order], [dbo].[customer], [dbo].[site]
				WHERE [dbo].[order].customer_id = [dbo].[customer].id
				AND [dbo].[site].id= [dbo].[order].site_id
				AND [dbo].[order].status = 1";

			

			$stmt = sqlsrv_query( $this->order_conn, $query );
			if( $stmt === false) {
				echo "Khong ton tai";
			    die( print_r( sqlsrv_errors(), true) );
			}
			$result = array();
			while( $row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC) ) {
				$query2 = "SELECT [dbo].[book].name as book_name ,[dbo].[order_detail].price as book_price, [dbo].[order_detail].quantity
					FROM [dbo].[order], [dbo].[book], [dbo].[order_detail]
					WHERE [dbo].[order].code = [dbo].[order_detail].[order_code]
					AND [dbo].[order_detail].book_id= [dbo].[book].id
					AND [dbo].[order].status = 1
					AND [dbo].[order].code = '".$row['code']."'";
				$stmt1 = sqlsrv_query( $this->order_conn, $query2 );
				if( $stmt1 === false) {
					echo "Khong ton tai";
				    die( print_r( sqlsrv_errors(), true) );
				}
				$row['detail']=array();
				while( $row1 = sqlsrv_fetch_array( $stmt1, SQLSRV_FETCH_ASSOC) ) {
					$row['detail'][] = $row1;
				}
				$result[] = $row;

			}
			
			return $result;
		}

		function delivery()
		{
			$query= "SELECT [dbo].[order].*, [dbo].[customer].id as customer_id, [dbo].[customer].name as customer_name , [dbo].[site].name as site_name
				FROM [dbo].[order], [dbo].[customer], [dbo].[site]
				WHERE [dbo].[order].customer_id = [dbo].[customer].id
				AND [dbo].[site].id= [dbo].[order].site_id
				AND [dbo].[order].status >= 2
				AND [dbo].[order].status <= 3 ";
			$stmt = sqlsrv_query( $this->order_conn, $query );
			if( $stmt === false) {
				echo "Khong ton tai";
			    die( print_r( sqlsrv_errors(), true) );
			}
			$result = array();
			while( $row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC) ) {
				$query2 = "SELECT [dbo].[book].name as book_name ,[dbo].[order_detail].price as book_price, [dbo].[order_detail].quantity
					FROM [dbo].[order], [dbo].[book], [dbo].[order_detail]
					WHERE [dbo].[order].code = [dbo].[order_detail].[order_code]
					AND [dbo].[order_detail].book_id= [dbo].[book].id
					AND [dbo].[order].status >= 2
					AND [dbo].[order].status <= 3
					AND [dbo].[order].code = '".$row['code']."'";
				$stmt1 = sqlsrv_query( $this->order_conn, $query2 );
				if( $stmt1 === false) {
					echo "Khong ton tai";
				    die( print_r( sqlsrv_errors(), true) );
				}
				$row['detail']=array();
				while( $row1 = sqlsrv_fetch_array( $stmt1, SQLSRV_FETCH_ASSOC) ) {
					$row['detail'][] = $row1;
				}
				$result[] = $row;

			}
			
			return $result;
		}

		function complete()
		{
			$query= "SELECT [dbo].[order].*, [dbo].[customer].id as customer_id, [dbo].[customer].name as customer_name , [dbo].[site].name as site_name
				FROM [dbo].[order], [dbo].[customer], [dbo].[site]
				WHERE [dbo].[order].customer_id = [dbo].[customer].id
				AND [dbo].[site].id= [dbo].[order].site_id
				AND [dbo].[order].status = 4";

			

			$stmt = sqlsrv_query( $this->order_conn, $query );
			if( $stmt === false) {
				echo "Khong ton tai";
			    die( print_r( sqlsrv_errors(), true) );
			}
			$result = array();
			while( $row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC) ) {
				$query2 = "SELECT [dbo].[book].name as book_name ,[dbo].[order_detail].price as book_price, [dbo].[order_detail].quantity
					FROM [dbo].[order], [dbo].[book], [dbo].[order_detail]
					WHERE [dbo].[order].code = [dbo].[order_detail].[order_code]
					AND [dbo].[order_detail].book_id= [dbo].[book].id
					AND [dbo].[order].status = 4
					AND [dbo].[order].code = '".$row['code']."'";
				$stmt1 = sqlsrv_query( $this->order_conn, $query2 );
				if( $stmt1 === false) {
					echo "Khong ton tai";
				    die( print_r( sqlsrv_errors(), true) );
				}
				$row['detail']=array();
				while( $row1 = sqlsrv_fetch_array( $stmt1, SQLSRV_FETCH_ASSOC) ) {
					$row['detail'][] = $row1;
				}
				$result[] = $row;

			}
			
			return $result;
		}

		function updateStatusConfirmDelivery($code)
		{
			$query="UPDATE [dbo].[order] SET [dbo].[order].status= 2 WHERE [dbo].[order].code = '".$code."'";
			$result = sqlsrv_query($this->order_conn, $query);
			return $result;
		}

		function updateStatusCompleteDelivery($code)
		{
			$query="UPDATE [dbo].[order] SET [dbo].[order].status= 4 WHERE [dbo].[order].code = '".$code."'";
			$result = sqlsrv_query($this->order_conn, $query);
			return $result;
		}

		function cancelDelivery($code)
		{
			// Tăng số lượng product của đơn hàng bị hủy trong kho
			$query3 = "SELECT * FROM [dbo].[order_detail] WHERE [dbo].[order_detail].order_code = '".$code."'";
			$stmt3 = sqlsrv_query( $this->order_conn, $query3);
			$order_details=array();
			while( $row1 = sqlsrv_fetch_array( $stmt3, SQLSRV_FETCH_ASSOC) ) {
				$order_details[] = $row1;
			}
			foreach ($order_details as $key => $value) {
				$query4 = "UPDATE [dbo].[site_book] SET [dbo].[site_book].quantity = [dbo].[site_book].quantity+[dbo].[order_detail].quantity
					FROM [dbo].[order], [dbo].[site_book], [dbo].[order_detail]
					WHERE [dbo].[order].[site_id] = [dbo].[site_book].[site_id]
					AND [dbo].[order_detail].book_id = [dbo].[site_book].book_id
					AND [dbo].[order].code = [dbo].[order_detail].[order_code]
					AND [dbo].[order].code = '".$value['order_code']."'";
					$stmt4 = sqlsrv_query( $this->order_conn, $query4);
			}
			//Xóa trong bảng order
			$query1= "DELETE FROM [dbo].[order] WHERE [dbo].[order].code = '".$code."'";
			$stmt1= sqlsrv_query($this->order_conn, $query1);
			//Xóa trong bảng order_detail
			$query2= "DELETE FROM [dbo].[order_detail] WHERE [dbo].[order_detail].order_code = '".$code."'";
			$stmt2 = sqlsrv_query( $this->order_conn, $query2);
			if( $stmt1 === false || $stmt2 === false) {
				die( print_r( sqlsrv_errors(), true));
			}
			return true;
		}

		function getYear()
		{
			$query= "SELECT DISTINCT YEAR([dbo].[order].created_date) as year
					FROM [dbo].[order]";
			$stmt = sqlsrv_query( $this->order_conn, $query );
			if( $stmt === false) {
				echo "Khong ton tai";
			    die( print_r( sqlsrv_errors(), true) );
			}
			$result = array();
			while( $row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC) ) {
				$result[] = $row ;
			}

			return $result;
		}
	}
?>