@extends('layouts.app2')

@section('title', '| V75 pro Dashboard')

@section('content')

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
    <div class="container-full">

        <!-- Main content -->
        <section class="content">
            <div class="row">
                <div class="col-12">
                    <div class="box">
                        <div class="box-body">
                            <div class="d-md-flex d-block align-items-center justify-content-between">
                                <h4 class="box-title mb-md-0 mb-20 text-info">QR dépôt </h4>
                                <a class="btn btn-info"><i class="fa fa-qrcode"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12">
                <div class="box">
                    <div class="box-body">


                        <div class="col-12">

                            <div class="box">
                            <div class="card">
                                <div class="card-header">
                                    {{-- <h5 class="card-title mb-0" style="text-align: center; font-size:14px;">Order: #</h5>
                                    <div class="card-actions float-end">
                                        <div class="">
                                            <a href="#" data-bs-toggle="dropdown" data-bs-display="static"> <i class="align-middle" data-feather="more-horizontal"></i></a>
                                            <div class="dropdown-menu dropdown-menu-end">
                                                <a class="dropdown-item" href="#">Action</a>
                                                <a class="dropdown-item" href="#">Another action</a>
                                                <a class="dropdown-item" href="#">Something else here</a>
                                            </div>
                                        </div>
                                    </div> --}}
                                </div>
                                <div class="card-body">
                                    <div class="row g-0">
                                        <div class="col-sm-3 col-xl-12 col-xxl-3 text-center">
                                            <img src="{{asset('/images/th.jpeg')}}" width="180" height="160" alt="{{ Auth::guard('client')->user()->last_name }} {{ Auth::guard('client')->user()->first_name }}" style="border-radius: 10%; border:1px solid rgba(194, 247, 194, 0.482);">
                                        </div>
                                        <div class="col-sm-9 col-xl-12 col-xxl-9">
                                            <br><center><strong>Order: #</strong></center>
                                            {{-- <p class="text-fade" style="text-align: justify; line-height:25px;"><br> ... </p> --}}
                                        </div>
                                    </div>

                                    <table class="table my-2">
                                        <tbody>
                                            <tr>
                                                <th>Transaction:</th>
                                                <td class="text-primary">10.000.000 USD</td>
                                            </tr>
                                            <tr>
                                                <th>Montant:</th>
                                                <td class="text-primary">10.000.000.000 $</td>
                                            </tr>
                                            <tr>
                                                <th>Adresse de Portefeuille:</th>
                                                @php
                                                    $usdt = Auth::guard('client')->user()->account()->usdt_account;
                                                    $usdt_account = Str::limit($usdt, 15, '...')
                                                @endphp
                                                <td class="text-primary">
                                                    <?php
                                                        echo '<style>';
                                                            echo 'body { text-align: justify; line-height:26px; font-size:14px; color: black; }';
                                                        echo '</style>';
                                                        echo $usdt_account;
                                                    ?>
                                                </td>
                                            </tr>
                                            <tr>
                                                <th>Status:</th>
                                                <td><span class="badge bg-danger-light">En attente</span></td>
                                            </tr>

                                            <tr>
                                                <th>Nº de Compte v75:</th>
                                                <td class="text-fade">{{ Auth::guard('client')->user()->fellow_code }}</td>
                                            </tr>

                                            <tr>
                                            </tr>

                                        </tbody>
                                    </table>

                                </div>
                            </div>
                        </div>

                        </div>
                    </div>
                    </div>
                </div>
                </div>
            </div>
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

