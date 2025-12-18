<!doctype html>
<html lang="id">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width,initial-scale=1" />
  <title>@yield('title', 'FILKOMIN Dashboard EO')</title>
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

  <style>
    :root{
      --bg: #f4f0e7;
      --paper: #f7ffec;
      --ink: #1b1b1b;
      --muted: #6b6b6b;
      --card: #2b2b2b;
      --card2:#fff;
      --primary:#4f79ff;
      --primary2:#2f5dff;
      --chip:#ffffff;
      --soft:#e9e3d8;
      --placeholder:#d9d9d9;
      --radius-xl: 28px;
      --radius-lg: 20px;
      --radius-md: 14px;
      --shadow: 0 16px 50px rgba(0,0,0,.10);
      --status-pending: #ffd36e;
      --status-approved: #4caf50;
      --status-rejected: #f44336;
      --status-draft: #9e9e9e;
    }

    *{ box-sizing:border-box; }
    html,body{ height:100%; }
    body{
      margin:0;
      font-family:"Poppins", system-ui, -apple-system, Segoe UI, Roboto, Arial, sans-serif;
      background: var(--bg);
      color: var(--ink);
    }

    .wrap{
      width:min(1200px, calc(100% - 56px));
      margin: 28px auto 18px;
      background: var(--paper);
      border-radius: var(--radius-xl);
      padding: 18px 22px 26px;
      box-shadow: var(--shadow);
      display: flex;
      flex-direction: column;
      min-height: calc(100vh - 46px);
    }

    .topbar{
      background: var(--chip);
      border-radius: 999px;
      padding: 10px 14px;
      display:flex;
      align-items:center;
      justify-content:space-between;
      gap:12px;
      margin-bottom: 20px;
    }
    .brand{
      display:flex; align-items:center; gap:10px;
      font-weight:800; letter-spacing:.9px;
    }
    .brand img{ height: 24px; width:auto; display:block; }
    .nav-actions{ display:flex; align-items:center; gap:14px; font-size:12px; }
    .link{ color:#303030; text-decoration:none; font-weight:500; opacity:.9; }

    .btn{
      border:0; cursor:pointer;
      padding: 10px 18px;
      border-radius: 999px;
      font-weight:600;
      font-size:14px;
      line-height:1;
      display:inline-flex; align-items:center; justify-content:center;
      gap:8px;
      transition: transform .08s ease, opacity .2s ease, background .2s ease;
    }
    .btn:active{ transform: translateY(1px); }
    .btn-primary{ background: var(--primary); color:#fff; }
    .btn-primary:hover{ background: var(--primary2); }
    .btn-secondary{ background: #efefef; color:#1d1d1d; }
    .btn-secondary:hover{ background: #e0e0e0; }
    .btn-ghost{
      background:transparent; color:var(--primary);
      padding: 8px 12px;
      font-weight:600;
      font-size:12px;
    }
    .btn:disabled, .btn[disabled]{
      background-color: var(--placeholder);
      color: var(--muted);
      cursor: not-allowed;
      opacity: 0.6;
    }

    .main-layout {
      display: grid;
      grid-template-columns: 250px 1fr;
      gap: 30px;
      flex-grow: 1;
    }

    .sidebar {
      width: 100%;
      background: var(--card);
      padding: 20px;
      border-radius: var(--radius-lg);
      color: white;
    }
    .sidebar .title{
      font-size: 18px;
      font-weight: 700;
      margin-bottom: 20px;
      color: white;
    }
    .sidebar a{
      display: flex;
      align-items: center;
      gap: 12px;
      color: #bdbdbd;
      text-decoration: none;
      padding: 10px 12px;
      font-size: 14px;
      margin: 5px 0;
      border-radius: var(--radius-md);
      transition: background .2s ease, color .2s ease;
    }
    .sidebar a span.icon { font-size: 16px; line-height: 1; }
    .sidebar a.active,
    .sidebar a:hover{
      color: white;
      background: var(--primary);
    }

    .dashboard-content{ padding-top: 0; padding-left: 0; }
    .dashboard-content h1 { margin-top: 0; margin-bottom: 30px; }

    .page-content { display: none; min-height: 500px; }
    .page-content.active { display: block; }

    .empty-state {
      text-align: center;
      padding: 50px 20px;
      border: 2px dashed var(--soft);
      border-radius: var(--radius-lg);
      background: #ffffffa0;
      margin-bottom: 20px;
    }
    .empty-state h2 { font-size: 24px; color: var(--muted); margin-bottom: 10px; }
    .empty-state p { color: var(--muted); margin-bottom: 20px; }

    .event-list-controls {
      display: flex;
      justify-content: space-between;
      align-items: center;
      margin-bottom: 20px;
      gap: 15px;
    }
    .event-list-controls .left, .event-list-controls .right {
      display: flex;
      gap: 10px;
      align-items: center;
    }
    .event-list-controls select, .event-list-controls input[type="text"] {
      padding: 8px 12px;
      border-radius: var(--radius-md);
      border: 1px solid var(--soft);
      background: var(--chip);
      font-size: 14px;
    }

    table{
      width: 100%;
      border-collapse: collapse;
      border-radius: var(--radius-md);
      overflow: hidden;
      box-shadow: 0 4px 12px rgba(0,0,0,.05);
      background: var(--card2);
    }
    table th, table td{
      padding: 14px;
      border: none;
      border-bottom: 1px solid var(--soft);
      text-align: left;
    }
    table th{
      background: var(--soft);
      font-weight: 600;
      color: var(--ink);
      text-transform: uppercase;
      font-size: 12px;
    }
    table tr:last-child td { border-bottom: none; }
    table tbody tr:hover { background: #fafafa; }

    .badge {
      display: inline-block;
      padding: 4px 10px;
      border-radius: 999px;
      font-size: 12px;
      font-weight: 600;
      color: white;
    }
    .badge-pending { background: var(--status-pending); color: var(--ink); }
    .badge-approved { background: var(--status-approved); }
    .badge-rejected { background: var(--status-rejected); }
    .badge-draft { background: var(--status-draft); }

    .simple-card {
      background: var(--chip);
      border-radius: var(--radius-lg);
      padding: 20px;
      box-shadow: 0 4px 12px rgba(0,0,0,.05);
      margin-bottom: 20px;
      border: 1px solid var(--soft);
    }
    .simple-card p { color: var(--muted); margin-top: 0; }
    .simple-card h2 { margin-top: 0; font-size: 20px; }
    .simple-card .icon { margin-right: 8px; }

    .form-group { margin-bottom: 20px; }
    .form-group label {
      display: block;
      font-weight: 600;
      margin-bottom: 5px;
      color: var(--ink);
    }
    .form-group input[type="text"],
    .form-group input[type="file"],
    .form-group input[type="date"],
    .form-group input[type="time"],
    .form-group input[type="email"],
    .form-group select,
    .form-group textarea {
      width: 100%;
      padding: 10px 12px;
      border-radius: var(--radius-md);
      border: 1px solid var(--soft);
      background: var(--card2);
      font-family: "Poppins", sans-serif;
      font-size: 14px;
    }
    .form-group textarea { min-height: 100px; resize: vertical; }
    .form-section-title {
      font-size: 22px;
      font-weight: 700;
      color: var(--primary);
      margin-top: 30px;
      margin-bottom: 15px;
      padding-bottom: 5px;
      border-bottom: 2px solid var(--soft);
    }
    .radio-group label {
      display: inline-flex;
      align-items: center;
      margin-right: 20px;
      font-weight: 400;
      cursor: pointer;
    }

    .template-selector {
      display: flex;
      gap: 20px;
      margin-top: 10px;
      overflow-x: auto;
      padding-bottom: 10px;
    }
    .template-card {
      min-width: 150px;
      padding: 15px;
      border-radius: var(--radius-md);
      border: 2px solid var(--soft);
      text-align: center;
      cursor: pointer;
      transition: all .2s ease;
    }
    .template-card:hover {
      border-color: var(--primary);
      box-shadow: 0 4px 8px rgba(0,0,0,.08);
    }
    .template-card.selected {
      border-color: var(--primary);
      background: #4f79ff15;
      box-shadow: 0 0 0 3px #4f79ff50;
    }
    .template-card h4 { margin: 5px 0 0; font-size: 14px; font-weight: 600; }
    .template-card .icon { font-size: 24px; color: var(--primary); }

    .alert {
      padding: 15px;
      border-radius: var(--radius-md);
      margin-bottom: 20px;
      font-size: 14px;
      font-weight: 500;
    }
    .alert-warning {
      background-color: #fff3cd;
      color: #856404;
      border: 1px solid #ffeeba;
    }
    .alert-danger {
      background-color: #f8d7da;
      color: #721c24;
      border: 1px solid #f5c6cb;
    }
    .alert-success {
      background-color: #d4edda;
      color: #155724;
      border: 1px solid #c3e6cb;
    }
    .alert strong { font-weight: 700; }

    .event-detail-header {
      display: flex;
      justify-content: space-between;
      align-items: center;
      margin-bottom: 20px;
      border-bottom: 1px solid var(--soft);
      padding-bottom: 10px;
    }
    .event-detail-header h2 { margin: 0; font-size: 26px; }
    .event-detail-actions { display: flex; gap: 10px; }
    .event-detail-info {
      display: grid;
      grid-template-columns: 1fr 1fr;
      gap: 20px;
      margin-bottom: 30px;
    }
    .info-block h4 { font-size: 16px; margin-top: 0; margin-bottom: 5px; color: var(--muted); }
    .info-block p { font-size: 16px; margin: 0; color: var(--ink); font-weight: 500;}

    .guest-controls {
      display: flex;
      gap: 10px;
      margin-bottom: 20px;
      justify-content: flex-start;
      flex-wrap: wrap;
    }
    .guest-list-table { margin-top: 20px; }

    .invitation-step {
      padding: 20px;
      border: 1px solid var(--soft);
      border-radius: var(--radius-md);
      margin-bottom: 15px;
      background: var(--card2);
    }
    .invitation-step-title {
      font-size: 18px;
      font-weight: 700;
      color: var(--primary);
      margin-bottom: 10px;
    }
    .message-editor {
      width: 100%;
      height: 150px;
      padding: 10px;
      border-radius: var(--radius-md);
      border: 1px solid var(--soft);
      resize: none;
      font-family: monospace;
      font-size: 14px;
    }
    .preview-box {
      background: #e9f5ff;
      border: 1px solid #cce5ff;
      padding: 15px;
      border-radius: var(--radius-md);
      white-space: pre-wrap;
      font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
      font-size: 14px;
      color: #004085;
    }

    .qr-section { text-align: center; padding: 40px; }
    .qr-section .qr-placeholder {
      width: 200px;
      height: 200px;
      background: var(--placeholder);
      margin: 20px auto;
      border-radius: var(--radius-md);
      display: flex;
      align-items: center;
      justify-content: center;
      font-weight: 600;
      color: var(--ink);
      overflow: hidden;
    }

    .footer{
      width:min(980px, calc(100% - 56px));
      margin: 10px auto 0;
      background: transparent;
      padding: 12px 8px;
      display:flex;
      justify-content:space-between;
      align-items:flex-start;
      gap: 24px;
      color:#2a2a2a;
    }
    .foot-left{ max-width: 340px; }
    .foot-brand{
      display:flex;
      align-items:center;
      gap:10px;
      margin-bottom: 8px;
    }
    .foot-brand img{ height: 24px; width:auto; display:block; }
    .foot-left p{
      margin: 0 0 10px;
      font-size: 11px;
      line-height:1.6;
      color:#666;
      font-weight:500;
    }
    .copyright{
      font-size: 10px;
      color:#777;
      font-weight:500;
    }
    .foot-right{ max-width: 300px; text-align:left; }
    .foot-right .title{ font-size: 18px; font-weight:800; margin-bottom: 8px; }
    .insta-list{ margin: 0; padding-left: 18px; font-size: 12px; color: #333; }
    .insta-list li{ margin: 4px 0; }
    .insta-list a{ color: #4f79ff; text-decoration: none; }
    .insta-list a:hover{ text-decoration: underline; }
    .social{ display:flex; gap:10px; margin-top: 10px; }
    .ico{
      width: 26px; height: 26px;
      border-radius: 999px;
      border: 1px solid rgba(0,0,0,.12);
      display:flex; align-items:center; justify-content:center;
      font-weight:800;
      font-size: 12px;
      color:#222;
      background: rgba(255,255,255,.6);
    }

    @media (max-width: 860px){
      .main-layout{ grid-template-columns: 1fr; }
      .event-detail-info { grid-template-columns: 1fr; }
      .footer{ flex-direction:column; width: 100%; margin: 10px 0 0; }
      .event-list-controls { flex-direction: column; align-items: stretch; }
      .event-list-controls .left, .event-list-controls .right { flex-direction: column; align-items: stretch; }
    }
  </style>
</head>
<body>
<main class="wrap">
  <header class="topbar">
    <div class="brand">
      <img
        src="https://images-wixmp-ed30a86b8c4ca887773594c2.wixmp.com/f/429fa1fa-304f-4a41-a6d1-c5dfc602e8d2/dl2tro7-b82d4d25-02fa-4843-abfd-244ea4faf4ab.png?token=eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJzdWIiOiJ1cm46YXBwOjdlMGQxODg5ODIyNjQzNzNhNWYwZDQxNWVhMGQyNmUwIiwiaXNzIjoidXJuOmFwcDo3ZTBkMTg4OTgyMjY0MzczYTVmMGQ0MTVlYTBkMjZlMCIsIm9iaiI6W1t7InBhdGgiOiIvZi80MjlmYTFmYS0zMDRmLTRhNDEtYTZkMS1jNWRmYzYwMmU4ZDIvZGwydHJvNy1iODJkNGQyNS0wMmZhLTQ4NDMtYWJmZC0yNDRlYTRmYWY0YWIucG5nIn1dXSwiYXVkIjpbInVybjpzZXJ2aWNlOmZpbGUuZG93bmxvYWQiXX0.JoGIQfUsi8w8QyK8aY7EjS8Qv5Lcoee0Gz0g_Q7axA0"
        alt="FILKOMIN Logo"
        referrerpolicy="no-referrer"
      />
    </div>
    <nav class="nav-actions">
      <a class="link" href="#">Log out</a>
      <button class="btn btn-primary" type="button">Settings</button>
    </nav>
  </header>

  <div class="main-layout">
    <aside class="sidebar">
      <div class="title">EO Navigation</div>

      <a href="#" class="nav-link active" data-page="event-list-content">
        <span class="icon"><i class="fas fa-calendar-alt"></i></span> Event List
      </a>
      <a href="#" class="nav-link" data-page="create-event-content">
        <span class="icon"><i class="fas fa-plus-circle"></i></span> Create Event
      </a>

      <a href="#" id="guest-management-sidebar-link" class="nav-link" style="display:none;" data-page="guest-management-content">
        <span class="icon"><i class="fas fa-users"></i></span> Manage Guests
      </a>
      <a href="#" id="qr-checkin-sidebar-link" class="nav-link" style="display:none;" data-page="qr-checkin-content">
        <span class="icon"><i class="fas fa-qrcode"></i></span> QR Check-In
      </a>
      <a href="#" id="rsvp-monitoring-sidebar-link" class="nav-link" style="display:none;" data-page="rsvp-monitoring-content">
        <span class="icon"><i class="fas fa-chart-pie"></i></span> RSVP Monitoring
      </a>
      <a href="#" id="send-invitations-sidebar-link" class="nav-link" style="display:none;" data-page="send-invitations-content">
        <span class="icon"><i class="fas fa-paper-plane"></i></span> Send Invitations
      </a>
    </aside>

    <section class="dashboard-content">
      <h1 id="dashboard-title">Event Organizer Dashboard</h1>

      <!-- EVENT LIST -->
      <div id="event-list-content" class="page-content active">
        <div class="event-list-controls">
          <div class="left">
            <select id="event-filter" onchange="filterEvents()">
              <option value="All">All</option>
              <option value="Pending">Pending</option>
              <option value="Approved">Approved</option>
              <option value="Rejected">Rejected</option>
              <option value="Draft">Draft</option>
            </select>
            <input type="text" id="event-search" onkeyup="filterEvents()" placeholder="Search event title...">
          </div>
          <div class="right">
            <button class="btn btn-primary" type="button" onclick="goCreateEvent()">
              <i class="fas fa-plus"></i> Create New Event
            </button>
          </div>
        </div>

        <div id="event-list-container">
          <div class="empty-state">
            <h2>No events yet.</h2>
            <p>Start by creating your first event to manage your guests and invitations.</p>
            <button class="btn btn-primary" type="button" onclick="goCreateEvent()">
              <i class="fas fa-plus"></i> Create New Event
            </button>
          </div>
        </div>
      </div>

      <!-- CREATE EVENT -->
      <div id="create-event-content" class="page-content">
        <div class="simple-card">
          <h2><i class="fas fa-clipboard-list"></i> Create New Event</h2>
          <form id="create-event-form" onsubmit="handleEventSubmission(event)">
            <div class="form-section-title">A. Basic Event Info</div>

            <div class="form-group">
              <label for="event-title">Event Title*</label>
              <input type="text" id="event-title" required>
            </div>

            <div class="form-group">
              <label for="event-category">Event Category*</label>
              <select id="event-category" required onchange="toggleOtherInput(this, 'other-category-input')">
                <option value="">Select Category</option>
                <option value="Seminar">Seminar</option>
                <option value="Workshop">Workshop</option>
                <option value="Talkshow">Talkshow</option>
                <option value="Competition">Competition</option>
                <option value="Meeting">Meeting</option>
                <option value="Other">Other</option>
              </select>
              <input type="text" id="other-category-input" placeholder="Specify other category" style="display:none; margin-top:10px;">
            </div>

            <div class="form-group">
              <label for="organizer-name">Organizer Name*</label>
              <input type="text" id="organizer-name" required>
            </div>

            <div class="form-group">
              <label for="organizer-unit">Organizer Unit*</label>
              <select id="organizer-unit" required onchange="toggleOtherInput(this, 'other-unit-input')">
                <option value="">Select Unit</option>
                <option value="FILKOM">FILKOM</option>
                <option value="BEM">BEM</option>
                <option value="HMJ">HMJ</option>
                <option value="UKM">UKM</option>
                <option value="Department">Department</option>
                <option value="Other">Other</option>
              </select>
              <input type="text" id="other-unit-input" placeholder="Specify other unit" style="display:none; margin-top:10px;">
            </div>

            <div class="form-group">
              <label for="description">Description*</label>
              <textarea id="description" required></textarea>
            </div>

            <div class="form-group">
              <label for="poster-banner">Poster/Banner</label>
              <input type="file" id="poster-banner" accept="image/jpeg,image/png">
            </div>

            <div class="form-section-title">B. Schedule & Location</div>

            <div class="form-group">
              <label for="date">Date*</label>
              <input type="date" id="date" required>
            </div>

            <div style="display:flex; gap:20px;">
              <div class="form-group" style="flex:1;">
                <label for="start-time">Start Time*</label>
                <input type="time" id="start-time" required>
              </div>
              <div class="form-group" style="flex:1;">
                <label for="end-time">End Time (Optional)</label>
                <input type="time" id="end-time">
              </div>
            </div>

            <div class="form-group">
              <label>Location Type*</label>
              <div class="radio-group">
                <label><input type="radio" name="location-type" value="On-site" required onchange="toggleLocationFields('On-site')"> On-site</label>
                <label><input type="radio" name="location-type" value="Online" onchange="toggleLocationFields('Online')"> Online</label>
                <label><input type="radio" name="location-type" value="Hybrid" onchange="toggleLocationFields('Hybrid')"> Hybrid</label>
              </div>
            </div>

            <div class="form-group" id="venue-group" style="display:none;">
              <label for="venue">Venue / Address*</label>
              <input type="text" id="venue" placeholder="e.g. Ruang Rapat A, Gedung FILKOM">
            </div>

            <div class="form-group" id="online-link-group" style="display:none;">
              <label for="online-link">Online Link*</label>
              <input type="text" id="online-link" placeholder="e.g. https://meet.google.com/xyz123">
            </div>

            <div class="form-section-title">C. Invitation Details</div>

            <div class="form-group">
              <label for="dress-code">Dress Code (Optional)</label>
              <input type="text" id="dress-code" placeholder="e.g. Batik Formal, Casual Rapi">
            </div>

            <div class="form-group">
              <label for="additional-notes">Additional Notes (Optional)</label>
              <textarea id="additional-notes" placeholder="e.g. Area parkir tersedia di belakang gedung, Meja registrasi di lobby"></textarea>
            </div>

            <div class="form-section-title">D. Template Selection</div>

            <div class="form-group">
              <label>Invitation Template*</label>
              <div class="template-selector">
                <div class="template-card selected" data-template="Formal" onclick="selectTemplate(this)">
                  <div class="icon">👔</div><h4>Formal</h4>
                </div>
                <div class="template-card" data-template="Semi-Formal" onclick="selectTemplate(this)">
                  <div class="icon">👖</div><h4>Semi-Formal</h4>
                </div>
                <div class="template-card" data-template="Speaker" onclick="selectTemplate(this)">
                  <div class="icon">📣</div><h4>Speaker Invitation</h4>
                </div>
              </div>
              <input type="hidden" id="invitation-template" value="Formal" required>
            </div>

            <div class="form-group">
              <button class="btn btn-ghost" type="button"
                onclick="alert('Template Preview for: ' + document.getElementById('invitation-template').value)">
                <i class="fas fa-eye"></i> Preview Template
              </button>
            </div>

            <div class="form-section-title">E. Contact & Approval</div>

            <div class="form-group">
              <label for="pic-name">PIC Name*</label>
              <input type="text" id="pic-name" required>
            </div>

            <div class="form-group">
              <label for="pic-whatsapp">PIC WhatsApp Number*</label>
              <input type="text" id="pic-whatsapp" placeholder="e.g. 6281234567890 (tanpa +)"
                required pattern="[0-9]{10,15}" title="Format: hanya angka, 10-15 digit (diawali 62)">
            </div>

            <div class="form-group">
              <label for="pic-email">PIC Email (Optional)</label>
              <input id="pic-email" type="email" placeholder="e.g. nama@email.com">
            </div>

            <div class="form-group">
              <label for="request-notes">Request Notes to Admin (Optional)</label>
              <textarea id="request-notes" placeholder="e.g. Need approval ASAP, Urgent event"></textarea>
            </div>

            <div style="display:flex; justify-content:flex-end; gap:10px; margin-top:30px;">
              <button class="btn btn-secondary" type="button" onclick="handleEventSubmission(event,'Draft')">
                <i class="fas fa-save"></i> Save as Draft
              </button>
              <button class="btn btn-primary" type="submit">
                <i class="fas fa-paper-plane"></i> Submit for Approval
              </button>
            </div>
          </form>
        </div>
      </div>

      <!-- EVENT DETAIL -->
      <div id="event-detail-content" class="page-content">
        <button class="btn btn-ghost" onclick="showPage('event-list-content')">
          <i class="fas fa-arrow-left"></i> Back to List
        </button>

        <div class="event-detail-header">
          <h2 id="detail-event-title"></h2>
          <div class="event-detail-actions"></div>
        </div>

        <div id="event-detail-alert-box"></div>

        <div class="simple-card">
          <h3>Event Information</h3>
          <div class="event-detail-info">
            <div class="info-block">
              <h4>Status</h4>
              <p id="detail-event-status"></p>
            </div>
            <div class="info-block">
              <h4>Date & Time</h4>
              <p id="detail-event-datetime"></p>
            </div>
            <div class="info-block">
              <h4>Location</h4>
              <p id="detail-event-location"></p>
            </div>
            <div class="info-block">
              <h4>Template</h4>
              <p id="detail-event-template"></p>
            </div>
            <div class="info-block" style="grid-column:1 / -1;">
              <h4>Admin Notes</h4>
              <p id="detail-admin-notes"></p>
            </div>
          </div>
          <p><strong>Description:</strong> <span id="detail-description"></span></p>
          <p><strong>PIC:</strong> <span id="detail-pic-contact"></span></p>
        </div>

        <div id="event-detail-guest-summary" class="simple-card" style="display:none;">
          <h3>Guest & RSVP Summary</h3>
          <div id="event-guest-summary-info"></div>
          <div style="max-width:300px; margin:26px auto;">
            <canvas id="detailRsvpChart"></canvas>
          </div>
        </div>
      </div>

      <!-- GUEST MANAGEMENT -->
      <div id="guest-management-content" class="page-content">
        <h2><i class="fas fa-users"></i> Guest Management - <span id="guest-event-title"></span></h2>
        <div class="simple-card">
          <h3>Add & Import Guests</h3>
          <div class="guest-controls">
            <input type="text" id="add-guest-name" placeholder="Name">
            <input type="text" id="add-guest-whatsapp" placeholder="WhatsApp (62...)">
            <input type="email" id="add-guest-email" placeholder="Email (Optional)">
            <button class="btn btn-secondary" onclick="addGuest()"><i class="fas fa-user-plus"></i> Add Guest</button>
          </div>

          <div class="guest-controls">
            <label for="import-csv" style="margin-right:10px;">Import CSV:</label>
            <input type="file" id="import-csv" accept=".csv" style="flex-grow:1;">
            <button class="btn btn-secondary" onclick="importCsv()"><i class="fas fa-upload"></i> Import</button>
          </div>

          <h3 style="margin-top:30px;">Guest List</h3>
          <div class="event-list-controls">
            <div class="left">
              <select id="guest-filter-rsvp" onchange="filterGuests()">
                <option value="All">All RSVP Status</option>
                <option value="Confirmed">Confirmed</option>
                <option value="Pending">Pending (Not Responded)</option>
                <option value="Not Attending">Not Attending</option>
                <option value="Checked In">Checked In</option>
              </select>
            </div>
            <div class="right">
              <input type="text" id="guest-search" onkeyup="filterGuests()" placeholder="Search guest name...">
            </div>
          </div>

          <div class="guest-list-table">
            <table id="guest-list-table">
              <thead>
                <tr>
                  <th>Name</th>
                  <th>WhatsApp</th>
                  <th>Email</th>
                  <th>RSVP Status</th>
                  <th>Actions</th>
                </tr>
              </thead>
              <tbody></tbody>
            </table>
          </div>
        </div>
      </div>

      <!-- SEND INVITATIONS -->
      <div id="send-invitations-content" class="page-content">
        <h2><i class="fas fa-paper-plane"></i> Send Invitations - <span id="invite-event-title"></span></h2>
        <div class="simple-card">

          <div class="invitation-step">
            <div class="invitation-step-title">Step A: Select Recipients</div>
            <p>Current Event Guests: <span id="total-guests-count"></span></p>
            <div style="display:flex; gap:10px; align-items:center;">
              <label for="recipient-filter">Filter:</label>
              <select id="recipient-filter" onchange="filterRecipients()" style="padding:8px;">
                <option value="Not Invited Yet">Not Invited Yet</option>
                <option value="All Guests">All Guests</option>
                <option value="Not Responded">Not Responded</option>
                <option value="Confirmed">RSVP Yes</option>
                <option value="Not Attending">RSVP No</option>
              </select>
              <input type="text" id="recipient-search" onkeyup="filterRecipients()" placeholder="Search name..." style="flex-grow:1;">
            </div>

            <div style="margin-top:15px; max-height:200px; overflow-y:auto; border:1px solid var(--soft); padding:10px; border-radius:var(--radius-md);">
              <label>
                <input type="checkbox" id="select-all-recipients" onclick="toggleSelectAll(this)">
                Select All (<span id="filtered-recipients-count"></span> selected)
              </label>
              <ul id="recipient-list" style="list-style:none; padding:0; margin:10px 0 0;"></ul>
            </div>
          </div>

          <div class="invitation-step">
            <div class="invitation-step-title">Step B: Message Configuration</div>
            <div class="form-group">
              <label for="message-type">Message Type</label>
              <select id="message-type" onchange="loadMessageTemplate()" style="width:100%;">
                <option value="Default">Default Invitation</option>
                <option value="Reminder">Reminder (24-Hour)</option>
                <option value="Custom">Custom Message</option>
              </select>
            </div>
            <div class="form-group">
              <label for="message-editor">Message Text (Variables: [GuestName], [EventTitle], [InvitationLink])</label>
              <textarea id="message-editor" class="message-editor" onkeyup="updatePreview()"></textarea>
            </div>
          </div>

          <div class="invitation-step">
            <div class="invitation-step-title">Step C: Preview & Confirm</div>
            <p><strong>Preview for: [GuestName]</strong></p>
            <div class="preview-box" id="message-preview"></div>
            <div style="margin-top:15px;">
              <label><input type="checkbox" id="confirm-send"> I confirm the message is correct and I am ready to send invitations via WhatsApp.</label>
            </div>
          </div>

          <div style="text-align:right; margin-top:20px;">
            <button class="btn btn-primary" type="button" onclick="sendInvitations()" id="send-invitations-btn" disabled>
              <i class="fab fa-whatsapp"></i> Send Invitation via WhatsApp
            </button>
          </div>

        </div>
      </div>

      <!-- QR CHECKIN -->
      <div id="qr-checkin-content" class="page-content">
        <h2><i class="fas fa-qrcode"></i> QR Check-In - <span id="qr-event-title"></span></h2>
        <div class="simple-card qr-section">
          <p>Tampilkan QR Code unik acara yang dapat dipindai oleh panitia untuk validasi kehadiran.</p>
          <div class="qr-placeholder">
            <img src="https://api.qrserver.com/v1/create-qr-code/?size=200x200&data=FILKOMIN-2025-EVENT_TOKEN"
                 alt="QR Code" style="width:100%; height:100%; border-radius:var(--radius-md);"/>
          </div>
          <p>Kode Verifikasi Event: <b>FILKOMIN-2025</b></p>
          <p>Total Checked In: <b id="checked-in-count">0</b> / <b id="total-guest-count-qr">0</b></p>
          <button class="btn btn-primary" type="button" onclick="alert('Simulasi Refresh Code')">
            <i class="fas fa-sync-alt"></i> Refresh Code
          </button>
        </div>

        <div class="simple-card">
          <h3>Check-In List (Real-time)</h3>
          <table id="check-in-table">
            <thead>
              <tr>
                <th>Name</th>
                <th>Check-In Time</th>
                <th>Status</th>
              </tr>
            </thead>
            <tbody></tbody>
          </table>
        </div>
      </div>

      <!-- RSVP MONITORING -->
      <div id="rsvp-monitoring-content" class="page-content">
        <div class="simple-card">
          <h2><i class="fas fa-chart-pie"></i> RSVP Monitoring &amp; Analytics - <span id="rsvp-event-title"></span></h2>
          <p>Visualisasi status RSVP tamu berdasarkan data undangan.</p>

          <div style="max-width:420px; margin:26px auto;">
            <canvas id="rsvpMonitoringChart"></canvas>
          </div>

          <table style="margin-top:20px;">
            <thead>
              <tr>
                <th>Total Undangan</th>
                <th>Confirmed</th>
                <th>Pending Response</th>
                <th>Not Attending</th>
              </tr>
            </thead>
            <tbody id="rsvp-monitoring-table-body">
              <tr><td></td><td></td><td></td><td></td></tr>
            </tbody>
          </table>
        </div>
      </div>

      <footer class="footer">
        <div class="foot-left">
          <div class="foot-brand" aria-label="FILKOMIN footer logo">
            <img
              src="https://images-wixmp-ed30a86b8c4ca887773594c2.wixmp.com/f/429fa1fa-304f-4a41-a6d1-c5dfc602e8d2/dl2tro7-b82d4d25-02fa-4843-abfd-244ea4faf4ab.png?token=eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJzdWIiOiJ1cm46YXBwOjdlMGQxODg5ODIyNjQzNzNhNWYwZDQxNWVhMGQyNmUwIiwiaXNzIjoidXJuOmFwcDo3ZTBkMTg4OTgyMjY0MzczYTVmMGQ0MTVlYTBkMjZlMCIsIm9iaiI6W1t7InBhdGgiOiIvZi80MjlmYTFmYS0zMDRmLTRhNDEtYTZkMS1jNWRmYzYwMmU4ZDIvZGwydHJvNy1iODJkNGQyNS0wMmZhLTQ4NDMtYWJmZC0yNDRlYTRmYWY0YWIucG5nIn1dXSwiYXVkIjpbInVybjpzZXJ2aWNlOmZpbGUuZG93bmxvYWQiXX0.JoGIQfUsi8w8QyK8aY7EjS8Qv5Lcoee0Gz0g_Q7axA0"
              alt="FILKOMIN"
              referrerpolicy="no-referrer"
            />
          </div>
          <p>An integrated platform designed to support academic and institutional activities at FILKOM</p>
          <div class="copyright">© 2025 Faculty of Computer Science, Brawijaya University</div>
        </div>

        <div class="foot-right">
          <div class="title">Catch us on insta!</div>
          <ul class="insta-list">
            <li><a href="https://instagram.com/adeliapel" target="_blank" rel="noopener">@adeliapel</a></li>
            <li><a href="https://instagram.com/depikan" target="_blank" rel="noopener">@depikan</a></li>
            <li><a href="https://instagram.com/dipantat" target="_blank" rel="noopener">@dipantat</a></li>
          </ul>

          <div class="social" aria-label="social links">
            <div class="ico" title="Instagram">⌁</div>
            <div class="ico" title="LinkedIn">in</div>
            <div class="ico" title="Twitter/X">x</div>
          </div>
        </div>
      </footer>

    </section>
  </div>
</main>

<script>
  // --- DATA SIMULATION (Database Mock) ---
  let events = [
    { id: 1, title: "Web Dev Workshop 2025", date: "2025-12-20", time: "09:00", status: "Approved", template: "Semi-Formal", adminNotes: "Approved. Please proceed with guest list and invitations.", category: "Workshop", organizer: "FILKOM", locationType: "Hybrid", venue: "Gedung A, Lt. 5", onlineLink: "https://zoom.us/webinar/123", pic: "Adelia Pel", picWa: "6281234567890", picEmail: "adelia@filkomin.com", lastUpdated: "2025-11-25 10:30" },
    { id: 2, title: "Inaugurasi FILKOM", date: "2026-01-15", time: "18:00", status: "Pending", template: "Formal", adminNotes: "Waiting for review", category: "Meeting", organizer: "BEM", locationType: "On-site", venue: "Ballroom UB", onlineLink: "", pic: "Dino Ganteng", picWa: "6285678901234", picEmail: "", lastUpdated: "2025-12-10 14:00" },
    { id: 3, title: "Alumni Gathering", date: "2025-11-10", time: "10:00", status: "Rejected", template: "Formal", adminNotes: "Poster resolution too low (max 1080p required). Please update and resubmit.", category: "Other: Gathering", organizer: "Other: Alumni", locationType: "On-site", venue: "Hotel Merdeka", onlineLink: "", pic: "Fulan", picWa: "628111222333", picEmail: "", lastUpdated: "2025-11-12 16:45" },
    { id: 4, title: "Draft Proposal", date: "2026-03-01", time: "13:00", status: "Draft", template: "Formal", adminNotes: "—", category: "Meeting", organizer: "Department", locationType: "Online", venue: "", onlineLink: "https://gmeet.com/abc", pic: "Test Draft", picWa: "628777666555", picEmail: "", lastUpdated: "2025-12-13 18:00" }
  ];

  let guests = {
    1: [
      { id: 101, name: "John Doe", whatsapp: "628121111000", email: "john@mail.com", rsvpStatus: "Confirmed", invited: true, checkedIn: true, checkInTime: "2025-12-20 08:50" },
      { id: 102, name: "Jane Smith", whatsapp: "628122222000", email: "jane@mail.com", rsvpStatus: "Pending", invited: true, checkedIn: false, checkInTime: null },
      { id: 103, name: "Peter Parker", whatsapp: "628123333000", email: "peter@mail.com", rsvpStatus: "Not Attending", invited: true, checkedIn: false, checkInTime: null },
      { id: 104, name: "Mary Jane", whatsapp: "628124444000", email: "mj@mail.com", rsvpStatus: "Confirmed", invited: false, checkedIn: false, checkInTime: null }
    ],
    2: [],
    3: [],
    4: []
  };

  let currentEventId = null;

  // --- NAV HELPERS ---
  function setActiveSidebar(pageId) {
    document.querySelectorAll('.sidebar a').forEach(a => a.classList.remove('active'));
    const link = document.querySelector(`.sidebar a[data-page="${pageId}"]`);
    if (link) link.classList.add('active');
  }

  function showPage(pageId) {
    document.querySelectorAll('.page-content').forEach(p => p.classList.remove('active'));
    const el = document.getElementById(pageId);
    if (el) el.classList.add('active');

    setActiveSidebar(pageId);

    const isDetailPage = ['event-detail-content','guest-management-content','qr-checkin-content','rsvp-monitoring-content','send-invitations-content'].includes(pageId);
    ['guest-management-sidebar-link','qr-checkin-sidebar-link','rsvp-monitoring-sidebar-link','send-invitations-sidebar-link']
      .forEach(id => {
        const link = document.getElementById(id);
        if (link) link.style.display = isDetailPage ? 'flex' : 'none';
      });

    if (pageId === 'event-list-content') {
      renderEventList();
      document.getElementById('dashboard-title').textContent = "Event Organizer Dashboard";
    }

    if (pageId === 'create-event-content') {
      const form = document.getElementById('create-event-form');
      form.reset();
      document.getElementById('dashboard-title').textContent = "Create New Event";
      toggleLocationFields('none');
      selectTemplate(document.querySelector('.template-selector [data-template="Formal"]'));
    }

    if (pageId === 'rsvp-monitoring-content' && currentEventId) {
      renderRsvpMonitoring(currentEventId);
    }

    if (pageId === 'qr-checkin-content' && currentEventId) {
      renderCheckInList();
    }

    if (pageId === 'guest-management-content' && currentEventId) {
      renderGuestList();
    }

if (pageId === 'send-invitations-content' && currentEventId) {
  renderRecipients();
  updatePreview();

  const confirmBox = document.getElementById('confirm-send');
  if (confirmBox) confirmBox.checked = false;

  wireSendInvitationConfirm(); // ✅ AKTIFKAN TOMBOL
}

  }

  function goCreateEvent() {
    showPage('create-event-content');
  }
function wireSendInvitationConfirm() {
  const confirmBox = document.getElementById('confirm-send');
  const sendBtn = document.getElementById('send-invitations-btn');
  if (!confirmBox || !sendBtn) return;

  // Hindari listener dobel
  if (!confirmBox.dataset.wired) {
    confirmBox.addEventListener('change', () => {
      sendBtn.disabled = !confirmBox.checked;
    });
    confirmBox.dataset.wired = "1";
  }

  // Sinkronkan state sekarang (penting!)
  sendBtn.disabled = !confirmBox.checked;
}

document.addEventListener('DOMContentLoaded', () => {
  document.querySelectorAll('.nav-link').forEach(a => {
    a.addEventListener('click', (e) => {
      e.preventDefault();
      const page = a.getAttribute('data-page');
      if (!page) return;

      if (['guest-management-content','qr-checkin-content','rsvp-monitoring-content','send-invitations-content'].includes(page)) {
        if (!currentEventId) return;
      }

      showPage(page);
    });
  });

  wireSendInvitationConfirm(); // ✅ PENTING
  showPage('event-list-content');
});

  // --- EVENT LIST ---
  function renderEventList() {
    const container = document.getElementById('event-list-container');
    const filterValue = document.getElementById('event-filter').value;
    const searchValue = document.getElementById('event-search').value.toLowerCase();

    const filteredEvents = events.filter(ev => {
      const statusMatch = (filterValue === 'All') || (ev.status === filterValue);
      const searchMatch = ev.title.toLowerCase().includes(searchValue);
      return statusMatch && searchMatch;
    });

    if (events.length === 0) {
      container.innerHTML = `
        <div class="empty-state">
          <h2>No events yet.</h2>
          <p>Start by creating your first event to manage your guests and invitations.</p>
          <button class="btn btn-primary" type="button" onclick="goCreateEvent()">
            <i class="fas fa-plus"></i> Create New Event
          </button>
        </div>
      `;
      return;
    }

    let tableHTML = `
      <table>
        <thead>
          <tr>
            <th>Event Title</th>
            <th>Date</th>
            <th>Template</th>
            <th>Status</th>
            <th>Last Updated</th>
            <th>Actions</th>
          </tr>
        </thead>
        <tbody>
    `;

    if (filteredEvents.length === 0) {
      tableHTML += `<tr><td colspan="6" style="text-align:center;">No events match the current filter and search criteria.</td></tr>`;
    } else {
      filteredEvents.forEach(ev => {
        const badgeClass = `badge-${ev.status.toLowerCase().replace(/\s+/g,'-')}`;
        const actionButtons = `
          <button class="btn btn-primary btn-ghost" onclick="viewEventDetail(${ev.id})"><i class="fas fa-eye"></i> View</button>
          ${(ev.status === 'Draft' || ev.status === 'Pending') ? `<button class="btn btn-secondary btn-ghost" onclick="editEvent(${ev.id})"><i class="fas fa-edit"></i> Edit</button>` : ''}
          ${(ev.status === 'Rejected') ? `<button class="btn btn-primary btn-ghost" onclick="editEvent(${ev.id})"><i class="fas fa-sync-alt"></i> Resubmit</button>` : ''}
        `;
        tableHTML += `
          <tr>
            <td>${ev.title}</td>
            <td>${ev.date}</td>
            <td>${ev.template}</td>
            <td><span class="badge ${badgeClass}">${ev.status}</span></td>
            <td>${ev.lastUpdated}</td>
            <td>${actionButtons}</td>
          </tr>
        `;
      });
    }

    tableHTML += `</tbody></table>`;
    container.innerHTML = tableHTML;
  }

  function filterEvents(){ renderEventList(); }

  // --- CREATE EVENT ---
  function toggleOtherInput(selectElement, inputId) {
    const input = document.getElementById(inputId);
    if (selectElement.value === 'Other') {
      input.style.display = 'block';
      input.setAttribute('required', 'required');
    } else {
      input.style.display = 'none';
      input.removeAttribute('required');
      input.value = '';
    }
  }

  function toggleLocationFields(type) {
    const venueGroup = document.getElementById('venue-group');
    const onlineLinkGroup = document.getElementById('online-link-group');
    const venueInput = document.getElementById('venue');
    const onlineLinkInput = document.getElementById('online-link');

    venueGroup.style.display = (type === 'On-site' || type === 'Hybrid') ? 'block' : 'none';
    onlineLinkGroup.style.display = (type === 'Online' || type === 'Hybrid') ? 'block' : 'none';

    if (type === 'On-site' || type === 'Hybrid') venueInput.setAttribute('required','required');
    else venueInput.removeAttribute('required');

    if (type === 'Online' || type === 'Hybrid') onlineLinkInput.setAttribute('required','required');
    else onlineLinkInput.removeAttribute('required');
  }

  function selectTemplate(card) {
    document.querySelectorAll('.template-card').forEach(c => c.classList.remove('selected'));
    if (!card) return;
    card.classList.add('selected');
    document.getElementById('invitation-template').value = card.dataset.template || 'Formal';
  }

  function handleEventSubmission(ev, action = 'Pending') {
    ev.preventDefault();
    const form = document.getElementById('create-event-form');
    if (!form.checkValidity()) { form.reportValidity(); return; }

    const eventTitle = document.getElementById('event-title').value;

    let eventCategory = document.getElementById('event-category').value;
    if (eventCategory === 'Other') {
      eventCategory = 'Other: ' + document.getElementById('other-category-input').value;
    }

    let organizerUnit = document.getElementById('organizer-unit').value;
    if (organizerUnit === 'Other') {
      organizerUnit = 'Other: ' + document.getElementById('other-unit-input').value;
    }

    const locationTypeEl = document.querySelector('input[name="location-type"]:checked');
    const locationType = locationTypeEl ? locationTypeEl.value : 'On-site';

    const newEvent = {
      id: events.length ? (Math.max(...events.map(e => e.id)) + 1) : 1,
      title: eventTitle,
      category: eventCategory,
      organizer: document.getElementById('organizer-name').value,
      organizerUnit: organizerUnit,
      description: document.getElementById('description').value,
      date: document.getElementById('date').value,
      time: document.getElementById('start-time').value,
      endTime: document.getElementById('end-time').value,
      locationType: locationType,
      venue: document.getElementById('venue').value,
      onlineLink: document.getElementById('online-link').value,
      dressCode: document.getElementById('dress-code').value,
      additionalNotes: document.getElementById('additional-notes').value,
      template: document.getElementById('invitation-template').value,
      pic: document.getElementById('pic-name').value,
      picWa: document.getElementById('pic-whatsapp').value,
      picEmail: document.getElementById('pic-email').value,
      requestNotes: document.getElementById('request-notes').value,
      status: (action === 'Draft') ? 'Draft' : 'Pending',
      adminNotes: (action === 'Draft') ? '—' : 'Waiting for review',
      lastUpdated: new Date().toLocaleString('id-ID', {
        year:'numeric', month:'2-digit', day:'2-digit', hour:'2-digit', minute:'2-digit'
      })
    };

    events.push(newEvent);
    guests[newEvent.id] = [];
    form.reset();
    alert(`Event "${newEvent.title}" saved as ${newEvent.status}.`);
    showPage('event-list-content');
  }

  function editEvent(id) {
    const eventToEdit = events.find(e => e.id === id);
    if (!eventToEdit) return;

    showPage('create-event-content');

    document.getElementById('event-title').value = eventToEdit.title;
    document.getElementById('date').value = eventToEdit.date;
    document.getElementById('start-time').value = eventToEdit.time || '';
    document.getElementById('end-time').value = eventToEdit.endTime || '';

    alert(`Editing/Resubmitting event ID ${id}: "${eventToEdit.title}".`);
  }

  // --- EVENT DETAIL ---
  function viewEventDetail(id) {
    const ev = events.find(e => e.id === id);
    if (!ev) return;

    currentEventId = id;
    showPage('event-detail-content');

    document.getElementById('dashboard-title').textContent = ev.title + " Details";
    document.getElementById('detail-event-title').textContent = ev.title;

    const badgeClass = `badge-${ev.status.toLowerCase().replace(/\s+/g,'-')}`;
    document.getElementById('detail-event-status').innerHTML = `<span class="badge ${badgeClass}">${ev.status}</span>`;

    const datetimeText = ev.date + " " + ev.time + (ev.endTime ? (" - " + ev.endTime) : "");
    document.getElementById('detail-event-datetime').textContent = datetimeText;

    let locationText = ev.locationType || '';
    if (ev.locationType === 'On-site' || ev.locationType === 'Hybrid') {
      locationText += ` (Venue: ${ev.venue || '-'})`;
    }
    if (ev.locationType === 'Online' || ev.locationType === 'Hybrid') {
      const link = ev.onlineLink ? (ev.onlineLink.length > 30 ? ev.onlineLink.substring(0,30) + "..." : ev.onlineLink) : '-';
      locationText += ` (Online: ${link})`;
    }
    document.getElementById('detail-event-location').textContent = locationText;

    document.getElementById('detail-event-template').textContent = ev.template || '-';
    document.getElementById('detail-admin-notes').textContent = ev.adminNotes || '-';
    document.getElementById('detail-description').textContent = ev.description || '-';
    document.getElementById('detail-pic-contact').textContent =
      `${ev.pic || '-'} (WA: ${ev.picWa || '-'}, Email: ${ev.picEmail || 'N/A'})`;

    const actionContainer = document.querySelector('.event-detail-actions');
    actionContainer.innerHTML = '';

    const alertBox = document.getElementById('event-detail-alert-box');
    alertBox.innerHTML = '';

    if (ev.status === 'Approved') {
      actionContainer.innerHTML = `
        <button class="btn btn-secondary" onclick="prepareGuestManagement(${id})"><i class="fas fa-users"></i> Manage Guests</button>
        <button class="btn btn-primary" onclick="prepareSendInvitation(${id})"><i class="fas fa-paper-plane"></i> Send Invitation</button>
        <button class="btn btn-ghost" onclick="alert('Simulasi Download PDF Invitation')"><i class="fas fa-file-pdf"></i> Download PDF</button>
      `;
      document.getElementById('event-detail-guest-summary').style.display = 'block';
      renderGuestSummary(id);
    } else {
      if (ev.status === 'Pending') {
        alertBox.innerHTML = `<div class="alert alert-warning"><strong>Pending Approval:</strong> Your request is currently under review by the Admin. No actions are available yet.</div>`;
      } else if (ev.status === 'Rejected') {
        alertBox.innerHTML = `<div class="alert alert-danger"><strong>Rejected:</strong> Please update the event details based on the Admin Notes and click Resubmit on the Event List page. <strong>Admin Notes:</strong> ${ev.adminNotes}</div>`;
        actionContainer.innerHTML = `<button class="btn btn-secondary" onclick="editEvent(${id})" disabled><i class="fas fa-edit"></i> Edit / Resubmit</button>`;
      } else if (ev.status === 'Draft') {
        alertBox.innerHTML = `<div class="alert alert-warning"><strong>Draft:</strong> This event is saved as a Draft. Submit for Approval when ready to proceed.</div>`;
        actionContainer.innerHTML = `
          <button class="btn btn-primary" onclick="handleDraftSubmission(${id})"><i class="fas fa-paper-plane"></i> Submit for Approval</button>
          <button class="btn btn-secondary" onclick="editEvent(${id})"><i class="fas fa-edit"></i> Edit</button>
        `;
      }
      document.getElementById('event-detail-guest-summary').style.display = 'none';
    }

    document.getElementById('guest-management-sidebar-link').innerHTML = `<span class="icon"><i class="fas fa-users"></i></span> Manage Guests (${ev.title})`;
    document.getElementById('qr-checkin-sidebar-link').innerHTML = `<span class="icon"><i class="fas fa-qrcode"></i></span> QR Check-In (${ev.title})`;
    document.getElementById('rsvp-monitoring-sidebar-link').innerHTML = `<span class="icon"><i class="fas fa-chart-pie"></i></span> RSVP Monitoring (${ev.title})`;
    document.getElementById('send-invitations-sidebar-link').innerHTML = `<span class="icon"><i class="fas fa-paper-plane"></i></span> Send Invitations (${ev.title})`;
  }

  function renderGuestSummary(eventId) {
    const eventGuests = guests[eventId] || [];
    const total = eventGuests.length;
    const confirmed = eventGuests.filter(g => g.rsvpStatus === 'Confirmed').length;
    const pending = eventGuests.filter(g => g.rsvpStatus === 'Pending').length;
    const notAttending = eventGuests.filter(g => g.rsvpStatus === 'Not Attending').length;
    const checkedIn = eventGuests.filter(g => g.checkedIn).length;

    document.getElementById('event-guest-summary-info').innerHTML = `
      <p><strong>Total Guests:</strong> ${total}</p>
      <p><strong>Confirmed (RSVP Yes):</strong> ${confirmed}</p>
      <p><strong>Pending Response:</strong> ${pending}</p>
      <p><strong>Checked In:</strong> ${checkedIn}</p>
    `;

    const canvas = document.getElementById('detailRsvpChart');
    if (window.detailRsvpChart) window.detailRsvpChart.destroy();

    window.detailRsvpChart = new Chart(canvas, {
      type: 'doughnut',
      data: {
        labels: ['Confirmed', 'Pending Response', 'Not Attending', 'Checked In'],
        datasets: [{
          data: [confirmed, pending, notAttending, checkedIn],
          backgroundColor: ['#4caf50', '#ffd36e', '#f44336', '#4f79ff'],
          borderWidth: 1
        }]
      },
      options: { responsive:true, plugins:{ legend:{ position:'bottom' } } }
    });
  }

  function handleDraftSubmission(id) {
    const ev = events.find(e => e.id === id);
    if (!ev) return;
    ev.status = 'Pending';
    ev.adminNotes = 'Waiting for review';
    ev.lastUpdated = new Date().toLocaleString('id-ID', {
      year:'numeric', month:'2-digit', day:'2-digit', hour:'2-digit', minute:'2-digit'
    });
    alert(`Event "${ev.title}" has been submitted for approval.`);
    viewEventDetail(id);
  }

  // --- GUEST MANAGEMENT ---
  function prepareGuestManagement(id) {
    const ev = events.find(e => e.id === id);
    if (!ev) return;
    currentEventId = id;
    document.getElementById('guest-event-title').textContent = ev.title;
    showPage('guest-management-content');
    renderGuestList();
  }

  function addGuest() {
    const name = document.getElementById('add-guest-name').value.trim();
    const whatsapp = document.getElementById('add-guest-whatsapp').value.trim();
    const email = document.getElementById('add-guest-email').value.trim();

    if (!name || !whatsapp) { alert("Name and WhatsApp number are required."); return; }
    if (whatsapp.length < 10 || !/^\d+$/.test(whatsapp)) {
      alert("WhatsApp number must be 10-15 digits, digits only (start with 62).");
      return;
    }

    const newGuest = {
      id: Date.now(),
      name,
      whatsapp,
      email,
      rsvpStatus: "Pending",
      invited: false,
      checkedIn: false,
      checkInTime: null
    };

    if (!guests[currentEventId]) guests[currentEventId] = [];
    guests[currentEventId].push(newGuest);

    renderGuestList();

    document.getElementById('add-guest-name').value = '';
    document.getElementById('add-guest-whatsapp').value = '';
    document.getElementById('add-guest-email').value = '';

    alert(`${name} added to the guest list.`);
  }

  function importCsv() {
    const fileInput = document.getElementById('import-csv');
    if (fileInput.files.length === 0) { alert("Please select a CSV file to import."); return; }
    alert(`Simulasi: File ${fileInput.files[0].name} imported successfully. (New guests added to list)`);
    fileInput.value = '';
  }

  function renderGuestList() {
    const tableBody = document.querySelector('#guest-list-table tbody');
    tableBody.innerHTML = '';

    const eventGuests = guests[currentEventId] || [];
    const filterRsvp = document.getElementById('guest-filter-rsvp').value;
    const search = document.getElementById('guest-search').value.toLowerCase();

    const filteredGuests = eventGuests.filter(g => {
      const rsvpMatch =
        filterRsvp === 'All' ||
        g.rsvpStatus === filterRsvp ||
        (filterRsvp === 'Checked In' && g.checkedIn);
      const searchMatch = (g.name || '').toLowerCase().includes(search) || (g.whatsapp || '').includes(search);
      return rsvpMatch && searchMatch;
    });

    if (filteredGuests.length === 0) {
      tableBody.innerHTML = `<tr><td colspan="5" style="text-align:center;">No guests found.</td></tr>`;
      return;
    }

    filteredGuests.forEach(guest => {
      const checkedInDisplay = guest.checkedIn && guest.checkInTime
        ? `<br><span style="color: var(--status-approved); font-size:12px;">Checked In: ${guest.checkInTime.split(' ')[1]}</span>`
        : '';

      let badgeBg = 'var(--status-draft)';
      if (guest.checkedIn) badgeBg = 'var(--primary)';
      else if (guest.rsvpStatus === 'Confirmed') badgeBg = 'var(--status-approved)';
      else if (guest.rsvpStatus === 'Not Attending') badgeBg = 'var(--status-rejected)';
      else if (guest.rsvpStatus === 'Pending' && guest.invited) badgeBg = '#ffd36e';

      const row = tableBody.insertRow();
      row.innerHTML = `
        <td>${guest.name}</td>
        <td>${guest.whatsapp}</td>
        <td>${guest.email || 'N/A'}</td>
        <td>
          <span class="badge" style="background:${badgeBg}; color:${badgeBg === '#ffd36e' ? 'var(--ink)' : '#fff'};">
            ${guest.rsvpStatus}
          </span>
          ${checkedInDisplay}
        </td>
        <td>
          <button class="btn btn-secondary btn-ghost" onclick="alert('Simulasi Edit Guest: ${guest.name}')">
            <i class="fas fa-edit"></i>
          </button>
          <button class="btn btn-ghost" style="color: var(--status-rejected);" onclick="deleteGuest(${guest.id})">
            <i class="fas fa-trash"></i>
          </button>
        </td>
      `;
    });
  }

  function filterGuests(){ renderGuestList(); }

  function deleteGuest(guestId) {
    if (!confirm("Are you sure you want to delete this guest?")) return;
    guests[currentEventId] = (guests[currentEventId] || []).filter(g => g.id !== guestId);
    renderGuestList();
    alert("Guest deleted.");
  }

  // --- SEND INVITATIONS ---
function prepareSendInvitation(id) {
  const ev = events.find(e => e.id === id);
  if (!ev) return;

  currentEventId = id;
  document.getElementById('invite-event-title').textContent = ev.title;

  showPage('send-invitations-content');

  loadMessageTemplate();
  renderRecipients();
  updatePreview();

  const confirmBox = document.getElementById('confirm-send');
  if (confirmBox) confirmBox.checked = false;

  wireSendInvitationConfirm(); // ✅ SATU-SATUNYA PENGATUR
}

  function loadMessageTemplate() {
    const ev = events.find(e => e.id === currentEventId);
    const template = document.getElementById('message-type').value;
    const editor = document.getElementById('message-editor');

    const linkPlaceholder = '[InvitationLink]';
    let message = '';

    if (template === 'Default') {
      message = `Halo [GuestName],\n\nKami mengundang Anda untuk menghadiri [EventTitle] yang diselenggarakan oleh ${ev ? ev.organizer : ''}!\n\nMohon konfirmasi kehadiran Anda melalui link berikut: ${linkPlaceholder}\n\nTerima kasih!`;
    } else if (template === 'Reminder') {
      message = `Reminder: [EventTitle] akan diadakan 24 jam lagi!\n\nPastikan Anda sudah RSVP di link ini: ${linkPlaceholder}\n\nSampai jumpa besok, [GuestName]!`;
    } else {
      message = `Pesan kustom Anda di sini... (Gunakan [GuestName], [EventTitle], [InvitationLink])`;
    }

    editor.value = message;
    updatePreview();
  }

  function renderRecipients() {
    const list = document.getElementById('recipient-list');
    const totalCount = document.getElementById('total-guests-count');
    const filteredCount = document.getElementById('filtered-recipients-count');
    list.innerHTML = '';

    const eventGuests = guests[currentEventId] || [];
    totalCount.textContent = eventGuests.length;

    const filterValue = document.getElementById('recipient-filter').value;
    const searchValue = document.getElementById('recipient-search').value.toLowerCase();

    const filteredRecipients = eventGuests.filter(g => {
      const searchMatch = (g.name || '').toLowerCase().includes(searchValue);
      let filterMatch = true;

      if (filterValue === 'Not Invited Yet') filterMatch = !g.invited;
      else if (filterValue === 'Not Responded') filterMatch = g.invited && g.rsvpStatus === 'Pending';
      else if (filterValue === 'Confirmed') filterMatch = g.rsvpStatus === 'Confirmed';
      else if (filterValue === 'Not Attending') filterMatch = g.rsvpStatus === 'Not Attending';

      return searchMatch && filterMatch;
    });

    filteredRecipients.forEach(guest => {
      const statusBadge = guest.invited ? ` (Status: ${guest.rsvpStatus})` : ' (Not Invited)';
      const li = document.createElement('li');
      li.style.marginBottom = '5px';
      li.innerHTML = `
        <label>
          <input type="checkbox" name="recipient" value="${guest.id}" data-whatsapp="${guest.whatsapp}" checked>
          ${guest.name} (${guest.whatsapp}) ${statusBadge}
        </label>
      `;
      list.appendChild(li);
    });

    filteredCount.textContent = filteredRecipients.length;
  }

  function filterRecipients(){ renderRecipients(); }

  function toggleSelectAll(checkbox) {
    document.querySelectorAll('#recipient-list input[name="recipient"]').forEach(cb => {
      cb.checked = checkbox.checked;
    });
  }

  function updatePreview() {
    const ev = events.find(e => e.id === currentEventId);
    const editorVal = document.getElementById('message-editor').value;

    const previewText = editorVal
      .replace(/\[GuestName\]/g, 'John Doe')
      .replace(/\[EventTitle\]/g, ev ? ev.title : '')
      .replace(/\[InvitationLink\]/g, 'https://filkomin.ub.ac.id/rsvp?token=XYZ-SIMULASI-TOKEN');

    document.getElementById('message-preview').textContent = previewText;
  }

  function sendInvitations() {
    if (!document.getElementById('confirm-send').checked) {
      alert("Please confirm the message before sending.");
      return;
    }

    const selectedRecipients = Array.from(document.querySelectorAll('#recipient-list input[name="recipient"]:checked'));
    if (selectedRecipients.length === 0) {
      alert("Please select at least one recipient.");
      return;
    }

    const messageTemplate = document.getElementById('message-editor').value;
    const ev = events.find(e => e.id === currentEventId);
    const whatsappLinks = [];

    selectedRecipients.forEach(checkbox => {
      const guestId = parseInt(checkbox.value, 10);
      const guest = (guests[currentEventId] || []).find(g => g.id === guestId);
      if (!guest || !ev) return;

      const uniqueToken = `FILKOMIN-${ev.id}-${guest.id}-${Date.now()}`;
      const invitationLink = `https://filkomin.ub.ac.id/rsvp?token=${uniqueToken}`;

      const finalMessage = messageTemplate
        .replace(/\[GuestName\]/g, guest.name)
        .replace(/\[EventTitle\]/g, ev.title)
        .replace(/\[InvitationLink\]/g, invitationLink);

      const waUrl = `whatsapp://send?phone=${guest.whatsapp}&text=${encodeURIComponent(finalMessage)}`;
      whatsappLinks.push({ name: guest.name, url: waUrl });

      guest.invited = true;
    });

    if (whatsappLinks.length > 0) {
      alert(`Redirecting to WhatsApp for ${whatsappLinks.length} recipients... Please click SEND on each chat window.`);
      window.open(whatsappLinks[0].url, '_blank');

      setTimeout(() => {
        alert("Simulasi: First message sent. Returning to Event Detail.");
        viewEventDetail(currentEventId);
      }, 1200);
    }
  }

  // --- QR CHECKIN + RSVP MONITORING ---
  function renderCheckInList() {
    const eventGuests = guests[currentEventId] || [];
    const checkedIn = eventGuests.filter(g => g.checkedIn);

    document.getElementById('checked-in-count').textContent = checkedIn.length;
    document.getElementById('total-guest-count-qr').textContent = eventGuests.length;

    const tableBody = document.querySelector('#check-in-table tbody');
    tableBody.innerHTML = '';

    checkedIn.sort((a,b) => new Date(b.checkInTime) - new Date(a.checkInTime));

    if (checkedIn.length === 0) {
      tableBody.innerHTML = `<tr><td colspan="3" style="text-align:center;">No guests have checked in yet.</td></tr>`;
      return;
    }

    checkedIn.forEach(g => {
      const t = g.checkInTime ? g.checkInTime.split(' ')[1] : '-';
      const row = tableBody.insertRow();
      row.innerHTML = `
        <td>${g.name}</td>
        <td>${t}</td>
        <td><span class="badge badge-approved">Checked In</span></td>
      `;
    });
  }

  function renderRsvpMonitoring(eventId) {
    const ev = events.find(e => e.id === eventId);
    if (!ev) return;

    document.getElementById('rsvp-event-title').textContent = ev.title;

    const eventGuests = guests[eventId] || [];
    const total = eventGuests.length;
    const confirmed = eventGuests.filter(g => g.rsvpStatus === 'Confirmed').length;
    const pending = eventGuests.filter(g => g.rsvpStatus === 'Pending').length;
    const notAttending = eventGuests.filter(g => g.rsvpStatus === 'Not Attending').length;

    document.getElementById('rsvp-monitoring-table-body').innerHTML = `
      <tr>
        <td>${total}</td>
        <td>${confirmed}</td>
        <td>${pending}</td>
        <td>${notAttending}</td>
      </tr>
    `;

    const ctx = document.getElementById('rsvpMonitoringChart');
    if (window.rsvpMonitoringChart) window.rsvpMonitoringChart.destroy();

    window.rsvpMonitoringChart = new Chart(ctx, {
      type: 'doughnut',
      data: {
        labels: ['Confirmed', 'Pending Response', 'Not Attending'],
        datasets: [{
          data: [confirmed, pending, notAttending],
          backgroundColor: ['#4caf50', '#ffd36e', '#f44336'],
          borderWidth: 0
        }]
      },
      options: {
        responsive: true,
        plugins: {
          legend: { position: 'bottom' },
          tooltip: {
            callbacks: {
              label: function(context){
                const val = context.parsed;
                const pct = total ? Math.round((val / total) * 100) : 0;
                return ` ${context.label}: ${val} (${pct}%)`;
              }
            }
          }
        },
        cutout: '65%'
      }
    });
  }
