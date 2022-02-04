var nicescroll;
let nicescroll_opts = {
    cursoropacitymin: 0,
    cursoropacitymax: .8,
    zindex: 892
  }, now_layout_class = null;

var update_nicescroll = function() {
    let a = setInterval(function() {
      if(nicescroll != null)
        nicescroll.resize();
    }, 10);

    setTimeout(function() {
      clearInterval(a);
    }, 600);
  }

  $("#div-to-scroll").scroll(function(){
    $(".nicescroll").getNiceScroll().resize();
  });

  $(".nicescroll").niceScroll(nicescroll_opts);

$('.item').hover(
function() {
    $('.description').css({opacity: 0, display: 'flex'}).animate({
        opacity: 1
    }, 1000);
},
function() {
    $('.description').fadeOut(1000);
});

