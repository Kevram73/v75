@extends('layouts.app2')

@section('title', 'V75 Pro - Dépôt')

@section('page-title', 'DÉPÔT')
@section('page-subtitle', 'FAIRE UN DÉPÔT')

@section('content')
<div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
    <div class="lg:col-span-2">
        <div class="bg-white rounded-lg shadow-sm border border-gray-200">
            <div class="border-b-2 border-gray-300 p-4">
                <h3 class="text-sm font-bold text-gray-900 uppercase tracking-tight">
                    <i class="fas fa-plus-circle mr-2"></i>Effectuer un dépôt
                </h3>
            </div>
            <div class="p-6">
                @if(session('success'))
                    <div class="mb-4 bg-green-50 border-l-4 border-green-600 p-3 border border-green-200">
                        <div class="flex items-center">
                            <span class="text-green-600 mr-2 font-mono">[OK]</span>
                            <p class="text-xs font-medium text-gray-900">{{ session('success') }}</p>
                        </div>
                    </div>
                @endif

                @if(session('error'))
                    <div class="mb-4 bg-red-50 border-l-4 border-red-600 p-3 border border-red-200">
                        <div class="flex items-center">
                            <span class="text-red-600 mr-2 font-mono">[ERR]</span>
                            <p class="text-xs font-medium text-gray-900">{{ session('error') }}</p>
                        </div>
                    </div>
                @endif

                <div class="mb-6 bg-blue-50 border-l-4 border-blue-400 p-4">
                    <h6 class="text-sm font-bold text-gray-900 mb-2">
                        <i class="fas fa-info-circle mr-2"></i>Informations importantes
                    </h6>
                    <ul class="text-xs text-gray-700 space-y-1">
                        <li>• Minimum de dépôt : <strong>10$</strong></li>
                        <li>• Maximum de dépôt : <strong>10,000$</strong></li>
                        <li>• Votre dépôt sera validé par l'administrateur</li>
                        <li>• Les fonds seront ajoutés à votre portefeuille une fois validés</li>
                    </ul>
                </div>

                <form method="POST" action="{{ route('client.deposit.store') }}" enctype="multipart/form-data" id="depositForm">
                    @csrf
                    
                    <div class="mb-4">
                        <label class="block text-xs font-medium text-gray-700 mb-2">Type de dépôt</label>
                        <div class="grid grid-cols-2 gap-4">
                            <div class="border-2 border-gray-300 rounded-lg p-4 cursor-pointer hover:border-green-500 transition-colors" onclick="selectDepositType('AUTOMATIC')">
                                <input type="radio" name="deposit_type" id="automatic" value="AUTOMATIC" class="hidden" onchange="toggleDepositType()">
                                <label for="automatic" class="cursor-pointer">
                                    <div class="flex items-center mb-2">
                                        <div class="w-4 h-4 border-2 border-gray-400 rounded-full mr-2 deposit-radio"></div>
                                        <strong class="text-sm">Dépôt Automatique</strong>
                                    </div>
                                    <small class="text-xs text-gray-500">Validation automatique par le système</small>
                                </label>
                            </div>
                            <div class="border-2 border-gray-300 rounded-lg p-4 cursor-pointer hover:border-green-500 transition-colors active" onclick="selectDepositType('MANUAL')">
                                <input type="radio" name="deposit_type" id="manual" value="MANUAL" checked class="hidden" onchange="toggleDepositType()">
                                <label for="manual" class="cursor-pointer">
                                    <div class="flex items-center mb-2">
                                        <div class="w-4 h-4 border-2 border-gray-400 rounded-full mr-2 deposit-radio"></div>
                                        <strong class="text-sm">Dépôt Manuel</strong>
                                    </div>
                                    <small class="text-xs text-gray-500">Validation par l'administrateur</small>
                                </label>
                            </div>
                        </div>
                    </div>

                    <div class="mb-4">
                        <label for="amount" class="block text-xs font-medium text-gray-700 mb-2">Montant du dépôt ($)</label>
                        <input type="number" class="w-full px-3 py-2 border-2 border-gray-300 rounded-md text-sm focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-green-500 @error('amount') border-red-500 @enderror" 
                               id="amount" name="amount" value="{{ old('amount', '10') }}" 
                               min="10" max="10000" step="0.01" required>
                        @error('amount')
                            <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                        @enderror
                        <small class="text-xs text-gray-500 mt-1">
                            <i class="fas fa-info-circle mr-1"></i>
                            Montant minimum: $10, Maximum: $10,000
                        </small>
                    </div>

                    <div class="mb-4">
                        <label for="payment_method" class="block text-xs font-medium text-gray-700 mb-2">Cryptomonnaie</label>
                        <select class="w-full px-3 py-2 border-2 border-gray-300 rounded-md text-sm focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-green-500 @error('payment_method') border-red-500 @enderror" 
                                id="payment_method" name="payment_method" required onchange="updateDepositInfo()">
                            <option value="">Sélectionnez une cryptomonnaie</option>
                            <option value="usdttrc20" {{ old('payment_method', 'usdttrc20') == 'usdttrc20' ? 'selected' : '' }}>
                                USDT TRC20
                            </option>
                        </select>
                        @error('payment_method')
                            <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Informations de dépôt automatique -->
                    <div id="automaticInfo" class="mb-4 hidden">
                        <div class="bg-blue-50 border-l-4 border-blue-400 p-4">
                            <h6 class="text-sm font-bold text-gray-900 mb-2">
                                <i class="fas fa-info-circle mr-2"></i>Dépôt Automatique
                            </h6>
                            <p class="text-xs text-gray-700">
                                Vous serez redirigé vers NowPayments.io pour effectuer votre paiement en cryptomonnaie. 
                                Le dépôt sera automatiquement validé une fois le paiement confirmé.
                            </p>
                        </div>
                    </div>

                    <!-- Informations de dépôt manuel -->
                    <div id="depositInfo" class="mb-4 hidden">
                        <div class="bg-white border-2 border-gray-300 rounded-lg p-4">
                            <h6 class="text-sm font-bold text-gray-900 mb-4">Informations de dépôt manuel</h6>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                <div>
                                    <label class="block text-xs font-medium text-gray-700 mb-2">Adresse de dépôt</label>
                                    <div class="flex">
                                        <input type="text" class="flex-1 px-3 py-2 border-2 border-gray-300 rounded-l-md text-xs font-mono focus:outline-none" id="depositAddress" readonly>
                                        <button type="button" class="px-3 py-2 bg-gray-800 text-white rounded-r-md hover:bg-gray-900" onclick="copyToClipboard('depositAddress')">
                                            <i class="fas fa-copy"></i>
                                        </button>
                                    </div>
                                </div>
                                <div>
                                    <label class="block text-xs font-medium text-gray-700 mb-2">QR Code</label>
                                    <div class="border-2 border-gray-300 rounded-lg p-4 flex items-center justify-center" id="qrCode" style="min-height: 150px;">
                                        <p class="text-xs text-gray-500">Sélectionnez une méthode de paiement</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="mb-4">
                        <label for="transaction_hash" class="block text-xs font-medium text-gray-700 mb-2">Hash de la transaction</label>
                        <input type="text" class="w-full px-3 py-2 border-2 border-gray-300 rounded-md text-sm font-mono focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-green-500 @error('transaction_hash') border-red-500 @enderror" 
                               id="transaction_hash" name="transaction_hash" value="{{ old('transaction_hash') }}" 
                               placeholder="Entrez le hash de votre transaction">
                        @error('transaction_hash')
                            <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                        @enderror
                        <small class="text-xs text-gray-500 mt-1">
                            <i class="fas fa-info-circle mr-1"></i>
                            Copiez le hash de la transaction depuis votre wallet
                        </small>
                    </div>

                    <!-- Capture d'écran (optionnelle pour le dépôt manuel) -->
                    <div id="screenshotSection" class="mb-4">
                        <label for="screenshot" class="block text-xs font-medium text-gray-700 mb-2">
                            <i class="fas fa-camera mr-2"></i>Capture d'écran (optionnel)
                        </label>
                        <div class="relative">
                            <input type="file" class="w-full px-3 py-2 border-2 border-gray-300 rounded-md text-sm focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-green-500 @error('screenshot') border-red-500 @enderror" 
                                   id="screenshot" name="screenshot" accept="image/*">
                            @error('screenshot')
                                <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                        <small class="text-xs text-gray-500 mt-1">
                            <i class="fas fa-info-circle mr-1"></i>
                            Formats acceptés : JPG, PNG, GIF (max 5MB)
                        </small>
                    </div>

                    <button type="submit" class="w-full bg-green-600 text-white px-4 py-2 rounded-md text-sm font-bold hover:bg-green-700 transition-colors">
                        <i class="fas fa-paper-plane mr-2"></i>Soumettre le dépôt
                    </button>
                </form>
            </div>
        </div>
    </div>

    <div class="space-y-6">
        <div class="bg-white rounded-lg shadow-sm border border-gray-200">
            <div class="border-b-2 border-gray-300 p-4">
                <h5 class="text-sm font-bold text-gray-900 uppercase tracking-tight">
                    <i class="fas fa-wallet mr-2"></i>Votre portefeuille
                </h5>
            </div>
            <div class="p-6">
                <div class="grid grid-cols-2 gap-4 text-center">
                    <div class="border-r-2 border-gray-300">
                        <h4 class="text-xl font-bold text-green-600 mb-1">${{ number_format($account->balance ?? 0, 2) }}</h4>
                        <small class="text-xs text-gray-500">Solde actuel</small>
                    </div>
                    <div>
                        <h4 class="text-xl font-bold text-blue-600 mb-1">${{ number_format($account->total_deposited ?? 0, 2) }}</h4>
                        <small class="text-xs text-gray-500">Total déposé</small>
                    </div>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-lg shadow-sm border border-gray-200">
            <div class="border-b-2 border-gray-300 p-4">
                <h5 class="text-sm font-bold text-gray-900 uppercase tracking-tight">
                    <i class="fas fa-info-circle mr-2"></i>Types de dépôt
                </h5>
            </div>
            <div class="p-6 space-y-4">
                <div>
                    <h6 class="text-xs font-bold text-gray-900 mb-1">
                        <i class="fas fa-robot mr-2"></i>Dépôt Automatique
                    </h6>
                    <p class="text-xs text-gray-600">Le système valide automatiquement votre dépôt après vérification de la blockchain.</p>
                </div>
                
                <div>
                    <h6 class="text-xs font-bold text-gray-900 mb-1">
                        <i class="fas fa-user-check mr-2"></i>Dépôt Manuel
                    </h6>
                    <p class="text-xs text-gray-600">Un administrateur valide manuellement votre dépôt. Plus sécurisé mais plus lent.</p>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
