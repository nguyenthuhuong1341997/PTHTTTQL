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
	                	<h2>Thêm mới sách</h2>

	                    <div class="clearfix"></div>

	                </div>
                  	<form enctype="multipart/form-data" method="POST" action="?mod=admin&act=book&action=store" class="form-horizontal form-label-left createuser" id="create-book">
                  		<div class="row">
                  			<div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
                  				<div class="row">
                  					<div class="col-md-3" style="padding-left: 20px;padding-top: 10px;">
                  						<label>Mã sách</label>
                  					</div>
                  					<div class="col-md-9">
                  						<input type="text" class="form-control has-feedback-left" placeholder="Code" name="code" id="code" autofocus="hidden" required="">
			                        	<span class="fa fa-envelope-o form-control-feedback left" aria-hidden="true"></span>
                  					</div>
                  				</div>
			                </div>
                  			<div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
                  				<div class="row">

                            <div class="col-md-3" style="padding-left: 20px;padding-top: 10px;">
                              <label>Nhà xuất bản</label>
                            </div>
                            <div class="col-md-9">
                              <select class="select2_single form-control" tabindex="-1" name="publisher">
                                <?php foreach ($publishers as $publisher): ?>
                                  <option value="<?=$publisher['id']?>"><?=$publisher['name']?></option>
                                <?php endforeach?>
                              </select>
                            </div>
                  				</div>
			                </div>
                  		</div>

                  		<div class="row">
                  			<div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
                  				<div class="row">
                            <div class="col-md-3" style="padding-left: 20px;padding-top: 10px;">
                              <label>Tên sách</label>
                            </div>
                            <div class="col-md-9">
                              <input type="text" id="name" name="name" class="form-control has-feedback-left" placeholder="Tên sách" required="">
                                <span class="fa fa-key form-control-feedback left" aria-hidden="true"></span>
                            </div>
                  				</div>
			                  </div>
                  			<div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
                  				<div class="row">
                  					<div class="col-md-3" style="padding-left: 20px;padding-top: 10px;">
                  						<label>Thể loại</label>
                  					</div>
                  					<div class="col-md-9">
                  						<select class="select2_single form-control" tabindex="-1" name="type">
                                <?php foreach ($types as $type): ?>
                                  <option value="<?=$type['id']?>"><?=$type['name']?></option>
                                <?php endforeach?>
                              </select>
                  					</div>
                  				</div>
			                  </div>
                  		</div>

                  		<div class="row">
                  			<div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
                  				<div class="row">
                            <div class="col-md-3" style="padding-left: 20px;padding-top: 10px;">
                              <label>Giá</label>
                            </div>
                            <div class="col-md-9">
                              <input type="number" id="price" class="form-control has-feedback-left" placeholder="Nhập vào giá bán" name="price" required="">
                                <span class="fa fa-user form-control-feedback left" aria-hidden="true"></span>
                            </div>
                  				</div>
			                  </div>
                  			<div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
                          <div class="col-md-3 col-md-3 col-sm-3 col-xs-12" style="padding-left: 30px;padding-top: 10px;">
                            <label for="author1">Tác giả</label>
                          </div>

                          <div class="col-md-9">
                            <select id="author1" class="select2_single form-control" tabindex="-1" name="author">
                              <?php foreach ($authors as $author): ?>
                                <option value="<?=$author['id']?>"><?=$author['name']?></option>
                              <?php endforeach?>
                            </select>
                          </div>
			                  </div>
                  		</div>
                      <div class="row">
                        <div class="col-md-4 col-sm-4 col-xs-12 form-group has-feedback">
                          <div class="row">
                            <div class="col-md-3" style="padding-left: 20px;padding-top: 10px;">
                              <label for="siteHN">Hà Nội</label>
                            </div>
                            <div class="col-md-9">
                              <input type="number" id="siteHN" class="form-control has-feedback-left" value="0" name="site_hn" min="0" style="padding-left: 15px;">
                            </div>
                          </div>
                        </div>
                        <div class="col-md-4 col-sm-4 col-xs-12 form-group has-feedback">
                          <div class="row">
                            <div class="col-md-3" style="padding-left: 20px;padding-top: 10px;">
                              <label for="siteDN">Đà Nẵng</label>
                            </div>
                            <div class="col-md-9">
                              <input type="number" id="siteDN" class="form-control has-feedback-left" value="0" name="site_dn" min="0" style="padding-left: 15px;">
                            </div>
                          </div>
                        </div>
                        <div class="col-md-4 col-sm-4 col-xs-12 form-group has-feedback">
                          <div class="row">
                          <div class="col-md-3" style="padding-left: 20px;padding-top: 10px;">
                            <label for="site_sg">Sài Gòn</label>
                          </div>
                          <div class="col-md-9">
                              <input type="number" id="site_sg" class="form-control has-feedback-left" value="0" name="site_sg" min="0" style="padding-left: 15px;">
                            </div>
                        </div>
                      </div>
                      </div>

                  		<div class="row">
                        <div class="col-md-12 col-sm-12 col-xs-12 form-group has-feedback">
                          <div class="row">
                            <div class="col-md-2" style="padding-left: 20px;padding-top: 10px;">
                              <label for="editor">Mô tả</label>
                            </div>
                            <div class="col-md-10">
                              <textarea id="editor" rows="6" cols="6" name="description"></textarea>
                              <script>
                                  ClassicEditor
                                          .create( document.querySelector( '#editor' ) )
                                          .then( editor => {
                                                  console.log( editor );
                                          } )
                                          .catch( error => {
                                                  console.error( error );
                                          } );
                              </script>

                            </div>
                          </div>
                  			<div class="col-md-12 col-sm-12 col-xs-12 form-group has-feedback">
                          <div class="row">
                            <div class="col-md-2" style="padding-left: 20px;padding-top: 10px;">
                              <label>Ảnh</label>
                            </div>
                            <div class="col-md-10">
                              <input type="file" class="form-control has-feedback-left" placeholder="" name="image" id="image" >
                                <span class="fa fa-graduation-cap form-control-feedback left" aria-hidden="true"></span>
                            </div>
                          </div>
                        </div>

			                  </div>
                  		</div>

                  	</div>



                  		<div class="row">
                  			<div class="col-md-2 col-md-offset-4">
                          <button type="button" onclick="location.href='?mod=admin&act=book'" class="btn btn-info ">Quay lại</button>
                        </div>
                        <div class="col-md-2">
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
<script type="text/javascript " src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
<script type="text/javascript">
	$('#myDatepicker2').datetimepicker({
        format: 'DD.MM.YYYY'
    });
</script>
<script>
  $(document).ready(function () {
    $('#create-book').submit(function(e){
      e.preventDefault();
      $.ajax({
        url : $(this).attr('action'),
        type : $(this).attr('method'),
        data : $(this).serialize(),
        success : function(res) {
          if(JSON.parse(res) === false) {
            toastr.error("Mã sách đã tồn tại!");
          }
        }
      })
    })
  })
</script>
