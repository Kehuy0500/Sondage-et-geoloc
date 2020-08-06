<style>
        .sondagerec{border: rgba(189, 189, 189, 0.486) 1px solid; padding: 30px;}

        .forumrec{border: rgba(189, 189, 189, 0.486) 1px solid; padding: 30px;}

        .nbvote{background-color: aqua; width: 120px; text-align: right; color: #000;}

        .vote{width: 240px; border: 1px solid black; height: 23px;}

        h2{text-decoration: underline;}

        #formulaire2 {display: none;}


        #myProgressoui {
        width: 100%;
        background-color: grey;
        }

        #myBaroui {
        width: 60%;     /* à remplacer par la variable $baroui % */
        height: 30px;
        background-color: #4CAF50;
        text-align: center; /* To center it horizontally (if you want) */
        line-height: 30px; /* To center it vertically */
        color: white;
        }


        #myProgressnon {
        width: 100%;
        background-color: grey;
        }

        #myBarnon {
        width: 40%;     /* à remplacer par la variable $barnon % */
        height: 30px;
        background-color: #4CAF50;
        text-align: center; /* To center it horizontally (if you want) */
        line-height: 30px; /* To center it vertically */
        color: white;
        }
</style>



<?php 
require_once('include/init.php');
require_once('include/header.php');

/*
TOUTES LES IMPERFECTIONS:
- update selon l'id du sondage

- S'assurer que la personne soit connecté et puisse voter qu'une fois !!!!! id = voter 1 fois si id = id alors pas possible

- Barre de progression des votes

- Réinitialiser les valeurs du bouton "réinitialiser" (ligne 90)

- Changer les status au cours du temps 
        => la variable $date qui est la date de la création du sondage n'est pas à jour par rapport au dernier sondage

    Aides:
https://stackoverflow.com/questions/2507678/get-the-timestamp-of-exactly-one-week-ago-in-php
https://www.php.net/manual/en/function.strtotime.php
https://openclassrooms.com/forum/sujet/creer-un-barre-de-progression-en-php-27772
https://www.bram.us/demo/projects/jsprogressbarhandler/
https://openclassrooms.com/fr/courses/510018-decouvrez-la-puissance-de-jquery-ui/509899-la-barre-de-progression
https://jqueryui.com/progressbar/#indeterminate
https://www.w3schools.com/howto/tryit.asp?filename=tryhow_js_progressbar_label_js
*/



echo '<pre>'; print_r($_POST); echo '</pre>';
extract($_POST);

if($_POST)
{
    if (isset($titre))
    {
        $insert = $bdd->prepare("INSERT INTO sondage (titre) VALUES (:titre)");
        $insert->bindValue(':titre', $titre, PDO::PARAM_STR);
        $insert->execute(); 
    }





    //-------------------------------------------------------- nombre de votes = Vote +1
    //--------------------------------------------------------

    $data = $bdd->query("SELECT * FROM sondage");
    $console = $data->fetch(PDO::FETCH_ASSOC);      // BDD sondage
    $id= $_GET['id_sondage'];

    if($Sondage == "oui" || $Sondage == "non")    // Variable $Sondage avec un S majuscule =/= $sondage
    {   
        /* $id = $_GET['id_sondage'];

            $update = $bdd->prepare("UPDATE sondage SET votes = votes+1 WHERE id_sondage = $id"); 
            $update->execute(); 
        */

        /* #######################################################
        !!!! PROBLEME Id pas dynamique
        https://stackoverflow.com/questions/10937517/using-get-when-updating-a-database
        */########################################################


        $update = $bdd->prepare("UPDATE sondage SET votes = votes+1 WHERE id_sondage = $id"); 
        $update->execute(); 

        echo '<pre>'; print_r($console); echo '</pre>';
    }


    /* OUI ou NON pour la BDD et pour la barre de progression*/ 
    if ($Sondage == "oui")  
    {

        $update = $bdd->prepare("UPDATE sondage SET oui = oui+1 WHERE id_sondage = 1"); 
        $update->execute(); 
  
    }

    else if ($Sondage == "non")  
    {

        $update = $bdd->prepare("UPDATE sondage SET non = non+1 WHERE id_sondage = 1"); 
        $update->execute(); 
        
    }



}

