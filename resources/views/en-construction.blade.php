@extends('layouts.app')

@section('title', 'En construction — Le Prestige')

@push('styles')
<style>
    .construction-wrapper {
        min-height: calc(100vh - 150px);
        display: flex;
        justify-content: center;
        align-items: center;
    }
    
    .page-max { 
        max-width: 450px; 
        width: 100%; 
        padding: 40px 20px; 
        text-align: center; 
    }
    
    .icon-wrapper { 
        font-size: 5rem; 
        color: #B38E5B; 
        margin-bottom: 20px; 
    }
    
    .construction-title { 
        font-family: 'Playfair Display', serif; 
        font-size: 2rem; 
        margin-bottom: 15px; 
    }
    
    .construction-text { 
        color: #555; 
        margin-bottom: 30px; 
    }
    
    .btn-back { 
        display: inline-block; 
        background: #685942; 
        color: #FFF; 
        padding: 14px 30px; 
        border-radius: 14px; 
        text-decoration: none; 
        font-weight: 600; 
        transition: background 0.3s;
    }
    
    .btn-back:hover { 
        background: #4A3E2F; 
        color: #FFF;
    }
</style>
@endpush

@section('content')
<div class="construction-wrapper">
    <div class="page-max">
        <div class="icon-wrapper">
            <i class="fa-solid fa-person-digging"></i>
        </div>
        
        <h1 class="construction-title">En construction</h1>
        
        <p class="construction-text">Cette page est actuellement en cours de préparation. Revenez vite nous voir !</p>
        
        <a href="javascript:history.back()" class="btn-back">
            <i class="fa-solid fa-arrow-left me-2"></i> Retour
        </a>
    </div>
</div>
@endsection