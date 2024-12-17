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
            ${"joueur{$i}"} = new Guerrier("{$nomDuJoueur}", "{$classeDuJoueur}");
            break;
        case 2:
            $classeDuJoueur = "Archer";
            ${"joueur{$i}"} = new Archer("{$nomDuJoueur}", "{$classeDuJoueur}");
            break;
        case 3:
            $classeDuJoueur = "Mage";
            ${"joueur{$i}"} = new Mage("{$nomDuJoueur}", "{$classeDuJoueur}");
            break;
        case 4:
            $classeDuJoueur = "Barde";
            ${"joueur{$i}"} = new Barde("{$nomDuJoueur}", "{$classeDuJoueur}");
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
    combatEquipe($joueur1, $joueur2, $joueur3, $joueur4);
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
    $equipe1 = [];
    $equipe2 = [];

    // Création de deux équipes de 2 de façon aléatoire
    for ($i = 1; $i <= 4; $i++) {
        $random = rand(1, 2);
        if (count($equipe1) < 2 && count($equipe2) < 2) {
            if ($random == 1) {
                array_push($equipe1, ${"joueur{$i}"});
            } else {
                array_push($equipe2, ${"joueur{$i}"});
            }
        } elseif (count($equipe1) >= 2) {
            array_push($equipe2, ${"joueur{$i}"});
        } elseif (count($equipe2) >= 2) {
            array_push($equipe1, ${"joueur{$i}"});
        }
    }

    echo "\nL'équipe 1 est composée de {$equipe1[0]->getName()} et de {$equipe1[1]->getName()} \n";
    echo "L'équipe 2 est composée de {$equipe2[0]->getName()} et de {$equipe2[1]->getName()} \n\n";

    // On va prendre l'équipe qui à le plus d'initiative en cumulée, elle commencera.
    $totalIniEquipe1 = $equipe1[0]->getInitiative() + $equipe1[1]->getInitiative();
    $totalIniEquipe2 = $equipe2[0]->getInitiative() + $equipe2[1]->getInitiative();
    $premierAJouer = $totalIniEquipe1 > $totalIniEquipe2 ? $equipe1 : $equipe2;
    $message = ($premierAJouer == $equipe1 ) ? "L'équipe 1 va commencée car elle a le plus d'initiative en cumulée ({$totalIniEquipe1} contre {$totalIniEquipe2})" : "L'équipe 2 va commencée car elle a le plus d'initiative en cumulée ({$totalIniEquipe2} contre {$totalIniEquipe1})";

    echo $message;

    echo "Début du combat";
    echo "---------------";

    
}