<?php

include 'connexionsql.php';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $user, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $stmt = $pdo->query("SELECT * FROM  joueurdevinettes");

} catch (PDOException $e) {
    echo "Erreur : " . $e->getMessage() . "\n";
}

$fichiertentatives = "tentatives.txt";
$fichier = fopen($fichiertentatives,"a");

if ($fichier) {
    fwrite($fichier, "Lancement d'une nouvelle partie...\n\n");

    echo "Entrez votre nom : ";
    $nomJoueur = readline();
    
    echo "Entrez votre prénom : ";
    $prenomJoueur = readline();
    
    echo "Entrez votre classe : ";
    $classeJoueur = readline();
    
    $randomChiffre = random_int(0, 100);
    $res;
    $victoire = false;
    $nombreDeTentative = 0;
    
    for($tentatives = 8; $tentatives > 0; $tentatives--) {
        echo "Donne moi un chiffre entre 0 et 100 : \n";
        $res = readline();
        $nombreDeTentative++;

        fwrite($fichier, "Le nombre recherché est " . $randomChiffre . ". Le joueur à testé le nombre " . $res . ". Il lui reste " . $tentatives - 1 . " tentatives .\n\n");
    
        if ($res > $randomChiffre) {
            echo "C'est plus petit.\n";
        } elseif ($res < $randomChiffre) {
            echo "C'est plus grand.\n";
        } elseif ($res == $randomChiffre) {
            echo "Bravo tu as gagné !\n";
            fwrite($fichier, "Le joueur à trouvé le nombre en " . $nombreDeTentative . " tentatives. \n\n");
            echo "Il te restait " . $tentatives - 1 . " tentatives\n";
    
            $stmt = $stmt = $pdo->prepare(
                "INSERT INTO joueurdevinettes
                        (Nom, Prenom, Classe, NombreDeTentatives, NombreATrouver, Victoire) 
                        VALUES (:Nom, :Prenom, :Classe, :NombreDeTentatives, :NombreATrouver, :Victoire)
                        ");
            $stmt->execute([
                ':Nom' => $nomJoueur,
                ':Prenom' => $prenomJoueur,
                ':Classe' => $classeJoueur,
                ':NombreDeTentatives' => $nombreDeTentative,
                ':NombreATrouver' => $randomChiffre,
                ':Victoire' => true,
            ]);
    
            return;
        }
        echo "Il te reste " . $tentatives - 1 . " tentatives\n";
    }
    fwrite($fichier, "Le joueur à perdu la partie. \n\n");
    echo "Tu as perdu, le chiffre était ". $randomChiffre. "\n";
    
    $stmt = $stmt = $pdo->prepare(
        "INSERT INTO joueurdevinettes
                (Nom, Prenom, Classe, NombreDeTentatives, NombreATrouver, Victoire) 
                VALUES (:Nom, :Prenom, :Classe, :NombreDeTentatives, :NombreATrouver, :Victoire)
                ");
    $stmt->execute([
        ':Nom' => $nomJoueur,
        ':Prenom' => $prenomJoueur,
        ':Classe' => $classeJoueur,
        ':NombreDeTentatives' => $nombreDeTentative,
        ':NombreATrouver' => $randomChiffre,
        ':Victoire' => false,
    ]);

} else {
    echo "Erreur lors de l'ouverture du fichier";
}
fclose($fichier);

