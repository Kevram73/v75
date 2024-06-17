@extends('layouts.app')

@section('title', '| V75 Admin Dashboard')

@section('content')

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper" >
	  <div class="container-full">

		<!-- Main content -->
		<section class="content">
			<div class="row">
				<div class="col-xl-12 col-lg-12">
					<div class="row">
						<div class="col-xl-4 col-lg-4 col-12">
							<div class="box box-body pull-up Sales_Profit">
								<div class="row">
									<div class="col-12">
										<h4 class="hover-primary"><i class="fa fa-fw fa-gg-circle text-primary"></i> Total entrée</h4>
										<p class="fs-35 fw-600 mb-0">$ {{$totalClientsBalance}}</p>
									</div>
									{{-- <div class=" col-4 text-end" style="position: relative;">
										<div id="new-leads-chart" style="min-height: 70px;"></div>
									</div> --}}
								</div>
							</div>
						</div>
						<div class="col-xl-4 col-lg-4 col-12">
							<div class="box box-body pull-up Sales_Profit ">
								<div class="row">
									<div class="col-12">
										<h4 class="hover-success"><i class="fa fa-fw fa-gg-circle text-primary"></i> Total reversé</h4>
										<div class="d-flex">
											<p class="fs-35 fw-600 mb-0">$ à mettre ! </p>
									  		<div class="text-end mt-20 fs-13"></div>
										</div>
									</div>
									{{-- <div class="col-4 text-end" style="position: relative;">
										<div id="new-leads-chart2" style="min-height: 70px;"></div>
									</div> --}}
								</div>
							</div>
						</div>
                        <div class="col-xl-4 col-lg-4 col-12">
							<div class="box box-body pull-up Sales_Profit ">
								<div class="row">
									<div class="col-12 ">
										<h4 class="hover-success"><i class="fa fa-fw fa-gg-circle text-primary"></i> Total Journaliers</h4>
										<div class="d-flex">
											<p class="fs-35 fw-600 mb-0">$ {{$totalTransactionsToday}} </p>
									  		<div class="text-end mt-20 fs-13"> <i class="fa fa-sort-up text-success me-2"></i> Transactions/24h</div>
										</div>
									</div>
									{{-- <div class="col-4 text-end" style="position: relative;">
										<div id="new-leads-chart2" style="min-height: 70px;"></div>
									</div> --}}
								</div>
							</div>
						</div>
                    </div>
                </div>


                <div class="col-xl-8 col-lg-12">
					<div class="row">
						<div class="col-xl-12">
							<div class="card chart_card">
								<div class="card-body">
									<div class="box-header px-0">
										<h4>Courbe v75 en temps réel</h4>
										<div class="box-controls pull-right">
											<ul class="nav nav-pills nav-pills-sm" role="tablist">
												<li class="nav-item">
													<a class="nav-link py-2 px-4 b-0" data-bs-toggle="tab" href="#">
														<span class="nav-text base-font">Month</span>
													</a>
												</li>
												<li class="nav-item">
													<a class="nav-link py-2 px-4 b-0" data-bs-toggle="tab" href="#">
														<span class="nav-text base-font">Week</span>
													</a>
												</li>
												<li class="nav-item">
													<a class="nav-link py-2 px-4 b-0 active" data-bs-toggle="tab" href="#">
														<span class="nav-text base-font">Day</span>
													</a>
												</li>
											</ul>
										</div>
									</div>

									<div dir="ltr">
										<div class="mt-3 chartjs-chart" style="height: 320px;">
											<div id="apexcharts-line">
											</div>
										</div>
									</div>
								</div> <!-- end card body-->
							</div> <!-- end card -->
						</div><!-- end col-->

                        <div class="col-12">
                            <div class="box">
                            <div class="box-header with-border">
                              <h2 class="box-title text-info" style="font-weight: 500">Derniers clients inscrits</h2>
                              <p class="mb-0 box-subtitle">Exporter les données de la table vers : CSV, Excel, PDF, Imprimer ou Copier</p>
                            </div>
                            <!-- /.box-header -->
                            <div class="box-body">
                                <div class="table-responsive">
                                  <table id="example" class="table text-fade table-bordered table-hover display nowrap margin-top-10 w-p100">
                                    <thead>
                                        <tr class="text-dark">
                                            <th>Nom</th>
                                            <th>Prénom(s)</th>
                                            <th>email</th>
                                            <th>Téléphone</th>
                                            <th>Etat</th>
                                            {{-- <th>Action</th> --}}
                                        </tr>
                                    </thead>
                                    <tbody>
                                      @foreach ($activeClients as $activeClient)
                                          <tr>
                                              <td class="text-dark">{{$activeClient->first_name}}</td>
                                              <td>{{$activeClient->last_name}}</td>
                                              <td>{{$activeClient->email}}</td>
                                              <td>{{$activeClient->phone_number}}</td>
                                              <td>
                                              @if ($activeClient->is_active == TRUE)
                                                  <button class="btn btn-primary btn-md mt-5"><i class="fa fa-check"></i> Actif</button>
                                              @else
                                                  <button class="btn btn-danger btn-md mt-5"><i class="fa fa-check"></i> Inactif</button>
                                              @endif
                                              </td>
                                              {{-- <td>
                                                  <a href="">
                                                      <button class="btn btn-info-light ms-1" id="request" title="Editer le client">Modifier</button>
                                                  </a>
                                                  <a href="">
                                                      <button class="btn btn-danger-light ms-1" id="exit" title="Supprimer le client">Supprimer</button>
                                                  </a>

                                              </td> --}}
                                          </tr>
                                      @endforeach
                                    </tbody>
                                </table>
                                </div>
                            </div>
                            <!-- /.box-body -->
                              </div>
                          <!-- /.box -->
                        </div>

						{{-- <div class="col-xl-6 col-lg-6 col-sm-6">
							<div class="box pull-up">
							  	<div class="box-body media-list">
							  		<div>
										<div class="d-flex align-items-center justify-content-between">
											<div class="d-flex align-items-center">
												<div class="bg-primary h-40 w-40 product_icon text-center">
												  	<p class="mb-0 fs-20 w-40 fw-600"><i class="fa fa-home" aria-hidden="true"></i></p>
												</div>
												<div class="d-flex flex-column fw-500 mx-10">
													<a href="#" class="text-dark hover-primary mb-1  fs-17">Dream House</a>
												</div>
											</div>
											<div>
												<div class="d-flex flex-column font-weight-500">
													<a href="#" class="text-fade text-end hover-primary mb-1 fs-13">9 Product</a>
												</div>
											</div>
										</div>
									</div>
									<div class="media mt-10 p-0">
										<div class="media-body m-0">
											<span class="text-fade">Portfolio</span>
											<span class="text-fade float-right">Profit</span>
											<br>
											<div>
												<p class="fs-30 mb-0">$545,569
										  		<span class="float-right fs-13 mt-10"><i class="fa fa-sort-up text-success me-1"></i> 2.5%</span></p>
											</div>
										</div>
									</div>
							  	</div>
							</div>
						</div> --}}

						{{-- <div class="col-xl-6 col-lg-6 col-sm-6">
							<div class="box pull-up">
							  	<div class="box-body media-list">
									<div>
										<div class="d-flex align-items-center justify-content-between">
											<div class="d-flex align-items-center">
												<div class="bg-primary h-40 w-40 product_icon text-center">
												  	<p class="mb-0 fs-20 w-40 fw-600"><i class="fa fa-fw fa-plane"></i></p>
												</div>
												<div class="d-flex flex-column fw-500 mx-10">
													<a href="#" class="text-dark hover-primary mb-1  fs-17">My Travel</a>
												</div>
											</div>
											<div>
												<div class="d-flex flex-column font-weight-500">
													<a href="#" class="text-fade text-end hover-primary mb-1 fs-13">9 Product</a>
												</div>
											</div>
										</div>
									</div>
									<div class="media mt-10 p-0">
										<div class="media-body m-0">
											<span class="text-fade">Portfolio</span>
											<span class="text-fade float-right">Profit</span>
											<br>
											<div>
												<p class="fs-30 mb-0">$345,155
										  		<span class="float-right fs-13 mt-10"><i class="fa fa-sort-up text-success me-1"></i> 4.5%</span></p>
											</div>
										</div>
									</div>
							  	</div>
							</div>
						</div> --}}
					</div>
				</div>


				<div class="col-xl-4 col-12 ">
					<div class="box side_product">
						<div class="box-body">


							<div class="box no-shadow mb-0 px-1">
								<div class="box-header no-border">
									<h4 class="box-title fw-500">Dernières transactions</h4>
									<div class="box-controls pull-right d-md-flex d-none">
									  <a href="#">Tout</a>
									</div>
								</div>
							</div>


							<div class="px-10">
                                @foreach ($lastTransactions as $lastTransaction)

                                    <div class="box mb-15 pull-up">
                                        <div class="box-body ">
                                            <div class="d-flex align-items-center justify-content-between">
                                                <div class="d-flex align-items-center">
                                                    <div class="bg-primary h-50 w-50 l-h-50 rounded text-center">
                                                        <p class="mb-0 fs-20 fw-600">$</p>
                                                    </div>
                                                    <div class="d-flex flex-column font-weight-500 mx-10">
                                                        <a href="#" class="text-dark hover-primary mb-1  fs-17">{{$lastTransaction->type}}</a>
                                                        {{-- <span class="text-fade">Alpha</span> --}}
                                                    </div>
                                                </div>

                                                <div>
                                                    <div class="d-flex flex-column font-weight-500">
                                                        <a href="#" class="text-dark text-end hover-primary mb-1 fs-16">{{$lastTransaction->amount}}</a>
                                                        <span class="text-success">{{ $lastTransaction->date_sent->format('d/m/Y à H:i') }}</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach

								{{-- <div class="box mb-15 pull-up">
									<div class="box-body">
										<div class="d-flex align-items-center justify-content-between">
											<div class="d-flex align-items-center">
												<div class="bg-primary h-50 w-50 l-h-50 rounded text-center">
												  	<p class="mb-0 fs-20 fw-600">G</p>
												</div>
												<div class="d-flex flex-column font-weight-500 mx-10">
													<a href="#" class="text-dark hover-primary mb-1  fs-16">Alphabet</a>
													<span class="text-fade">Alpha</span>
												</div>
											</div>
											<div>
												<div class="d-flex flex-column font-weight-500">
													<a href="#" class="text-dark text-end hover-primary mb-1 fs-16">$2865</a>
													<span class="text-success">+80.11(9.10%)</span>
												</div>
											</div>
										</div>
									</div>
								</div> --}}

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

@push('home')
    <script src="{{asset('/assets/vendor_components/datatable/datatables.min.js')}}"></script>
    <script src="{{asset('/src/js/pages/data-table.js')}}"></script>

@endpush
