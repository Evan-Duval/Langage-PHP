<?php

$fichiertentatives = "tentatives.txt";
$fichier = fopen($fichiertentatives,"a");

if ($fichier) {
    fwrite($fichier, "Lancement d'une nouvelle partie...\n\n");

    $randomChiffre = random_int(0, 100);
    $res;
    $tentatives = 8;

    do
    {
        echo "Donne moi un chiffre entre 0 et 100 : \n";
        $res = readline();

        fwrite($fichier, "Le nombre recherché est " . $randomChiffre . ". Le joueur à testé le nombre " . $res . ". Il lui reste " . $tentatives . " tentatives .\n\n");

        if ($res > $randomChiffre) {
            echo "C'est plus petit.\n";
            $tentatives--;
        } elseif ($res < $randomChiffre) {
            echo "C'est plus grand.\n";
            $tentatives--;
        } elseif ($res == $randomChiffre) {
            echo "Bravo tu as gagné !\n";
            echo "Il te restait " . $tentatives . " tentatives\n";
            fwrite($fichier, "Le joueur à trouvé le nombre en " . 8 - $tentatives . " tentatives. \n\n");
            return;
        }
        if ($tentatives == 0) {
            fwrite($fichier, "Le joueur à perdu la partie. \n\n");
            echo "Tu as perdu, le chiffre était ". $randomChiffre. "\n";
        } else {
            echo "Il te reste " . $tentatives . " tentatives\n";
        }
        
    } 
    while ($res != $randomChiffre && $tentatives > 0);
} else {
    echo "Erreur lors de l'ouverture du fichier";
}
fclose($fichier);
