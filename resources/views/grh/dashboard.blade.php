<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width,initial-scale=1">
  <title>Sonatrach - GRH</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
  <style>
    body { background: #f4f6f9; margin: 0; }

    /* ══ SIDEBAR ══ */
    .sidebar {
      width: 220px;
      min-height: 100vh;
      background: #fff;
      border-right: 1px solid #e0e0e0;
      position: fixed;
      top: 0; left: 0;
      z-index: 100;
      display: flex;
      flex-direction: column;
    }
    .sidebar .logo-area {
      padding: 14px;
      border-bottom: 1px solid #eee;
      text-align: center;
    }
    .sidebar .logo-area img {
      width: 75px;
      height: auto;
      display: block;
      margin: 0 auto;
    }

    /* ══ NAV LINKS ══ */
    .nav-link {
      color: #444;
      padding: 9px 18px;
      border-radius: 8px;
      margin: 2px 8px;
      font-size: 13.5px;
      display: flex;
      align-items: center;
      gap: 8px;
      text-decoration: none;
    }
    .nav-link:hover { background: #f0f4ff; color: #1a3c8f; }
    .nav-link.active {
      background: #fff3e8;
      color: #E07820;
      border-left: 3px solid #E07820;
      border-radius: 0 8px 8px 0;
    }

    /* ══ RETOUR (style encadrant) ══ */
    .nav-back {
      color: #555;
      padding: 9px 18px;
      font-size: 13.5px;
      display: flex;
      align-items: center;
      gap: 8px;
      text-decoration: none;
      margin: 8px 8px 4px;
      border-radius: 8px;
    }
    .nav-back:hover { background: #f0f4ff; color: #1a3c8f; }

    /* ══ TOPBAR ══ */
    .topbar {
      margin-left: 220px;
      background: #fff;
      border-bottom: 1px solid #e0e0e0;
      padding: 11px 22px;
      display: flex;
      justify-content: space-between;
      align-items: center;
    }

    /* ══ MAIN ══ */
    .main-content { margin-left: 220px; padding: 22px; }

    /* ══ BREADCRUMB / TITRE PAGE ══ */
    .page-title {
      font-size: 22px;
      font-weight: 700;
      color: #1a2340;
      margin-bottom: 20px;
    }
  </style>
</head>
<body>

<!-- ══════════════════ SIDEBAR ══════════════════ -->
<div class="sidebar">
  <div class="logo-area">
    <img src="{{ asset('Sonatrach-Logo.wine.webp') }}" alt="Sonatrach">
  </div>
  <nav class="mt-2">
    {{-- Bouton Retour (style encadrant) --}}
    <a href="javascript:history.back()" class="nav-back">
      <i class="bi bi-arrow-left"></i> Retour
    </a>

    <a href="/grh/stagiaires"    class="nav-link {{ request()->is('grh/stagiaires*')    ? 'active' : '' }}">
      <i class="bi bi-people"></i> Stagiaires
    </a>
    <a href="/grh/contrats"      class="nav-link {{ request()->is('grh/contrats*')      ? 'active' : '' }}">
      <i class="bi bi-file-earmark-check"></i> Contrats
    </a>
    <a href="/grh/autorisations" class="nav-link {{ request()->is('grh/autorisations*') ? 'active' : '' }}">
      <i class="bi bi-shield-check"></i> Autorisations
    </a>
  </nav>
</div>

<!-- ══════════════════ TOPBAR ══════════════════ -->
<div class="topbar">
  {{-- Le titre change selon la page active --}}
  <span style="font-weight:600;color:#1a3c8f;font-size:15px">
    @yield('page_title', 'Accueil')
  </span>
  <div class="d-flex align-items-center gap-2">
    <small class="text-muted">Rôle : GRH</small>
    <i class="bi bi-person-circle fs-4 text-secondary"></i>
  </div>
</div>

<!-- ══════════════════ CONTENU ══════════════════ -->
<div class="main-content">
  @yield('content')
</div>

<script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
@stack('scripts')
</body>
</html>
