@extends('layouts.app')

@section('title', '| V75 pro Admin Dashboard')

@section('content')

    <div class="content-wrapper">
    <div class="container-full">
      <div class="content-header">
          <div class="d-flex align-items-center">
              <div class="me-auto">
                  <h4 class="page-title">Dashboard</h4>
                  <div class="d-inline-block align-items-center">
                      <nav>
                          <ol class="breadcrumb">
                              <li class="breadcrumb-item"><a href="#"><i class="mdi mdi-home-outline"></i></a></li>
                              <li class="breadcrumb-item" aria-current="page">Gestion des demandes</li>
                              <li class="breadcrumb-item active" aria-current="page">Liste des demandes de retrait</li>
                          </ol>
                      </nav>
                  </div>
              </div>
          </div>
      </div>

      <section class="content">
        <div class="row">
          <div class="col-12">
              <div class="box">
              <div class="box-header with-border">
                <h2 class="box-title text-info" style="font-weight: 500">Liste des demandes de retrait</h2>
              </div>
              <div class="box-body">
                  <div class="table-responsive">
                    <table id="example" class="table text-fade table-bordered table-hover display nowrap margin-top-10 w-p100">
                      <thead>
                          <tr class="text-dark">
                              <th>ID</th>
                              <th>Montant</th>
                              <th>Devise</th>
                              <th>Compte de destination</th>
                              <th>Statut</th>
                              <th>Date de demande</th>
                              <th>Actions</th>
                          </tr>
                      </thead>
                      <tbody>
                        @foreach ($retrieveRequests as $request)
                            <tr>
                                <td class="text-dark">{{ $request->id }}</td>
                                <td>{{ $request->price_amount }}</td>
                                <td>{{ $request->price_currency }}</td>
                                <td>{{ $request->to_account }}</td>
                                <td>{{ $request->status }}</td>
                                <td>{{ $request->created_at->format('d/m/Y') }}</td>
                                <td>
                                    <form action="{{ route('update_request_status', $request->id) }}" method="POST" style="display:inline;">
                                        @csrf
                                        @method('PATCH')
                                        <input type="text" name="status" value="{{ $request->status }}" class="form-control">
                                        <button class="btn btn-info-light ms-1" type="submit" title="Mettre à jour le statut">Modifier le statut</button>
                                    </form>

                                    <form action="{{ route('delete_request', $request->id) }}" method="POST" style="display:inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-danger-light ms-1" type="submit" title="Supprimer la demande">Supprimer</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                      </tbody>
                  </table>
                  </div>
              </div>
              </div>
          </div>
        </div>
      </section>
    </div>
    </div>

@endsection

@push('datatable')
    <script src="{{asset('/assets/vendor_components/datatable/datatables.min.js')}}"></script>
    <script src="{{asset('/src/js/pages/data-table.js')}}"></script>
@endpush
