(function ($, Drupal, once) {

  'use strict';

  /**
   * Attaches the behavior to bootstrap carousel view.
   */
  Drupal.behaviors.views_bootstrap_carousel = {
    attach: function (context, settings) {
      const observer = new ResizeObserver(entries => {
        var ratio = entries[0].target.querySelector(".carousel-item").offsetWidth/entries[0].target.parentElement.cardWidth;
        entries[0].target.parentElement.cardWidth = entries[0].target.querySelector(".carousel-item").offsetWidth;
        entries[0].target.querySelectorAll(".carousel-item").forEach(function(element){
          element.style.left = ((element.style.left) ? (parseInt(element.style.left, 10)*ratio)+"px" : '');
        });
      });

      var multipleCardCarousel = document.querySelector(".views-bootstrap-multi-item");
      once('views-bootstrap-multi-item',".views-bootstrap-multi-item", context).forEach(function (carousel,i) {
        observer.observe(carousel.querySelector(".carousel-inner"));
        var items = carousel.querySelectorAll(".carousel-item");
        carousel.cardWidth = items[0].offsetWidth;

        carousel.addEventListener('slide.bs.carousel', function(event){
          if(event.direction === "left"){
            items.forEach(function(element){
              $(element).animate({left: ((element.style.left) ? parseInt(element.style.left, 10) : 0)+(-carousel.cardWidth)});
              //element.style.left = ((element.style.left) ? parseInt(element.style.left, 10) : 0) +(-cardWidth)+"px";
            });
          }else {
            $(items[event.from]).promise().done(function(){
              items[event.to].style.left = (((items[event.to].style.left) ? parseInt(items[event.to].style.left, 10) : 0)-items.length*carousel.cardWidth)+"px";
            });
          }
        });

        carousel.addEventListener('slid.bs.carousel', function(event){
          if(event.direction === "right"){
            items.forEach(function(element){
              $(element).animate({left: ((element.style.left) ? parseInt(element.style.left, 10) : 0)+carousel.cardWidth});
              //element.style.left = ((element.style.left) ? parseInt(element.style.left, 10) : 0)+cardWidth+"px";
            });
          }else{
            $(items[event.from]).promise().done(function(){
              items[event.from].style.left = (((items[event.from].style.left) ? parseInt(items[event.from].style.left, 10) : 0)+items.length*carousel.cardWidth)+"px";
            });
          }
        });
      });
    }
  }
})(jQuery, Drupal, once);
