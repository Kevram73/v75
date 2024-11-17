@extends('layouts.app2')

@section('title', '| V75 pro Client deposits')

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
                            <h4 class="box-title mb-md-0 mb-20 text-info">Liste des retraits clients</h4>

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

                                <tr>
                                <th scope="col">#</th>
                                <th scope="col">Identité du client</th>
                                <th scope="col">Montant</th>
                                <th scope="col">Date et heure</th>
                                <th scope="col">Devise</th>
                                <th scope="col">N° de transaction</th>
                                <th scope="col">Statut</th>
                                </tr>
                            </thead>
                            @foreach ($deposits as $deposit)
                            @php
                                $client = app\Models\Client::find($deposit->sender_id);
                            @endphp
                            <tbody class="text-fade">
                                <tr>
                                <th scope="row"><span style="text-info">{{$loop->index + 1}}</span></th>
                                <td>{{$client->last_name}} {{$client->first_name}}</td>
                                <td>{{$deposit->amount}} $</td>
                                <td>{{$deposit->date_sent->format('d/m/Y à H:i')}}</td>
                                <td>{{$deposit->merchant_trade_no}}</td>
                                <td>{{$deposit->trx_id}}</td>

                                <td><span class="badge badge-sm badge-danger-light">Dépôt</span></td>
                                @if($deposit->status == 'pending')
                                    <td><span class="badge badge-sm badge-warning-light">En attente</span></td>
                                @elseif($deposit->status == 'done')
                                        <td><span class="badge badge-sm badge-success-light">Effectué</span></td>
                                @elseif($deposit->status == 'cancelled')
                                        <td><span class="badge badge-sm badge-success-light">Annulé</span></td>
                                @endif
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