/****** FIN du IF POST *******/



$data = $bdd->query("SELECT * FROM sondage");
$sondage = $data->fetch(PDO::FETCH_ASSOC);

$baroui = ($sondage['oui']*100)/($sondage['votes']);      // 100 multiplié par valeur partielle/ Valeur totale
$barnon = ($sondage['non']*100)/($sondage['votes']);

echo ': <pre>';print_r(round($baroui, 0));  echo ' %</pre>';    // Résultat 
echo ': <pre>';print_r(round($barnon, 0));  echo ' %</pre>';

echo ': <pre>'; print_r($sondage['oui']); echo '</pre>';     // Colonne "oui" dans la BDD 
echo ': <pre>'; print_r($sondage['non']); echo '</pre>';
echo '<pre>'; print_r($Sondage); echo '</pre>';     // Valeur formulaire = variable définie lors de l'envoie







//###############################################  Changement de status par rapport à la date  ##############################

// https://stackoverflow.com/questions/2507678/get-the-timestamp-of-exactly-one-week-ago-in-php
// https://www.php.net/manual/en/function.strtotime.php




$date = date( "Y-m-d", strtotime($sondage['date']) );       // date de la création des sondages
$date1 = date( "Y-m-d", strtotime( "now, -1 week" ) );  // date d'il y'a 1 semaine 

    if($date <= $date1)         // si Date des sondages est inférieur ou égale à la date d'aujourdhui - 1 semaine
    {
        
        $update = $bdd->prepare("UPDATE sondage SET status = 2 WHERE $date <= $date1");  // ALORS update le status où la date est <= à aujourd'hui - 1 semaine
        $update->execute(); 
    }

    echo 'Date de la création du sondage : <pre>'; print_r($date); echo '</pre>';
    echo 'Date de -1 week : <pre>'; print_r($date1); echo '</pre>';
    echo '<pre>'; print_r($update); echo '</pre>';

    



