$(document).ready(function () {
	$(document).on('click', '.open-detail', function(){
		
		var code = $(this).attr('slug-code');
		$.ajax({
			url : '?mod=admin&act=book&action=find-one&code=' + code,
			type : 'get',
			success : function(res){
				if(res){
					var data = JSON.parse(res);
					$('#modal-detail img').attr('src', data.book['image']);
					for (var key in data.book) {
					    if (data.book.hasOwnProperty(key)) {
					    	$('#modal-detail p[slug='+key+']').html(data.book[key]);
					    	if(key === 'price'){
					    		$('#modal-detail p[slug='+key+']').html(fomatVND(data.book[key]));
					    	}
					    }
					}
					data.site_book.forEach(function(sb){
						$('.site_book p[slug='+sb.scode+']').text(sb.quantity);
					})
					$('#modal-detail').modal('show');
				}
			}
		})
	});
	$(".delete-book").click(function(){
		var code = $(this).attr("slug-code");
		var path = "?mod=admin&act=book&action=delete&code=" + code;
		swal({
	        title: "Bạn có muốn xóa không?",
			icon: "warning",
			buttons: true,
			dangerMode: true,
		})
		.then((willDelete) => {
		  	if (willDelete) {
		  		 $.ajax({
		            type: "get",
		            url: path,
		            success: function(res)
		            {
		            	var data = JSON.parse(res);
		            	if(data === true) {
		            		toastr.success('Xóa thành công.', 'Xog!')
							setTimeout(function(){window.location.reload();}, 1000);
						}else {
							toastr.error('Xóa không thành công.', 'Lỗi!')
							toastr.options.timeOut = 3000;
						}
		            }

	            });
		  	}
		});    	
	});
	function fomatVND(input) {
        return input.toLocaleString('it-IT', {style : 'currency', currency : 'VND'});
    }
})