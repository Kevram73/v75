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
                        <h3 class="box-title text-info" style="font-weight: 500;">Annonces</h3>
                        <div class="box-controls pull-right">
                          <button class="btn btn-xs btn-primary">Redaction</button>
                        </div>
                      </div>

                      <div class="box-body">
                        <p class="text-gray-600">Veuillez remplir les informations ci-dessous (<b><em>Titre</em></b> et <b><em>Contenu</em></b> de l'annonce) pour publier votre annonce !</p>
                      </div>
                    </div>
                </div>

            <div class="col-12">

				<form class="form-horizontal form-element" method="POST" action="{{ route('admin.announcements.store') }}" enctype="multipart/form-data">
                    @csrf
                    <div class="box">
                        <div class="box-header">
                            <h5 class="box-title" style="font-weight: 600">Titre :<br>
                            {{-- <small>Bootstrap html5 editor</small> --}}
                            </h5>
                        </div>
                        <div class="box-body">
                            <div class="col-12">
                                <div class="input-group">
                                <div class="input-group-addon" style="border: 1px solid rgb(225, 225, 225);">
                                    <i class="fa fa-pencil"></i>
                                </div>
                                <input type="text" name="title" placeholder="Titre de la publication" class="form-control" required style="border: 1px solid rgb(225, 225, 225); color:black;">
                                </div>
                                <!-- /.input group -->
                            </div>
                        </div>

                        <div class="box-header">
                            <h5 class="box-title" style="font-weight: 600">Contenu :<br></h5>
                        </div>
                        <div class="box-body">
                            <textarea id="editor1" placeholder="Rédigez votre contenu ici" name="content" style="width: 100%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;" required rows="10" cols="80"></textarea>
                        </div>

                        <br><div class="box-footer">
                            <button type="reset" class="btn btn-danger-light ms-1">Annuler</button>
                            <button type="submit" class="btn btn-info-light ms-1">Publier</button>
                        </div>
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

