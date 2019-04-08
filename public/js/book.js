// $('.btn-save-add-quantity').on('click', function() {
// 	var book_id = $("input[name = quantityadd]").val();
// 	var quantity = $("input[name = idaddquantity]").val();

// 	$.ajax({
// 		url : '?mod=admin&act=book&action=ajaxInforBookAddQuantity',
// 		type: 'POST',
// 		data: {
// 			book_id: book_id,
// 			quantity: quantity
// 		},
// 		success:function(response) {
// 			var data = JSON.parse(response);
//         	if(data.status == 'true') {
//         		toastr.success('Thêm số lượng thành công.')
// 				var url1 = '?mod=admin&act=book'; 
// 				document.location = url1;
// 			}else {
// 				toastr.error('Thêm không thành công không thành công.', 'Lỗi!')
// 				toastr.options.timeOut = 3000;
// 			}
// 		}
// 	});
// })