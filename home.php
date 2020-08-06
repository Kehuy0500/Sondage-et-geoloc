
<style>
        body{
          background-color: rgb(255, 255, 255);
        }
          header{
              height: 30vh; background-color: grey;
          }
          .sondage{
              height: 25vh; border-bottom: black 1px solid; margin-left: 0px;
          }
          .row{
              margin: 0;
          }
          .forum{
              flex-direction: column;
          }
          .forumrec{
            border: rgba(189, 189, 189, 0.486) 1px solid; padding: 30px; 
        }
        a{text-decoration: none !important;}

          
</style>

<?php 
require_once('include/init.php');
require_once('include/header.php');

/*
    IMPERFECTIONS POUR L'INSTANT:

- Breaking News n'est pas en continu et est limité en nombre de caractère
        => Mettre les sondages récents avec une limite de 5 sondages Rendre plus esthétique? 
        
- Géolocalisation des magasins avec google map

- Détail des marchands (comme pour la partie forum)

*/


?>




 <!-- Page Content -->
 
    <!-------------- BREAKING NEWS ---------------->
<!-- Styles --> 
<style>
  /* .sondage{
    display: flex !important; 
    flex-direction: row !important;
    } */

  .example1 {
   height: 50px;  
   overflow: hidden;
  /* position: relative; */
  position: relative;
  }
  .example1 h2 {
   font-size: 2.5em;
   /* position: absolute; */
   /* width: 100%; */
    position: absolute;
    width: 100%; 
   /* width: 300px; */
   height: 100%;
   margin: 0;
   line-height: 50px;
   text-align: center;

   /* Starting position */
   -moz-transform:translateX(100%);
   -webkit-transform:translateX(100%);    
   transform:translateX(100%);
   /* Apply animation to this element */  
   -moz-animation: example1 25s linear infinite;
   -webkit-animation: example1 25s linear infinite;
   animation: example1 25s linear infinite;
  }
  /* Move it (define the animation) */
  @-moz-keyframes example1 {
   0%   { -moz-transform: translateX(100%); }
   100% { -moz-transform: translateX(-100%); }
  }
  @-webkit-keyframes example1 {
   0%   { -webkit-transform: translateX(100%); }
   100% { -webkit-transform: translateX(-100%); }
  }
  @keyframes example1 {
   0%   { 
   -moz-transform: translateX(100%); /* Firefox bug fix */
   -webkit-transform: translateX(100%); /* Firefox bug fix */
   transform: translateX(100%);       
   }
   100% { 
   -moz-transform: translateX(-100%); /* Firefox bug fix */
   -webkit-transform: translateX(-100%); /* Firefox bug fix */
   transform: translateX(-100%); 
   }
  }
  </style>

  <section class="sondage"> 
  <?php   
    $badge = $bdd->query("SELECT * FROM sondage where status = 0");
    
  ?>

  <h2>Sondages en cours <?= "<strong class='badge badge-info'>" .$badge->rowCount(). "</strong>"; ?> </h2>
  <?php 
    $data = $bdd->query("SELECT * FROM sondage WHERE status = 0 LIMIT 0, 3");
    while($sondage = $data->fetch(PDO::FETCH_ASSOC)):
  ?>
  <!-- HTML -->   
  <div class="example1">
  <h2> <?= $sondage['titre']?> (<?= $sondage['votes']?> votes) Lorem ipsum dolor sit amet, consectetur adipisicing elit. Rerum excepturi, unde obcaecati vitae ex reprehenderit sint quam non tempora nesciunt quis nobis magnam impedit hic magni repellat laudantium possimus saepe.</h2>
  </div>
    <?php endwhile; ?>
    </section>
<!---------------------------------------FIN BREAKING NEWS------------------------------------------------>

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


    <section class="row">

        <section class="col-md-6 mx-auto">
            <h1 class="text-center">Forum</h1>
            <h2>Sujets récents:</h2>
            <?php
             $data = $bdd->query("SELECT * FROM forum ORDER BY heure DESC LIMIT 0,3");
                    while($forum = $data->fetch(PDO::FETCH_ASSOC)):?>

                <div class="forumrec my-4">
                    <h2> <?= $forum['titre'] ?> </h2>
                    <p><h5><strong><?= $forum['pseudo'] ?></strong>: </h5> <?= $forum['msg'] ?> </p> <br>
                    
                    <span> (ici bulle indiquant le nb de commentaires sur le sujet)</span> <br>
                    <button class="btn btn-info"><a href="sujetsforum.php?id_forum= <?= $forum['id_forum'] ?>">Voir le sujet</a></button>
                </div>
                <hr>
                <?php endwhile; ?>
            

        </section> 

    </section>








    </main>



<?php 
require_once('include/footer.php');