
<?php
$this->load->helper('form');
$this->load->helper('url');

$options[-1] = "NOGENRE";
foreach ($genres as $genre) { 
  $options[$genre->id] = $genre->nom; 
}

$attributs = array(
  'class' => 'form-control select2'
);

echo form_open('magasin');
echo('<div id="recherche">');
echo form_dropdown('genres', $options, '-1', $attributs);
echo form_submit('search_submit', 'Rechercher', 'class="mt-auto btn btn-primary btn-recherche"' );
echo('</div>');
echo form_close();

?>

<a href="<?php echo base_url('Magasin/clearSession')?>" class="btn btn-secondary">Clear Session</a>

<a href="<?php echo base_url('Panier/clearPanier')?>" class="btn btn-secondary">Clear Panier</a>

<div class="d-flex flex-wrap justify-content-around">
  <?php
  $i = 0;
  foreach ($results as $bd) { ?>
    <div class="card">
      <img src="<?php echo base_url('public/couv/' . $bd->ref) ?>.jpg"  class="card-img-top" alt="couverture">
      <div class="card-body d-flex flex-column">
        <h6 class="card-title"><?php echo $bd->titre ?></h6>
        <h6 class="card-title"><?php echo $bd->prix_public.' €' ?></h6>
        <button type="button" class="mt-auto btn btn-secondary" data-toggle="modal" data-target="#exampleModal<?php echo $i ?>">
          Résumé
        </button>
        <a href="<?php echo base_url('Panier/ajouterPanier/'.$bd->id)?>" class="mt-auto btn btn-primary">Ajouter au panier</a>
      </div>
    </div>

    <!-- Modal -->
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
            <?php echo $bd->resume; ?>
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
  ?>
</div>

<div id="pagination-container">
  <div id="pagination">
    <?php echo $links; ?>
  </div>
</div>