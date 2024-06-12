@extends('layouts.app')

@section('title', '| V75 Admin Dashboard')

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
                              <li class="breadcrumb-item" aria-current="page">Gestion des clients</li>
                              <li class="breadcrumb-item active" aria-current="page">listes des clients</li>
                          </ol>
                      </nav>
                  </div>
              </div>
          </div>
      </div>

      <!-- Main content -->
      <section class="content">
        <div class="row">

          <div class="col-12">
              <div class="box">
              <div class="box-header with-border">
                <h2 class="box-title text-info" style="font-weight: 500">Liste des clients</h2>
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
                              <th>Action</th>
                          </tr>
                      </thead>
                      <tbody>
                        @foreach ($clients as $client)
                            <tr>
                                <td class="text-dark">{{$client->lastname}}</td>
                                <td>{{$client->firstname}}</td>
                                <td>{{$client->email}}</td>
                                <td>{{$client->phone_number}}</td>
                                <td>
                                @if ($client->is_active == TRUE)
                                    <button class="btn btn-primary btn-md mt-5"><i class="fa fa-check"></i> Actif</button>
                                @else
                                    <button class="btn btn-danger btn-md mt-5"><i class="fa fa-check"></i> Inactif</button>
                                @endif
                                </td>
                                <td>
                                    <a href="">
                                        <button class="btn btn-info-light ms-1" id="request" title="Editer le client">Modifier</button>
                                    </a>
                                    <a href="">
					                    <button class="btn btn-danger-light ms-1" id="exit" title="Supprimer le client">Supprimer</button>
                                    </a>
                                    {{-- <button type="button" class="btn btn-xs bg-primary btn-circle" data-bs-toggle="tooltip" title="" data-bs-original-title="Edit">
                                        <i class="fa fa-pencil"></i>
                                    </button>
                                    <button type="button" class="btn btn-xs bg-primary btn-circle" data-bs-toggle="tooltip" title="" data-bs-original-title="Delete">
                                        <i class="fa fa-trash"></i>
                                    </button> --}}
                                </td>
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
    <script src="../../../assets/vendor_components/datatable/datatables.min.js"></script>
    <script src="../src/js/pages/data-table.js"></script>

@endpush

