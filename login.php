<?php session_start();
include "fixed/head.php"; 
include "fixed/navigacija.php"; 
if(isset($_SESSION['ulogovan'])){
    http_response_code(404);
    header('Location:index.php');
}?>?>
<main class="login-bg">

<div class="login-form-area">
<div class="container">
<div class="row justify-content-center">
<div class="col-xl-7 col-lg-8">
<div class="login-form">

<div class="login-heading">
<span>Login</span>
<p>Enter Login details to get access</p>
</div>

<div class="input-box">
<div class="single-input-fields">
<label>Username or Email Address</label>
 <input type="email"  name="logEmail" id="logEmail" placeholder="Email address">
</div>
<p class=" alert-danger d-none alertemail" id="alertemail" role="alert">
</p>
<div class="single-input-fields">
<label>Password</label>
<input type="password" name="logPass" id="logPass" placeholder="Enter Password">
</div>
<p class=" alert-danger d-none alertpass" id="alertemail" role="alert">
</p>

</div>

<div class="login-footer">
<p>Don’t have an account? <a href="register.php">Sign Up</a> here</p>
<button class="submit-btn3 logButton" name="logButton">Login</button>
</div>
<div class="login-footer sesija">
</div>
<?php
// $promenljiva=$_SESSION['ulogovan'];
// var_dump($promenljiva->Uloga);
// if($_SESSION['neuspeh']){
//     echo "<p>".$_SESSION['neuspeh']."</p>";
// }
// else{
//     unset($_SESSION['neuspeh']);
//}
?>
</div>
</div>
</div>
</div>
</div>

</main>


<script src="assets/js/vendor/modernizr-3.5.0.min.js"></script>
<script src="assets/js/vendor/jquery-1.12.4.min.js"></script>
<script src="assets/js/popper.min.js"></script>
<script src="assets/js/bootstrap.min.js"></script>

<script src="assets/js/owl.carousel.min.js"></script>
<script src="assets/js/slick.min.js"></script>
<script src="assets/js/jquery.slicknav.min.js"></script>

<script src="assets/js/wow.min.js"></script>
<script src="assets/js/animated.headline.js"></script>
<script src="assets/js/jquery.magnific-popup.js"></script>
<script src="assets/js/gijgo.min.js"></script>
<script src="assets/js/lightslider.min.js"></script>
<script src="assets/js/price_rangs.js"></script>

<script src="assets/js/jquery.nice-select.min.js"></script>
<script src="assets/js/jquery.sticky.js"></script>
<script src="assets/js/jquery.barfiller.js"></script>

<script src="assets/js/jquery.counterup.min.js"></script>
<script src="assets/js/waypoints.min.js"></script>
<script src="assets/js/jquery.countdown.min.js"></script>
<script src="assets/js/hover-direction-snake.min.js"></script>

<script src="assets/js/contact.js"></script>
<script src="assets/js/jquery.form.js"></script>
<script src="assets/js/jquery.validate.min.js"></script>
<script src="assets/js/mail-script.js"></script>
<script src="assets/js/jquery.ajaxchimp.min.js"></script>

<script src="assets/js/plugins.js"></script>
<script src="assets/js/main.js"></script>
<script>
(function($)
{"use strict"
$(window).on('load',function(){$('#preloader-active').delay(450).fadeOut('slow');$('body').delay(450).css({'overflow':'visible'});});$(window).on('scroll',function(){var scroll=$(window).scrollTop();if(scroll<400){$(".header-sticky").removeClass("sticky-bar");$('#back-top').fadeOut(500);}else{$(".header-sticky").addClass("sticky-bar");$('#back-top').fadeIn(500);}});$('#back-top a').on("click",function(){$('body,html').animate({scrollTop:0},800);return false;});var menu=$('ul#navigation');if(menu.length){menu.slicknav({prependTo:".mobile_menu",closedSymbol:'+',openedSymbol:'-'});};function mainSlider(){var BasicSlider=$('.slider-active');BasicSlider.on('init',function(e,slick){var $firstAnimatingElements=$('.single-slider:first-child').find('[data-animation]');doAnimations($firstAnimatingElements);});BasicSlider.on('beforeChange',function(e,slick,currentSlide,nextSlide){var $animatingElements=$('.single-slider[data-slick-index="'+nextSlide+'"]').find('[data-animation]');doAnimations($animatingElements);});BasicSlider.slick({autoplay:true,autoplaySpeed:4000,dots:false,fade:true,arrows:false,prevArrow:'<button type="button" class="slick-prev"><i class="ti-angle-left"></i></button>',nextArrow:'<button type="button" class="slick-next"><i class="ti-angle-right"></i></button>',responsive:[{breakpoint:1024,settings:{slidesToShow:1,slidesToScroll:1,infinite:true,}},{breakpoint:991,settings:{slidesToShow:1,slidesToScroll:1,arrows:false}},{breakpoint:767,settings:{slidesToShow:1,slidesToScroll:1,arrows:false}}]});function doAnimations(elements){var animationEndEvents='webkitAnimationEnd mozAnimationEnd MSAnimationEnd oanimationend animationend';elements.each(function(){var $this=$(this);var $animationDelay=$this.data('delay');var $animationType='animated '+$this.data('animation');$this.css({'animation-delay':$animationDelay,'-webkit-animation-delay':$animationDelay});$this.addClass($animationType).one(animationEndEvents,function(){$this.removeClass($animationType);});});}}
mainSlider();$('.owl-carousel').owlCarousel({autoplay:true,center:true,loop:true,nav:true,items:1});var nice_Select=$('select');if(nice_Select.length){nice_Select.niceSelect();}
$("[data-background]").each(function(){$(this).css("background-image","url("+$(this).attr("data-background")+")")});new WOW().init();function mailChimp(){$('#mc_embed_signup').find('form').ajaxChimp();}
mailChimp();var popUp=$('.single_gallery_part, .img-pop-up');if(popUp.length){popUp.magnificPopup({type:'image',gallery:{enabled:true}});}
var popUp=$('.popup-video');if(popUp.length){popUp.magnificPopup({type:'iframe'});}
$('.counter').counterUp({delay:10,time:3000});$('#datepicker1').datepicker();$('#timepicker').timepicker();$(".snake").snakeify({speed:200});$('#bar1').barfiller();$('#bar2').barfiller();$('.search-switch').on('click',function(){$('.search-model-box').fadeIn(400);});$('.search-close-btn').on('click',function(){$('.search-model-box').fadeOut(400,function(){$('#search-input').val('');});});var product_overview=$('#vertical');if(product_overview.length){product_overview.lightSlider({gallery:true,item:1,verticalHeight:450,thumbItem:4,slideMargin:0,speed:600,autoplay:true,responsive:[{breakpoint:991,settings:{item:1,}},{breakpoint:576,settings:{item:1,slideMove:1,verticalHeight:350,}}]});}
(function(){window.inputNumber=function(el){var min=el.attr('min')||false;var max=el.attr('max')||false;var els={};els.dec=el.prev();els.inc=el.next();el.each(function(){init($(this));});function init(el){els.dec.on('click',decrement);els.inc.on('click',increment);function decrement(){var value=el[0].value;value--;if(!min||value>=min){el[0].value=value;}}
function increment(){var value=el[0].value;value++;if(!max||value<=max){el[0].value=value++;}}}}})();inputNumber($('.input-number'));})(jQuery);</script>
</body>
</html>