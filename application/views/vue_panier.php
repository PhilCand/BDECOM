<?php
$this->table->set_heading('Titre', 'Prix', 'Quantité');
$template = array(
    'table_open' => '<table border="0" cellpadding="10" cellspacing="5" class="mytable">'
);
$this->table->set_template($template);
if (isset($_SESSION['panier'])) {
    foreach ($_SESSION['panier'] as $bd) {
        $this->table->add_row(
            $bd->titre,
            $bd->prix_public,
            $bd->qte,
            '<a href=' . base_url('Panier/retirerPanier/') . $bd->id . '><img class ="ctrl_panier" src=' . base_url('public/img/moins.jpg') . '></img></a>',
            '<a href=' . base_url('Panier/ajouterPanier/') . $bd->id . '><img class ="ctrl_panier" src=' . base_url('public/img/plus.jpg') . '></img></a>',
            '<a href=' . base_url('Panier/supprimerDuPanier/') . $bd->id . '><img class ="ctrl_panier" src=' . base_url('public/img/delete.jpg') . '></img></a>'
        );
    }
    echo anchor('Panier/clearPanier', 'Vider le panier', 'class="btn btn-secondary vider-panier"');
    echo '<div class="panier_container">';
    echo '<div class="panier">';
    echo $this->table->generate();
} else {
    echo '<div id="message">';
    echo 'Votre panier est vide <br>';
    echo anchor('Magasin', 'Reprendre vos achats');
    echo '</div>';
}
echo '</div>';
echo '</div>';
