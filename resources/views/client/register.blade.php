<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>V75 Pro Client - Inscription</title>
    
    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
    
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    
    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=JetBrains+Mono:wght@400;500;600;700&family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    
    <style>
        * {
            font-family: 'Inter', 'JetBrains Mono', monospace;
        }
        body {
            font-size: 13px;
        }
        code, .mono {
            font-family: 'JetBrains Mono', monospace;
            font-size: 12px;
        }
    </style>
</head>
<body class="bg-gray-50">
    <div class="min-h-screen flex items-center justify-center py-12 px-4 sm:px-6 lg:px-8">
        <div class="max-w-md w-full space-y-8 p-10 bg-white rounded-lg shadow-lg border border-gray-200">
            <div>
                <div class="flex justify-center">
                    <div class="w-16 h-16 bg-gray-800 border-2 border-gray-900 flex items-center justify-center">
                        <i class="fas fa-chart-line text-gray-300 text-2xl"></i>
                    </div>
                </div>
                <h2 class="mt-6 text-center text-3xl font-extrabold text-gray-900">
                    Créer un compte
                </h2>
                <p class="mt-2 text-center text-sm text-gray-600">
                    Créez votre compte V75 Pro pour commencer à percevoir vos gains !
                </p>
            </div>
            <form class="mt-8 space-y-6" action="{{ route('client.auth_register') }}" method="POST">
                @csrf
                <div class="rounded-md shadow-sm -space-y-px">
                    <div>
                        <label for="last_name" class="sr-only">Nom</label>
                        <input id="last_name" name="last_name" type="text" autocomplete="family-name" required
                               class="appearance-none rounded-none relative block w-full px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 rounded-t-md focus:outline-none focus:ring-green-500 focus:border-green-500 focus:z-10 sm:text-sm"
                               placeholder="Nom" value="{{ old('last_name') }}">
                    </div>
                    <div>
                        <label for="first_name" class="sr-only">Prénom(s)</label>
                        <input id="first_name" name="first_name" type="text" autocomplete="given-name" required
                               class="appearance-none rounded-none relative block w-full px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 focus:outline-none focus:ring-green-500 focus:border-green-500 focus:z-10 sm:text-sm"
                               placeholder="Prénom(s)" value="{{ old('first_name') }}">
                    </div>
                    <div>
                        <label for="email-address" class="sr-only">Adresse email</label>
                        <input id="email-address" name="email" type="email" autocomplete="email" required
                               class="appearance-none rounded-none relative block w-full px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 focus:outline-none focus:ring-green-500 focus:border-green-500 focus:z-10 sm:text-sm"
                               placeholder="Adresse email" value="{{ old('email') }}">
                    </div>
                    <div>
                        <label for="phone_number" class="sr-only">Téléphone</label>
                        <input id="phone_number" name="phone_number" type="text" autocomplete="tel" required
                               class="appearance-none rounded-none relative block w-full px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 focus:outline-none focus:ring-green-500 focus:border-green-500 focus:z-10 sm:text-sm"
                               placeholder="Téléphone (exemple: 22866778899)" value="{{ old('phone_number') }}">
                    </div>
                    <div>
                        <label for="fellow" class="sr-only">Code de parrainage</label>
                        <input id="fellow" name="fellow" type="text"
                               class="appearance-none rounded-none relative block w-full px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 focus:outline-none focus:ring-green-500 focus:border-green-500 focus:z-10 sm:text-sm"
                               placeholder="Code de parrainage (optionnel)" value="{{ request('ref', $fellow ?? '') }}">
                    </div>
                    <div>
                        <label for="password" class="sr-only">Mot de passe</label>
                        <input id="password" name="password" type="password" autocomplete="new-password" required
                               class="appearance-none rounded-none relative block w-full px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 focus:outline-none focus:ring-green-500 focus:border-green-500 focus:z-10 sm:text-sm"
                               placeholder="Mot de passe">
                    </div>
                    <div>
                        <label for="password_confirmation" class="sr-only">Confirmez le mot de passe</label>
                        <input id="password_confirmation" name="password_confirmation" type="password" autocomplete="new-password" required
                               class="appearance-none rounded-none relative block w-full px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 rounded-b-md focus:outline-none focus:ring-green-500 focus:border-green-500 focus:z-10 sm:text-sm"
                               placeholder="Confirmez le mot de passe">
                    </div>
                </div>

                @if ($errors->any())
                    <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative" role="alert">
                        <strong class="font-bold">Erreur!</strong>
                        <span class="block sm:inline">{{ $errors->first() }}</span>
                    </div>
                @endif

                <div class="flex items-center">
                    <input id="terms" name="terms" type="checkbox" required
                           class="h-4 w-4 text-green-600 focus:ring-green-500 border-gray-300 rounded">
                    <label for="terms" class="ml-2 block text-sm text-gray-900">
                        J'accepte les <a href="{{ route('policy') }}" class="font-medium text-green-600 hover:text-green-500">conditions d'utilisation</a>
                    </label>
                </div>

                <div>
                    <button type="submit" id="register_btn"
                            class="group relative w-full flex justify-center py-2 px-4 border border-transparent text-sm font-medium rounded-md text-white bg-green-600 hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500">
                        <span class="absolute left-0 inset-y-0 flex items-center pl-3">
                            <i class="fas fa-user-plus h-5 w-5 text-green-500 group-hover:text-green-400"></i>
                        </span>
                        Créer un compte
                    </button>
                </div>
            </form>
            <div class="text-center text-sm text-gray-600">
                Vous avez déjà un compte ?
                <a href="{{ route('client.login') }}" class="font-medium text-green-600 hover:text-green-500">
                    Se connecter
                </a>
            </div>
        </div>
    </div>
</body>
</html>

