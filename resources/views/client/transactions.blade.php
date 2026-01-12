@extends('layouts.app2')

@section('title', 'V75 Pro - Transactions')

@section('page-title', 'TRANSACTIONS')
@section('page-subtitle', 'HISTORIQUE DES TRANSACTIONS')

@section('content')
<!-- Filter Buttons -->
<div class="mb-4 flex flex-wrap gap-2">
    <a href="{{ route('client.transactions') }}" class="px-4 py-2 text-xs font-mono border-2 border-gray-300 rounded-md {{ !request('type') && !request('status') ? 'bg-gray-800 text-white border-gray-800' : 'bg-white text-gray-700 hover:bg-gray-50' }}">
        TOUTES
    </a>
    <a href="{{ route('client.transactions', ['type' => 'DEPOSIT']) }}" class="px-4 py-2 text-xs font-mono border-2 border-gray-300 rounded-md {{ request('type') === 'DEPOSIT' ? 'bg-green-600 text-white border-green-600' : 'bg-white text-gray-700 hover:bg-gray-50' }}">
        DÉPÔTS
    </a>
    <a href="{{ route('client.transactions', ['type' => 'WITHDRAWAL']) }}" class="px-4 py-2 text-xs font-mono border-2 border-gray-300 rounded-md {{ request('type') === 'WITHDRAWAL' ? 'bg-yellow-600 text-white border-yellow-600' : 'bg-white text-gray-700 hover:bg-gray-50' }}">
        RETRAITS
    </a>
    <a href="{{ route('client.transactions', ['type' => 'INVESTMENT']) }}" class="px-4 py-2 text-xs font-mono border-2 border-gray-300 rounded-md {{ request('type') === 'INVESTMENT' ? 'bg-blue-600 text-white border-blue-600' : 'bg-white text-gray-700 hover:bg-gray-50' }}">
        INVESTISSEMENTS
    </a>
    <a href="{{ route('client.transactions', ['status' => 'PENDING']) }}" class="px-4 py-2 text-xs font-mono border-2 border-gray-300 rounded-md {{ request('status') === 'PENDING' ? 'bg-gray-600 text-white border-gray-600' : 'bg-white text-gray-700 hover:bg-gray-50' }}">
        EN ATTENTE
    </a>
</div>

<!-- Transactions Table -->
<div class="bg-white rounded-lg shadow-sm border border-gray-200">
    <div class="border-b-2 border-gray-300 p-4">
        <h3 class="text-sm font-bold text-gray-900 uppercase tracking-tight">
            <i class="fas fa-history mr-2"></i>Historique des Transactions
        </h3>
    </div>
    <div class="p-6">
        @if($transactions->count() > 0)
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Type</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Montant</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Statut</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Description</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Date</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @foreach ($transactions as $transaction)
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full 
                                        @if($transaction->type === 'DEPOSIT') bg-green-100 text-green-800
                                        @elseif($transaction->type === 'WITHDRAWAL') bg-yellow-100 text-yellow-800
                                        @elseif($transaction->type === 'INVESTMENT') bg-blue-100 text-blue-800
                                        @else bg-gray-100 text-gray-800 @endif">
                                        <i class="fas @if($transaction->type === 'DEPOSIT') fa-arrow-down
                                                    @elseif($transaction->type === 'WITHDRAWAL') fa-arrow-up
                                                    @elseif($transaction->type === 'INVESTMENT') fa-chart-line
                                                    @else fa-exchange-alt @endif mr-1"></i>
                                        {{ $transaction->type }}
                                    </span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <strong class="text-sm 
                                        @if($transaction->type === 'DEPOSIT') text-green-600
                                        @elseif($transaction->type === 'WITHDRAWAL') text-yellow-600
                                        @else text-blue-600 @endif">
                                        ${{ number_format($transaction->amount, 2) }}
                                    </strong>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full 
                                        @if($transaction->status === 'COMPLETED') bg-green-100 text-green-800
                                        @elseif($transaction->status === 'PENDING') bg-yellow-100 text-yellow-800
                                        @else bg-red-100 text-red-800 @endif">
                                        {{ $transaction->status }}
                                    </span>
                                </td>
                                <td class="px-6 py-4 text-sm text-gray-500">{{ $transaction->description ?? 'N/A' }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $transaction->created_at->format('d/m/Y H:i') }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                    <a href="{{ route('client.transactions.show', $transaction->id) }}" class="text-green-600 hover:text-green-900">
                                        <i class="fas fa-eye"></i> Voir
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <!-- Pagination -->
            <div class="mt-6 flex justify-center">
                {{ $transactions->links() }}
            </div>
        @else
            <div class="text-center py-12">
                <i class="fas fa-history text-4xl text-gray-400 mb-4"></i>
                <h5 class="text-sm font-bold text-gray-900 mb-2">Aucune transaction trouvée</h5>
                <p class="text-xs text-gray-500 mb-4">Vous n'avez pas encore effectué de transactions.</p>
                <div class="flex justify-center space-x-2">
                    <a href="{{ route('client.deposit') }}" class="inline-block bg-green-600 text-white px-4 py-2 rounded-md text-xs font-bold hover:bg-green-700">
                        <i class="fas fa-plus mr-2"></i>Faire un Dépôt
                    </a>
                    <a href="{{ route('client.investments.create') }}" class="inline-block bg-blue-600 text-white px-4 py-2 rounded-md text-xs font-bold hover:bg-blue-700">
                        <i class="fas fa-chart-line mr-2"></i>Investir
                    </a>
                </div>
            </div>
        @endif
    </div>
</div>
@endsection
