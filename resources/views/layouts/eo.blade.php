<!doctype html>
<html lang="id">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width,initial-scale=1" />
  <title>FILKOMIN Dashboard EO</title>

  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

  <style>
    * { box-sizing: border-box; }
    html, body { height: 100%; }
    body {
      margin: 0;
      font-family: "Poppins", sans-serif;
      background: #f4f0e7;
    }

    .wrap {
      width: min(1200px, calc(100% - 56px));
      margin: 28px auto;
      background: #f7ffec;
      border-radius: 28px;
      padding: 18px 22px 26px;
      display: flex;
      flex-direction: column;
      min-height: calc(100vh - 56px);
    }

    /* TOPBAR */
    .topbar {
      background: #fff;
      border-radius: 999px;
      padding: 10px 14px;
      display: flex;
      justify-content: space-between;
      align-items: center;
      margin-bottom: 20px;
      z-index: 1000;
      position: relative;
    }

    .nav-actions {
      display: flex;
      gap: 12px;
      align-items: center;
    }

    .btn {
      border: 0;
      cursor: pointer;
      padding: 10px 18px;
      border-radius: 999px;
      font-weight: 600;
      font-size: 14px;
    }

    .btn-primary {
      background: #4f79ff;
      color: white;
    }

    /* LAYOUT */
    .main-layout {
      display: grid;
      grid-template-columns: 250px 1fr;
      gap: 30px;
      flex-grow: 1;
    }

    /* SIDEBAR */
    .sidebar {
      background: #2b2b2b;
      color: white;
      padding: 20px;
      border-radius: 20px;
      z-index: 1000;
      position: relative;
    }

    .sidebar .title {
      font-size: 18px;
      font-weight: 700;
      margin-bottom: 20px;
    }

    .sidebar a,
    .sidebar button {
      display: flex;
      align-items: center;
      gap: 12px;
      color: #bdbdbd;
      text-decoration: none;
      padding: 10px 12px;
      font-size: 14px;
      border-radius: 14px;
      width: 100%;
      background: none;
      border: none;
      cursor: pointer;
      text-align: left;
    }

    .sidebar a:hover,
    .sidebar a.active,
    .sidebar button:hover {
      background: #4f79ff;
      color: white;
    }

    .dashboard-content {
      padding: 10px;
    }

        /* FOOTER */
/* Footer Styles */
    .dashboard-footer {
      margin-top: auto;
      padding-top: 30px;
    }

    .footer-content {
      background: var(--card);
      border-radius: var(--radius-lg);
      padding: 25px 30px;
      display: flex;
      flex-wrap: wrap;
      align-items: center;
      justify-content: space-between;
      gap: 20px;
    }

    .footer-brand {
      display: flex;
      align-items: center;
      gap: 12px;
    }

    .footer-logo {
      height: 28px;
      width: auto;
    }

    .footer-title {
      font-weight: 700;
      font-size: 16px;
      color: white;
      letter-spacing: 0.5px;
    }

    .footer-social {
      display: flex;
      gap: 15px;
    }

    .social-link {
      width: 36px;
      height: 36px;
      border-radius: 50%;
      background: rgba(255, 255, 255, 0.1);
      display: flex;
      align-items: center;
      justify-content: center;
      color: #bdbdbd;
      text-decoration: none;
      transition: all 0.2s ease;
    }

    .social-link:hover {
      background: var(--primary);
      color: white;
      transform: translateY(-2px);
    }

    .footer-copy {
      font-size: 12px;
      color: #888;
      text-align: center;
      width: 100%;
    }


  </style>
</head>

<body>


  <main class="wrap">

    {{-- TOPBAR --}}
    <header class="topbar">


      <div class="nav-actions">
        {{-- LOGOUT (POST, WAJIB) --}}
        <form method="POST" action="{{ route('logout') }}">
          @csrf
          <button type="submit" class="btn btn-primary">
            Logout
          </button>
        </form>
      </div>
    </header>

    {{-- MAIN --}}
    <div class="main-layout">

      {{-- SIDEBAR --}}
      <aside class="sidebar">
  <div class="title">EO Navigation</div>

  <a href="{{ route('eo.dashboard') }}"
     class="{{ request()->routeIs('eo.dashboard') ? 'active' : '' }}">
    <i class="fas fa-calendar-alt"></i>
    Event List
  </a>

  <a href="{{ route('eo.events.create') }}"
     class="{{ request()->routeIs('eo.events.*') ? 'active' : '' }}">
    <i class="fas fa-plus-circle"></i>
    Create Event
  </a>
</aside>



      {{-- CONTENT --}}
      <section class="dashboard-content">
        @yield('content')
      </section>

    </div> {{-- end main-layout --}}


    <footer class="dashboard-footer">
      <div class="footer-content">
        <div class="footer-brand">
          <img
            src="https://images-wixmp-ed30a86b8c4ca887773594c2.wixmp.com/f/429fa1fa-304f-4a41-a6d1-c5dfc602e8d2/dl2tro7-b82d4d25-02fa-4843-abfd-244ea4faf4ab.png?token=eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJzdWIiOiJ1cm46YXBwOjdlMGQxODg5ODIyNjQzNzNhNWYwZDQxNWVhMGQyNmUwIiwiaXNzIjoidXJuOmFwcDo3ZTBkMTg4OTgyMjY0MzczYTVmMGQ0MTVlYTBkMjZlMCIsIm9iaiI6W1t7InBhdGgiOiIvZi80MjlmYTFmYS0zMDRmLTRhNDEtYTZkMS1jNWRmYzYwMmU4ZDIvZGwydHJvNy1iODJkNGQyNS0wMmZhLTQ4NDMtYWJmZC0yNDRlYTRmYWY0YWIucG5nIn1dXSwiYXVkIjpbInVybjpzZXJ2aWNlOmZpbGUuZG93bmxvYWQiXX0.JoGIQfUsi8w8QyK8aY7EjS8Qv5Lcoee0Gz0g_Q7axA0"
            alt="FILKOMIN" class="footer-logo" referrerpolicy="no-referrer" />
          <span class="footer-title"></span>
        </div>
        <div class="footer-social">
          <a href="#" class="social-link" title="Instagram"><i class="fab fa-instagram"></i></a>
          <a href="#" class="social-link" title="Twitter"><i class="fab fa-twitter"></i></a>
          <a href="#" class="social-link" title="YouTube"><i class="fab fa-youtube"></i></a>
        </div>
        <div class="footer-copy">
          &copy; {{ date('Y') }} FILKOMIN - Event Organizer System. All rights reserved.
        </div>
              </div>
    </footer>

    </main>

</body>

</html>