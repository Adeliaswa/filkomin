<!doctype html>
<html lang="id">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>@yield('title', 'FILKOMIN Landing')</title>

    <!-- Poppins Font -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">

    <style>
    :root{
      --bg: #f4f0e7;
      --paper: #f7f4ee;
      --ink: #1b1b1b;
      --muted: #6b6b6b;
      --card: #2b2b2b;
      --card2:#3a3333;
      --primary:#4f79ff;
      --primary2:#2f5dff;
      --chip:#ffffff;
      --soft:#e9e3d8;
      --placeholder:#d9d9d9;
      --radius-xl: 28px;
      --radius-lg: 20px;
      --radius-md: 14px;
      --shadow: 0 16px 50px rgba(0,0,0,.10);
    }

    *{ box-sizing:border-box; }
    html,body{ height:100%; }
    body{
      margin:0;
      font-family:"Poppins", system-ui, -apple-system, Segoe UI, Roboto, Arial, sans-serif;
      background: var(--bg);
      color: var(--ink);
    }

    /* page frame */
    .wrap{
      width:min(980px, calc(100% - 56px));
      margin: 28px auto 18px;
      background: var(--paper);
      border-radius: var(--radius-xl);
      padding: 18px 22px 26px;
      box-shadow: var(--shadow);
    }

    /* top nav */
    .topbar{
      background: var(--chip);
      border-radius: 999px;
      padding: 10px 14px;
      display:flex;
      align-items:center;
      justify-content:space-between;
      gap:12px;
    }
    .brand{
      display:flex; align-items:center; gap:10px;
      font-weight:800; letter-spacing:.9px;
    }
    .brand img{
      height: 24px;  /* Sesuaikan ukuran agar teks tetap terbaca jelas */
      width: auto;
      display:block;
    }
    .nav-actions{
      display:flex; align-items:center; gap:14px;
      font-size:12px;
    }
    .link{
      color:#303030; text-decoration:none; font-weight:500;
      opacity:.9;
    }
    .btn{
      border:0; cursor:pointer;
      padding: 8px 14px;
      border-radius: 999px;
      font-weight:600;
      font-size:12px;
      line-height:1;
      display:inline-flex; align-items:center; justify-content:center;
      gap:8px;
      transition: transform .08s ease, opacity .2s ease;
    }
    .btn:active{ transform: translateY(1px); }
    .btn-primary{ background: var(--primary); color:#fff; }
    .btn-primary:hover{ background: var(--primary2); }
    .btn-ghost{
      background:#efefef; color:#1d1d1d;
      padding: 8px 14px;
      font-weight:600;
    }

    /* hero */
    .hero{
      text-align:center;
      padding: 28px 10px 18px;
    }
    .hero h1{
      margin: 8px 0 12px;
      font-size: clamp(30px, 5vw, 44px);
      line-height:1.05;
      font-weight:900;
      letter-spacing:-.7px;
    }
    .hero p{
      max-width: 560px;
      margin: 0 auto 16px;
      color: var(--muted);
      font-size: 12.5px;
      line-height:1.55;
      font-weight:500;
    }
    .hero .cta{
      display:flex; justify-content:center; gap:12px;
      margin: 12px 0 18px;
    }
    .hero .collab{
      margin-top: 10px;
      font-size: 12px;
      font-weight:700;
      color:#2a2a2a;
    }
    .hero .filkom-logo{
      display:flex; align-items:center; justify-content:center;
      margin-top: 10px;
      gap:10px;
    }
    .hero .filkom-logo img{
      height: 40px;  /* Ukuran logo agar jelas */
      width: auto;
      display:block;
    }

    .emoji-badge{
      width: 32px; height: 32px;
      display:inline-flex; align-items:center; justify-content:center;
      border-radius: 10px;
      background:#fff;
      border: 2px solid #1e1e1e20;
      box-shadow: 0 10px 18px rgba(0,0,0,.08);
      transform: rotate(-6deg);
    }
    .emoji-row{
      display:flex; justify-content:center; gap:14px;
      margin-top: 6px;
    }
    .emoji-row .emoji-badge:nth-child(2){ transform: rotate(7deg); }

    /* dark how it works */
    .how{
      margin: 18px auto 8px;
      background: #1e1f1f;
      border-radius: var(--radius-xl);
      padding: 22px 18px 18px;
      color:#fff;
    }
    .how h2{
      margin: 2px 0 18px;
      text-align:center;
      font-size: 30px;
      font-weight:900;
      letter-spacing:-.6px;
    }
    .how-grid{
      display:grid;
      grid-template-columns: repeat(3, 1fr);
      gap: 14px;
    }
    .step{
      background: #3a3232;
      border-radius: 14px;
      padding: 14px;
      position:relative;
      min-height: 176px;
      overflow:hidden;
    }
    .step .top{
      display:flex;
      align-items:flex-start;
      justify-content:space-between;
      gap:10px;
      margin-bottom: 10px;
    }
    .step .title{
      font-size: 12px;
      font-weight:800;
      line-height:1.2;
      opacity:.95;
    }
    .step .ext{
      width: 22px; height: 22px;
      border-radius: 8px;
      background: rgba(255,255,255,.08);
      display:flex; align-items:center; justify-content:center;
      font-weight:900;
      font-size: 14px;
    }

    /* mock images inside cards */
    .mock{
      border-radius: 12px;
      background: rgba(255,255,255,.08);
      height: 118px;
      position:relative;
      overflow:hidden;
    }
    .mock.create::before{
      content:"";
      position:absolute; left:14px; top:16px;
      width:26px; height:26px; border-radius:9px;
      background:#8aa4ff;
      box-shadow: 46px 0 0 #5fe1c4, 92px 0 0 #ffd36e;
      opacity:.95;
    }
    .mock.create::after{
      content:"";
      position:absolute; left:14px; right:14px; bottom:16px;
      height: 20px; border-radius: 10px;
      background:#9cf0cf;
      opacity:.85;
    }
    .mock.invite{
      background: rgba(255,255,255,.10);
    }
    .mock.invite::before{
      content:"";
      position:absolute; left:16px; top:14px;
      width: 72%; height: 82%;
      background:#f3f3f3;
      border-radius: 10px;
    }
    .mock.invite::after{
      content:"";
      position:absolute; left:26px; top:28px;
      width: 54%; height: 8px;
      background:#c8c8c8;
      border-radius: 99px;
      box-shadow:
        0 18px 0 #d7d7d7,
        0 36px 0 #e2e2e2,
        0 64px 0 #d7d7d7;
    }
    .mock.qr::before{
      content:"";
      position:absolute; right:14px; top:16px;
      width: 88px; height: 88px;
      border-radius: 10px;
      background:
        linear-gradient(90deg, rgba(255,255,255,.9) 0 0) 0 0/14px 14px,
        linear-gradient(90deg, rgba(0,0,0,.0) 0 0) 0 0/14px 14px;
      background-color:#f6f6f6;
      box-shadow: inset 0 0 0 10px #f6f6f6;
      outline: 6px solid #f6f6f6;
    }
    .mock.qr::after{
      content:"";
      position:absolute; left:14px; right:120px; bottom:18px;
      height: 8px; border-radius: 99px;
      background: rgba(255,255,255,.22);
      box-shadow: 0 -18px 0 rgba(255,255,255,.16);
    }

    /* alternating feature rows */
    .features{ padding: 10px 6px 0; }
    .row{
      display:grid;
      grid-template-columns: 1.05fr 1.35fr;
      gap: 28px;
      align-items:center;
      padding: 22px 8px;
    }
    .row.reverse{ grid-template-columns: 1.35fr 1.05fr; }
    .kicker{
      font-size: 11px;
      font-weight:600;
      color:#616161;
      margin-bottom: 6px;
    }
    .row h3{
      font-size: 22px;
      line-height:1.15;
      margin: 0 0 10px;
      font-weight:900;
      letter-spacing:-.4px;
    }
    .row p{
      margin: 0 0 14px;
      color:#6a6a6a;
      font-size: 12.5px;
      line-height:1.6;
      font-weight:500;
      max-width: 360px;
    }
    .btn-dark{
      background:#262626;
      color:#fff;
      padding: 10px 14px;
      font-size: 11px;
      font-weight:700;
      border-radius: 999px;
    }
    .placeholder{
      background: var(--placeholder);
      border-radius: 10px;
      height: 168px;
      width: 100%;
    }

    /* CTA dark banner */
    .cta2{
      width:min(980px, calc(100% - 56px));
      margin: 14px auto 0;
      background:#2b2323;
      border-radius: var(--radius-xl);
      padding: 38px 18px 22px;
      color:#fff;
      text-align:center;
      box-shadow: var(--shadow);
    }
    .cta2 .mini-emoji{
      display:flex; justify-content:center; gap:10px;
      margin-bottom: 10px;
    }
    .cta2 h2{
      margin: 6px 0 14px;
      font-size: clamp(26px, 4vw, 40px);
      line-height:1.05;
      font-weight:900;
      letter-spacing:-.6px;
    }
    .cta2 .sub{
      display:flex; justify-content:center; gap:12px;
      font-size: 11px;
      color: rgba(255,255,255,.70);
      margin-top: 10px;
      font-weight:600;
    }

    /* footer */
    .footer{
      width:min(980px, calc(100% - 56px));
      margin: 10px auto 26px;
      background: transparent;
      padding: 12px 8px;
      display:flex;
      justify-content:space-between;
      align-items:flex-start;
      gap: 24px;
      color:#2a2a2a;
    }
    .foot-left{
      max-width: 340px;
    }
    .foot-brand{
      display:flex;
      align-items:center;
      gap:10px;
      margin-bottom: 8px;
    }
    .foot-brand img{
      height: 24px;  /* Sesuaikan ukuran logo FILKOMIN */
      width: auto;
      display:block;
    }
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
    .foot-right{
      max-width: 300px;
      text-align:left;
    }
    .foot-right .title{
      font-size: 18px;
      font-weight:800;
      margin-bottom: 8px;
    }
    .insta-list{
      font-size: 12px; /* Ukuran teks disesuaikan dengan teks lainnya */
      color: #333;
    }
    .insta-list a{
      color: #4f79ff;
      text-decoration: none;
    }

    .social{
      display:flex; gap:10px; margin-top: 10px;
    }
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

    /* responsive */
    @media (max-width: 860px){
      .how-grid{ grid-template-columns: 1fr; }
      .step{ min-height: 168px; }
      .row, .row.reverse{
        grid-template-columns: 1fr;
      }
      .row p{ max-width: 100%; }
      .placeholder{ height: 190px; }
      .footer{ flex-direction:column; }
    }
    </style>
</head>

<body>
    <main class="wrap">
        @yield('content') <!-- Content Section -->
    </main>
</body>
</html>
