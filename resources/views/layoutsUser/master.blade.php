<!DOCTYPE html>
<html lang="en">
  <head>
    @include('layoutsUser.header')
  </head>
<body>
<div id="header">
<div class="container">
<div id="welcomeLine" class="row">
<div class="span6">Welcome!<strong></strong></div>
	<div class="span6">
	<div class="pull-right">
		<a href="/addToCart"><span class="btn btn-mini btn-primary"><i class="icon-shopping-cart icon-white"></i> [ {{ count(Cart::content()) }} ] Items in your cart </span> </a> 
	</div>
	</div>
</div>
<!-- Navbar ================================================== -->
<div id="logoArea" class="navbar">
@include('layoutsUser.navbar')
</div>
</div>
</div>
<!-- Header End====================================================================== -->

<div id="mainBody">
	<div class="container">
	<div class="row">
<!-- Sidebar ================================================== -->
	<div id="sidebar" class="span3">
		@include('layoutsUser.sidebar')
	</div>
<!-- Sidebar end=============================================== -->
		<?php
			$barangs = \DB::table('products')->inRandomOrder()->limit(12)->get();
			$barangsActive = \DB::table('products')->inRandomOrder()->limit(4)->get();
		?>
		

		<!-- Latest Products ===================================================== -->

			  @yield('content')	

		<!-- End Latest Products ================================================== -->
		</div>
		</div>
	</div>
</div>
<!-- Footer ================================================================== -->
	<div  id="footerSection">
	<div class="container">
		<div class="row">
			<div class="span3">
				<h5>ACCOUNT</h5>
				<a href="login.html">YOUR ACCOUNT</a>
				<a href="login.html">PERSONAL INFORMATION</a> 
				<a href="login.html">ADDRESSES</a> 
				<a href="login.html">DISCOUNT</a>  
				<a href="login.html">ORDER HISTORY</a>
			 </div>
			<div class="span3">
				<h5>INFORMATION</h5>
				<a href="contact.html">CONTACT</a>  
				<a href="register.html">REGISTRATION</a>  
				<a href="legal_notice.html">LEGAL NOTICE</a>  
				<a href="tac.html">TERMS AND CONDITIONS</a> 
				<a href="faq.html">FAQ</a>
			 </div>
			<div class="span3">
				<h5>OUR OFFERS</h5>
				<a href="#">NEW PRODUCTS</a> 
				<a href="#">TOP SELLERS</a>  
				<a href="special_offer.html">SPECIAL OFFERS</a>  
				<a href="#">MANUFACTURERS</a> 
				<a href="#">SUPPLIERS</a> 
			 </div>
			<div id="socialMedia" class="span3 pull-right">
				<h5>SOCIAL MEDIA </h5>
				<a href="#"><img width="60" height="60" src="{{asset('asset/user/themes/images/facebook.png')}}" title="facebook" alt="facebook"/></a>
				<a href="#"><img width="60" height="60" src="{{asset('asset/user/themes/images/twitter.png')}}" title="twitter" alt="twitter"/></a>
				<a href="#"><img width="60" height="60" src="{{asset('asset/user/themes/images/youtube.png')}}" title="youtube" alt="youtube"/></a>
			 </div> 
		 </div>
		<p class="pull-right">&copy; Bootshop</p>
	</div><!-- Container End -->
	</div>
<!-- Placed at the end of the document so the pages load faster ============================================= -->
	@include('layoutsUser.script')
	@yield('scripts')
	
	<!-- Themes switcher section ============================================================================================= -->

<span id="themesBtn"></span>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js"
        integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN"
        crossorigin="anonymous"></script>
<script src="{{asset('frontEnd/js/bootstrap.min.js')}}"></script>
<script src="{{asset('frontEnd/js/jquery.scrollUp.min.js')}}"></script>
<script src="{{asset('frontEnd/js/price-range.js')}}"></script>
<script src="{{asset('frontEnd/js/jquery.prettyPhoto.js')}}"></script>
<script src="{{asset('frontEnd/js/main.js')}}"></script>
<script src="{{asset('easyzoom/dist/easyzoom.js')}}"></script>
<script src="{{asset('frontEnd/js/select2.min.js')}}"></script>
<script>
    // Instantiate EasyZoom instances
    var $easyzoom = $('.easyzoom').easyZoom();

    // Setup thumbnails example
    var api1 = $easyzoom.filter('.easyzoom--with-thumbnails').data('easyZoom');

    $('.thumbnails').on('click', 'a', function(e) {
        var $this = $(this);

        e.preventDefault();

        // Use EasyZoom's `swap` method
        api1.swap($this.data('standard'), $this.attr('href'));
    });

    // Setup toggles example
    var api2 = $easyzoom.filter('.easyzoom--with-toggle').data('easyZoom');

    $('.toggle').on('click', function() {
        var $this = $(this);
        if ($this.data("active") === true) {
            $this.text("Switch on").data("active", false);
            api2.teardown();
        } else {
            $this.text("Switch off").data("active", true);
            api2._init();
        }
    });

    $(document).ready(function() { 
            $("select").select2(); 

    });
    var token='{{ Session::token() }}';
</script>


</body>
</html>