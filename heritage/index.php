<?php

require_once("classes/Guerrier.php");
require_once("classes/Archer.php");

$guerrier = new Guerrier("John", 100, rand(1, 100), rand(1, 20));
echo $guerrier->afficherInfos();

$archer = new Archer("Felindra", 100, rand(1, 100), rand(1, 20));
echo $archer->afficherInfos();

echo "Bienvenue dans le jeu de rôle\n";
echo "-----------------------------\n";

echo "Choisis le nombre de joueurs (2 ou 4) : \n";
$nombreDeJoueur = readline();

if (($nombreDeJoueur != 2) &&($nombreDeJoueur != 4)) {
    echo "Veuillez entrer un nombre correcte.\n";
    exit();
}

$joueurs = [];
for ($i = 1; $i <= $nombreDeJoueur; $i++) {
    echo "Entrez le nom du joueur ". $i. " : \n";
    $joueurs[$i] = readline();
    echo "Entrez le type de joueur ". $i. " (Guerrier ou Archer) : \n";
    $classeJoueur[$joueurs[$i]] = readline();

    echo "Le nom du joueur {$i} est {$joueurs[$i]} et sa classe est {$classeJoueur[$joueurs[$i]]}. \n";
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
    
}