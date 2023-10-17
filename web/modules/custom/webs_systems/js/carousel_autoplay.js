/**
 * @file
 * Plantilla web behaviors.
 */
(function (Drupal,$) {

  'use strict';

  Drupal.behaviors.moduloWsautoplay = {
    attach: function (context, settings) { 
    	
    	$('.autoplay').slick({
		  slidesToShow: 5,
		  slidesToScroll: 1,
		  autoplay: true,
		  autoplaySpeed: 2000,
		  mobileFirst: true,
		  responsive: [
		  	{
		      breakpoint: 300,  // Hasta 300
		      settings: {
		        slidesToShow: 1,
		        slidesToScroll: 1
		      }
		    },
		    {
		      breakpoint: 480,  // Hasta 480px
		      settings: {
		        slidesToShow: 1,
		        slidesToScroll: 1
		      }
		    },
		    {
		      breakpoint: 575,  // Hasta 575px
		      settings: {
		        slidesToShow: 2,
		        slidesToScroll: 1
		      }
		    },
		    {
		      breakpoint: 768,  // Hasta 768px
		      settings: {
		        slidesToShow: 3,
		        slidesToScroll: 1
		      }
		    },
		    {
		      breakpoint: 992,  // Hasta 992px
		      settings: {
		        slidesToShow: 4,
		        slidesToScroll: 1
		      }
		    },
		    {
		      breakpoint: 1200,  // Hasta 1200px
		      settings: {
		        slidesToShow: 5,
		        slidesToScroll: 1
		      }
		    }
		    // Agregar más configuraciones según sea necesario
		  ]
		});
    }
  };
	

} (Drupal,jQuery));







