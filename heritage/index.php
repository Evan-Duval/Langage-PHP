<?php

require_once("classes/Guerrier.php");
require_once("classes/Archer.php");
require_once("classes/Mage.php");
require_once("classes/Barde.php");

echo "Bienvenue dans le jeu de rôle Rich'ies Fights\n";
echo "-----------------------------\n";

echo "Choisis le nombre de joueurs (2 ou 4) : \n";
$nombreDeJoueur = readline();

if (($nombreDeJoueur != 2) &&($nombreDeJoueur != 4)) {
    echo "Veuillez entrer un nombre correcte.\n";
    exit();
}

for ($i = 1; $i <= $nombreDeJoueur; $i++) {
    echo "Entrez le nom du joueur ". $i. " : \n";
    $nomDuJoueur = readline();
    echo "Choisissez votre classe pour : ". $nomDuJoueur 
    . "\n 1: Guerrier 
    \n 2: Archer
    \n 3: Mage
    \n 4: Barde\n";

    $numeroClasse = readline();

    switch ($numeroClasse) :
        case 1:
            $classeDuJoueur = "Guerrier";
            $guerrier = new Guerrier("{$nomDuJoueur}", "{$classeDuJoueur}");
            break;
        case 2:
            $classeDuJoueur = "Archer";
            $archer = new Archer("{$nomDuJoueur}", "{$classeDuJoueur}");
            break;
        case 3:
            $classeDuJoueur = "Mage";
            $mage = new Mage("{$nomDuJoueur}", "{$classeDuJoueur}");
            break;
        case 4:
            $classeDuJoueur = "Barde";
            $barde = new Barde("{$nomDuJoueur}", "{$classeDuJoueur}");
            break;
        default:
            echo "Veuillez entrer un nombre correspondant à une classe.\n";
            exit();
    endswitch;

    echo "\nLe joueur {$nomDuJoueur} à bien été créé avec la classe {$classeDuJoueur}. \n";
}

if ($nombreDeJoueur == 2) {
    //
} else {
    combatEquipe($guerrier, $archer, $mage, $barde);
}

function combat($joueur1, $joueur2) {
    $tourActuel = 0;
    while ($joueur1->getVie() > 0 && $joueur2->getVie() > 0) {
        $tourActuel++;

        echo "\nTour ". $tourActuel. " : \n";

        if ($tourActuel == 1) {
            $premierAJouer = ($joueur1->getInitiative() > $joueur2->getInitiative()) ? $joueur1 : $joueur2;
            $joueurTourPair = $premierAJouer == $joueur1 ? $joueur2 : $joueur1;
            $joueurTourImpair = $premierAJouer == $joueur1 ? $joueur1 : $joueur2;

            echo $premierAJouer->getName(). " est celui qui à le plus d'initiative, il joue donc en premier.\n";
        }

        if ($tourActuel % 2 == 0) {
            echo $joueurTourPair->attaquer($joueurTourImpair);
        } else {
            echo $joueurTourImpair->attaquer($joueurTourPair);
        }
    }
    echo $joueur1->afficherGagnant($joueur2->getName());
}

function combatEquipe($joueur1, $joueur2, $joueur3, $joueur4) {
    echo "{$joueur1->afficherInfos()}\n {$joueur2->afficherInfos()}\n {$joueur3->afficherInfos()}\n {$joueur4->afficherInfos()}";
}