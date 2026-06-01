<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Sonatrach - Connexion</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
  <style>
    * { box-sizing: border-box; }

    body {
      margin: 0;
      min-height: 100vh;
      display: flex;
      align-items: center;
      justify-content: center;
      /* ═══ PHOTO DE FOND : laptop avec code ═══
         Remplace par ta propre image si tu veux :
         background: url('/images/bg-login.jpg') center/cover no-repeat;
      */
      background:
        linear-gradient(135deg, rgba(10,20,50,0.82) 0%, rgba(20,40,90,0.75) 100%),
        url('https://images.unsplash.com/photo-1555066931-4365d14bab8c?w=1600&q=80') center/cover no-repeat;
      font-family: 'Segoe UI', sans-serif;
    }

    /* ══ CARTE LOGIN ══ */
    .card-login {
      background: rgba(255, 255, 255, 0.97);
      border-radius: 18px;
      padding: 2.2rem 2.5rem 2rem;
      width: 100%;
      max-width: 420px;
      box-shadow: 0 20px 60px rgba(0,0,0,0.35);
      border: none;
    }

    /* ══ LOGO ══ */
    .logo-section {
      text-align: center;
      margin-bottom: 1.6rem;
    }
    .logo-section img {
      width: 110px;   /* taille appropriée — ni trop grand ni trop petit */
      height: auto;
      object-fit: contain;
    }
    .logo-section .app-title {
      display: block;
      font-size: 13px;
      color: #666;
      margin-top: 8px;
      letter-spacing: 0.5px;
    }

    /* ══ TITRE ══ */
    .login-title {
      font-size: 20px;
      font-weight: 700;
      color: #1a3c8f;
      text-align: center;
      margin-bottom: 1.5rem;
    }

    /* ══ INPUTS ══ */
    .input-group-custom {
      position: relative;
      margin-bottom: 1rem;
    }
    .input-group-custom .icon {
      position: absolute;
      left: 12px;
      top: 50%;
      transform: translateY(-50%);
      color: #999;
      font-size: 16px;
      z-index: 2;
    }
    .input-group-custom input {
      width: 100%;
      padding: 11px 12px 11px 38px;
      border: 1.5px solid #d0d7e3;
      border-radius: 9px;
      font-size: 14px;
      outline: none;
      transition: border-color .2s;
      background: #fafbff;
    }
    .input-group-custom input:focus {
      border-color: #1a3c8f;
      background: #fff;
      box-shadow: 0 0 0 3px rgba(26,60,143,.1);
    }
    .toggle-pwd {
      position: absolute;
      right: 12px;
      top: 50%;
      transform: translateY(-50%);
      cursor: pointer;
      color: #999;
      font-size: 16px;
      z-index: 2;
    }
    .toggle-pwd:hover { color: #1a3c8f; }

    /* ══ ROLE BADGES ══ */
    .role-section {
      margin-bottom: 1.2rem;
    }
    .role-label {
      font-size: 13px;
      font-weight: 600;
      color: #444;
      margin-bottom: 8px;
      display: block;
    }
    .role-options {
      display: flex;
      gap: 10px;
    }
    .role-option {
      flex: 1;
      text-align: center;
    }
    .role-option input[type="radio"] {
      display: none;
    }
    .role-option label {
      display: block;
      padding: 9px 10px;
      border: 2px solid #d0d7e3;
      border-radius: 9px;
      font-size: 13px;
      font-weight: 500;
      color: #666;
      cursor: pointer;
      transition: all .2s;
      background: #fafbff;
    }
    .role-option input[type="radio"]:checked + label {
      border-color: #E07820;
      background: #fff3e8;
      color: #E07820;
      font-weight: 600;
    }
    .role-option label:hover {
      border-color: #E07820;
      color: #E07820;
    }

    /* ══ BOUTON ══ */
    .btn-login {
      width: 100%;
      padding: 12px;
      background: #1a3c8f;
      color: #fff;
      border: none;
      border-radius: 9px;
      font-size: 15px;
      font-weight: 600;
      cursor: pointer;
      transition: background .2s, transform .1s;
      letter-spacing: 0.3px;
    }
    .btn-login:hover { background: #142d6e; transform: translateY(-1px); }
    .btn-login:active { transform: translateY(0); }

    /* ══ ALERTE ══ */
    #msg {
      display: none;
      border-radius: 9px;
      font-size: 13px;
      padding: 10px 14px;
      margin-bottom: 1rem;
    }

    /* ══ FOOTER CARD ══ */
    .card-footer-text {
      text-align: center;
      margin-top: 1.2rem;
      font-size: 11.5px;
      color: #aaa;
    }

    /* ══ LOADING SPINNER sur bouton ══ */
    .spinner {
      display: inline-block;
      width: 14px; height: 14px;
      border: 2px solid rgba(255,255,255,.4);
      border-top-color: #fff;
      border-radius: 50%;
      animation: spin .6s linear infinite;
      margin-right: 6px;
      vertical-align: middle;
    }
    @keyframes spin { to { transform: rotate(360deg); } }
  </style>
</head>
<body>

<div class="card-login">

  <!-- LOGO SONATRACH -->
  <div style="text-align:center; margin-bottom:1.5rem;">
    <img src="{{ asset('sonatrach.webp') }}"
         alt="Sonatrach"
         style="width:200px; height:auto; display:block; margin:0 auto;">
    <span style="display:block; font-size:13px; color:#666; margin-top:8px;">
        Plateforme de gestion des stages et stagiaires
    </span>
  </div>

  <div class="login-title">Connexion</div>

  <!-- Message erreur/succès -->
  <div id="msg" class="alert"></div>

  <form id="loginForm">
    @csrf

    <!-- Nom utilisateur -->
    <div class="input-group-custom">
      <i class="bi bi-person icon"></i>
      <input type="text" id="nom_utilisateur" name="nom_utilisateur"
             placeholder="Nom utilisateur" required autocomplete="username">
    </div>

    <!-- Mot de passe -->
    <div class="input-group-custom">
      <i class="bi bi-lock icon"></i>
      <input type="password" id="mot_de_passe" name="mot_de_passe"
             placeholder="Mot de passe" required autocomplete="current-password">
      <i class="bi bi-eye toggle-pwd" id="togglePwd"></i>
    </div>

    <!-- Rôle -->
    <div class="role-section">
      <span class="role-label">Rôle :</span>
      <div class="role-options">
        <div class="role-option">
          <input type="radio" id="encadrant" name="role" value="encadrant" checked>
          <label for="encadrant">
            <i class="bi bi-person-badge"></i> Encadrant
          </label>
        </div>
        <div class="role-option">
          <input type="radio" id="grh" name="role" value="grh">
          <label for="grh">
            <i class="bi bi-people"></i> GRH
          </label>
        </div>
      </div>
    </div>

    <!-- Bouton connexion -->
    <button type="submit" class="btn-login" id="btnLogin">
      Se connecter
    </button>

  </form>

  <div class="card-footer-text">
    © {{ date('Y') }} Sonatrach — Tous droits réservés
  </div>

</div>

<script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script>
  // ── Afficher/cacher mot de passe ──
  $('#togglePwd').on('click', function() {
    var input = $('#mot_de_passe');
    var isPass = input.attr('type') === 'password';
    input.attr('type', isPass ? 'text' : 'password');
    $(this).toggleClass('bi-eye bi-eye-slash');
  });

  // ── Soumission AJAX ──
  $('#loginForm').on('submit', function(e) {
    e.preventDefault();

    var btn = $('#btnLogin');
    btn.html('<span class="spinner"></span> Connexion...').prop('disabled', true);

    var data = {
      _token:          $('input[name=_token]').val(),
      nom_utilisateur: $('#nom_utilisateur').val(),
      mot_de_passe:    $('#mot_de_passe').val(),
      role:            $('input[name=role]:checked').val(),
    };

    $.ajax({
      url: '/login',
      type: 'POST',
      data: data,
      success: function(res) {
        $('#msg')
          .removeClass('alert-danger')
          .addClass('alert alert-success')
          .html('<i class="bi bi-check-circle me-1"></i>' + res.message)
          .show();

        setTimeout(function() {
          window.location.href = res.redirect;
        }, 800);
      },
      error: function(xhr) {
        var err = xhr.responseJSON ? xhr.responseJSON.message : 'Identifiants incorrects.';
        $('#msg')
          .removeClass('alert-success')
          .addClass('alert alert-danger')
          .html('<i class="bi bi-exclamation-circle me-1"></i>' + err)
          .show();
        btn.html('Se connecter').prop('disabled', false);
      }
    });
  });
</script>
</body>
</html>

