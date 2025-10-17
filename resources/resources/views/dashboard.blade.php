<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Wellcare Home</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600&display=swap" rel="stylesheet">
    <title>Document</title>
    @vite('resources/css/dashboard.css')
</head>
<body>
    <header>
        <div class="header-top">
            <h1>SeekMed</h1>
            <nav class="top-nav desktop-nav">
                <a href={{route('home')}}"><span>Home</span></a>
                <span class="active">Dashboard</span>
                <a href={{route('forum')}}"><span>Forum</span></a>
            </nav>
        </div>
    </header>

    <section class="dash-container">
        <div class="section-one">
            <a>Konsultasi Spesialis Tepercaya</a>
            <button class="buton-help">Sp. Mata</button>
            <button class="buton-help">Sp. Kulit</button>
            <button class="buton-help">Sp. Penyakit Dalam</button>
            <button class="buton-help">Sp. Kandungan</button>
        </div>
        <div class="section-two">
            <a>Kami Siap Membantu</a>
            <button class="buton-help">Beli Asuransi Kesehatan</button>
            <button class="buton-help">Konsultasi Dokter Online</button>
            <button class="buton-help">Apoteker Terdekat</button>
        </div>
    </section>
</body>
</html>