?>




 <!-- Page Content -->
 
 <main>




        <section class="row">
        <section class="col-md-10 mx-auto my-5 text-center">
        <h1>Ajouter un sondage <button class="btn btn-info" onclick="toggleFormSondage()">+</button></h1>

        <!--########" RESET LES VALEURS "##########################################################################################################################################################################################################################################################-->
        <form method="post" class="col-md-6 mx-auto" id="formulaire2">

            <div class="form-row">
                <div class="form-group col-md-12">
                    <label for="titre">Titre</label>
                    <input type="text" class="form-control" id="titre" name="titre">
                </div>
            </div>
        
            <button type="submit" class="btn btn-dark mb-4">Créer le sondage</button>
            <button type="submit" class="btn btn-danger mb-4">Réinitialiser</button>

        </form>

        </section>

        </section>
        <section class="row ">  

            <section class="col-md-6 mx-auto py-5">
            <h1>Sondages récents:</h1>

               
               <?php 
                
                $badge = $bdd->query("SELECT * FROM sondage where status = 0");
                    //  ####################################### (limite l'affichage à 5 sondages) #######################
                echo "Nombre de votes récents <strong class='badge badge-info'>" .$badge->rowCount(). "</strong>";

                $data = $bdd->query("SELECT * FROM sondage where status = 0 ORDER BY date DESC LIMIT 0, 2");
                
                while($sondage = $data->fetch(PDO::FETCH_ASSOC)):?>
                
                <div class="sondagerec my-4">
                    <h2><?= $sondage['titre'] ?></h2>
                    

                    <div class="row">
                        <div class="col-md-4 mx-auto">   <!--Formulaire radio box-->
                            <form method="POST" class="my-2">
                                
                                <div>
                                    <input type="radio" class="my-3" name="Sondage"  value="oui" /> Oui <br> 
                                    <input type="radio" class="my-3" name="Sondage"  value="non" /> Non
                                </div>


                                    <button type="submit" class="btn btn-info col-md-4 my-3" >Voter</button>
                            </form>       
                        </div>
                        <div class="col-md-4"> 

                            <div id="myProgressoui" class="my-3">
                                <div id="myBaroui">%</div>   <!-- à remplacer par la variable $baroui -->
                            </div>
                            <div id="myProgressnon" class="my-3">
                                <div id="myBarnon">%</div>   <!-- à remplacer par la variable $barnon -->
                            </div>
                            
                        </div>
                        <div class="col-md-2 mx-auto my-3"> <!-- Nombre de votes -->
                            <p>(<?= $sondage['votes'] ?>)</p>

                        </div>
                    
                    </div>
               

                </div>
                
                <hr>
                <?php endwhile; ?>

        
            </section> 
           
        </section> <hr>




        <section class="row">

            <section class="col-md-6 mx-auto">
                <h1>Sondages en cours:</h1>
                <?php 
                    $badge = $bdd->query("SELECT * FROM sondage where status = 1");
                    //  ####################################### (limite l'affichage à 5 sondages) #######################
                    echo "Nombre de votes récents <strong class='badge badge-info'>" .$badge->rowCount(). "</strong>";

                $data = $bdd->query("SELECT * FROM sondage where status = 0 LIMIT 0, 5");

                while($sondage = $data->fetch(PDO::FETCH_ASSOC)):?>
              <div class="sondagerec my-4">
                    <h2><?= $sondage['titre'] ?></h2>
                    
                    <div class="row">
                        <div class="col-md-4 mx-auto">   <!--Formulaire radio box-->
                            <form method="POST" class="my-2">
                                <div>
                                    <input type="radio" class="my-3" name="Sondage"  value="oui" /> Oui <br>
                                    <input type="radio" class="my-3" name="Sondage"  value="non" /> Non
                                </div>

                                
                                    <button type="submit" class="btn btn-info col-md-4 my-3">Voter</button>
                            </form>       
                        </div>
                        <div class="col-md-4"> 
                            <div id="myProgressoui" class="my-3">
                                <div id="myBaroui">%</div>   <!-- à remplacer par la variable $barnon -->
                            </div>
                            <div id="myProgressnon" class="my-3">
                                <div id="myBarnon">%</div>   <!-- à remplacer par la variable $barnon -->
                            </div>
                        </div>
                        <div class="col-md-2 mx-auto my-3">
                            <p>(<?= $sondage['votes'] ?>)</p>

                        </div>
                    
                    </div>
               

                </div>
                
                
                <hr>
                <?php endwhile; ?>

            </section> 
            
        </section>

        
        <section class="row">

            <section class="col-md-6 mx-auto">
                <h1>Sondages terminés:</h1>
                <?php 

                    $badge = $bdd->query("SELECT * FROM sondage where status = 2");
                    //  ####################################### (limite l'affichage à 5 sondages) #######################
                    echo "Nombre de votes récents <strong class='badge badge-info'>" .$badge->rowCount(). "</strong>";

                $data = $bdd->query("SELECT * FROM sondage where status = 2 LIMIT 0, 5");
                while($sondage = $data->fetch(PDO::FETCH_ASSOC)):?>
               
                <div class="sondagerec my-4">
                            <h2><?= $sondage['titre'] ?></h2>
                    
                    <div class="row">
                        <div class="col-md-4"> <!-- la variable $barnon !-->
                            <div class="vote my-2">
                                <p class="nbvote">50% </p> 
                            </div>
                            <div class="vote my-2">
                                <p class="nbvote">50% </p> 
                            </div>
                        </div>
                        <div class="col-md-2 mx-auto my-3">
                            <p>(<?= $sondage['votes'] ?>)</p>

                        </div>
                    
                    </div>
               

                </div>
                
                <hr>
                <?php endwhile; ?>
                <button class=" btn btn-danger">Voir les sondages terminés (redirection vers l'archive des sondages)</button>
            </section> 
            
        </section>



    </main>
    


<?php 
require_once('include/footer.php');