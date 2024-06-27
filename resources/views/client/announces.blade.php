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
                              <li class="breadcrumb-item" aria-current="page">Annonces</li>
                              <li class="breadcrumb-item active" aria-current="page">actualités v75 pro</li>
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
                    <h3 class="box-title text-info" style="font-weight: 500;">Actualités</h3>
                    <div class="box-controls pull-right">
                      <button class="btn btn-xs btn-info">Annonces</button>
                    </div>
                  </div>

                  {{-- <div class="box-body">
                    <p class="text-gray-600">Veuillez remplir les informations ci-dessous (<b><em>Titre</em></b> et <b><em>Contenu</em></b> de l'annonce) pour publier votre annonce !</p>
                  </div> --}}
                </div>
            </div>

            @foreach ($announcements as $announcement)
                <div class="col-md-12 col-lg-12">
                    <div class="box">
                        <div class="box-body">
                        <h4><a href="#">{{$announcement->title}}</a></h4>
                        <p class="text-black">{{$announcement->updated_at->format('d M, Y')}}</p>

                        @php
                            $content = $announcement->content;
                        @endphp
                        <p class="text-gray-600" style="text-align: justify; line-height:24px;">
                            <?php
                                echo '<style>';
                                    echo 'body { text-align: justify; line-height:28px; font-size:16px; color: #707070; }';
                                echo '</style>';
                                echo $content;
                            ?>
                        </p>

                        <div class="flexbox align-items-center mt-3 pull-right">
                            <div class="btn-group">
                            <a class="btn btn-xs btn-facebook" href="#" data-bs-toggle="tooltip" title="" data-bs-original-title="Share Facebook"><i class="fa fa-facebook"></i></a>
                            <a class="btn btn-xs btn-twitter" href="#" data-bs-toggle="tooltip" title="" data-bs-original-title="Share Twitter"><i class="fa fa-twitter"></i></a>
                            <a class="btn btn-xs btn-google" href="#" data-bs-toggle="tooltip" title="" data-bs-original-title="Share Google"><i class="fa fa-google"></i></a>
                            </div>

                            {{-- <a class="btn btn-sm btn-bold btn-primary" href="#">Read more</a> --}}
                        </div>
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

