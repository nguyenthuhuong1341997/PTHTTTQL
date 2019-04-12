<?php
include_once 'views/layout/admin/header.php';
include_once 'models/CONSTANT.php';
?>
 <div class="right_col list-book" role="main">
          <div class="">
            <div class="page-title">
              <div class="title_left">
                <h3>Quản Lý Sách</small></h3>
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
                    <h2>Danh sách sản phẩm</small></h2>
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
                  	<?php if ($_SESSION['user']['rcode'] == 'ROLE_BOSS'): ?>
	                  	<div class="row">
	                  		<div class="col-md-6">
	                  			<a href="?mod=admin&act=book&action=create" class="btn btn-success"><i class="fa fa-plus-circle"></i>Thêm mới</a>
	                  		</div>
	                  	</div>
                  	<?php endif?>
                    <table id="datatable" class="table table-striped table-bordered">
                      <thead>
                        <tr>
                          	<th>ID</th>
                          	<th>Tên sách</th>
					        <th>Ảnh</th>
					        <th>Tác giả</th>
					        <th>Thể loại</th>
					        <th>Nhà xuất bản</th>
					        <th></th>
                        </tr>
                      </thead>


                      <tbody>
                        <?php foreach ($books as $key => $value) {?>


					    		<tr id="<?php echo $value['id']; ?>">
				    			<td><?=$value['id']?></td>
				    			<td><?=$value['name']?></td>
						        <td><div style="background-image: url('<?php echo $HOST . $value['image']; ?>'); width: 100px; height: 100px; background-repeat: no-repeat; background-position: center; background-size: cover;"></div></td>
						        <td><?=$value['author_name']?></td>
						        <td><?=$value['type_name']?></td>
						        <td><?=$value['publisher_name']?></td>
						        <td>
									<a href="javascript:void(0)" slug-code="<?=$value['code']?>" class="open-detail btn btn-info" title="Xem chi tiết sản phẩm"><i class="fa fa-eye"></i></a>
									<?php if ($_SESSION['user']['rcode'] == 'ROLE_BOSS'): ?>
										<a href="?mod=admin&act=book&action=edit&code=<?=$value['code']?>" class="btn btn-warning" title="Sửa thông tin sản phẩm"><i class="fa fa-edit"></i></a>
									<?php endif?>
									<?php if ($_SESSION['user']['rcode'] == 'ROLE_ADMIN'): ?>
										<a href="?mod=admin&act=book&action=bookAddQuantity&code=<?=$value['code']?>" type="button" class="btn btn-info btn-edit-quantity-book" title="Thêm số lượng sản phẩm" data-id="<?=$value['id']?>"><i class="fa fa-edit"></i></a>
									<?php endif?>
									<?php if ($_SESSION['user']['rcode'] == 'ROLE_BOSS'): ?>
										<a href="javascript:;" slug-code="<?=$value['code']?>" class="btn btn-danger delete-book" title="Xóa sản phẩm"><i class="fa fa-trash-o"></i></a>
									<?php endif?>

						        </td>
					      	</tr>



						<?php }?>
                      </tbody>
                    </table>
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
											<div class="col-md-3"><b>Description</b></div>
											<div class="col-md-9"><p slug="description"></p></div>
										</div>
										<center>
											<div class="row site_book" style="padding-left: 15%">
												<div class="quantityBook">
													<div class="border-quantity">
														<p><b>Vị trí</b></p>
													</div>
													<div class="border-quantity">
														<p style="font-weight: 700;">Số lượng</p>
													</div>
												</div>
												<?php foreach ($sites as $s) {?>
													<div class="quantityBook">
														<div class="border-quantity">
															<p><b><?=$s['location']?></b></p>
														</div>
														<div class="border-quantity">
															<p slug="<?=$s['code']?>"></p>
														</div>
													</div>
												<?php }?>
											</div>
										</center>
									</div>

								</div>
								<div class="modal-footer">
									<button type="button" class="btn btn-default" data-dismiss="modal">Đóng</button>
								</div>
							</div>
						</div>
					</div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
<script type="text/javascript">
	var bookqan = <?php echo json_encode($books) ?>;
	var host = '<?=$HOST?>';
</script>
<?php
include_once 'views/layout/admin/footer.php';

?>
<script type="text/javascript" src="public/js/book.js"></script>

<?php
if (isset($_COOKIE['msg3'])) {
	echo '<script type="text/javascript">toastr.success("Thêm mới thành công");toastr.options.timeOut = 30000;</script>';
	// unset($_COOKIE['msg3']);
}
if (isset($_COOKIE['msg'])) {
	echo '<script type="text/javascript">toastr.success("Cập nhật thành công");toastr.options.timeOut = 30000;</script>';
	// unset($_COOKIE['msg3']);
}
if (isset($_COOKIE['updateQuantityBookSuccess'])) {
	echo '<script type="text/javascript">toastr.success("Thêm số lượng thành công");toastr.options.timeOut = 30000;</script>';
	// unset($_COOKIE['msg3']);
}

?>