// Adresses de dépôt
const depositAddresses = {
    'usdttrc20': '{{ config("app.usdt_account", "TSxu5NpBKAsEWipRuxgJwsRLUbG78G9Nf3") }}',
};

// Fonction pour générer un QR code simple (utiliser une librairie QR code en production)
function generateQRCode(text, size = 200) {
    // Pour l'instant, on affiche juste l'adresse
    // En production, utiliser une vraie librairie QR code comme qrcode.js
    return `https://api.qrserver.com/v1/create-qr-code/?size=${size}x${size}&data=${encodeURIComponent(text)}`;
}

function selectDepositType(type) {
    document.getElementById(type === 'AUTOMATIC' ? 'automatic' : 'manual').checked = true;
    toggleDepositType();
    
    // Mise à jour visuelle
    document.querySelectorAll('.deposit-radio').forEach(radio => {
        radio.classList.remove('bg-green-600', 'border-green-600');
        radio.classList.add('border-gray-400');
    });
    
    const selectedRadio = event.currentTarget.querySelector('.deposit-radio');
    selectedRadio.classList.add('bg-green-600', 'border-green-600');
    selectedRadio.classList.remove('border-gray-400');
}

function toggleDepositType() {
    const manualDeposit = document.getElementById('manual').checked;
    const automaticDeposit = document.getElementById('automatic').checked;
    const depositInfo = document.getElementById('depositInfo');
    const automaticInfo = document.getElementById('automaticInfo');
    const screenshotSection = document.getElementById('screenshotSection');
    const transactionHashField = document.getElementById('transaction_hash');
    
    if (manualDeposit) {
        depositInfo.classList.remove('hidden');
        automaticInfo.classList.add('hidden');
        screenshotSection.classList.remove('hidden');
        transactionHashField.required = true;
        updateDepositInfo();
    } else if (automaticDeposit) {
        depositInfo.classList.add('hidden');
        automaticInfo.classList.remove('hidden');
        screenshotSection.classList.remove('hidden');
        transactionHashField.required = false;
    } else {
        depositInfo.classList.add('hidden');
        automaticInfo.classList.add('hidden');
        screenshotSection.classList.remove('hidden');
        transactionHashField.required = false;
    }
}

