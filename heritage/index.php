<?php

require_once("classes/Guerrier.php");
require_once("classes/Archer.php");

$guerrier = new Guerrier("John", 100, rand(1, 100), rand(1, 20));
echo $guerrier->afficherInfos();

$archer = new Archer("Felindra", 100, rand(1, 100), rand(1, 20));
echo $archer->afficherInfos();

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
