<?php
 
 $dataPoints = array(
	array("x" => 946665000000, "y" => 12),
	array("x" => 978287400000, "y" => 1),
	array("x" => 1009823400000, "y" => 2),
	array("x" => 1041359400000, "y" => 3),
	array("x" => 1072895400000, "y" => 4),
	array("x" => 1104517800000, "y" => 5),
	array("x" => 1136053800000, "y" => 6),
	array("x" => 1167589800000, "y" => 7),
	array("x" => 1199125800000, "y" => 8),
	array("x" => 1230748200000, "y" => 9),
	array("x" => 1262284200000, "y" => 10),
	array("x" => 1293820200000, "y" => 11),
	array("x" => 1325356200000, "y" => 12),
	array("x" => 1356978600000, "y" => 13),
	array("x" => 1388514600000, "y" => 14),
	array("x" => 1420050600000, "y" => 15),
	array("x" => 1451586600000, "y" => 16)
 );
 
?>
<?php 
	include_once 'views/layout/admin/header.php';
?>
<script>
	window.onload = function () {
		var revenueSite =JSON.parse( '<?php echo json_encode($revenueSites); ?>' );
		var chart1 = new CanvasJS.Chart("chartContainerColumn", {
		title:{
			text: "Doanh số công ty tại các chi nhánh"              
		},
		
		
		data: [              
		{
			// Change type to "doughnut", "line", "splineArea", etc.
			type: "column",
			
			dataPoints: <?php echo json_encode($revenueSites); ?>
		}
		],
		axisY:{
	      suffix: "VND"
	    } 
	});
	chart1.render();
	 
	// var chart = new CanvasJS.Chart("chartContainer", {
	// 	animationEnabled: true,
	// 	title:{
	// 		text: "Company Revenue by Year"
	// 	},
	// 	axisY: {
	// 		title: "Revenue in USD",
	// 		valueFormatString: "#0,,.",
	// 		suffix: "mn",
	// 		prefix: "$"
	// 	},
	// 	data: [{
	// 		type: "spline",
	// 		markerSize: 5,
	// 		xValueFormatString: "YYYY",
	// 		yValueFormatString: "$#,##0.##",
	// 		xValueType: "dateTime",
	// 		dataPoints: <?php echo json_encode($dataPoints, JSON_NUMERIC_CHECK); ?>
	// 	}]
	// });
	 
	// chart.render();
	 
	}
</script>
<div class="right_col" role="main" id="order-wait-section">
        <div class="">
	            <div class="page-title">
	              	<div class="title_left">
	                	<h3>Thống kê</h3>
	              	</div>

	              	<div class="title_right">
		                <div class="col-md-5 col-sm-5 col-xs-12 form-group pull-right top_search">
			                <div class="input-group">
			                    <input type="text" class="form-control" placeholder="Tìm kiếm...">
			                    <span class="input-group-btn">
			                      <button class="btn btn-default" type="button"><i class="fa fa-arrow-circle-right"></i></button>
			                    </span>
			                </div>
		                </div>
	             	</div>
	            </div>

            <div class="clearfix"></div>
			<div>
				<div id="chartContainerColumn" style="height: 370px; width: 100%;"></div>
			</div>
            <div class="row" style="margin-top: 20px;">
              	<div class="col-md-3">
              		<select class="select2_single form-control" tabindex="-1" name="site_id">
              			<option value="">All</option>
	                    <?php foreach ($sites as $key => $value): ?>
	                      	<option value="<?= $value['id']?>"><?= $value['name']?></option>
	                    <?php endforeach ?>
	                 </select>
              	</div>
              	<div class="col-md-3">
              		<select class="select2_single form-control" tabindex="-1" name="publisher">
	                    
	                      <option value="1">1</option>
	                    
	                  </select>
              	</div>
              	<div class="col-md-3">
              		<select class="select2_single form-control" tabindex="-1" name="publisher">
	                    
	                      <option value="2">2</option>
	                    
	                </select>
              	</div>
              	<div class="col-md-2">
              		<button class="btn btn-info">Thống kê</button>
              	</div>
            </div>
            
            <div id="chartContainer" style="height: 370px; width: 100%;"></div>
        </div>
</div>

<?php 
	include_once 'views/layout/admin/footer.php';
?>
<script src="public/admin/js/canvasjs.min.js"></script>


