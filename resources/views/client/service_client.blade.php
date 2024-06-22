@extends('layouts.app2')

@section('title', '| V75 Dashboard')

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
                              <li class="breadcrumb-item" aria-current="page">Service client</li>
                              <li class="breadcrumb-item active" aria-current="page">Mes messages</li>
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
                    <h3 class="box-title text-info" style="font-weight: 500;">{{ Auth::guard('client')->user()->first_name }} {{ Auth::guard('client')->user()->last_name }}</h3>
                    <div class="box-controls pull-right">
                      <button class="btn btn-xs btn-info">Messages envoyés</button>
                    </div>
                  </div>

                  {{-- <div class="box-body">
                    <p class="text-gray-600">Veuillez remplir les informations ci-dessous (<b><em>Titre</em></b> et <b><em>Contenu</em></b> de l'annonce) pour publier votre annonce !</p>
                  </div> --}}
                </div>
            </div>

            @foreach ($messages as $message)
                <div class="col-md-12 col-lg-6">
                    <div class="card">
                        <div class="card-header d-flex justify-content-between">

                            <span><i class="fa fa-user me-2"></i> <a href="#">Par vous</a></span>
                            <span class="text-muted">{{$message->created_at->format('d/m/Y à H:i')}}</span>
                        </div>
                    <div class="card-body">
                        <h4 class="card-title fw-600">{{$message->object}}</h4>
                        <p class="card-text text-gray-600" style="text-align: justify; line-height:24px;">{{$message->content}}</p>
                    </div>
                    <div class="card-footer justify-content-between d-flex">
                        <ul class="list-inline mb-0 me-2">
                            <li class="list-inline-item">
                                <i class="fa fa-comment-o"></i>
                            </li>
                            <li class="list-inline-item">
                                <button class="btn btn-xs btn-primary">envoyé</button>
                            </li>
                        </ul>


                    </div>
                    </div>
                </div>
            @endforeach

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

