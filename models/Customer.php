<?php
include_once 'Connection.php';
/**
 *
 */
class Customer {
	var $customer_conn;
	function __construct() {
		$object = new Connection();
		$this->customer_conn = $object->conn;
	}

	function list($type) {
		$join = ($type != 0) ? "inner join dbo.[order] o on c.id = o.customer_id
				inner join dbo.[site] s on s.id = o.site_id
				where s.id = " . $type . "
				group by c.id, c.code, c.name, c.address, c.email, c.phone, c.username  " : "";
		$query = "select c.id, c.code, c.name, c.address, c.email, c.phone, c.username
				from dbo.[customer] c " . $join;
		$query .= ' order by c.id desc';
		$stmt = sqlsrv_query($this->customer_conn, $query);
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

	function findByUsername($username) {
		$sql = "select * from dbo.[customer] where username = '" . $username . "'";
		$stmt = sqlsrv_query($this->customer_conn, $sql);
		$result = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC);
		return $result;
	}

	function insert($data) {
		$sql = "insert into dbo.[customer] (code, name, address, phone, email, username, password, created_by) values(?,?,?,?,?,?,?,?)";
		$stmt = sqlsrv_query($this->customer_conn, $sql, array($data['code'], $data['name'], $data['address'], $data['phone'], $data['email'], $data['username'], md5($data['password']), $data['created_by']));
		return $stmt;
	}

	function find($code) {
		$query = "SELECT c.* from [dbo].[customer] c where c.code = '" . $code . "'";
		$stmt = sqlsrv_query($this->customer_conn, $query);
		if (!$stmt) {
			echo "Khong ton tai";
			die(print_r(sqlsrv_errors(), true));
		}
		$result = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC);
		return $result;
	}

	function update($data) {
		$query = "UPDATE [dbo].[customer] SET name = ?, address = ?, phone = ?, email = ?, username = ?, password = ? WHERE code = ?";
		$stmt = sqlsrv_query($this->customer_conn, $query, array($data['name'], $data['address'], $data['phone'], $data['email'], $data['username'], $data['password'], $data['code']));
		if (!$stmt) {
			echo "Khong ton tai";
			die(print_r(sqlsrv_errors(), true));
		}
		return $stmt;
	}

	function delete($code) {
		$query = "DELETE FROM [dbo].[customer] WHERE code = '" . $code . "'";
		$stmt = sqlsrv_query($this->customer_conn, $query);
		if (!$stmt) {
			echo "Khong ton tai";
			die(print_r(sqlsrv_errors(), true));
		}
		return $stmt;
	}
}
?>