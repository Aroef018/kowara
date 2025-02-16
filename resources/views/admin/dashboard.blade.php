<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Dashboard Admin</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    /* Sidebar styling */
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

    .content {
      margin-left: 250px; /* Offset to match sidebar width */
      padding: 20px;
    }

    .header {
      background-color: #f8f9fa;
      padding: 15px 20px;
      border-bottom: 1px solid #ddd;
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
    <!-- Header -->
    <div class="header d-flex justify-content-between align-items-center">
      <h3>Welcome, Admin</h3>
      <button class="btn btn-primary">Profile</button>
    </div>

    <!-- Dashboard Overview -->
    <div class="container mt-4">
      <h4>Overview</h4>
      <div class="row g-4">
        <div class="col-md-3">
          <div class="card text-center shadow-sm">
            <div class="card-body">
              <h5 class="card-title">Users</h5>
              <p class="card-text fs-4">150</p>
              <a href="#users" class="btn btn-outline-primary">View</a>
            </div>
          </div>
        </div>
        <div class="col-md-3">
          <div class="card text-center shadow-sm">
            <div class="card-body">
              <h5 class="card-title">Articles</h5>
              <p class="card-text fs-4">45</p>
              <a href="#articles" class="btn btn-outline-primary">View</a>
            </div>
          </div>
        </div>
        <div class="col-md-3">
          <div class="card text-center shadow-sm">
            <div class="card-body">
              <h5 class="card-title">Comments</h5>
              <p class="card-text fs-4">200</p>
              <a href="#comments" class="btn btn-outline-primary">View</a>
            </div>
          </div>
        </div>
        <div class="col-md-3">
          <div class="card text-center shadow-sm">
            <div class="card-body">
              <h5 class="card-title">Visits</h5>
              <p class="card-text fs-4">1,250</p>
              <a href="#visits" class="btn btn-outline-primary">View</a>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- Recent Activity -->
    <div class="container mt-5">
      <h4>Recent Activities</h4>
      <ul class="list-group">
        <li class="list-group-item">User <strong>John Doe</strong> added a new article.</li>
        <li class="list-group-item">Admin updated system settings.</li>
        <li class="list-group-item">New user <strong>Jane Smith</strong> registered.</li>
        <li class="list-group-item">User <strong>Mike</strong> commented on an article.</li>
      </ul>
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
  </script>
</body>
</html>