<?php 
	include_once 'models/Book.php';
	include_once 'models/Site.php';
	include_once 'models/Type.php';
	include_once 'models/Publisher.php';
	include_once 'models/Author.php';

	/**
	 * 
	 */
	class BookController
	{
		var $book_model;
		var $site_model;
		var $type_model;
		var $publisher_model;
		var $author_model;
		function __construct()
		{
			$this->book_model = new Book();
			$this->site_model = new Site();
			$this->type_model = new Type();
			$this->publisher_model = new Publisher();
			$this->author_model = new Author();
		}

		public function index()
		{
			$books= $this->book_model->list();
			$sites = $this->site_model->list();
			require_once('views/admin/book/index.php');
		}

		function list()
		{
			$users= $this->book_model->list();
			require_once 'views/admin/index.php';
		}

		function create()
		{
			$types = $this->type_model->list();
			$authors = $this->author_model->list();
			$publishers = $this->publisher_model->list();
			require_once 'views/admin/book/create.php';
		}

		function store()
		{
			$data = $_POST;
			$data['description'] = strip_tags($data['description']);
			
			// var_dump($data);
			// die();
			// print_r($data);
			// die();
			$book = $this->book_model->insert($data);
			if ($book) {
				setcookie('msg3','Thêm mới thành công',time()+5);
			} 
			header('Location:?mod=admin&act=book');
		}

		function edit()
		{
			$id=$_GET['id'];
			$admin=$this->book_model->find($id);
			require_once('views/admin/edit.php');
		}

		function update(){
			$data=$_POST;
			// var_dump('hfjfjf');
			$id=$_GET['id'];
			$admin = $this->book_model->update($data,$id);
			if ($admin==1) {
				setcookie('msg','Cập nhật thành công',time()+5);
			} else {
				setcookie('msg','Cập nhật không thành công',time()+5);
			}
			header('Location:?mod=admin&act=list');
		}

		function delete()
		{
			$id=$_GET['id'];
			$user= $this->book_model->delete($id);
			echo json_encode([
	        	'data' => null,
	        	'status' => $user,
	      	]); 
		}

		function bookAddQuantity()
		{
			$id =$_GET['id'];
			$result = $this->book_model->find($id);
			require_once('views/admin/book/add_quantity_book.php');
			// $quantity = $_POST['quantity'];
			// $book_id = $_POST['book_id'];
			// print_r($quantity);
			// print_r($result);
			// die();
			// $result = $this->book_model->ajaxInforBookForAddQuantity($book_id,$quantity);
			// if($result) {
			// 	echo json_encode([
		 //        	'data' => null,
		 //        	'status' => 'true',
	  //     		]);
	  //     		exit();
			// }
			// echo json_encode([
	  //       	'data' => null,
	  //       	'status' => 'false',
   //    		]);
			
		}

		public function updateQuantity()
		{
			$data = $_POST;
			$result = $this->book_model->ajaxInforBookForAddQuantity($data['idaddquantity'],$data['quantityadd']);
			if ($result) {
				setcookie('updateQuantityBookSuccess','Cập nhật thành công',time()+5);
			} else {
				setcookie('updateQuantityBookFail','Cập nhật không thành công',time()+5);
			}
			header('Location:?mod=admin&act=book');

		}
	}
 ?>