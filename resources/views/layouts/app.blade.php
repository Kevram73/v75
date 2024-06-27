<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="{{asset('/images/V75.png')}}" style="border-radius: 100%;">

    <title>{{config('app.name', 'V75 pro')}} | Dashboard </title>

	<!-- Vendors Style-->
	<link rel="stylesheet" href="{{asset('/src/css/vendors_css.css')}}">

	<!-- Style-->
	<link rel="stylesheet" href="{{asset('/src/css/style.css')}}">
	<link rel="stylesheet" href="{{asset('/src/css/skin_color.css')}}">

	  <link rel="stylesheet" href="{{asset('/src/css/custom.css')}}">
 <link rel="stylesheet" href="{{asset('/src/css/responsive.css')}}">

  </head>

<body class="hold-transition light-skin sidebar-mini theme-primary fixed">

<div class="wrapper">
	<div id="loader"></div>

  <header class="main-header">
	<div class="d-flex align-items-center logo-box justify-content-start">
		<!-- Logo -->
		<a href="#" class="logo">
		  <!-- logo-->
		  <div class="logo-mini w-60">
			  <span class="light-logo"><img src="{{asset('/images/V75.png')}}" alt="logo" style="border-radius:100%; border:1px solid rgba(252, 254, 252, 0.24);"></span>

			  {{-- <span class="light-logo"><img src="../../../images/V75.png" alt="logo" style="border-radius:100%; border:1px solid rgba(252, 254, 252, 0.24);"></span> --}}
		  </div>
		  <div class="logo-lg">
              <span class="light-logo" style="font-family:sans-serif; font-size:30px; font-weight:600; color:black; line-height:80px;">Admin</span>

              {{-- <span class="light-logo" style="font-family:sans-serif; font-size:30px; font-weight:600; color:white; line-height:80px;">Admin</span> --}}
          </div>
		</a>
	</div>
    <!-- Header Navbar -->
    <nav class="navbar navbar-static-top">
      <!-- Sidebar toggle button-->
	  <div class="app-menu">
		<ul class="header-megamenu nav">
			<li class="btn-group nav-item">
				<a href="#" class="waves-effect waves-light nav-link push-btn btn-primary-light" data-toggle="push-menu" role="button">
					<i data-feather="menu"></i>
			    </a>
			</li>
			<li class="btn-group d-lg-inline-flex d-none">
				<div class="app-menu">
					<div class="search-bx mx-9">
                        <div class="input-group">
                            <h4 style="line-height: 45px;">  <span style="color: green;"> </span></h4>
                        </div>
					</div>
				</div>
			</li>
		</ul>
	  </div>

      <div class="navbar-custom-menu r-side">
        <ul class="nav navbar-nav">
            <li class="btn-group d-md-inline-flex d-none">
                <label class="switch">
                    <span class="waves-effect skin-toggle waves-light">
                        <input type="checkbox" data-mainsidebarskin="toggle" id="toggle_left_sidebar_skin">
                        <span class="switch-on"><i data-feather="moon"></i></span>
                        <span class="switch-off"><i data-feather="sun"></i></span>
                    </span>
                </label>
            </li>
			{{-- <li class="btn-group d-xl-inline-flex d-none">
			    <a href="#" class="waves-effect waves-light nav-link btn-primary-light svg-bt-icon dropdown-toggle" data-bs-toggle="dropdown">
					<img class="rounded" src="../../../images/svg-icon/usa.svg" alt="">
				</a>
			    <div class="dropdown-menu">
					<a class="dropdown-item my-5" href="#"><img class="w-20 rounded me-10" src="../../../images/svg-icon/usa.svg" alt=""> English</a>
					<a class="dropdown-item my-5" href="#"><img class="w-20 rounded me-10" src="../../../images/svg-icon/spain.svg" alt=""> Spanish</a>
					<a class="dropdown-item my-5" href="#"><img class="w-20 rounded me-10" src="../../../images/svg-icon/ger.svg" alt=""> German</a>
					<a class="dropdown-item my-5" href="#"><img class="w-20 rounded me-10" src="../../../images/svg-icon/jap.svg" alt=""> Japanese</a>
					<a class="dropdown-item my-5" href="#"><img class="w-20 rounded me-10" src="../../../images/svg-icon/fra.svg" alt=""> French</a>
			    </div>
			</li> --}}

			<li class="btn-group nav-item d-xl-inline-flex d-none">
				<a href="#" data-provide="fullscreen" class="waves-effect waves-light nav-link btn-primary-light svg-bt-icon" title="Plein écran">
					<i data-feather="maximize"></i>
			    </a>
			</li>
          <!-- Control Sidebar Toggle Button -->
          {{-- <li class="btn-group nav-item d-xl-inline-flex d-none">
              <a href="#" data-toggle="control-sidebar" title="Paramètre" class="waves-effect waves-light nav-link btn-primary-light svg-bt-icon">
			  	<i data-feather="sliders"></i>
			  </a>
          </li> --}}

			<!-- User Account-->
			<li class="dropdown user user-menu">
				<a href="#" class="waves-effect waves-light dropdown-toggle w-auto l-h-12 bg-transparent p-0 no-shadow" title="User" data-bs-toggle="modal" data-bs-target="#quick_user_toggle">
					<img src="{{asset('/images/ui.jpg')}}" class="avatar rounded bg-primary-light" alt="" title="profil"/>
				</a>
			</li>
        </ul>
      </div>
    </nav>
  </header>


  @include('inc.adminMenu')


  @yield('content')


  <footer class="main-footer">
    <div class="pull-right d-none d-sm-inline-block">
        <ul class="nav nav-primary nav-dotted nav-dot-separated justify-content-center justify-content-md-end">
		  <li class="nav-item">
			<a class="nav-link text-info" href="/" target="_blank">Retour à l'accueil</a>
		  </li>
		</ul>
    </div>
	  &copy; <script>document.write(new Date().getFullYear())</script> <a href="#">v75 pro</a>. All Rights Reserved.
  </footer>
  <!-- Side panel -->

  @include('modal.adminModal')
  <!-- quick_user_toggle -->

  <!-- Add the sidebar's background. This div must be placed immediately after the control sidebar -->
  <div class="control-sidebar-bg"></div>

</div>
<!-- ./wrapper -->

	<!-- Page Content overlay -->

	<!-- Vendor JS -->

	<script src="{{asset('/src/js/vendors.min.js')}}"></script>
	<script src="{{asset('/src/js/pages/chat-popup.js')}}"></script>
    <script src="{{asset('/assets/icons/feather-icons/feather.min.js')}}"></script>

	<script src="{{asset('/assets/vendor_components/raphael/raphael.min.js')}}"></script>
	<script src="{{asset('/assets/vendor_components/morris.js/morris.min.js')}}"></script>
	<script src="{{asset('/assets/vendor_components/apexcharts-bundle/dist/apexcharts.js')}}"></script>

	<!-- InvestX App -->
	<script src="{{asset('/src/js/demo.js')}}"></script>
	<script src="{{asset('/src/js/template.js')}}"></script>

	<script src="{{asset('/src/js/pages/custom.js')}}"></script>
	<script src="{{asset('/src/js/pages/apex_charts.js')}}"></script>
	<script src="{{asset('/src/js/pages/chart-widgets.js')}}"></script>

    @stack('datatable')
    @stack('editor')
    @stack('profile')
    @stack('home')
</body>
</html>
