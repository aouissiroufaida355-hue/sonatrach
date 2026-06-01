<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width,initial-scale=1">
  <title>Sonatrach - Contrats GRH</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.4.1/html2canvas.min.js"></script>
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
    .tbl-wrap{background:#fff;border-radius:10px;overflow:hidden;box-shadow:0 1px 4px rgba(0,0,0,.06)}
    thead th{background:#f8f9fa;font-size:12.5px;font-weight:600;white-space:nowrap}
    tbody td{font-size:12.5px;vertical-align:middle}
    .badge-attente{background:#fff3cd;color:#856404;font-size:11px;padding:3px 10px;border-radius:20px}
    .badge-valide{background:#d1fae5;color:#065f46;font-size:11px;padding:3px 10px;border-radius:20px}
    .badge-refuse{background:#fee2e2;color:#991b1b;font-size:11px;padding:3px 10px;border-radius:20px}
    .toast-container{position:fixed;bottom:20px;right:20px;z-index:9999}
    @media print{
      body *{visibility:hidden !important}
      #zoneConvention,#zoneConvention *{visibility:visible !important}
      #zoneConvention{position:fixed !important;top:0;left:0;width:100%;background:#fff;z-index:99999;padding:20px}
      .no-print{display:none !important}
    }
    .convention-doc{font-family:'Times New Roman',serif;font-size:13px;color:#111;margin:0;padding:0;background:#fff}
#zoneDoc{padding:20mm 15mm;width:180mm;margin:0 auto}
    .conv-header{display:flex;justify-content:space-between;align-items:flex-start;margin-bottom:20px;padding-bottom:16px;border-bottom:2px solid #E07820}
    .conv-header-left{font-size:12px;color:#555;line-height:1.8}
    .conv-header-right img{width:90px}
    .conv-title{text-align:center;margin:20px 0;font-size:16px;font-weight:bold;color:#1a3c8f;border:2px solid #1a3c8f;padding:10px;border-radius:4px}
    .conv-num{text-align:center;font-size:13px;margin-bottom:20px;color:#555}
    .conv-body p{margin-bottom:10px;line-height:1.8;text-align:justify}
    .conv-article{font-weight:bold;color:#1a3c8f;margin-top:16px;margin-bottom:6px;font-size:13.5px}
    .conv-field{border-bottom:1px solid #333;display:inline-block;min-width:200px;margin:0 4px}
    .conv-signatures{display:flex;justify-content:space-between;margin-top:40px;padding-top:20px;border-top:1px solid #ddd}
    .conv-sig{text-align:center;width:45%}
    .conv-sig strong{display:block;margin-bottom:40px;font-size:13px}
    .conv-sig .line{border-bottom:1px solid #333;width:200px;margin:0 auto}
  </style>
</head>
<body>

<!-- SIDEBAR -->
<div class="sidebar">
  <div class="logo-area"><img src="{{ asset('sonatrach.webp') }}" alt="Sonatrach"></div>
  <nav class="mt-2">
    <a href="javascript:history.back()" class="nav-link"><i class="bi bi-arrow-left"></i> Retour</a>
    <a href="/grh/stagiaires" class="nav-link"><i class="bi bi-people"></i> Stagiaires</a>
    <a href="/grh/contrats" class="nav-link active"><i class="bi bi-file-earmark-check"></i> Contrats</a>
    <a href="/grh/autorisations" class="nav-link"><i class="bi bi-shield-check"></i> Autorisations</a>
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
  <h5 class="mb-3" style="font-weight:700">Conventions de stage</h5>
  <div class="mb-3 no-print">
  <div class="d-flex align-items-center gap-3 mb-2 flex-wrap">
    <div style="max-width:360px;flex:1">
      <div class="input-group input-group-sm">
        <span class="input-group-text bg-white"><i class="bi bi-search"></i></span>
        <input type="text" id="searchInput" class="form-control" placeholder="Rechercher...">
      </div>
    </div>
    <select id="filtreStatut" class="form-select form-select-sm" style="max-width:180px">
      <option value="tous">Tous les statuts</option>
      <option value="en_attente">En attente</option>
      <option value="valide">Validés</option>
      <option value="refuse">Refusés</option>
    </select>
  </div>
  <!-- Bouton en bas -->
  <button class="btn btn-sm text-white rounded-3 px-3" style="background:#1a3c8f" onclick="ouvrirCreer()">
    <i class="bi bi-plus-lg"></i> Nouveau contrat
  </button>
</div>
  <p class="text-muted mb-2 no-print" style="font-size:12px"><span id="compteur">0</span> contrat(s)</p>
  <div class="tbl-wrap no-print">
    <table class="table table-bordered table-hover mb-0">
      <thead>
        <tr>
          <th>ID</th><th>Stagiaire(s)</th><th>Date début</th><th>Date fin</th>
          <th>Statut</th><th>Actions</th>
        </tr>
      </thead>
      <tbody id="tbody">
        <tr><td colspan="7" class="text-center py-4">Chargement...</td></tr>
      </tbody>
    </table>
  </div>
</div>

<!-- MODAL CRÉER -->
<div class="modal fade" id="modalCreer" tabindex="-1">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header" style="background:#1a3c8f">
        <h5 class="modal-title text-white"><i class="bi bi-file-earmark-plus"></i> Nouveau contrat</h5>
        <button class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
      </div>
      <div class="modal-body">
        <label class="form-label fw-semibold mb-2">Stagiaires <span class="text-danger">*</span></label>
        <div id="listeStagiaires">
          <div class="stagiaire-row border rounded p-2 mb-2 bg-light">
            <div class="row g-2">
              <div class="col-6"><input type="text" class="form-control sNom" placeholder="NOM *"></div>
              <div class="col-6"><input type="text" class="form-control sPrenom" placeholder="Prénom *"></div>
            </div>
          </div>
        </div>
        <button type="button" class="btn btn-outline-primary btn-sm mb-3" onclick="ajouterLigne()">
          <i class="bi bi-plus-circle"></i> Ajouter un autre stagiaire
        </button>
        <div class="row g-3">
          <div class="col-6">
            <label class="form-label fw-semibold">Date début <span class="text-danger">*</span></label>
            <input type="date" id="cDateDebut" class="form-control">
          </div>
          <div class="col-6">
            <label class="form-label fw-semibold">Date fin <span class="text-danger">*</span></label>
            <input type="date" id="cDateFin" class="form-control">
          </div>
          <div class="col-12">
            <label class="form-label fw-semibold">Organisme de formation</label>
            <input type="text" id="cOrganisme" class="form-control" placeholder="ex: Université d'Alger">
          </div>
          <div class="col-12">
            <label class="form-label fw-semibold">Thème du stage</label>
            <input type="text" id="cTheme" class="form-control" placeholder="ex: Développement Web">
          </div>
        </div>
      </div>
      <div class="modal-footer">
        <button class="btn btn-outline-secondary btn-sm" data-bs-dismiss="modal">Annuler</button>
        <button class="btn btn-sm text-white" style="background:#1a3c8f" onclick="creerContrat()">
          <i class="bi bi-check-circle"></i> Créer
        </button>
      </div>
    </div>
  </div>
</div>

<!-- MODAL CONVENTION -->
<div class="modal fade" id="modalConvention" tabindex="-1">
  <div class="modal-dialog modal-xl">
    <div class="modal-content">
      <div class="modal-header no-print" style="background:#1a3c8f">
        <h5 class="modal-title text-white"><i class="bi bi-file-text"></i> Convention de stage</h5>
        <button class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
      </div>
      <div class="modal-body p-3">
        <div class="d-flex gap-2 mb-3 no-print">
          <button class="btn btn-sm text-white" style="background:#E07820" onclick="window.print()">
            <i class="bi bi-printer"></i> Imprimer
          </button>
          <a id="btnTelecharger" href="#" target="_blank" class="btn btn-outline-success btn-sm">
            <i class="bi bi-download"></i> Télécharger PDF
          </a>
          <button class="btn btn-outline-primary btn-sm" id="btnValider" onclick="validerContrat()">
            <i class="bi bi-check-circle"></i> Valider
          </button>
          <button class="btn btn-outline-danger btn-sm" id="btnRefuser" onclick="refuserContrat()">
            <i class="bi bi-x-circle"></i> Refuser
          </button>
        </div>
        <div id="zoneConvention">
          <div class="convention-doc">
            <div class="conv-header">
              <div class="conv-header-left">
                <strong>Exploration & Production</strong><br>
                Division Exploration<br>GPR/DRH/SCE. Formation
              </div>
              <div class="conv-header-right">
                <img src="{{ asset('sonatrach.webp') }}" alt="Sonatrach">
              </div>
            </div>
            <div class="conv-title">Convention de Stage</div>
            <div class="conv-num">N° <span id="cvNum">____</span> / {{ date('Y') }}</div>
            <div class="conv-body">
              <p><strong>Entre,</strong></p>
              <p>La Société Nationale pour la Recherche, la Production, le Transport, la Transformation et la Commercialisation des Hydrocarbures, dénommée « <strong>Sonatrach</strong> », dont le siège social est à Djenane El Malik Hydra Alger, représentée par Monsieur <strong>ZEBBOUDJ Mourad</strong>, Directeur Gestion du Personnel de la Division Exploration.</p>
              <p><strong>D'une part,</strong></p>
              <p><strong>Et,</strong></p>
              <p><span class="conv-field" id="cvOrganisme" style="min-width:400px">&nbsp;</span></p>
              <p>Représenté par <span class="conv-field" style="min-width:300px">&nbsp;</span></p>
              <p><strong>D'autre part,</strong></p>
              <p><strong>Il est convenu et arrêté ce qui suit :</strong></p>
              <p class="conv-article">Article 1 : Objet de la Convention</p>
              <p>La présente convention a pour objet de définir les conditions et les modalités d'organisation et de réalisation d'un stage pratique au profit de :</p>
              <!-- ICI les stagiaires s'affichent tous -->
              <div id="cvStagiaires" style="margin:8px 0;padding:8px;border-left:3px solid #1a3c8f;background:#f0f4ff"></div>
              <p>Etudiant(e)s inscrit(e)s auprès de l'Etablissement sus cité, pour la préparation du diplôme de <span class="conv-field" id="cvDiplome">&nbsp;</span></p>
              <p class="conv-article">Article 2 : Lieu et durée du stage</p>
              <p>Le stage pratique se déroulera à <strong>Boumerdès – Division Exploration / Sonatrach</strong>.</p>
              <p>pour la période allant du <span class="conv-field" id="cvDateDebut">&nbsp;</span> au <span class="conv-field" id="cvDateFin">&nbsp;</span>.</p>
              <p>Cette durée pourra être prolongée dans la limite des capacités d'accueil.</p>
              <p class="conv-article">Article 3 : Objectifs du stage</p>
              <p>- L'acquisition et le renforcement des connaissances pratiques sur les réalités de l'Entreprise.</p>
              <p>- L'intégration progressive des stagiaires dans le milieu professionnel.</p>
              <p>- La contribution des stagiaires à l'amélioration des performances de l'Entreprise.</p>
              <p class="conv-article">Article 4 : Le contenu du stage</p>
              <p>Le programme du stage sera établi par le maitre de stage de l'Entreprise, ici dénommé « Encadreur ».</p>
              <p><strong>Thème :</strong> <span class="conv-field" id="cvTheme" style="min-width:300px">&nbsp;</span></p>
              <p class="conv-article">Article 5 : Obligations du stagiaire</p>
              <p>Le stagiaire doit accomplir les tâches confiées, se soumettre au Règlement Intérieur de Sonatrach, préserver la discrétion et restituer les badges d'accès à la fin du stage.</p>
              <p class="conv-article">Article 6 : Obligations de l'organisme de formation</p>
              <p>L'Organisme de formation s'engage à désigner un encadreur et à assurer la couverture des stagiaires en matière de sécurité sociale.</p>
              <p class="conv-article">Article 7 : Obligations de Sonatrach</p>
              <p>Sonatrach s'engage à désigner un encadreur, mettre à disposition la documentation nécessaire et délivrer une attestation de fin de stage.</p>
              <p class="conv-article">Article 8 : Discipline</p>
              <p>Tout écart de conduite doit être signalé immédiatement à l'organisme formateur. En cas de fautes graves, Sonatrach se réserve le droit de mettre fin au stage.</p>
              <p class="conv-article">Article 9 : Responsabilité et assurances</p>
              <p>L'organisme de formation s'engage à souscrire une police d'assurance couvrant la responsabilité civile des stagiaires.</p>
              <p class="conv-article">Article 10 : Règlement des litiges</p>
              <p>Sonatrach et l'organisme de formation s'efforceront de régler, à l'amiable, tout différend.</p>
              <p class="conv-article">Article 11 : Entrée en vigueur</p>
              <p>La présente convention entrera en vigueur après sa signature par les deux (02) parties.</p>
              <p style="margin-top:20px">Fait en trois (03) exemplaires à Boumerdès, le <span class="conv-field" style="min-width:200px">&nbsp;</span></p>
            </div>
            <div class="conv-signatures">
              <div class="conv-sig">
                <strong>Pour l'Organisme Formateur</strong>
                <div class="line"></div>
                <small>Signature & Cachet</small>
              </div>
              <div class="conv-sig">
                <strong>Pour SONATRACH<br>Le Directeur Gestion du Personnel<br>M. ZEBBOUDJ</strong>
                <div class="line"></div>
                <small>Signature & Cachet</small>
              </div>
            </div>
          </div>
        </div>
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
var contratCourant = null;

// ══ CHARGER TABLEAU ══
function charger() {
  $.ajax({
    url: '/grh/contrats/liste',
    data: { statut: $('#filtreStatut').val(), search: $('#searchInput').val() },
    success: function(data) {
      $('#compteur').text(data.length);
      var html = '';
      if (!data.length) {
        html = '<tr><td colspan="7" class="text-center text-muted py-4">Aucun contrat trouvé</td></tr>';
      } else {
        data.forEach(function(c) {
          // ← CORRECTION : utilise directement nom/prenom du contrat
          var nom = '';
          if (c.stagiaires && c.stagiaires.length) {
            // si relation stagiaires multiple
            nom = c.stagiaires.map(function(s){ return s.nom+' '+s.prenom; }).join(', ');
          } else if (c.noms_stagiaires) {
            // champ texte groupé
            nom = c.noms_stagiaires;
          } else {
            // champ direct nom/prenom sur le contrat
            nom = ((c.nom||'') + ' ' + (c.prenom||'')).trim() || '—';
          }

          var badge = c.statut==='valide'
            ? '<span class="badge-valide"><i class="bi bi-check-circle me-1"></i>Validé</span>'
            : c.statut==='refuse'
            ? '<span class="badge-refuse"><i class="bi bi-x-circle me-1"></i>Refusé</span>'
            : '<span class="badge-attente"><i class="bi bi-hourglass me-1"></i>En attente</span>';
          var pdf = c.fichier_pdf
            ? '<a href="/contrats/'+c.fichier_pdf+'" target="_blank" class="btn btn-outline-success btn-sm"><i class="bi bi-file-pdf"></i> PDF</a>'
            : '<span class="text-muted" style="font-size:11px">Aucun PDF</span>';

          html += '<tr>'+
            '<td>'+c.id+'</td>'+
            '<td><strong>'+nom+'</strong></td>'+
            '<td>'+(c.date_debut||'—')+'</td>'+
            '<td>'+(c.date_fin||'—')+'</td>'+
            '<td>'+badge+'</td>'+
            '<td style="white-space:nowrap">'+
              '<button class="btn btn-sm text-white me-1" style="background:#1a3c8f" onclick="voirConvention('+JSON.stringify(c).replace(/"/g,'&quot;')+')">'+
                '<i class="bi bi-eye"></i> Convention</button>'+
              '<button class="btn btn-outline-danger btn-sm" onclick="supprimerContrat('+c.id+')">'+
                '<i class="bi bi-trash"></i></button>'+
            '</td></tr>';
        });
      }
      $('#tbody').html(html);
    }
  });
}

$('#searchInput').on('input', charger);
$('#filtreStatut').on('change', charger);

// ══ OUVRIR CRÉER ══
function ouvrirCreer() {
  $('#listeStagiaires').html(
    '<div class="stagiaire-row border rounded p-2 mb-2 bg-light">'+
      '<div class="row g-2">'+
        '<div class="col-6"><input type="text" class="form-control sNom" placeholder="NOM *"></div>'+
        '<div class="col-6"><input type="text" class="form-control sPrenom" placeholder="Prénom *"></div>'+
      '</div>'+
    '</div>'
  );
  $('#cDateDebut,#cDateFin,#cOrganisme,#cTheme').val('');
  new bootstrap.Modal('#modalCreer').show();
}

function ajouterLigne() {
  $('#listeStagiaires').append(
    '<div class="stagiaire-row border rounded p-2 mb-2 bg-light">'+
      '<div class="row g-2">'+
        '<div class="col-5"><input type="text" class="form-control sNom" placeholder="NOM *"></div>'+
        '<div class="col-5"><input type="text" class="form-control sPrenom" placeholder="Prénom *"></div>'+
        '<div class="col-2"><button type="button" class="btn btn-outline-danger btn-sm w-100" onclick="$(this).closest(\'.stagiaire-row\').remove()"><i class="bi bi-trash"></i></button></div>'+
      '</div>'+
    '</div>'
  );
}

// ══ CRÉER CONTRAT ══
function creerContrat() {
  var stagiaires = [];
  $('.stagiaire-row').each(function() {
    var nom    = $(this).find('.sNom').val().trim();
    var prenom = $(this).find('.sPrenom').val().trim();
    if (nom && prenom) stagiaires.push({ nom: nom, prenom: prenom });
  });

  if (!stagiaires.length) { toast('Ajoutez au moins un stagiaire !', 'danger'); return; }
  if (!$('#cDateDebut').val() || !$('#cDateFin').val()) { toast('Remplissez les dates !', 'danger'); return; }

  $.ajax({
    url: '/grh/contrats/store-multiple',
    type: 'POST',
    contentType: 'application/json',
    data: JSON.stringify({
      _token:     TOKEN,
      stagiaires: stagiaires,
      date_debut: $('#cDateDebut').val(),
      date_fin:   $('#cDateFin').val(),
      organisme:  $('#cOrganisme').val(),
      theme:      $('#cTheme').val(),
    }),
    success: function() {
      // ✅ CORRECTION : utiliser l'élément DOM directement
      var modalEl = document.getElementById('modalCreer');
      var modal   = bootstrap.Modal.getInstance(modalEl);
      if (modal) modal.hide();

      charger();
      toast('Contrat(s) créé(s) avec succès !', 'success');
    },
    error: function(x) {
      var msg = x.responseJSON ? x.responseJSON.message : 'Erreur serveur';
      // ✅ Afficher aussi les erreurs de validation Laravel
      if (x.responseJSON && x.responseJSON.errors) {
        var errors = Object.values(x.responseJSON.errors).flat();
        msg = errors.join('<br>');
      }
      toast('Erreur : ' + msg, 'danger');
    }
  });
}

// ══ VOIR CONVENTION ══
function voirConvention(c) {
  contratCourant = c;

  $('#cvNum').text(c.id);
  $('#cvDateDebut').text(c.date_debut || '_______________');
  $('#cvDateFin').text(c.date_fin || '_______________');
  $('#cvOrganisme').text(c.organisme || '_______________________________________________');
  $('#cvTheme').text(c.theme || '_______________________________________________');
  $('#cvDiplome').text('_______________');
  $('#btnTelecharger').attr('href', '/grh/contrats/' + c.id + '/convention-pdf');
  // ← CORRECTION : afficher TOUS les stagiaires du contrat
  var nomsStagiaires = '';
  if (c.stagiaires && c.stagiaires.length) {
    // relation multiple
    c.stagiaires.forEach(function(s, i) {
      nomsStagiaires += '<strong>'+(i+1)+'. '+s.nom+' '+s.prenom+'</strong><br>';
    });
  } else if (c.noms_stagiaires) {
    nomsStagiaires = '<strong>'+c.noms_stagiaires+'</strong>';
  } else {
    // contrat avec nom/prenom direct
    var n = ((c.nom||'') + ' ' + (c.prenom||'')).trim();
    nomsStagiaires = n ? '<strong>'+n+'</strong>' : '<em class="text-muted">—</em>';
  }
  $('#cvStagiaires').html(nomsStagiaires);

  if (c.statut === 'valide') {
    $('#btnValider,#btnRefuser').hide();
  } else {
    $('#btnValider,#btnRefuser').show();
  }
  new bootstrap.Modal('#modalConvention').show();
}

// ══ VALIDER ══
function validerContrat() {
  if (!contratCourant || !confirm('Valider ce contrat ?')) return;
  $.ajax({
    url: '/grh/contrats/'+contratCourant.id+'/valider',
    type: 'POST',
    data: { _token: TOKEN },
    success: function() {
      bootstrap.Modal.getInstance('#modalConvention').hide();
      charger();
      toast('Contrat validé !', 'success');
    },
    error: function() { toast('Erreur validation.', 'danger'); }
  });
}

// ══ REFUSER ══
function refuserContrat() {
  if (!contratCourant || !confirm('Refuser ce contrat ?')) return;
  $.ajax({
    url: '/grh/contrats/'+contratCourant.id+'/refuser',
    type: 'POST',
    data: { _token: TOKEN },
    success: function() {
      bootstrap.Modal.getInstance('#modalConvention').hide();
      charger();
      toast('Contrat refusé.', 'warning');
    },
    error: function() { toast('Erreur refus.', 'danger'); }
  });
}

// ══ IMPORTER PDF ══
function importerPdf() {
  if (!contratCourant) return;
  var file = $('#inputPdf')[0].files[0];
  if (!file) return;
  var formData = new FormData();
  formData.append('_token', TOKEN);
  formData.append('pdf', file);
  $.ajax({
    url: '/grh/contrats/'+contratCourant.id+'/pdf',
    type: 'POST',
    data: formData,
    processData: false,
    contentType: false,
    success: function() { charger(); toast('PDF importé !', 'success'); },
    error: function() { toast('Erreur import PDF.', 'danger'); }
  });
}

// ══ SUPPRIMER ══
function exporterPdf() {
  toast('Génération du PDF en cours...', 'secondary');
  var element = document.getElementById('zoneConvention');
  html2canvas(element, {
    scale: 2,
    useCORS: true,
    backgroundColor: '#ffffff'
  }).then(function(canvas) {
    var { jsPDF } = window.jspdf;
    var pdf = new jsPDF('p', 'mm', 'a4');
    var pdfWidth = pdf.internal.pageSize.getWidth();
    var pdfHeight = (canvas.height * pdfWidth) / canvas.width;
    var pageHeight = pdf.internal.pageSize.getHeight();
    var imgData = canvas.toDataURL('image/jpeg', 1.0);
    if (pdfHeight <= pageHeight) {
      pdf.addImage(imgData, 'JPEG', 0, 0, pdfWidth, pdfHeight);
    } else {
      var position = 0;
      while (position < pdfHeight) {
        pdf.addImage(imgData, 'JPEG', 0, -position, pdfWidth, pdfHeight);
        position += pageHeight;
        if (position < pdfHeight) pdf.addPage();
      }
    }
    pdf.save('convention_' + (contratCourant ? contratCourant.id : 'stage') + '.pdf');
    toast('PDF téléchargé avec succès !', 'success');
  }).catch(function(err) {
    toast('Erreur : ' + err.message, 'danger');
  });
}
function supprimerContrat(id) {
  if (!confirm('Supprimer ce contrat ?')) return;
  $.ajax({
    url: '/grh/contrats/' + id,
    type: 'DELETE',
    data: { _token: TOKEN },
    success: function() {
      charger();
      toast('Contrat supprimé.', 'warning');
    },
    error: function() {
      toast('Erreur suppression.', 'danger');
    }
  });
}
function toast(msg, type) {
  var t = document.getElementById('toast');
  t.className = 'toast align-items-center text-white border-0 bg-' + type;
  document.getElementById('toastTxt').innerHTML = msg;
  var bsToast = new bootstrap.Toast(t, { delay: 3500 });
  bsToast.show();
}
$(document).ready(function() { charger(); });
</script>
</body>
</html>
