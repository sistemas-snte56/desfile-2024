

<!doctype html>
<html class="no-js" lang="en">

    <head>
        <!-- meta data -->
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->

        <!--font-family-->
		<link href="https://fonts.googleapis.com/css?family=Poppins:100,100i,200,200i,300,300i,400,400i,500,500i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
        
        <!-- title of site -->
        <title>Directory Landing Page</title>

        <!-- For favicon png -->
		<link rel="shortcut icon" type="image/icon" href="assets/logo/favicon.png"/>
       
        <!--font-awesome.min.css-->
        <link rel="stylesheet" href="assets/css/font-awesome.min.css">

        <!--linear icon css-->
		<link rel="stylesheet" href="assets/css/linearicons.css">

		<!--animate.css-->
        <link rel="stylesheet" href="assets/css/animate.css">

		<!--flaticon.css-->
        <link rel="stylesheet" href="assets/css/flaticon.css">

		<!--slick.css-->
        <link rel="stylesheet" href="assets/css/slick.css">
		<link rel="stylesheet" href="assets/css/slick-theme.css">
		
        <!--bootstrap.min.css-->
        <link rel="stylesheet" href="assets/css/bootstrap.min.css">
		
		<!-- bootsnav -->
		<link rel="stylesheet" href="assets/css/bootsnav.css" >	
        
        <!--style.css-->
        <link rel="stylesheet" href="assets/css/style.css">
        
        <!--responsive.css-->
        <link rel="stylesheet" href="assets/css/responsive.css">
        
        <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
		
        <!--[if lt IE 9]>
			<script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
			<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->

		<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    </head>
	
	<body>		
		<!--header-top start -->
		<header id="header-top" class="header-top">
			<ul>
				<li>
					<div class="header-top-left">
						<ul>
							<li class="select-opt">
                                &nbsp;
							</li>
						</ul>
					</div>
				</li>
				<li class="head-responsive-right pull-right">
					<div class="header-top-right">
                        @if (Route::has('login'))
                            <ul>
                                @auth
                                    <li class="header-top-contact">
                                        <a href="{{ url('/dashboard') }}" class="">Dashboard</a>
                                    </li>
                                @else
                                    <li class="header-top-contact">
                                        <a href="{{ route('login') }}" class="">Iniciar sesión</a>
                                    </li>
                                    <li class="header-top-contact">
                                        @if (Route::has('register'))
                                            <a href="{{ route('register') }}" class="ml-4 ">Registrarse</a>
                                        @endif
                                    </li>
                                @endauth
                            </ul>
                        @endif
					</div>
				</li>
			</ul>
		</header><!--/.header-top-->
		<!--header-top end -->

		<!-- top-area Start -->
		<section class="top-area">
			<div class="header-area">
				<!-- Start Navigation -->
			    <nav class="navbar navbar-default bootsnav  navbar-sticky navbar-scrollspy"  data-minus-value-desktop="70" data-minus-value-mobile="55" data-speed="1000">

			        <div class="container">

			            <!-- Start Header Navigation -->
			            <div class="navbar-header">
			                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navbar-menu">
			                    <i class="fa fa-bars"></i>
			                </button>
			                <img src="{{ asset('img/banner.png') }}" alt="" width="300" >

			            </div><!--/.navbar-header-->
			            <!-- End Header Navigation -->


			        </div><!--/.container-->
			    </nav><!--/nav-->
			    <!-- End Navigation -->
			</div><!--/.header-area-->
		    <div class="clearfix"></div>

		</section><!-- /.top-area-->
		<!-- top-area End -->

		<!--welcome-hero start -->
		<section id="home" class="welcome-hero">
			<div class="container">

			</div>

		</section><!--/.welcome-hero-->
		<!--welcome-hero end -->

		<!--list-topics start -->
		<section id="list-topics" class="list-topics">
			<div class="container">
				<div class="list-topics-content">

				</div>
			</div><!--/.container-->
		</section><!--/.list-topics-->
		<!--list-topics end-->

		<!--works start -->
		<hr class="my-5">
		<section id="works" class="works">
			@livewire('busqueda-constancia')
		</section>

		<!--footer start-->
		<footer id="footer"  class="footer">
			<div class="container">
				<div class="footer-menu">
		           	<div class="row">
			           	<div class="col-sm-3">
			           		 <div class="navbar-header">
				                <a class="navbar-brand" href="index.html">list<span>race</span></a>

								
				            </div><!--/.navbar-header-->
			           	</div>
			           	<div class="col-sm-9">
			           		<ul class="footer-menu-item">

			                </ul><!--/.nav -->
			           	</div>
		           </div>
				</div>
				<div class="hm-footer-copyright">
					<div class="row">
						<div class="col-sm-7">
							<p>
								&copy;copyright. 2024 SNTE. Todos los derechos reservados <a href="https://www.themesine.com/">www.<strong>snte</strong>.org.mx/<strong>seccion56</strong></a>
							</p><!--/p-->
						</div>
						<div class="col-sm-5">
							<div class="footer-social">
								<a href="https://www.facebook.com/snte56informafanpage/" target="_blank" rel="noopener noreferrer"><i class="fa fa-facebook"></i></a>
								<a href="https://x.com/snte56veracruz" target="_blank" rel="noopener noreferrer"><i class="fa fa-twitter"></i></a>
							</div>
						</div>
					</div>
					
				</div><!--/.hm-footer-copyright-->
			</div><!--/.container-->

			<div id="scroll-Top">
				<div class="return-to-top">
					<i class="fa fa-angle-up " id="scroll-top" data-toggle="tooltip" data-placement="top" title="" data-original-title="Back to Top" aria-hidden="true"></i>
				</div>
				
			</div><!--/.scroll-Top-->
			
        </footer><!--/.footer-->
		<!--footer end-->
		
		<!-- Include all js compiled plugins (below), or include individual files as needed -->

		<script src="assets/js/jquery.js"></script>
        
        <!--modernizr.min.js-->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/modernizr/2.8.3/modernizr.min.js"></script>
		
		<!--bootstrap.min.js-->
        <script src="assets/js/bootstrap.min.js"></script>
		
		<!-- bootsnav js -->
		<script src="assets/js/bootsnav.js"></script>

        <!--feather.min.js-->
        <script  src="assets/js/feather.min.js"></script>

        <!-- counter js -->
		<script src="assets/js/jquery.counterup.min.js"></script>
		<script src="assets/js/waypoints.min.js"></script>

        <!--slick.min.js-->
        <script src="assets/js/slick.min.js"></script>

		<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.4.1/jquery.easing.min.js"></script>
		     
        <!--Custom JS-->
        <script src="assets/js/custom.js"></script>

		<script>
			// Cuando el botón es presionado
			document.getElementById('mostrarAlerta').addEventListener('click', function() {
				Swal.fire({
					title: '¿Estás seguro?',
					text: 'Este es un ejemplo de alerta con un botón personalizado.',
					icon: 'warning',
					showCancelButton: true, // Muestra el botón "Cancelar"
					confirmButtonText: 'Sí, confirmo', // Botón de confirmación
					cancelButtonText: 'No, cancela', // Botón de cancelación
					// Si el usuario hace clic en confirmar:
					confirmButtonColor: '#3085d6',
					// Si el usuario hace clic en cancelar:
					cancelButtonColor: '#d33',
				}).then((result) => {
					if (result.isConfirmed) {
						Swal.fire(
							'¡Confirmado!',
							'Has confirmado la acción.',
							'success'
						);
					} else if (result.isDismissed) {
						Swal.fire(
							'Cancelado',
							'Has cancelado la acción.',
							'error'
						);
					}
				});
			});
		</script>		
        
    </body>
	
</html>