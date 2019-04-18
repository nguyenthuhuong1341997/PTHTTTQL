<?php
include_once 'models/Book.php';
include_once 'models/Order.php';

/**
 *
 */
class OrderController {
	var $book_model;
	var $order_model;
	function __construct() {
		$this->book_model = new Book();
		$this->order_model = new Order();
	}

	public function index() {
		$orders = $this->order_model->list();
		$completeOrders = $this->order_model->complete();
		$waitOrders = $this->order_model->delivery();
		require_once 'views/admin/order/index.php';
	}

	public function confirmDelivery() {
		$order_code = $_GET['id'];
		$result = $this->order_model->updateStatusConfirmDelivery($order_code);

		// print_r($result);
		// die();
		if ($result) {
			setcookie('updateStatusConfirmDeliverySuccess', 'Đơn hàng đang được giao', time() + 10);
		} else {
			setcookie('updateStatusConfirmDeliveryFail', 'Đơn hàng chưa được giao', time() + 10);
		}

		header('Location:?mod=admin&act=order');
	}

	public function backToOrder() {
		$order_code = $_GET['id'];
		$result = $this->order_model->updateStatusCancelDelivery($order_code);

		// print_r($result);
		// die();
		if ($result) {
			setcookie('updateStatusCancelDelivery', 'Đơn hàng quay về chưa đc giao', time() + 10);
		} else {
			setcookie('updateStatusCancelDeliveryFail', 'Đơn hàng lỗi', time() + 10);
		}

		header('Location:?mod=admin&act=order');
	}

	public function confirmComplete() {
		$order_code = $_GET['id'];
		$result = $this->order_model->updateStatusCompleteDelivery($order_code);
		if ($result) {
			setcookie('updateStatusCompleteDeliverySuccess', 'Đơn hàng đã hoàn thành', time() + 10);
		} else {
			setcookie('updateStatusCompleteDeliveryFail', 'Đã hủy đơn hàng', time() + 10);
		}

		header('Location:?mod=admin&act=order');
	}

	public function cancelDelivery() {
		$order_code = $_GET['id'];
		$result = $this->order_model->cancelDelivery($order_code);
		if ($result == 1) {
			setcookie('cancelDeliverySuccess', 'Đơn hàng đã hoàn thành', time() + 10);
		} else {
			setcookie('cancelDeliveryFail', 'Đã hủy đơn hàng', time() + 10);
		}

		header('Location:?mod=admin&act=order');
	}
}
?>