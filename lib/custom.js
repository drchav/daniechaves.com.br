$(document).ready(function(){
	
	//--------------------------------- Tabs section setup  --------------------------------//
	
		$("#wrapper").easytabs({
    	animate			: true,
    	updateHash		: false,
    	transitionIn	:'slideDown',
    	transitionOut	:'slideUp',
    	animationSpeed	:800,
		tabActiveClass	:'active',
		tabs            :" #mainNav > ul > li",
		transitionInEasing: 'easeOutExpo',
	  	transitionOutEasing: 'easeInOutExpo'
    
    });
	
	//--------------------------------- End tabs section setup --------------------------------//
	

	//--------------------------------- Hover animation for the elements of the portfolio --------------------------------//

	$(".portfolio a").hover( function(){ 
		$(this).children("img").animate({ opacity: 0.55 }, "fast"); 
	}, function(){ 
		$(this).children("img").animate({ opacity: 1.0 }, "slow"); 
	}); 
	
	//--------------------------------- End hover animation for the elements of the portfolio --------------------------------//
	
	
	//--------------------------------- End initilaizing prettyPhoto for the clicked elements of the portfolio --------------------------------//
	
	$(".portfolio a[data-type^='prettyPhoto']").prettyPhoto({
		theme:'light_square', 
		autoplay_slideshow: false, 
		overlay_gallery: false, 
		show_title: false
	});
	
	//--------------------------------- End initilaizing prettyPhoto for the clicked elements of the portfolio  --------------------------------//
	
	
	//--------------------------------- Sorting portfolio elements with quicksand plugin  --------------------------------//
	var $portfolioClone = $(".portfolio").clone();
	
	$(".filter a").click(function(e){
		$(".filter li").removeClass("current");	
		var $filterClass = $(this).parent().attr("class");
		if ( $filterClass == "all" ) {
			var $filteredPortfolio = $portfolioClone.find("li");
		} else {
			var $filteredPortfolio = $portfolioClone.find("li[data-type~=" + $filterClass + "]");
		}
		$(".portfolio").quicksand( $filteredPortfolio, { 
			duration: 800,
			easing: 'easeInOutQuad' 
		}, function(){
						$(".portfolio a").hover( function(){ 
				$(this).children("img").animate({ opacity: 0.55 }, "fast"); 
			}, function(){ 
				$(this).children("img").animate({ opacity: 1.0 }, "slow"); 
			});
			 
			//--------------------------------- Reinitilaizing prettyPhoto for the new cloned elements of the portfolio --------------------------------//
			
			$(".portfolio a[data-type^='prettyPhoto']").prettyPhoto({
				theme:'light_square', 
				autoplay_slideshow: false, 
				overlay_gallery: false, 
				show_title: false
			});
			
			//--------------------------------- End reinitilaizing prettyPhoto for the new cloned elements of the portfolio --------------------------------//
			
		});


		$(this).parent().addClass("current");
		e.preventDefault();
	});
	
	//--------------------------------- End sorting portfolio elements with quicksand plugin --------------------------------//
	
	
	//-------------------------- Social Links hover animation -----------------------------------//
	
	$(".socialList1 li, .socialList2 li").hover( function(){ 
			$(this).find("img").animate({marginTop:"-7px"},200); 
	}, function(){ 
		$(this).find("img").animate({marginTop:"4px"},200); 
	});
	
//-------------------------- End social Links hover animation --------------------------------//


//-------------------------- Pattern switcher --------------------------------//

$('.switcher').click(
		function() {
			var pattNumb = $(this).attr("data-id");
			$('body').css("background-image","url(images/pattern/pattern"+pattNumb+".png)");
		});
   
       
//-------------------------- End pattern switcher --------------------------------//


// ----------------------------- Tooltip for the map image ---------------------------------//

$('#googlemap').poshytip({
	className: 'tooltip',
	showTimeout: 1,
	alignTo: 'target',
	alignX: 'right',
	offsetY: 15,
	allowTipHover: false
});

// ----------------------------- Tooltip for the map image ---------------------------------//


//--------------------------- Prettyphoto for the click on the map image ----------------------------//

	$("#contactInfo a[data-type^='prettyPhoto']").prettyPhoto({
		theme:'light_square', 
		autoplay_slideshow: false, 
		overlay_gallery: false, 
		show_title: false,
		show_navigation:false
	});
//--------------------------- End prettyphoto for the click on the map image ----------------------------//


//--------------------------- Form validation  ----------------------------//
$(".contactForm").validate();
//--------------------------- End form validation ----------------------------//



});
