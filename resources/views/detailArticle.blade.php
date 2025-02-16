@extends('layouts.app') <!-- Gunakan layout utama -->

@section('content')
<div class="container my-5">
    <div class="row">
        <!-- Bagian Utama Artikel -->
        <div class="col-lg-8">
            <div class="card shadow-sm">
                <!-- Gambar Utama -->
                <img src="{{ Storage::url($article->main_image) }}" alt="{{ $article->title }}" class="card-img-top">
                <div class="card-body">
                    <h1 class="card-title">{!! $article->title !!}</h1>
                    <p class="text-muted">Dipublikasikan pada {{ $article->created_at->translatedFormat('j F Y') }}</p>
                    <hr>
                    <p class="card-text">
                        {!! $article->content !!}
                    </p>
                </div>
            </div>

            <!-- Carousel Gambar Tambahan -->
            @if ($article->additionalImages->count() > 0)
            <div id="additionalImagesCarousel" class="carousel slide mt-4" data-bs-ride="carousel">
                <div class="carousel-inner">
                    @foreach ($article->additionalImages as $index => $image)
                    <div class="carousel-item {{ $index === 0 ? 'active' : '' }}">
                        <img src="{{ Storage::url($image->path) }}" class="d-block w-100" alt="Gambar Tambahan {{ $index + 1 }}">
                    </div>
                    @endforeach
                </div>
                <button class="carousel-control-prev" type="button" data-bs-target="#additionalImagesCarousel" data-bs-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Previous</span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#additionalImagesCarousel" data-bs-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Next</span>
                </button>
            </div>
            @endif
        </div>

        <!-- Bagian Samping: Artikel Lainnya -->
        <div class="col-lg-4">
            <h4 class="mb-3" style="margin-left: 80px">Artikel Lainnya</h4>
            <ul class="list-group">
                @foreach ($articles->take(3) as $article) <!-- Batasi maksimal 3 artikel -->
                <li class="list-group-item text-center mb-4" style="padding: 15px; border: none; margin-left: 33px;">
                    <!-- Gambar di atas -->
                    <img src="{{ Storage::url($article->main_image) }}" 
                        alt="{{ $article->title }}" 
                        class="img-fluid rounded mb-3" 
                        style="max-width: 300px; object-fit: cover;">
                    <!-- Judul di bawah gambar -->
                    <a href="{{ route('article.detail', $article->id) }}" class="text-decoration-none d-block">
                        {{ $article->title }}
                    </a>
                </li>
                @endforeach
            </ul>
        </div>
    </div>

    <!-- Komentar (Nonaktif) -->
    {{-- 
    <div class="mt-5">
        <h3>Komentar</h3>
        <form method="POST" action="#">
            @csrf
            <div class="mb-3">
                <textarea class="form-control" name="comment" rows="3" placeholder="Tulis komentar Anda..." required></textarea>
            </div>
            <button type="submit" class="btn btn-primary">Kirim Komentar</button>
        </form>

        <div class="mt-4">
            <div class="card shadow-sm mb-3">
                <div class="card-body">
                    <h5 class="card-title">Nama Pengguna</h5>
                    <p class="card-text">Ini adalah contoh komentar yang dikirimkan oleh pengguna.</p>
                    <p class="text-muted small">Diposting pada 19 Januari 2025</p>
                </div>
            </div>
        </div>
    </div>
    --}}
</div>
@endsection