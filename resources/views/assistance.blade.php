@extends('layouts.app')

@section('title', 'Le Gourmet — Assistance')
@section('page-id', 'assistance.html')

@push('styles')
<style>
    /* Styles spécifiques à la page Assistance */
    .section-assistance {
        background: var(--pink-cream, #fff0f0);
        padding: 90px 20px 110px;
        text-align: center;
        min-height: 70vh;
        position: relative;
    }

    .section-assistance .back-btn {
        position: absolute;
        top: 32px;
        left: 40px;
        width: 48px;
        height: 48px;
        border-radius: 50%;
        background: var(--bordeaux, #800020);
        color: #fff;
        display: none;
        align-items: center;
        justify-content: center;
        border: none;
    }

    .section-assistance h1 {
        font-size: 3rem;
        font-weight: 700;
        color: #111;
        margin-bottom: 28px;
    }

    .section-assistance .subtitle {
        font-size: 1.15rem;
        color: #333;
        max-width: 620px;
        margin: 0 auto 60px;
        line-height: 1.6;
    }

    .bell-btn {
        width: 230px;
        height: 230px;
        border-radius: 50%;
        background: var(--bordeaux, #800020);
        border: none;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        color: #fff;
        font-size: 5.5rem;
        cursor: pointer;
        transition: transform .2s ease, box-shadow .2s ease, background-color .2s ease;
        box-shadow: 0 6px 18px rgba(128,0,32,.25);
    }

    .bell-btn:hover {
        background: var(--bordeaux-dark, #5e0017);
        transform: scale(1.05);
        box-shadow: 0 10px 26px rgba(128,0,32,.35);
    }

    .bell-btn:active {
        transform: scale(.97);
    }

    .bell-btn.ringing i {
        animation: ring 0.5s ease-in-out 2;
    }

    @keyframes ring {
        0%, 100% { transform: rotate(0deg); }
        20% { transform: rotate(-15deg); }
        40% { transform: rotate(12deg); }
        60% { transform: rotate(-8deg); }
        80% { transform: rotate(5deg); }
    }

    .assistance-label {
        display: block;
        margin-top: 30px;
        font-family: 'Playfair Display', serif;
        font-size: 1.7rem;
        font-weight: 700;
        color: var(--bordeaux, #800020);
    }

    .toast-confirm {
        position: fixed;
        bottom: 30px;
        left: 50%;
        transform: translateX(-50%) translateY(20px);
        background: var(--bordeaux, #800020);
        color: #fff;
        padding: 14px 28px;
        border-radius: 30px;
        font-weight: 500;
        opacity: 0;
        pointer-events: none;
        transition: opacity .3s ease, transform .3s ease;
        z-index: 2000;
        box-shadow: 0 6px 20px rgba(0,0,0,.2);
    }

    .toast-confirm.show {
        opacity: 1;
        transform: translateX(-50%) translateY(0);
    }

    @media (max-width: 767.98px) {
        .section-assistance {
            padding: 40px 20px 60px;
            min-height: 60vh;
            display: flex;
            flex-direction: column;
            justify-content: center;
        }
        .section-assistance .back-btn {
            display: flex;
            top: 20px;
            left: 16px;
            width: 40px;
            height: 40px;
            position: absolute;
            margin-bottom: 0;
        }
        .section-assistance h1 { font-size: 1.9rem; margin-bottom: 18px; }
        .section-assistance .subtitle { font-size: .95rem; margin-bottom: 50px; }
        .bell-btn { width: 200px; height: 200px; font-size: 4.6rem; margin: 0 auto; }
        .assistance-label { font-size: 1.4rem; }
    }
</style>
@endpush

@section('content')
<section class="section-assistance">
    <button class="back-btn" onclick="history.back()">
        <i class="fa-solid fa-chevron-left"></i>
    </button>

    <h1>Besoin d'aide ?</h1>
    <p class="subtitle">
        Appuyer sur la cloche pour appeler un serveur.<br class="d-none d-md-inline"> 
        Nous serons à votre disposition rapidement
    </p>

    <button id="bellBtn" class="bell-btn" type="button" aria-label="Appeler un serveur">
        <i class="fa-solid fa-bell"></i>
    </button>
    <span class="assistance-label">Appeler un serveur</span>
</section>
@endsection

@push('scripts')
<script>
    const bellBtn = document.getElementById('bellBtn');

    // Génère un son de cloche doux (type "ding") avec le Web Audio API
    let audioCtx;
    function playBellSound() {
        audioCtx = audioCtx || new (window.AudioContext || window.webkitAudioContext)();
        const now = audioCtx.currentTime;

        const frequencies = [880, 1320, 1760, 2640];
        const gains = [0.35, 0.18, 0.09, 0.05];

        frequencies.forEach((freq, i) => {
            const osc = audioCtx.createOscillator();
            const gainNode = audioCtx.createGain();

            osc.type = 'sine';
            osc.frequency.setValueAtTime(freq, now);

            gainNode.gain.setValueAtTime(0, now);
            gainNode.gain.linearRampToValueAtTime(gains[i], now + 0.015);
            gainNode.gain.exponentialRampToValueAtTime(0.0001, now + 1.6);

            osc.connect(gainNode);
            gainNode.connect(audioCtx.destination);

            osc.start(now);
            osc.stop(now + 1.7);
        });
    }

    if (bellBtn) {
        bellBtn.addEventListener('click', function () {
            bellBtn.classList.remove('ringing');
            void bellBtn.offsetWidth; // reset animation
            bellBtn.classList.add('ringing');

            playBellSound();
            showToast('Un serveur a été notifié, merci de patienter.');

            // Emplacement pour futur appel API Laravel :
            // fetch('{{ url("/api/call-server") }}', { method: 'POST', headers: { 'X-CSRF-TOKEN': '{{ csrf_token() }}' } });
        });
    }

    function showToast(message) {
        let toast = document.querySelector('.toast-confirm');
        if (!toast) {
            toast = document.createElement('div');
            toast.className = 'toast-confirm';
            document.body.appendChild(toast);
        }
        toast.textContent = message;
        requestAnimationFrame(() => toast.classList.add('show'));
        clearTimeout(toast._timeout);
        toast._timeout = setTimeout(() => toast.classList.remove('show'), 2800);
    }
</script>
@endpush