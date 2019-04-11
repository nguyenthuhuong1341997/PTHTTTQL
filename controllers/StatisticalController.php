<?php
include_once 'models/Statistical.php';
include_once 'models/Site.php';
include_once 'models/Order.php';

/**
 *
 */
class StatisticalController {
	var $statistical_model;
	var $site_model;
	var $order_model;
	var $book_model;
	function __construct() {
		$this->book_model = new Book();
		$this->statistical_model = new Statistical();
		$this->site_model = new Site();
		$this->order_model = new Order();
	}

	public function index() {
		$years = $this->order_model->getYear();
		$sites = $this->site_model->list();
		$year = $years[0]['year'];
		$site_id = key($sites);

		if (isset($_POST['revenue'])) {
			$year = $_POST['year'];
			$site_id = $_POST['site_id'];
		}
		$revenueSites = $this->statistical_model->revenueSite();
		$revenueYears = $this->statistical_model->revenueYear($site_id, $year);

		// print_r($revenueYears);
		// die();

		require_once 'views/admin/statistical/index.php';
	}
	public function main() {
		$top_sale = $this->statistical_model->getTopSale();
		require_once 'views/admin/statistical/main.php';
	}
	public function orderInDate() {
		if (!isset($_GET['date'])) {
			$date_selected = date('Y-m-d');
		} else {
			$date_selected = $_GET['date'];
		}
		if (!isset($_GET['site'])) {
			$site_selected = null;
			if ($_SESSION['user']['rcode'] != 'ROLE_BOSS') {
				$site_selected = $_SESSION['user']['site_id'];
			}

		} else {
			$site_selected = $_GET['site'];
		}
		if (!isset($_GET['status'])) {
			$status_selected = 4;
		} else {
			$status_selected = $_GET['status'];
		}
		$sites = $this->site_model->list();
		$orders = $this->statistical_model->getListOrderByDate($date_selected, $site_selected, $status_selected);
		require_once 'views/admin/statistical/order_in_date.php';
	}
	public function getListOrderByBook() {
		$book = $this->book_model->find($_GET['code']);
		$site_id = $_SESSION['user']['rcode'] == 'ROLE_BOSS' ? 0 : $site_selected = $_SESSION['user']['site_id'];
		$oders = $this->statistical_model->getListOrderByBook($_GET['code'], $site_id);
		echo json_encode([
			'book' => $book,
			'orders' => $oders,
		]);
	}
	public function findOrderDetail() {
		$orders = $this->statistical_model->findOrderDetail($_GET['code']);
		echo json_encode($orders);
	}

}
?>