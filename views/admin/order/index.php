<?php
include_once 'views/layout/admin/header.php';
?>
<div class="right_col" role="main" id="order-wait-section">
        <div class="">
	            <div class="page-title">
	              	<div class="title_left">
	                	<h3>Quản Lý Đơn Đặt Hàng</h3>
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

            <div class="row">
              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  	<div class="x_title">
	                    <h2>Danh sách đơn đặt hàng chờ duyệt</h2>
	                    <ul class="nav navbar-right panel_toolbox">
	                      	<li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
	                      	</li>
	                      	<li class="dropdown">
		                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-wrench"></i></a>
		                        <ul class="dropdown-menu" role="menu">
			                        <li><a href="#">Settings 1</a>
			                        </li>
			                        <li><a href="#">Settings 2</a>
			                        </li>
		                        </ul>
	                      	</li>
		                    <li><a class="close-link"><i class="fa fa-close"></i></a>
		                    </li>
	                    </ul>
                    	<div class="clearfix"></div>
                  	</div>
                  	<div class="x_content">
	                  	<div class="row">
	                  		<div class="col-md-6">
	                  			<a href="?mod=admin&act=create" class="btn btn-success"><i class="fa fa-plus-circle"></i>Thêm mới</a>
	                  		</div>
	                  	</div>
	                    <table id="wait-order-table" class="table table-striped table-bordered">
	                      	<thead>
		                        <tr>
		                        	<th><input type="checkbox" onclick="toggle(this);" /></th>
		                          	<th>Mã đơn hàng</th>
		                          	<th>Tên khách hàng</th>
							        <th>Chi nhánh</th>
							        <th>Giỏ hàng</th>
							        <th>Tổng tiền</th>
							        <th></th>
		                        </tr>
	                      	</thead>
		                    <tbody>
		                      	<?php foreach ($orders as $order): ?>
							    	<tr id="<?php echo $order['id']; ?>">
							    		<td><input class="checkbox-working-day" value="<?=$order['id']?>" type="checkbox" /></td>
						    			<td><?=$order['code']?></td>
						    			<td><?=$order['customer_name']?></td>
								        <td><?=$order['site_name']?></td>
								        <td>
								        	<?php $total = 0;foreach ($order['detail'] as $detail): ?>
								        		<span><?=$detail['quantity']?> <?=$detail['book_name']?> </span> <br/>
								        			<?php $total += $detail['quantity'] * $detail['book_price']?>
								        	<?php endforeach?>
								        </td>
								        <td><?php echo number_format($total, 0) . "&nbsp;₫"; ?></td>
								        <td>
											<a href="?mod=admin&act=order&action=confirmDelivery&id=<?=$order['code']?>" class="btn btn-info" title="Giao hàng" ><i class="fa fa-check"></i></a>
											<a class="btn btn-warning" title="Chỉnh sửa đơn hàng" ><i class="fa  fa-wrench"></i></a>
											<a href="?mod=admin&act=order&action=cancelDelivery&id=<?=$order['code']?>" class="btn btn-danger delete" title="Hủy đơn hàng"><i class="fa fa-close"></i></a>
								        </td>
							      	</tr>
								<?php endforeach?>
		                    </tbody>
	                    </table>
                  	</div>
                </div>
              </div>
            </div>
        </div>
</div>

<div class="right_col" role="main" id="order-delivery-section">
        <div class="">
            <div class="clearfix"></div>

            <div class="row">
              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  	<div class="x_title">
	                    <h2>Danh sách đơn đặt hàng đang được giao</h2>
	                    <ul class="nav navbar-right panel_toolbox">
	                      	<li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
	                      	</li>
	                      	<li class="dropdown">
		                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-wrench"></i></a>
		                        <ul class="dropdown-menu" role="menu">
			                        <li><a href="#">Settings 1</a>
			                        </li>
			                        <li><a href="#">Settings 2</a>
			                        </li>
		                        </ul>
	                      	</li>
		                    <li><a class="close-link"><i class="fa fa-close"></i></a>
		                    </li>
	                    </ul>
                    	<div class="clearfix"></div>
                  	</div>
                  	<div class="x_content">

	                    <table id="order-delivery-table" class="table table-striped table-bordered">
	                      	<thead>
		                        <tr>
		                        	<th><input type="checkbox" onclick="toggle(this);" /></th>
		                          	<th>Mã đơn hàng</th>
		                          	<th>Tên khách hàng</th>
							        <th>Chi nhánh</th>
							        <th>Giỏ hàng</th>
							        <th>Tổng tiền</th>
							        <th></th>
		                        </tr>
	                      	</thead>
		                    <tbody>
		                      	<?php foreach ($waitOrders as $waitOrder): ?>
							    	<tr id="<?php echo $waitOrder['id']; ?>">
							    		<td><input class="checkbox-working-day" value="<?=$waitOrder['id']?>" type="checkbox" /></td>
						    			<td><?=$waitOrder['code']?></td>
						    			<td><?=$waitOrder['customer_name']?></td>
								        <td><?=$waitOrder['site_name']?></td>
								        <td>
								        	<?php $total = 0;foreach ($waitOrder['detail'] as $detail): ?>
								        		<span><?=$detail['quantity']?> quyển <?=$detail['book_name']?> </span>
								        			<?php $total += $detail['quantity'] * $detail['book_price']?> <br/>
								        	<?php endforeach?>
								        </td>
								        <td><?php echo $total; ?></td>
								        <td>
											<a href="?mod=admin&act=order&action=confirmComplete&id=<?=$waitOrder['code']?>" class="btn btn-success" title="Hoàn thành" ><i class="fa fa-check"></i></a>
											<a href="?mod=admin&act=order&action=cancelDelivery&id=<?=$waitOrder['code']?>" class="btn btn-danger delete" title="Hủy đơn hàng"><i class="fa fa-close"></i></a>
								        </td>
							      	</tr>
								<?php endforeach?>
		                    </tbody>
	                    </table>
                  	</div>
                </div>
              </div>
            </div>
        </div>
