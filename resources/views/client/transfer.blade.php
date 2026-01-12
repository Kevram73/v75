@extends('layouts.app2')

@section('title', 'V75 Pro - Transfert')

@section('page-title', 'TRANSFERT')
@section('page-subtitle', 'TRANSFÉRER DES FONDS')

@section('content')
<div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
    <div class="lg:col-span-2">
        <div class="bg-white rounded-lg shadow-sm border border-gray-200">
            <div class="border-b-2 border-gray-300 p-4">
                <h3 class="text-sm font-bold text-gray-900 uppercase tracking-tight">
                    <i class="fas fa-paper-plane mr-2"></i>Effectuer un transfert
                </h3>
            </div>
            <div class="p-4 md:p-6">
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
                        <li>• Montant minimum : <strong>$1</strong></li>
                        <li>• Montant maximum : <strong>$100,000</strong></li>
                        <li>• Les transferts sont instantanés et irréversibles</li>
                        <li>• Vérifiez bien l'email du destinataire</li>
                    </ul>
                </div>

                <form method="POST" action="{{ route('client.transfer.process') }}" id="transferForm">
                    @csrf
                    
                    <div class="mb-4">
                        <label for="email" class="block text-xs font-medium text-gray-700 mb-2">Email du destinataire</label>
                        <input type="email" class="w-full px-3 py-2 border-2 border-gray-300 rounded-md text-sm focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-green-500 @error('email') border-red-500 @enderror" 
                               id="email" name="email" 
                               value="{{ old('email') }}" 
                               placeholder="Entrez l'email du destinataire" required>
                        @error('email')
                            <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                        @enderror
                        
                        <!-- User info display -->
                        <div id="user-info" class="mt-2 hidden">
                            <div class="bg-green-50 border-l-4 border-green-500 p-3 rounded-md">
                                <div class="flex items-start">
                                    <i class="fas fa-user-check text-green-600 mr-3 mt-1"></i>
                                    <div class="flex-1">
                                        <div class="flex items-center mb-1">
                                            <strong class="text-sm font-bold text-gray-900" id="user-full-name"></strong>
                                        </div>
                                        <div class="text-xs text-gray-600">
                                            <i class="fas fa-envelope mr-1"></i>
                                            <span id="user-email"></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <small class="text-xs text-gray-500 mt-1">
                            <i class="fas fa-info-circle mr-1"></i>
                            Entrez l'email exact du destinataire - Le nom s'affichera automatiquement
                        </small>
                    </div>

                    <div class="mb-4">
                        <label for="amount" class="block text-xs font-medium text-gray-700 mb-2">Montant du transfert ($)</label>
                        <input type="number" class="w-full px-3 py-2 border-2 border-gray-300 rounded-md text-sm focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-green-500 @error('amount') border-red-500 @enderror" 
                               id="amount" name="amount" value="{{ old('amount') }}" 
                               min="1" max="100000" step="0.01" required>
                        @error('amount')
                            <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                        @enderror
                        <small class="text-xs text-gray-500 mt-1">
                            <i class="fas fa-info-circle mr-1"></i>
                            Montant disponible : ${{ number_format($account->balance ?? 0, 2) }}
                        </small>
                    </div>

                    <div class="mb-4">
                        <label for="description" class="block text-xs font-medium text-gray-700 mb-2">Description (optionnel)</label>
                        <textarea class="w-full px-3 py-2 border-2 border-gray-300 rounded-md text-sm focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-green-500 @error('description') border-red-500 @enderror" 
                                  id="description" name="description" rows="3" 
                                  placeholder="Ajoutez une description pour ce transfert">{{ old('description') }}</textarea>
                        @error('description')
                            <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <div class="flex items-center">
                            <input type="checkbox" id="confirm_transfer" required
                                   class="h-4 w-4 text-green-600 focus:ring-green-500 border-gray-300 rounded">
                            <label for="confirm_transfer" class="ml-2 text-xs text-gray-700">
                                Je confirme que les informations sont correctes et que ce transfert est irréversible
                            </label>
                        </div>
                    </div>

                    <button type="submit" class="w-full bg-green-600 text-white px-4 py-2 rounded-md text-sm font-bold hover:bg-green-700 transition-colors" id="submitBtn">
                        <i class="fas fa-paper-plane mr-2"></i>Effectuer le transfert
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
            <div class="p-4 md:p-6">
                <div class="text-center">
                    <h4 class="text-2xl font-bold text-green-600 mb-1">${{ number_format($account->balance ?? 0, 2) }}</h4>
                    <small class="text-xs text-gray-500">Solde disponible</small>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-lg shadow-sm border border-gray-200">
            <div class="border-b-2 border-gray-300 p-4">
                <h5 class="text-sm font-bold text-gray-900 uppercase tracking-tight">
                    <i class="fas fa-info-circle mr-2"></i>Comment transférer
                </h5>
            </div>
            <div class="p-4 md:p-6 space-y-4">
                <div>
                    <h6 class="text-xs font-bold text-gray-900 mb-1">
                        <i class="fas fa-user mr-2"></i>1. Destinataire
                    </h6>
                    <p class="text-xs text-gray-600">Entrez l'email exact du destinataire.</p>
                </div>
                
                <div>
                    <h6 class="text-xs font-bold text-gray-900 mb-1">
                        <i class="fas fa-dollar-sign mr-2"></i>2. Montant
                    </h6>
                    <p class="text-xs text-gray-600">Spécifiez le montant à transférer (minimum $1).</p>
                </div>
                
                <div>
                    <h6 class="text-xs font-bold text-gray-900 mb-1">
                        <i class="fas fa-check mr-2"></i>3. Confirmation
                    </h6>
                    <p class="text-xs text-gray-600">Vérifiez les informations et confirmez le transfert.</p>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const form = document.getElementById('transferForm');
    const submitBtn = document.getElementById('submitBtn');
    const amountInput = document.getElementById('amount');
    const emailInput = document.getElementById('email');
    const confirmCheckbox = document.getElementById('confirm_transfer');
    const userInfoDiv = document.getElementById('user-info');
    const userFullNameSpan = document.getElementById('user-full-name');
    const userEmailSpan = document.getElementById('user-email');
    
    let searchTimeout;
    let currentUser = null;
    
    // User search function
    function searchUser(email) {
        if (email.length < 3) {
            hideUserInfo();
            return;
        }
        
        fetch(`{{ route('client.api.search-user') }}?email=${encodeURIComponent(email)}`)
            .then(response => response.json())
            .then(data => {
                if (data.user) {
                    showUserInfo(data.user);
                    currentUser = data.user;
                } else {
                    hideUserInfo();
                    currentUser = null;
                }
            })
            .catch(error => {
                console.error('Error searching user:', error);
                hideUserInfo();
                currentUser = null;
            });
    }
    
    function showUserInfo(user) {
        const fullName = `${user.first_name || ''} ${user.last_name || ''}`.trim();
        if (fullName) {
            userFullNameSpan.textContent = fullName;
        } else {
            userFullNameSpan.textContent = 'Utilisateur trouvé';
        }
        userEmailSpan.textContent = user.email;
        userInfoDiv.classList.remove('hidden');
    }
    
    function hideUserInfo() {
        userInfoDiv.classList.add('hidden');
    }
    
    // Debounced search
    emailInput.addEventListener('input', function() {
        const email = this.value.trim();
        
        clearTimeout(searchTimeout);
        
        if (email.length >= 3) {
            searchTimeout = setTimeout(() => {
                searchUser(email);
            }, 300);
        } else {
            hideUserInfo();
            currentUser = null;
        }
        
        validateForm();
    });
    
    // Validation en temps réel
    function validateForm() {
        const amount = parseFloat(amountInput.value) || 0;
        const email = emailInput.value.trim();
        const confirmed = confirmCheckbox.checked;
        const availableBalance = {{ $account->balance ?? 0 }};
        
        if (amount > 0 && amount <= availableBalance && email.length > 0 && confirmed) {
            submitBtn.disabled = false;
            submitBtn.classList.remove('opacity-50', 'cursor-not-allowed');
            submitBtn.classList.add('hover:bg-green-700');
        } else {
            submitBtn.disabled = true;
            submitBtn.classList.add('opacity-50', 'cursor-not-allowed');
            submitBtn.classList.remove('hover:bg-green-700');
        }
    }
    
    // Événements de validation
    amountInput.addEventListener('input', validateForm);
    confirmCheckbox.addEventListener('change', validateForm);
    
    // Validation initiale
    validateForm();
    
    // Confirmation avant soumission
    form.addEventListener('submit', function(e) {
        const amount = parseFloat(amountInput.value);
        const email = emailInput.value.trim();
        
        let confirmMessage = `Êtes-vous sûr de vouloir transférer $${amount.toFixed(2)} vers ${email} ?\n\nCette action est irréversible.`;
        
        if (currentUser) {
            confirmMessage = `Êtes-vous sûr de vouloir transférer $${amount.toFixed(2)} vers ${currentUser.first_name} ${currentUser.last_name} (${currentUser.email}) ?\n\nCette action est irréversible.`;
        }
        
        if (!confirm(confirmMessage)) {
            e.preventDefault();
        }
    });
});
</script>
@endsection
