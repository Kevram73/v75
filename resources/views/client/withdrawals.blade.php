@extends('layouts.app2')

@section('title', 'V75 Pro - Mes Retraits')

@section('page-title', 'MES RETRAITS')
@section('page-subtitle', 'LISTE DE VOS RETRAITS')

@section('content')
<div class="bg-white rounded-lg shadow-sm border border-gray-200">
    <div class="border-b-2 border-gray-300 p-4 flex items-center justify-between">
        <h3 class="text-sm font-bold text-gray-900 uppercase tracking-tight">
            <i class="fas fa-list mr-2"></i>Historique des Retraits
        </h3>
        <a href="{{ route('client.withdrawal') }}" class="text-xs font-mono bg-green-600 text-white px-4 py-2 hover:bg-green-700">
            <i class="fas fa-plus mr-2"></i>NOUVEAU RETRAIT
        </a>
    </div>
    <div class="p-6">
        @if($withdrawals->count() > 0)
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">#</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Montant</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Méthode</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Adresse</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Statut</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Date</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @foreach ($withdrawals as $withdrawal)
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">{{ $loop->index + 1 }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 font-bold">${{ number_format($withdrawal->amount, 2) }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $withdrawal->payment_method ?? 'USDT TRC20' }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 font-mono text-xs">{{ Str::limit($withdrawal->reference ?? 'N/A', 20) }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                    @if($withdrawal->status == 'pending' || $withdrawal->status == 'PENDING')
                                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-yellow-100 text-yellow-800">En attente</span>
                                    @elseif($withdrawal->status == 'completed' || $withdrawal->status == 'COMPLETED')
                                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">Effectué</span>
                                    @elseif($withdrawal->status == 'cancelled' || $withdrawal->status == 'CANCELLED')
                                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-red-100 text-red-800">Annulé</span>
                                    @else
                                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-gray-100 text-gray-800">{{ $withdrawal->status }}</span>
                                    @endif
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $withdrawal->created_at->format('d/m/Y H:i') }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                    <a href="{{ route('client.transactions.show', $withdrawal->id) }}" class="text-green-600 hover:text-green-900">
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
                {{ $withdrawals->links() }}
            </div>
        @else
            <div class="text-center py-12">
                <i class="fas fa-arrow-up text-4xl text-gray-400 mb-4"></i>
                <h5 class="text-sm font-bold text-gray-900 mb-2">Aucun retrait</h5>
                <p class="text-xs text-gray-500 mb-4">Vous n'avez pas encore effectué de retrait.</p>
                <a href="{{ route('client.withdrawal') }}" class="inline-block bg-green-600 text-white px-6 py-2 rounded-md text-xs font-bold hover:bg-green-700">
                    <i class="fas fa-plus mr-2"></i>Faire un Retrait
                </a>
            </div>
        @endif
    </div>
</div>
@endsection