function updateDepositInfo() {
    const paymentMethod = document.getElementById('payment_method').value;
    const depositAddress = document.getElementById('depositAddress');
    const qrCode = document.getElementById('qrCode');
    
    if (paymentMethod && depositAddresses[paymentMethod]) {
        const address = depositAddresses[paymentMethod];
        
        if (depositAddress) {
            depositAddress.value = address;
        }
        
        // Générer le QR code
        const qrCodeUrl = generateQRCode(address);
        if (qrCode) {
            qrCode.innerHTML = `
                <div class="text-center">
                    <img src="${qrCodeUrl}" alt="QR Code" class="mx-auto border-2 border-gray-300 rounded-lg shadow-sm" style="max-width: 150px;">
                    <p class="text-xs text-gray-500 mt-2">Scannez pour copier l'adresse</p>
                </div>
            `;
        }
    } else {
        if (depositAddress) {
            depositAddress.value = '';
        }
        if (qrCode) {
            qrCode.innerHTML = '<p class="text-xs text-gray-500">Sélectionnez une méthode de paiement</p>';
        }
    }
}

function copyToClipboard(elementId) {
    const element = document.getElementById(elementId);
    element.select();
    document.execCommand('copy');
    
    const button = event.target.closest('button');
    const originalHTML = button.innerHTML;
    button.innerHTML = '<i class="fas fa-check"></i>';
    button.classList.remove('bg-gray-800', 'hover:bg-gray-900');
    button.classList.add('bg-green-600');
    
    setTimeout(() => {
        button.innerHTML = originalHTML;
        button.classList.remove('bg-green-600');
        button.classList.add('bg-gray-800', 'hover:bg-gray-900');
    }, 2000);
}

// Initialiser l'affichage
document.addEventListener('DOMContentLoaded', function() {
    toggleDepositType();
    
    const paymentMethod = document.getElementById('payment_method');
    if (paymentMethod && paymentMethod.value) {
        updateDepositInfo();
    }
    
    if (paymentMethod) {
        paymentMethod.addEventListener('change', updateDepositInfo);
    }
});
</script>
@endsection
