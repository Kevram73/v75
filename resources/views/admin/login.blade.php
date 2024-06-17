<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="../../../images/favicon.ico">

    <title>v75 - Log in</title>

	<!-- Vendors Style-->
	<link rel="stylesheet" href="../src/css/vendors_css.css">

	<!-- Style-->
	<link rel="stylesheet" href="../src/css/style.css">
	<link rel="stylesheet" href="../src/css/skin_color.css">

</head>

<body class="hold-transition dark-skin theme-primary bg-img" style="background-image: url(../../../images/box-svg-3.png); background-repeat:repeat; background-size:contain; background-color:rgb(26, 0, 81); padding-top:10%; padding-bottom:90%" data-overlay-light="8">
    {{-- rgba(38, 95, 0, 0.55) --}}

	<div class="container h-p100">
		<div class="row align-items-center justify-content-md-center h-p100">

			<div class="col-12">
				<div class="row justify-content-center g-0">
					<div class="col-lg-5 col-md-5 col-12">
						<div class="bg-gray-800 rounded10 shadow-lg">

                            <div class="content-top-agile p-20 pb-0">
                                <br><br><a href="#" title="v75">
                                    <img src="../../../images/V75.png" class="" alt="" style="width: 20%; height: 30%; border-radius:100%; margin-bottom:2%; border:1px solid rgba(0, 59, 0, 0.24);"/>
                                </a>
                                <h2 class="text-prmary fw-600" style="color: white;"><br>Connexion | Admin</h2>
								<p class="mb-0 text-primary">Veuillez vous connecter !</p>

							</div>
							<div class="p-30">
								<form method="POST" action="{{ route('admin.auth_login') }}" enctype="multipart/form-data">
                                    @csrf
									<div class="form-group">
										<div class="input-group mb-3">
											<span class="input-group-text bg-transparent" style="border: 1px solid rgba(255, 255, 255, 0.11); color:rgb(255, 255, 255);"><i class="text-fade ti-user"></i></span>
											<input type="email" name="email" class="form-control ps-15 bg-transparent {{ $errors->has('email') ? ' is-invalid' : '' }}" placeholder="email" required style="border: 1px solid rgba(255, 255, 255, 0.089); color:rgb(255, 255, 255);" autofocus>
                                            {{-- @if ($errors->has('email'))
                                                <div class="box box-danger-light">
                                                    <div class="box-header">
                                                        <h4 class="box-title text-danger"><strong>Erreur</strong></h4>
                                                        <div class="box-tools pull-right">
                                                            <ul class="box-controls">
                                                                <li><a class="box-btn-close" href="#"></a></li>
                                                            </ul>
                                                        </div>
                                                    </div>

                                                    <div class="box-body">
                                                        <em>{{ $errors->first('email') }}</em>
                                                    </div>
                                                </div>
                                            @endif --}}
										</div>
									</div>
									<div class="form-group">
										<div class="input-group mb-3">
											<span class="input-group-text bg-transparent" style="border: 1px solid rgba(255, 255, 255, 0.11); color:rgb(255, 255, 255);"><i class="text-fade ti-lock"></i></span>
											<input type="password" name="password" class="form-control ps-15 bg-transparent {{ $errors->has('password') ? ' is-invalid' : '' }}" placeholder="Mot de passe" required style="border: 1px solid rgba(255, 255, 255, 0.089); color:rgb(255, 255, 255);">
                                            {{-- @if ($errors->has('password'))
                                                <div class="box box-danger-light">
                                                    <div class="box-header">
                                                        <h4 class="box-title text-danger"><strong>Erreur</strong></h4>
                                                        <div class="box-tools pull-right">
                                                            <ul class="box-controls">
                                                                <li><a class="box-btn-close" href="#"></a></li>
                                                            </ul>
                                                        </div>
                                                    </div>

                                                    <div class="box-body">
                                                        <em>{{ $errors->first('password') }}</em>
                                                    </div>
                                                </div>
                                            @endif --}}
										</div>
									</div>
									  <div class="row">
										<div class="col-6">
										  {{-- <div class="checkbox">
											<input type="checkbox" id="basic_checkbox_1" >
											<label for="basic_checkbox_1">Remember Me</label>
										  </div> --}}
										</div>
										<!-- /.col -->
										<div class="col-6">
										 <div class="fog-pwd text-end">
											<a href="javascript:void(0)" class="text-fade fw-350 hover-primary"><i class="ion ion-locked"></i> Mot de passe oublié ?</a><br>
										  </div>
										</div>
										<!-- /.col -->
										<div class="col-12 text-center">
										  <button type="submit" class="btn btn-prmary w-p100 mt-10" style="background-color:white; color: rgb(0, 128, 0);">Se connecter</button>
										</div>
										<!-- /.col -->
									  </div>
								</form><br>
								{{-- <div class="text-center">
									<br><p class="mt-15 mb-0 text-fade">Vous n'avez pas encore de compte ? <a href="auth_register.html" class="text-primary ms-5">Créer</a></p>
								</div> --}}

								{{-- <div class="text-center">
								  <p class="mt-20 text-fade">- Sign With -</p>
								  <p class="gap-items-2 mb-0">
									  <a class="waves-effect waves-circle btn btn-social-icon btn-circle btn-facebook-light" href="#"><i class="fa fa-facebook"></i></a>
									  <a class="waves-effect waves-circle btn btn-social-icon btn-circle btn-twitter-light" href="#"><i class="fa fa-twitter"></i></a>
									  <a class="waves-effect waves-circle btn btn-social-icon btn-circle btn-instagram-light" href="#"><i class="fa fa-instagram"></i></a>
									</p>
								</div> --}}
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>


	<!-- Vendor JS -->
	<script src="../src/js/vendors.min.js"></script>
	<script src="../src/js/pages/chat-popup.js"></script>
    <script src="../../../assets/icons/feather-icons/feather.min.js"></script>

</body>
</html>
