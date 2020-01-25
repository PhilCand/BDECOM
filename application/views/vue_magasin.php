<?php
$this->load->helper('form');
$this->load->helper('url');

$options[-1] = "TOUS LES GENRES";
foreach ($genres as $genre) {
  $options[$genre->id] = $genre->nom;
}

$attributs = array(
  'class' => 'form-control select2'
);

echo form_open('magasin');
echo ('<div id="recherche">');
echo form_dropdown('genres', $options, isset($_SESSION["genre"]) ? $_SESSION["genre"] : '-1', $attributs);
echo form_submit('search_submit', 'Rechercher', 'class="mt-auto btn btn-outline-info btn-recherche"');
echo ('</div>');
echo form_close();
?>

<!-- <a href="<?php echo base_url('Magasin/clearSearch') ?>" class="btn btn-secondary">Clear Session</a>

<a href="<?php echo base_url('Panier/clearPanier') ?>" class="btn btn-secondary">Clear Panier</a> -->

<div class="d-flex flex-wrap justify-content-around content">
  <?php
  $i = 0;
  if ($results != false) {
    foreach ($results as $bd) { ?>
      <div class="card">
        <img src="<?php echo base_url('public/couv/' . $bd->ref) ?>.jpg" class="card-img-top" onerror="if (this.src != 'error.jpg') this.src = '<?php echo base_url('public/couv/defaut.jpg') ?>';">
        <div class="card-body d-flex flex-column">
          <h6 class="card-title titre"><?php echo $bd->titre ?></h6>
          <h6 class="card-title prix"><?php echo $bd->prix_public != null ?  $bd->prix_public . ' €' : '&nbsp' ?></h6>
          <button type="button" class="mt-auto btn btn-outline-secondary" data-toggle="modal" data-target="#exampleModal<?php echo $i ?>">Détail</button>
          <div class="espace"></div>
          <?php
          if ($bd->prix_public == null) { ?>
            <a href="<?php echo base_url('Panier/ajouterPanier/' . $bd->id) ?>" class="mt-auto btn btn-outline-success disabled">Ajouter au panier</a>
          <?php } else { ?> <a href="<?php echo base_url('Panier/ajouterPanier/' . $bd->id) ?>" class="mt-auto btn btn-outline-success">Ajouter au panier</a>
          <?php } ?>

        </div>
      </div>

      <!-- Modal detail -->
      <div class="modal fade" id="exampleModal<?php echo $i ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel<?php echo $i ?>" aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel<?php echo $i ?>"><?php echo $bd->titre ?></h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">

              <div class="accordion" id="accordionResume">
                <div class="card" style="width:100%">
                  <div class="card-header" id="headingOne">
                    <h2 class="mb-0">
                      <button class="btn btn-outline-secondary" type="button" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">Résumé</button>
                    </h2>
                  </div>

                  <div id="collapseOne" class="collapse" aria-labelledby="headingOne" data-parent="#accordionResume">
                    <div class="card-body">
                      <?php echo '<p>' . $bd->resume . '</p>'; ?>
                    </div>
                  </div>
                </div>
              </div>

              <?php echo '<p><strong>Auteur : </strong>' . $bd->nom_auteur . '</p>' ?>
              <?php echo '<p><strong>Editeur : </strong>' . $bd->nom_editeur . '</p>' ?>
              <?php echo '<p><strong>Réf fournisseur : </strong>' . $bd->ref_fournisseur . '</p>' ?>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Fermer</button>

            </div>
          </div>
        </div>
      </div>

  <?php
      $i++;
    }
  }else echo '<p id="noresult">Pas de résultat.</p>';
  ?>

</div>

<div id="pagination-container">
  <div id="pagination">
    <?php echo $links; ?>
  </div>
</div>