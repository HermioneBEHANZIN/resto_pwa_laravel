@extends('layouts.app')

@section('title', 'Ajouter un utilisateur — Le Gourmet')
@section('page-id', 'users')

@push('styles')
    <!-- CSS spécifique à cette page -->
    <link rel="stylesheet" href="{{ asset('assets/css/ajouter-utilisateur.css') }}">
@endpush

@section('content')
<main class="main ajouter-utilisateur-main">
    <div class="container-fluid p-0">

        <!-- Fil d'Ariane -->
        <div class="breadcrumb-row mb-3">
            <a href="{{ url('/utilisateurs') }}" class="crumb-muted text-decoration-none">Utilisateurs</a>
            <i class="fa-solid fa-chevron-right"></i>
            <span class="crumb-active">Ajouter un utilisateur</span>
        </div>

        <!-- Carte chiffre d'affaires journalier -->
        <div class="revenue-card d-flex align-items-center flex-wrap gap-4 p-4 mb-4">
            <div class="revenue-icon">
                <i class="fa-solid fa-chart-line"></i>
            </div>
            <div class="revenue-info">
                <div class="label">Chiffres d'affaires journaliers</div>
                <div class="amount">1 250 000<span class="unit">FCFA</span></div>
                <div class="delta">+ 10%</div>
            </div>
            <div class="revenue-date ms-md-auto d-flex align-items-center gap-2">
                <i class="fa-regular fa-calendar"></i>
                03 juillet 2026
            </div>
        </div>

        <div class="row g-3">

            <!-- Colonne gauche : Formulaire -->
            <div class="col-12 col-lg-5">
                <div class="form-card">
                    <div class="title">Ajouter un utilisateur</div>
                    <div class="subtitle">Ajouter un nouveau membre à votre équipe</div>

                    <form id="userForm" action="{{ url('/utilisateurs') }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <div class="section-label"><i class="fa-solid fa-play"></i> Photo de profil</div>
                        <div class="upload-zone mb-2">
                            <div class="up-icon"><i class="fa-solid fa-cloud-arrow-up"></i></div>
                            <div class="up-text">Glissez-déposez une image ici</div>
                            <div class="up-or">ou</div>
                            <label class="import-btn mb-0" style="cursor:pointer;">
                                Importer une image
                                <input type="file" id="photoInput" name="photo" accept="image/png, image/jpeg, image/webp" hidden>
                            </label>
                            <div class="fmt">PNG, JPG ou WEBP</div>
                        </div>

                        <div class="section-label"><i class="fa-solid fa-play"></i> Informations générales</div>

                        <div class="field mb-3">
                            <label for="fullName">Nom complet</label>
                            <input type="text" class="form-control" id="fullName" name="fullName" placeholder="Ex : Vicenzo CASSADO">
                        </div>

                        <div class="field mb-3">
                            <label for="userEmail">Adresse e-mail</label>
                            <div class="field-email">
                                <i class="fa-regular fa-envelope"></i>
                                <input type="email" id="userEmail" name="email" placeholder="vicenzo@gmail.com">
                            </div>
                        </div>

                        <div class="field mb-3">
                            <label for="userPhone">Numéro de téléphone</label>
                            <div class="phone-field">
                                <span class="phone-flag"><span class="flag"></span>+229 <i class="fa-solid fa-chevron-down"></i></span>
                                <input type="tel" id="userPhone" name="phone" placeholder="01 97 36 74 67">
                            </div>
                        </div>

                        <div class="field mb-3">
                            <label for="userRole">Rôle</label>
                            <div class="role-select-wrap">
                                <i class="fa-solid fa-user"></i>
                                <select class="form-select" id="userRole" name="role">
                                    <option value="" selected disabled>Sélectionner un rôle</option>
                                    <option value="Super Administrateur">Super Administrateur</option>
                                    <option value="Administrateur">Administrateur</option>
                                    <option value="Serveur">Serveur</option>
                                    <option value="Serveuse">Serveuse</option>
                                    <option value="Cuisinier">Cuisinier</option>
                                    <option value="Cuisinière">Cuisinière</option>
                                </select>
                                <i class="fa-solid fa-chevron-down"></i>
                            </div>
                        </div>

                        <div class="form-actions">
                            <a href="{{ url('/utilisateurs') }}" class="btn btn-cancel">Annuler</a>
                            <button type="submit" class="btn btn-save">Enregistrer</button>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Colonne droite : Aperçu en temps réel -->
            <div class="col-12 col-lg-7">
                <div class="preview-card">
                    <div class="preview-title"><i class="fa-solid fa-eye"></i> Aperçu en temps réel</div>

                    <div class="preview-avatar-wrap">
                        <img id="previewPhoto" src="https://ui-avatars.com/api/?name=Nouvel+Utilisateur&background=EEF1FF&color=7B1C2A&bold=true&size=170" alt="Aperçu photo de profil">
                        <div class="preview-cam-btn"><i class="fa-solid fa-camera"></i></div>
                    </div>

                    <div class="preview-name" id="previewName">Nouvel utilisateur</div>

                    <div class="preview-role-badge">
                        <i class="fa-solid fa-user" id="previewRoleIcon"></i>
                        <span id="previewRole">Rôle non défini</span>
                    </div>

                    <div class="preview-info-row">
                        <div class="icon-round"><i class="fa-solid fa-phone"></i></div>
                        <div class="value" id="previewPhone">+229 —</div>
                    </div>
                    <div class="preview-info-row">
                        <div class="icon-round"><i class="fa-regular fa-envelope"></i></div>
                        <div class="value" id="previewEmail">adresse@email.com</div>
                    </div>
                    <div class="preview-info-row">
                        <div class="icon-round"><i class="fa-solid fa-user"></i></div>
                        <div class="value" id="previewFunction">Fonction non définie</div>
                    </div>

                    <div class="preview-actions">
                        <button type="button" class="btn-preview-edit"><i class="fa-solid fa-pen me-2"></i>Modifier</button>
                        <button type="button" class="btn-preview-delete"><i class="fa-solid fa-trash me-2"></i>Supprimer</button>
                    </div>
                </div>
            </div>

        </div>

    </div>
</main>
@endsection

@push('scripts')
    <!-- Script JS spécifique à cette page -->
    <script src="{{ asset('assets/js/ajouter-utilisateur.js') }}"></script>
@endpush