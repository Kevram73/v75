@extends('layouts.app2')

@section('title', '| V75 Dashboard')

@section('content')

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper" >
	  <div class="container-full">

        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="d-flex align-items-center">
                <div class="me-auto">
                    <h4 class="page-title">Welcome</h4>
                    <div class="d-inline-block align-items-center">
                        <nav>
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="#"><i class="mdi mdi-home-outline"></i></a></li>
                                <li class="breadcrumb-item" aria-current="page">Dashboard</li>
                                <li class="breadcrumb-item active" aria-current="page">Client</li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
        </div>

        <section class="content">
            <div class="row">

                <div class="col-xl-12 col-12">
                    <div class="box">
                      <div class="box-header">
                        <h3 class="box-title text-info" style="font-weight: 500;">Tableau de bord</h3>
                        <div class="box-controls pull-right">
                          <button class="btn btn-xs btn-primary">Bienvenue</button>
                        </div>
                      </div>

                      <div class="box-body">
                        <p class="text-gray-600"><marquee behavior="" direction="left">Avec v75, c'est votre argent qui travaille pour vous ! Investissez, aucune condition préalable requise et percevez jusqu'à 3,3% sur votre capital initial</marquee></p>
                      </div>
                    </div>
                </div>
            </div>

            <div class="row bg-transparent">
                <div class="col-xl-12 col-12">
                    <div class="row">

                        <div class="col-xl-4">
                            <div class="box">
                                <div class="card-body d-flex p-0">
                                    <div class="flex-grow-1 px-30 pt-50 pb-100 flex-grow-1 bg-img min-h-350" style="background-position: calc(100% + 0.5rem) bottom; background-size: 50% auto; background-image: url({{asset('/images/svg-icon/color-svg/custom-3.svg')}})">

                                        <p class="text-primary py-10 fs-20 fw-500">
                                            Prenez votre indépendance<br>
                                            financière<br>
                                            Investissez maintenant
                                        </p>

                                        <a href="#" class="btn btn-primary-light">Faire un placement</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-4">
                            <div class="box">
                                <div class="box-body d-flex p-0">
                                    <div class="flex-grow-1 bg-info px-30 pt-50 pb-100 flex-grow-1 bg-img min-h-350" style="background-position: right bottom; background-size: 40% auto; background-image: url({{asset('/images/svg-icon/color-svg/custom-6.svg')}})">
                                        {{-- <h3 class="fw-500">Avec v75</h3> --}}
                                        <p class="py-15 fs-20 text-white-70">
                                            Suivez de près les<br>
                                            variations du marché<br>
                                            en temps réel
                                        </p>
                                        {{-- <a href="#" class="btn btn-info-light">Faire un placement</a> --}}
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-4">
                            <div class="box">
                                <div class="box-body d-flex p-0">
                                    <div class="flex-grow-1 bg-danger px-30 pt-50 pb-100 flex-grow-1 bg-img min-h-350" style="background-position: calc(100% + 0.5rem) bottom; background-size: 68% auto; background-image: url({{asset('/images/svg-icon/color-svg/custom-2.svg')}})">

                                        <p class="py-15 pb-5 fs-20">
                                            Avec v75 gagnez jusqu'à<br>
                                            3,3% par jour sur votre<br>
                                            capital initial
                                        </p>

                                        {{-- <a href="#" class="btn btn-danger-light">Retirer maintenant</a> --}}
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>

            <div class="col-xl-12 col-lg-12">
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


                </div>
            </div>
        </section>


	  </div>
  </div>
  <!-- /.content-wrapper -->

@endsection
