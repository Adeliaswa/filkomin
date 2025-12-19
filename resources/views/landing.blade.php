@extends('layouts.app')

@section('title', 'FILKOMIN Landing Page')

@section('content')
<style>
:root {
  --primary: #4f79ff;
  --bg: #f4f0e7;
  --surface: #ffffff;
  --soft: #f7ffec;
  --dark: #1f1f1f;
  --muted: #666;

  --radius-lg: 28px;
  --radius-md: 20px;
  --radius-sm: 14px;
}

html { scroll-behavior: smooth; }

body {
  margin: 0;
  background: var(--bg);
  font-family: 'Inter', system-ui, sans-serif;
  color: var(--dark);
}

/* ===== WRAPPER ===== */
.landing-wrapper {
  max-width: 1100px;
  margin: 28px auto;
  background: var(--soft);
  border-radius: var(--radius-lg);
  padding-bottom: 28px;
}

/* ===== TOPBAR ===== */
.topbar {
  margin: 0 24px;
  padding: 14px 24px;
  background: var(--surface);
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
  padding: 10px 22px;
  border-radius: 999px;
  font-size: 14px;
  font-weight: 600;
  text-decoration: none;
  transition: all .25s ease;
}

.btn-primary {
  background: var(--primary);
  color: #fff;
}

.btn-primary:hover {
  transform: translateY(-1px);
  opacity: .95;
}

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
.emoji-row, .mini-emoji {
  display: flex;
  justify-content: center;
  gap: 12px;
  margin-bottom: 14px;
}

.emoji-badge {
  font-size: 22px;
  background: var(--surface);
  padding: 12px;
  border-radius: var(--radius-sm);
}

/* ===== HOW IT WORKS ===== */
.how {
  background: linear-gradient(180deg, #1f1f1f, #252525);
  margin: 0 24px;
  border-radius: var(--radius-lg);
  padding: 56px 36px;
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
  position: relative;
  background: #2a2a2a;
  border-radius: var(--radius-md);
  padding: 36px 28px;
  text-align: center;
  transition: transform .25s ease, box-shadow .25s ease;
}

.step:hover {
  transform: translateY(-4px);
  box-shadow: 0 12px 30px rgba(0,0,0,.3);
}

.step .icon {
  font-size: 34px;
  background: rgba(79,121,255,.12);
  color: var(--primary);
  width: 64px;
  height: 64px;
  margin: 0 auto 18px;
  border-radius: 18px;
  display: flex;
  align-items: center;
  justify-content: center;
}

.step h3 {
  font-size: 16px;
  margin-bottom: 8px;
  color: #fff;
}

.step p {
  font-size: 14px;
  color: #bbb;
  line-height: 1.6;
}

.step-number {
  position: absolute;
  top: 18px;
  right: 20px;
  font-size: 14px;
  font-weight: 700;
  color: var(--primary);
}

/* ===== CTA 2 ===== */
.cta2 {
  margin: 40px 24px;
  padding: 90px 24px;
  text-align: center;
  background: var(--dark);
  border-radius: var(--radius-lg);
  color: #fff;
}

.cta2 h2 {
  font-size: 34px;
  line-height: 1.2;
  margin: 22px 0;
}

.sub {
  margin-top: 18px;
  display: flex;
  justify-content: center;
  gap: 20px;
  font-size: 14px;
  color: #ccc;
}

/* ===== FOOTER ===== */
.footer {
  margin: 0 24px;
  padding: 44px;
  background: var(--dark);
  border-radius: var(--radius-lg);
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
  <p>An integrated platform designed to support<br>academic and institutional activities at FILKOM</p>

  <div class="cta">
    <a href="#how-it-works" class="btn btn-ghost">Learn More</a>
    <a href="{{ route('register') }}" class="btn btn-primary">Get Started!</a>
  </div>
</section>

<section class="how" id="how-it-works">
  <h2>How it works?</h2>

  <div class="how-grid">
    <article class="step">
      <div class="icon">📝</div>
      <h3>Create & Publish Event</h3>
      <p>Set up event details, schedule, and publish in minutes.</p>
      <span class="step-number">1</span>
    </article>

    <article class="step">
      <div class="icon">🔗</div>
      <h3>Share the Invitation</h3>
      <p>Distribute links or QR codes to participants easily.</p>
      <span class="step-number">2</span>
    </article>

    <article class="step">
      <div class="icon">📊</div>
      <h3>Manage Attendance</h3>
      <p>Track attendance and export reports instantly.</p>
      <span class="step-number">3</span>
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
