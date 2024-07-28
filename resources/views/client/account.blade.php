@extends('layouts.app2')

@section('title', '| V75 pro Dashboard')

@section('content')

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
    <div class="container-full">
      <!-- Content Header (Page header) -->
      <div class="content-header">
          <div class="d-flex align-items-center">
              <div class="me-auto">
                  <h4 class="page-title">Dashboard</h4>
                  <div class="d-inline-block align-items-center">
                      <nav>
                          <ol class="breadcrumb">
                              <li class="breadcrumb-item"><a href="#"><i class="mdi mdi-home-outline"></i></a></li>
                              <li class="breadcrumb-item" aria-current="page">Comptes</li>
                              <li class="breadcrumb-item active" aria-current="page">Infos comptes</li>
                          </ol>
                      </nav>
                  </div>
              </div>
          </div>
      </div>

      <!-- Main content -->
      <section class="content">
        <div class="row">
            <div class="col-md-7">
                <div class="card">
                    <div class="card-body">
                        <h4 class="header-title">Informations de compte</h4>
                        <p class="text-muted fs-14 mb-3">
                            Ici s'affiche toutes les informations de votre compte d'investissent v75 pro
                        </p><br>

                        <ul class="nav nav-pills bg-nav-pills mb-3 nav-justified" >
                            <li class="nav-item">
                                <a href="#bordered-justified-tabs-preview" data-bs-toggle="tab" aria-expanded="false" class="nav-link rounded-0 active" style="height: 60px; line-height: 45px;">
                                    CAPITAL
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="#bordered-justified-tabs-rsi" data-bs-toggle="tab" aria-expanded="true" class="nav-link rounded-0" style="height: 60px; line-height: 45px;">
                                    <i class="fa fa-dollar" style="font-size: 14px;"> RSI</i>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="#bordered-justified-tabs-code" data-bs-toggle="tab" aria-expanded="true" class="nav-link rounded-0" style="height: 60px; line-height: 45px;">
                                    COMMISSION
                                </a>
                            </li>
                        </ul> <!-- end nav-->

                        <div class="tab-content">
                            <div class="tab-pane show active" id="bordered-justified-tabs-preview">

                                <br><div class="tab-pane show active" id="profile-b2">
                                    <p class="text-fade" style="text-align: justify; font-size:15px;">Votre capital initial investit vous reste toujours disponible. Au désir, vous êtes libre de le retirer ou d'augmenter la mise (le montant)</p>
                                    {{-- <p class="mb-0 text-fade">Leggings occaecat dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Donec quam felis, ultricies nec, pellentesque eu, pretium quis, sem. Nulla consequat massa quis enim.</p> --}}
                                </div>

                                <div class="col-xl-12 col-12">
                                    <div class="box box-body">
                                      <div class="fs-18 flexbox align-items-center">
                                        <span>Capital investi</span>
                                        <span style="font-size: 34px;">{{$account->balance}} <i class="fa fa-dollar"></i></span>
                                      </div>

                                      <div class="progress progress-xxs mt-10 mb-10">
                                        <div class="progress-bar" role="progressbar" style="width: 35%; height: 4px;" aria-valuenow="35" aria-valuemin="0" aria-valuemax="100"></div>
                                      </div>
                                      <div class="text-end"><small class="fw-400 mb-5 text-fade"><i class="fa fa-sort-up text-success me-1"></i> {{$account->balance*3.3/100}} $ </small> <span class="text-success">RSI</span></div>
                                    </div>
                                </div>

                                <div class="col-xxl-12 col-lg-12">
                                    <div class="box-header no-border">
                                    <h3 class="box-title mb-0 fw-500">Votre carte v75 pro</h3>
                                    <span class="box-controls pull-right text-fade fs-20"><i class="fa fa-credit-card"></i></span>
                                    </div>
                                    <!-- /.box-body -->
                                    <div class="box-body pt-10">
                                        <!-- Place somewhere in the <body> of your page -->
                                        <div class="flexslider">
                                            <div class="flex-viewport" style="overflow: hidden; position: relative;">
                                                <ul class="slides">
                                                    <li class="clone" aria-hidden="true" style=" margin-right: 0px; float: left; display: block;">
                                                    <div class="box bg-danger box-inverse">
                                                            <div class="box-body">
                                                                <h1><i class="fa fa-credit-card-alt"></i></h1>
                                                                <h3 style="margin-top: 5%; font-size:30px">{{$account->balance}}  <i class="fa fa-dollar"></i></h3><br>
                                                                {{-- **** **** **** 9578 --}}
                                                                <h3>Solde total</h3>
                                                                <span class="pull-right">Fait le : {{$account->created_at->format('d/m/Y')}}</span>
                                                                <span class="font-500">Investisseur</span>
                                                            </div>
                                                        </div>
                                                    </li>
                                                    <li style=" margin-right: 0px; float: left; display: block;" class="" data-thumb-alt="">
                                                        <div class="box bg-warning box-inverse">
                                                            <div class="box-body">
                                                                <h1><i class="fa fa-credit-card"></i></h1>
                                                                <h3 style="margin-top: 5%;">{{$account->account_num}}</h3><br>
                                                                {{-- **** **** **** 9578 --}}
                                                                <h3>{{ Auth::guard('client')->user()->first_name }} {{ Auth::guard('client')->user()->last_name }}</h3>
                                                                <span class="pull-right">Fait le : {{$account->created_at->format('d/m/Y')}}</span>
                                                                <span class="font-500">Investisseur</span>
                                                            </div>
                                                        </div>
                                                    </li>

                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div> <!-- end preview-->

                            <div class="tab-pane show" id="bordered-justified-tabs-rsi">

                                <br><div class="tab-pane show active" id="profile-b2">
                                    <p class="text-fade" style="text-align: justify; font-size:15px;">Vos RSI (retours sur investissement) vous sont reversés chaque jour sur votre comptre d'investissement ; à raison de 3,3% de votre capital initial investit.</p>
                                    {{-- <p class="mb-0 text-fade">Leggings occaecat dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Donec quam felis, ultricies nec, pellentesque eu, pretium quis, sem. Nulla consequat massa quis enim.</p> --}}
                                </div>

                                <div class="col-xl-12 col-12">
                                    <div class="box box-body">
                                      <div class="flexbox">
                                        <span class="icon-Dollar text-primary fs-50"><span class="path1"></span><span class="path2"></span><span class="path3"></span></span>
                                        <span class="fs-40 fw-200">{{$account->balance*3.3/100}}</span>
                                      </div>
                                      <div class="text-end text-fade">RSI JOURNALIER</div>
                                    </div>
                                </div>

                                <div class="col-xl-12 col-12">
                                    <div class="box box-body">
                                      <div class="fs-18 flexbox align-items-center">
                                        <span>Total RSI</span>
                                        <span style="font-size: 34px;">{totalRSI} </span>
                                      </div>

                                      <div class="progress progress-xxs mt-10 mb-10">
                                        <div class="progress-bar" role="progressbar" style="width: 15%; height: 4px;" aria-valuenow="15" aria-valuemin="0" aria-valuemax="100"></div>
                                      </div>
                                      <div class="text-end"><small class="fw-400 mb-5 text-fade"><i class="fa fa-sort-up text-success me-1"></i> </small>Depuis le <span class="text-success"> {{$account->created_at->format('d-m-Y')}}</span></div>
                                    </div>
                                </div>

                                <center>
                                    <div class="activ_box_button mt-30 " style="width: 80%;">
                                        <button class="btn btn-outline-secondary bg-2500B6 text-white" style="width: 100%; height: 50px; font-size:18px;"><i class="fa fa-money me-10"></i> Réinvestir mes RSI</button>
                                    </div>

                                    <div class="activ_box_button mt-30 " style="width: 80%;">
                                        <button class="btn btn-primary bg-2500B6 text-white" style="width: 100%; height: 50px; font-size:18px;"><i class="fa fa-dollar me-10"></i> Retirer mes RSI</button>
                                    </div><br>
                                </center>

                            </div> <!-- end preview-->

                            <div class="tab-pane" id="bordered-justified-tabs-code">
                                     <br><div class="tab-pane show active" id="profile-b2">
                                    <p class="text-fade" style="text-align: justify; font-size:15px;">Vos commissions de parrainages vous reversés chaque jour sur vour compte d'investissement pour chacun des filleuls qui vous sont affiliés ;
                                        à raison de 8% du RSI journalier de vos filleuls de 1er niveau, 5% sur le RSI de vos filleuls de 2eme niveau et 3% sur ceux de 3eme niveau.</p>
                                    {{-- <p class="mb-0 text-fade">Leggings occaecat dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Donec quam felis, ultricies nec, pellentesque eu, pretium quis, sem. Nulla consequat massa quis enim.</p> --}}
                                </div>

                                <div class="row">
                                    <div class="col-12 col-md-4 col-xl-4">
                                        <a class="box box-link-pop text-center" href="javascript:void(0)">
                                            <div class="box-body py-25 bg-primary-light btsr-0 bter-0">
                                                <p class="fw-600">
                                                    <span class="icon-users me-5 text-primary"><span class="path1"></span><span class="path2"></span></span> Filleuls de niveau 1
                                                </p>
                                            </div>
                                            <div class="box-body">
                                                <p class="fs-20 text-black">
                                                    <strong>{{ $account->balance }}$</strong>
                                                    {{-- {nbF1} --}}
                                                </p>
                                            </div>
                                        </a>
                                    </div>
                                    <div class="col-12 col-md-4 col-xl-4">
                                        <a class="box box-link-pop text-center" href="javascript:void(0)">
                                            <div class="box-body py-25 bg-info-light btsr-0 bter-0">
                                                <p class="fw-600">
                                                    <span class="icon-users me-5 text-info"><span class="path1"></span><span class="path2"></span></span> Filleuls de niveau 2
                                                </p>
                                            </div>
                                            <div class="box-body">
                                                <p class="fs-20 text-black">
                                                    <strong>{nbF1}</strong>
                                                </p>
                                            </div>
                                        </a>
                                    </div>

                                    <div class="col-12 col-md-4 col-xl-4">
                                        <a class="box box-link-pop text-center" href="javascript:void(0)">
                                            <div class="box-body py-25 bg-danger-light btsr-0 bter-0">
                                                <p class="fw-600">
                                                    <span class="icon-users me-5 text-danger"><span class="path1"></span><span class="path2"></span></span> Filleuls de niveau 3
                                                </p>
                                            </div>
                                            <div class="box-body">
                                                <p class="fs-20 text-black">
                                                    <strong>{nbF1}</strong>
                                                </p>
                                            </div>
                                        </a>
                                    </div>
                                </div>

                                <div class="col-xl-12 col-12">
                                    <div class="box box-body">
                                      <div class="flexbox">
                                        <span class="icon-Dollar text-primary fs-50"><span class="path1"></span><span class="path2"></span><span class="path3"></span></span>
                                        <span class="fs-40 fw-200">{{ $account->balance }} $</span>
                                      </div>
                                      <div class="text-end text-fade">Montant total des commissions</div>
                                    </div>
                                </div>

                                <center>
                                    <div class="activ_box_button mt-30 " style="width: 80%;">
                                        <button class="btn btn-outline-secondary bg-2500B6 text-white" style="width: 100%; height: 50px; font-size:18px;"><i class="fa fa-money me-10"></i> Réinvestir mes commissions</button>
                                    </div>

                                    <div class="activ_box_button mt-30 " style="width: 80%;">
                                        <button class="btn btn-primary bg-2500B6 text-white" style="width:100%; height: 50px; font-size:18px;"><i class="fa fa-dollar me-10"></i> Retirer mes commissions</button>
                                    </div><br>
                                </center>
                            </div> <!-- end preview code-->
                        </div> <!-- end tab-content-->
                    </div> <!-- end card-body -->
                </div> <!-- end card-->

            </div>

            <div class="col-md-5">
					<div class="card">
						<div class="card-header">
							<h5 class="card-title mb-0">{{ Auth::guard('client')->user()->last_name }} {{ Auth::guard('client')->user()->first_name }}</h5>
							<div class="card-actions float-end">
								<div class="">
									<a href="#" data-bs-toggle="dropdown" data-bs-display="static"> <i class="align-middle" data-feather="more-horizontal"></i></a>
									{{-- <div class="dropdown-menu dropdown-menu-end">
										<a class="dropdown-item" href="#">Action</a>
										<a class="dropdown-item" href="#">Another action</a>
										<a class="dropdown-item" href="#">Something else here</a>
									</div> --}}
								</div>
							</div>
						</div>
						<div class="card-body">
							<div class="row g-0">
								<div class="col-sm-3 col-xl-12 col-xxl-3 text-center">
									<img src="{{asset('/images/ui.jpg')}}" width="64" height="64" class="bg-light rounded-circle mt-2" alt="{{ Auth::guard('client')->user()->last_name }} {{ Auth::guard('client')->user()->first_name }}" style="border-radius: 100%; border:1px solid rgba(194, 247, 194, 0.482);">
								</div>
								<div class="col-sm-9 col-xl-12 col-xxl-9">
									<br><strong>Informations personnelles</strong>
									<p class="text-fade" style="text-align: justify; line-height:25px;"><br>Vous disposez du statut <span class="text-info">client actif</span> de la plateforme v75 pro. Vous êtes donc élligible pour les investissements et les opérations (dépôts, retraits de fond).</p>
								</div>
							</div>

							<table class="table my-2">
								<tbody>
									<tr>
										<th>Nom</th>
										<td class="text-fade">{{ Auth::guard('client')->user()->first_name }}</td>
									</tr>
									<tr>
										<th>Prénom(s)</th>
										<td class="text-fade">{{ Auth::guard('client')->user()->last_name }}</td>
									</tr>
									<tr>
										<th>Email</th>
										<td class="text-fade">{{ Auth::guard('client')->user()->email }}</td>
									</tr>
									<tr>
										<th>Téléphone</th>
										<td class="text-fade">{{ Auth::guard('client')->user()->phone_number }}</td>
									</tr>
                                    <tr>
										<th>Nº Compte</th>
										<td class="text-fade">{{ Auth::guard('client')->user()->fellow_code }}</td>
									</tr>
                                    <tr>
										<th>Nº Compte USDT</th>
										<td class="text-fade">{{Auth::guard('client')->user()->account()->usdt_account}}</td>
                                        <td>
                                            <button class="btn btn-info-light ms-1" id="request" title="Editer le client" data-bs-toggle="modal" data-bs-target="#info-alert-modal">
                                                Modifier
                                            </button>
                                        </td>
                                        <div id="info-alert-modal" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
                                            <div class="modal-dialog modal-lg modal-dialog-centered">
                                                <div class="modal-content modal-filled">
                                                    <div class="modal-body p-4">
                                                        <div class="text-center" style="color: white; font-size:15px;">
                                                            <i class="dripicons-wrong h1"></i>
                                                            <h4 class="mt-2" style="color: black">Compte USDT !</h4>
                                                            <form action="{{ route('client.account_usdt') }}" method="POST">
                                                                @csrf
                                                                <div class="input-group mb-3">
                                                                    <input id="code" type="text" id="fellow" name="code" class="form-control ps-15 bg-transparent" placeholder="Compte USDT" value="{{Auth::guard('client')->user()->account()->usdt_account}}" required style="border: 1px solid rgba(0, 91, 0, 0.089); color:rgb(41, 69, 41);">
                                                                    <span class="btn btn-info bg-transparent" onclick="copierCode(event)" style="border: 1px solid rgba(1, 17, 0, 0.11); color:black;"><i class="text-fade ti-files"></i></span>
                                                                </div>
                                                                <button type="button" class="btn btn-danger my-2" data-bs-dismiss="modal">Annuler</button>
                                                                <button type="submit" class="btn btn-light my-2">Modifier</button>
                                                            </form>

                                                        </div>
                                                    </div>
                                                </div><!-- /.modal-content -->
                                            </div><!-- /.modal-dialog -->
                                        </div>

									</tr>

                                    <tr>
                                        <th>Nº Compte Bitcoin(BTC)</th>
                                        <td class="text-fade">{{Auth::guard('client')->user()->account()->btc_account}}</td>
                                        <td>
                                            <button class="btn btn-info-light ms-1" id="request" title="Editer le client" data-bs-toggle="modal" data-bs-target="#info-btc-modal">
                                                Modifier
                                            </button>
                                        </td>
                                        <div id="info-btc-modal" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
                                            <div class="modal-dialog modal-lg modal-dialog-centered">
                                                <div class="modal-content modal-filled">
                                                    <div class="modal-body p-4">
                                                        <div class="text-center" style="color: white; font-size:15px;">
                                                            <i class="dripicons-wrong h1"></i>
                                                            <h4 class="mt-2" style="color: black">Compte BTC !</h4>
                                                            <form action="{{ route('client.account_btc') }}" method="POST">
                                                                @csrf
                                                                <div class="input-group mb-3">
                                                                    <input id="code" type="text" id="fellow" name="code" class="form-control ps-15 bg-transparent" placeholder="Compte USDT" value="{{Auth::guard('client')->user()->account()->btc_account}}" required style="border: 1px solid rgba(0, 91, 0, 0.089); color:rgb(41, 69, 41);">
                                                                    <span class="btn btn-info bg-transparent" onclick="copierCode(event)" style="border: 1px solid rgba(1, 17, 0, 0.11); color:black;"><i class="text-fade ti-files"></i></span>
                                                                </div>
                                                                <button type="button" class="btn btn-danger my-2" data-bs-dismiss="modal">Annuler</button>
                                                                <button type="submit" class="btn btn-light my-2">Modifier</button>
                                                            </form>

                                                        </div>
                                                    </div>
                                                </div><!-- /.modal-content -->
                                            </div><!-- /.modal-dialog -->
                                        </div>

                                    </tr>
                                    <tr>
										<th>Capital initial</th>
										<td class="text-danger">{{ $account->balance }} $</td>
									</tr>
									<tr>
										<th>Status</th>
										<td><span class="badge bg-success-light">Active</span></td>
									</tr>
                                    <tr>

                                    </tr>

								</tbody>

							</table>
                            <br><label style="font-weight: 600;">Code de parrainage</label>
                            <div class="form-group">
                                <br><div class="input-group mb-3">
                                    <input id="code" type="text" id="fellow" name="fellow" class="form-control ps-15 bg-transparent" placeholder="" value="{{Auth::guard('client')->user()->fellow_code}}" readonly style="border: 1px solid rgba(0, 91, 0, 0.089); color:rgb(41, 69, 41);">
                                    <span class="btn btn-info bg-transparent" onclick="copierCode(event)" style="border: 1px solid rgba(1, 17, 0, 0.11); color:black;"><i class="text-fade ti-files"></i></span>
                                </div>
                            </div>


							{{-- <strong class="my-20 d-block">Activity</strong> --}}


						</div>
					</div>
				</div>
            </div>
        </div>
      </section>
      <!-- /.content -->

    </div>
    </div>
    <!-- /.content-wrapper -->

