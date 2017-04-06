<?php 

// Cette page a pour fonction d'afficher une liste de films sortis en Blueray

// Contient la date courante 
$current_date = date("d/m/Y");


// Contient le titre de la page 
$title = "Ma liste de films du " . $current_date;

// Contient les données de films 
$data = array ();

if (($handle = fopen("films.csv", "r")) !== FALSE) {
    while (($row = fgetcsv($handle, 1000, ",")) !== FALSE) {
        // var_dump($row);
        array_push($data, $row);
        // $data[] = $row;
    }
    fclose($handle);
}

// var_dump($data);

?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="utf-8" />
    <title>
        <?php echo $title; ?> </title>
    <link href="css/bootstrap.min.css" rel="stylesheet" />
</head>

<body>
    <nav class="navbar navbar-default" role="navigation">
        <div class="container">
            <div class="collapse navbar-collapse">
                <ul class="nav navbar-nav">
                    <li class="active"> <a href="/"> Films </a></li>
                    <li> <a href="#"> A propos </a></li>
                    <li> <a href="#"> Contact </a></li>
                </ul>
            </div>
        </div>
    </nav>
    <div class="container">
        <h1>
            <?php echo $title; ?> </h1>
            <p> Voici ma liste de films à regarder. Merci de ne pas télécharger illégalement. Pour plus d'informations, attendre la suite du cours </p>
        <?php if (count($data)>1) : ?>
        <h2>
            <?php printf("J'ai actuellement %s films à regarder : ", count($data)-1); ?> </h2>
        <ul>
            <?php
    for ($i=0; $i<count($data); $i++) : 
    if ($i>0) : ?>
                <li>
                    <?php echo $data[$i][1]; ?> </li>
                <?php endif; ?>
                <?php endfor; ?>
        </ul>
        <?php else : ?>
        <h2> Je n'ai pas de films à visionner actuellement. </h2>
        <?php endif; ?>

    </div>
</body>

</html>