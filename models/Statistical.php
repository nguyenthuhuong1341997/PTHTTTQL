<?php 
	include_once 'Connection.php';
	/**
	 * 
	 */
	class Statistical
	{
		var $statistical_conn;
		function __construct()
		{
			$object= new Connection();
			$this->statistical_conn= $object->conn;
		}

		function revenueSite()
		{
			$query= "SELECT b_table.total as y, [dbo].[site].name as label
					FROM [dbo].[site], (SELECT a_table.site_id, SUM(a_table.total)AS total
										FROM (SELECT [dbo].[order].code , ord_detail_table.total , [dbo].[order].site_id as site_id
												FROM [dbo].[order], (SELECT [dbo].[order_detail].order_code, SUM([dbo].[order_detail].price*[dbo].[order_detail].quantity) AS total
																	FROM [dbo].[order_detail]
																	GROUP BY [dbo].[order_detail].order_code) AS ord_detail_table
												WHERE [dbo].[order].code = ord_detail_table.order_code) AS a_table
										GROUP By a_table.site_id) AS b_table
					WHERE [dbo].[site].id = b_table.site_id";

			$stmt = sqlsrv_query( $this->statistical_conn, $query );
			if( $stmt === false) {
				echo "Khong ton tai";
			    die( print_r( sqlsrv_errors(), true) );
			}
			$result = array();
			while( $row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC) ) {
				$result[] = $row;

			}
			
			return $result;
		}

		function revenueYear($site_id, $year)
		{
			$query = "SELECT total_month_year.month as x, SUM(total) as y
					FROM (SELECT [dbo].[order].code, [dbo].[order].site_id , ord_detail_table.total , YEAR([dbo].[order].created_date) as year, MONTH([dbo].[order].created_date) as month
						FROM [dbo].[order], (SELECT [dbo].[order_detail].order_code, SUM([dbo].[order_detail].price*[dbo].[order_detail].quantity) AS total
											FROM [dbo].[order_detail]
											GROUP BY [dbo].[order_detail].order_code) AS ord_detail_table
						WHERE [dbo].[order].code = ord_detail_table.order_code) AS total_month_year
					WHERE total_month_year.site_id = ".$site_id."
					AND total_month_year.year = ".$year."
					GROUP BY year, month";
			$stmt = sqlsrv_query( $this->statistical_conn, $query );
			if( $stmt === false) {
				echo "Khong ton tai";
			    die( print_r( sqlsrv_errors(), true) );
			}
			$result = array();
			while( $row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC) ) {
				$result[] = $row;

			}
			
			return $result;
		}
	}
?>