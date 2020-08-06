<style>

        body{
        background-color: rgb(255, 255, 255);
        }
        header{
            height: 30vh; background-color: grey;
        }
        .row{
            margin: 0;
        }
        img
        {
            width: 600px !important;
            height: 350px !important;
        }
        #formulaire1 {
            display: none;
        }

</style>
<?php 
require_once('include/init.php');
require_once('include/header.php');

/*
    IMPERFECTIONS:
- Géolocalisation

- If siret = siret on ajoute pas dans le rectangle d'artisans MAIS il se peut que la même entreprise puisse avoir plusieurs annonces parce que si on ajoute un post il va y avoir doublons dans le rectangle en plus de leur annonce

- Update du tel fonctionne pas

- les images à enregistrer dans la BDD puis les utiliser 

- Order by DESC (mettre la nouvelle annonce en 1ere et pas qu'elle s'ajoute à la fin)

- Voir si il n'existe pas un formulaire type horaire ou tableau

- Le bouton voir emplacement devra montrer sur la carte l'emplacement

- Le bouton détail devra afficher la fiche de l'entreprise
*/
echo '<pre>'; print_r($_POST); echo '</pre>';


extract($_POST); 
if ($_POST)
{
    $user = $_SESSION['membre']['id_membre'];

    $class1 = '';
    if(empty($nom))
    {
        $errorNom = '<p class="font-italic text-danger">! Saisissez le nom de l\'établissement</p>';
        $error = true;
        $class1 .= 'border border-danger';
    }


    $class3 = '';
    if(empty($adresse))
    {
        $errorAdresse = '<p class="font-italic text-danger">! Saisissez l\'adresse de l\'établissement</p>';
        $error = true;
        $class3 .= 'border border-danger';
    }

    

    if(!isset($error))
    {
    // TelE s'update pas

    $update = $bdd->prepare("UPDATE artisans SET nomE = :nomE, telE = :telE, adresseE = :adresseE, img = :img, horaire = :horaire, annonce = :annonce WHERE id_membre = $user");

    $update->bindValue(':nomE', $nomE, PDO::PARAM_STR);
    $update->bindValue(':telE', $telE, PDO::PARAM_INT);
    $update->bindValue(':adresseE', $adresseE, PDO::PARAM_STR);
    $update->bindValue(':img', $img, PDO::PARAM_STR);
    $update->bindValue(':horaire', $horaire, PDO::PARAM_STR);
    $update->bindValue(':annonce', $annonce, PDO::PARAM_STR);


    $update->execute(); 
    }

}


?>
    


      
 <!-- Page Content -->
 <main>
   

   <h1 class="col-md-6 mx-auto text-center my-5">Retrouvez vos artisans préférés de Trappes!</h1>
   <section class="row col-md-8 mx-auto my-5">
                                               <!----###################### GOOGLE MAP #########################---->
       <iframe src="https://www.google.com/maps/embed?pb=!1m14!1m12!1m3!1d21027.951022299876!2d1.9890176!3d48.791551999999996!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!5e0!3m2!1sfr!2sfr!4v1591808407893!5m2!1sfr!2sfr" 
       width="600" height="450" frameborder="0" style="border:0;" allowfullscreen="" aria-hidden="false" tabindex="0">
       </iframe>


       <section class=" col-md-4 mx-auto border border-info p-4 " style="overflow:scroll; border:#000000 1px solid; height:60vh;">
            <?php        
                $data = $bdd->query("SELECT * FROM artisans");
                
                echo "Nombre d'artisans au sein de Trappes <strong class='badge badge-info'>" .$data->rowCount(). "</strong>";
                while($annuaire = $data->fetch(PDO::FETCH_ASSOC)):?>
                <hr>
           
           <div>   <!----###################### Partie marchand #########################----> 
                <h3><?= $annuaire['nomE'] ?></h3>
                <h5><?= $annuaire['adresseE'] ?></h5>
                <h5>Numéro: <?= $annuaire['telE'] ?></h5>
                <div class="text-right">
                <button class="btn btn-info col-md-4">Détail</button>
                </div>
            </div> <hr>

                <?php endwhile; ?>

       </section>
   </section>

   <hr>


