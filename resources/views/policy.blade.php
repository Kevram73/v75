<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>V75 Pro - Politique de Confidentialité</title>
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
    </style>
</head>
<body class="bg-gray-50">
    <div class="max-w-4xl mx-auto px-4 py-8">
        <div class="bg-white border-2 border-gray-300 p-6">
            <h1 class="text-2xl font-bold text-gray-900 mb-4 uppercase">POLITIQUE DE CONFIDENTIALITÉ</h1>
            <div class="text-xs text-gray-700 space-y-4">
                <p>V75 Pro s'engage à protéger votre vie privée et vos données personnelles.</p>
                <p>En utilisant notre plateforme, vous acceptez les termes de cette politique.</p>
            </div>
            <div class="mt-6">
                <a href="{{ route('welcome') }}" class="text-xs font-mono bg-gray-800 text-white px-4 py-2 hover:bg-gray-900">
                    RETOUR À L'ACCUEIL
                </a>
            </div>
        </div>
    </div>
</body>
</html>

