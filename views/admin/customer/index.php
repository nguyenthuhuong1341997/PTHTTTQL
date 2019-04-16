<?php
include_once 'views/layout/admin/header.php';
?>
 <div class="right_col list-book" role="main">
          <div class="">
            <div class="page-title">
              <div class="title_left">
                <h3>Quản Lý Nhân viên</small></h3>
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
                    <h2>Danh sách khách hàng</small></h2>
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
                  		<div class="col-md-3">
                  			<a href="?mod=admin&act=customer&action=create" class="btn btn-success"><i class="fa fa-plus-circle"></i>Thêm mới</a>
                  		</div>

      	<?php	if ($_SESSION['user']['rcode'] == 'ROLE_BOSS') {
	?>
      					<div class="col-md-3">
      						<label for="type">Chọn danh sách</label>
      						<select name="type" id="type" class="form-control">
								<option <?php echo (0 == $type) ? ' selected="selected"' : ''; ?> value="0">Tất cả khách hàng</option>
      							<?php foreach ($sites as $site) {?>
      								<option <?php echo ($site['id'] == $type) ? ' selected="selected"' : ''; ?> value="<?=$site['id']?>">Khách hàng tại <?=$site['location']?></option>
      							<?php }?>
      						</select>
      					</div>
<?php } else {?>
						<div class="col-md-3">
      						<label for="type">Chọn danh sách</label>
      						<select name="type" id="type" class="form-control">
								<option value="1">Khách hàng đã mua tại đây</option>
								<option value="0">Tất cả khách hàng</option>
      						</select>
      					</div>
<?php }?>
					<div class="col-md-3">
  						<button style="margin-top: 22px;" type="button" id="choose-type" class="btn btn-info ">Xem danh sách</button>
  					</div>
                  	</div>

                    <table id="datatablex" class="table table-striped table-bordered">
                      <thead>
                        <tr>
                          	<th>Mã khách hàng</th>
                          	<th>Email</th>
					        <th>Họ tên</th>
					        <th>Số điện thoại</th>
					        <th>Địa chỉ</th>
					        <th>Tài khoản</th>
					        <th></th>
                        </tr>
                      </thead>


                      <tbody>
                        <?php foreach ($customers as $customer) {?>


					    		<tr slug-code="<?php echo $customer['code']; ?>">
				    			<td><?=$customer['code']?></td>
				    			<td><?=$customer['email']?></td>
						        <td><?=$customer['name']?></td>
						        <td><?=$customer['phone']?></td>
						        <td><?=$customer['address']?></td>
						        <td><?=$customer['username']?></td>
						        <td>
									<a data-target="#myModal-<?=$customer['id']?>" class="btn btn-info" title="Xem chi tiết khách hàng" data-toggle="modal" ><i class="fa fa-eye"></i></a>
									<a href="?mod=admin&act=customer&action=edit&code=<?=$customer['code']?>" class="btn btn-warning" title="Sửa thông tin nhân viên"><i class="fa fa-edit"></i></a>
									<a href="javascript:;" class="btn btn-danger delete-customer" title="Xóa khách hàng"><i class="fa fa-trash-o"></i></a>
						        </td>
					      	</tr>

				      		<div id="myModal-<?=$customer['id']?>" class="modal fade" role="dialog">
								<div class="modal-dialog modal-lg">
									<!-- Modal content-->
									<div class="modal-content">
										<div class="modal-header">
											<button type="button" class="close" data-dismiss="modal">&times;</button>
											<h4 class="modal-title">Thông tin khách hàng</h4>
										</div>
										<div class="modal-body" style="height: 200px;">
											<div class="col-md-3">
												<img src="public/image/user.png" alt="" style="width: 170px; height: 170px; border-radius: 50%">
											</div>
											<div class="col-md-8 col-md-offset-1">
												<div class="row">
													<div class="col-md-5"><b>Email</b></div>
													<div class="col-md-7"><p><?=$customer['email']?></p></div>
												</div>
												<div class="row">
													<div class="col-md-5"><b>Họ và tên</b></div>
													<div class="col-md-7"><p><?=$customer['name']?></p></div>
												</div>
												<div class="row">
													<div class="col-md-5"><b>Username</b></div>
													<div class="col-md-7"><p><?=$customer['username']?></p></div>
												</div>
												<div class="row">
													<div class="col-md-5"><b>Điện thoại</b></div>
													<div class="col-md-7"><p><?=$customer['phone']?></p></div>
												</div>
												<div class="row">
													<div class="col-md-5"><b>Địa chỉ</b></div>
													<div class="col-md-7"><p><?=$customer['address']?></p></div>
												</div>
											</div>
										</div>
										<div class="modal-footer">
											<button type="button" class="btn btn-default" data-dismiss="modal">Đóng</button>
										</div>
									</div>
								</div>
							</div>
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

<?php
if (isset($_COOKIE['msg3'])) {
	echo '<script type="text/javascript">toastr.success("Thêm mới thành công");toastr.options.timeOut = 30000;</script>';
}

if (isset($_COOKIE['addUser'])) {
	echo '<script type="text/javascript">toastr.success("Thêm mới thành công");toastr.options.timeOut = 30000;</script>';
}

if (isset($_COOKIE['updateUser'])) {
	echo '<script type="text/javascript">toastr.success("Sửa thành công");toastr.options.timeOut = 30000;</script>';
}
?>
<script type="text/javascript">
	$(document).ready(function(){
		$('#datatablex').dataTable({
				  'order': [[ 0, 'desc' ]]
				});
	})
	$('#choose-type').click(function(e){
			e.preventDefault();
			window.location.replace('?mod=admin&act=customer&type=' + $(this).parents('.row').find('select[name=type]').val());
		})
	$(".delete-customer").click(function(){
		var id = $(this).parents("tr").attr("slug-code");
		var path = "?mod=admin&act=customer&action=delete&code=" + id;
		swal({
	        title: "Bạn có muốn xóa không?",
			icon: "warning",
			buttons: true,
			dangerMode: true,
		})
		.then((willDelete) => {
		  	if (willDelete) {
		  		 $.ajax({
		            type: "POST",
		            url: path,
		            success: function(res)
		            {
		            	var data = JSON.parse(res);
		            	if(data.status == 'true') {
		            		toastr.success('Xóa thành công.')
							document.location = '?mod=admin&act=customer';
						}else {
							toastr.error('Xóa không thành công.', 'Lỗi!')
							toastr.options.timeOut = 3000;
						}
		            }

	            });
		  	}
		});
	});

</script>