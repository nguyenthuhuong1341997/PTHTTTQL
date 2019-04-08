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
		var chart1 = new CanvasJS.Chart("chartContainerColumn", {
		title:{
			text: "Doanh số công ty tại các chi nhánh",
			fontWeight: "normal",
			fontFamily: "arial"           
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
	 
	var chart = new CanvasJS.Chart("chartContainer", {
		animationEnabled: true,
		title:{
			text: "Thu nhập theo hàng năm của từng chi nhánh",
			fontWeight: "normal",
			fontFamily: "arial"
		},
		axisY: {
			title: "VND",
			suffix: "VND"
		},
		axisX: {
			title: "Tháng",
		},
		data: [{
			type: "spline",
			markerSize: 5,
			dataPoints: <?php echo json_encode($revenueYears); ?>
		}]
	});
	 
	chart.render();
	 
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

			<form action="?mod=admin&act=statistical" method="POST">
	            <div class="row" style="margin: 20px 0px;">
	              	<div class="col-md-3">
	              		<p>Chi nhánh</p>
	              		<select class="select2_single form-control" tabindex="-1" name="site_id">
		                    <?php foreach ($sites as $key => $value): ?>
		                    	<?php if ($key == $site_id): ?>
		                    		<option value="<?= $value['id']?>" selected="true"><?= $value['name']?></option>
		                    	<?php else: ?>
		                    		<option value="<?= $value['id']?>"><?= $value['name']?></option>
		                    	<?php endif ?>
		                      	
		                    <?php endforeach ?>
		                 </select>
	              	</div>
	              	<div class="col-md-3">
	              		<p>Năm</p>
	              		<select class="select2_single form-control" tabindex="-1" name="year">
		                    	<?php foreach ($years as $key => $value): ?>
		                    		<?php if ($key == $site_id): ?>
		                    		<option value="<?= $value['year']?>" selected="true"><?= $value['year']?></option>
		                    	<?php else: ?>
		                    		<option value="<?= $value['year']?>"><?= $value['year']?></option>
		                    	<?php endif ?>
		                    		
		                    	<?php endforeach ?>
		                  </select>
	              	</div>
	              	
	              	<div class="col-md-2">
	              		<p> </p>
	              		<button class="btn btn-info" name="revenue" style="margin-top: 19px;">Thống kê</button>
	              	</div>
	            </div>
			</form>
            
            <div id="chartContainer" style="height: 370px; width: 100%;"></div>
        </div>
</div>

<?php 
	include_once 'views/layout/admin/footer.php';
?>
<script src="public/admin/js/canvasjs.min.js"></script>


