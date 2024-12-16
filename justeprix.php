<?php
session_start();

// Chemin du fichier pour enregistrer les tentatives
$fichiertentatives = "tentatives.txt";

// Initialisation du jeu
if (!isset($_SESSION['randomChiffre'])) {
    $_SESSION['randomChiffre'] = random_int(0, 100);
    $_SESSION['tentatives'] = 8;
    $_SESSION['historique'] = [];
    file_put_contents($fichiertentatives, "Nouvelle partie commencée !\n", FILE_APPEND);
}

// Traitement du formulaire
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['chiffre'])) {
    $chiffre = intval($_POST['chiffre']); // Récupérer le chiffre saisi
    $_SESSION['tentatives']--;

    // Analyser la tentative
    if ($chiffre > $_SESSION['randomChiffre']) {
        $message = "C'est plus petit.";
    } elseif ($chiffre < $_SESSION['randomChiffre']) {
        $message = "C'est plus grand.";
    } else {
        $message = "Bravo, tu as trouvé le nombre {$_SESSION['randomChiffre']} ! 🎉";
        file_put_contents($fichiertentatives, "Le joueur a trouvé le nombre après " . (8 - $_SESSION['tentatives']) . " tentatives.\n", FILE_APPEND);
        session_destroy(); // Terminer la session après la victoire
    }

    // Ajouter l'essai dans l'historique
    $_SESSION['historique'][] = "Tentative: $chiffre - $message";

    // Écrire chaque tentative dans le fichier
    $log = "Tentative: $chiffre - $message. Il reste {$_SESSION['tentatives']} tentatives.\n";
    file_put_contents($fichiertentatives, $log, FILE_APPEND);
}

// Vérifier si les tentatives sont épuisées
if (isset($_SESSION['tentatives']) && $_SESSION['tentatives'] <= 0) {
    $message = "Tu as perdu ! Le nombre était {$_SESSION['randomChiffre']}.";
    file_put_contents($fichiertentatives, "Le joueur a perdu. Le nombre était {$_SESSION['randomChiffre']}.\n", FILE_APPEND);
    session_destroy();
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Juste Prix</title>
</head>
<body>
    <h1>Le Juste Prix</h1>

    <?php if (isset($message)) : ?>
        <p><strong><?= htmlspecialchars($message) ?></strong></p>
    <?php endif; ?>

    <?php if (isset($_SESSION['tentatives']) && $_SESSION['tentatives'] > 0) : ?>
        <form method="post">
            <label for="chiffre">Devine le nombre (entre 0 et 100) :</label>
            <input type="number" id="chiffre" name="chiffre" min="0" max="100" required>
            <button type="submit">Valider</button>
        </form>
        <p>Il te reste <?= $_SESSION['tentatives'] ?> tentatives.</p>
    <?php else : ?>
        <form method="post">
            <button type="submit">Rejouer</button>
        </form>
    <?php endif; ?>

    <h2>Historique des tentatives :</h2>
    <ul>
        <?php if (isset($_SESSION['historique'])) : ?>
            <?php foreach ($_SESSION['historique'] as $essai) : ?>
                <li><?= htmlspecialchars($essai) ?></li>
            <?php endforeach; ?>
        <?php endif; ?>
    </ul>
</body>
</html>
