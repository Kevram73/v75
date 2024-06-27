@extends('layouts.app2')

@section('title', '| V75 pro Dashboard')

@section('content')
<style>
    .hidden {
            visibility: hidden;
        }

</style>

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
                                <li class="breadcrumb-item" aria-current="page">Compte</li>
                                <li class="breadcrumb-item active" aria-current="page">Investment</li>
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
                        <h3 class="box-title text-info" style="font-weight: 500;">Transactions</h3>
                        <div class="box-controls pull-right">
                          <button class="btn btn-xs btn-primary">Retrait d'argent</button>
                        </div>
                      </div>

                      <div class="box-body">
                        <p class="text-gray-600">Veuillez renseigner votre numero/adresse de compte et le montant de la transaction !</p>
                      </div>
                    </div>
                </div>

            <div class="col-12">

				<form class="form-horizontal form-element" method="POST" action="" enctype="multipart/form-data">
                    @csrf
                    <div class="box">
                        <div class="box-header with-border">
                          <h4 class="box-title text-primary">Faire un retrait</h4>
                        @if (Session::has('error'))
                            <span style="color: red;">{{ Session::get('error') }}</span>
                        @endif
                        @if (Session::has('success'))
                            <span style="color: green;">{{ Session::get('success') }}</span>
                        @endif
                        </div>
                        <!-- /.box-header -->
                        <!-- form start -->
                        <form class="form-horizontal form-element" action="" method="POST">
                            @csrf
                            <div class="box-body">

                              <input type="text" class="hidden" id="from_account" name="from_account" required style="color: black;" value="">
                              <input type="text" class="hidden" id="type" name="type" required style="color: black;" value="retrait">
                              <input type="text" class="hidden" id="gateway" name="gateway" required style="color: black;" value="USDT TRC20">

                            <div class="form-group row">
                                <label for="to_account" class="col-sm-2 form-label">Adresse de compte : </label>

                                <div class="col-sm-10">
                                  <input type="text" placeholder="Adresse de votre portefeuille USDT" class="form-control" id="to_account" name="to_account" required style="color: black;">

                                </div>
                              </div>
                            <div class="form-group row">
                              <label for="amount" class="col-sm-2 form-label">Montant : </label>

                              <div class="col-sm-10">
                                <input type="number" placeholder="Montant de la transaction en dollar $" class="form-control" id="amount" name="amount" required style="color: black;">

                              </div>
                            </div>

                            <div class="box-footer">
                                <button type="reset" class="btn btn-danger ms-1">Annuler</button>
                                <button type="submit" class="btn btn-primary ms-1" id="submit_button">Retirer</button>
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

