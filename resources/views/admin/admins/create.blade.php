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
                                <li class="breadcrumb-item" aria-current="page">Annonces</li>
                                <li class="breadcrumb-item active" aria-current="page">Rédiger une annonce</li>
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
                        <h3 class="box-title text-info" style="font-weight: 500;">Admins</h3>
                        <div class="box-controls pull-right">
                          <button class="btn btn-xs btn-primary">Création</button>
                        </div>
                      </div>

                      <div class="box-body">
                        <p class="text-gray-600">Veuillez remplir les champs ci-après !</p>
                      </div>
                    </div>
                </div>

            <div class="col-12">

				<form class="form-horizontal form-element" method="POST" action="{{ route('admin.admins.store') }}" enctype="multipart/form-data">
                    @csrf
                    <div class="box">
                        <div class="box-header with-border">
                          <h4 class="box-title" style="color: rgb(184, 184, 184);">Nouvel administrateur</h4>
                        </div>
                        <!-- /.box-header -->
                        <!-- form start -->
                        <form class="form-horizontal form-element">
                          <div class="box-body">
                            <div class="form-group row">
                                <label for="username" class="col-sm-2 form-label">Nom d'utilisateur : </label>

                                <div class="col-sm-10">
                                  <input type="text" placeholder="Username" class="form-control" id="username" name="username" required style="color: black;">

                                </div>
                              </div>
                            <div class="form-group row">
                              <label for="email" class="col-sm-2 form-label">Email : </label>

                              <div class="col-sm-10">
                                <input type="email" placeholder="Adresse email" class="form-control" id="email" name="email" required style="color: black;">

                              </div>
                            </div>
                            <div class="form-group row">
                              <label for="password" class="col-sm-2 form-label">Mot de passe : </label>

                              <div class="col-sm-10">
                                <input type="password" placeholder="********" class="form-control" id="password" name="password" required style="color: black;">
                                
                              </div>
                            </div>

                          </div>
                          <!-- /.box-body -->
                          <div class="box-footer">
                            <button type="reset" class="btn btn-danger-light ms-1">Cancel</button>
                            <button type="submit" class="btn btn-info-light ms-1">Sign in</button>
                          </div>
                          <!-- /.box-footer -->
                        </form>
                      </div>
                </form>
                <!-- /.box -->


                <!-- /.box -->

            </div>
            <!-- /.col-->
            </div>
            <!-- ./row -->
        </section>
        <!-- /.content -->
        </div>
    </div>
    <!-- /.content-wrapper -->

@endsection

@push('editor')
    <script src="{{asset('/assets/vendor_components/ckeditor/ckeditor.js')}}"></script>
    <script src="https://cdn.ckeditor.com/ckeditor5/29.2.0/classic/ckeditor.js"></script>
    <script src="{{asset('/assets/vendor_plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.js')}}"></script>

    <script src="{{asset('/src/js/pages/editor.js')}}"></script>

@endpush