<!--################################# Vérification de l'utilisateur pour poster ##################### -->

<?php if(connectArtisan()):?>
   <section class="row col-md-8 mx-auto text-center my-5">
   <button class="btn btn-secondary mx-auto" onclick="toggleFormArtisans()"> <h2 class="display-5"><strong>Ajoutez votre annonce!</strong></h2> </button>
   </section>  

<!--############################## FORMULAIRE Si on est co en tant qu'artisan #################################-->
   <form action="" method="POST" id="formulaire1" class="col-md-8 mx-auto text-center">
        <div class="form-row">
            <div class="form-group col-md-6">
                <label for="nomE">Nom de l'établissement</label>
                <input type="text" class="form-control" id="nomE" name="nomE">
                <?php if(isset($errorNom)) echo $errorNom; ?>
            </div>
            <div class="form-group col-md-6">
                <label for="telE">Numéro tel de l'établissement</label>
                <input type="text" class="form-control" id="telE" name="telE" placeholder="ex: 0606060606">
            </div>
        </div>

        <div class="form-row">
            <div class="form-group col-md-6">
                <label for="adresseE">Adresse de l'établissement</label>
                <input type="text" class="form-control" id="adresseE" name="adresseE" placeholder="00 Rue, Ville, Code postal">
                <?php if(isset($errorAdresse)) echo $errorAdresse; ?>
            </div>
            <!-- Image = media ou je sais plus quoi -->
            <div class="form-group col-md-6">
                <label for="img">Images de l'établissement </label>
                <input type="text" class="form-control" id="img" name="img">
            </div>
        </div>

        <div class="form-row">
            <div class="form-group col-md-6">
                <label for="horaire">Horaires</label>
                <input type="text" class="form-control" id="horaire" name="horaire">
            </div>
            <div class="form-group col-md-6">
                <label for="annonce">Vos Annonces / Promotions </label>
                <input type="text" class="form-control" id="annonce" name="annonce">
            </div>
        </div>
       
        <button type="submit" class="btn btn-info mb-4">Soumettre l'annonce</button>
     
   </form>


<?php elseif(connect()):?>
   <section class="row col-md-8 mx-auto text-center my-5">
       <button class="btn btn-warning mx-auto"> <h2 class="display-5"> <a href="inscription.php" class="text-dark"> <strong>Vous devez être un artisan pour ajouter votre annonce</strong></a> </h2> </button>z
   </section>  

<?php elseif(!connect()):?>
   <section class="row col-md-8 mx-auto text-center my-5">
       <button class="btn btn-warning mx-auto"> <h2 class="display-5"> <a href="inscription.php" class="text-dark"> <strong>Vous devez être un artisan et posseder un compte pour ajouter votre annonce</strong></a> </h2> </button>
   </section>  
   
 <?php endif; ?>
   <hr>

<!------------------------------------------------------------------------------------------------------>


<?php $data = $bdd->query("SELECT * FROM artisans");
     while($annuaire = $data->fetch(PDO::FETCH_ASSOC)):?>

   <section class="row col-md-8 mx-auto text-center my-5">

       <div class="col-md-6">     
       

           <h1> <?= $annuaire['nomE'] ?> </h1>
           <h4>Horaires: <?=$annuaire['horaire']?> </h4>
           <h4>Numéro: <?= $annuaire['telE'] ?> </h4>
           <h4>Adresse: <?= $annuaire['adresseE'] ?> </h4>
           <button class="btn btn-info">voir l'emplacement</button>

           <div class="border border-danger my-5 p-5"> 
               <h1 class="text-danger">Promotions!!</h1>
               <h2>Réductions de 0.50€ sur les baguettes après 17h !!! <?= $annuaire['annonce'] ?></h2>
           </div>
          
        </div>
            <div class="col-md-2"> 
                <img src="Boulangerie.jpg" alt="">
                <!------------------------------------------------IMG------------------------------------------------------>
                <img src="<?= $annuaire['img'] ?>" alt="">
            </div>

   </section>  <hr>

   <?php endwhile; ?>







</main>


<?php 
require_once('include/footer.php');