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
                              <li class="breadcrumb-item" aria-current="page">Gestion des admins</li>
                              <li class="breadcrumb-item active" aria-current="page">listes des admins</li>
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
                <h2 class="box-title text-info" style="font-weight: 500">Liste des administrateurs</h2>
              </div>
              <!-- /.box-header -->
              <div class="box-body">
                  <div class="table-responsive">
                    <table id="example" class="table text-fade table-bordered table-hover display nowrap margin-top-10 w-p100">
                      <thead>
                          <tr class="text-dark">
                              <th>Nom d'utilisateur</th>
                              <th>Adresse email</th>
                              <th>Action</th>
                          </tr>
                      </thead>
                      <tbody>
                        @foreach ($admins as $admin)
                            <tr>
                                <td class="text-dark">{{ $admin->username }}</td>
                                <td>{{ $admin->email }}</td>

                                <td>
                                    <button class="btn btn-info-light ms-1" id="request" title="Editer le client">Modifier</button>
                                    <button class="btn btn-danger-light ms-1" id="exit" title="Supprimer le client">Supprimer</button>
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
    <script src="{{asset('/assets/vendor_components/datatable/datatables.min.js')}}"></script>
    <script src="{{asset('/src/js/pages/data-table.js')}}"></script>

@endpush