</div>

<div class="right_col" role="main" id="order-complete-section">
        <div class="">
            <div class="clearfix"></div>

            <div class="row">
              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  	<div class="x_title">
	                    <h2>Danh sách đơn đặt hàng đã hoàn thành</h2>
	                    <ul class="nav navbar-right panel_toolbox">
	                      	<li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
	                      	</li>
	                      	<li class="dropdown">
		                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-wrench"></i></a>
		                        <ul class="dropdown-menu" role="menu">
			                        <li><a href="#">Settings 1</a>
			                        </li>
			                        <li><a href="#">Settings 2</a>
			                        </li>
		                        </ul>
	                      	</li>
		                    <li><a class="close-link"><i class="fa fa-close"></i></a>
		                    </li>
	                    </ul>
                    	<div class="clearfix"></div>
                  	</div>
                  	<div class="x_content">
	                    <table id="order-complete-table" class="table table-striped table-bordered">
	                      	<thead>
		                        <tr>
		                        	<th><input type="checkbox" onclick="toggle(this);" /></th>
		                          	<th>Mã đơn hàng</th>
		                          	<th>Tên khách hàng</th>
							        <th>Chi nhánh</th>
							        <th>Giỏ hàng</th>
							        <th>Tổng tiền</th>
		                        </tr>
	                      	</thead>
		                    <tbody>
		                      	<?php foreach ($completeOrders as $completeOrder): ?>
							    	<tr id="<?php echo $completeOrder['id']; ?>">
							    		<td><input class="checkbox-working-day" value="<?=$completeOrder['id']?>" type="checkbox" /></td>
						    			<td><?=$completeOrder['code']?></td>
						    			<td><?=$completeOrder['customer_name']?></td>
								        <td><?=$completeOrder['site_name']?></td>
								        <td>
								        	<?php $total = 0;foreach ($completeOrder['detail'] as $detail): ?>
								        		<span><?=$detail['quantity']?> quyển <?=$detail['book_name']?> </span>
								        			<?php $total += $detail['quantity'] * $detail['book_price']?> <br/>
								        	<?php endforeach?>
								        </td>
								        <td><?php echo $total; ?></td>
							      	</tr>
								<?php endforeach?>
		                    </tbody>
	                    </table>
                  	</div>
                </div>
              </div>
            </div>
        </div>
</div>
<?php
include_once 'views/layout/admin/footer.php';
?>

<?php
if (isset($_COOKIE['updateStatusConfirmDeliverySuccess'])) {
	echo '<script type="text/javascript">toastr.success("Đơn hàng đang được giao");toastr.options.timeOut = 30000;</script>';
}

if (isset($_COOKIE['updateStatusConfirmDeliveryFail'])) {
	echo '<script type="text/javascript">toastr.error("Đơn hàng chưa được giao!", "Lỗi!");</script>';
}

if (isset($_COOKIE['updateStatusCompleteDeliverySuccess'])) {
	echo '<script type="text/javascript">toastr.success("Đơn hàng đã hoàn thành");toastr.options.timeOut = 30000;</script>';
}

if (isset($_COOKIE['updateStatusCompleteDeliveryFail'])) {
	echo '<script type="text/javascript">toastr.error("Đơn hàng chưa được hoàn thành!", "Lỗi!");</script>';
}

if (isset($_COOKIE['cancelDeliverySuccess'])) {
	echo '<script type="text/javascript">toastr.error("Hủy đơn hàng thành công");toastr.options.timeOut = 30000;</script>';
}

if (isset($_COOKIE['cancelDeliveryFail'])) {
	echo '<script type="text/javascript">toastr.error("Đơn hàng chưa được hủy!", "Lỗi!");</script>';
}
?>