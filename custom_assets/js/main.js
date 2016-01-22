



(function($){
	$("#sponsorarea .gooder .panel-heading a").on("click", function(){
		if($(this).children("i").hasClass("fa-angle-up") ){
			$(this).children("i").removeClass("fa-angle-up").addClass("fa-angle-down");
		}
		else{
			$(this).children("i").removeClass("fa-angle-down").addClass("fa-angle-up");
		}
		
	})
}(jQuery));