<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width,initial-scale=1">
  <title>Sonatrach - Stagiaires GRH</title>
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
    .btn-add{background:#1a3c8f;color:#fff;border:none;font-size:13px}
    .btn-add:hover{background:#142d6e;color:#fff}
    .tbl-wrap{background:#fff;border-radius:10px;overflow:hidden;box-shadow:0 1px 4px rgba(0,0,0,.06)}
    thead th{background:#f8f9fa;font-size:12.5px;font-weight:600;white-space:nowrap}
    tbody td{font-size:12.5px;vertical-align:middle}
    .modal-header-custom{background:#1a3c8f}
    .modal-header-archive{background:#6c757d}
    .form-label{font-size:13px;font-weight:500;color:#333;margin-bottom:3px}
    .form-control,.form-select{font-size:13px;border-radius:8px;border:1px solid #d0d7e3}
    .form-control:focus,.form-select:focus{border-color:#1a3c8f;box-shadow:0 0 0 2px rgba(26,60,143,.15)}
    .required-star{color:#dc3545}
    .fiche-header{background:#f0f4ff;border-radius:10px;padding:14px 18px;margin-bottom:18px;border-left:4px solid #1a3c8f}
    .fiche-header h5{margin:0;color:#1a3c8f;font-weight:700}
    .toast-container{position:fixed;bottom:20px;right:20px;z-index:9999}
    .tab-btn{border:none;background:none;padding:6px 14px;border-radius:20px;font-size:13px;cursor:pointer;color:#666}
    .tab-btn.active{background:#1a3c8f;color:#fff;font-weight:600}
    .tab-btn.archive-tab.active{background:#6c757d;color:#fff}
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
    <a href="/encadrant/stagiaires" class="nav-link active"><i class="bi bi-people"></i> Stagiaires</a>
    <a href="/encadrant/sujets" class="nav-link"><i class="bi bi-mortarboard"></i> Sujets</a>
    <a href="/encadrant/rendezvous" class="nav-link"><i class="bi bi-calendar3"></i> Rendez-vous</a>
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
    <small class="text-muted">Rôle : GRH</small>
    <i class="bi bi-person-circle fs-4 text-secondary"></i>
  </div>
</div>

<!-- CONTENU -->
<div class="main-content">
  <h5 class="mb-3" style="font-weight:700">Liste des stagiaires</h5>

  <div class="mb-3" style="max-width:420px">
    <div class="input-group input-group-sm">
      <span class="input-group-text bg-white"><i class="bi bi-search"></i></span>
      <input type="text" id="searchInput" class="form-control" placeholder="Rechercher par nom de stagiaire...">
    </div>
  </div>

  <div class="d-flex align-items-center gap-2 mb-3 flex-wrap">
    <button class="btn btn-add btn-sm rounded-3 px-3" onclick="ouvrirAjout()">
      <i class="bi bi-plus-lg"></i> Ajouter
    </button>
    <div class="ms-3 d-flex gap-1">
      <button class="tab-btn active" id="tabActifs" onclick="switchTab('actifs')">
        <i class="bi bi-people"></i> Actifs
      </button>
      <button class="tab-btn archive-tab" id="tabArchives" onclick="switchTab('archives')">
        <i class="bi bi-archive"></i> Archives
      </button>
    </div>
  </div>

  <p class="text-muted mb-2" style="font-size:12px"><span id="compteur">0</span> stagiaire(s)</p>

  <!-- Tableau actifs -->
  <div id="viewActifs">
    <div class="tbl-wrap">
      <table class="table table-bordered table-hover mb-0">
        <thead>
          <tr>
            <th>ID</th><th>Nom</th><th>Prénom</th><th>Période</th>
            <th>Journée</th><th>Sujet attribué</th><th>Actions</th>
          </tr>
        </thead>
        <tbody id="tbody">
          <tr><td colspan="7" class="text-center py-4">Chargement...</td></tr>
        </tbody>
      </table>
    </div>
  </div>

  <!-- Tableau archives -->
  <div id="viewArchives" style="display:none">
    <div class="tbl-wrap">
      <table class="table table-bordered table-hover mb-0">
        <thead>
          <tr>
            <th>ID</th><th>Nom</th><th>Prénom</th><th>Période</th>
            <th>Journée</th><th>Sujet attribué</th><th>Archivé le</th><th>Actions</th>
          </tr>
        </thead>
        <tbody id="tbodyArchive">
          <tr><td colspan="8" class="text-center py-4">Chargement...</td></tr>
        </tbody>
      </table>
    </div>
  </div>
</div>

<!-- MODAL STAGIAIRE -->
<div class="modal fade" id="modalStagiaire" tabindex="-1">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header modal-header-custom">
        <h5 class="modal-title text-white" id="mTitre"><i class="bi bi-person-plus"></i> Ajouter un stagiaire</h5>
        <button class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
      </div>
      <div class="modal-body">
        <div class="fiche-header" id="ficheHeader" style="display:none">
          <h5 id="ficheNom"></h5>
        </div>
        <input type="hidden" id="sId">
        <div class="row g-3">
          <div class="col-md-3">
            <label class="form-label">Identifiant</label>
            <input type="text" id="fId" class="form-control" readonly style="background:#f8f9fa" placeholder="Auto">
          </div>
          <div class="col-md-4">
            <label class="form-label">Nom <span class="required-star">*</span></label>
            <input type="text" id="fNom" class="form-control" placeholder="NOM">
          </div>
          <div class="col-md-5">
            <label class="form-label">Prénom <span class="required-star">*</span></label>
            <input type="text" id="fPrenom" class="form-control" placeholder="Prénom">
          </div>
          <div class="col-12">
            <label class="form-label">Période <span class="required-star">*</span></label>
            <div class="row g-2">
              <div class="col-md-6">
                <div class="input-group input-group-sm">
                  <span class="input-group-text bg-white" style="font-size:12px">Du</span>
                  <input type="date" id="fPeriodeDebut" class="form-control">
                </div>
              </div>
              <div class="col-md-6">
                <div class="input-group input-group-sm">
                  <span class="input-group-text bg-white" style="font-size:12px">Au</span>
                  <input type="date" id="fPeriodeFin" class="form-control">
                </div>
              </div>
            </div>
          </div>
          <div class="col-md-6">
            <label class="form-label">Téléphone</label>
            <input type="text" id="fTel" class="form-control" placeholder="Numéro de téléphone">
          </div>
          <div class="col-md-6">
            <label class="form-label">Email</label>
            <input type="email" id="fEmail" class="form-control" placeholder="email@example.com">
          </div>
          <div class="col-md-6">
            <label class="form-label">Lieu de naissance</label>
            <input type="text" id="fNaiss" class="form-control" placeholder="Lieu de naissance">
          </div>
          <div class="col-md-6">
            <label class="form-label">Lieu de résidence</label>
            <input type="text" id="fResid" class="form-control" placeholder="Lieu de résidence">
          </div>
          <div class="col-md-6">
            <label class="form-label">Diplôme <span class="required-star">*</span></label>
            <select id="fDiplome" class="form-select">
              <option value="">Sélectionner un diplôme</option>
              <option value="Licence">Licence</option>
              <option value="Master">Master</option>
              <option value="Ingénieur">Ingénieur</option>
              <option value="Doctorat">Doctorat</option>
              <option value="BTS">BTS</option>
              <option value="DUT">DUT</option>
            </select>
          </div>
          <div class="col-md-6">
            <label class="form-label">Spécialité</label>
            <input type="text" id="fSpecialite" class="form-control" placeholder="ex: Informatique, Réseaux...">
          </div>
          <div class="col-12">
            <label class="form-label">Sujet attribué</label>
            <select id="fSujet" class="form-select">
              <option value="">Sélectionner le sujet attribué</option>
            </select>
          </div>
          <div class="col-12">
            <label class="form-label">Journée</label>
            <select id="fJournee" class="form-select">
              <option value="">Sélectionner la journée</option>
              <option value="Lundi">Lundi</option>
              <option value="Mardi">Mardi</option>
              <option value="Mercredi">Mercredi</option>
              <option value="Jeudi">Jeudi</option>
              <option value="Dimanche">Dimanche</option>
            </select>
          </div>
        </div>
      </div>
      <div class="modal-footer">
        <button class="btn btn-outline-secondary btn-sm" data-bs-dismiss="modal">Annuler</button>
        <button class="btn btn-add btn-sm text-white" id="btnSave" onclick="sauvegarder()">
          <i class="bi bi-check-circle"></i> Enregistrer
        </button>
      </div>
    </div>
  </div>
</div>

<!-- MODAL CONFIRMATION ARCHIVER -->
<div class="modal fade" id="modalArchiver" tabindex="-1">
  <div class="modal-dialog modal-sm">
    <div class="modal-content">
      <div class="modal-header modal-header-archive">
        <h6 class="modal-title text-white"><i class="bi bi-archive"></i> Archiver le stagiaire</h6>
        <button class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
      </div>
      <div class="modal-body">
        <p class="mb-0" style="font-size:13px">
          Voulez-vous archiver <strong id="archiveNom"></strong> ?<br>
          <small class="text-muted">Le stagiaire sera masqué de la liste active mais conservé.</small>
        </p>
      </div>
      <div class="modal-footer">
        <button class="btn btn-outline-secondary btn-sm" data-bs-dismiss="modal">Annuler</button>
        <button class="btn btn-sm text-white" style="background:#6c757d" onclick="confirmerArchiver()">
          <i class="bi bi-archive"></i> Archiver
        </button>
      </div>
    </div>
  </div>
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
var modeConsulter = false;
var currentTab = 'actifs';
var archiverId = null;

// ══════════════════════════════════════════
// ONGLETS
// ══════════════════════════════════════════
function switchTab(tab) {
  currentTab = tab;
  if (tab === 'actifs') {
    $('#tabActifs').addClass('active');
    $('#tabArchives').removeClass('active');
    $('#viewActifs').show();
    $('#viewArchives').hide();
    charger();
  } else {
    $('#tabArchives').addClass('active');
    $('#tabActifs').removeClass('active');
    $('#viewArchives').show();
    $('#viewActifs').hide();
    chargerArchives();
  }
}

// ══════════════════════════════════════════
// CHARGER STAGIAIRES ACTIFS
// ══════════════════════════════════════════
function charger(search) {
  $.ajax({
    url: '/grh/stagiaires/liste',
    data: { search: search || $('#searchInput').val() },
    success: function(data) {
      $('#compteur').text(data.length);
      var html = '';
      if (!data.length) {
        html = '<tr><td colspan="7" class="text-center text-muted py-4">Aucun stagiaire trouvé</td></tr>';
      } else {
        data.forEach(function(st) {
          var periode = formatPeriode(st.periode_debut, st.periode_fin);
          var sujetNom = st.sujet ? st.sujet.sujet : '<span class="text-muted">—</span>';
          html += '<tr>' +
            '<td>' + st.id + '</td>' +
            '<td><strong>' + (st.nom || '') + '</strong></td>' +
            '<td>' + (st.prenom || '') + '</td>' +
            '<td><small>' + periode + '</small></td>' +
            '<td>' + (st.journee || '—') + '</td>' +
            '<td>' + sujetNom + '</td>' +
            '<td style="white-space:nowrap">' +
              '<button class="btn btn-outline-primary btn-sm me-1" onclick="ouvrirModif(' + st.id + ')">' +
                '<i class="bi bi-pencil"></i> Modifier</button>' +
              '<button class="btn btn-outline-info btn-sm me-1" onclick="ouvrirConsulter(' + st.id + ')">' +
                '<i class="bi bi-eye"></i> Consulter</button>' +
              '<button class="btn btn-sm me-1 text-white" style="background:#6c757d" onclick="demanderArchiver(' + st.id + ',\'' + (st.nom || '') + ' ' + (st.prenom || '') + '\')">' +
                '<i class="bi bi-archive"></i> Archiver</button>' +
              '<button class="btn btn-outline-danger btn-sm" onclick="supprimer(' + st.id + ')">' +
                '<i class="bi bi-trash"></i> Supprimer</button>' +
            '</td></tr>';
        });
      }
      $('#tbody').html(html);
    },
    error: function(x) {
      $('#tbody').html('<tr><td colspan="7" class="text-center text-danger py-4">Erreur de chargement</td></tr>');
      console.log('Erreur charger:', x.responseText);
    }
  });
}

// ══════════════════════════════════════════
// CHARGER ARCHIVES
// ══════════════════════════════════════════
function chargerArchives(search) {
  $.ajax({
    url: '/grh/stagiaires/archives',
    data: { search: search || $('#searchInput').val() },
    success: function(data) {
      $('#compteur').text(data.length);
      var html = '';
      if (!data.length) {
        html = '<tr><td colspan="8" class="text-center text-muted py-4">Aucun stagiaire archivé</td></tr>';
      } else {
        data.forEach(function(st) {
          var periode = formatPeriode(st.periode_debut, st.periode_fin);
          var sujetNom = st.sujet ? st.sujet.sujet : '<span class="text-muted">—</span>';
          var archiveLe = st.archived_at ? formatDate(st.archived_at.substring(0,10)) : '—';
          html += '<tr class="table-secondary">' +
            '<td>' + st.id + '</td>' +
            '<td><strong>' + (st.nom || '') + '</strong></td>' +
            '<td>' + (st.prenom || '') + '</td>' +
            '<td><small>' + periode + '</small></td>' +
            '<td>' + (st.journee || '—') + '</td>' +
            '<td>' + sujetNom + '</td>' +
            '<td><small class="text-muted">' + archiveLe + '</small></td>' +
            '<td style="white-space:nowrap">' +
              '<button class="btn btn-outline-success btn-sm me-1" onclick="desarchiverStagiaire(' + st.id + ')">' +
                '<i class="bi bi-arrow-counterclockwise"></i> Désarchiver</button>' +
              '<button class="btn btn-outline-danger btn-sm" onclick="supprimerDefinitif(' + st.id + ')">' +
                '<i class="bi bi-trash"></i> Supprimer</button>' +
            '</td></tr>';
        });
      }
      $('#tbodyArchive').html(html);
    }
  });
}

// ══════════════════════════════════════════
// ARCHIVER / DÉSARCHIVER
// ══════════════════════════════════════════
function demanderArchiver(id, nom) {
  archiverId = id;
  $('#archiveNom').text(nom);
  new bootstrap.Modal('#modalArchiver').show();
}

function confirmerArchiver() {
  if (!archiverId) return;
  $.ajax({
    url: '/grh/stagiaires/' + archiverId + '/archiver',
    type: 'POST',
    data: { _token: TOKEN },
    success: function() {
      bootstrap.Modal.getInstance('#modalArchiver').hide();
      charger();
      toast('Stagiaire archivé avec succès.', 'secondary');
      archiverId = null;
    },
    error: function() { toast('Erreur lors de l\'archivage.', 'danger'); }
  });
}

function desarchiverStagiaire(id) {
  if (!confirm('Désarchiver ce stagiaire ?')) return;
  $.ajax({
    url: '/grh/stagiaires/' + id + '/desarchiver',
    type: 'POST',
    data: { _token: TOKEN },
    success: function() { chargerArchives(); toast('Stagiaire désarchivé.', 'success'); },
    error: function() { toast('Erreur lors du désarchivage.', 'danger'); }
  });
}

function supprimerDefinitif(id) {
  if (!confirm('Supprimer définitivement ce stagiaire ? Cette action est irréversible.')) return;
  $.ajax({
    url: '/grh/stagiaires/' + id + '/force-delete',
    type: 'DELETE',
    data: { _token: TOKEN },
    success: function() { chargerArchives(); toast('Stagiaire supprimé définitivement.', 'danger'); },
    error: function() { toast('Erreur lors de la suppression.', 'danger'); }
  });
}

// ══════════════════════════════════════════
// RECHERCHE
// ══════════════════════════════════════════
$('#searchInput').on('input', function() {
  if (currentTab === 'actifs') charger($(this).val());
  else chargerArchives($(this).val());
});

// ══════════════════════════════════════════
// MODAL STAGIAIRE — OUVRIR
// ══════════════════════════════════════════
function chargerSujets(selectedId) {
  $.get('/grh/sujets', function(data) {
    var opt = '<option value="">Sélectionner le sujet attribué</option>';
    data.forEach(function(s) {
      opt += '<option value="' + s.id + '">' + s.sujet + ' (' + s.domaine + ')</option>';
    });
    $('#fSujet').html(opt);
    if (selectedId) $('#fSujet').val(selectedId);
  });
}

function ouvrirAjout() {
  modeConsulter = false;
  viderForm();
  $('#mTitre').html('<i class="bi bi-person-plus"></i> Ajouter un stagiaire');
  $('#ficheHeader').hide();
  $('#btnSave').show();
  activerChamps(true);
  chargerSujets(null);
  new bootstrap.Modal('#modalStagiaire').show();
}
function ouvrirModif(id) {
  modeConsulter = false;
  chargerSujets();
  $.get('/encadrant/stagiaires/'+id, function(st) {
    remplirForm(st);
    $('#mTitre').html('<i class="bi bi-pencil"></i> Modifier — '+st.nom+' '+st.prenom);
    $('#ficheHeader').show();
    $('#ficheNom').text('Fiche stagiaire : '+st.nom+' '+st.prenom);
    $('#btnSave').show();
    activerChamps(true);
    new bootstrap.Modal('#modalStagiaire').show();
  });
}
function ouvrirConsulter(id) {
  modeConsulter = true;
  chargerSujets();
  $.get('/encadrant/stagiaires/'+id, function(st) {
    remplirForm(st);
    $('#mTitre').html('<i class="bi bi-eye"></i> Consulter — '+st.nom+' '+st.prenom);
    $('#ficheHeader').show();
    $('#ficheNom').text('Fiche stagiaire : '+st.nom+' '+st.prenom);
    $('#btnSave').hide();
    activerChamps(false);
    new bootstrap.Modal('#modalStagiaire').show();
  });
}

function activerChamps(actif) {
  ['#fNom','#fPrenom','#fPeriodeDebut','#fPeriodeFin',
   '#fTel','#fEmail','#fNaiss','#fResid',
   '#fDiplome','#fSpecialite','#fSujet','#fJournee'].forEach(function(f) {
    $(f).prop('disabled', !actif).css('background', actif ? '' : '#f8f9fa');
  });
}

function viderForm() {
  $('#sId,#fId,#fNom,#fPrenom,#fPeriodeDebut,#fPeriodeFin').val('');
  $('#fTel,#fEmail,#fNaiss,#fResid,#fSpecialite').val('');
  $('#fDiplome,#fSujet,#fJournee').val('');
}

function remplirForm(st) {
  $('#sId').val(st.id || '');
  $('#fId').val(st.id || '');
  $('#fNom').val(st.nom || '');
  $('#fPrenom').val(st.prenom || '');
  $('#fPeriodeDebut').val(st.periode_debut ? st.periode_debut.substring(0,10) : '');
  $('#fPeriodeFin').val(st.periode_fin ? st.periode_fin.substring(0,10) : '');
  $('#fTel').val(st.telephone || '');
  $('#fEmail').val(st.email || '');
  $('#fNaiss').val(st.lieu_naissance || '');
  $('#fResid').val(st.lieu_residence || '');
  $('#fDiplome').val(st.diplome || '');
  $('#fSpecialite').val(st.specialite || '');
  $('#fJournee').val(st.journee || '');
}

// ══════════════════════════════════════════
// SAUVEGARDER
// ══════════════════════════════════════════
function sauvegarder() {
  var id = $('#sId').val();
  var data = {
    _token: TOKEN,
    nom: $('#fNom').val(),
    prenom: $('#fPrenom').val(),
    periode_debut: $('#fPeriodeDebut').val(),
    periode_fin: $('#fPeriodeFin').val(),
    telephone: $('#fTel').val(),
    email: $('#fEmail').val(),
    lieu_naissance: $('#fNaiss').val(),
    lieu_residence: $('#fResid').val(),
    diplome: $('#fDiplome').val(),
    specialite: $('#fSpecialite').val(),
    sujet_id: $('#fSujet').val(),
    journee: $('#fJournee').val(),
  };
  if (!data.nom || !data.prenom) { toast('Le nom et prénom sont obligatoires !', 'danger'); return; }
  $.ajax({
    url: id ? '/grh/stagiaires/' + id : '/grh/stagiaires/store',
    type: id ? 'PUT' : 'POST',
    data: data,
    success: function() {
      bootstrap.Modal.getInstance('#modalStagiaire').hide();
      switchTab('actifs');
      toast(id ? 'Stagiaire modifié !' : 'Stagiaire ajouté !', 'success');
    },
    error: function(x) {
      var msg = x.responseJSON && x.responseJSON.errors
        ? Object.values(x.responseJSON.errors).join(' | ') : 'Erreur serveur';
      toast(msg, 'danger');
    }
  });
}

// ══════════════════════════════════════════
// SUPPRIMER
// ══════════════════════════════════════════
function supprimer(id) {
  if (!confirm('Supprimer ce stagiaire définitivement ?')) return;
  $.ajax({
    url: '/grh/stagiaires/' + id,
    type: 'DELETE',
    data: { _token: TOKEN },
    success: function() { charger(); toast('Stagiaire supprimé !', 'warning'); },
    error: function() { toast('Erreur suppression.', 'danger'); }
  });
}

// ══════════════════════════════════════════
// UTILITAIRES
// ══════════════════════════════════════════
function formatPeriode(debut, fin) {
  if (debut && fin) return formatDate(debut) + ' → ' + formatDate(fin);
  if (debut) return 'Dès ' + formatDate(debut);
  return '—';
}

function formatDate(d) {
  if (!d) return '';
  var p = d.substring(0,10).split('-');
  return p[2] + '/' + p[1] + '/' + p[0];
}

function toast(msg, type) {
  var el = document.getElementById('toast');
  el.className = 'toast align-items-center text-white border-0 bg-' + type;
  document.getElementById('toastTxt').textContent = msg;
  new bootstrap.Toast(el, { delay: 3000 }).show();
}

$(document).ready(function() { charger(); });
</script>
</body>
</html>
