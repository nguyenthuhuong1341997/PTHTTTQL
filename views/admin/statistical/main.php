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
	                    <h2>Danh sách sản phẩm bán chạy nhất</h2>
                    	<div class="clearfix"></div>
                  	</div>
                  	<div class="x_content">
	                    <table id="wait-order-table" class="table table-striped table-bordered">
	                      	<thead>
		                        <tr>
		                          	<th>Mã sách</th>
		                          	<th>Tên sách</th>
							        <th>Ảnh</th>
							        <th>Đơn giá</th>
							        <th>Số lần bán</th>
							        <th>Số lượng bán</th>
							        <th>Hành động</th>
		                        </tr>
	                      	</thead>
		                    <tbody>
	                        <?php foreach ($top_sale as $key => $value) {?>


						    		<tr id="<?php echo $value['id']; ?>">
					    			<td><?=$value['code']?></td>
					    			<td><?=$value['name']?></td>
							        <td><div style="background-image: url('<?php echo $HOST . $value['image']; ?>'); width: 100px; height: 100px; background-repeat: no-repeat; background-position: center; background-size: cover;"></div></td>
							        <td><?=$value['price']?></td>
							        <td><?=$value['total_count']?></td>
							        <td><?=$value['total_quantity']?></td>
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
				<h4 class="modal-title">Thông tin sách</h4>
			</div>
			<div class="modal-body" style="overflow: hidden;">
				<div class="col-md-3">
					<img src="" alt="" style="width: 235px; height: 300px;">
				</div>
				<div class="col-md-8 col-md-offset-1">
					<div class="row">
						<div class="col-md-3"><b>Mã sách</b></div>
						<div class="col-md-9"><p slug="code"></p></div>
					</div>
					<div class="row">
						<div class="col-md-3"><b>Tên sách</b></div>
						<div class="col-md-9"><p slug="name"></p></div>
					</div>
					<div class="row">
						<div class="col-md-3"><b>Giá bán</b></div>
						<div class="col-md-9"><p slug="price"></p></div>
					</div>
					<div class="row">
						<div class="col-md-3"><b>Thể loại</b></div>
						<div class="col-md-9"><p slug="type"></p></div>
					</div>
					<div class="row">
						<div class="col-md-3"><b>Tác giả</b></div>
						<div class="col-md-9"><p slug="author_name"></p></div>
					</div>
					<div class="row">
						<div class="col-md-3"><b>Nhà xuất bản</b></div>
						<div class="col-md-9"><p slug="publisher_name"></p></div>
					</div>
					<div class="row">
						<div class="col-md-3"><b>Tổng thu nhập</b></div>
						<div class="col-md-9"><p slug="total"></p></div>
					</div>
					<center>
						<table class="table table-striped table-bordered">
	                      	<thead>
		                        <tr>
		                          	<th>Mã hóa đơn</th>
		                          	<th>Ngày tạo</th>
		                          	<th>Khách hàng</th>
							        <th>Đã mua</th>
							        <th>Tổng giá</th>
							        <th>Chi nhánh</th>
		                        </tr>
	                      	</thead>
		                    <tbody>

	                      </tbody>
	                    </table>
					</center>
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
</script>
<script>
	$(document).ready(function () {
		$(document).on('click', '.open-detail', function(){
			var code = $(this).attr('slug-code');
			$.ajax({
				url : '?mod=admin&act=get-list-order-by-book&code=' + code,
				type : 'get',
				success : function(res){
					if(res){
						var data = JSON.parse(res);
						$('#modal-detail img').attr('src', host + data.book['image']);
						for (var key in data.book) {
						    if (data.book.hasOwnProperty(key)) {
						    	$('#modal-detail p[slug='+key+']').html(data.book[key]);
						    	if(key === 'price')
						    		$('#modal-detail p[slug='+key+']').html(fomatVND(data.book[key]));
						    }
						}
						var total = 0;
						$('#modal-detail tbody').children().remove();
						data.orders.forEach(function(od){
							var cus_name = od.name ? od.name : 'Khách lẻ';
							total += od.total_price;
							$('#modal-detail tbody').append('<tr>'
					    			+'<td>'+od.code+'</td>'
					    			+'<td>'+od.created_date.date.split(' ')[0]+'</td>'
					    			+'<td style="text-transform: capitalize;">'+cus_name+'</td>'
							        +'<td>'+od.quantity+'</td>'
							        +'<td>'+fomatVND(od.total_price)+'</td>'
							        +'<td>'+od.location+'</td>'
						      	+'</tr>')
						})
						$('#modal-detail p[slug=total]').text(fomatVND(total));
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