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
                    <h2>Danh sách nhân viên</small></h2>
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
                  			<a href="?mod=admin&act=user&action=create" class="btn btn-success"><i class="fa fa-plus-circle"></i>Thêm mới</a>
                  		</div>
                  		
                  	</div>
                    <table id="datatable" class="table table-striped table-bordered">
                      <thead>
                        <tr>
                        	<th><input type="checkbox" onclick="toggle(this);" /></th>
                          	<th>ID</th>
                          	<th>Email</th>
					        <th>Họ tên</th>
					        <th>Số điện thoại</th>
					        <th>Chức vụ</th>
					        <th>Chi nhánh</th>
					        <th></th>
                        </tr>
                      </thead>


                      <tbody>
                        <?php foreach ($users as $user) { ?>
			    		
			      		
					    		<tr id="<?php echo $user['id']; ?>">
					    		<td><input class="checkbox-working-day" value="<?=$user['id']  ?>" type="checkbox" /></td>
				    			<td><?=$user['id']  ?></td>
				    			<td><?=$user['email']  ?></td>
						        <td><?=$user['name']  ?></td>
						        <td><?=$user['phone']  ?></td>
						        <td><?=$user['role_name']  ?></td>
						        <td><?=$user['site_name']  ?></td>
						        <td>
									<a data-target="#myModal-<?=$user['id']?>" class="btn btn-info" title="Xem chi tiết nhân viên" data-toggle="modal" ><i class="fa fa-eye"></i></a>
									<a href="?mod=admin&act=user&action=edit&id=<?= $user['id']?>" class="btn btn-warning" title="Sửa thông tin nhân viên"><i class="fa fa-edit"></i></a>
									<a href="javascript:;" class="btn btn-danger delete-user" title="Xóa nhân viên"><i class="fa fa-trash-o"></i></a>
						        </td>
					      	</tr>
			      		
				      		<div id="myModal-<?=$user['id']?>" class="modal fade" role="dialog">
								<div class="modal-dialog modal-lg">
									<!-- Modal content-->
									<div class="modal-content">
										<div class="modal-header">
											<button type="button" class="close" data-dismiss="modal">&times;</button>
											<h4 class="modal-title">Thông tin nhân viên</h4>
										</div>
										<div class="modal-body" style="height: 200px;">
											<div class="col-md-3">
												<img src="public/image/user.png" alt="" style="width: 170px; height: 170px; border-radius: 50%">
											</div>
											<div class="col-md-8 col-md-offset-1">
												<div class="row">
													<div class="col-md-5"><b>Email</b></div>
													<div class="col-md-7"><p><?=$user['email']?></p></div>
												</div>
												<div class="row">
													<div class="col-md-5"><b>Họ và tên</b></div>
													<div class="col-md-7"><p><?=$user['name']?></p></div>
												</div>
												<div class="row">
													<div class="col-md-5"><b>Username</b></div>
													<div class="col-md-7"><p><?=$user['username']?></p></div>
												</div>	
												<div class="row">
													<div class="col-md-5"><b>Điện thoại</b></div>
													<div class="col-md-7"><p><?=$user['phone']?></p></div>
												</div>
												<div class="row">
													<div class="col-md-5"><b>Chức vụ</b></div>
													<div class="col-md-7"><p><?=$user['role_name']?></p></div>
												</div>
												<div class="row">
													<div class="col-md-5"><b>Chi nhánh</b></div>
													<div class="col-md-7"><p><?=$user['site_name']?></p></div>
												</div>										
											</div>
										</div>
										<div class="modal-footer">
											<button type="button" class="btn btn-default" data-dismiss="modal">Đóng</button>
										</div>
									</div>
								</div>
							</div>						
						<?php } ?>
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
		echo '<script type="text/javascript">toastr.success("Thêm mới nhân viên thành công");toastr.options.timeOut = 30000;</script>';
	}

	if (isset($_COOKIE['updateUser'])) {
		echo '<script type="text/javascript">toastr.success("Sửa thành công");toastr.options.timeOut = 30000;</script>';
	}
?>

<script type="text/javascript">
	$(".delete-user").click(function(){
		var id = $(this).parents("tr").attr("id");
		var path = "?mod=admin&act=user&action=delete&id=" + id;
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
							var url1 = '?mod=admin&act=user'; 
							document.location = url1;
						}else {
							toastr.error('Xóa không thành công.', 'Lỗi!')
							toastr.options.timeOut = 3000;
						}
		            }

	            });
		  	}
		});    	
	});

	function toggle(source) {
	    var checkboxes = document.querySelectorAll('input[type="checkbox"]');
	    for (var i = 0; i < checkboxes.length; i++) {
	        if (checkboxes[i] != source)
	            checkboxes[i].checked = source.checked;
	    }
	};

</script>