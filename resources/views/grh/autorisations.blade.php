<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width,initial-scale=1">
  <title>Sonatrach - Autorisations GRH</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
  <style>
    body{background:#f4f6f9;margin:0}
    .sidebar{width:220px;min-height:100vh;background:#fff;border-right:1px solid #e0e0e0;position:fixed;top:0;left:0;z-index:100}
    .sidebar .logo-area{padding:14px;border-bottom:1px solid #eee;text-align:center}
    .sidebar .logo-area img{width:120px;height:auto;display:block;margin:0 auto}
    .nav-link{color:#444;padding:9px 18px;border-radius:8px;margin:2px 8px;font-size:13.5px;display:flex;align-items:center;gap:8px;text-decoration:none}
    .nav-link:hover{background:#f0f4ff;color:#1a3c8f}
    .nav-link.active{background:#fff3e8;color:#E07820;border-left:3px solid #E07820;border-radius:0 8px 8px 0}
    .topbar{margin-left:220px;background:#fff;border-bottom:1px solid #e0e0e0;padding:11px 22px;display:flex;justify-content:space-between;align-items:center}
    .main-content{margin-left:220px;padding:22px}

    /* Suggestions */
    .suggestions-box{position:absolute;top:100%;left:0;right:0;background:#fff;border:1px solid #d0d7e3;border-radius:0 0 8px 8px;z-index:999;max-height:220px;overflow-y:auto;box-shadow:0 4px 12px rgba(0,0,0,.1)}
    .suggestion-item{padding:9px 14px;cursor:pointer;font-size:13px;border-bottom:1px solid #f0f0f0}
    .suggestion-item:hover,.suggestion-item.actif{background:#f0f4ff;color:#1a3c8f}
    .suggestion-item:last-child{border-bottom:none}

    /* Document autorisation */
    .auto-wrap{background:#fff;border-radius:10px;box-shadow:0 2px 12px rgba(0,0,0,.08);padding:30px;max-width:750px;margin:0 auto}
    .auto-doc{font-family:'Times New Roman',serif;font-size:13px;color:#111}
    .auto-header{display:flex;align-items:flex-start;gap:16px;padding-bottom:16px;border-bottom:2px solid #E07820;margin-bottom:20px}
    .auto-photo{width:80px;height:90px;border:1px solid #999;display:flex;align-items:center;justify-content:center;font-size:11px;color:#888;text-align:center;flex-shrink:0}
    .auto-logo{text-align:center;flex-shrink:0}
    .auto-logo img{width:85px}
    .auto-logo small{display:block;font-size:10px;color:#555;margin-top:4px;line-height:1.5}
    .auto-title{flex:1;text-align:center;padding-top:6px}
    .auto-title h4{color:#E07820;font-size:20px;font-weight:bold;margin-bottom:6px}
    .auto-title .num{font-size:13px;color:#333}
    .auto-date{text-align:right;font-size:12px;margin-bottom:18px;padding-bottom:10px;border-bottom:1px solid #ddd}
    .auto-table{width:100%;border-collapse:collapse;margin-bottom:28px}
    .auto-table tr td{padding:8px 12px;border-bottom:1px solid #e8e8e8;font-size:13px}
    .auto-table tr td:first-child{font-weight:bold;width:46%;color:#1a3c8f}
    .auto-sigs{display:flex;justify-content:space-around;margin-top:28px;padding-top:10px}
    .auto-sigs .sig{text-align:center}
    .auto-sigs .sig strong{display:block;margin-bottom:36px;font-size:13px}
    .auto-sigs .sig .line{border-bottom:1px solid #555;width:160px;margin:0 auto;font-size:12px;padding-top:4px}

    /* Impression */
    @media print{
      body *{visibility:hidden !important}
      #zoneImpression,#zoneImpression *{visibility:visible !important}
      #zoneImpression{position:fixed !important;top:0;left:0;width:100%;background:#fff;z-index:99999;padding:30px}
      .no-print{display:none !important}
    }
  </style>
</head>
<body>

<!-- SIDEBAR -->
<div class="sidebar">
  <div class="logo-area">
    <img src="{{ asset('sonatrach.webp') }}" alt="Sonatrach">
  </div>
  <nav class="mt-2">
    <a href="javascript:history.back()" class="nav-link"><i class="bi bi-arrow-left"></i> Retour</a>
    <a href="/grh/stagiaires" class="nav-link"><i class="bi bi-people"></i> Stagiaires</a>
    <a href="/grh/contrats" class="nav-link"><i class="bi bi-file-earmark-check"></i> Contrats</a>
    <a href="/grh/autorisations" class="nav-link active"><i class="bi bi-shield-check"></i> Autorisations</a>
  </nav>
  <div style="position:absolute;bottom:20px;left:0;right:0;padding:0 8px">
    <a href="/logout" class="nav-link" style="color:#dc2626;border:1px solid #fee2e2;border-radius:8px;justify-content:center">
      <i class="bi bi-box-arrow-left"></i> Déconnexion
    </a>
  </div>
</div>
</div>

<!-- TOPBAR -->
<div class="topbar">
  <span style="font-weight:600;color:#1a3c8f;font-size:15px">Accueil</span>
  <div class="d-flex align-items-center gap-2">
    <small class="text-muted">Rôle : GRH</small>
    <i class="bi bi-person-circle fs-4 text-secondary"></i>
  </div>
</div>

<!-- CONTENU -->
<div class="main-content">
  <h5 class="mb-4" style="font-weight:700">Autorisation d'accès</h5>

  <!-- Recherche -->
  <div class="auto-wrap mb-4 no-print">
    <label class="form-label fw-semibold mb-2">
      <i class="bi bi-search me-1 text-primary"></i> Rechercher un stagiaire
    </label>
    <div style="position:relative;max-width:450px">
      <input type="text" id="searchInput" class="form-control"
             placeholder="Tapez le nom ou prénom puis appuyez sur Entrée..."
             autocomplete="off">
      <div id="suggestionsBox" class="suggestions-box" style="display:none"></div>
    </div>
  </div>

  <!-- Zone vide -->
  <div id="zoneVide" class="text-center py-5 text-muted">
    <i class="bi bi-shield-check" style="font-size:52px;color:#d0d7e3"></i>
    <p class="mt-3" style="font-size:14px">Recherchez un stagiaire pour afficher son autorisation d'accès</p>
  </div>

  <!-- Zone autorisation -->
  <div id="zoneAutorisation" style="display:none">

    <!-- Boutons -->
    <div class="d-flex gap-2 mb-3 no-print" style="max-width:750px;margin:0 auto">
      <button class="btn btn-sm text-white px-3" style="background:#E07820" onclick="window.print()">
        <i class="bi bi-printer me-1"></i> Imprimer l'autorisation
      </button>
      <button class="btn btn-outline-secondary btn-sm" onclick="reinitialiser()">
        <i class="bi bi-arrow-counterclockwise me-1"></i> Nouvelle recherche
      </button>
    </div>

    <!-- DOCUMENT -->
    <div class="auto-wrap">
      <div id="zoneImpression">
        <div class="auto-doc">

          <div class="auto-header">
            <div class="auto-photo">Photo</div>
            <div class="auto-logo">
              <img src="{{ asset('sonatrach.webp') }}" alt="Sonatrach">
              <small>Exploration-Production<br>Division Exploration<br>GPR/DRH/SCE. Formation</small>
            </div>
            <div class="auto-title">
              <h4>Autorisation d'Accès au Siège</h4>
              <div class="num" id="docNum">N° —</div>
            </div>
          </div>

          <div class="auto-date">
            Boumerdes, le &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
          </div>

          <table class="auto-table">
            <tr><td>Nom &amp; Prénom :</td>                      <td id="docNomPrenom">—</td></tr>
            <tr><td>Date de naissance :</td>                     <td>_______________</td></tr>
            <tr><td>Nationalité :</td>                           <td>Algérienne</td></tr>
            <tr><td>Spécialité :</td>                            <td id="docSpecialite">—</td></tr>
            <tr><td>Année universitaire :</td>                   <td id="docAnnee">—</td></tr>
            <tr><td>Entreprise ou organisme de stage :</td>      <td>SONATRACH</td></tr>
            <tr><td>Lieu d'affectation Direction :</td>          <td>Département Formation</td></tr>
            <tr><td>Période de consultation :</td>               <td id="docPeriode">—</td></tr>
            <tr><td>Journées de consultation :</td>              <td id="docJournee">—</td></tr>
            <tr><td>Accès à la bibliothèque et Archives :</td>   <td>Autorisé</td></tr>
          </table>

          <div class="auto-sigs">
            <div class="sig">
              <strong>Le Stagiaire</strong>
              <div class="line">Signature : ________________</div>
            </div>
            <div class="sig">
              <strong>Le Responsable</strong>
              <div class="line">Signature &amp; Cachet : ________________</div>
            </div>
          </div>

        </div>
      </div>
    </div>

  </div>
</div>

<script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script>
var indexActif = -1;
var listeStagiaires = [];

// ══════════════════════════════════════════
// RECHERCHE EN TEMPS RÉEL
// ══════════════════════════════════════════
$('#searchInput').on('input', function() {
  var val = $(this).val().trim();
  indexActif = -1;

  if (val.length < 2) {
    $('#suggestionsBox').hide();
    listeStagiaires = [];
    return;
  }

  $.ajax({
    url: '/grh/stagiaires/liste',
    data: { search: val },
    success: function(data) {
      listeStagiaires = data;
      if (!data.length) { $('#suggestionsBox').hide(); return; }

      var html = '';
      data.forEach(function(st, i) {
        var periode = '';
        if (st.periode_debut && st.periode_fin) {
          periode = formatDate(st.periode_debut) + ' → ' + formatDate(st.periode_fin);
        }
        html += '<div class="suggestion-item" data-index="' + i + '">' +
          '<strong>' + st.nom + ' ' + st.prenom + '</strong>' +
          (st.specialite ? ' <small class="text-muted">| ' + st.specialite + '</small>' : '') +
          (periode ? ' <small class="text-muted">| ' + periode + '</small>' : '') +
        '</div>';
      });
      $('#suggestionsBox').html(html).show();
    }
  });
});

// ══════════════════════════════════════════
// NAVIGATION CLAVIER (flèches + Entrée)
// ══════════════════════════════════════════
$('#searchInput').on('keydown', function(e) {
  var items = $('#suggestionsBox .suggestion-item');

  if (e.key === 'ArrowDown') {
    e.preventDefault();
    indexActif = Math.min(indexActif + 1, items.length - 1);
    items.removeClass('actif');
    $(items[indexActif]).addClass('actif');

  } else if (e.key === 'ArrowUp') {
    e.preventDefault();
    indexActif = Math.max(indexActif - 1, 0);
    items.removeClass('actif');
    $(items[indexActif]).addClass('actif');

  } else if (e.key === 'Enter') {
    e.preventDefault();
    if (items.length === 0) return;

    // Si flèche utilisée → prendre l'actif, sinon prendre le premier
    var idx = indexActif >= 0 ? indexActif : 0;
    var st = listeStagiaires[idx];
    if (st) afficherAutorisation(st);
    indexActif = -1;
  }

  // Echap → fermer
  if (e.key === 'Escape') {
    $('#suggestionsBox').hide();
    indexActif = -1;
  }
});

// ══════════════════════════════════════════
// CLIC SUR UNE SUGGESTION
// ══════════════════════════════════════════
$(document).on('click', '.suggestion-item', function() {
  var idx = $(this).data('index');
  var st = listeStagiaires[idx];
  if (st) afficherAutorisation(st);
});
$('#searchInput').on('keydown', function(e) {
  if (e.key === 'Enter') {
    e.preventDefault();
    var val = $(this).val().trim();
    if (!val) return;
    $.ajax({
      url: '/grh/stagiaires/liste',
      data: { search: val },
      success: function(data) {
        if (data.length > 0) {
          $('#suggestionsBox').hide();
          selectionnerStagiaire(data[0]);
        }
      }
    });
  }
});
// Fermer si clic ailleurs
$(document).on('click', function(e) {
  if (!$(e.target).closest('#searchInput, #suggestionsBox').length) {
    $('#suggestionsBox').hide();
  }
});

// ══════════════════════════════════════════
// AFFICHER L'AUTORISATION
// ══════════════════════════════════════════
function afficherAutorisation(st) {
  $('#suggestionsBox').hide();
  $('#searchInput').val(st.nom + ' ' + st.prenom);

  var annee = new Date().getFullYear();
  var anneeUniv = st.periode_fin
    ? new Date(st.periode_fin).getFullYear()
    : annee;

  $('#docNum').text('N° ' + st.id + '-1 / ' + annee);
  $('#docNomPrenom').text(st.nom + ' ' + st.prenom);
  $('#docSpecialite').text(st.specialite || '—');
  $('#docAnnee').text(anneeUniv);
  $('#docJournee').text(st.journee || '—');

  if (st.periode_debut && st.periode_fin) {
    $('#docPeriode').text(st.periode_debut + ' au ' + st.periode_fin);
  } else {
    $('#docPeriode').text('—');
  }

  $('#zoneVide').hide();
  $('#zoneAutorisation').show();
}

// ══════════════════════════════════════════
// RÉINITIALISER
// ══════════════════════════════════════════
function reinitialiser() {
  $('#searchInput').val('');
  $('#suggestionsBox').hide();
  $('#zoneAutorisation').hide();
  $('#zoneVide').show();
  listeStagiaires = [];
  indexActif = -1;
}

// ══════════════════════════════════════════
// UTILITAIRE DATE
// ══════════════════════════════════════════
function formatDate(d) {
  if (!d) return '';
  var p = d.substring(0, 10).split('-');
  return p[2] + '/' + p[1] + '/' + p[0];
}
</script>
</body>
</html>
