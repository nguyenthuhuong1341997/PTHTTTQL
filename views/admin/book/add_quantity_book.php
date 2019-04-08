<?php 
	include_once 'views/layout/admin/header.php';
?>
<!-- page content -->
        <div class="right_col" role="main">
          <div class="">
            <div class="page-title">
              <div class="title_left">
                <h3>Quản Lý Sách</small></h3>
              </div>
            </div>

            <div class="clearfix"></div>

            <div class="row">
              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
	                <div class="x_title" style="margin-top: 15px;">
	                	<h2>Thêm số lượng sách</h2>
	                    
	                    <div class="clearfix"></div>

	                </div>
                  	<form enctype="multipart/form-data" method="POST" action="?mod=admin&act=book&action=updateQuantity" class="form-horizontal form-label-left createuser" >
                  		<div class="row" style="height: 340px">
							<div class="col-md-3">
								<img src="<?php echo $result['image'] ?>" alt="" style="width: 235px; height: 250px;">
							</div>
							<div class="col-md-8 col-md-offset-1">
								<div class="row">
									<div class="col-md-3"><b>Mã sách</b></div>
									<div class="col-md-9"><p><?=$result['code']?></p></div>
								</div>
								<div class="row">
									<div class="col-md-3"><b>Tên sách</b></div>
									<div class="col-md-9"><p><?=$result['name']?></p></div>
								</div>
								<div class="row">
									<div class="col-md-3"><b>Giá bán</b></div>
									<div class="col-md-9"><p><?=$result['price']?></p></div>
								</div>
								<div class="row">
									<div class="col-md-3"><b>Thể loại</b></div>
									<div class="col-md-9"><p><?=$result['type']?></p></div>
								</div>
								<div class="row">
									<div class="col-md-3"><b>Tác giả</b></div>
									<div class="col-md-9"><p><?=$result['author_name']?></p></div>
								</div>
								<div class="row">
									<div class="col-md-3"><b>Nhà xuất bản</b></div>
									<div class="col-md-9"><p><?=$result['publisher_name']?></p></div>
								</div>	
								<div class="row">
									<div class="col-md-3"><b>Số lượng</b></div>
									<div class="col-md-9">
										<input type="number" class="form-control has-feedback-left" placeholder="Số lượng thêm" name="quantityadd" autofocus="hidden" required="">
										<input type="hidden" name="idaddquantity" id="idaddquantity" value="<?=$result['id']?>">
                    					<span class="fa fa-envelope-o form-control-feedback left" aria-hidden="true"></span>
                    				</div>
								</div>					
							</div>
						</div>

                        

                  		<div class="row">
                  			<div class="col-md-2 col-md-offset-5">
								<button type="submit" class="btn btn-info ">Save</button>
                  			</div>
                  		</div>
                  	</form>
                </div>
              </div>
            </div>
          </div>
        </div>
        <!-- /page content -->
		
<?php 
 	include_once 'views/layout/admin/footer.php';
?>
<script type="text/javascript " src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
<script type="text/javascript">
	$('#myDatepicker2').datetimepicker({
        format: 'DD.MM.YYYY'
    });
</script>
















<div class="modal fade" id="modal-add-quantity-book-<?=$value['id']?>" role="dialog">
								<div class="modal-dialog modal-lg">
									<div class="modal-content" >
										<div class="modal-header">
											<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
											<h4 class="modal-title">Thêm số lượng sản phẩm</h4>
										</div>
										<div class="modal-body" style="height: 340px">
											<div class="col-md-3">
												<img src="<?php echo $value['image'] ?>" alt="" style="width: 235px; height: 250px;">
											</div>
											<div class="col-md-8 col-md-offset-1">
												<div class="row">
													<div class="col-md-3"><b>Mã sách</b></div>
													<div class="col-md-9"><p><?=$value['code']?></p></div>
												</div>
												<div class="row">
													<div class="col-md-3"><b>Tên sách</b></div>
													<div class="col-md-9"><p><?=$value['name']?></p></div>
												</div>
												<div class="row">
													<div class="col-md-3"><b>Giá bán</b></div>
													<div class="col-md-9"><p><?=$value['price']?></p></div>
												</div>
												<div class="row">
													<div class="col-md-3"><b>Thể loại</b></div>
													<div class="col-md-9"><p><?=$value['type']?></p></div>
												</div>
												<div class="row">
													<div class="col-md-3"><b>Tác giả</b></div>
													<div class="col-md-9"><p><?=$value['author_name']?></p></div>
												</div>
												<div class="row">
													<div class="col-md-3"><b>Nhà xuất bản</b></div>
													<div class="col-md-9"><p><?=$value['publisher_name']?></p></div>
												</div>	
												<div class="row">
													<div class="col-md-3"><b>Số lượng</b></div>
													<div class="col-md-9">
														<input type="email" class="form-control has-feedback-left" placeholder="Số lượng thêm" name="quantityadd" autofocus="hidden" required="">
														<input type="hidden" name="idaddquantity" id="idaddquantity" value="<?=$value['id']?>">
			                        					<span class="fa fa-envelope-o form-control-feedback left" aria-hidden="true"></span>
			                        				</div>
												</div>					
											</div>
										</div>
																		
										<div class="modal-footer">
											<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
											<button type="button" class="btn btn-primary btn-save-add-quantity">Save changes</button>
										</div>
									</div>
								</div>
							</div>	