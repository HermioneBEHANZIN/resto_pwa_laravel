<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Le Gourmet — Resto PWA')</title>

    <!-- Google Fonts & Font Awesome -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">

    <!-- CSS commun à toutes les pages -->
    <link rel="stylesheet" href="{{ asset('assets/css/header-sidebar.css') }}">

    <!-- Permet d'injecter du CSS spécifique à une page -->
    @stack('styles')
</head>
<body data-page="@yield('page-id', 'default')">

<div class="app">
    <!-- Header / Sidebar JS Mount -->
    <div id="hsMount"></div>

    <!-- Contenu spécifique de chaque page -->
    @yield('content')
</div>

<!-- JS commun -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script src="{{ asset('assets/js/header-sidebar.js') }}"></script>

<!-- Permet d'injecter des scripts JS spécifiques à une page -->
@stack('scripts')

</body>
</html>