

function toggleFormArtisans(){
    // on réccupère l'élément form.  Artisan
    var formulaire = document.getElementById('formulaire1');
  
    // Condition pour afficher/cacher le formulaire en fonction de son état
    if(formulaire.style.display == 'block')
    {
        formulaire.style.display = 'none';
    }
    else{
        formulaire.style.display = 'block';
    }
}

function toggleFormInscription(){
  // Formulaire Inscription
  var formulaire = document.getElementById('formulaire0');

  if(formulaire.style.display == 'block')
  {
      formulaire.style.display = 'none';
  }
  else{
      formulaire.style.display = 'block';
  }
}


function toggleFormSondage(){
    // Sondage
    var formulaire = document.getElementById('formulaire2');
  
    if(formulaire.style.display == 'block')
    {
        formulaire.style.display = 'none';
    }
    else{
        formulaire.style.display = 'block';
    }
  }
  
  function toggleFormForum(){
    // on réccupère l'élément form.  Artisan
    var formulaire = document.getElementById('formulaire3');
  
    // Condition pour afficher/cacher le formulaire en fonction de son état
    if(formulaire.style.display == 'block')
    {
        formulaire.style.display = 'none';
    }
    else{
        formulaire.style.display = 'block';
    }
}




