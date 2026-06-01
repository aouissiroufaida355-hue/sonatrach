<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width,initial-scale=1">
  <title>Sonatrach - Rendez-vous</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
  <style>
    body { background:#f4f6f9; margin:0; }
    .sidebar { width:220px; min-height:100vh; background:#fff;
               border-right:1px solid #e0e0e0; position:fixed; top:0; left:0; z-index:100; }
    .sidebar .logo-area { padding:14px; border-bottom:1px solid #eee; text-align:center; }
    .sidebar .logo-area img { width:75px; }
    .nav-link { color:#444; padding:9px 18px; border-radius:8px; margin:2px 8px;
                font-size:13.5px; display:flex; align-items:center; gap:8px; }
    .nav-link:hover { background:#f0f4ff; color:#1a3c8f; }
    .nav-link.active { background:#fff3e8; color:#E07820;
                       border-left:3px solid #E07820; border-radius:0 8px 8px 0; }
    .topbar { margin-left:220px; background:#fff; border-bottom:1px solid #e0e0e0;
              padding:11px 22px; display:flex; justify-content:space-between; align-items:center; }
    .main-content { margin-left:220px; padding:22px; }
    .btn-rdv { background:#1a3c8f; color:#fff; border:none; font-size:13px; }
    .btn-rdv:hover { background:#142d6e; color:#fff; }
    .btn-rapport { background:#E07820; color:#fff; border:none; font-size:13px; }
    .btn-rapport:hover { background:#c06010; color:#fff; }
    .tbl-wrap { background:#fff; border-radius:10px; overflow:hidden;
                box-shadow:0 1px 4px rgba(0,0,0,.06); }
    thead th { background:#f8f9fa; font-size:12.5px; font-weight:600; white-space:nowrap; }
    tbody td { font-size:12.5px; vertical-align:middle; }
    .badge-oui { background:#dcfce7; color:#16a34a; padding:3px 10px;
                 border-radius:12px; font-size:12px; font-weight:500; cursor:help; }
    .badge-non { background:#fee2e2; color:#dc2626; padding:3px 10px;
                 border-radius:12px; font-size:12px; font-weight:500; }

    /* POPOVER rapport */
    #pop {
      display:none;
      position:fixed;
      background:#fff;
      border:1px solid #E07820;
      border-radius:10px;
      padding:14px 16px;
      max-width:320px;
      min-width:200px;
      box-shadow:0 4px 20px rgba(0,0,0,.18);
      z-index:9999;
      font-size:12.5px;
      pointer-events:none;
      line-height:1.7;
    }
    #pop .pop-header {
      color:#E07820;
      font-weight:600;
      font-size:13px;
      border-bottom:1px solid #f0d0a0;
      padding-bottom:6px;
      margin-bottom:8px;
    }
    #pop .pop-body { color:#333; white-space:pre-wrap; }

    .mh-rdv     { background:#1a3c8f; }
    .mh-rapport { background:#E07820; }
    .form-label { font-size:13px; font-weight:500; color:#333; margin-bottom:3px; }
    .form-control { font-size:13px; border-radius:8px; border:1px solid #d0d7e3; }
    .form-control:focus { border-color:#1a3c8f; box-shadow:0 0 0 2px rgba(26,60,143,.15); }
    .rapport-textarea { min-height:180px; resize:vertical; font-size:13px;
                        border:none; padding:12px; width:100%; outline:none; }
    .char-count { font-size:11px; color:#888; text-align:right; padding:4px 12px 8px; }
    .toast-container { position:fixed; bottom:20px; right:20px; z-index:9999; }
  </style>
</head>
<body>

<!-- SIDEBAR -->
<div class="sidebar">
  <div class="logo-area">
    <img src="{{ asset('sonatrach.webp') }}" alt="Sonatrach"
         style="width:120px; height:auto; display:block; margin:0 auto;">
  </div>
  <nav class="mt-2">
    <a href="javascript:history.back()" class="nav-link"><i class="bi bi-arrow-left"></i> Retour</a>
    <a href="/encadrant/stagiaires" class="nav-link"><i class="bi bi-people"></i> Stagiaires</a>
    <a href="/encadrant/sujets"     class="nav-link"><i class="bi bi-mortarboard"></i> Sujets</a>
    <a href="/encadrant/rendezvous" class="nav-link active"><i class="bi bi-calendar3"></i> Rendez-vous</a>
  </nav>
  <div style="position:absolute;bottom:20px;left:0;right:0;padding:0 8px">
    <a href="/logout" class="nav-link" style="color:#dc2626;border:1px solid #fee2e2;border-radius:8px;justify-content:center">
      <i class="bi bi-box-arrow-left"></i> Déconnexion
    </a>
  </div>
</div>


<!-- TOPBAR -->
<div class="topbar">
  <span style="font-weight:600;color:#1a3c8f;font-size:15px">Accueil</span>
  <div class="d-flex align-items-center gap-2">
    <small class="text-muted">Rôle : Encadrant</small>
    <i class="bi bi-person-circle fs-4 text-secondary"></i>
  </div>
</div>

<!-- CONTENU -->
<div class="main-content">
  <h5 class="mb-3" style="font-weight:700">Rendez-vous</h5>

  <div class="mb-3" style="max-width:500px">
    <div class="input-group input-group-sm">
      <span class="input-group-text bg-white"><i class="bi bi-search"></i></span>
      <input type="text" id="searchInput" class="form-control"
             placeholder="Rechercher un rendez-vous...">
    </div>
  </div>

  <div class="mb-3 d-flex gap-2">
    <button class="btn btn-rdv btn-sm rounded-3 px-3" onclick="ouvrirAjoutRdv()">
      <i class="bi bi-plus-lg"></i> Ajouter un rendez-vous
    </button>
    <button class="btn btn-rapport btn-sm rounded-3 px-3" onclick="ouvrirAjoutRapport()">
      <i class="bi bi-plus-lg"></i> Ajouter un rapport
    </button>
  </div>

  <p class="text-muted mb-2" style="font-size:12px">
    <span id="compteur">0</span> rendez-vous
  </p>

  <div class="tbl-wrap">
    <table class="table table-bordered table-hover mb-0">
      <thead>
        <tr>
          <th>ID</th>
          <th>Nom</th>
          <th>Prénom</th>
          <th>Date</th>
          <th>Heure</th>
          <th>Objet</th>
          <th>Date rapport</th>
          <th>Rapport <i class="bi bi-info-circle text-warning"
              title="Survolez Oui pour lire le rapport"></i></th>
          <th>Actions</th>
        </tr>
      </thead>
      <tbody id="tbody">
        <tr><td colspan="9" class="text-center py-4 text-muted">Chargement...</td></tr>
      </tbody>
    </table>
  </div>
</div>

<!-- POPOVER RAPPORT -->
<div id="pop">
  <div class="pop-header">
    <i class="bi bi-file-earmark-text"></i> Rapport complet
  </div>
  <div class="pop-body" id="pop-texte"></div>
</div>

<!-- MODAL 1 : AJOUTER / MODIFIER RENDEZ-VOUS -->
<div class="modal fade" id="modalRdv" tabindex="-1">
  <div class="modal-dialog"><div class="modal-content">
    <div class="modal-header mh-rdv">
      <h5 class="modal-title text-white" id="mTitreRdv">
        <i class="bi bi-calendar-plus"></i> Ajouter un rendez-vous
      </h5>
      <button class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
    </div>
    <div class="modal-body">
      <input type="hidden" id="rdvId">
      <div class="row g-3">

        <div class="col-md-6">
          <label class="form-label">Nom <span style="color:red">*</span></label>
          <input type="text" id="rNom" class="form-control" placeholder="Nom du stagiaire">
        </div>

        <div class="col-md-6">
          <label class="form-label">Prénom <span style="color:red">*</span></label>
          <input type="text" id="rPrenom" class="form-control" placeholder="Prénom du stagiaire">
        </div>

        <div class="col-md-6">
          <label class="form-label">Date <span style="color:red">*</span></label>
          <input type="date" id="rDate" class="form-control">
        </div>

        <div class="col-md-6">
          <label class="form-label">Heure <span style="color:red">*</span></label>
          <input type="time" id="rHeure" class="form-control">
        </div>

        <div class="col-12">
          <label class="form-label">Objet <span style="color:red">*</span></label>
          <input type="text" id="rObjet" class="form-control"
                 placeholder="ex: Suivi, Mémoire, Rapport final...">
        </div>

      </div>
    </div>
    <div class="modal-footer">
      <button class="btn btn-outline-secondary btn-sm" data-bs-dismiss="modal">Annuler</button>
      <button class="btn btn-rdv btn-sm text-white" onclick="sauvegarderRdv()">
        <i class="bi bi-check-circle"></i> Enregistrer
      </button>
    </div>
  </div></div>
</div>

<!-- MODAL 2 : AJOUTER RAPPORT -->
<div class="modal fade" id="modalRapport" tabindex="-1">
  <div class="modal-dialog modal-lg"><div class="modal-content">
    <div class="modal-header mh-rapport">
      <h5 class="modal-title text-white">
        <i class="bi bi-file-earmark-text"></i> Ajouter un rapport
      </h5>
      <button class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
    </div>
    <div class="modal-body">

      <!-- UN SEUL RECTANGLE ORANGE -->
      <div style="border:2px solid #E07820; border-radius:10px; overflow:hidden;">

        <!-- Partie haute : Nom + Prénom -->
        <div style="background:#fff8f0; padding:14px; border-bottom:1px solid #f0d0a0;">
          <label class="form-label fw-semibold mb-2" style="color:#E07820">
            <i class="bi bi-person"></i> Nom et Prénom du stagiaire
          </label>
          <div class="row g-2">
            <div class="col-md-6">
              <input type="text" id="rapNom" class="form-control"
                     placeholder="Écrire le nom du stagiaire">
            </div>
            <div class="col-md-6">
              <input type="text" id="rapPrenom" class="form-control"
                     placeholder="Écrire le prénom du stagiaire">
            </div>
          </div>
        </div>

        <!-- Partie basse : zone rapport -->
        <div style="padding:14px 14px 4px; background:#fff;">
          <label class="form-label fw-semibold" style="color:#E07820">
            <i class="bi bi-pencil-square"></i> Écrire le rapport
          </label>
          <textarea id="rapTexte" class="rapport-textarea"
            placeholder="Écrivez ici le contenu du rapport...&#10;&#10;- Résumé de la réunion&#10;- Points discutés&#10;- Décisions prises&#10;- Prochaines étapes"
            oninput="majCompteur()"></textarea>
        </div>
        <div class="char-count"><span id="charCount">0</span> caractères</div>

      </div>
    </div>
    <div class="modal-footer">
      <button class="btn btn-outline-secondary btn-sm" data-bs-dismiss="modal">Annuler</button>
      <button class="btn btn-rapport btn-sm" onclick="sauvegarderRapport()">
        <i class="bi bi-check-circle"></i> Enregistrer le rapport
      </button>
    </div>
  </div></div>
</div>

<!-- Toast -->
<div class="toast-container">
  <div id="toast" class="toast align-items-center text-white border-0">
    <div class="d-flex">
      <div class="toast-body" id="toastTxt"></div>
      <button class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast"></button>
    </div>
  </div>
</div>

<script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script>
var TOKEN = '{{ csrf_token() }}';
var rdvData = [];

// ══ Charger liste RDV ══
function charger(search) {
  $.ajax({
    url: '/encadrant/rendezvous/liste',
    data: { search: search || $('#searchInput').val() },
    success: function(data) {
      rdvData = data;
      $('#compteur').text(data.length);
      var html = '';

      if (!data.length) {
        html = '<tr><td colspan="9" class="text-center text-muted py-4">Aucun rendez-vous trouvé</td></tr>';
      } else {
        data.forEach(function(r) {
          var nom    = r.nom_stagiaire    ? r.nom_stagiaire    : '—';
          var prenom = r.prenom_stagiaire ? r.prenom_stagiaire : '—';
          var heure  = r.heure_rdv ? r.heure_rdv.substring(0,5) : '—';
          var dateRap = r.has_rapport ? formatDate(r.updated_at) : '—';

          // Colonne rapport : si Oui → badge cliquable avec popover au survol
          var rapportCol;
          if (r.has_rapport && r.rapport) {
            // Stocker le rapport dans attribut data pour le popover
            var rapportEscaped = escapeHtml(r.rapport);
            rapportCol = '<td>'
              + '<span class="badge-oui" '
              + 'onmouseenter="showPop(event, this)" '
              + 'onmouseleave="hidePop()" '
              + 'data-rapport="' + rapportEscaped + '">'
              + 'Oui</span>'
              + '</td>';
          } else {
            rapportCol = '<td><span class="badge-non">Non</span></td>';
          }

          html += '<tr>'
            + '<td>' + r.id + '</td>'
            + '<td><strong>' + nom + '</strong></td>'
            + '<td>' + prenom + '</td>'
            + '<td>' + formatDate(r.date_rdv) + '</td>'
            + '<td>' + heure + '</td>'
            + '<td>' + r.objet + '</td>'
            + '<td>' + dateRap + '</td>'
            + rapportCol
            + '<td style="white-space:nowrap">'
            + '<button class="btn btn-outline-primary btn-sm me-1" onclick="ouvrirModifRdv(' + r.id + ')">'
            + '<i class="bi bi-pencil"></i> Modifier</button>'
            + '<button class="btn btn-outline-danger btn-sm" onclick="supprimer(' + r.id + ')">'
            + '<i class="bi bi-trash"></i> Supprimer</button>'
            + '</td></tr>';
        });
      }
      $('#tbody').html(html);
    },
    error: function() {
      $('#tbody').html('<tr><td colspan="9" class="text-center text-danger py-4">Erreur de chargement</td></tr>');
    }
  });
}

$('#searchInput').on('input', function(){ charger($(this).val()); });

function formatDate(d) {
  if (!d) return '—';
  var p = d.substring(0,10).split('-');
  return p[2]+'/'+p[1]+'/'+p[0];
}

// Échapper les guillemets pour les attributs HTML
function escapeHtml(s) {
  return (s || '')
    .replace(/&/g, '&amp;')
    .replace(/"/g, '&quot;')
    .replace(/'/g, '&#39;')
    .replace(/</g, '&lt;')
    .replace(/>/g, '&gt;');
}

// ══ POPOVER rapport au survol ══
function showPop(e, el) {
  var texte = el.getAttribute('data-rapport') || '';
  document.getElementById('pop-texte').textContent = texte;
  document.getElementById('pop').style.display = 'block';
  positionPop(e);
}

function positionPop(e) {
  var pop = document.getElementById('pop');
  var x = e.clientX + 15;
  var y = e.clientY + 15;
  // Éviter que le popover sorte de l'écran
  if (x + 320 > window.innerWidth)  x = e.clientX - 330;
  if (y + 200 > window.innerHeight) y = e.clientY - 160;
  pop.style.left = x + 'px';
  pop.style.top  = y + 'px';
}

function hidePop() {
  document.getElementById('pop').style.display = 'none';
}

document.addEventListener('mousemove', function(e) {
  var pop = document.getElementById('pop');
  if (pop.style.display === 'block') positionPop(e);
});

// ══ MODAL 1 : Ajouter RDV ══
function ouvrirAjoutRdv() {
  $('#rdvId,#rNom,#rPrenom,#rDate,#rHeure,#rObjet').val('');
  $('#mTitreRdv').html('<i class="bi bi-calendar-plus"></i> Ajouter un rendez-vous');
  new bootstrap.Modal('#modalRdv').show();
}

// ══ MODAL 1 : Modifier RDV ══
function ouvrirModifRdv(id) {
  $.get('/encadrant/rendezvous/' + id, function(r) {
    $('#rdvId').val(r.id);
    $('#rNom').val(r.nom_stagiaire    || '');
    $('#rPrenom').val(r.prenom_stagiaire || '');
    $('#rDate').val(r.date_rdv   ? r.date_rdv.substring(0,10)  : '');
    $('#rHeure').val(r.heure_rdv ? r.heure_rdv.substring(0,5)  : '');
    $('#rObjet').val(r.objet);
    $('#mTitreRdv').html('<i class="bi bi-pencil"></i> Modifier le rendez-vous');
    new bootstrap.Modal('#modalRdv').show();
  });
}

// ══ Sauvegarder RDV ══
function sauvegarderRdv() {
  var id     = $('#rdvId').val();
  var nom    = $('#rNom').val().trim();
  var prenom = $('#rPrenom').val().trim();
  var date   = $('#rDate').val();
  var heure  = $('#rHeure').val();
  var objet  = $('#rObjet').val().trim();

  if (!nom || !prenom || !date || !heure || !objet) {
    toast('Tous les champs sont obligatoires !', 'danger'); return;
  }

  $.ajax({
    url:  id ? '/encadrant/rendezvous/' + id : '/encadrant/rendezvous',
    type: id ? 'PUT' : 'POST',
    data: {
      _token:           TOKEN,
      nom_stagiaire:    nom,
      prenom_stagiaire: prenom,
      date_rdv:         date,
      heure_rdv:        heure,
      objet:            objet,
    },
    success: function() {
      bootstrap.Modal.getInstance('#modalRdv').hide();
      charger();
      toast(id ? 'Rendez-vous modifié !' : 'Rendez-vous ajouté avec succès !', 'success');
    },
    error: function(x) {
      toast(x.responseJSON && x.responseJSON.errors
        ? Object.values(x.responseJSON.errors).join(' | ')
        : 'Erreur serveur', 'danger');
    }
  });
}

// ══ MODAL 2 : Ouvrir Rapport ══
function ouvrirAjoutRapport() {
  $('#rapNom,#rapPrenom,#rapTexte').val('');
  $('#charCount').text('0');
  new bootstrap.Modal('#modalRapport').show();
}

function majCompteur() {
  $('#charCount').text($('#rapTexte').val().length);
}

// ══ Sauvegarder Rapport ══
function sauvegarderRapport() {
  var nom    = $('#rapNom').val().trim();
  var prenom = $('#rapPrenom').val().trim();
  var texte  = $('#rapTexte').val().trim();

  if (!nom || !prenom) {
    toast('Écrivez le nom et prénom du stagiaire !', 'danger'); return;
  }
  if (!texte || texte.length < 5) {
    toast('Écrivez le rapport (minimum 5 caractères)', 'danger'); return;
  }

  // Chercher le RDV correspondant dans la liste
  var rdvTrouve = null;
  for (var i = 0; i < rdvData.length; i++) {
    var r = rdvData[i];
    if ((r.nom_stagiaire||'').toLowerCase().trim()    === nom.toLowerCase() &&
        (r.prenom_stagiaire||'').toLowerCase().trim() === prenom.toLowerCase()) {
      rdvTrouve = r;
      break;
    }
  }

  if (!rdvTrouve) {
    toast('Aucun rendez-vous trouvé pour "' + nom + ' ' + prenom + '". Ajoutez d\'abord un rendez-vous !', 'warning');
    return;
  }

  $.ajax({
    url:  '/encadrant/rendezvous/' + rdvTrouve.id + '/rapport',
    type: 'POST',
    data: { _token: TOKEN, rapport: texte },
    success: function() {
      bootstrap.Modal.getInstance('#modalRapport').hide();
      charger();
      toast('Rapport enregistré avec succès !', 'success');
    },
    error: function() {
      toast("Erreur lors de l'enregistrement", 'danger');
    }
  });
}

// ══ Supprimer ══
function supprimer(id) {
  if (!confirm('Supprimer ce rendez-vous définitivement ?')) return;
  $.ajax({
    url: '/encadrant/rendezvous/' + id, type: 'DELETE',
    data: { _token: TOKEN },
    success: function() { charger(); toast('Rendez-vous supprimé !', 'warning'); }
  });
}

// ══ Toast ══
function toast(msg, type) {
  var el = document.getElementById('toast');
  el.className = 'toast align-items-center text-white border-0 bg-' + type;
  document.getElementById('toastTxt').textContent = msg;
  new bootstrap.Toast(el, {delay:3500}).show();
}

$(document).ready(function(){ charger(); });
</script>
</body>
</html>
