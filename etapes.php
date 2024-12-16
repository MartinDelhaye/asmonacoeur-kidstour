<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Evenements</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <?php
    $tab = [
        ["illustratiom" => "url",
        "titre"=>"exemple titre",
        "texte"=>"Exemple texte",
        "id_etape" =>"1"],
        ["illustratiom" => "url",
        "titre"=>"exemple titre",
        "texte"=>"Exemple texte",
        "id_etape" =>"1"],
        ["illustratiom" => "url",
        "titre"=>"exemple titre",
        "texte"=>"Exemple texte",
        "id_etape" =>"1"]
    ];
    foreach($tab as $etape):?>
        <?php echo '<a href="etape.php?id_etape='.$etape["id_etape"].'">' ?>
        <div class="container">
        <div class="row mb-4 align-items-center text-center">
            <!-- Colonne pour l'image -->
            <div class="col-md-6 d-flex justify-content-center">
            <img src="<?php echo $etape["illustration"]?>" class="img-fluid" alt="AS Monacoeur Kids Tour Fayence">
            </div>
            <!-- Colonne pour le texte -->
            <div class="col-md-6 d-flex flex-column justify-content-center">
                <h5 class="fw-bold" style="color: red;"><?php echo $etape["titre"]?></h5>
                <p>
                <?php echo $etape["texte"]?>
                </p>
            </div>
        </div>
    </div>
<?php endforeach;?>
     
</body>
</html>