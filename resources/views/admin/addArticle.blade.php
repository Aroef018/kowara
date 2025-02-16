<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Upload Article</title>
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

    #additionalImagesPreview img {
      margin-right: 10px; /* Jarak antar gambar */
      max-height: 100px; /* Tinggi maksimum */
      border: 1px solid #ccc; /* Tambahkan border */
      border-radius: 5px; /* Tambahkan border radius */
    }

  </style>
</head>
<script src="https://cdn.quilljs.com/1.3.7/quill.min.js"></script>
<!-- Tambahkan SweetAlert -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<body>
  <!-- Main Content -->
  <div class="content">
    <button class="btn btn-secondary mb-3" onclick="history.back()">← Back</button>
    <h3 class="mb-4">Upload Article</h3>

    <!-- Form to Upload Article -->
    <form id="uploadArticleForm" action="{{ route('articles.store') }}" method="POST" enctype="multipart/form-data">
      @csrf
      <div class="mb-3">
        <label for="articleTitle" class="form-label">Title</label>
        <input type="text" class="form-control" id="articleTitle" placeholder="Enter article title" name="title" required>
      </div>
    
      <div class="mb-3">
        <label for="articleContent" class="form-label">Content</label>
        <div id="articleContent" style="height: 300px; background-color: white;"></div>
        <input type="hidden" id="contentInput" name="content">
      </div>      
    
      <div class="mb-3">
        <label for="mainImage" class="form-label">Main Image</label>
        <input type="file" class="form-control" id="mainImage" accept="image/*" name="main_image" required onchange="previewImage(event, 'mainImagePreview')">
        <img id="mainImagePreview" class="image-preview" src="" alt="Main Image Preview" style="display: none;">
      </div>
    
      <div class="mb-3">
        <label for="additionalImages" class="form-label">Additional Images</label>
        <input type="file" class="form-control" id="additionalImages" accept="image/*" multiple name="additional_images[]" onchange="previewAdditionalImages(event)">
        <div id="additionalImagesPreview"></div>
      </div>
    
      <button type="submit" class="btn btn-primary">Upload Article</button>
    </form>    
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
  <script>
    // Function to preview the main image
    function previewImage(event, previewId) {
      const reader = new FileReader();
      reader.onload = function() {
        const previewElement = document.getElementById(previewId);
        previewElement.src = reader.result;
        previewElement.style.display = 'block';
      };
      reader.readAsDataURL(event.target.files[0]);
    }

    // Function to preview additional images
    function previewAdditionalImages(event) {
      const previewContainer = document.getElementById('additionalImagesPreview');
      previewContainer.innerHTML = ''; // Clear previous previews

      // Loop melalui semua file yang dipilih
      Array.from(event.target.files).forEach((file) => {
        const reader = new FileReader();
        reader.onload = function () {
          // Buat elemen img untuk setiap gambar
          const imgElement = document.createElement('img');
          imgElement.src = reader.result;
          imgElement.classList.add('image-preview'); // Tambahkan gaya khusus
          imgElement.style.marginRight = '10px'; // Tambahkan jarak antar gambar
          imgElement.style.maxHeight = '100px'; // Tentukan tinggi maksimum

          // Tambahkan elemen img ke container
          previewContainer.appendChild(imgElement);
        };
        reader.readAsDataURL(file); // Baca data file
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

    // Tambahkan konfirmasi sebelum submit
    document.getElementById("uploadArticleForm").onsubmit = function(event) {
      event.preventDefault(); // Mencegah submit otomatis
      
      const title = document.getElementById("articleTitle").value.trim();
      const content = quill.root.innerHTML.trim();
      const contentInput = document.querySelector("#contentInput");
      contentInput.value = content; // Sinkronisasi Quill ke input hidden

      // Validasi sebelum konfirmasi
      if (!title || content === "<p><br></p>") {
        Swal.fire({
          title: "Error",
          text: "Judul dan Konten tidak boleh kosong!",
          icon: "error",
          confirmButtonColor: "#d33"
        });
        return;
      }

      Swal.fire({
        title: "Konfirmasi Upload",
        text: "Apakah Anda yakin ingin mengunggah artikel ini?",
        icon: "question",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Ya, Upload",
        cancelButtonText: "Batal"
      }).then((result) => {
        if (result.isConfirmed) {
          event.target.submit(); // Submit form jika dikonfirmasi
        }
      });
    };
  </script>
</body>
</html>