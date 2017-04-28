<!doctype html>
<html lang="en">
<head>
	<meta charset="utf-8" />
	<link rel="icon" type="image/png" href="assets/img/favicon.ico">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
	<meta name="csrf-token" content="{{ csrf_token() }}">
	<title>FOMO Admin Panel</title>
	<meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport' />
  	<meta name="viewport" content="width=device-width" />

  	<!-- Bootstrap core CSS     -->
  	<link href="/css/bootstrap.min.css" rel="stylesheet" />

  	<!-- Animation library for notifications   -->
  	<link href="/css/animate.min.css" rel="stylesheet"/>

  	<!--  Light Bootstrap Table core CSS    -->
  	<link href="/css/light-bootstrap-dashboard.css" rel="stylesheet"/>

	{{-- Sweet alert core css --}}
	<link href="/css/sweetalert.css" rel="stylesheet">

	{{-- datatable --}}
	<link rel="stylesheet" href="/css/material.min.css">
	<link rel="stylesheet" href="/css/dataTables.material.min.css">

	{{-- light slider --}}
	<link rel="stylesheet" href="/css/lightslider.min.css">

  	<!--     Fonts and icons     -->
  	<link href="http://maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet">
  	<link href='http://fonts.googleapis.com/css?family=Roboto:400,700,300' rel='stylesheet' type='text/css'>
  	<link href="/css/pe-icon-7-stroke.css" rel="stylesheet" />
	<link href="/css/jquery.tagsinput.css" rel="stylesheet" />
	<link href="/css/app.css" rel="stylesheet">
</head>
<body>
<div class="wrapper" id="admin-wrapper">
  	<div class="sidebar" data-color="" data-image="/images/sidebar-5.jpg">
	{{-- <div class="sidebar" data-color="azure" data-image="/images/sidebar-5.jpg"> --}}
  		<div class="sidebar-wrapper">
      		<div class="logo">
        		<a href="/admin" class="simple-text">
					<img src="/images/logo-white.svg" alt="">
					<span>FOMO</span>
        		</a>
      		</div>

            <ul class="nav">
                <li class="@yield('dashboard-sidebar')">
                    <a href="/admin">
                        <i class="pe-7s-graph"></i>
                        <p>Dashboard</p>
                    </a>
                </li>
				<li class="@yield('product-nav')">
					<a data-toggle="collapse" href="#product-dropdown">
						<i class="pe-7s-wristwatch"></i>
						<p>
							Product
							<b class="caret"></b>
						</p>
					</a>
					<div id="product-dropdown" class="collapse @yield('product-dropdown-status')">
						<ul class="nav" style="margin-top: 0px;">
							<li class="@yield('products-dropdown-nav')">
								<a href="/admin/product" style="padding-left: 60px;">
									Products
								</a>
							</li>
							<li class="@yield('inventory-dropdown-nav')">
								<a href="/admin/product/inventory" style="padding-left: 60px;">
									Inventory
								</a>
							</li>
							<li class="@yield('customize-dropdown-nav')">
								<a href="/admin/customize" style="padding-left: 60px;">
									Customize
								</a>
							</li>
						</ul>
					</div>
				</li>
				<li class="@yield('order-sidebar')">
					<a href="/admin/order">
						<i class="pe-7s-note2"></i>
						<p>Order</p>
					</a>
				</li>
				<li class="@yield('customer-sidebar')">
					<a href="/admin/customer">
						<i class="pe-7s-users"></i>
						<p>Customer</p>
					</a>
				</li>
				<li class="@yield('cms-sidebar')">
					<a href="/admin/cms">
						<i class="pe-7s-box2"></i>
						<P>CMS</P>
					</a>
				</li>
            </ul>
    	</div>
    </div>

    <div class="main-panel">
        <nav class="navbar navbar-default navbar-fixed">
            <div class="container-fluid">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>

					<ul class="page-direction">
						@yield('page-direction')
					<ul>
                </div>
                <div class="collapse navbar-collapse">
                    <ul class="nav navbar-nav navbar-right">
                        <li>
                           <a href="">
                               Account
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>


        <div class="content">
            <div class="container-fluid">
                <div class="row">
				    @yield('content')
                </div>
            </div>
        </div>


        {{-- <footer class="footer">
            <div class="container-fluid">
                <p class="copyright pull-right">
                    &copy; <script>document.write(new Date().getFullYear())</script> <a href="http://www.thelittletroop.com">The Little Troop</a>, made with love for a better web
                </p>
            </div>
        </footer> --}}

    </div>
</div>


</body>

    <!--   Core JS Files   -->
    <script src="/js/jquery-1.10.2.js" type="text/javascript"></script>
	<script src="/js/admin/bootstrap.min.js" type="text/javascript"></script>

	<!--  Checkbox, Radio & Switch Plugins -->
	<script src="/js/admin/bootstrap-checkbox-radio-switch.js"></script>

	<!--  Charts Plugin -->
	{{-- <script src="/js/admin/chartist.min.js"></script> --}}

    <!--  Notifications Plugin    -->
    <script src="/js/admin/bootstrap-notify.js"></script>
	<script>
	// notify funciton
	function showNotification(type, message, from, align){
		var icon = '';
		switch(type) {
			case 'info':
				icon = "pe-7s-bell";
				break;
			case 'warning':
				icon = "pe-7s-attention";
				break;
		}

		$.notify({
			icon: icon,
			message: message

		},{
			type: type,
			timer: 4000,
			placement: {
				from: from,
				align: align
			}
		});
	}
	</script>

    <!-- Light Bootstrap Table Core javascript and methods for Demo purpose -->
	<script src="/js/admin/light-bootstrap-dashboard.js"></script>

	{{-- Sweet Alert Plugin--}}
	<script src="/js/admin/sweetalert.min.js"></script>

	{{-- datatable --}}
	<script src="/js/admin/jquery.dataTables.min.js"></script>

	<script src="/js/lightslider.min.js"></script>

    @stack('scripts')
    {{-- <script src="/js/admin/main.js"></script> --}}
	<script src="/js/main.js"></script>
	<script>
	@if(Session::has('notify'))
	$.notify({
    	icon: 'pe-7s-bell',
    	message: "{{ Session::get('notify') }}"
    },{
        type: 'info',
        timer: 4000
    });
	@endif
	</script>
</html>
