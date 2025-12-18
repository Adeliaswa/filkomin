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
  </style>
</head>

<body>
  <main class="wrap">

    {{-- TOPBAR --}}
    <header class="topbar">
      <div class="brand">
        <strong>FILKOMIN</strong>
      </div>

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

    </div>
  </main>
</body>
</html>
