@extends('layouts.app')  

@section('title', 'FILKOMIN Landing Page')  

@section('content')
  <header class="topbar">
    <div class="brand" aria-label="FILKOMIN">
      <img src="https://images-wixmp-ed30a86b8c4ca887773594c2.wixmp.com/f/429fa1fa-304f-4a41-a6d1-c5dfc602e8d2/dl2tro7-b82d4d25-02fa-4843-abfd-244ea4faf4ab.png?token=eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJzdWIiOiJ1cm46YXBwOjdlMGQxODg5ODIyNjQzNzNhNWYwZDQxNWVhMGQyNmUwIiwiaXNzIjoidXJuOmFwcDo3ZTBkMTg4OTgyMjY0MzczYTVmMGQ0MTVlYTBkMjZlMCIsIm9iaiI6W1t7InBhdGgiOiIvZi80MjlmYTFmYS0zMDRmLTRhNDEtYTZkMS1jNWRmYzYwMmU4ZDIvZGwydHJvNy1iODJkNGQyNS0wMmZhLTQ4NDMtYWJmZC0yNDRlYTRmYWY0YWIucG5nIn1dXSwiYXVkIjpbInVybjpzZXJ2aWNlOmZpbGUuZG93bmxvYWQiXX0.JoGIQfUsi8w8QyK8aY7EjS8Qv5Lcoee0Gz0g_Q7axA0" alt="FILKOMIN Logo">
    </div>
    <nav class="nav-actions">
      <a class="link" href="{{ route('login') }}">Log in</a> 
      <a href="{{ route('register') }}" class="btn btn-primary">Start for free</a>
    </nav>
  </header>

  <section class="hero">
    <div class="emoji-row" aria-hidden="true">
      <div class="emoji-badge">😵</div>
      <div class="emoji-badge">😐</div>
    </div>

    <h1>
      A smarter<br/>
      way to run<br/>
      FILKOM’s events!
    </h1>

    <p>
      An integrated platform designed to support<br/>
      academic and institutional activities at FILKOM
    </p>

    <div class="cta">
      <a href="#how-it-works" class="btn btn-ghost">Learn More</a>
      <a href="{{ route('register') }}" class="btn btn-primary">Get Started!</a>
    </div>
  </section>

  <section class="how" id="how-it-works" style="scroll-margin-top: 30px;">
    <h2>How it works?</h2>

    <div class="how-grid">
      <article class="step">
        <div class="top">
          <div class="title">Create &amp; Publish the Event</div>
          <div class="ext">1</div>
        </div>
        <div class="mock create" aria-hidden="true"></div>
      </article>

      <article class="step">
        <div class="top">
          <div class="title">Share the Invitation</div>
          <div class="ext">2</div>
        </div>
        <div class="mock invite" aria-hidden="true"></div>
      </article>

      <article class="step">
        <div class="top">
          <div class="title">Manage Attendance</div>
          <div class="ext">3</div>
        </div>
        <div class="mock qr" aria-hidden="true"></div>
      </article>
    </div>
  </section>

  <section class="cta2" style="margin-top: 28px;">
    <div class="mini-emoji" aria-hidden="true">
      <div class="emoji-badge" style="transform:rotate(-8deg)">😵</div>
      <div class="emoji-badge" style="transform:rotate(2deg)">😎</div>
      <div class="emoji-badge" style="transform:rotate(8deg)">😐</div>
    </div>

    <h2>Run Your<br/>Academic Events<br/>Digitally Today</h2>

    <a href="{{ route('register') }}" class="btn btn-primary">Start Here</a>

    <div class="sub" aria-label="benefits">
      <span>✓ Faculty-supported</span>
      <span>✓ No installation</span>
    </div>
  </section>

  <footer class="footer">
    <div class="foot-left">
      <div class="foot-brand" aria-label="FILKOMIN footer logo">
        <img
          src="https://images-wixmp-ed30a86b8c4ca887773594c2.wixmp.com/f/429fa1fa-304f-4a41-a6d1-c5dfc602e8d2/dl2tro7-b82d4d25-02fa-4843-abfd-244ea4faf4ab.png?token=eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJzdWIiOiJ1cm46YXBwOjdlMGQxODg5ODIyNjQzNzNhNWYwZDQxNWVhMGQyNmUwIiwiaXNzIjoidXJuOmFwcDo3ZTBkMTg4OTgyMjY0MzczYTVmMGQ0MTVlYTBkMjZlMCIsIm9iaiI6W1t7InBhdGgiOiIvZi80MjlmYTFmYS0zMDRmLTRhNDEtYTZkMS1jNWRmYzYwMmU4ZDIvZGwydHJvNy1iODJkNGQyNS0wMmZhLTQ4NDMtYWJmZC0yNDRlYTRmYWY0YWIucG5nIn1dXSwiYXVkIjpbInVybjpzZXJ2aWNlOmZpbGUuZG93bmxvYWQiXX0.JoGIQfUsi8w8QyK8aY7EjS8Qv5Lcoee0Gz0g_Q7axA0"
          alt="FILKOMIN"
        />
      </div>
      <p>An integrated platform designed to support academic and institutional activities at FILKOM</p>
      <div class="copyright">© 2025 Faculty of Computer Science, Brawijaya University</div>
    </div>

    <div class="foot-right">
      <div class="title">Catch us!</div>
      <ul class="insta-list">
        <li><a href="https://github.com/Adeliaswa" target="_blank" rel="noopener">Adelia Swatika</a></li>
        <li><a href="https://github.com/viatika265" target="_blank" rel="noopener">Devi Atika</a></li>
        <li><a href="https://github.com/nadh-ifa" target="_blank" rel="noopener">Nadhifa Fitriyah</a></li>
      </ul>
    </div>
  </footer>

  <style>
    html {
      scroll-behavior: smooth;
    }
  </style>
@endsection