<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="{{asset('/images/V75.png')}}" style="border-radius: 100%;">

    <title>v75 - Log in</title>

	<!-- Vendors Style-->
	<link rel="stylesheet" href="../src/css/vendors_css.css">

	<!-- Style-->
	<link rel="stylesheet" href="../src/css/style.css">
	<link rel="stylesheet" href="../src/css/skin_color.css">

</head>

<body class="hold-transition dark-skin theme-primary bg-img" style="background-image: url(../../../images/box-svg-3.png); background-repeat:repeat; background-size:contain; background-color:rgba(98, 180, 110, 0.534); padding-top:10%; padding-bottom:90%" data-overlay="8">

	<div class="container h-p100">
		<div class="row align-items-center justify-content-md-center h-p100">

			<div class="col-12" style="padding-bottom:10%;">
				<div class="row justify-content-center g-0">
					<div class="col-lg-5 col-md-5 col-12">
						<div class="bg-white rounded10 shadow-lg">

                            <div class="content-top-agile p-20 pb-0">
                                <br><br><a href="#" title="v75">
                                    <img src="../../../images/OIPa.jpeg" class="" alt="" style="width: 30%; height: 40%; border-radius:10%; margin-bottom:2%; border:0px solid rgba(2, 52, 2, 0.24);"/>
                                </a>
								<h2 class="text-primary fw-600"><br>Créer un compte</h2>
								<p class="mb-0 text-fade" style="margin-top: 3%;">Créez votre compte v75 pour commencer <br>à percevoir vos gains !</p><br>
							</div>


							<div class="p-30">
                                @if ($errors->any())
                                    <div style="form-group">
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
                                                <ul>
                                                    @foreach ($errors->all() as $error)
                                                        <li>{{ $error }}</li>
                                                    @endforeach
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                @endif
								<br><form method="POST" action="{{ route('client.auth_register') }}" enctype="multipart/form-data">
                                    @csrf
                                    <div class="form-group">
										<div class="input-group mb-3">
											<span class="input-group-text bg-transparent" style="border: 1px solid rgba(1, 17, 0, 0.11); color:black;"><i class="text-fade ti-user"></i></span>
											<input type="text" name="last_name" class="form-control ps-15 bg-transparent" placeholder="Nom" required style="border: 1px solid rgba(0, 91, 0, 0.089); color:black;" autofocus>
                                            {{-- @if ($errors->has('last_name'))
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
                                                        <em>{{ $errors->first('last_name') }}</em>
                                                    </div>
                                                </div>
                                            @endif --}}
										</div>
									</div>
                                    <div class="form-group">
										<div class="input-group mb-3">
											<span class="input-group-text bg-transparent" style="border: 1px solid rgba(1, 17, 0, 0.11); color:black;"><i class="text-fade ti-user"></i></span>
											<input type="text" name="first_name" class="form-control ps-15 bg-transparent" placeholder="Prénom(s)" required style="border: 1px solid rgba(0, 91, 0, 0.089); color:black;">
                                            {{-- @if ($errors->has('first_name'))
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
                                                        <em>{{ $errors->first('first_name') }}</em>
                                                    </div>
                                                </div>
                                            @endif --}}
										</div>
									</div>
									<div class="form-group">
										<div class="input-group mb-3">
											<span class="input-group-text bg-transparent" style="border: 1px solid rgba(1, 17, 0, 0.11); color:black;"><i class="text-fade ti-email"></i></span>
											<input type="email" name="email" class="form-control ps-15 bg-transparent" placeholder="email" required style="border: 1px solid rgba(0, 91, 0, 0.089); color:black;">
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
											<span class="input-group-text bg-transparent" style="border: 1px solid rgba(1, 17, 0, 0.11); color:black;"><i class="text-fade ti-mobile"></i></span>
											<input type="text" name="phone_number" class="form-control ps-15 bg-transparent" placeholder="Tel (exemple: 22866778899)" required style="border: 1px solid rgba(0, 91, 0, 0.089); color:black;" >

										</div>
									</div>

                                    <div class="form-group">
										<div class="input-group mb-3">
											<span class="input-group-text bg-transparent" style="border: 1px solid rgba(1, 17, 0, 0.11); color:black;"><i class="text-fade ti-user"></i></span>
											<input type="text" id="fellow" name="fellow" class="form-control ps-15 bg-transparent" placeholder="Code de parrainage (optionnel)" value="" style="border: 1px solid rgba(0, 91, 0, 0.089); color:black;">
										</div>
									</div>
									<div class="form-group">
										<div class="input-group mb-3">
											<span class="input-group-text bg-transparent" style="border: 1px solid rgba(1, 17, 0, 0.11); color:black;"><i class="text-fade ti-lock"></i></span>
											<input type="password" id="password" name="password" class="form-control ps-15 bg-transparent" placeholder="Mot de passe" required style="border: 1px solid rgba(0, 91, 0, 0.089); color:black;">
                                            <span class="input-group-text bg-transparent" style="border: 1px solid rgba(1, 17, 0, 0.11); color:black;"><i class="text-fade ti-eye" type="button" id="icon_pwd" onclick="show_password()"></i></span>

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
                                    <div class="form-group">
										<div class="input-group mb-3">
											<span class="input-group-text bg-transparent" style="border: 1px solid rgba(1, 17, 0, 0.11); color:black;"><i class="text-fade ti-lock"></i></span>
											<input type="password" id="password_confirmation" name="password_confirmation" class="form-control ps-15 bg-transparent" placeholder="Confirmez le mot de passe" required style="border: 1px solid rgba(0, 91, 0, 0.089); color:black;">
                                            <span class="input-group-text bg-transparent" style="border: 1px solid rgba(1, 17, 0, 0.11); color:black;"><i class="text-fade ti-eye" type="button" id="icon_pwd"  onclick="show_confirm_password()"></i></span>
										</div>
									</div>

                                    <div class="form-group" style="display:none;">
										<div class="input-group mb-3">
											<span class="input-group-text bg-transparent" style="border: 1px solid rgba(1, 17, 0, 0.11); color:black;"><i class="text-fade ti-lock"></i></span>
											<input type="number" id="is_active" name="is_active" value="1" class="form-control ps-15 bg-transparent" required style="border: 1px solid rgba(0, 91, 0, 0.089); color:black;">
                                            <span class="input-group-text bg-transparent" style="border: 1px solid rgba(1, 17, 0, 0.11); color:black;"><i class="text-fade ti-eye" type="button" id="icon_pwd" ></i></span>
										</div>
									</div>

                                    <p id="message"></p>
									  <div class="row">
										<div class="col-11">
										  <div class="checkbox">
											<input type="checkbox" id="terms" onClick="button();" required>
											<label for="terms" title="J'accepte les conditions générales d'utilisation de la plateforme"><a href="policy" style="color: rgb(191, 55, 191);">J'accepte les conditions d'utilisation</a></label>
										  </div>
										</div>
										<!-- /.col -->
										<div class="col-1">
										 <div class="fog-pwd text-end">
											{{-- <a href="javascript:void(0)" class="text-primary fw-350 hover-primary"><i class="ion ion-locked"></i> Mot de passe oublié ?</a><br> --}}
										  </div>
										</div>
										<!-- /.col -->
										<div class="col-12 text-center">
										  <button type="submit" class="btn btn-primary w-p100 mt-10" id="register_btn" disabled="true">Créer</button>
										</div>
										<!-- /.col -->
									  </div>
								</form>
								<div class="text-center">
									<br><p class="mt-15 mb-0 text-fade">Vous avez déjà un compte ? <a href="{{route('client.login')}}" class="text-primary ms-5">Se connecter</a></p>
								</div>

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

    <script>
        function button() {
            let pwd = document.getElementById('password').value;
            let pwd_confirm = document.getElementById('password_confirmation').value;

            if (document.getElementById('terms').checked && pwd != "" && pwd == pwd_confirm ) {
                document.getElementById('register_btn').disabled = false;
            } else {
                document.getElementById('register_btn').disabled = true;
            }
        }

        function show_password() {
            let icon_pwd = document.getElementById('icon_pwd');
            let pwd = document.getElementById('password');
            if(pwd.type == "password"){
                pwd.type = "text";
                icon_pwd.className = "text-fade ti-eye"
            } else {
                pwd.type = "password";
                icon_pwd.className = "text-fade ti-eye"
            }

        }

        function show_confirm_password() {
            let icon_pwd = document.getElementById('icon_pwd');
            let pwd = document.getElementById('password_confirmation');
            if(pwd.type == "password"){
                pwd.type = "text";
                icon_pwd.className = "text-fade ti-eye"
            } else {
                pwd.type = "password";
                icon_pwd.className = "text-fade ti-eye"
            }

        }





    </script>

</body>
</html>
