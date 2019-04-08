<?php 
	include_once 'models/Statistical.php';
	include_once 'models/Site.php';

	/**
	 * 
	 */
	class StatisticalController
	{
		var $statistical_model;
		var $site_model;
		function __construct()
		{
			$this->statistical_model = new Statistical();
			$this->site_model = new Site();
		}

		public function index()
		{
			$revenueSites = $this->statistical_model->revenueSite();
			$sites = $this->site_model->list();
			require_once('views/admin/statistical/index.php');
		}

		
	}
 ?>