<div class="modal fade" id="modal-add-quantity-book-<?=$value['id']?>">
								<div class="modal-dialog">
									<div class="modal-content">
										<div class="modal-header">
											<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
											<h4 class="modal-title">Thêm số lượng sản phẩm</h4>
										</div>
										<div class="modal-body">
											<div class="col-md-3">
												<img src="<?php echo $data['image'] ?>" alt="" style="width: 235px; height: 300px;">
											</div>
											<div class="col-md-8 col-md-offset-1">
												<div class="row">
													<div class="col-md-3"><b>Mã sách</b></div>
													<div class="col-md-9"><p><?=$data['code']?></p></div>
												</div>
												<div class="row">
													<div class="col-md-3"><b>Tên sách</b></div>
													<div class="col-md-9"><p><?=$data['name']?></p></div>
												</div>
												<div class="row">
													<div class="col-md-3"><b>Giá bán</b></div>
													<div class="col-md-9"><p><?=$data['price']?></p></div>
												</div>
												<div class="row">
													<div class="col-md-3"><b>Thể loại</b></div>
													<div class="col-md-9"><p><?=$data['type']?></p></div>
												</div>
												<div class="row">
													<div class="col-md-3"><b>Tác giả</b></div>
													<div class="col-md-9"><p><?=$data['author_name']?></p></div>
												</div>
												<div class="row">
													<div class="col-md-3"><b>Nhà xuất bản</b></div>
													<div class="col-md-9"><p><?=$data['publisher_name']?></p></div>
												</div>	
												<div class="row">
													<div class="col-md-3"><b>Description</b></div>
													<div class="col-md-9"><p><?=$data['description']?></p></div>
												</div>					
											</div>
										</div>
																		
										<div class="modal-footer">
											<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
											<button type="button" class="btn btn-primary">Save changes</button>
										</div>
									</div>
								</div>
							</div>	