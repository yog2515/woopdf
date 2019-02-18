jQuery(document).ready(function($){
	jQuery('.pdfbtn_cls').click(function(e){
		var post_id = jQuery(this).attr("id");
		jQuery.ajax({
			url : ajaxurl,
			type : 'post',
			data : {
				"action" : 'woopdf_pdf_data',
				"post_id" : post_id,
			},
			success : function( response ) {
				if(!response.error) {
					alert(response);
				}
			} 
		});   
	});
});