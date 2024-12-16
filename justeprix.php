<?php

$fichiertentatives = "tentatives.txt";
$fichier = fopen($fichiertentatives,"a");

if ($fichier) {
    $randomChiffre = random_int(0, 100);
    $res;
    $tentatives = 8;

    do
    {
        echo "Donne moi un chiffre entre 0 et 100 : \n";
        $res = readline();

        if ($res > $randomChiffre) {
            echo "C'est plus petit.\n";
            $tentatives--;
        } elseif ($res < $randomChiffre) {
            echo "C'est plus grand.\n";
            $tentatives--;
        } elseif ($res == $randomChiffre) {
            echo "Bravo tu as gagné !\n";
            echo "Il te restait " . $tentatives . " tentatives\n";
            return;
        }
        if ($tentatives == 0) {
            echo "Tu as perdu, le chiffre était ". $randomChiffre. "\n";
        } else {
            echo "Il te reste " . $tentatives . " tentatives\n";
        }
        
        fwrite($fichier, $res);

    } 
    while ($res != $randomChiffre && $tentatives > 0);
}
fclose($fichier);
