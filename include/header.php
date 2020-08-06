<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <title>Trappes web</title>
</head>
<body>
    <nav class="navbar navbar-expand-md navbar-dark bg-dark">
        <a class="navbar-brand" href="home.php">Trappes</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsExample04" aria-controls="navbarsExample04" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarsExample04">
            <ul class="navbar-nav mr-auto">
            
            <?php  if(connect()): // Accès à un membre connecté (non ADMIN) ?>
                <li class="nav-item active">
                    <a class="nav-link" href="<?= URL ?>sondage.php">Sondages</a>
                </li>
                <li class="nav-item active">
                    <a class="nav-link" href="<?= URL ?>forum.php">Forum</a>
                </li>
                <li class="nav-item active">
                    <a class="nav-link" href="<?= URL ?>artisans.php">Artisans</a>
                </li>

                <li class="nav-item active">
                    <a class="nav-link" href="<?= URL ?>connexion.php">Mon Compte</a>
                </li>
                <li class="nav-item active">
                    <a class="nav-link" href="<?= URL ?>connexion.php?action=deconnexion">Deconnexion</a>
                </li>

            <?php  else: // visiteur lambda (non connecté) ?>

                <li class="nav-item active">
                    <a class="nav-link" href="<?= URL ?>sondage.php">Sondages</a>
                </li>
                <li class="nav-item active">
                    <a class="nav-link" href="<?= URL ?>forum.php">Forum</a>
                </li>
                <li class="nav-item active">
                    <a class="nav-link" href="<?= URL ?>artisans.php">Artisans</a>
                </li>
                <li class="nav-item active">
                    <a class="nav-link" href="<?= URL ?>inscription.php">Créer un compte</a>
                </li>
                <li class="nav-item active">
                    <a class="nav-link" href="<?= URL ?>connexion.php">Identifiez-vous</a>
                </li>

            <?php  endif; ?>
            
            <?php  if(connectAdmin()): // Accès à l'administrateur du site ?>
            
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="dropdown04" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">BACK OFFICE</a>
                <div class="dropdown-menu" aria-labelledby="dropdown04">
                <a class="dropdown-item" href="<?= URL ?>admin/gestion_sondage.php">Gestion des Sondages</a>
                <a class="dropdown-item" href="<?= URL ?>admin/gestion_membre.php">Gestion des membres</a>
                <a class="dropdown-item" href="<?= URL ?>admin/gestion_forum.php">Gestion des Sujets</a>
                </div>
            </li>

            <?php  endif; ?>

            </ul>


            <!-- <div class="form-inline my-2 my-lg-0">
            <ul class="navbar-nav mr-auto">
            <li class="nav-item active">
                    <a class="nav-link" href="inscription.php">Créer un compte</a>
                </li>
                <li class="nav-item active">
                    <a class="nav-link" href="connexion.php">Identifiez-vous</a>
                </li>

            </ul> 
            </div> -->


        </div>
    </nav>

    <section class="container-fluid" style="min-height: 80vh;">