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
                              <li class="breadcrumb-item active" aria-current="page">QR Code pour dépot</li>
                          </ol>
                      </nav>
                  </div>
              </div>
          </div>
      </div>

      <!-- Main content -->
      <section class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <h4 class="header-title">Informations de compte</h4>
                        
                            <div class="text-center">
                                <img src="{{ $qrLink }}" alt="Payment QR Code" class="img-fluid" width="500px" height="500px">
                            </div>
                    </div> <!-- end card-body -->
                </div> <!-- end card-->

            </div>

        </div>
      </section>
      <!-- /.content -->

    </div>
    </div>
    <!-- /.content-wrapper -->

@endsection

