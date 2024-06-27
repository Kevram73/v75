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
                                <li class="breadcrumb-item active" aria-current="page">Liste des annonces</li>
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
                          <button class="btn btn-xs btn-primary">Liste</button>
                        </div>
                      </div>

                      {{-- <div class="box-body">
                        <p class="text-gray-600">Veuillez remplir les informations ci-dessous (<b><em>Titre</em></b> et <b><em>Contenu</em></b> de l'annonce) pour publier votre annonce !</p>
                      </div> --}}
                    </div>
                </div>

            <div class="col-12">
                @foreach ($announcements as $announcement)
                    <div class="col-md-12 col-lg-12">
                        <div class="card">
                            <div class="card-header d-flex justify-content-between">
                                <span><i class="fa fa-calendar me-2 text-primary"></i>
                                    @php
                                        $admin = app\Models\Admin::find($announcement->admin_id);
                                        $content = $announcement->content;
                                        $ctnt = Str::limit($content, 280, '...')
                                    @endphp
                                    <a href="#">{{ $announcement->updated_at->format('d/m/Y à H:i') }}</a>
                                </span>
                                <span class="text-muted text-primary"></span>
                            </div>
                        {{-- <img class="card-img-top bter-0 btsr-0" src="../../../images/gallery/landscape9.jpg" alt="Card image cap"> --}}
                        <div class="card-body">
                            <h4 class="card-title fw-600">{{ $announcement->title }}</h4>

                            <p class="card-text text-gray-600">
                                <?php
                                    echo '<style>';
                                        echo 'body { text-align: justify; line-height:26px; font-size:15px; color: #707070; }';
                                    echo '</style>';
                                    echo $ctnt;
                                ?>
                            </p>
                        </div>
                        <div class="card-footer justify-content-between d-flex">
                            <ul class="list-inline mb-0 me-2">
                                <div class="header-elements">
                                    <span class="badge bg-primary badge-pill">Publié par {{ $admin->username }}</span>
                                </div>
                            </ul>

                            <ul class="list-inline mb-0">
                                <li><a href="#" title="Editer cet annonce" class="btn btn-info-light ms-1" data-bs-toggle="modal" data-bs-target="#bs-example-modal-lg">Modifier</a></li>
                                <li><a href="#" title="Supprimer cet annonce" class="btn btn-danger-light ms-1" data-bs-toggle="modal" data-bs-target="#danger-alert-modal">Supprimer</a></li>
                            </ul>
                        </div>
                        </div>
                    </div>

                    <!-- Large modal -->
                    <div class="modal fade" id="bs-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-lg">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h4 class="modal-title" id="myLargeModalLabel">Mise à jour de l'annonce</h4>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-hidden="true"></button>
                                </div>
                                <div class="modal-body">
                                    <div class="col-12">

                                        <form class="form-horizontal form-element" method="POST" action="{{ route('admin.announcements.update', $announcement->id) }}" enctype="multipart/form-data">
                                            @csrf
                                            @method("PATCH")
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
                                                        <input type="text" name="title" placeholder="{{ $announcement->title }}" class="form-control" required style="border: 1px solid rgb(225, 225, 225); color:black;">
                                                        </div>
                                                        <!-- /.input group -->
                                                    </div>
                                                </div>

                                                <div class="box-header">
                                                    <h5 class="box-title" style="font-weight: 600">Contenu :<br></h5>
                                                </div>
                                                <div class="box-body">
                                                    <textarea id="editor1" name="content" style="width: 100%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;" required rows="10" cols="80" placeholder="<?php echo $content ?>" ></textarea>
                                                </div>

                                                <br><div class="box-footer">
                                                    <button type="reset" class="btn btn-danger-light ms-1">Annuler</button>
                                                    <button type="submit" class="btn btn-info-light ms-1">Valider</button>
                                                </div>
                                            </div>
                                        </form>
                                        <!-- /.box -->


                                        <!-- /.box -->

                                    </div>
                                </div>
                            </div><!-- /.modal-content -->
                        </div><!-- /.modal-dialog -->
                    </div><!-- /.modal -->
                @endforeach

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

