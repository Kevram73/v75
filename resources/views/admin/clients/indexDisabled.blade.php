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
                              <li class="breadcrumb-item" aria-current="page">Gestion des clients</li>
                              <li class="breadcrumb-item active" aria-current="page">listes des clients retirés</li>
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
                <h2 class="box-title text-info" style="font-weight: 500">Liste des clients retirés</h2>
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
                              <th>Action</th>
                          </tr>
                      </thead>
                      <tbody>
                        @foreach ($clients as $client)
                            <tr>
                                <td class="text-dark">{{$client->last_name}}</td>
                                <td>{{$client->first_name}}</td>
                                <td>{{$client->email}}</td>
                                <td>{{$client->phone_number}}</td>

                                <td>
                                    <a href="{{ route('admin.client.activate', $client->id) }}" class="btn btn-danger-light ms-1" id="request" title="Désactiver le client">
                                        Activer
                                    </a>
                                    <a href="">
                                        <button class="btn btn-info-light ms-1" id="request" title="Editer le client" data-bs-toggle="modal" data-bs-target="#info-alert-modal">Réintégrer</button>
                                    </a>
                                    <a href="">
					                    <button class="btn btn-danger-light ms-1" id="exit" title="Supprimer le client" data-bs-toggle="modal" data-bs-target="#danger-alert-modal">Supprimer</button>
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

    <form action="">
        <div id="danger-alert-modal" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog modal-sm">
                <div class="modal-content modal-filled bg-danger">
                    <div class="modal-body p-4">
                        <div class="text-center" style="color: white; font-size:15px;">
                            <i class="dripicons-wrong h1"></i>
                            <h4 class="mt-2">Suppression !</h4>
                            <p class="mt-3" style="text-align: center;">Etes vous sûr de vouloir supprimer ce client ? l'action sera irreversible.</p>
                            <button type="submit" class="btn btn-light my-2" data-bs-dismiss="modal">Supprimer</button>
                        </div>
                    </div>
                </div><!-- /.modal-content -->
            </div><!-- /.modal-dialog -->
        </div><!-- /.modal -->
    </form>

    <form action="">
        <div id="info-alert-modal" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog modal-sm">
                <div class="modal-content modal-filled bg-info">
                    <div class="modal-body p-4">
                        <div class="text-center" style="color: white; font-size:15px;">
                            <i class="dripicons-wrong h1"></i>
                            <h4 class="mt-2">Modification du client !</h4>
                            <p class="mt-3" style="text-align: center;">Souhaitez-vous réactiver le compte de ce client, le réintégrer à la plateforme ?<br>Son statut sera de nouveau actif !</p>
                            <button type="submit" class="btn btn-light my-2" data-bs-dismiss="modal">Réintégrer</button>
                        </div>
                    </div>
                </div><!-- /.modal-content -->
            </div><!-- /.modal-dialog -->
        </div><!-- /.modal -->
    </form>

    </div>
    </div>
    <!-- /.content-wrapper -->

@endsection

@push('datatable')
    <script src="{{asset('/assets/vendor_components/datatable/datatables.min.js')}}"></script>
    <script src="{{asset('/src/js/pages/data-table.js')}}"></script>

@endpush

