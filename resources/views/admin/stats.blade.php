@extends('layouts.app')

@section('title', '| V75 pro Admin Dashboard')

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
                              <li class="breadcrumb-item" aria-current="page">admin</li>
                              <li class="breadcrumb-item active" aria-current="page">Statistiques</li>
                          </ol>
                      </nav>
                  </div>
              </div>
          </div>
      </div>

      <!-- Main content -->
      <section class="content">
        <div class="row">

            <div class="col-xl-12 col-12">
                <div class="box">
                  <div class="box-header">
                    <h3 class="box-title text-info" style="font-weight: 500;">Statistiques</h3>
                    <div class="box-controls pull-right">
                      <button class="btn btn-xs btn-primary">Données systèmes</button>
                    </div>
                  </div>

                  <div class="box-body">
                    <p class="text-gray-600">Les statistiques et performances du système s'affiche ici !</p>
                  </div>
                </div>
            </div>

            <div class="row bg-transparent">
				<div class="col-xl-9 col-12">


					{{-- <div class="row">

						<div class="col-xl-3 col-lg-3 col-sm-6 col-6">
							<div class="box pull-up dashboard_box">
								<div class="box-body">
									<div class="d-flex align-items-center justify-content-between">
										<div class="d-flex align-items-center">
											<div class="bg-warning h-50 w-50 product_icon text-center">
												<p class="mb-0 fs-20 w-50 fw-600 l-h-45"><i class="fa fa-download" aria-hidden="true"></i></p>
											</div>
											<div class="d-flex flex-column font-weight-500 mx-10">
												<a href="#" class="text-dark hover-primary mb-1  fs-17">0</a>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
						<div class="col-xl-3 col-lg-3 col-sm-6 col-6">
							<div class="box pull-up dashboard_box">
								<div class="box-body">
									<div class="d-flex align-items-center justify-content-between">
										<div class="d-flex align-items-center">
											<div class="bg-danger h-50 w-50 product_icon text-center">
												<p class="mb-0 fs-20 w-50 fw-600 l-h-45"><i class="fa fa-tags" aria-hidden="true"></i></p>
											</div>
											<div class="d-flex flex-column font-weight-500 mx-10">
												<a href="#" class="text-dark hover-primary mb-1  fs-17">0</a>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
						<div class="col-xl-3 col-lg-3 col-sm-6 col-6">
							<div class="box pull-up dashboard_box">
								<div class="box-body">
									<div class="d-flex align-items-center justify-content-between">
										<div class="d-flex align-items-center">
											<div class="bg-info h-50 w-50 product_icon text-center">
												<p class="mb-0 fs-20 w-50 fw-600 l-h-45"><i class="fa fa-sign-out" aria-hidden="true"></i></p>
											</div>
											<div class="d-flex flex-column font-weight-500 mx-10">
												<a href="#" class="text-dark hover-primary mb-1  fs-17">0</a>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
						<div class="col-xl-3 col-lg-3 col-sm-6 col-6">
							<div class="box pull-up dashboard_box">
								<div class="box-body">
									<div class="d-flex align-items-center justify-content-between">
										<div class="d-flex align-items-center">
											<div class="bg-success h-50 w-50 product_icon text-center">
												<p class="mb-0 fs-20 w-50 fw-600 l-h-45"><i class="fa fa-sign-in" aria-hidden="true"></i></p>
											</div>
											<div class="d-flex flex-column font-weight-500 mx-10">
												<a href="#" class="text-dark hover-primary mb-1  fs-17">0</a>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>

					</div> --}}


					<div class="box">
						<div class="box-body">
							<div class="row">
								<div class="col-lg-12">
									<div class="row">
										<h3>Stats utilisateurs</h3>
										<div class="col-lg-6">
											<a class="box box-body box-hover-shadow mb-3" href="#">
								  				<div class="d-flex align-items-center">
								  					<div>
														<img class="avatar avatar-lg" src="../../../images/avatar2.png" alt="...">
													</div>
													<div class="mx-3">
									  					<h6 class="mt-3">Administrateurs</h6>
									  					<p class="text-black" style="font-size: 22px;">{{ $adminsCount }}</p>
													</div>
								  				</div>
											</a>
										</div>
										<div class="col-lg-6">
											<a class="box box-body box-hover-shadow mb-3" href="#">
								  				<div class="d-flex align-items-center">
								  					<div>
														<img class="avatar avatar-lg" src="../../../images/avatar5.jpg" alt="...">
													</div>
													<div class="mx-3">
									  					<h6 class="mt-3">Clients</h6>
									  					<p class="text-black" style="font-size: 22px;">{{ $clientsCount }}</p>
													</div>
								  				</div>
											</a>
										</div>
									</div>
								</div>
                                <div class="row">
                                    <div class="col-lg-6">
                                        <h3 class="mt-0" style="color:transparent;">-</h3>
                                        <a class="box box-body box-hover-shadow mb-3" href="#">
                                            <div class="d-flex align-items-center">
                                                {{-- <i class="fa fa-user-check" style="font-size: 30px;"></i> --}}
                                                <h1 style="color: black;">{{$actives}}</h1>
                                                <div class="mx-3">
                                                    <h6 class="mt-3">Comptes actifs</h6>
                                                    <p class="text-fade">Clients</p>
                                                </div>
                                            </div>
                                        </a>
                                    </div>
                                    <div class="col-lg-6">
                                        <h3 class="mt-0" style="color:transparent;">-</h3>
                                        <a class="box box-body box-hover-shadow mb-3" href="#">
                                            <div class="d-flex align-items-center">
                                                {{-- <i class="fa fa-user-lock" style="font-size: 40px;"></i> --}}
                                                <h1 style="color: black;">{{$inactives}}</h1>
                                                <div class="mx-3">
                                                    <h6 class="mt-3">Comptes inactifs</h6>
                                                    <p class="text-fade">Clients</p>
                                                </div>
                                            </div>
                                        </a>
                                    </div>
                                </div>
							</div>
						</div>
					</div>

					<div class="box">
						<div class="box-body">
							<div class="row">
								<div class="col-lg-8">
									<div class="row">
										<h3>Stats financiers</h3>
										<div class="col-lg-6">
											<a class="box box-body box-hover-shadow mb-3" href="#">
								  				<div class="d-flex align-items-center">
                                                    <i class="fa fa-dollar" style="font-size: 25px;"></i>
                                                    <h1></h1>
													<div class="mx-3">
									  					<h6 class="mt-3">Total dépôts</h6>
									  					<p class="text-primary" style="font-size: 22px;">{{$countdeps}}</p>
													</div>
								  				</div>
											</a>
										</div>
										<div class="col-lg-6">
											<a class="box box-body box-hover-shadow mb-3" href="#">
								  				<div class="d-flex align-items-center">
                                                    <i class="fa fa-money" style="font-size: 25px;"></i>
                                                    <h1></h1>
													<div class="mx-3">
									  					<h6 class="mt-3">Total retraits</h6>
									  					<p class="text-primary" style="font-size: 22px;">{{$countrecs}}</p>
													</div>
								  				</div>
											</a>
										</div>
									</div>
								</div>
								<div class="col-lg-4">
									<h3 class="mt-0" style="color:transparent;">-</h3>
									<a class="box box-body box-hover-shadow mb-3" href="#">
						  				<div class="d-flex align-items-center">
											<i class="fa fa-bar-chart-o" style="font-size: 25px;"></i>
											<h1></h1>
											<div class="mx-3">
							  					<h6 class="mt-3">Transactions</h6>
							  					<p class="text-warning" style="font-size: 22px;">{{$numberOfTransactions}}</p>
											</div>
						  				</div>
									</a>
								</div>
							</div>
						</div>
					</div>

					{{-- <div class="box">
						<div class="box-body">
							<div class="d-md-flex justify-content-between align-items-center">
								<div>
									<h3 class="m-0">Total dépôt ou investissement clients du mois: <span class="text-success">{{$lastMonthTotalTransactions}}</span></h3>
								</div>
								<div class="mx-lg-5">
									<a href="#" class="waves-effect waves-light btn btn-outline btn-primary m-1 mx-lg-5">View All</a>
								</div>
							</div>
						</div>

					</div> --}}
				</div>

				<div class="col-xl-3 col-12">
					<div class="box">
						<div class="box box-body m-0">
							<h3>Total retrait possible</h3>
				  			<div class="flexbox align-items-center text-fade">
								<p>Montant</p>
								<p>Minimum requis</p>
							</div>
							<div class="flexbox align-items-center">
								<h3>$100</h3>
								<h3>$ | <small class="text-fade"> Tout
									 inclus</small></h3>
							</div>
							{{-- <div class="mt-10 mt-md-0">
								<a href="#" class="waves-effect waves-light btn btn-outline btn-success"><i class="fa fa-calendar" aria-hidden="true"></i> Start SIP</a>
							</div> --}}
						</div>
					</div>
					<div class="box">
						<div class="box box-body">
							<h3>Avoir de la plateforme</h3>
							<div class="text-center">
								<h1>$ {{ $totalTransactions }}</h1>
								<hr style="margin: 2px 77px 3px 77px;">
								<p class="text-fade">Montant total déversé par les clients</p>
							</div>
                            <div>
                                <center><img class="avatar avatar-lg" src="{{asset('/images/avatar/21.jpg')}}" style="width: 150px; height:139px;" alt="..."></center>
                            </div>
							{{-- <div>
								<div id="spark2"></div>
							</div> --}}
						</div>
						{{-- <div class="box box-body">
					  		<div class="fs-18 flexbox align-items-center">
								<span>This Online Fund</span>
								<h3 class="text-success">$1,62,901</h3>
					  		</div>
                            <div class=" p-4" style="width: 100%;">
                                <button class="btn btn-success" style="width: 100%;">Invest Now</button>
                            </div>

						</div> --}}

					</div>

				</div>
			</div>




          <!-- /.col -->
        </div>
        <!-- /.row -->
      </section>
      <!-- /.content -->

    </div>
    </div>
    <!-- /.content-wrapper -->

@endsection

@push('datatable')
    <script src="{{asset('/assets/vendor_components/datatable/datatables.min.js')}}"></script>
    <script src="{{asset('/src/js/pages/data-table.js')}}"></script>

@endpush

