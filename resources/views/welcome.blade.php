<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>V75 Pro - Investissement Intelligent</title>
    <link rel="icon" href="{{asset('/images/V75.png')}}" style="border-radius: 100%;">
    
    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    
    <!-- Google Fonts -->
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
        .plan-card {
            transition: all 0.3s ease;
        }
        .plan-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 25px rgba(0,0,0,0.15);
        }
        .feature-card {
            transition: all 0.3s ease;
        }
        .feature-card:hover {
            transform: translateY(-3px);
        }
    </style>
</head>
<body class="bg-gray-50">
    <!-- Navigation -->
    <nav class="bg-white border-b-2 border-gray-300 sticky top-0 z-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center h-16">
                <div class="flex items-center">
                    <img src="{{asset('/images/V75.png')}}" alt="V75 Pro" class="h-10 w-10 rounded-full">
                    <span class="ml-3 text-sm font-bold text-gray-900 uppercase tracking-tight">V75 Pro</span>
                </div>
                <div class="hidden md:flex items-center space-x-6">
                    <a href="#features" class="text-xs font-mono text-gray-700 hover:text-gray-900">FONCTIONNALITÉS</a>
                    <a href="#plans" class="text-xs font-mono text-gray-700 hover:text-gray-900">PLANS</a>
                    <a href="#commissions" class="text-xs font-mono text-gray-700 hover:text-gray-900">COMMISSIONS</a>
                    <a href="#advantages" class="text-xs font-mono text-gray-700 hover:text-gray-900">AVANTAGES</a>
                </div>
                <div class="flex items-center space-x-4">
                    <a href="{{ route('client.login') }}" class="text-xs font-mono text-gray-700 hover:text-gray-900">CONNEXION</a>
                    <a href="{{ route('client.register') }}" class="text-xs font-mono bg-gray-800 text-white px-4 py-2 hover:bg-gray-900">
                        CRÉER UN COMPTE
                    </a>
                </div>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <section class="bg-gradient-to-br from-green-600 to-green-800 text-white py-20">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <h1 class="text-5xl font-bold mb-4 uppercase tracking-tight">
                <i class="fas fa-chart-line mr-3"></i>V75 Pro
            </h1>
            <p class="text-lg text-green-100 mb-8 max-w-3xl mx-auto">
                V75 Pro est une plateforme d'investissement innovante qui vous permet de gagner 1,5% par jour sur vos investissements. 
                Dépôt et retrait instantané via USDT TRC20. Avec V75 Pro, c'est votre argent qui travaille pour vous !
            </p>
            <div class="bg-white bg-opacity-20 rounded-lg p-6 max-w-2xl mx-auto mb-8">
                <h3 class="text-lg font-bold mb-4"><i class="fas fa-info-circle mr-2"></i>Conditions d'investissement</h3>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-4 text-left">
                    <div>
                        <p class="text-sm font-semibold">Minimum d'investissement</p>
                        <p class="text-lg font-bold">10$</p>
                    </div>
                    <div>
                        <p class="text-sm font-semibold">Dépôts acceptés</p>
                        <p class="text-lg font-bold">USDT TRC20</p>
                    </div>
                    <div>
                        <p class="text-sm font-semibold">Retraits</p>
                        <p class="text-lg font-bold">USDT TRC20</p>
                    </div>
                </div>
            </div>
            <div class="flex justify-center space-x-4">
                <a href="{{ route('client.register') }}" class="bg-white text-green-700 px-8 py-3 rounded-lg font-bold hover:bg-gray-100 transition-colors">
                    <i class="fas fa-rocket mr-2"></i>COMMENCER MAINTENANT
                </a>
                <a href="#plans" class="bg-transparent border-2 border-white text-white px-8 py-3 rounded-lg font-bold hover:bg-white hover:text-green-700 transition-colors">
                    <i class="fas fa-info-circle mr-2"></i>EN SAVOIR PLUS
                </a>
            </div>
        </div>
    </section>

    <!-- Caractéristiques Clés -->
    <section id="features" class="py-16 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-12">
                <h2 class="text-3xl font-bold text-gray-900 mb-4 uppercase tracking-tight">Caractéristiques Clés</h2>
                <p class="text-gray-600 max-w-2xl mx-auto">Découvrez les avantages de notre plateforme d'investissement</p>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <div class="feature-card bg-white border-2 border-gray-200 rounded-lg p-8 text-center">
                    <div class="w-16 h-16 bg-green-100 rounded-full flex items-center justify-center mx-auto mb-4">
                        <i class="fas fa-chart-line text-green-600 text-2xl"></i>
                    </div>
                    <h3 class="text-lg font-bold text-gray-900 mb-3">Rendements Élevés</h3>
                    <p class="text-gray-600 text-sm">
                        Gagnez 1,5% par jour sur vos investissements. Un système de profit quotidien qui fait fructifier votre capital de manière régulière.
                    </p>
                </div>
                
                <div class="feature-card bg-white border-2 border-gray-200 rounded-lg p-8 text-center">
                    <div class="w-16 h-16 bg-green-100 rounded-full flex items-center justify-center mx-auto mb-4">
                        <i class="fas fa-shield-alt text-green-600 text-2xl"></i>
                    </div>
                    <h3 class="text-lg font-bold text-gray-900 mb-3">Sécurité Maximale</h3>
                    <p class="text-gray-600 text-sm">
                        Vos fonds sont sécurisés avec des protocoles de sécurité avancés. Transactions cryptées et système de protection des données.
                    </p>
                </div>
                
                <div class="feature-card bg-white border-2 border-gray-200 rounded-lg p-8 text-center">
                    <div class="w-16 h-16 bg-green-100 rounded-full flex items-center justify-center mx-auto mb-4">
                        <i class="fas fa-bolt text-green-600 text-2xl"></i>
                    </div>
                    <h3 class="text-lg font-bold text-gray-900 mb-3">Transactions Instantanées</h3>
                    <p class="text-gray-600 text-sm">
                        Dépôts et retraits rapides via USDT TRC20. Pas d'attente, vos transactions sont traitées instantanément.
                    </p>
                </div>
            </div>
        </div>
    </section>

    <!-- Avantages -->
    <section id="advantages" class="py-16 bg-gray-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-12">
                <h2 class="text-3xl font-bold text-gray-900 mb-4 uppercase tracking-tight">Avantages</h2>
                <p class="text-gray-600 max-w-2xl mx-auto">Pourquoi choisir V75 Pro ?</p>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div class="bg-white border-2 border-gray-200 rounded-lg p-6 flex items-start">
                    <div class="w-12 h-12 bg-green-100 rounded-full flex items-center justify-center mr-4 flex-shrink-0">
                        <i class="fas fa-dollar-sign text-green-600 text-xl"></i>
                    </div>
                    <div>
                        <h4 class="text-lg font-bold text-gray-900 mb-2">Profit Quotidien Garanti</h4>
                        <p class="text-gray-600 text-sm">
                            Recevez 1,5% de profit chaque jour sur votre investissement. Un système transparent et régulier pour faire croître votre capital.
                        </p>
                    </div>
                </div>
                
                <div class="bg-white border-2 border-gray-200 rounded-lg p-6 flex items-start">
                    <div class="w-12 h-12 bg-green-100 rounded-full flex items-center justify-center mr-4 flex-shrink-0">
                        <i class="fas fa-users text-green-600 text-xl"></i>
                    </div>
                    <div>
                        <h4 class="text-lg font-bold text-gray-900 mb-2">Programme de Parrainage</h4>
                        <p class="text-gray-600 text-sm">
                            Gagnez jusqu'à 8% de commission sur les investissements de vos filleuls. Un système multi-niveaux rémunérateur.
                        </p>
                    </div>
                </div>
                
                <div class="bg-white border-2 border-gray-200 rounded-lg p-6 flex items-start">
                    <div class="w-12 h-12 bg-green-100 rounded-full flex items-center justify-center mr-4 flex-shrink-0">
                        <i class="fas fa-lock text-green-600 text-xl"></i>
                    </div>
                    <div>
                        <h4 class="text-lg font-bold text-gray-900 mb-2">Sécurité des Fonds</h4>
                        <p class="text-gray-600 text-sm">
                            Vos investissements sont protégés. Système de sécurité avancé et suivi en temps réel de vos transactions.
                        </p>
                    </div>
                </div>
                
                <div class="bg-white border-2 border-gray-200 rounded-lg p-6 flex items-start">
                    <div class="w-12 h-12 bg-green-100 rounded-full flex items-center justify-center mr-4 flex-shrink-0">
                        <i class="fas fa-mobile-alt text-green-600 text-xl"></i>
                    </div>
                    <div>
                        <h4 class="text-lg font-bold text-gray-900 mb-2">Interface Moderne</h4>
                        <p class="text-gray-600 text-sm">
                            Une plateforme intuitive et facile à utiliser. Gérez vos investissements depuis n'importe où, à tout moment.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Plans d'Investissement -->
    <section id="plans" class="py-16 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-12">
                <h2 class="text-3xl font-bold text-gray-900 mb-4 uppercase tracking-tight">Plans d'Investissement</h2>
                <p class="text-gray-600 max-w-2xl mx-auto">Choisissez le plan qui correspond à vos objectifs financiers</p>
            </div>
            
            <div class="bg-green-50 border-2 border-green-200 rounded-lg p-6 mb-8">
                <h3 class="text-xl font-bold text-gray-900 mb-4 text-center">
                    <i class="fas fa-info-circle text-green-600 mr-2"></i>Comment ça fonctionne ?
                </h3>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-4 text-center">
                    <div>
                        <div class="text-3xl font-bold text-green-600 mb-2">1,5%</div>
                        <p class="text-sm text-gray-700">Profit quotidien</p>
                    </div>
                    <div>
                        <div class="text-3xl font-bold text-green-600 mb-2">Minimum</div>
                        <p class="text-sm text-gray-700">10$ pour commencer</p>
                    </div>
                    <div>
                        <div class="text-3xl font-bold text-green-600 mb-2">USDT TRC20</div>
                        <p class="text-sm text-gray-700">Méthode de paiement</p>
                    </div>
                </div>
            </div>

            <!-- Exemple de Plans -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <!-- Plan Starter -->
                <div class="plan-card bg-white border-2 border-gray-200 rounded-lg overflow-hidden">
                    <div class="bg-green-600 text-white p-6 text-center">
                        <h3 class="text-xl font-bold mb-2">PLAN STARTER</h3>
                        <p class="text-green-100 text-sm">Pour débuter</p>
                    </div>
                    <div class="p-6 text-center">
                        <div class="mb-4">
                            <span class="bg-gray-100 text-gray-800 px-4 py-2 rounded-full text-xs font-bold">10$ - 100$</span>
                        </div>
                        <div class="mb-4">
                            <h4 class="text-2xl font-bold text-green-600 mb-2">1,5%</h4>
                            <p class="text-gray-600 text-sm">par jour</p>
                        </div>
                        <div class="mb-6">
                            <p class="text-gray-500 text-xs">Durée flexible</p>
                        </div>
                        <a href="{{ route('client.register') }}" class="block w-full bg-gray-800 text-white py-3 rounded-lg font-bold hover:bg-gray-900 transition-colors text-center">
                            INVESTIR MAINTENANT
                        </a>
                    </div>
                </div>

                <!-- Plan Pro -->
                <div class="plan-card bg-white border-2 border-green-500 rounded-lg overflow-hidden relative">
                    <div class="absolute top-0 right-0 bg-green-500 text-white px-4 py-1 text-xs font-bold">
                        POPULAIRE
                    </div>
                    <div class="bg-green-700 text-white p-6 text-center">
                        <h3 class="text-xl font-bold mb-2">PLAN PRO</h3>
                        <p class="text-green-100 text-sm">Le plus choisi</p>
                    </div>
                    <div class="p-6 text-center">
                        <div class="mb-4">
                            <span class="bg-green-100 text-green-800 px-4 py-2 rounded-full text-xs font-bold">100$ - 1000$</span>
                        </div>
                        <div class="mb-4">
                            <h4 class="text-2xl font-bold text-green-600 mb-2">1,5%</h4>
                            <p class="text-gray-600 text-sm">par jour</p>
                        </div>
                        <div class="mb-6">
                            <p class="text-gray-500 text-xs">Durée flexible</p>
                        </div>
                        <a href="{{ route('client.register') }}" class="block w-full bg-green-600 text-white py-3 rounded-lg font-bold hover:bg-green-700 transition-colors text-center">
                            INVESTIR MAINTENANT
                        </a>
                    </div>
                </div>

                <!-- Plan Premium -->
                <div class="plan-card bg-white border-2 border-gray-200 rounded-lg overflow-hidden">
                    <div class="bg-green-600 text-white p-6 text-center">
                        <h3 class="text-xl font-bold mb-2">PLAN PREMIUM</h3>
                        <p class="text-green-100 text-sm">Maximum</p>
                    </div>
                    <div class="p-6 text-center">
                        <div class="mb-4">
                            <span class="bg-gray-100 text-gray-800 px-4 py-2 rounded-full text-xs font-bold">1000$+</span>
                        </div>
                        <div class="mb-4">
                            <h4 class="text-2xl font-bold text-green-600 mb-2">1,5%</h4>
                            <p class="text-gray-600 text-sm">par jour</p>
                        </div>
                        <div class="mb-6">
                            <p class="text-gray-500 text-xs">Durée flexible</p>
                        </div>
                        <a href="{{ route('client.register') }}" class="block w-full bg-gray-800 text-white py-3 rounded-lg font-bold hover:bg-gray-900 transition-colors text-center">
                            INVESTIR MAINTENANT
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Système de Commissions -->
    <section id="commissions" class="py-16 bg-gray-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-12">
                <h2 class="text-3xl font-bold text-gray-900 mb-4 uppercase tracking-tight">Système de Commissions Multi-Niveaux</h2>
                <p class="text-gray-600 max-w-2xl mx-auto">
                    Parrainez des membres et gagnez des commissions sur leurs investissements. Plus vous parrainez, plus vous gagnez !
                </p>
            </div>
            
            <div class="bg-white border-2 border-gray-200 rounded-lg p-8 mb-8">
                <div class="grid grid-cols-1 md:grid-cols-5 gap-4 text-center">
                    <div class="p-4 bg-gray-50 rounded-lg">
                        <h4 class="text-lg font-bold text-gray-900 mb-2">Niveau 1</h4>
                        <div class="text-3xl font-bold text-green-600 mb-2">8%</div>
                        <p class="text-xs text-gray-600">Sur les investissements directs</p>
                    </div>
                    <div class="p-4 bg-gray-50 rounded-lg">
                        <h4 class="text-lg font-bold text-gray-900 mb-2">Niveau 2</h4>
                        <div class="text-3xl font-bold text-green-600 mb-2">3%</div>
                        <p class="text-xs text-gray-600">Sur les investissements niveau 2</p>
                    </div>
                    <div class="p-4 bg-gray-50 rounded-lg">
                        <h4 class="text-lg font-bold text-gray-900 mb-2">Niveau 3</h4>
                        <div class="text-3xl font-bold text-green-600 mb-2">1%</div>
                        <p class="text-xs text-gray-600">Sur les investissements niveau 3</p>
                    </div>
                    <div class="p-4 bg-gray-50 rounded-lg">
                        <h4 class="text-lg font-bold text-gray-900 mb-2">Niveau 4</h4>
                        <div class="text-3xl font-bold text-green-600 mb-2">0.5%</div>
                        <p class="text-xs text-gray-600">Sur les investissements niveau 4</p>
                    </div>
                    <div class="p-4 bg-gray-50 rounded-lg">
                        <h4 class="text-lg font-bold text-gray-900 mb-2">Niveau 5</h4>
                        <div class="text-3xl font-bold text-green-600 mb-2">0.5%</div>
                        <p class="text-xs text-gray-600">Sur les investissements niveau 5</p>
                    </div>
                </div>
            </div>

            <div class="bg-green-50 border-l-4 border-green-500 p-6 rounded-lg">
                <div class="flex items-start">
                    <i class="fas fa-lightbulb text-green-600 text-2xl mr-4 mt-1"></i>
                    <div>
                        <h4 class="text-lg font-bold text-gray-900 mb-2">Comment ça marche ?</h4>
                        <p class="text-gray-700 text-sm mb-2">
                            Partagez votre code de parrainage avec vos amis. Lorsqu'ils investissent, vous recevez automatiquement des commissions sur 5 niveaux.
                        </p>
                        <p class="text-gray-700 text-sm">
                            Les commissions sont automatiquement ajoutées à votre solde et peuvent être retirées à tout moment.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Fonctionnalités -->
    <section class="py-16 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-12">
                <h2 class="text-3xl font-bold text-gray-900 mb-4 uppercase tracking-tight">Fonctionnalités</h2>
                <p class="text-gray-600 max-w-2xl mx-auto">Les outils dont vous avez besoin pour réussir</p>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <div class="bg-white border-2 border-gray-200 rounded-lg p-6 flex items-start">
                    <div class="w-12 h-12 bg-green-100 rounded-full flex items-center justify-center mr-4 flex-shrink-0">
                        <i class="fas fa-chart-bar text-green-600 text-xl"></i>
                    </div>
                    <div>
                        <h4 class="text-lg font-bold text-gray-900 mb-2">Tableau de Bord Complet</h4>
                        <p class="text-gray-600 text-sm">
                            Suivez vos investissements, profits et commissions en temps réel avec un tableau de bord intuitif.
                        </p>
                    </div>
                </div>
                
                <div class="bg-white border-2 border-gray-200 rounded-lg p-6 flex items-start">
                    <div class="w-12 h-12 bg-green-100 rounded-full flex items-center justify-center mr-4 flex-shrink-0">
                        <i class="fas fa-history text-green-600 text-xl"></i>
                    </div>
                    <div>
                        <h4 class="text-lg font-bold text-gray-900 mb-2">Historique des Transactions</h4>
                        <p class="text-gray-600 text-sm">
                            Consultez l'historique complet de toutes vos transactions, dépôts et retraits.
                        </p>
                    </div>
                </div>
                
                <div class="bg-white border-2 border-gray-200 rounded-lg p-6 flex items-start">
                    <div class="w-12 h-12 bg-green-100 rounded-full flex items-center justify-center mr-4 flex-shrink-0">
                        <i class="fas fa-bullhorn text-green-600 text-xl"></i>
                    </div>
                    <div>
                        <h4 class="text-lg font-bold text-gray-900 mb-2">Actualités et Annonces</h4>
                        <p class="text-gray-600 text-sm">
                            Restez informé des dernières actualités et annonces importantes de la plateforme.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Call to Action -->
    <section class="py-16 bg-gradient-to-br from-green-600 to-green-800 text-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <h2 class="text-3xl font-bold mb-4 uppercase tracking-tight">
                Prêt à commencer votre parcours d'investissement ?
            </h2>
            <p class="text-lg text-green-100 mb-8 max-w-2xl mx-auto">
                Rejoignez des milliers d'investisseurs satisfaits et faites fructifier votre argent avec V75 Pro.
            </p>
            <div class="flex justify-center space-x-4">
                <a href="{{ route('client.register') }}" class="bg-white text-green-700 px-8 py-3 rounded-lg font-bold hover:bg-gray-100 transition-colors">
                    <i class="fas fa-user-plus mr-2"></i>S'INSCRIRE MAINTENANT
                </a>
                <a href="{{ route('client.login') }}" class="bg-transparent border-2 border-white text-white px-8 py-3 rounded-lg font-bold hover:bg-white hover:text-green-700 transition-colors">
                    <i class="fas fa-sign-in-alt mr-2"></i>SE CONNECTER
                </a>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="bg-gray-800 text-white py-12 border-t-2 border-gray-900">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8 mb-8">
                <div>
                    <h4 class="text-lg font-bold mb-4 uppercase tracking-tight">V75 Pro</h4>
                    <p class="text-gray-400 text-sm mb-4">
                        Plateforme d'investissement innovante pour faire fructifier votre capital.
                    </p>
                    <div class="flex space-x-4">
                        <a href="#" class="text-gray-400 hover:text-white">
                            <i class="fab fa-facebook-f"></i>
                        </a>
                        <a href="#" class="text-gray-400 hover:text-white">
                            <i class="fab fa-twitter"></i>
                        </a>
                        <a href="#" class="text-gray-400 hover:text-white">
                            <i class="fab fa-linkedin-in"></i>
                        </a>
                    </div>
                </div>
                <div>
                    <h4 class="text-lg font-bold mb-4 uppercase tracking-tight">Liens Rapides</h4>
                    <ul class="space-y-2">
                        <li><a href="#features" class="text-gray-400 hover:text-white text-sm">Fonctionnalités</a></li>
                        <li><a href="#plans" class="text-gray-400 hover:text-white text-sm">Plans d'Investissement</a></li>
                        <li><a href="#commissions" class="text-gray-400 hover:text-white text-sm">Commissions</a></li>
                        <li><a href="{{ route('policy') }}" class="text-gray-400 hover:text-white text-sm">Politique de Confidentialité</a></li>
                    </ul>
                </div>
                <div>
                    <h4 class="text-lg font-bold mb-4 uppercase tracking-tight">Contact</h4>
                    <ul class="space-y-2 text-gray-400 text-sm">
                        <li><i class="fas fa-envelope mr-2"></i>support@v75pro.com</li>
                        <li><i class="fas fa-globe mr-2"></i>www.v75pro.com</li>
                    </ul>
                </div>
            </div>
            <div class="border-t border-gray-700 pt-8 text-center">
                <p class="text-xs font-mono text-gray-400">&copy; {{ date('Y') }} V75 PRO. TOUS DROITS RÉSERVÉS.</p>
            </div>
        </div>
    </footer>
</body>
</html>
