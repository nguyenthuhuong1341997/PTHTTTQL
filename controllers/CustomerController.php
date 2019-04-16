<?php
include_once 'models/Customer.php';

/**
 *
 */
class customerController {
	var $customer_model;
	var $site_model;
	function __construct() {
		$this->customer_model = new Customer();
		$this->site_model = new Site();
	}

	public function index() {
		$type = isset($_GET['type']) ? $_GET['type'] : 0;
		if ($_SESSION['user']['rcode'] != 'ROLE_BOSS' && $_SESSION['user']['site_id'] != $type) {
			header('Location:?mod=admin&act=customer');
		} else {
			$sites = $this->site_model->list();
			$customers = $this->customer_model->list($type);
			require_once 'views/admin/customer/index.php';
		}

	}

	public function create() {
		require_once 'views/admin/customer/create.php';
	}

	public function store() {
		$data = $_POST;
		if ($this->customer_model->findByUsername($data['username']) != null) {
			echo json_encode(false);
		} else {
			$data['code'] = "KH_" . date('Ymdhis');
			$data['created_by'] = $_SESSION['user']['code'];
			if ($this->customer_model->insert($data)) {
				echo json_encode(true);
			}

		}
	}

	public function edit() {
		$code = $_GET['code'];
		$customer = $this->customer_model->find($code);
		require_once 'views/admin/customer/edit.php';
	}

	public function update() {
		$data = $_POST;
		$cus = $this->customer_model->find($data['code']);
		if ($cus == null) {
			echo json_encode(false);
		} else {
			$data['password'] = ($data['password'] == null) ? $cus['password'] : md5($data['password']);
			if ($this->customer_model->update($data)) {
				echo json_encode(true);
			} else {echo json_encode(false);}
		}

	}

	public function delete() {
		$code = $_GET['code'];
		$customer = $this->customer_model->delete($code);
		if ($customer) {
			echo json_encode([
				'data' => null,
				'status' => 'true',
			]);
			exit();
		}
		echo json_encode([
			'data' => null,
			'status' => 'false',
		]);
	}
}
?>