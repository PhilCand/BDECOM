<?php


$this->table->set_heading('Titre', 'Prix', 'Quantité');

if (isset($_SESSION['panier'])) {

    foreach ($_SESSION['panier'] as $bd) {
        $this->table->add_row(
            $bd->titre,
            $bd->prix_public,
            $bd->qte,
            '<a href=' . base_url('Panier/retirerPanier/') . $bd->id . '><img src=' . base_url('public/img/moins.jpg') . '></img></a>',
            '<a href=' . base_url('Panier/ajouterPanier/') . $bd->id . '><img src=' . base_url('public/img/plus.jpg') . '></img></a>',
            '<a href=' . base_url('Panier/supprimerDuPanier/') . $bd->id . '><img src=' . base_url('public/img/delete.jpg') . '></img></a>'
        );

        //'<a href='.base_url('Panier/supprimerDuPanier/').$bd->id.'><img src='.base_url('public/img/delete.jpg').'></img></a>';
    }



    echo $this->table->generate();
} else {
    echo '<div id="message">';
    echo 'Votre panier est vide <br>';
    echo anchor('Magasin', 'Reprendre vos achats');
    echo '</div>';
}
