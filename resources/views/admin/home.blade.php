@extends('layouts.app')

@section('title', '| V75 Admin Dashboard')

@section('content')

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper" >
	  <div class="container-full">

		<!-- Main content -->
		<section class="content">
			<div class="row">
				<div class="col-xl-8 col-lg-12">
					<div class="row">
						<div class="col-xl-6 col-lg-6 col-12">
							<div class="box box-body pull-up Sales_Profit">
								<div class="row">
									<div class="col-8">
										<h4 class="hover-primary"><i class="fa fa-fw fa-gg-circle text-primary"></i> Total entrée</h4>
										<p class="fs-35 fw-600 mb-0">$258,789</p>
									</div>
									<div class=" col-4 text-end" style="position: relative;">
										<div id="new-leads-chart" style="min-height: 70px;"></div>
									</div>
								</div>
							</div>
						</div>
						<div class="col-xl-6 col-lg-6 col-12">
							<div class="box box-body pull-up Sales_Profit ">
								<div class="row">
									<div class="col-8 ">
										<h4 class="hover-success"><i class="fa fa-fw fa-gg-circle text-primary"></i> Total reversé</h4>
										<div class="d-flex">
											<p class="fs-35 fw-600 mb-0">$159,348 </p>
									  		<div class="text-end mt-20 fs-13"><i class="fa fa-sort-up text-success me-1"></i> 3.3%/24h</div>
										</div>
									</div>
									<div class="col-4 text-end" style="position: relative;">
										<div id="new-leads-chart2" style="min-height: 70px;"></div>
									</div>
								</div>
							</div>
						</div>
						<div class="col-xl-12">
							<div class="card chart_card">
								<div class="card-body">
									<div class="box-header px-0">
										<h4>Profit</h4>
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
						<div class="col-xl-6 col-lg-6 col-sm-6">
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
						</div>
						<div class="col-xl-6 col-lg-6 col-sm-6">
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
						</div>
					</div>
				</div>


				<div class="col-xl-4 col-12 ">
					<div class="box side_product">
						<div class="box-body">
							<div class="box no-shadow mb-0">
								<div class="box-header no-border">
									<h4 class="fw-500">Product</h4>
									<p>Choose your produce,for which Build your investment portfolio.
									Monitor How Your Investment are Working</p>
									<div class="box-controls pull-right d-md-flex d-none">
									  <a href="#">View All</a>
									</div>
								</div>
								<div class=" d-flex text-center">
									<div class="box-body product_box">
										<div class="bg-primary h-50 w-50 l-h-55 rounded text-center">
											<p class="fs-20"><i class="fa fa-database" aria-hidden="true"></i></p>
										</div>
										<p class="fw-600 mt-10 text-fade">Market</p>
									</div>
									<div class="box-body product_box">
										<div class="bg-primary h-50 w-50 l-h-55 rounded text-center">
											<p class="fs-20"><i class="fa fa-fw fa-file"></i></p>
										</div>
										<p class="fw-600 mt-10 text-fade">Bond</p>
									</div>
									<div class="box-body product_box">
										<div class="bg-primary h-50 w-50 l-h-55 rounded text-center">
											<p class="fs-20"><i class="fa fa-bar-chart" aria-hidden="true"></i></p>
										</div>
										<p class="fw-600 mt-10 text-fade">Stock</p>
									</div>
									<div class="box-body product_box">
										<div class="bg-primary h-50 w-50 l-h-55 rounded text-center">
											<p class="fs-20"><i class="fa fa-fw fa-ioxhost"></i></p>
										</div>
										<p class="fw-600 mt-10 text-fade">Gold</p>
									</div>
								</div>
							</div>

							<div class="box no-shadow mb-0 px-10">
								<div class="box-header no-border">
									<h4 class="box-title fw-500">Lessons</h4>
									<div class="box-controls pull-right d-md-flex d-none">
									  <a href="#">View All</a>
									</div>
								</div>
							</div>
							<div class="px-10">
								<div class="box mb-15 pull-up">
									<div class="box-body ">
										<div class="d-flex align-items-center justify-content-between">
											<div class="d-flex align-items-center">
												<div class="bg-primary h-50 w-50 l-h-50 rounded text-center">
												  	<p class="mb-0 fs-20 fw-600">A</p>
												</div>
												<div class="d-flex flex-column font-weight-500 mx-10">
													<a href="#" class="text-dark hover-primary mb-1  fs-17">Amazon</a>
													<span class="text-fade">Alpha</span>
												</div>
											</div>
											<div>
												<div class="d-flex flex-column font-weight-500">
													<a href="#" class="text-dark text-end hover-primary mb-1 fs-16">$3580.29</a>
													<span class="text-success">+40.1(2.44%)</span>
												</div>
											</div>
										</div>
									</div>
								</div>
								<div class="box mb-15 pull-up">
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
								</div>
								<div class="box mb-15 pull-up">
									<div class="box-body">
										<div class="d-flex align-items-center justify-content-between">
											<div class="d-flex align-items-center">
												<div class="bg-primary h-50 w-50 l-h-50 rounded text-center">
												  	<p class="mb-0 fs-20 fw-600">E</p>
												</div>
												<div class="d-flex flex-column font-weight-500 mx-10">
													<a href="#" class="text-dark hover-primary mb-1  fs-16">eBay</a>
													<span class="text-fade">Micak Doe</span>
												</div>
											</div>
											<div>
												<div class="d-flex flex-column font-weight-500">
													<a href="#" class="text-dark text-end hover-primary mb-1 fs-16">$59.29</a>
													<span class="text-success">+66.11(6.54%)</span>
												</div>
											</div>
										</div>
									</div>
								</div>
								<div class="box mb-15 pull-up">
									<div class="box-body">
										<div class="d-flex align-items-center justify-content-between">
											<div class="d-flex align-items-center">
												<div class="bg-primary h-50 w-50 l-h-50 rounded text-center">
												  	<p class="mb-0 fs-20 fw-600">M</p>
												</div>
												<div class="d-flex flex-column font-weight-500 mx-10">
													<a href="#" class="text-dark hover-primary mb-1  fs-16">Meta</a>
													<span class="text-fade">Micak Doe</span>
												</div>
											</div>
											<div>
												<div class="d-flex flex-column font-weight-500">
													<a href="#" class="text-dark text-end hover-primary mb-1 fs-16">257.09</a>
													<span class="text-success">+50(7.54%)</span>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>

				<div class="col-lg-12">
					<div class="row">
						<div class="col-lg-6 col-md-12 col-12">
							<div class="box">
								<div class="box-body">
									<h3>Sectors Holding In This Online Fund</h3>
									<div>
										<ul class="nav nav-tabs nav-bordered mb-3">
											<li class="nav-item be-1 active">
												<a href="#home-b1" data-bs-toggle="tab" aria-expanded="false" class="nav-link active">
													<span>Stor By</span>
												</a>
											</li>
											<li class="nav-item be-1">
												<a href="#profile-b1" data-bs-toggle="tab" aria-expanded="true" class="nav-link ">

													<span>Value</span>
												</a>
											</li>
											<li class="nav-item">
												<a href="#settings-b1" data-bs-toggle="tab" aria-expanded="false" class="nav-link">

													<span>Sector</span>
												</a>
											</li>
										</ul>
										<div class="tab-content">
											<div class="tab-pane active table-responsive" id="home-b1">
												<div class="box-body p-0">
													<div class="mb-25 pb-25">
														<div class="d-flex align-items-center justify-content-between">
															<div>
																<h5 class="mb-0">Layzoo Ltd.</h5>
															</div>
															<div class="d-flex align-items-center justify-content-between">
																<div class="w-150 mx-20">
																	<div class="progress progress-lg mb-0">
																		<div class="progress-bar bg-success" role="progressbar" style="width: 94.11%" aria-valuenow="94.11" aria-valuemin="0" aria-valuemax="100"></div>94.11%
																	</div>
																</div>
																<h5 class="mb-0">$573.06</h5>
															</div>
														</div>
													</div>
													<div class="mb-25 pb-25">
														<div class="d-flex align-items-center justify-content-between">
															<div>
																<h5 class="mb-0">NightBlink Ltd.</h5>
															</div>
															<div class="d-flex align-items-center justify-content-between">
																<div class="w-150 mx-20">
																	<div class="progress progress-lg mb-0">
																		<div class="progress-bar bg-success" role="progressbar" style="width: 9.91%" aria-valuenow="9.91" aria-valuemin="0" aria-valuemax="100"></div>9.91%
																	</div>
																</div>
																<h5 class="mb-0">$499.33</h5>
															</div>
														</div>
													</div>
													<div class="mb-25 pb-25">
														<div class="d-flex align-items-center justify-content-between">
															<div>
																<h5 class="mb-0">Lcyflame Ltd.</h5>
															</div>
															<div class="d-flex align-items-center justify-content-between">
																<div class="w-150 mx-20">
																	<div class="progress progress-lg mb-0">
																		<div class="progress-bar bg-success" role="progressbar" style="width: 7.96%" aria-valuenow="7.96" aria-valuemin="0" aria-valuemax="100"></div>7.96%
																	</div>
																</div>
																<h5 class="mb-0">$400.30</h5>
															</div>
														</div>
													</div>
													<div class="mb-25 pb-25">
														<div class="d-flex align-items-center justify-content-between">
															<div>
																<h5 class="mb-0">Feelopie Services Ltd.</h5>
															</div>
															<div class="d-flex align-items-center justify-content-between">
																<div class="w-150 mx-20">
																	<div class="progress progress-lg mb-0">
																		<div class="progress-bar bg-success" role="progressbar" style="width: 6.40%" aria-valuenow="6.40" aria-valuemin="0" aria-valuemax="100"></div>6.40%
																	</div>
																</div>
																<h5 class="mb-0">$322.93</h5>
															</div>
														</div>
													</div>
													<div class="mb-10">
														<div class="d-flex align-items-center justify-content-between">
															<div>
																<h5 class="mb-0">Grofler Ltd.</h5>
															</div>
															<div class="d-flex align-items-center justify-content-between">
																<div class="w-150 mx-20">
																	<div class="progress progress-lg mb-0">
																		<div class="progress-bar bg-success" role="progressbar" style="width: 1.22%" aria-valuenow="1.22" aria-valuemin="0" aria-valuemax="100"></div>1.22%
																	</div>
																</div>
																<h5 class="mb-0">$601.50</h5>
															</div>
														</div>
													</div>
												</div>
											</div>
											<div class="tab-pane table-responsive" id="profile-b1">
												<div class="box-body p-0">
													<div class="mb-25 pb-25">
														<div class="d-flex align-items-center justify-content-between">
															<div>
																<h5 class="mb-0">Layzoo Ltd.</h5>
															</div>
															<div class="d-flex align-items-center justify-content-between">
																<div class="w-150 mx-20">
																	<div class="progress progress-lg mb-0">
																		<div class="progress-bar bg-success" role="progressbar" style="width: 94.11%" aria-valuenow="94.11" aria-valuemin="0" aria-valuemax="100"></div>94.11%
																	</div>
																</div>
																<h5 class="mb-0">$573.06</h5>
															</div>
														</div>
													</div>
													<div class="mb-25 pb-25">
														<div class="d-flex align-items-center justify-content-between">
															<div>
																<h5 class="mb-0">NightBlink Ltd.</h5>
															</div>
															<div class="d-flex align-items-center justify-content-between">
																<div class="w-150 mx-20">
																	<div class="progress progress-lg mb-0">
																		<div class="progress-bar bg-success" role="progressbar" style="width: 9.91%" aria-valuenow="9.91" aria-valuemin="0" aria-valuemax="100"></div>9.91%
																	</div>
																</div>
																<h5 class="mb-0">$499.33</h5>
															</div>
														</div>
													</div>
													<div class="mb-25 pb-25">
														<div class="d-flex align-items-center justify-content-between">
															<div>
																<h5 class="mb-0">Lcyflame Ltd.</h5>
															</div>
															<div class="d-flex align-items-center justify-content-between">
																<div class="w-150 mx-20">
																	<div class="progress progress-lg mb-0">
																		<div class="progress-bar bg-success" role="progressbar" style="width: 7.96%" aria-valuenow="7.96" aria-valuemin="0" aria-valuemax="100"></div>7.96%
																	</div>
																</div>
																<h5 class="mb-0">$400.30</h5>
															</div>
														</div>
													</div>
													<div class="mb-25 pb-25">
														<div class="d-flex align-items-center justify-content-between">
															<div>
																<h5 class="mb-0">Feelopie Services Ltd.</h5>
															</div>
															<div class="d-flex align-items-center justify-content-between">
																<div class="w-150 mx-20">
																	<div class="progress progress-lg mb-0">
																		<div class="progress-bar bg-success" role="progressbar" style="width: 6.40%" aria-valuenow="6.40" aria-valuemin="0" aria-valuemax="100"></div>6.40%
																	</div>
																</div>
																<h5 class="mb-0">$322.93</h5>
															</div>
														</div>
													</div>
													<div class="mb-10">
														<div class="d-flex align-items-center justify-content-between">
															<div>
																<h5 class="mb-0">Grofler Ltd.</h5>
															</div>
															<div class="d-flex align-items-center justify-content-between">
																<div class="w-150 mx-20">
																	<div class="progress progress-lg mb-0">
																		<div class="progress-bar bg-success" role="progressbar" style="width: 1.22%" aria-valuenow="1.22" aria-valuemin="0" aria-valuemax="100"></div>1.22%
																	</div>
																</div>
																<h5 class="mb-0">$601.50</h5>
															</div>
														</div>
													</div>
												</div>
											</div>
											<div class="tab-pane table-responsive" id="settings-b1">
												<div class="box-body p-0">
													<div class="mb-25 pb-25">
														<div class="d-flex align-items-center justify-content-between">
															<div>
																<h5 class="mb-0">Layzoo Ltd.</h5>
															</div>
															<div class="d-flex align-items-center justify-content-between">
																<div class="w-150 mx-20">
																	<div class="progress progress-lg mb-0">
																		<div class="progress-bar bg-success" role="progressbar" style="width: 94.11%" aria-valuenow="94.11" aria-valuemin="0" aria-valuemax="100"></div>94.11%
																	</div>
																</div>
																<h5 class="mb-0">$573.06</h5>
															</div>
														</div>
													</div>
													<div class="mb-25 pb-25">
														<div class="d-flex align-items-center justify-content-between">
															<div>
																<h5 class="mb-0">NightBlink Ltd.</h5>
															</div>
															<div class="d-flex align-items-center justify-content-between">
																<div class="w-150 mx-20">
																	<div class="progress progress-lg mb-0">
																		<div class="progress-bar bg-success" role="progressbar" style="width: 9.91%" aria-valuenow="9.91" aria-valuemin="0" aria-valuemax="100"></div>9.91%
																	</div>
																</div>
																<h5 class="mb-0">$499.33</h5>
															</div>
														</div>
													</div>
													<div class="mb-25 pb-25">
														<div class="d-flex align-items-center justify-content-between">
															<div>
																<h5 class="mb-0">Lcyflame Ltd.</h5>
															</div>
															<div class="d-flex align-items-center justify-content-between">
																<div class="w-150 mx-20">
																	<div class="progress progress-lg mb-0">
																		<div class="progress-bar bg-success" role="progressbar" style="width: 7.96%" aria-valuenow="7.96" aria-valuemin="0" aria-valuemax="100"></div>7.96%
																	</div>
																</div>
																<h5 class="mb-0">$400.30</h5>
															</div>
														</div>
													</div>
													<div class="mb-25 pb-25">
														<div class="d-flex align-items-center justify-content-between">
															<div>
																<h5 class="mb-0">Feelopie Services Ltd.</h5>
															</div>
															<div class="d-flex align-items-center justify-content-between">
																<div class="w-150 mx-20">
																	<div class="progress progress-lg mb-0">
																		<div class="progress-bar bg-success" role="progressbar" style="width: 6.40%" aria-valuenow="6.40" aria-valuemin="0" aria-valuemax="100"></div>6.40%
																	</div>
																</div>
																<h5 class="mb-0">$322.93</h5>
															</div>
														</div>
													</div>
													<div class="mb-10">
														<div class="d-flex align-items-center justify-content-between">
															<div>
																<h5 class="mb-0">Grofler Ltd.</h5>
															</div>
															<div class="d-flex align-items-center justify-content-between">
																<div class="w-150 mx-20">
																	<div class="progress progress-lg mb-0">
																		<div class="progress-bar bg-success" role="progressbar" style="width: 1.22%" aria-valuenow="1.22" aria-valuemin="0" aria-valuemax="100"></div>1.22%
																	</div>
																</div>
																<h5 class="mb-0">$601.50</h5>
															</div>
														</div>
													</div>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
						<div class="col-lg-6 col-md-12 col-12">
							<div class="box">
								<div class="box-body">
									<h3>Companies Holding In This Online Fund</h3>
									<div>
										<ul class="nav nav-tabs nav-bordered mb-3">
											<li class="nav-item be-1 active">
												<a href="#home-b2" data-bs-toggle="tab" aria-expanded="false" class="nav-link active">

													<span>Stor By</span>
												</a>
											</li>
											<li class="nav-item be-1">
												<a href="#profile-b2" data-bs-toggle="tab" aria-expanded="true" class="nav-link ">

													<span>Value</span>
												</a>
											</li>
											<li class="nav-item">
												<a href="#settings-b2" data-bs-toggle="tab" aria-expanded="false" class="nav-link">

													<span>Sector</span>
												</a>
											</li>
										</ul>
										<div class="tab-content">
											<div class="tab-pane active show table-responsive" id="home-b2">
												<div class="box-body p-0">
													<div class="mb-25 pb-25">
														<div class="d-flex align-items-center justify-content-between">
															<div>
																<h5 class="mb-0">Layzoo Ltd.</h5>
															</div>
															<div class="d-flex align-items-center justify-content-between">
																<div class="w-150 mx-20">
																	<div class="progress progress-lg mb-0">
																		<div class="progress-bar bg-success" role="progressbar" style="width: 94.11%" aria-valuenow="94.11" aria-valuemin="0" aria-valuemax="100"></div>94.11%
																	</div>
																</div>
																<h5 class="mb-0">$573.06</h5>
															</div>
														</div>
													</div>
													<div class="mb-25 pb-25">
														<div class="d-flex align-items-center justify-content-between">
															<div>
																<h5 class="mb-0">NightBlink Ltd.</h5>
															</div>
															<div class="d-flex align-items-center justify-content-between">
																<div class="w-150 mx-20">
																	<div class="progress progress-lg mb-0">
																		<div class="progress-bar bg-success" role="progressbar" style="width: 9.91%" aria-valuenow="9.91" aria-valuemin="0" aria-valuemax="100"></div>9.91%
																	</div>
																</div>
																<h5 class="mb-0">$499.33</h5>
															</div>
														</div>
													</div>
													<div class="mb-25 pb-25">
														<div class="d-flex align-items-center justify-content-between">
															<div>
																<h5 class="mb-0">Lcyflame Ltd.</h5>
															</div>
															<div class="d-flex align-items-center justify-content-between">
																<div class="w-150 mx-20">
																	<div class="progress progress-lg mb-0">
																		<div class="progress-bar bg-success" role="progressbar" style="width: 7.96%" aria-valuenow="7.96" aria-valuemin="0" aria-valuemax="100"></div>7.96%
																	</div>
																</div>
																<h5 class="mb-0">$400.30</h5>
															</div>
														</div>
													</div>
													<div class="mb-25 pb-25">
														<div class="d-flex align-items-center justify-content-between">
															<div>
																<h5 class="mb-0">Feelopie Services Ltd.</h5>
															</div>
															<div class="d-flex align-items-center justify-content-between">
																<div class="w-150 mx-20">
																	<div class="progress progress-lg mb-0">
																		<div class="progress-bar bg-success" role="progressbar" style="width: 6.40%" aria-valuenow="6.40" aria-valuemin="0" aria-valuemax="100"></div>6.40%
																	</div>
																</div>
																<h5 class="mb-0">$322.93</h5>
															</div>
														</div>
													</div>
													<div class="mb-10">
														<div class="d-flex align-items-center justify-content-between">
															<div>
																<h5 class="mb-0">Grofler Ltd.</h5>
															</div>
															<div class="d-flex align-items-center justify-content-between">
																<div class="w-150 mx-20">
																	<div class="progress progress-lg mb-0">
																		<div class="progress-bar bg-success" role="progressbar" style="width: 1.22%" aria-valuenow="1.22" aria-valuemin="0" aria-valuemax="100"></div>1.22%
																	</div>
																</div>
																<h5 class="mb-0">$601.50</h5>
															</div>
														</div>
													</div>
												</div>
											</div>
											<div class="tab-pane table-responsive" id="profile-b2">
												<div class="box-body p-0">
													<div class="mb-25 pb-25">
														<div class="d-flex align-items-center justify-content-between">
															<div>
																<h5 class="mb-0">Layzoo Ltd.</h5>
															</div>
															<div class="d-flex align-items-center justify-content-between">
																<div class="w-150 mx-20">
																	<div class="progress progress-lg mb-0">
																		<div class="progress-bar bg-success" role="progressbar" style="width: 94.11%" aria-valuenow="94.11" aria-valuemin="0" aria-valuemax="100"></div>94.11%
																	</div>
																</div>
																<h5 class="mb-0">$573.06</h5>
															</div>
														</div>
													</div>
													<div class="mb-25 pb-25">
														<div class="d-flex align-items-center justify-content-between">
															<div>
																<h5 class="mb-0">NightBlink Ltd.</h5>
															</div>
															<div class="d-flex align-items-center justify-content-between">
																<div class="w-150 mx-20">
																	<div class="progress progress-lg mb-0">
																		<div class="progress-bar bg-success" role="progressbar" style="width: 9.91%" aria-valuenow="9.91" aria-valuemin="0" aria-valuemax="100"></div>9.91%
																	</div>
																</div>
																<h5 class="mb-0">$499.33</h5>
															</div>
														</div>
													</div>
													<div class="mb-25 pb-25">
														<div class="d-flex align-items-center justify-content-between">
															<div>
																<h5 class="mb-0">Lcyflame Ltd.</h5>
															</div>
															<div class="d-flex align-items-center justify-content-between">
																<div class="w-150 mx-20">
																	<div class="progress progress-lg mb-0">
																		<div class="progress-bar bg-success" role="progressbar" style="width: 7.96%" aria-valuenow="7.96" aria-valuemin="0" aria-valuemax="100"></div>7.96%
																	</div>
																</div>
																<h5 class="mb-0">$400.30</h5>
															</div>
														</div>
													</div>
													<div class="mb-25 pb-25">
														<div class="d-flex align-items-center justify-content-between">
															<div>
																<h5 class="mb-0">Feelopie Services Ltd.</h5>
															</div>
															<div class="d-flex align-items-center justify-content-between">
																<div class="w-150 mx-20">
																	<div class="progress progress-lg mb-0">
																		<div class="progress-bar bg-success" role="progressbar" style="width: 6.40%" aria-valuenow="6.40" aria-valuemin="0" aria-valuemax="100"></div>6.40%
																	</div>
																</div>
																<h5 class="mb-0">$322.93</h5>
															</div>
														</div>
													</div>
													<div class="mb-10">
														<div class="d-flex align-items-center justify-content-between">
															<div>
																<h5 class="mb-0">Grofler Ltd.</h5>
															</div>
															<div class="d-flex align-items-center justify-content-between">
																<div class="w-150 mx-20">
																	<div class="progress progress-lg mb-0">
																		<div class="progress-bar bg-success" role="progressbar" style="width: 1.22%" aria-valuenow="1.22" aria-valuemin="0" aria-valuemax="100"></div>1.22%
																	</div>
																</div>
																<h5 class="mb-0">$601.50</h5>
															</div>
														</div>
													</div>
												</div>
											</div>
											<div class="tab-pane table-responsive" id="settings-b2">
												<div class="box-body p-0">
													<div class="mb-25 pb-25">
														<div class="d-flex align-items-center justify-content-between">
															<div>
																<h5 class="mb-0">Layzoo Ltd.</h5>
															</div>
															<div class="d-flex align-items-center justify-content-between">
																<div class="w-150 mx-20">
																	<div class="progress progress-lg mb-0">
																		<div class="progress-bar bg-success" role="progressbar" style="width: 94.11%" aria-valuenow="94.11" aria-valuemin="0" aria-valuemax="100"></div>94.11%
																	</div>
																</div>
																<h5 class="mb-0">$573.06</h5>
															</div>
														</div>
													</div>
													<div class="mb-25 pb-25">
														<div class="d-flex align-items-center justify-content-between">
															<div>
																<h5 class="mb-0">NightBlink Ltd.</h5>
															</div>
															<div class="d-flex align-items-center justify-content-between">
																<div class="w-150 mx-20">
																	<div class="progress progress-lg mb-0">
																		<div class="progress-bar bg-success" role="progressbar" style="width: 9.91%" aria-valuenow="9.91" aria-valuemin="0" aria-valuemax="100"></div>9.91%
																	</div>
																</div>
																<h5 class="mb-0">$499.33</h5>
															</div>
														</div>
													</div>
													<div class="mb-25 pb-25">
														<div class="d-flex align-items-center justify-content-between">
															<div>
																<h5 class="mb-0">Lcyflame Ltd.</h5>
															</div>
															<div class="d-flex align-items-center justify-content-between">
																<div class="w-150 mx-20">
																	<div class="progress progress-lg mb-0">
																		<div class="progress-bar bg-success" role="progressbar" style="width: 7.96%" aria-valuenow="7.96" aria-valuemin="0" aria-valuemax="100"></div>7.96%
																	</div>
																</div>
																<h5 class="mb-0">$400.30</h5>
															</div>
														</div>
													</div>
													<div class="mb-25 pb-25">
														<div class="d-flex align-items-center justify-content-between">
															<div>
																<h5 class="mb-0">Feelopie Services Ltd.</h5>
															</div>
															<div class="d-flex align-items-center justify-content-between">
																<div class="w-150 mx-20">
																	<div class="progress progress-lg mb-0">
																		<div class="progress-bar bg-success" role="progressbar" style="width: 6.40%" aria-valuenow="6.40" aria-valuemin="0" aria-valuemax="100"></div>6.40%
																	</div>
																</div>
																<h5 class="mb-0">$322.93</h5>
															</div>
														</div>
													</div>
													<div class="mb-10">
														<div class="d-flex align-items-center justify-content-between">
															<div>
																<h5 class="mb-0">Grofler Ltd.</h5>
															</div>
															<div class="d-flex align-items-center justify-content-between">
																<div class="w-150 mx-20">
																	<div class="progress progress-lg mb-0">
																		<div class="progress-bar bg-success" role="progressbar" style="width: 1.22%" aria-valuenow="1.22" aria-valuemin="0" aria-valuemax="100"></div>1.22%
																	</div>
																</div>
																<h5 class="mb-0">$601.50</h5>
															</div>
														</div>
													</div>
												</div>
											</div>
										</div>
									</div>
								</div>
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
