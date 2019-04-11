<?php
include_once 'models/Book.php';
include_once 'models/Site.php';
include_once 'models/Type.php';
include_once 'models/Publisher.php';
include_once 'models/Author.php';

/**
 *
 */
class BookController {
	var $book_model;
	var $site_model;
	var $type_model;
	var $publisher_model;
	var $author_model;
	function __construct() {
		$this->book_model = new Book();
		$this->site_model = new Site();
		$this->type_model = new Type();
		$this->publisher_model = new Publisher();
		$this->author_model = new Author();
	}

	public function index() {
		$books = $this->book_model->list();
		$sites = $this->site_model->list();
		require_once 'views/admin/book/index.php';
	}

	function list() {
		$users = $this->book_model->list();
		require_once 'views/admin/index.php';
	}

	function create() {
		$types = $this->type_model->list();
		$authors = $this->author_model->list();
		$publishers = $this->publisher_model->list();
		require_once 'views/admin/book/create.php';
	}

	function store() {
		$data = $_POST;
		$data['description'] = strip_tags($data['description']);
		$book = $this->book_model->find($data['code']);
		if ($book != null) {
			echo json_encode(false);
			return;
		} else {
			if (!empty($_FILES['image']['name']) && $_FILES['image']['size'] != 0) {
				if ($_FILES['image']['error'] > 0) {
					echo "lỗi";
				} else {
					move_uploaded_file($_FILES['image']['tmp_name'], '../upload/' . $_FILES['image']['name']);
					$st = $_FILES['image']['name'];
					$data['image'] = $st;
				}
			} else {
				$data['image'] = null;
			}

			$book = $this->book_model->insert($data);
			if ($book) {
				if ($this->book_model->insertQuantitySite($data['code'], 'SITE_HANOI', $data['site_hn'])
					&& $this->book_model->insertQuantitySite($data['code'], 'SITE_DANANG', $data['site_dn'])
					&& $this->book_model->insertQuantitySite($data['code'], 'SITE_SAIGON', $data['site_sg'])
				) {
					setcookie('msg3', 'Thêm mới thành công', time() + 5);
					echo json_encode(true);
				}
			}
		}
	}

	function edit() {
		$code = $_GET['code'];
		$book = $this->book_model->find($code);
		$types = $this->type_model->list();
		$authors = $this->author_model->list();
		$publishers = $this->publisher_model->list();
		$site_book = $this->book_model->findQuantitySite($code);
		require_once 'views/admin/book/edit.php';
	}

	function update() {
		$data = $_POST;
		$code = $_POST['code'];
		$book = $this->book_model->find($code);
		if (empty($_FILES['image']['name']) && $_FILES['image']['size'] == 0) {
			$data['image'] = $book['image'];
		} else {
			if ($_FILES['image']['error'] > 0) {
				echo "lỗi";
			} else {
				move_uploaded_file($_FILES['image']['tmp_name'], '../upload/' . $_FILES['image']['name']);
				$st = $_FILES['image']['name'];
				$data['image'] = $st;
			}
		}
		$book1 = $this->book_model->update($data);
		if ($book1) {
			if ($this->book_model->updateQuantitySite($book['id'], 'SITE_HANOI', $data['SITE_HANOI'])
				&& $this->book_model->updateQuantitySite($book['id'], 'SITE_DANANG', $data['SITE_DANANG'])
				&& $this->book_model->updateQuantitySite($book['id'], 'SITE_SAIGON', $data['SITE_SAIGON'])
			) {
				setcookie('msg', 'Cập nhật thành công', time() + 5);
				header('Location:?mod=admin&act=book');
			}
		} else {
			setcookie('msg', 'Cập nhật không thành công', time() + 5);
		}
	}
	function findOne() {
		$code = $_GET['code'];
		$book = $this->book_model->find($code);
		$site_book = $this->book_model->findQuantitySite($code);
		echo json_encode([
			'book' => $book,
			'site_book' => $site_book,
		]);
	}
	function delete() {
		$code = $_GET['code'];
		$book = $this->book_model->delete($code);
		if ($book) {
			echo json_encode(true);
		} else {
			echo json_encode(false);
		}

	}

	function bookAddQuantity() {
		$code = $_GET['code'];
		$result = $this->book_model->find($code);
		$site_book = $this->book_model->findQuantitySite($code);
		require_once 'views/admin/book/add_quantity_book.php';
	}

	public function updateQuantity() {
		$data = $_POST;
		$result = $this->book_model->ajaxInforBookForAddQuantity($data['idaddquantity'], $data['quantityadd']);
		if ($result) {
			setcookie('updateQuantityBookSuccess', 'Cập nhật thành công', time() + 5);
			header('Location:?mod=admin&act=book');
		} else {
			setcookie('updateQuantityBookFail', 'Cập nhật không thành công', time() + 5);
			header('Location:?mod=admin&act=book&action=bookAddQuantity&code=' . $data['code']);
		}

	}
}
?>