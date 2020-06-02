(function($) {
  "use strict"; // Start of use strict

  // Toggle the side navigation
  $("#sidebarToggle, #sidebarToggleTop").on('click', function(e) {
    $("body").toggleClass("sidebar-toggled");
    $(".sidebar").toggleClass("toggled");
    if ($(".sidebar").hasClass("toggled")) {
      $('.sidebar .collapse').collapse('hide');
    };
  });

  // Close any open menu accordions when window is resized below 768px
  $(window).resize(function() {
    if ($(window).width() < 768) {
      $('.sidebar .collapse').collapse('hide');
    };
  });

  // Prevent the content wrapper from scrolling when the fixed side navigation hovered over
  $('body.fixed-nav .sidebar').on('mousewheel DOMMouseScroll wheel', function(e) {
    if ($(window).width() > 768) {
      var e0 = e.originalEvent,
        delta = e0.wheelDelta || -e0.detail;
      this.scrollTop += (delta < 0 ? 1 : -1) * 30;
      e.preventDefault();
    }
  });

  // Scroll to top button appear
  $(document).on('scroll', function() {
    var scrollDistance = $(this).scrollTop();
    if (scrollDistance > 100) {
      $('.scroll-to-top').fadeIn();
    } else {
      $('.scroll-to-top').fadeOut();
    }
  });

  // Smooth scrolling using jQuery easing
  $(document).on('click', 'a.scroll-to-top', function(e) {
    var $anchor = $(this);
    $('html, body').stop().animate({
      scrollTop: ($($anchor.attr('href')).offset().top)
    }, 1000, 'easeInOutExpo');
    e.preventDefault();
  });

})(jQuery); // End of use strict

var listaFalta = [];

/**
 * Function used to add the judokas that are not present at class
 * @param id
 */
function addToList(id){
  var estaEnLista = false;
  var posicionEnLista = 0;
  for(var i = 0; i < listaFalta.length; i++){
    if(listaFalta[i] == id){
      estaEnLista = true;
      posicionEnLista = i;
    }
  }
  if(estaEnLista){
    listaFalta.splice(posicionEnLista,1);
  }
  else{
    listaFalta.push(id);
  }
};

/**
 * Confirms the list
 */
function sendList(){
  //TODO: hacer que envie al nuevo controlador
  alert(listaFalta);
  $.ajax({
    url: 'site/controller/ClasesController.php',
    type: 'post',
    data: {listaFalta: listaFalta},
    success: function (response) {
      if (response == 0) {
        var msg = "Error";
        $("#message").html(msg);
        var div = document.getElementById("message");
        div.classList.remove("d-none");
      } else if (response == 1) {
        window.location = "../Listar.php";
      }

    }

  });
};