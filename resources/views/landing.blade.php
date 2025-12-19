@extends('layouts.app')

@section('title', 'FILKOMIN Landing Page')

@section('content')

<style>
/* ===== ROOT ===== */
:root {
  --primary: #4f79ff;
  --bg: #f4f0e7;
  --card: #ffffff;
  --soft: #f7ffec;
  --dark: #2b2b2b;
  --muted: #666;
}

/* ===== GLOBAL ===== */
html { scroll-behavior: smooth; }

body {
  margin: 0;
  background: var(--bg);
  font-family: 'Inter', system-ui, sans-serif;
  color: var(--dark);
}

/* ===== WRAPPER (INI KUNCI) ===== */
.landing-wrapper {
  max-width: 1100px;
  margin: 28px auto;
  background: var(--soft);
  border-radius: 28px;
  padding-bottom: 28px;
}

/* ===== TOPBAR ===== */
.topbar {
  margin: 0 24px;
  padding: 14px 24px;
  background: var(--card);
  border-radius: 999px;
  display: flex;
  justify-content: space-between;
  align-items: center;
}

.brand img { height: 40px; }

.nav-actions {
  display: flex;
  gap: 14px;
  align-items: center;
}

.link {
  font-size: 14px;
  font-weight: 600;
  color: var(--muted);
  text-decoration: none;
}

/* ===== BUTTON ===== */
.btn {
  padding: 10px 20px;
  border-radius: 999px;
  font-size: 14px;
  font-weight: 600;
  text-decoration: none;
  transition: .25s;
}

.btn-primary {
  background: var(--primary);
  color: #fff;
}

.btn-primary:hover { opacity: .9; }

.btn-ghost {
  border: 1.5px solid #ddd;
  color: var(--dark);
}

.btn-ghost:hover {
  border-color: var(--primary);
  color: var(--primary);
}

/* ===== HERO ===== */
.hero {
  padding: 90px 24px 70px;
  text-align: center;
}

.hero h1 {
  font-size: 44px;
  line-height: 1.2;
  margin: 20px 0;
}

.hero p {
  font-size: 16px;
  color: var(--muted);
}

.cta {
  margin-top: 32px;
  display: flex;
  justify-content: center;
  gap: 16px;
}

/* ===== EMOJI ===== */
.emoji-row,
.mini-emoji {
  display: flex;
  justify-content: center;
  gap: 12px;
  margin-bottom: 14px;
}

.emoji-badge {
  font-size: 22px;
  background: var(--card);
  padding: 12px;
  border-radius: 14px;
}

/* ===== HOW IT WORKS ===== */
.how {
  background: #2b2b2b;
  margin: 0 24px;
  border-radius: 22px;
  padding: 48px 32px;
  color: #fff;
}

.how h2 {
  text-align: center;
  font-size: 26px;
  margin-bottom: 36px;
}

.how-grid {
  display: grid;
  grid-template-columns: repeat(3, 1fr);
  gap: 24px;
}

.step {
  background: #3a3a3a;
  border-radius: 18px;
  padding: 22px;
}

.step .top {
  display: flex;
  justify-content: space-between;
  align-items: center;
}

.step .title {
  font-weight: 600;
}

.step .ext {
  font-size: 18px;
  font-weight: 700;
  color: var(--primary);
}

.mock {
  height: 100px;
  margin-top: 14px;
  border-radius: 12px;
  background: #4a4a4a;
}

/* ===== CTA 2 (BROWN BOX) ===== */
.cta2 {
  margin: 40px 24px;
  padding: 80px 24px;
  text-align: center;

  background: #3b2f2f;          /* coklat tua */
  border-radius: 24px;

  color: #fff;
}

.cta2 h2 {
  font-size: 34px;
  line-height: 1.2;
  margin: 22px 0;
  color: #fff;
}

.cta2 .btn-primary {
  background: var(--primary);
}

.sub {
  margin-top: 18px;
  display: flex;
  justify-content: center;
  gap: 18px;
  font-size: 14px;
  color: #e0d6d6;              /* teks abu terang */
}


