$(document).ready(function(){
	
	const updateScreen = response => {
	
		if(response.data.val == '1') {		
			$('#status_'+response.data.id).html('In Active');				
			$('#update_'+response.data.id).html('Publish');
			$('#update_'+response.data.id).attr('data-value', '0');
		} else {			
			$('#status_'+response.data.id).html('Active');				
			$('#update_'+response.data.id).html('Unpublish');		
			$('#update_'+response.data.id).attr('data-value', '1');
		}
		
	};
	$( "a[rel^='update']" ).on( "click", function() {
		$.ajax({
				type: "POST", dataType: "json", url: "/admin/book/update",
				data: {id:this.dataset['id'], status:this.dataset['value']},
				success: function(response, status) {			
					if (response.status == "success") {					
						updateScreen(response);	
					} else {
						console.log('Problem with update. Kindly check with Admin');						
					}
				}
		}); 
	});

	 
	});