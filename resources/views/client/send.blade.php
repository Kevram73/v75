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
                          <button class="btn btn-xs btn-info">Dépôt d'argent</button>
                        </div>
                      </div>

                      <div class="box-body">
                        <p class="text-gray-600">Veuillez renseigner votre numero/adresse de compte et le montant de la transaction !</p>
                      </div>
                    </div>
                </div>

            <div class="col-12">


                    <div class="box">
                        <div class="box-header with-border">
                          <h4 class="box-title text-info">Faire un dépôt</h4>
                        @if (Session::has('error'))
                            <span style="color: red;">{{ Session::get('error') }}</span>
                        @endif
                        @if (Session::has('success'))
                            <span style="color: green;">{{ Session::get('success') }}</span>
                        @endif
                        </div>
                        <!-- /.box-header -->
                        <!-- form start -->
                        <form class="form-horizontal form-element" action="{{ route('send_money') }}" method="post">
                            @csrf
                            <div class="box-body">
                                <input type="hidden" value="TSxu5NpBKAsEWipRuxgJwsRLUbG78G9Nf3" name="address"/>
                                <input type="hidden" value="195" name="coin"/>

                                <div class="form-group row">
                                    <label for="currency" class="col-sm-2 form-label">Devise :</label>
                                    <div class="col-sm-10">
                                        <select name="currency" id="currency" class="form-control">
                                            <option value="USDT">USDT</option>
                                            <option value="BTC">BTC</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="amount" class="col-sm-2 form-label">Montant :</label>
                                    <div class="col-sm-10">
                                        <input type="number" min="10" placeholder="Montant de la transaction en dollar $" class="form-control" id="amount" name="amount" required style="color: black;">
                                    </div>
                                </div>

                                <div class="box-footer">
                                    <button type="reset" class="btn btn-danger ms-1">Annuler</button>
                                    <button type="submit" class="btn btn-info ms-1" id="submit_button">Investir</button>
                                </div>
                            </div>
                        </form>

                    </div>

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

