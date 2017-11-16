$(document.body).on("click", ".tab-title", function(){
	var ind = $(this).index();
	$(this).addClass("active");
	$(this).siblings().removeClass("active");
	$(this).parent().siblings(".tab-body").find(".tab-body-content").removeClass("active");
	$(this).parent().siblings(".tab-body").find(".tab-body-content").eq(ind).addClass("active");
});