$(document).ready(function(){
    // delete wishlist Items 
	$(document).on('click','.remove_item',function(e){
		e.preventDefault();
		var product_id = $(this).closest('.product_data').find('.product_id').val();
		var result = confirm('are you sure to delete this ?');
		if(result){
		    $.ajax({
				headers: {
					'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
				},
				data:{
					'product_id':product_id,
				},
				url:'/wishlists/delete-wishlist-item',
				method:'POST',
				success:function(response){
					$('.WishlistItems').load(location.href +" .WishlistItems");
				}
			});
		}
	});
});