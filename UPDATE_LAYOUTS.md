# Mise à jour des Layouts - V75 Pro

## ✅ Layouts créés

1. **`resources/views/layouts/app.blade.php`** - Layout Admin avec Tailwind CSS
2. **`resources/views/layouts/app2.blade.php`** - Layout Client avec Tailwind CSS

## ✅ Pages mises à jour

### Admin
- ✅ `admin/home.blade.php` - Dashboard admin
- ✅ `admin/withdrawals.blade.php` - Liste des retraits
- ✅ `admin/deposits.blade.php` - Liste des dépôts
- ✅ `admin/clients/index.blade.php` - Liste des clients

### Client
- ✅ `client/dashboard.blade.php` - Dashboard client

## 📝 Pages à mettre à jour

Pour chaque page, ajouter après `@section('content')`:

```php
@section('page-title', 'TITRE EN MAJUSCULES')
@section('page-subtitle', 'SOUS-TITRE')
```

Et supprimer les wrappers:
- `<div class="content-wrapper">`
- `<div class="container-full">`
- `<div class="content-header">`
- `</section>` et `</div>` de fin

### Pages Admin restantes:
- `admin/stats.blade.php`
- `admin/profile.blade.php`
- `admin/transactions/index.blade.php`
- `admin/retrieve_requests/index.blade.php`
- `admin/clients/indexDisabled.blade.php`
- `admin/messages/index.blade.php`
- `admin/accounts/index.blade.php`
- `admin/announcements/index.blade.php`
- `admin/announcements/create.blade.php`
- `admin/admins/index.blade.php`
- `admin/admins/create.blade.php`
- `admin/admins/edit.blade.php`

### Pages Client restantes:
- `client/account.blade.php`
- `client/commissions/index.blade.php`
- `client/investments/index.blade.php`
- `client/deposits.blade.php`
- `client/withdrawals.blade.php`
- `client/service_client.blade.php`
- Et autres...

## 🎨 Style du nouveau layout

- Sidebar sombre avec navigation
- Header avec informations utilisateur
- Alerts avec style monospace ([OK], [ERR])
- Design "engineering" avec polices JetBrains Mono
- Responsive avec Tailwind CSS

