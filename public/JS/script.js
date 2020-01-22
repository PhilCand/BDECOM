function test(){
    alert(document.getElementById('genres').value);
    $('#monBouton').click(function() {
        // L'URL du fichier dans lequel tu appelles ta fonctio
        var url = '/Magasin.php';
        $.post(url, testAppel()
            
        );
    });
}
