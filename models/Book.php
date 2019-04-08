<?php
include_once 'Connection.php';
/**
 *
 */
class Book {
	var $book_conn;
	function __construct() {
		$object = new Connection();
		$this->book_conn = $object->conn;
	}

	function list() {
		$query = "SELECT b.*,
				a.[name] AS author_name,
				p.[name] as publisher_name,
				t.[name] as [type_name]
				FROM [dbo].[book] b
				join dbo.[type] t on t.[id]= b.[type_id]
				join dbo.[publisher] p on p.[id]= b.publisher_id
				join dbo.[author] a on a.[id]= b.author_id
				order by b.[id] desc";

		$stmt = sqlsrv_query($this->book_conn, $query);
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

	function find($code) {
		$query = "SELECT [dbo].[book].*,
						[dbo].[author].[name] AS author_name,
						[dbo].[publisher].[name] as publisher_name,
						[dbo].[type].[name] as type
					FROM [dbo].[book], [dbo].[author], [dbo].[publisher],[dbo].[type]
					where [dbo].[type].[id]= [dbo].[book].[type_id]
					AND [dbo].[author].[id]= [dbo].[book].[author_id]
					AND [dbo].[publisher].[id]= [dbo].[book].[publisher_id]
					AND [dbo].[book].[code] = '" . $code . "'";

		$stmt = sqlsrv_query($this->book_conn, $query);
		if ($stmt === false) {
			echo "Khong ton tai";
			return null;
		}
		$result = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC);

		return $result;
	}
	function findQuantitySite($code) {
		$sql = "select b.code, s.name, s.code, sb.quantity from dbo.book b
				join dbo.site_book sb on sb.book_id = b.id
				join dbo.[site] s on s.id = sb.site_id
				where b.code = '" . $code . "'";
		$stmt = sqlsrv_query($this->book_conn, $sql);
		$result = array();
		while ($row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC)) {
			$result[] = $row;
		}
		return $result;
	}

	function ajaxInforBookForAddQuantity($book_id, $quantity) {
		$query = "SELECT * FROM [dbo].[site_book] WHERE [dbo].[site_book].book_id =" . $book_id . " AND [dbo].[site_book].site_id = " . $_SESSION['user']['site_id'];
		$stmt = sqlsrv_query($this->book_conn, $query);

		if ($stmt) {
			$query2 = "INSERT INTO [dbo].[site_book](book_id,site_id, quantity)
						values(" . $book_id . ", " . $_SESSION['user']['site_id'] . "," . $quantity . ")";
			// print_r($query2);
			// die();
			$result = sqlsrv_query($this->book_conn, $query2);
			return $result;
		} else {

			$book_site;
			while ($row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC)) {
				$book_site = $row;

			}
			$book_site['quantity'] = $book_site['quantity'] + $quantity;
			$query3 = "UPDATE [dbo].[site_book]
						SET quantity = " . $book_site['quantity'] . "
						WHERE book_id =" . $book_id . " AND site_id = " . $_SESSION['user']['site_id'];
			$result = sqlsrv_query($this->book_conn, $query3);
			return $result;
		}
	}

	function insert($data) {
		$query = "INSERT INTO [dbo].[book](code,name, price, type_id, author_id,publisher_id,image, description)
				values('" . $data['code'] . "',N'" . $data['name'] . "'," . $data['price'] . "," . $data['type'] . "," . $data['author'] . "," . $data['publisher'] . ",'" . $data['image'] . "',N'" . $data['description'] . "')";
		$result = sqlsrv_query($this->book_conn, $query);
		return $result;
	}

	function update($data) {
		$query = "UPDATE [dbo].[book] SET name=N'" . $data['name'] . "',price=" . $data['price'] . ",type_id=" . $data['type'] . ",author_id=" . $data['author'] . ",publisher_id=" . $data['publisher'] . ",image='" . $data['image'] . "',description=N'" . $data['description'] . "' WHERE code='" . $data['code'] . "'";
		$result = sqlsrv_query($this->book_conn, $query);
		return $result;
	}

	function delete($code) {
		$query = "DELETE FROM [dbo].[book] WHERE code='" . $code . "'";
		$result = sqlsrv_query($this->book_conn, $query);
		return $result;
	}

	function checkpassword($id, $password) {
		$query = "SELECT * FROM users WHERE password='" . md5($password) . "' AND id= " . $id;

		$result = $this->book_conn->query($query)->fetch_assoc();

		return $result;
	}

	function editpassword($id, $password) {
		$query = "UPDATE users SET password='" . md5($password) . "'WHERE id=" . $id;
		print_r($query);
		$result = $this->book_conn->query($query);
		return $result;
	}

	function insertWorkingDay($date, $user) {

		$query = "INSERT INTO users_working_days(user, workingday)
				values('" . $user . "','" . $date . "')";
		print_r($query);
		$result = $this->book_conn->query($query);
		return $result;
	}
}
?>