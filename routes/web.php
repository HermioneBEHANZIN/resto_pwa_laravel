<?php

use Illuminate\Support\Facades\Route;

// Page d'accueil
Route::get('/', function () {
    return view('index');
});

// Utilisateurs
Route::get('/utilisateurs', function () {
    return view('utilisateurs');
});
Route::get('/utilisateurs/ajouter', function () {
    return view('ajouter-utilisateur');
});

// Commandes et Plats
Route::get('/commandes', function () {
    return view('commandes');
});
Route::get('/commandes/creation', function () {
    return view('creation-commande');
});
Route::get('/commandes/suivi', function () {
    return view('suivi-commande');
});

// Plats, Menus et Catégories
Route::get('/gestion-plats', function () {
    return view('gestion-plats');
});
Route::get('/detail-plat', function () {
    return view('detail-plat');
});
Route::get('/gestion-menus', function () {
    return view('gestion-menus');
});
Route::get('/gestion-categories', function () {
    return view('gestion-categories');
});
Route::get('/sous-categories', function () {
    return view('sous-categories');
});

// Tables et Salle
Route::get('/plan-de-salle', function () {
    return view('plan-de-salle');
});
Route::get('/detail-table', function () {
    return view('detail-table');
});
Route::get('/membres-table', function () {
    return view('membres-table');
});
Route::get('/panier-table', function () {
    return view('panier-table');
});

// Facturation et Paiements
Route::get('/factures', function () {
    return view('factures');
});
Route::get('/facturation', function () {
    return view('facturation');
});
Route::get('/paiements', function () {
    return view('paiements');
});

// Interface et Tableau de bord
Route::get('/dashboard', function () {
    return view('dashboard');
});
Route::get('/interface-serveur', function () {
    return view('interface-serveur');
});
Route::get('/statistiques', function () {
    return view('statistiques');
});
Route::get('/parametres', function () {
    return view('parametres');
});
Route::get('/assistance', function () {
    return view('assistance');
});
Route::get('/contact', function () {
    return view('contact');
});
Route::get('/en-construction', function () {
    return view('en-construction');
});