$(document.body).on("click", ".tab-title", function(){
	var ind = $(this).index() + 1;
	$(this).addClass("active");
	$(this).siblings().removeClass("active");
	$(this).parent().siblings(".tab-body").removeClass("active");
	$(this).parent().siblings(".tab-body-" + ind).addClass("active");
});