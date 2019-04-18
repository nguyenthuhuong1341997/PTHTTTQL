<?php
include_once 'views/layout/admin/header.php';
include_once 'models/CONSTANT.php';
?>
<div class="right_col" role="main" id="order-wait-section">
        <div class="">
	            <div class="page-title">
	              	<div class="title_left">
	                	<h3>THỐNG KÊ</h3>
	              	</div>
	            </div>

            <div class="clearfix"></div>

            <div class="row">
              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  	<div class="x_title">
	                    <h2>Danh sách sản phẩm bán chạy nhất</h2>
                    	<div class="clearfix"></div>
                  	</div>
                  	<div class="x_content">
	                    <table id="staff-order" class="table table-striped table-bordered">
	                      	<thead>
		                        <tr>
		                          	<th>Mã nhân viên</th>
		                          	<th>Tên nhân viên</th>
							        <th>Tổng số hóa đơn</th>
							        <th>Đã bán (quyển)</th>
							        <th>Tổng bán (quyển x số lượng)</th>
							        <th>Doanh thu</th>
							        <th>Chi nhánh</th>
							        <th>Hành động</th>
		                        </tr>
	                      	</thead>
		                    <tbody>
	                        <?php foreach ($statistical1 as $value) {?>


						    		<tr>
					    			<td><?=$value['username']?></td>
					    			<td style="text-transform: capitalize;"><?=$value['name']?></td>
					    			<td><?=$value['total_order']?></td>
					    			<td><?=$value['total_book']?></td>
					    			<td><?=$value['total_quantity']?></td>
							        <td><?php echo number_format($value['total_price'], 0) . "&nbsp;₫"; ?></td>
							        <td><?=$value['location']?></td>
							        <td>
										<a href="?mod=admin&act=statistical-staff&action=detail&staff=<?=$value['username']?>" class="open-detail btn btn-info" title="Xem chi tiết sản phẩm"><i class="fa fa-eye"></i></a>
							        </td>
						      	</tr>



							<?php }?>
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
<script>
	$('#staff-order').dataTable({
				  'order': [[ 2, 'desc' ]]
				});
</script>