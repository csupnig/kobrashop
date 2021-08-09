$(document).ready(function () {
	//Initialization
	function reloadPage() {
		window.location.reload();
	}

	/*=================================== Snippets ===================================*/

	//Carousel (Cycle)
	$(".carousel.cycle .next").click(function() {
		$(this).closest(".carousel").find(".items .item:first-of-type").insertAfter($(this).closest(".carousel").find(".items .item:last-of-type"));
	});
	$(".carousel.cycle .previous").click(function() {
		$(this).closest(".carousel").find(".items .item:last-of-type").insertBefore($(this).closest(".carousel").find(".items .item:first-of-type"));
	});

	//Carousel (Direct access) - navigation via direct link buttons
	$(".carousel.directAccess button.direct").click(function() {
		//Manage button appearance
		$(this).closest(".carousel.directAccess").find("button.direct.active").removeClass("active");
		$(this).addClass("active");
		//Show selected element
		selection = $(this).attr("data-selection");
		console.log(selection);
		$(this).closest(".carousel.directAccess").find(".item").hide();
		$(this).closest(".carousel.directAccess").find(".item#"+selection).show();
	});
	//Carousel (Direct access) - navigation via next/previous buttons
	$(".carousel.directAccess button.next").click(function() {
		if ($(".carousel.directAccess button.direct.active").next().length) {
			//Manage button appearance
			$(".carousel.directAccess button.direct.active").removeClass("active").next().addClass("active");
			//Show selected element
			selection = $(".carousel.directAccess button.direct.active").attr("data-selection");
		} else {
			//Manage button appearance
			$(".carousel.directAccess button.direct.active").removeClass("active")
			$(".carousel.directAccess button.direct:first").addClass("active");
			//Show selected element
			selection = $(".carousel.directAccess button.direct:first").attr("data-selection");
		}
		$(this).parent().parent().find(".item").hide();
		$(this).parent().parent().find(".item."+selection).show();
	});
	$(".carousel.directAccess button.previous").click(function() {
		if ($(".carousel.directAccess button.direct.active").prev().length) {
			//Manage button appearance
			$(".carousel.directAccess button.direct.active").removeClass("active").prev().addClass("active");
			//Show selected element
			selection = $(".carousel.directAccess button.direct.active").attr("data-selection");
		} else {
			//Manage button appearance
			$(".carousel.directAccess button.direct.active").removeClass("active")
			$(".carousel.directAccess button.direct:last").addClass("active");
			//Show selected element
			selection = $(".carousel.directAccess button.direct:last").attr("data-selection");
		}
		$(this).parent().parent().find(".item").hide();
		$(this).parent().parent().find(".item."+selection).show();
	});

	//Carousel (Sliding cycle - Equal width items)
	$(".carousel.slide .next").click(function() {
		if (!$(this).closest(".carousel").find(".items").is(":animated")) {
			$(this).closest(".carousel").find(".items").animate({left: "-="+$(this).closest(".carousel").find(".items .item:first-of-type").outerWidth(true)}, function() {
				$(this).closest(".carousel").find(".items .item:first-of-type").insertAfter($(this).closest(".carousel").find(".items .item:last-of-type"));
				$(this).closest(".carousel").find(".items").css({left: 0});
			});
		}
	});
	$(".carousel.slide .previous").click(function() {
		if (!$(this).closest(".carousel").find(".items").is(":animated")) {
			$(this).closest(".carousel").find(".items").css({left: "-="+$(this).closest(".carousel").find(".items .item:first-of-type").outerWidth(true)});
			$(this).closest(".carousel").find(".items .item:last-of-type").insertBefore($(this).closest(".carousel").find(".items .item:first-of-type"));
			$(this).closest(".carousel").find(".items").animate({left: 0});
		}
	});

	//Carousel (Multiple sliding cycles controlled through one navigation)
	$(".carousel.multiSlide .next").click(function() {
		if (!$(this).closest(".carousel").find(".items.active").is(":animated")) {
			$(this).closest(".carousel").find(".items.active").animate({left: "-="+$(this).closest(".carousel").find(".items.active .item:first-of-type").outerWidth(true)}, function() {
				$(this).closest(".carousel").find(".items.active .item:first-of-type").insertAfter($(this).closest(".carousel").find(".items.active .item:last-of-type"));
				$(this).closest(".carousel").find(".items.active").css({left: 0});
			});
		}
	});
	$(".carousel.multiSlide .previous").click(function() {
		if (!$(this).closest(".carousel").find(".items.active").is(":animated")) {
			$(this).closest(".carousel").find(".items.active").css({left: "-="+$(this).closest(".carousel").find(".items.active .item:first-of-type").outerWidth(true)});
			$(this).closest(".carousel").find(".items.active .item:last-of-type").insertBefore($(this).closest(".carousel").find(".items.active .item:first-of-type"));
			$(this).closest(".carousel").find(".items.active").animate({left: 0});
		}
	});

	//Lightbox
	$(".lightbox").click(function() {
		$(this).toggleClass("active");
	});
});
