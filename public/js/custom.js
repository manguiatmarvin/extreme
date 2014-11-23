$(function() {
	//auto destruct dissmissable flash message 
	setTimeout(
			  function() 
			  {
				  for(i=0;i<3;i++) {
					  $('.alert-dismissable').fadeTo('fast', 0.5).fadeTo('fast', 1.0);
                  }
				  fadeOut();
				  
			  }, 300);
	
	
	
	function fadeOut(){
		setTimeout(
				  function(){
					  $('.alert-dismissable').fadeOut('slow');	  
					  
				  },5000);	
	}
	
	
	$('#image-file').addClass( "btn btn-primary" );
	
	$('#vplay-add-likes').click(function(e) {
		e.preventDefault();
		
		$(this).prop('disabled', true);
		var _id = $('input:hidden[name=player_video_id]').val();
		var _url = "/videos/add-video-likes-json/"+_id;
		
		$.ajax({
			  type: "POST",
			  url: _url,
			  data: {'video_id':_id},
			  success: function(e){
				  if(e.result !='failed'){
					  $('#vplay-add-likes').html('<i class="fa  fa-thumbs-up">'+e.result); 
				  }
			  },
			  dataType:'json'
			});
	});
	
	$('#vplay-add-dislikes').click(function(e) {
		e.preventDefault();
		
		$(this).prop('disabled', true);
		
		var _id = $('input:hidden[name=player_video_id]').val();
		var _url = "/videos/add-video-dislikes-json/"+_id;
		
		$.ajax({
			  type: "POST",
			  url: _url,
			  data: {'video_id':_id},
			  success: function(e){
				  //alert(e.result);
				  if(e.result !='failed'){
					  $('#vplay-add-dislikes').html('<i class="fa  fa-thumbs-down">'+e.result); 
				  }
			
			  },
			  dataType:'json'
			});
		  
	});
	
	$(".basic").jRating({
	  isDisabled : true,
	  step:false,
	  length :5,
	  sendRequest : false,
	  decimalLength:2
	  
	});
	
	
});// end function