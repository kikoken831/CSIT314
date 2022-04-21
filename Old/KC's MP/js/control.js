/*Without jQuery Cookie*/
$(document).ready(function(){
	$("#chalet").css("display","none");
            
    $(".deliverto").click(function(){
    	if ($('input[name=deliver]:checked').val() == "chalet" ) {
        	$("#chalet").slideDown("fast"); //Slide Down Effect   
        } else {
            $("#chalet").slideUp("fast");	//Slide Up Effect
        }
     });            
});

$(document).ready(function(){
  $("#home").css("display","none");
            
    $(".deliverto").click(function(){
      if ($('input[name=deliver]:checked').val() == "home" ) {
          $("#home").slideDown("fast"); //Slide Down Effect   
        } else {
            $("#home").slideUp("fast"); //Slide Up Effect
        }
     });            
});

