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
	                    <h2>Thông tin bán hàng nhân viên <b style="text-transform: capitalize;"><?=$user['name']?></b></h2>
                    	<div class="clearfix"></div>
                  	</div>
                  	<div class="row x_title">
                  		<div class="col-md-11 col-md-offset-1">
							<div class="row">
								<div class="col-md-3"><b>Email</b></div>
								<div class="col-md-7"><p><?=$user['email']?></p></div>
							</div>
							<div class="row">
								<div class="col-md-3"><b>Họ và tên</b></div>
								<div class="col-md-7"><p style="text-transform: capitalize;"><?=$user['name']?></p></div>
							</div>
							<div class="row">
								<div class="col-md-3"><b>Tài khoản</b></div>
								<div class="col-md-7"><p><?=$user['username']?></p></div>
							</div>
							<div class="row">
								<div class="col-md-3"><b>Điện thoại</b></div>
								<div class="col-md-7"><p><?=$user['phone']?></p></div>
							</div>
							<div class="row">
								<div class="col-md-3"><b>Chức vụ</b></div>
								<div class="col-md-7"><p><?=$user['rname']?></p></div>
							</div>
							<div class="row">
								<div class="col-md-3"><b>Chi nhánh</b></div>
								<div class="col-md-7"><p><?=$user['location']?></p></div>
							</div>
						</div>
                  	</div>
                  	<div class="x_content">

	                    <table id="staff-order1" class="table table-striped table-bordered">
	                      	<thead>
		                        <tr>
		                          	<th>Mã hóa đơn</th>
		                          	<th>Ngày tạo</th>
		                          	<th>Khách hàng</th>
							        <th>Số lượng bán</th>
							        <th>Tổng tiền</th>
							        <th>Hình thức</th>
							        <th>Chi nhánh</th>
							        <th>Hành động</th>
		                        </tr>
	                      	</thead>
		                    <tbody>
	                        <?php foreach ($orders as $key => $value) {?>
					    			<td><?=$value['code']?></td>
					    			<td><?=$value['created_date']->format('Y-m-d H:i:s')?></td>
					    			<td><?=$value['name'] == null ? 'Khách lẻ' : $value['name']?></td>
							        <td><?=$value['total_quantity']?></td>
							        <td><?php echo number_format($value['total_price'], 0) . "&nbsp;₫"; ?></td>
							        <td><?=$value['sale_type'] == 1 ? 'Đặt hàng trực tiếp' : 'Mua hàng trên mạng'?></td>
							        <td><?=$value['location']?></td>
							        <td>
										<a href="javascript:void(0)" slug-code="<?=$value['code']?>" class="open-detail btn btn-info" title="Xem chi tiết sản phẩm"><i class="fa fa-eye"></i></a>
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
<div id="modal-detail" class="modal fade" role="dialog">
	<div class="modal-dialog modal-lg">
		<!-- Modal content-->
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
				<h4 class="modal-title">Thông tin đơn hàng: <b></b></h4>
			</div>
			<div class="modal-body" style="overflow: hidden;">
				<div class="col-md-12">
						<table class="table table-striped table-bordered">
	                      	<thead>
		                        <tr>
		                          	<th>Tên sách</th>
							        <th>Ảnh</th>
							        <th>Đã bán</th>
							        <th>Thu về</th>
		                        </tr>
		                    </thead>
		                    <tbody>

	                      </tbody>
	                    </table>
				</div>

			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">Đóng</button>
			</div>
		</div>
	</div>
</div>
<?php
include_once 'views/layout/admin/footer.php';
?>
<script>
	var host = '<?=$HOST?>';
	var role = '<?=$_SESSION["user"]["rcode"]?>';
</script>
<script>
	$(document).ready(function () {
		$('#staff-order1').dataTable({
		  'order': [[ 2, 'desc' ]]
		});
		$(document).on('click', '.open-detail', function(){
			var code = $(this).attr('slug-code');
			$.ajax({
				url : '?mod=admin&act=get-order-detail&code=' + code,
				type : 'get',
				success : function(res){
					if(res){
						$('h4.modal-title b').text(code);
						var data = JSON.parse(res);
						$('#modal-detail tbody').children().remove();
						var t1 = 0;
						var t2 = 0;
						data.forEach(function(b){
							t1 += parseInt(b.quantity);
							t2 += b.total_price;
							$('#modal-detail tbody').append('<tr><td>'+b.name+'</td>'
						        +'<td><div style="background-image: url('+host+b.image+'); width: 100px; height: 50px; background-repeat: no-repeat; background-position: center; background-size: cover;"></div></td>'
						        +'<td>'+b.quantity+'</td>'
						        +'<td>'+fomatVND(b.total_price)+'</td></tr>');
						})
						$('#modal-detail tbody').append('<tr><td colspan="2"><b>Tổng số</b></td><td><b>'+t1+'</b></td><td><b>'+fomatVND(t2)+'</b></td></tr>')
						$('#modal-detail').modal('show');
					}
				}
			})
		});
		function fomatVND(input) {
            return input.toLocaleString('it-IT', {style : 'currency', currency : 'VND'});
        }
	})
</script>