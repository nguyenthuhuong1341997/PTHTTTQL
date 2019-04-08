<?php 
	include_once 'models/Statistical.php';
	include_once 'models/Site.php';
	include_once 'models/Order.php';

	/**
	 * 
	 */
	class StatisticalController
	{
		var $statistical_model;
		var $site_model;
		var $order_model;
		function __construct()
		{
			$this->statistical_model = new Statistical();
			$this->site_model = new Site();
			$this->order_model = new Order();
		}

		public function index()
		{
			$years = $this->order_model->getYear();
			$sites = $this->site_model->list();
			$year = $years[0]['year'];
			$site_id = key($sites);

			if(isset($_POST['revenue'])){
				$year = $_POST['year'];
				$site_id = $_POST['site_id'];
			}
			$revenueSites = $this->statistical_model->revenueSite();
			$revenueYears = $this->statistical_model->revenueYear($site_id, $year);

			// print_r($revenueYears);
			// die();

			require_once('views/admin/statistical/index.php');
		}

		
	}
 ?>