<?php
include_once 'views/layout/admin/header.php';
?>
<!-- page content -->
        <div class="right_col" role="main">
          <div class="">
            <div class="page-title">
              <div class="title_left">
                <h3>Quản Lý Khách Hàng</small></h3>
              </div>
            </div>

            <div class="clearfix"></div>

            <div class="row">
              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
	                <div class="x_title" style="margin-top: 15px;">
	                	<h2>Sửa khách hàng</h2>

	                    <div class="clearfix"></div>

	                </div>
                  	<form enctype="multipart/form-data" method="POST" action="?mod=admin&act=customer&action=update&code=<?=$customer['code']?>" class="form-horizontal form-label-left createcustomer" >
                  		<div class="row">
                        <div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
                          <div class="row">
                            <div class="col-md-3" style="padding-left: 20px;padding-top: 10px;">
                              <label>Mã khách hàng</label>
                            </div>
                            <div class="col-md-9">
                              <input type="text" id="code" name="code" readonly="" class="form-control has-feedback-left" placeholder="Code" required="" value="<?=$customer['code']?>">
                                <span class="fa fa-key form-control-feedback left" aria-hidden="true"></span>
                            </div>
                          </div>
                      </div>
                        <div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
                          <div class="row">
                            <div class="col-md-3" style="padding-left: 20px;padding-top: 10px;">
                              <label>Họ và tên</label>
                            </div>
                            <div class="col-md-9">
                              <input type="text" id="name" class="form-control has-feedback-left" placeholder="Nhập vào họ và tên" name="name" required="" value="<?=$customer['name']?>">
                                <span class="fa fa-user form-control-feedback left" aria-hidden="true"></span>
                            </div>
                          </div>
                      </div>

                  		</div>
                  		<div class="row">
                        <div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
                          <div class="row">
                            <div class="col-md-3" style="padding-left: 20px;padding-top: 10px;">
                              <label>Tài khoản</label>
                            </div>
                            <div class="col-md-9">
                              <input type="" class="form-control has-feedback-left" value="<?=$customer['username']?>" id="username" name="username" required="" placeholder="username">
                                <span class="fa fa-user form-control-feedback left" aria-hidden="true"></span>
                            </div>
                          </div>
                      </div>
                  			<div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
                          <div class="row">
                            <div class="col-md-3" style="padding-left: 20px;padding-top: 10px;">
                              <label>Email</label>
                            </div>
                            <div class="col-md-9">
                              <input type="email" class="form-control has-feedback-left" value="<?=$customer['email']?>" name="email" id="email" autofocus="hidden" required="">
                                <span class="fa fa-envelope-o form-control-feedback left" aria-hidden="true"></span>
                            </div>
                          </div>
                      </div>
                  		</div>
                  		<div class="row">
                  			<div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
                  				<div class="row">
                  					<div class="col-md-3" style="padding-left: 20px;padding-top: 10px;">
                  						<label>Số điện thoại</label>
                  					</div>
                  					<div class="col-md-9">
                  						<input type="text" class="form-control has-feedback-left" value="<?=$customer['phone']?>" id="phone_number" name="phone" required="">
			                        	<span class="fa fa-phone form-control-feedback left" aria-hidden="true"></span>
                  					</div>
                  				</div>
			                </div>
                      <div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
                          <div class="row">
                            <div class="col-md-3" style="padding-left: 20px;padding-top: 10px;">
                              <label>Địa chỉ</label>
                            </div>
                            <div class="col-md-9">
                              <input type="text" class="form-control has-feedback-left" value="<?=$customer['address']?>" id="address" name="address" required="">
                                <span class="fa fa-phone form-control-feedback left" aria-hidden="true"></span>
                            </div>
                          </div>
                      </div>

                  		</div>
                      <div class="row">
                        <div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
                          <div class="row">
                            <div class="col-md-3" style="padding-left: 20px;padding-top: 10px;">
                              <label>Đặt lại mật khẩu</label>
                            </div>
                            <div class="col-md-9">
                              <input type="password" class="form-control has-feedback-left" value="" id="password" name="password">
                                <span class="fa fa-key form-control-feedback left" aria-hidden="true"></span>
                            </div>
                          </div>
                        </div>
                      </div>

                  		<div class="row">
                  			<div class="col-md-2 col-md-offset-5">
								          <button type="submit" class="btn btn-info ">Sửa thông tin</button>
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
<script>
  $(document).ready(function () {
    $('form').submit(function(e){
      e.preventDefault();
      $.ajax({
        url : $(this).attr('action'),
        type : $(this).attr('method'),
        data : $(this).serialize(),
        success : function(res){
          if(JSON.parse(res) === false){
            toastr.error('Tài khoản đã tồn tại!', 'Lỗi!');
          } else{
            $('button[type="submit"]').attr('disabled','true');
            toastr.success('Sửa thành công!', 'Thành công!');
            setTimeout(function(){ window.location.replace('?mod=admin&act=customer'); }, 1000);
          }
        }
      })
    })
  })
</script>
