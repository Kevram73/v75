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
                              <li class="breadcrumb-item" aria-current="page">Gestion des messages</li>
                              <li class="breadcrumb-item active" aria-current="page">listes des messages</li>
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
                    <h3 class="box-title text-info" style="font-weight: 500;">Messages clients</h3>
                    <div class="box-controls pull-right">
                      <button class="btn btn-xs btn-primary">Liste</button>
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
                            @php
                                $client = app\Models\Client::find($message->sender_id);
                            @endphp
                            <span><i class="fa fa-user me-2"></i> <a href="#">De : {{$client->first_name}} {{$client->last_name}}</a></span>
                            <span class="text-muted">{{$message->date_sent}}</span>
                        </div>
                    {{-- <img class="card-img-top bter-0 btsr-0" src="{{asset('/images/gallery/landscape9.jpg" alt="Card image cap')}}"> --}}
                    <div class="card-body">
                        <h4 class="card-title fw-600">{{$message->object}}</h4>
                        <p class="card-text text-gray-600">{{$message->content}}</p>
                    </div>
                    <div class="card-footer justify-content-between d-flex">
                        <ul class="list-inline mb-0 me-2">
                            {{-- <li class="list-inline-item">
                                <a href="#"><i class="fa fa-heart-o"></i></a>
                            </li>
                            <li class="list-inline-item">
                                <a href="#"><i class="fa fa-comment-o"></i></a>
                            </li> --}}
                        </ul>

                        <ul class="list-inline mb-0">
                            <li class="btn btn-danger-light ms-1"><a href="#"><i class="fa fa-trash-o"></i> Supprimer</a></li>
                            <li class="btn btn-info-light ms-1"><a href="mailto:{{$client->email}}"><i class="fa fa-email"></i> Répondre</a></li>
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

