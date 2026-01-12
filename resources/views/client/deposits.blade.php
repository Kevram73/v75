@extends('layouts.app2')

@section('title', 'V75 Pro - Mes Dépôts')

@section('page-title', 'MES DÉPÔTS')
@section('page-subtitle', 'LISTE DE VOS DÉPÔTS')

@section('content')
<div class="bg-white rounded-lg shadow-sm border border-gray-200">
    <div class="border-b-2 border-gray-300 p-4 flex items-center justify-between">
        <h3 class="text-sm font-bold text-gray-900 uppercase tracking-tight">
            <i class="fas fa-list mr-2"></i>Historique des Dépôts
        </h3>
        <a href="{{ route('client.deposit') }}" class="text-xs font-mono bg-green-600 text-white px-4 py-2 hover:bg-green-700">
            <i class="fas fa-plus mr-2"></i>NOUVEAU DÉPÔT
        </a>
    </div>
    <div class="p-6">
        @if($deposits->count() > 0)
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">#</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Montant</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Méthode</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Statut</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Date</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @foreach ($deposits as $deposit)
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">{{ $loop->index + 1 }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 font-bold">${{ number_format($deposit->amount, 2) }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $deposit->payment_method ?? 'USDT TRC20' }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                    @if($deposit->status == 'pending' || $deposit->status == 'PENDING')
                                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-yellow-100 text-yellow-800">En attente</span>
                                    @elseif($deposit->status == 'completed' || $deposit->status == 'COMPLETED')
                                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">Effectué</span>
                                    @elseif($deposit->status == 'cancelled' || $deposit->status == 'CANCELLED')
                                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-red-100 text-red-800">Annulé</span>
                                    @else
                                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-gray-100 text-gray-800">{{ $deposit->status }}</span>
                                    @endif
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $deposit->created_at->format('d/m/Y H:i') }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                    <a href="{{ route('client.transactions.show', $deposit->id) }}" class="text-green-600 hover:text-green-900">
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
                {{ $deposits->links() }}
            </div>
        @else
            <div class="text-center py-12">
                <i class="fas fa-arrow-down text-4xl text-gray-400 mb-4"></i>
                <h5 class="text-sm font-bold text-gray-900 mb-2">Aucun dépôt</h5>
                <p class="text-xs text-gray-500 mb-4">Vous n'avez pas encore effectué de dépôt.</p>
                <a href="{{ route('client.deposit') }}" class="inline-block bg-green-600 text-white px-6 py-2 rounded-md text-xs font-bold hover:bg-green-700">
                    <i class="fas fa-plus mr-2"></i>Faire un Dépôt
                </a>
            </div>
        @endif
    </div>
</div>
@endsection
