<?php
session_start();

if (isset($_GET['mod'])) {
	$mod = $_GET['mod'];
} else {
	$mod = 'login';
}

if (isset($_GET['act'])) {
	$act = $_GET['act'];
} else {
	$act = '';
}

if (isset($_GET['action'])) {
	$action = $_GET['action'];
} else {
	$action = '';
}

switch ($mod) {
case 'admin':{
		include_once 'controllers/AdminController.php';
		$admin = new AdminController();
		include_once 'controllers/BookController.php';
		$book = new BookController();
		include_once 'controllers/OrderController.php';
		$order = new OrderController();
		include_once 'controllers/UserController.php';
		$user = new UserController();
		include_once 'controllers/StatisticalController.php';
		$statistical = new StatisticalController();
		if (isset($_SESSION['user'])) {
			$current_user = $_SESSION['user'];
		} else {
			header("location: ?mod=login");
		}
		switch ($act) {
		case '':
			$admin->index();
			break;
		case 'user':
			if ($current_user['rcode'] == 'ROLE_BOSS') {
				switch ($action) {
				case '':
					$user->index();
					break;
				case 'create':
					$user->create();
					break;
				case 'store':
					$user->store();
					break;
				case 'edit':
					$user->edit();
					break;
				case 'update':
					$user->update();
					break;
				case 'delete':
					$user->delete();
					break;
				default:
					# code...
					break;
				}
			} else {
				header("location: ?mod=admin");
			}
			break;
		case 'book':
			if ($current_user['rcode'] == 'ROLE_BOSS' || $current_user['rcode'] == 'ROLE_ADMIN') {
				switch ($action) {
				case '':
					$book->index();
					break;
				case 'create':
					if ($current_user['rcode'] == 'ROLE_BOSS') {
						$book->create();
					} else {
						header("location: ?mod=admin&act=book");
					}

					break;
				case 'store':
					if ($current_user['rcode'] == 'ROLE_BOSS') {
						$book->store();
					} else {
						header("location: ?mod=admin&act=book");
					}

					break;
				case 'edit':
					if ($current_user['rcode'] == 'ROLE_BOSS') {
						$book->edit();
					} else {
						header("location: ?mod=admin&act=book");
					}

					break;
				case 'update':
					if ($current_user['rcode'] == 'ROLE_BOSS') {
						$book->update();
					} else {
						header("location: ?mod=admin&act=book");
					}

					break;
				case 'find-one':
					$book->findOne();
					break;
				case 'delete':
					if ($current_user['rcode'] == 'ROLE_BOSS') {
						$book->delete();
					} else {
						header("location: ?mod=admin&act=book");
					}
					break;
				case 'bookAddQuantity':
					$book->bookAddQuantity();
					break;
				case 'updateQuantity':
					$book->updateQuantity();
					break;
				default:
					# code...
					break;
				}
			} else {
				header("location: ?mod=admin");
			}
			break;

		case 'order':
			switch ($action) {
			case '':
				$order->index();
				break;
			case 'delivery':
				$order->delivery();
				break;
			case 'complete':
				$order->complete();
				break;
			case 'confirmDelivery':
				$order->confirmDelivery();
				break;
			case 'confirmComplete':
				$order->confirmComplete();
				break;
			case 'cancelDelivery':
				$order->cancelDelivery();
				break;
			default:
				# code...
				break;
			}
			break;

		case 'statistical':{
				$statistical->index();
				break;
			}
		case 'abc':{
				$statistical->main();
				break;
			}
		default:

			break;
		}
		break;
	}
case 'login':{
		include_once 'controllers/AuthController.php';
		$auth = new AuthController();
		if (!isset($_SESSION['user'])) {
			switch ($act) {
			case '':
				$auth->login();
				break;
			case 'separation':
				$auth->separation();
				break;
			default:

				break;
			}
		} else {
			header("location: ?mod=admin");
		}
		break;

	}
case 'logout':{
		include_once 'controllers/AuthController.php';
		$auth = new AuthController();
		$auth->logout();
		break;
	}
default:
	# code...
	break;
}
?>
