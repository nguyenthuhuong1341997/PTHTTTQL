<?php 
	include_once 'views/layout/admin/header.php';
?>
<!-- page content -->
        <div class="right_col" role="main">
          <div class="">
            <div class="page-title">
              <div class="title_left">
                <h3>Quản Lý Nhân Viên</small></h3>
              </div>
            </div>

            <div class="clearfix"></div>

            <div class="row">
              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
	                <div class="x_title" style="margin-top: 15px;">
	                	<h2>Thêm mới nhân viên</h2>
	                    
	                    <div class="clearfix"></div>

	                </div>
                  	<form enctype="multipart/form-data" method="POST" action="?mod=admin&act=user&action=store" class="form-horizontal form-label-left createuser" >
                  		<div class="row">
                  			<div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
                  				<div class="row">
                  					<div class="col-md-3" style="padding-left: 20px;padding-top: 10px;">
                  						<label>Email</label>
                  					</div>
                  					<div class="col-md-9">
                  						<input type="email" class="form-control has-feedback-left" placeholder="Email" name="email" id="email" autofocus="hidden" required="">
			                        	<span class="fa fa-envelope-o form-control-feedback left" aria-hidden="true"></span>
                  					</div>
                  				</div>
			                </div>
                  			<div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
                  				<div class="row">
                  					<div class="col-md-3" style="padding-left: 20px;padding-top: 10px;">
                  						<label>Code</label>
                  					</div>
                  					<div class="col-md-9">
                  						<input type="text" id="code" name="code" class="form-control has-feedback-left" placeholder="Code" required="">
			                        	<span class="fa fa-key form-control-feedback left" aria-hidden="true"></span>
                  					</div>
                  				</div>
			                </div>
                  		</div>
                  		<div class="row">
                  			<div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
                  				<div class="row">
                  					<div class="col-md-3" style="padding-left: 20px;padding-top: 10px;">
                  						<label>Họ và tên</label>
                  					</div>
                  					<div class="col-md-9">
                  						<input type="text" id="name" class="form-control has-feedback-left" placeholder="Nhập vào họ và tên" name="name" required="">
			                        	<span class="fa fa-user form-control-feedback left" aria-hidden="true"></span>
                  					</div>
                  				</div>
			                </div>
                  			<div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
                  				<div class="row">

                  					<div class="col-md-3" style="padding-left: 20px;padding-top: 10px;">
                  						<label>Chức vụ</label>
                  					</div>
                  					<div class="col-md-9">
                  						<select class="select2_single form-control" tabindex="-1" name="role_id">
                                <?php foreach ($roles as $role): ?>
                                  <option value="<?= $role['id'] ?>"><?= $role['name'] ?></option>
                                <?php endforeach ?>
                              </select>
                  					</div>
                  				</div>
			                </div>
                  		</div>
                  		<div class="row">
                  			<div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
                  				<div class="row">
                  					<div class="col-md-3" style="padding-left: 20px;padding-top: 10px;">
                  						<label>Username</label>
                  					</div>
                  					<div class="col-md-9">
                  						<input type="" class="form-control has-feedback-left" value="" id="username" name="username" required="" placeholder="Username">
			                        	<span class="fa fa-user form-control-feedback left" aria-hidden="true"></span>
                  					</div>
                  				</div>
			                </div>
                  			<div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
                  				<div class="row">
                  					<div class="col-md-3" style="padding-left: 20px;padding-top: 10px;">
                  						<label>Password</label>
                  					</div>
                  					<div class="col-md-9">

                  						<input type="password" class="form-control has-feedback-left" placeholder="Nhập vào chức vụ" id="password" name="password" value="123456">
			                        	<span class="fa fa-graduation-cap form-control-feedback left" aria-hidden="true"></span>
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
                  						<input type="text" class="form-control has-feedback-left" placeholder="Nhập vào số điện thoại" id="phone_number" name="phone" required="">
			                        	<span class="fa fa-phone form-control-feedback left" aria-hidden="true"></span>
                  					</div>
                  				</div>
			                </div>
                  			<div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
                  				<div class="row">
                  					<div class="col-md-3" style="padding-left: 20px;padding-top: 10px;">
                  						<label>Chi nhánh</label>
                  					</div>
                  					<div class="col-md-9">
                  						<select class="select2_single form-control" tabindex="-1" name="site_id">
                                <?php foreach ($sites as $site): ?>
                                  <option value="<?= $site['id'] ?>"><?= $site['name'] ?></option>
                                <?php endforeach ?>
                              </select>
                  					</div>
                  				</div>
			                </div>
                  		</div>
                  		
                  		<div class="row">
                  			<div class="col-md-2 col-md-offset-5">
								          <button type="submit" class="btn btn-info ">Thêm mới</button>
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
<script type="text/javascript " src="public/admin/js/toastr.min.js"></script>
<script type="text/javascript">
	$('#myDatepicker2').datetimepicker({
        format: 'DD.MM.YYYY'
    });
</script>
