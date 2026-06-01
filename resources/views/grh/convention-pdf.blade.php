<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <title>Convention de stage N°{{ $contrat->id }}</title>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.4.1/html2canvas.min.js"></script>
  <style>
    *{margin:0;padding:0;box-sizing:border-box}
    body{font-family:'Times New Roman',serif;font-size:13px;color:#111;background:#fff}
    #zoneDoc{width:210mm;min-height:297mm;padding:15mm 20mm;margin:0 auto;background:#fff}
    .conv-header{display:flex;justify-content:space-between;align-items:flex-start;margin-bottom:20px;padding-bottom:16px;border-bottom:2px solid #E07820}
    .conv-header-left{font-size:12px;color:#555;line-height:1.8}
    .conv-header-right img{width:90px}
    .conv-title{text-align:center;margin:20px 0;font-size:16px;font-weight:bold;color:#1a3c8f;border:2px solid #1a3c8f;padding:10px}
    .conv-num{text-align:center;font-size:13px;margin-bottom:20px;color:#555}
    .conv-body p{margin-bottom:10px;line-height:1.8;text-align:justify}
    .conv-article{font-weight:bold;color:#1a3c8f;margin-top:16px;margin-bottom:6px;font-size:13.5px}
    .conv-field{border-bottom:1px solid #333;display:inline-block;min-width:200px;margin:0 4px}
    .conv-signatures{display:flex;justify-content:space-between;margin-top:40px;padding-top:20px;border-top:1px solid #ddd}
    .conv-sig{text-align:center;width:45%}
    .conv-sig strong{display:block;margin-bottom:40px;font-size:13px}
    .conv-sig .line{border-bottom:1px solid #333;width:200px;margin:0 auto}
    #btn-dl{position:fixed;top:10px;right:10px;z-index:999;background:#1a3c8f;color:#fff;border:none;padding:10px 20px;border-radius:8px;font-size:14px;cursor:pointer}
    #btn-dl:hover{background:#142d6e}
  </style>
</head>
<body>

<button id="btn-dl" onclick="telecharger()">⬇ Télécharger PDF</button>

<div id="zoneDoc">
  <div class="conv-header">
    <div class="conv-header-left">
      <strong>Exploration & Production</strong><br>
      Division Exploration<br>
      GPR/DRH/SCE. Formation
    </div>
    <div class="conv-header-right">
      <img src="{{ asset('sonatrach.webp') }}" alt="Sonatrach">
    </div>
  </div>

  <div class="conv-title">Convention de Stage</div>
  <div class="conv-num">N° {{ $contrat->id }} / {{ date('Y') }}</div>

  <div class="conv-body">
    <p><strong>Entre,</strong></p>
    <p>La Société Nationale pour la Recherche, la Production, le Transport, la Transformation et la Commercialisation des Hydrocarbures, dénommée « <strong>Sonatrach</strong> », dont le siège social est à Djenane El Malik Hydra Alger, représentée par Monsieur <strong>ZEBBOUDJ Mourad</strong>, Directeur Gestion du Personnel de la Division Exploration.</p>
    <p><strong>D'une part,</strong></p>
    <p><strong>Et,</strong></p>
    <p><span class="conv-field">{{ $contrat->organisme ?? '' }}</span></p>
    <p>Représenté par <span class="conv-field">&nbsp;</span></p>
    <p><strong>D'autre part,</strong></p>
    <p><strong>Il est convenu et arrêté ce qui suit :</strong></p>

    <p class="conv-article">Article 1 : Objet de la Convention</p>
    <p>La présente convention a pour objet de définir les conditions et les modalités d'organisation et de réalisation d'un stage pratique au profit de :</p>
    <p><strong>{{ $contrat->noms_stagiaires ?? ($contrat->nom . ' ' . $contrat->prenom) }}</strong></p>
    <p>Etudiant(e)s inscrit(e)s auprès de l'Etablissement sus cité.</p>

    <p class="conv-article">Article 2 : Lieu et durée du stage</p>
    <p>Le stage pratique se déroulera à <strong>Boumerdès – Division Exploration / Sonatrach</strong>.</p>
    <p>pour la période allant du <span class="conv-field">{{ $contrat->date_debut }}</span> au <span class="conv-field">{{ $contrat->date_fin }}</span>.</p>
    <p>Cette durée pourra être prolongée dans la limite des capacités d'accueil.</p>

    <p class="conv-article">Article 3 : Objectifs du stage</p>
    <p>- L'acquisition et le renforcement des connaissances pratiques sur les réalités de l'Entreprise.</p>
    <p>- L'intégration progressive des stagiaires dans le milieu professionnel.</p>
    <p>- La contribution des stagiaires à l'amélioration des performances de l'Entreprise.</p>

    <p class="conv-article">Article 4 : Le contenu du stage</p>
    <p>Le programme du stage sera établi par le maitre de stage de l'Entreprise, ici dénommé « Encadreur ».</p>
    <p><strong>Thème :</strong> <span class="conv-field">{{ $contrat->theme ?? '' }}</span></p>

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

    <p style="margin-top:20px">Fait en trois (03) exemplaires à Boumerdès, le <span class="conv-field">&nbsp;</span></p>
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

<script>
function telecharger() {
  var btn = document.getElementById('btn-dl');
  btn.style.display = 'none';

  var { jsPDF } = window.jspdf;
  var element = document.getElementById('zoneDoc');

  html2canvas(element, {
    scale: 2,
    useCORS: true,
    allowTaint: true,
    backgroundColor: '#ffffff',
    width: element.offsetWidth,
    height: element.offsetHeight,
    scrollX: 0,
    scrollY: 0
  }).then(function(canvas) {
    var pdf = new jsPDF('p', 'mm', 'a4');
    var pageW  = pdf.internal.pageSize.getWidth();
    var pageH  = pdf.internal.pageSize.getHeight();
    var imgW   = pageW;
    var imgH   = (canvas.height * pageW) / canvas.width;
    var imgData = canvas.toDataURL('image/jpeg', 1.0);

    if (imgH <= pageH) {
      pdf.addImage(imgData, 'JPEG', 0, 0, imgW, imgH);
    } else {
      var position = 0;
      while (position < imgH) {
        pdf.addImage(imgData, 'JPEG', 0, -position, imgW, imgH);
        position += pageH;
        if (position < imgH) pdf.addPage();
      }
    }
    pdf.save('convention_{{ $contrat->id }}.pdf');
    btn.style.display = 'block';
  });
}
</script>
</body>
</html>
