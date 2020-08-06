<?php 
//------- FONCTION MEMBRE CONNECTE 
// Cette fonction permet de savoir si le membre est connecté ou non
function connect()
{
    // Si l'indice 'membre' n'est pas définit, cela veut dire que l'internaute n'est pas passé par la page connexion, et peut-être inscription
    if(!isset($_SESSION['membre']))
    {
        return false;
    } 
    else // sinon l'indice 'membre' est bien présent dans la session, le membre est bien connecté
    {
        return true;
    }
}

//----- FONCTION ADMIN
// Cette fonction permet de savoir si le membre est connecté et est administrateur du site

function connectAdmin()
{
    // Si l'indice membre est bien définit dans le fichier session et que l'indice 'statut' a bien pour valeur '1', cela dire que l'utilisateur est bien administrateur du site 
    if(connect() && $_SESSION['membre']['role'] == 1)
    {
        return true;
    }
    else // Sinon l'internaute n'est peut être pas connecté ni admin
    {
        return false;
    }
}



function connectArtisan()
{
    // Si l'indice membre est bien définit dans le fichier session et que l'indice 'statut' a bien pour valeur '1', cela dire que l'utilisateur est bien administrateur du site 
    if(connect() && $_SESSION['membre']['role'] == 3)
    {
        return true;
    }
    else // Sinon l'internaute n'est peut être pas connecté ni admin
    {
        return false;
    }
}

