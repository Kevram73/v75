@extends('layouts.app2')

@section('title', 'V75 Pro - Mes Investissements')

@section('page-title', 'MES INVESTISSEMENTS')
@section('page-subtitle', 'LISTE DE VOS INVESTISSEMENTS')

@section('content')
<div class="bg-white rounded-lg shadow-sm border border-gray-200">
    <div class="border-b-2 border-gray-300 p-4 flex items-center justify-between">
        <h3 class="text-sm font-bold text-gray-900 uppercase tracking-tight">
            <i class="fas fa-list mr-2"></i>Historique des Investissements
        </h3>
        <a href="{{ route('client.investments.create') }}" class="text-xs font-mono bg-green-600 text-white px-4 py-2 hover:bg-green-700">
            <i class="fas fa-plus mr-2"></i>NOUVEL INVESTISSEMENT
        </a>
    </div>
    <div class="p-6">
        @if($investments->count() > 0)
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">#</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Montant</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Profit Quotidien</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Durée</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Progression</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Statut</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Date de début</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @foreach ($investments as $investment)
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">{{ $loop->index + 1 }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 font-bold">${{ number_format($investment->amount, 2) }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-green-600 font-bold">${{ number_format($investment->daily_profit, 2) }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                    {{ $investment->days_elapsed ?? 0 }}/{{ $investment->duration ?? 0 }} jours
                                    <br>
                                    <small class="text-xs text-gray-400">Fin: {{ $investment->end_date ? $investment->end_date->format('d/m/Y') : 'N/A' }}</small>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    @php
                                        $progress = $investment->duration > 0 ? (($investment->days_elapsed ?? 0) / $investment->duration) * 100 : 0;
                                    @endphp
                                    <div class="w-full bg-gray-200 rounded-full h-2">
                                        <div class="bg-green-600 h-2 rounded-full" style="width: {{ min($progress, 100) }}%"></div>
                                    </div>
                                    <span class="text-xs text-gray-500 mt-1">{{ number_format($progress, 1) }}%</span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                    @if($investment->status == 'active')
                                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                                            <i class="fas fa-play mr-1"></i>Actif
                                        </span>
                                    @elseif($investment->status == 'completed')
                                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-blue-100 text-blue-800">
                                            <i class="fas fa-check mr-1"></i>Terminé
                                        </span>
                                    @else
                                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-gray-100 text-gray-800">
                                            {{ $investment->status }}
                                        </span>
                                    @endif
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                    {{ $investment->start_date ? $investment->start_date->format('d/m/Y') : 'N/A' }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                    <a href="{{ route('client.investments.show', $investment->id) }}" class="text-green-600 hover:text-green-900 mr-3">
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
                {{ $investments->links() }}
            </div>
        @else
            <div class="text-center py-12">
                <i class="fas fa-chart-line text-4xl text-gray-400 mb-4"></i>
                <h5 class="text-sm font-bold text-gray-900 mb-2">Aucun investissement</h5>
                <p class="text-xs text-gray-500 mb-4">Commencez à investir pour voir vos investissements ici.</p>
                <a href="{{ route('client.investments.create') }}" class="inline-block bg-green-600 text-white px-6 py-2 rounded-md text-xs font-bold hover:bg-green-700">
                    <i class="fas fa-plus mr-2"></i>Investir Maintenant
                </a>
            </div>
        @endif
    </div>
</div>
@endsection
