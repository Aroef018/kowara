<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Edit Article</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdn.quilljs.com/1.3.7/quill.snow.css" rel="stylesheet">
  <style>
    .content {
      margin-left: 250px; /* Offset untuk sidebar */
      padding: 20px;
    }
    .sidebar {
      height: 100vh;
      width: 250px;
      position: fixed;
      top: 0;
      left: 0;
      background-color: #343a40;
      color: #fff;
      padding-top: 20px;
    }
    .sidebar a {
      text-decoration: none;
      color: #adb5bd;
      padding: 10px 20px;
      display: block;
    }
    .sidebar a:hover, .sidebar a.active {
      background-color: #495057;
      color: white;
    }
    .image-preview {
      max-width: 100%;
      max-height: 200px;
      margin-top: 10px;
    }
  </style>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<script src="https://cdn.quilljs.com/1.3.7/quill.min.js"></script>
<body>
  <!-- Main Content -->
  <div class="content">
    <button class="btn btn-secondary mb-3" onclick="history.back()">← Back</button>
    <h3 class="mb-4">Edit Article</h3>

    <!-- Form to Edit Article -->
    <form id="editArticleForm" action="{{ route('articles.update', $article->id) }}" method="POST" enctype="multipart/form-data">
      @csrf
      @method('PUT')
      <!-- Title -->
      <div class="mb-3">
        <label for="articleTitle" class="form-label">Title</label>
        <input type="text" name="title" id="title" class="form-control" value="{{ old('title', $article->title) }}" required>
      </div>

      <div class="mb-3">
        <label for="articleContent" class="form-label">Content</label>
        <div id="articleContent" 
             style="height: 300px; background-color: white;"
        >
          {!! old('content', $article->content) !!}
        </div>
        <input type="hidden" id="contentInput" name="content">
      </div>      

      <!-- Main Image -->
      <div class="mb-3">
        <label for="mainImage" class="form-label">Main Image</label>
        <input type="file" class="form-control" id="mainImage" name="main_image" accept="image/*" onchange="previewImage(event, 'mainImagePreview')">
        <img id="mainImagePreview" class="image-preview" src="{{ $article->main_image ? asset('storage/' . $article->main_image) : '#' }}" 
             alt="Main Image Preview" style="{{ $article->main_image ? 'display: block;' : 'display: none;' }}">
      </div>

      <div class="mb-3">
        <label for="additionalImages" class="form-label">Additional Images</label>
        <input type="file" class="form-control" id="additionalImages" name="additional_images[]" accept="image/*" multiple onchange="previewAdditionalImages(event)">
        <div id="additionalImagesPreview">
          @if ($article->additionalImages)
            @foreach ($article->additionalImages as $image)
              <img src="{{ asset('storage/' . $image->path) }}" class="image-preview" alt="Additional Image">
            @endforeach
          @endif
        </div>
      </div>      

      <!-- Submit Button -->
      <button type="button" class="btn btn-primary" onclick="confirmSave()">Save Changes</button>
    </form>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
  <script>
    // Function to preview the main image
    function previewImage(event, previewId) {
      const file = event.target.files[0];
      if (file) {
        const reader = new FileReader();
        reader.onload = function() {
          const previewElement = document.getElementById(previewId);
          previewElement.src = reader.result;
          previewElement.style.display = 'block';
        };
        reader.readAsDataURL(file);
      }
    }

    // Function to preview additional images
    function previewAdditionalImages(event) {
      const files = event.target.files;
      const previewContainer = document.getElementById('additionalImagesPreview');
      previewContainer.innerHTML = ''; // Hapus preview sebelumnya

      Array.from(files).forEach(file => {
        const reader = new FileReader();
        reader.onload = function() {
          const imgElement = document.createElement('img');
          imgElement.src = reader.result;
          imgElement.classList.add('image-preview');
          previewContainer.appendChild(imgElement);
        };
        reader.readAsDataURL(file);
      });
    }

    // Inisialisasi Quill.js
    const quill = new Quill('#articleContent', {
      theme: 'snow', // Gunakan tema "snow"
      placeholder: 'Write your article content here...',
      modules: {
        toolbar: [
          ['bold', 'italic', 'underline'],        // Tombol format teks
          [{ 'list': 'ordered'}, { 'list': 'bullet' }], // Daftar
          ['link'],                      // Link dan gambar
          [{ 'align': [] }],                      // Pengaturan align
          ['clean']                               // Hapus format
        ]
      }
    });

    // Sinkronisasi isi editor ke input tersembunyi
    document.querySelector('form').onsubmit = function() {
      const contentInput = document.querySelector('#contentInput');
      contentInput.value = quill.root.innerHTML; // Ambil HTML dari editor
    };
  </script>
</body>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
  document.addEventListener("DOMContentLoaded", function() {
    document.querySelector("button.btn-primary").addEventListener("click", function() {
      Swal.fire({
        title: "Konfirmasi Simpan",
        text: "Apakah Anda yakin ingin menyimpan perubahan pada artikel ini?",
        icon: "question",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Ya, Simpan",
        cancelButtonText: "Batal"
      }).then((result) => {
        if (result.isConfirmed) {
          // Pastikan form ditemukan
          let form = document.getElementById("editArticleForm");
          
          if (!form) {
            Swal.fire({
              title: "Error",
              text: "Form tidak ditemukan! Coba refresh halaman.",
              icon: "error",
              confirmButtonColor: "#d33"
            });
            return;
          }

          // Validasi input sebelum submit
          const title = document.getElementById("title").value.trim();
          const content = quill.root.innerHTML.trim();

          if (!title || content === "<p><br></p>") {
            Swal.fire({
              title: "Error",
              text: "Judul dan Konten tidak boleh kosong!",
              icon: "error",
              confirmButtonColor: "#d33"
            });
          } else {
            // Pastikan input hidden memiliki nilai sebelum submit
            document.getElementById("contentInput").value = content;

            // Kirim form dengan cara lebih aman
            setTimeout(() => {
              form.submit();
            }, 300);
          }
        }
      });
    });
  });
</script>
</html>