<?php
include_once 'Connection.php';
/**
 *
 */
class Statistical {
	var $statistical_conn;
	function __construct() {
		$object = new Connection();
		$this->statistical_conn = $object->conn;
	}

	function revenueSite() {
		$query = "SELECT b_table.total as y, [dbo].[site].name as label
					FROM [dbo].[site], (SELECT a_table.site_id, SUM(a_table.total)AS total
										FROM (SELECT [dbo].[order].code , ord_detail_table.total , [dbo].[order].site_id as site_id
												FROM [dbo].[order], (SELECT [dbo].[order_detail].order_code, SUM([dbo].[order_detail].price*[dbo].[order_detail].quantity) AS total
																	FROM [dbo].[order_detail]
																	GROUP BY [dbo].[order_detail].order_code) AS ord_detail_table
												WHERE [dbo].[order].code = ord_detail_table.order_code) AS a_table
										GROUP By a_table.site_id) AS b_table
					WHERE [dbo].[site].id = b_table.site_id";

		$stmt = sqlsrv_query($this->statistical_conn, $query);
		if ($stmt === false) {
			echo "Khong ton tai";
			die(print_r(sqlsrv_errors(), true));
		}
		$result = array();
		while ($row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC)) {
			$result[] = $row;

		}

		return $result;
	}

	function revenueYear($site_id, $year) {
		$query = "SELECT total_month_year.month as x, SUM(total) as y
					FROM (SELECT [dbo].[order].code, [dbo].[order].site_id , ord_detail_table.total , YEAR([dbo].[order].created_date) as year, MONTH([dbo].[order].created_date) as month
						FROM [dbo].[order], (SELECT [dbo].[order_detail].order_code, SUM([dbo].[order_detail].price*[dbo].[order_detail].quantity) AS total
											FROM [dbo].[order_detail]
											GROUP BY [dbo].[order_detail].order_code) AS ord_detail_table
						WHERE [dbo].[order].code = ord_detail_table.order_code) AS total_month_year
					WHERE total_month_year.site_id = " . $site_id . "
					AND total_month_year.year = " . $year . "
					GROUP BY year, month";
		$stmt = sqlsrv_query($this->statistical_conn, $query);
		if ($stmt === false) {
			echo "Khong ton tai";
			die(print_r(sqlsrv_errors(), true));
		}
		$result = array();
		while ($row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC)) {
			$result[] = $row;

		}

		return $result;
	}
	function getTopSale() {
		$s = $_SESSION['user']['rcode'] != 'ROLE_BOSS' ? 'where o.site_id = ' . $_SESSION['user']['site_id'] : '';
		$query = "select b.code, b.name, CAST(b.[image] AS NVARCHAR(1000)) as image, b.price, sum(od.quantity) as total_quantity, count(b.code) as total_count, o.site_id
			from dbo.[order] o
			join dbo.[order_detail] od on od.order_code = o.code
			join dbo.[book] b on od.book_id = b.id
			" . $s . "
			group by b.code, b.name, CAST(b.[image] AS NVARCHAR(1000)), b.price, o.site_id order by total_count desc, total_quantity desc";

		$stmt = sqlsrv_query($this->statistical_conn, $query);
		if ($stmt === false) {
			echo "Khong ton tai";
			die(print_r(sqlsrv_errors(), true));
		}
		$result = array();
		while ($row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC)) {
			$result[] = $row;

		}
		return $result;
	}
	function getListOrderByBook($code, $site_id) {
		$s = $site_id == 0 ? '' : ' and o.site_id = ' . $site_id;
		$query = "select o.code, c.name, od.quantity * b.price as total_price, od.quantity, o.created_date, s.location
				from dbo.[book] b join dbo.[order_detail] od on od.book_id = b.id
				join dbo.[order] o on o.code = od.order_code
				join dbo.[site] s on s.id = o.site_id
				left join dbo.[customer] c on c.id = o.customer_id
				where b.code = '" . $code . "' " . $s;
		$stmt = sqlsrv_query($this->statistical_conn, $query);
		if ($stmt === false) {
			echo "Khong ton tai";
			die(print_r(sqlsrv_errors(), true));
		}
		$result = array();
		while ($row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC)) {
			$result[] = $row;

		}
		return $result;
	}
	function getListOrderByDate($from, $to, $site_selected, $status_selected) {
		$sitex = ($site_selected == null) || ($site_selected == 'null') ? '' : ' and s.id = ' . $site_selected;
		$query = "select o.code, o.sale_type, c.name, o.created_date, s.location, sum(od.price * od.quantity) as total_price, sum(od.quantity) as total_quantity from dbo.[order] o
			left join dbo.[site] s on o.site_id = s.id
			left join dbo.[customer] c on o.customer_id = c.id
			inner join dbo.[order_detail] od on o.code = od.order_code
			where CONVERT(DATE, o.created_date) >= '" . $from . "' and CONVERT(DATE, o.created_date) <= '" . $to . "' and o.status = " . $status_selected .
			$sitex .
			" group  by o.code, o.sale_type, o.status, o.created_date, s.location, c.name order by o.created_date desc";

		$stmt = sqlsrv_query($this->statistical_conn, $query);
		if ($stmt === false) {
			echo "Khong ton tai";
			die(print_r(sqlsrv_errors(), true));
		}
		$result = array();
		while ($row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC)) {
			$result[] = $row;

		}
		return $result;
	}
	function findOrderDetail($code) {
		$sql = "SELECT b.name, CAST(b.[image] AS NVARCHAR(1000)) as image, od.quantity, od.price, (od.quantity * od.price) as total_price FROM [dbo].[order_detail] od inner join dbo.book b on od.book_id = b.id where od.order_code = '" . $code . "'";
		$stmt = sqlsrv_query($this->statistical_conn, $sql);
		$data = array();
		while ($row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC)) {
			$data[] = $row;
		}
		return $data;
	}
	function statisticalStaff() {
		$sql = "select x.created_by, u.name, u.username, count(x.created_by) as total_order, sum(x.total_price) as total_price,
			sum(x.total_quantity) as total_quantity, sum(x.total_book) as total_book, s.location from
			(
			select o.code, o.created_by, sum(od.quantity*od.price) as total_price, sum(od.quantity) as total_quantity, count(od.book_id) as total_book
			from dbo.[order] o inner join dbo.[order_detail] od on od.order_code = o.code
			group by o.code, o.created_by
			) as x
			join dbo.[user] u on u.id = x.created_by
			join dbo.[site] s on s.id = u.site_id
			where x.created_by is not null group by x.created_by, u.name, u.username, s.location";
		$stmt = sqlsrv_query($this->statistical_conn, $sql);
		$data = array();
		while ($row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC)) {
			$data[] = $row;
		}
		return $data;
	}
	function getOrdersByUser($username) {
		$sql = "select o.code, u.username, o.sale_type, c.name, o.created_date, s.location, sum(od.price * od.quantity) as total_price, sum(od.quantity) as total_quantity from dbo.[order] o
			left join dbo.[site] s on o.site_id = s.id
			left join dbo.[customer] c on o.customer_id = c.id
			inner join dbo.[order_detail] od on o.code = od.order_code
			inner join dbo.[user] u on u.id = o.created_by
			where u.username = '" . $username . "'
			group  by o.code, o.sale_type, o.status, o.created_date, s.location, c.name, u.username order by o.created_date desc";
		$stmt = sqlsrv_query($this->statistical_conn, $sql);
		$data = array();
		while ($row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC)) {
			$data[] = $row;
		}
		return $data;
	}
}
?>