@endsection

@push('account')
    <script>
        function copierCode(event) {
            const texteSaisi = document.getElementById('code').value;
            if (texteSaisi) {
                navigator.clipboard.writeText(texteSaisi)
                    .then(() => alert('Code copié !'))
                    .catch(err => console.error('Erreur lors de la copie :', err));
            }
        }
    </script>
    <script src="{{asset('/assets/vendor_components/jquery-steps-master/build/jquery.steps.js')}}"></script>

	<script src="{{asset('/assets/vendor_components/flexslider/jquery.flexslider.js')}}"></script>
	<script src="{{asset('/assets/vendor_plugins/bootstrap-slider/bootstrap-slider.js')}}"></script>
	<script src="{{asset('/assets/vendor_components/OwlCarousel2/dist/owl.carousel.js')}}"></script>
	<script src="{{asset('/assets/vendor_components/c3/c3.min.js')}}"></script>
	<script src="{{asset('/assets/vendor_components/c3/d3.min.js')}}"></script>
    <script src="{{asset('/src/js/pages/dashboard5.js')}}"></script>

    <script src="{{asset('/assets/vendor_components/datatable/datatables.min.js')}}"></script>
    <script src="{{asset('/src/js/pages/data-table.js')}}"></script>
    <script src="{{asset('/src/js/pages/steps.js')}}"></script>
    <script src="{{asset('/assets/vendor_components/jquery-validation-1.17.0/dist/jquery.validate.min.js')}}"></script>
    <script src="{{asset('/assets/vendor_components/sweetalert/sweetalert.min.js')}}"></script>

@endpush

