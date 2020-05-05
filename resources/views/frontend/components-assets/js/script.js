jQuery(function ($) {
    try {
    	//slick dùng để tạo slide
        $('.list-timkhoahoc').slick({
		  dots: false,
		  infinite: true,
		  speed: 300,
		  slidesToShow: 1,  
		  autoplay: true, 
		  autoplaySpeed: 3000,
		  arrows: true,
		  responsive: [
		    {
		      breakpoint: 768,
		      settings: {
		        arrows: false,
		      }
		    }
		  ]
		});


		$('.list-partner').slick({
		 	slidesToScroll: 1,  
		  	slidesToShow: 6,
		  	arrows: true,	  
		  	autoplaySpeed: 3000,
		  	arrows: true,

		  	responsive: [
			    {
			      breakpoint: 768,
			      settings: {
			        arrows: false,
			        slidesToShow: 3
			      }
			    },
			    {
			      breakpoint: 480,
			      settings: {
			        slidesToShow: 2
			      }
			    }
			  ]
		});
		    
    } catch (e) {
        // console.log(e);
    }
});