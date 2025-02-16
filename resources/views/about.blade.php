@extends('layouts.app')

<style>
    .hero-section {
        height: 60vh; /* Tinggi hero lebih pendek dari home */
        position: relative;
        overflow: hidden;
    }

    .background-overlay {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background-image: url('{{ asset('image/beach-418742_1280.jpg') }}');
        background-size: cover;
        background-position: center;
        z-index: -1;
        opacity: 0.7;
    }

    .content-section {
        padding: 60px 0;
    }

    .content-text {
        font-size: 18px;
        line-height: 1.8;
        text-align: justify;
    }

    .card img {
        width: 100px;
        height: 100px;
        object-fit: cover;
        border-radius: 50%;
        margin-bottom: 10px;
    }
</style>

@section('content')
<!-- Hero Section -->
<section class="hero-section text-center d-flex align-items-center justify-content-center">
    <div class="background-overlay"></div>
    <div class="container text-white">
        <h1 class="display-4 fw-bold">Tentang Kami</h1>
        <p class="lead">Mengenal lebih dalam tentang KOWARA</p>
    </div>
</section>  

<!-- About Content -->
<section class="content-section">
    <div class="container">
        <h2 class="text-center mb-4">Siapa Kami?</h2>
        <div class="row">
            <div class="col-md-6">
                <img src="{{ asset('image/kowara.jpg') }}" alt="Our Team" class="img-fluid rounded">
            </div>
            <div class="col-md-6">
                <p class="content-text">
                    Kowara (Komunitas Warga Rantau) adalah sebuah organisasi sosial yang berpusat di Desa Tugu, Kecamatan Buayan, Kabupaten Kebumen. Komunitas ini beranggotakan warga Desa Tugu yang merantau ke berbagai daerah serta relawan yang masih berada di desa.
                </p>
                <p class="content-text">
                    Sebagai komunitas yang bergerak di bidang sosial, Kowara hadir sebagai wadah dan forum komunikasi bagi para perantau dan masyarakat desa dalam berbagai kegiatan sosial. Kami berkomitmen untuk membangun semangat kebersamaan, mempererat tali silaturahmi, serta menjadi sarana pengembangan dan pembinaan bagi seluruh anggota dan masyarakat.
                </p>
                <p class="content-text">
                    Selain itu, Kowara juga menjalin kerja sama dengan berbagai instansi untuk turut berperan dalam memajukan desa. Melalui berbagai program sosial dan kegiatan berbasis komunitas, kami berharap dapat memberikan manfaat nyata bagi masyarakat Desa Tugu dan menciptakan lingkungan yang lebih harmonis dan sejahtera.
                </p>
            </div>
        </div>
    </div>
</section>

<!-- Visi & Misi -->
<section class="content-section bg-light">
    <div class="container">
        <h2 class="text-center mb-4">Visi & Misi</h2>
        <div class="row">
            <div class="col-md-6">
                <h4 class="fw-bold text-center">Visi</h4>
                <p class="content-text">
                    Membentuk wadah dan forum komunikasi seputar kegiatan sosial yang bisa menjadi pemersatu bagi anggota yang di perantauan maupun masyarakat yang ada di Desa Tugu, khususnya. Sebagai upaya untuk membangun semangat kebersamaan sekaligus menjadi wadah untuk pengembangan, pembinaan, dan juga sebagai sarana silaturahmi bagi semua anggota dan masyarakat. Selain itu, bekerja sama dengan beberapa instansi untuk berperan serta dalam memajukan desa.
                </p>
            </div>
            <div class="col-md-6">
                <h4 class="fw-bold text-center">Misi</h4>
                <p class="content-text">
                    Meningkatkan kualitas persatuan dan kesatuan serta rasa kebersamaan dan etika dalam berorganisasi maupun bersosialisasi, yang berazaskan musyawarah serta kekeluargaan.
                </p>
            </div>
        </div>
    </div>
</section>

<!-- Struktur Kepengurusan -->
<section class="content-section">
    <div class="container">
        <h2 class="text-center mb-4">Struktur Kepengurusan</h2>
        <div class="row text-center">
            <div class="col-md-4">
                <div class="card p-3">
                    {{-- <img src="{{ asset('image/profile1.jpg') }}" alt="Ketua"> --}}
                    <h5 class="fw-bold mt-2">Sariyo</h5>
                    <p class="text-muted">Wakil Ketua KOWARA</p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card p-3">
                    {{-- <img src="{{ asset('image/profile2.jpg') }}" alt="Wakil Ketua"> --}}
                    <h5 class="fw-bold mt-2">Suparyo</h5>
                    <p class="text-muted">Ketua KOWARA</p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card p-3">
                    {{-- <img src="{{ asset('image/profile3.jpg') }}" alt="Sekretaris"> --}}
                    <h5 class="fw-bold mt-2">Wagiyo</h5>
                    <p class="text-muted">Sekretaris KOWARA</p>
                </div>
            </div>
        </div>
    </div>
    <div class="container" style="margin-top: 25px">
        <div class="row text-center">
            <div class="col-md-4">
                <div class="card p-3">
                    {{-- <img src="{{ asset('image/profile1.jpg') }}" alt="Ketua"> --}}
                    <h5 class="fw-bold mt-2">Sarijan</h5>
                    <p class="text-muted">Humas I KOWARA</p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card p-3">
                    {{-- <img src="{{ asset('image/profile2.jpg') }}" alt="Wakil Ketua"> --}}
                    <h5 class="fw-bold mt-2">Dalimun</h5>
                    <p class="text-muted">Bendahara</p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card p-3">
                    {{-- <img src="{{ asset('image/profile3.jpg') }}" alt="Sekretaris"> --}}
                    <h5 class="fw-bold mt-2">Peri Sukandar</h5>
                    <p class="text-muted">Humas II KOWARA</p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Lokasi Sekretariat -->
<section class="content-section bg-light">
    <div class="container text-center mt-4">
        <h3 style="margin-bottom: 25px">Lokasi Sekretariat KOWARA</h3>
        <iframe 
            src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d1010.1962806804027!2d109.44796090756569!3d-7.644678155172413!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e65495b4bd6c91b%3A0xf1ae05ec277993aa!2sSEKRETARIAT%20KOWARA%20KEBUMEN!5e0!3m2!1sid!2sid!4v1739180707683!5m2!1sid!2sid" 
            width="70%" 
            height="450" 
            style="border:0;" 
            allowfullscreen="" 
            loading="lazy" 
            referrerpolicy="no-referrer-when-downgrade">
        </iframe>
    </div>    
</section>

@endsection
