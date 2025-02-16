<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Manage Articles</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
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
  </style>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<body>
  <!-- Sidebar -->
  <div class="sidebar">
    <h4 class="text-center">Admin Dashboard</h4>
    <a href="{{ url('/dashboard') }}" class="{{ request()->is('dashboard') ? 'active' : '' }}">Dashboard</a>
    <a href="{{ route('articles.index') }}" class="{{ request()->is('articles*') ? 'active' : '' }}">Manage Articles</a>
    
    <!-- Tombol Logout -->
    <a href="#" onclick="confirmLogout()">Logout</a>

    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
        @csrf
    </form>
  </div>

  <!-- Main Content -->
  <div class="content">
    <h3 class="mb-4">Manage Articles</h3>

    <!-- Button to Add New Article -->
    <a href="{{ route('articles.create') }}" class="btn btn-primary mb-3">
        Add New Article
    </a>      

    <!-- Articles Table -->
    <div class="table-responsive">
      <table class="table table-bordered table-striped">
          <thead class="table-dark">
              <tr>
                  <th>No</th>
                  <th>Judul</th>
                  <th>Tanggal Publikasi</th>
                  <th>Aksi</th>
              </tr>
          </thead>
          <tbody>
              @foreach($articles as $index => $article)
              <tr>
                  <td>{{ $index + 1 }}</td>
                  <td>{{ $article->title }}</td>
                  <td>{{ $article->created_at->translatedFormat('j F Y') }}</td>
                  <td>
                      <a href="{{ route('articles.edit', $article->id) }}" class="btn btn-warning btn-sm">Edit</a>
                      
                      <!-- Tombol Hapus dengan Konfirmasi -->
                      <button type="button" class="btn btn-danger btn-sm" onclick="confirmDelete({{ $article->id }})">
                          Delete
                      </button>
                      
                      <!-- Form Hapus (Hidden) -->
                      <form id="delete-form-{{ $article->id }}" action="{{ route('articles.destroy', $article->id) }}" method="POST" class="d-none">
                          @csrf
                          @method('DELETE')
                      </form>
                  </td>
              </tr>
              @endforeach
          </tbody>
      </table>
    </div>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
  <!-- Tambahkan SweetAlert2 -->
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <script>
      function confirmLogout() {
          Swal.fire({
              title: "Konfirmasi Logout",
              text: "Apakah Anda yakin ingin logout?",
              icon: "warning",
              showCancelButton: true,
              confirmButtonColor: "#3085d6",
              cancelButtonColor: "#d33",
              confirmButtonText: "Ya, Logout",
              cancelButtonText: "Batal"
          }).then((result) => {
              if (result.isConfirmed) {
                  document.getElementById('logout-form').submit();
              }
          });
      }

      function confirmDelete(articleId) {
        Swal.fire({
            title: "Konfirmasi Hapus",
            text: "Apakah Anda yakin ingin menghapus artikel ini?",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "Ya, Hapus",
            cancelButtonText: "Batal"
        }).then((result) => {
            if (result.isConfirmed) {
                document.getElementById('delete-form-' + articleId).submit();
            }
        });
    }
  </script>
</body>
</html>