@extends('layouts.app')

<style>
    /* Global Styles */
    body {
        background-color: #f9f9f9; /* Warna latar belakang yang lembut */
        font-family: Arial, sans-serif; /* Gunakan font sans-serif */
    }

    /* Hero Section */
    /* .hero-section {
        background: linear-gradient(rgba(0, 0, 0, 0.5), rgba(0, 0, 0, 0.5)), 
                    url('{{ asset("image/hero-background.jpg") }}') center/cover no-repeat;
        height: 300px;
        color: white;
        display: flex;
        align-items: center;
        justify-content: center;
    } */

    .hero-section h2 {
        font-size: 2.5rem;
        font-weight: bold;
        margin-bottom: 0;
    }

    /* Article Section */
    #articles {
        padding: 60px 0;
    }

    /* Card Styles */
    .card {
        border: none;
        border-radius: 8px;
        background-color: #ffffff;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        transition: transform 0.3s ease, box-shadow 0.3s ease;
    }

    .card:hover {
        transform: translateY(-10px);
        box-shadow: 0 8px 12px rgba(0, 0, 0, 0.2);
    }

    .card-img-top {
        width: 100%;
        height: 200px; /* Pastikan gambar seragam */
        object-fit: cover;
        border-top-left-radius: 8px;
        border-top-right-radius: 8px;
    }

    .card-body {
        min-height: 200px; /* Tinggi minimum untuk body card */
        max-height: 200px;
        display: flex;
        flex-direction: column;
        justify-content: space-between;
    }

    .card-title {
        font-size: 1.25rem;
        font-weight: bold;
        color: #333;
        margin-bottom: 10px;
        text-overflow: ellipsis;
        white-space: nowrap;
        overflow: hidden;
    }

    .card-text {
        font-size: 0.95rem;
        color: #666;
        line-height: 1.5;
        max-height: 75px; /* Membatasi tinggi konten */
        overflow: hidden;
        text-overflow: ellipsis;
        display: -webkit-box;
        -webkit-line-clamp: 3; /* Batasi ke 3 baris */
        -webkit-box-orient: vertical;
        white-space: normal;
    }

    .btn-outline-primary {
        border-radius: 20px;
        color: #007bff;
        border-color: #007bff;
        transition: background-color 0.3s ease, color 0.3s ease;
    }

    .btn-outline-primary:hover {
        background-color: #007bff;
        color: #ffffff;
    }

    /* Pagination Styles */
    .pagination {
        margin: 20px 0;
    }

    .pagination .page-item .page-link {
        color: #007bff;
        border-radius: 50%;
        transition: background-color 0.3s ease, color 0.3s ease;
    }

    .pagination .page-item.active .page-link {
        background-color: #007bff;
        border-color: #007bff;
        color: #ffffff;
    }

    /* Responsiveness */
    @media (max-width: 768px) {
        .card-title {
            font-size: 1rem;
        }

        .card-text {
            font-size: 0.85rem;
        }
    }
</style>

@section('content')
<!-- Hero Section -->
<section class="hero-section">
    <div class="container text-center">
        <h2>Daftar Artikel</h2>
    </div>
</section>

<!-- Articles Section -->
<section id="articles">
    <div class="container">
        <div class="row g-4">
            @forelse ($articles as $article)
                <div class="col-md-4">
                    <div class="card">
                        <img src="{{ Storage::url($article->main_image) }}" alt="{{ $article->title }}" class="card-img-top">
                        <div class="card-body">
                            <h5 class="card-title">{!! Str::limit($article->title, 50) !!}</h5>
                            <p class="card-text">
                                {!! \App\Helpers\TextHelper::limitLines(strip_tags($article->content)) !!}
                            </p>
                            <a href="{{ route('article.detail', $article->id) }}" class="btn btn-outline-primary mt-auto">Baca Selengkapnya</a>
                        </div>
                    </div>
                </div>
            @empty
                <p class="text-center">Belum ada artikel yang tersedia.</p>
            @endforelse
        </div>

        <!-- Pagination -->
        <div class="d-flex justify-content-center mt-4">
            {{ $articles->links() }}
        </div>
    </div>
</section>
@endsection