/* ===== FOOTER ===== */
.footer {
  margin: 0 24px;
  padding: 40px;
  background: #1f1f1f;
  border-radius: 22px;
  display: flex;
  flex-wrap: wrap;
  justify-content: space-between;
  gap: 32px;
  color: #ccc;
}

.footer img { height: 28px; }

.foot-left p {
  max-width: 360px;
  font-size: 14px;
  color: #aaa;
}

.copyright {
  margin-top: 12px;
  font-size: 12px;
  color: #888;
}

.foot-right .title {
  font-weight: 600;
  color: #fff;
  margin-bottom: 8px;
}

.insta-list {
  list-style: none;
  padding: 0;
  margin: 0;
}

.insta-list li a {
  font-size: 13px;
  color: #aaa;
  text-decoration: none;
}

.insta-list li a:hover { color: #fff; }
</style>

<div class="landing-wrapper">

<header class="topbar">
  <div class="brand">
    <img src="https://images-wixmp-ed30a86b8c4ca887773594c2.wixmp.com/f/429fa1fa-304f-4a41-a6d1-c5dfc602e8d2/dl2tro7-b82d4d25-02fa-4843-abfd-244ea4faf4ab.png" alt="FILKOMIN">
  </div>
  <nav class="nav-actions">
    <a class="link" href="{{ route('login') }}">Log in</a>
    <a href="{{ route('register') }}" class="btn btn-primary">Start for free</a>
  </nav>
</header>

<section class="hero">
  <div class="emoji-row">
    <div class="emoji-badge">😵</div>
    <div class="emoji-badge">😐</div>
  </div>

  <h1>A smarter<br>way to run<br>FILKOM’s events!</h1>

  <p>
    An integrated platform designed to support<br>
    academic and institutional activities at FILKOM
  </p>

  <div class="cta">
    <a href="#how-it-works" class="btn btn-ghost">Learn More</a>
    <a href="{{ route('register') }}" class="btn btn-primary">Get Started!</a>
  </div>
</section>

<section class="how" id="how-it-works">
  <h2>How it works?</h2>

  <div class="how-grid">
    <article class="step">
      <div class="top">
        <div class="title">Create & Publish the Event</div>
        <div class="ext">1</div>
      </div>
      <div class="mock"></div>
    </article>

    <article class="step">
      <div class="top">
        <div class="title">Share the Invitation</div>
        <div class="ext">2</div>
      </div>
      <div class="mock"></div>
    </article>

    <article class="step">
      <div class="top">
        <div class="title">Manage Attendance</div>
        <div class="ext">3</div>
      </div>
      <div class="mock"></div>
    </article>
  </div>
</section>

<section class="cta2">
  <div class="mini-emoji">
    <div class="emoji-badge">😵</div>
    <div class="emoji-badge">😎</div>
    <div class="emoji-badge">😐</div>
  </div>

  <h2>Run Your<br>Academic Events<br>Digitally Today</h2>

  <a href="{{ route('register') }}" class="btn btn-primary">Start Here</a>

  <div class="sub">
    <span>✓ Faculty-supported</span>
    <span>✓ No installation</span>
  </div>
</section>

<footer class="footer">
  <div class="foot-left">
    <img src="https://images-wixmp-ed30a86b8c4ca887773594c2.wixmp.com/f/429fa1fa-304f-4a41-a6d1-c5dfc602e8d2/dl2tro7-b82d4d25-02fa-4843-abfd-244ea4faf4ab.png" alt="FILKOMIN">
    <p>An integrated platform designed to support academic and institutional activities at FILKOM</p>
    <div class="copyright">
      © 2025 Faculty of Computer Science, Brawijaya University
    </div>
  </div>

  <div class="foot-right">
    <div class="title">Catch us!</div>
    <ul class="insta-list">
      <li><a href="https://github.com/Adeliaswa" target="_blank">Adelia Swatika</a></li>
      <li><a href="https://github.com/viatika265" target="_blank">Devi Atika</a></li>
      <li><a href="https://github.com/nadh-ifa" target="_blank">Nadhifa Fitriyah</a></li>
    </ul>
  </div>
</footer>

</div>

@endsection
