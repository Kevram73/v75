@extends('layouts.app2')

@section('title', '| V75 Dashboard')

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
                            <h4 class="box-title mb-md-0 mb-20 text-info">Transactions</h4>
                            <a href="{{route('client.invest_withdrawal')}}" class="btn btn-info"><i class="fa fa-download me-10"></i>Faire un retrait</a>
                        </div>
                    </div>
                </div>
                </div>
                <div class="col-12">
                <div class="box">
                    <div class="box-body">
                        <div class="table-responsive">
                        <table class="table mb-0">
                            <thead class="thead-light">
                                @php
                                    $nb = 0;
                                @endphp
                                <tr>
                                <th scope="col">#</th>
                                <th scope="col">Montant</th>
                                <th scope="col">Numéro de compte</th>
                                <th scope="col">Date</th>
                                <th scope="col">Identité du client</th>
                                <th scope="col">Nature de la transaction</th>
                                </tr>
                            </thead>
                            @foreach ($withdrawals as $withdrawal)
                                @php
                                    $client = app\Models\Client::find($withdrawal->receiver_id);
                                @endphp
                            <tbody class="text-fade">
                                <tr>
                                <th scope="row">TRANSACT.<span style="text-info">{{$nb+1}}</span></th>
                                <td>{{$withdrawal->amount}} $</td>
                                <td>{{$account->account_num}}</td>
                                <td>{{$withdrawal->created_at->format('d/m/Y à H:i')}}</td>
                                <td>{{$client->last_name}} {{$client->first_name}}</td>
                                <td><span class="badge badge-sm badge-success-light">Retrait</span></td>
                                </tr>

                            </tbody>
                            @endforeach

                            </table>
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

