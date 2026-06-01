<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width,initial-scale=1">
  <title>Sonatrach - Sujets</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
  <style>
    body{background:#f4f6f9;margin:0}
    .sidebar{width:220px;min-height:100vh;background:#fff;border-right:1px solid #e0e0e0;position:fixed;top:0;left:0;z-index:100}
    .sidebar .logo-area{padding:14px;border-bottom:1px solid #eee;text-align:center}
    .sidebar .logo-area img{width:75px}
    .nav-link{color:#444;padding:9px 18px;border-radius:8px;margin:2px 8px;font-size:13.5px;display:flex;align-items:center;gap:8px}
    .nav-link:hover{background:#f0f4ff;color:#1a3c8f}
    .nav-link.active{background:#fff3e8;color:#E07820;border-left:3px solid #E07820;border-radius:0 8px 8px 0}
    .topbar{margin-left:220px;background:#fff;border-bottom:1px solid #e0e0e0;padding:11px 22px;display:flex;justify-content:space-between;align-items:center}
    .main-content{margin-left:220px;padding:22px}
    .btn-add{background:#1a3c8f;color:#fff;border:none;font-size:13px}
    .btn-add:hover{background:#142d6e;color:#fff}
    .btn-att{background:#E07820;color:#fff;border:none;font-size:13px}
    .btn-att:hover{background:#c06010;color:#fff}
    .tbl-wrap{background:#fff;border-radius:10px;overflow:hidden;box-shadow:0 1px 4px rgba(0,0,0,.06)}
    thead th{background:#f8f9fa;font-size:12.5px;font-weight:600;white-space:nowrap}
    tbody td{font-size:12.5px;vertical-align:middle}
    .badge-filtre{display:inline-flex;align-items:center;gap:6px;padding:5px 12px;border-radius:20px;font-size:12.5px;border:1px solid #ddd;background:#fff;cursor:pointer;transition:all .15s;user-select:none}
    .badge-filtre:hover{box-shadow:0 2px 6px rgba(0,0,0,.1)}
    .badge-filtre.active{border-width:2px;font-weight:600}
    .badge-filtre.active.f-ouvert{border-color:#3B82F6;background:#EFF6FF}
    .badge-filtre.active.f-verrou{border-color:#6B7280;background:#F3F4F6}
    .badge-filtre.active.f-attrib{border-color:#F59E0B;background:#FFFBEB}
    .badge-filtre.active.f-soutenu{border-color:#F97316;background:#FFF7ED}
    .dot{width:10px;height:10px;border-radius:50%;display:inline-block;flex-shrink:0}
    .d-bleu{background:#3B82F6}.d-verrou{background:#6B7280}
    .d-attrib{background:#F59E0B}.d-soutenu{background:#F97316}.d-tous{background:#aaa}
    .badge-statut{font-size:11px;padding:3px 8px;border-radius:12px;font-weight:500}
    .bs-ouvert{background:#EFF6FF;color:#1d4ed8}.bs-verrou{background:#F3F4F6;color:#374151}
    .bs-attrib{background:#FFFBEB;color:#b45309}.bs-soutenu{background:#FFF7ED;color:#c2410c}
    .desc-cell{max-width:150px;white-space:nowrap;overflow:hidden;text-overflow:ellipsis;cursor:help;color:#1a3c8f;text-decoration:underline dotted}
    .stag-badge{display:inline-block;background:#EFF6FF;color:#1d4ed8;border-radius:12px;padding:2px 8px;font-size:11px;margin:1px;white-space:nowrap}
    .voir-plus{color:#E07820;cursor:pointer;font-size:11px;text-decoration:underline;white-space:nowrap}
    #pop{display:none;position:fixed;background:#fff;border:1px solid #ddd;border-radius:10px;padding:14px 16px;max-width:290px;box-shadow:0 4px 18px rgba(0,0,0,.13);z-index:9999;font-size:12.5px;pointer-events:none;line-height:1.6}
    #pop strong{color:#1a3c8f;display:block;margin-bottom:6px;font-size:13px}
    #popStag{display:none;position:fixed;background:#fff;border:2px solid #1a3c8f;border-radius:10px;padding:14px 16px;min-width:200px;max-width:280px;box-shadow:0 4px 18px rgba(0,0,0,.15);z-index:9999;font-size:12.5px;line-height:1.8}
    #popStag .pop-title{color:#1a3c8f;font-weight:600;border-bottom:1px solid #dde5f5;padding-bottom:6px;margin-bottom:8px;font-size:13px}
    #popStag .pop-close{position:absolute;top:8px;right:10px;cursor:pointer;color:#aaa;font-size:16px;line-height:1}
    .form-label{font-size:13px;font-weight:500;color:#333;margin-bottom:3px}
    .form-control,.form-select{font-size:13px;border-radius:8px;border:1px solid #d0d7e3}
    .form-control:focus,.form-select:focus{border-color:#1a3c8f;box-shadow:0 0 0 2px rgba(26,60,143,.15)}
    .stag-row{display:flex;gap:6px;margin-bottom:6px;align-items:center}
    .stag-row input{flex:1}
    .toast-container{position:fixed;bottom:20px;right:20px;z-index:9999}

    /* UN SEUL RECTANGLE SUJET */
    .sujet-box{border:2px solid #1a3c8f;border-radius:10px;overflow:hidden;background:#f0f4ff}
    .sujet-box-header{padding:10px 14px 8px;border-bottom:1px solid #c0cbdf;background:#f0f4ff}
    .sujet-box input{border:none;border-bottom:1px solid #c0cbdf;border-radius:0;
                     background:#fff;width:100%;padding:9px 14px;font-size:13px;outline:none}
    .sujet-box input:focus{background:#fffde8}
    .sujet-box select{border:none;border-radius:0;background:#f0f4ff;
                      width:100%;padding:9px 14px;font-size:13px;outline:none;cursor:pointer}
    .sujet-box select:focus{background:#e8f0fe}
    .sujet-box .info-sujet{padding:8px 14px;background:#e8edf8;font-size:12px;
                            border-top:1px solid #c0cbdf;display:none}
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
    <a href="/encadrant/sujets" class="nav-link active"><i class="bi bi-mortarboard"></i> Sujets</a>
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
    <small class="text-muted">Rôle : Encadrant</small>
    <i class="bi bi-person-circle fs-4 text-secondary"></i>
  </div>
</div>

<!-- CONTENU -->
<div class="main-content">
  <h5 class="mb-3" style="font-weight:700">Liste des sujets</h5>

  <div class="mb-3" style="max-width:380px">
    <div class="input-group input-group-sm">
      <span class="input-group-text bg-white"><i class="bi bi-search"></i></span>
      <input type="text" id="searchInput" class="form-control" placeholder="Rechercher un sujet...">
    </div>
  </div>

  <div class="mb-3 d-flex gap-2 flex-wrap">
    <button class="btn btn-add btn-sm rounded-3 px-3" onclick="ouvrirAjout()">
      <i class="bi bi-plus-lg"></i> Ajouter
    </button>
    <button class="btn btn-att btn-sm rounded-3 px-3" onclick="ouvrirAttribution()">
      <i class="bi bi-person-check"></i> Attribuer
    </button>
  </div>

  <div class="d-flex flex-wrap gap-2 mb-3">
    <span class="badge-filtre active" data-s="tous" onclick="filtrer(this,'tous')">
      <span class="dot d-tous"></span>Tous</span>
    <span class="badge-filtre f-ouvert" data-s="non_attribue_ouvert" onclick="filtrer(this,'non_attribue_ouvert')">
      <span class="dot d-bleu"></span>Non attribué ouvert</span>
    <span class="badge-filtre f-verrou" data-s="non_attribue_verrouille" onclick="filtrer(this,'non_attribue_verrouille')">
      <span class="dot d-verrou"></span><i class="bi bi-lock-fill" style="font-size:10px"></i> Non attribué verrouillé</span>
    <span class="badge-filtre f-attrib" data-s="attribue" onclick="filtrer(this,'attribue')">
      <span class="dot d-attrib"></span>Attribué</span>
    <span class="badge-filtre f-soutenu" data-s="soutenu" onclick="filtrer(this,'soutenu')">
      <span class="dot d-soutenu"></span>Soutenu</span>
  </div>

  <p class="text-muted mb-2" style="font-size:12px"><span id="compteur">0</span> sujet(s)</p>

  <div class="tbl-wrap">
    <table class="table table-bordered table-hover mb-0">
      <thead>
        <tr>
          <th>ID</th><th>Domaine</th><th>Sujet</th><th>Proposé par</th>
          <th>Année</th>
          <th>Description <i class="bi bi-info-circle text-primary"></i></th>
          <th>Statut</th>
          <th>Stagiaire(s)</th>
          <th>Action</th>
        </tr>
      </thead>
      <tbody id="tbody">
        <tr><td colspan="9" class="text-center py-4">Chargement...</td></tr>
      </tbody>
    </table>
  </div>
</div>

<!-- POPOVER description -->
<div id="pop">
  <strong id="pop-titre"></strong>
  <span id="pop-texte"></span>
</div>

<!-- POPOVER tous les stagiaires -->
<div id="popStag" style="position:fixed">
  <span class="pop-close" onclick="fermerPopStag()">✕</span>
  <div class="pop-title"><i class="bi bi-people"></i> Tous les stagiaires</div>
  <div id="popStagListe"></div>
</div>

<!-- ═══════════════════════════
     MODAL AJOUTER / MODIFIER
     ═══════════════════════════ -->
<div class="modal fade" id="modalSujet" tabindex="-1">
  <div class="modal-dialog"><div class="modal-content">
    <div class="modal-header" style="background:#1a3c8f">
      <h5 class="modal-title text-white" id="mTitre">Ajouter un sujet</h5>
      <button class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
    </div>
    <div class="modal-body">
      <input type="hidden" id="sId">
      <div class="row g-2">
        <div class="col-6">
          <label class="form-label">Domaine <span style="color:red">*</span></label>
          <input type="text" id="fDom" class="form-control" placeholder="ex: Informatique">
        </div>
        <div class="col-6">
          <label class="form-label">Proposé par <span style="color:red">*</span></label>
          <input type="text" id="fProp" class="form-control" placeholder="Dr. Nom">
        </div>
        <div class="col-8">
          <label class="form-label">Sujet <span style="color:red">*</span></label>
          <input type="text" id="fSuj" class="form-control" placeholder="Titre du sujet">
        </div>
        <div class="col-4">
          <label class="form-label">Année <span style="color:red">*</span></label>
          <input type="number" id="fAnn" class="form-control" placeholder="2024">
        </div>
        <div class="col-12">
          <label class="form-label">Description courte</label>
          <input type="text" id="fDesc" class="form-control">
        </div>
        <div class="col-12">
          <label class="form-label">Description détaillée</label>
          <textarea id="fDescD" class="form-control" rows="3"></textarea>
        </div>
        <div class="col-12">
          <label class="form-label">Statut</label>
          <select id="fStat" class="form-select">
            <option value="non_attribue_ouvert">Non attribué ouvert</option>
            <option value="non_attribue_verrouille">Non attribué verrouillé</option>
            <option value="attribue">Attribué</option>
            <option value="soutenu">Soutenu</option>
          </select>
        </div>
      </div>
    </div>
    <div class="modal-footer">
      <button class="btn btn-secondary btn-sm" data-bs-dismiss="modal">Annuler</button>
      <button class="btn btn-add btn-sm text-white" onclick="sauvegarder()">Enregistrer</button>
    </div>
  </div></div>
</div>

<!-- ══════════════════════════════════════════
     MODAL ATTRIBUER
     ══════════════════════════════════════════ -->
<div class="modal fade" id="modalAttrib" tabindex="-1">
  <div class="modal-dialog modal-lg"><div class="modal-content">
    <div class="modal-header btn-att">
      <h5 class="modal-title text-white">
        <i class="bi bi-person-check"></i> Attribuer un sujet à un stagiaire
      </h5>
      <button class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
    </div>
    <div class="modal-body">
      <div class="row g-3">

        <!-- ══ UN SEUL RECTANGLE BLEU : écrire OU choisir ══ -->
        <div class="col-md-6">
          <div class="sujet-box">

            <!-- En-tête -->
            <div class="sujet-box-header">
              <label class="form-label fw-semibold mb-0" style="color:#1a3c8f">
                <i class="bi bi-mortarboard"></i> sujet
              </label>
            </div>

            <!-- Champ texte : écrire et filtrer -->
            <input type="text" id="aSujetTexte"
                   placeholder="✏️ Tapez pour filtrer la liste..."
                   oninput="filtrerListeSujets(this.value)">

            <!-- Liste déroulante collée -->
            <select id="aSujetSelect" onchange="selSujet(this.value)">
              <option value="">📋  sélectionner dans la liste...</option>
            </select>

            <!-- Info sujet sélectionné -->
            <div class="info-sujet" id="aSujetInfo"></div>
          </div>
        </div>

        <!-- ══ RECTANGLE ORANGE : stagiaires ══ -->
        <div class="col-md-6">
          <div style="border:2px solid #E07820;border-radius:10px;padding:14px;background:#fff8f0">
            <label class="form-label fw-semibold mb-1" style="color:#E07820">
              <i class="bi bi-people"></i> Stagiaire(s)
            </label>
            <p style="font-size:11px;color:#888;margin-bottom:8px">

            </p>
            <div id="stagiairesContainer">
              <div class="stag-row">
                <input type="text" class="form-control form-control-sm stag-nom" placeholder="Nom">
                <input type="text" class="form-control form-control-sm stag-prenom" placeholder="Prénom">
              </div>
            </div>
            <button class="btn btn-outline-warning btn-sm mt-2 w-100" onclick="ajouterStagiaire()">
              <i class="bi bi-plus-circle"></i> Ajouter un autre stagiaire
            </button>
          </div>
        </div>

        <!-- Récapitulatif -->
        <div class="col-12">
          <div id="aResume" style="display:none;background:#fff3e8;border:1px solid #E07820;
               border-radius:8px;padding:12px;font-size:13px">
            <strong style="color:#E07820">Récapitulatif :</strong>
            <div id="aResumeTxt" class="mt-1"></div>
          </div>
        </div>

      </div>
    </div>
    <div class="modal-footer">
      <button class="btn btn-secondary btn-sm" data-bs-dismiss="modal">Annuler</button>
      <button class="btn btn-att btn-sm text-white" onclick="confirmerAttribution()">
        <i class="bi bi-check-circle"></i> Confirmer l'attribution
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
var filtreActuel = 'tous';
var sujetsData = [];

// ══ Charger sujets ══
function charger(statut, search) {
  $.ajax({
    url: '/encadrant/sujets/liste',
    data: { statut: statut || filtreActuel, search: search || $('#searchInput').val() },
    success: function(data) {
      sujetsData = data;
      $('#compteur').text(data.length);
      var html = '';
      if (!data.length) {
        html = '<tr><td colspan="9" class="text-center text-muted py-4">Aucun sujet trouvé</td></tr>';
      } else {
        data.forEach(function(s) {
          var dotCl   = {non_attribue_ouvert:'d-bleu',non_attribue_verrouille:'d-verrou',attribue:'d-attrib',soutenu:'d-soutenu'}[s.statut]||'d-bleu';
          var badgeCl = {non_attribue_ouvert:'bs-ouvert',non_attribue_verrouille:'bs-verrou',attribue:'bs-attrib',soutenu:'bs-soutenu'}[s.statut]||'bs-ouvert';
          var statLabel = s.statut.replace(/_/g,' ');
          var descD = (s.description_detaillee||'').replace(/'/g,"\\'").replace(/\n/g,' ');

          // Colonne stagiaires : afficher TOUS
          var stagCol = '<span class="text-muted">—</span>';
          var allStags = [];
          if (s.stagiaires && s.stagiaires.length > 0) {
            allStags = s.stagiaires;
          } else if (s.stagiaire) {
            allStags = [s.stagiaire];
          }

          if (allStags.length === 1) {
            stagCol = '<span class="stag-badge">'
              + allStags[0].prenom + ' ' + allStags[0].nom + '</span>';
          } else if (allStags.length > 1) {
            var stagsJson = JSON.stringify(allStags)
              .replace(/&/g,'&amp;').replace(/"/g,'&quot;').replace(/'/g,'&#39;');
            stagCol = '<span class="stag-badge">'
              + allStags[0].prenom + ' ' + allStags[0].nom + '</span> '
              + '<span class="voir-plus" onclick="afficherTousStags(event,\''
              + stagsJson + '\')">'
              + '+' + (allStags.length - 1) + ' autre(s) ▾</span>';
          }

          html += '<tr>'
            +'<td>'+s.id+'</td>'
            +'<td>'+s.domaine+'</td>'
            +'<td>'+s.sujet+'</td>'
            +'<td>'+s.propose_par+'</td>'
            +'<td>'+s.annee_proposee+'</td>'
            +'<td class="desc-cell" onmouseenter="showPop(event,\''+s.sujet.replace(/'/g,"\\'")+"','"+descD+'\')" onmouseleave="hidePop()">'+(s.description||'—')+'</td>'
            +'<td><span class="badge-statut '+badgeCl+'"><span class="dot '+dotCl+'" style="width:7px;height:7px;margin-right:4px"></span>'+statLabel+'</span></td>'
            +'<td>'+stagCol+'</td>'
            +'<td style="white-space:nowrap">'
            +'<button class="btn btn-outline-primary btn-sm me-1" onclick="ouvrirModif('+s.id+')"><i class="bi bi-pencil"></i> Modifier</button>'
            +'<button class="btn btn-outline-danger btn-sm" onclick="supprimer('+s.id+')"><i class="bi bi-trash"></i> Supprimer</button>'
            +'</td></tr>';
        });
      }
      $('#tbody').html(html);
    },
    error: function() {
      $('#tbody').html('<tr><td colspan="9" class="text-center text-danger py-4">Erreur de chargement</td></tr>');
    }
  });
}

function filtrer(el, statut) {
  filtreActuel = statut;
  $('.badge-filtre').removeClass('active');
  $(el).addClass('active');
  charger(statut);
}
$('#searchInput').on('input', function(){ charger(filtreActuel, $(this).val()); });

// ── Popover description ──
function showPop(e, titre, texte) {
  if (!texte) return;
  $('#pop-titre').text(titre);
  $('#pop-texte').text(texte);
  document.getElementById('pop').style.display='block';
  movePop(e);
}
function movePop(e) {
  var p=document.getElementById('pop');
  p.style.left=(e.clientX+14)+'px';
  p.style.top=(e.clientY+14)+'px';
}
function hidePop(){ document.getElementById('pop').style.display='none'; }
document.addEventListener('mousemove',function(e){
  if(document.getElementById('pop').style.display==='block') movePop(e);
});

// ── Popover tous les stagiaires ──
function afficherTousStags(event, json) {
  event.stopPropagation();
  var stags;
  try {
    var decoded = json.replace(/&quot;/g,'"').replace(/&#39;/g,"'").replace(/&amp;/g,'&');
    stags = JSON.parse(decoded);
  } catch(e) { return; }

  var html = '';
  stags.forEach(function(st, i){
    html += '<div style="display:flex;align-items:center;gap:6px;padding:3px 0">'
      + '<i class="bi bi-person-circle text-primary"></i>'
      + ' <strong>'+(i+1)+'.</strong> '+st.prenom+' '+st.nom
      + '</div>';
  });
  $('#popStagListe').html(html);

  var pop = document.getElementById('popStag');
  pop.style.display = 'block';
  var x = event.clientX + 10;
  var y = event.clientY + 10;
  if (x + 280 > window.innerWidth) x = event.clientX - 290;
  if (y + 200 > window.innerHeight) y = event.clientY - 160;
  pop.style.left = x + 'px';
  pop.style.top  = y + 'px';
}
function fermerPopStag() {
  document.getElementById('popStag').style.display = 'none';
}
document.addEventListener('click', function(e) {
  var pop = document.getElementById('popStag');
  if (pop && !pop.contains(e.target) && !e.target.classList.contains('voir-plus')) {
    pop.style.display = 'none';
  }
});

// ── MODAL Ajouter ──
function ouvrirAjout() {
  $('#sId,#fDom,#fSuj,#fProp,#fAnn,#fDesc,#fDescD').val('');
  $('#fStat').val('non_attribue_ouvert');
  $('#mTitre').text('Ajouter un sujet');
  new bootstrap.Modal('#modalSujet').show();
}

// ── MODAL Modifier ──
function ouvrirModif(id) {
  $.get('/encadrant/sujets/'+id, function(s) {
    $('#sId').val(s.id); $('#fDom').val(s.domaine); $('#fSuj').val(s.sujet);
    $('#fProp').val(s.propose_par); $('#fAnn').val(s.annee_proposee);
    $('#fDesc').val(s.description); $('#fDescD').val(s.description_detaillee);
    $('#fStat').val(s.statut); $('#mTitre').text('Modifier le sujet');
    new bootstrap.Modal('#modalSujet').show();
  });
}

function sauvegarder() {
  var id = $('#sId').val();
  $.ajax({
    url: id ? '/encadrant/sujets/'+id : '/encadrant/sujets',
    type: id ? 'PUT' : 'POST',
    data: { _token:TOKEN, domaine:$('#fDom').val(), sujet:$('#fSuj').val(),
            propose_par:$('#fProp').val(), annee_proposee:$('#fAnn').val(),
            description:$('#fDesc').val()||'—', description_detaillee:$('#fDescD').val(),
            statut:$('#fStat').val() },
    success: function() {
      bootstrap.Modal.getInstance('#modalSujet').hide();
      charger();
      toast(id?'Sujet modifié !':'Sujet ajouté !','success');
    },
    error: function(x){
      var msg = x.responseJSON && x.responseJSON.errors
        ? Object.values(x.responseJSON.errors).flat().join(' | ') : 'Erreur : vérifiez les champs';
      toast(msg,'danger');
    }
  });
}

function supprimer(id) {
  if(!confirm('Supprimer ce sujet ?')) return;
  $.ajax({ url:'/encadrant/sujets/'+id, type:'DELETE', data:{_token:TOKEN},
    success: function(){ charger(); toast('Sujet supprimé !','warning'); }
  });
}

// ══ MODAL ATTRIBUER ══
function ouvrirAttribution() {
  $('#aSujetTexte').val('');
  $('#aSujetInfo').hide();
  $('#aResume').hide();
  $('#stagiairesContainer').html(
    '<div class="stag-row">'
    +'<input type="text" class="form-control form-control-sm stag-nom" placeholder="Nom">'
    +'<input type="text" class="form-control form-control-sm stag-prenom" placeholder="Prénom">'
    +'</div>'
  );
  // Remplir la liste des sujets
  var opts = '<option value="">📋 Ou sélectionner dans la liste...</option>';
  sujetsData.forEach(function(s){
    opts += '<option value="'+s.id+'">['+s.id+'] '+s.sujet+' ('+s.domaine+')</option>';
  });
  $('#aSujetSelect').html(opts);
  new bootstrap.Modal('#modalAttrib').show();
}

// Filtrer la liste selon ce qu'on écrit
function filtrerListeSujets(texte) {
  var opts = '<option value="">📋 Ou sélectionner dans la liste...</option>';
  sujetsData.forEach(function(s){
    if (!texte || s.sujet.toLowerCase().includes(texte.toLowerCase())
               || s.domaine.toLowerCase().includes(texte.toLowerCase())) {
      opts += '<option value="'+s.id+'">['+s.id+'] '+s.sujet+' ('+s.domaine+')</option>';
    }
  });
  $('#aSujetSelect').html(opts);
  $('#aSujetInfo').hide();
}

// Quand on sélectionne dans la liste → remplir le champ texte
function selSujet(id) {
  if (!id) { $('#aSujetInfo').hide(); return; }
  var s = sujetsData.find(function(x){ return x.id == id; });
  if (s) {
    $('#aSujetTexte').val(s.sujet);
    $('#aSujetInfo').html('<b>'+s.sujet+'</b> — '+s.domaine+' ('+s.annee_proposee+')').show();
  }
}

// Ajouter une ligne stagiaire
function ajouterStagiaire() {
  $('#stagiairesContainer').append(
    '<div class="stag-row">'
    +'<input type="text" class="form-control form-control-sm stag-nom" placeholder="Nom">'
    +'<input type="text" class="form-control form-control-sm stag-prenom" placeholder="Prénom">'
    +'<button class="btn btn-outline-danger btn-sm px-2" onclick="$(this).closest(\'.stag-row\').remove()">'
    +'<i class="bi bi-x"></i></button>'
    +'</div>'
  );
}

// Confirmer l'attribution
function confirmerAttribution() {
  var sujetId = $('#aSujetSelect').val();

  if (!sujetId) {
    var texte = $('#aSujetTexte').val().trim().toLowerCase();
    if (!texte) { toast('Choisissez ou écrivez un sujet !','danger'); return; }
    var trouve = sujetsData.find(function(s){
      return s.sujet.toLowerCase().includes(texte);
    });
    if (!trouve) { toast('Sujet introuvable ! Choisissez dans la liste.','warning'); return; }
    sujetId = trouve.id;
  }

  var stagiaires = [];
  $('.stag-row').each(function(){
    var nom    = $(this).find('.stag-nom').val().trim();
    var prenom = $(this).find('.stag-prenom').val().trim();
    if (nom && prenom) stagiaires.push(nom+' '+prenom);
  });

  if (!stagiaires.length) {
    toast('Ajoutez au moins un stagiaire avec nom et prénom !','danger'); return;
  }

  var sujet = sujetsData.find(function(s){ return s.id == sujetId; });
  $('#aResumeTxt').html(
    '<i class="bi bi-mortarboard text-primary"></i> <b>'+(sujet?sujet.sujet:'')+'</b>'
    +' → <i class="bi bi-people text-success"></i> <b>'+stagiaires.join(', ')+'</b>'
  );
  $('#aResume').show();

  $.ajax({
    url: '/encadrant/sujets/attribuer', type:'POST',
    data: { _token:TOKEN, sujet_id:sujetId, stagiaires:JSON.stringify(stagiaires) },
    success: function() {
      bootstrap.Modal.getInstance('#modalAttrib').hide();
      charger();
      toast('Attribution réussie pour '+stagiaires.length+' stagiaire(s) !','success');
    },
    error: function(x){
      toast('Erreur : '+(x.responseJSON?x.responseJSON.message:'serveur'),'danger');
    }
  });
}

// ── Toast ──
function toast(msg, type) {
  var el = document.getElementById('toast');
  el.className = 'toast align-items-center text-white border-0 bg-'+type;
  document.getElementById('toastTxt').textContent = msg;
  new bootstrap.Toast(el,{delay:3500}).show();
}

$(document).ready(function(){ charger(); });
</script>
</body>
</html>
