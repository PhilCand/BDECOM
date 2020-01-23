<?php $this->load->helper('html');
$this->load->helper('url'); 

if (isset($_SESSION['panier'])){
    $qte = 0;
    foreach($_SESSION['panier'] as $bd){
        $qte += $bd->qte;
    }
}

?>

<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <?php echo link_tag(base_url('public/CSS/style.css')); ?>
    <script src="<?php echo base_url('public/js/script.js') ?>"></script>
    <title>Magasin BD</title>
</head>

<body>
    
<nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
    <a class="navbar-brand mr-sm-5" href="#">BD Shop</a><br>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav">
                <li ><?php echo anchor('Magasin/clearSession', 'Magasin', 'class="mt-auto btn btn-secondary mr-sm-3"') ?></li>
                <li ><?php echo anchor('Panier', isset($_SESSION['panier']) ? 'Panier : '.$qte : 'Panier', 'class="mt-auto btn btn-outline-success mr-sm-3"') ?></li>

            </ul>

    </nav>
