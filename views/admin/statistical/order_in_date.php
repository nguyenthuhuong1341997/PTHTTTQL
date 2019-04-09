<?php
include_once 'views/layout/admin/header.php';
?>
<div class="right_col" role="main" id="order-wait-section">
        <div class="">
	            <div class="page-title">
	              	<div class="title_left">
	                	<h3>THỐNG KÊ</h3>
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
	                    <h2>Danh sách hóa đơn bán trong ngày: <b><?=$date?></b></h2>
                    	<div class="clearfix"></div>
                  	</div>
                  	<div class="x_content">
                  		<div class="row">
                  			<div class="col-md-offset-3 col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
                  				<div class="row">
                  					<form id="choose-date" action="" method="get">
	                  					<div class="col-md-3" style="padding-left: 20px;padding-top: 10px;">
	                  						<label for="date">Chọn ngày</label>
	                  					</div>
	                  					<div class="col-md-7">
	                  						<input type="date" value="<?=$date?>" class="form-control has-feedback-left" name="date" id="date" autofocus="hidden" required="">
				                        	<span class="fa fa-clock-o form-control-feedback left" aria-hidden="true"></span>
	                  					</div>
	                  					<div class="col-md-2">
	                  						<button type="submit" class="btn btn-info ">Xem báo cáo</button>
	                  					</div>
	                  				</form>
                  				</div>
			                </div>
                  		</div>
                  		<div class="row" style="padding: 10px 0;"></div>
	                    <table id="order-in-date" class="table table-striped table-bordered">
	                      	<thead>
		                        <tr>
		                          	<th>Mã hóa đơn</th>
		                          	<th>Ngày tạo</th>
							        <th>Số lượng bán</th>
							        <th>Tổng tiền</th>
							        <th>Chi nhánh</th>
							        <th>Hành động</th>
		                        </tr>
	                      	</thead>
		                    <tbody>
	                        <?php foreach ($orders as $key => $value) {?>
					    			<td><?=$value['code']?></td>
					    			<td><?=$value['created_date']->format('Y-m-d H:i:s')?></td>
							        <td><?=$value['total_quantity']?></td>
							        <td><?php echo number_format($value['total_price'], 0) . "&nbsp;₫"; ?></td>
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
	$(document).ready(function () {
		$('#order-in-date').dataTable({
				  'order': [[ 1, 'desc' ]]
				});
		$('#choose-date').submit(function(e){
			e.preventDefault();
			window.location.replace('?mod=admin&act=order-in-date&date=' + $(this).find('input[type=date]').val());
		})
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
						        +'<td><div style="background-image: url('+b.image+'); width: 100px; height: 50px; background-repeat: no-repeat; background-position: center; background-size: cover;"></div></td>'
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