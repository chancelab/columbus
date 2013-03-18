$('#popover-notice-link').popover({
	html : true,
	content: function() {
		return $('#popover-notices').html();
	}
});
$(".nav .nav_NewIdea a").prepend('<i class="icon-lightbulb"></i> ');
$(".nav .nav_Setting a").prepend('<i class="icon-wrench"></i> ');
$(".nav .nav_MyProfile a").prepend('<i class="icon-user"></i> ');
$(".nav .nav_Logout a").prepend('<i class="icon-signout"></i> ');
$(document).ready(function(){
    $(".popover-notice-area").hover(function(){
        $(".popover-notice-area i")
            .animate({top:"0.5em"}, 200).animate({top:"0.9em"}, 200)
            .animate({top:"0.6em"}, 100).animate({top:"0.9em"}, 100)
            .animate({top:"0.8em"}, 100).animate({top:"0.9em"}, 100);
    });
});


