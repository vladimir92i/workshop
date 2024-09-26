<?php
// Démarrer la session
session_start();

// Connexion à la base de données
$host = 'localhost'; // Adresse du serveur MySQL
$dbname = 'workshop'; // Remplacez par le nom de votre base de données
$username = 'root'; // Nom d'utilisateur pour MySQL
$password = ''; // Mot de passe pour MySQL

try {
    // Connexion à MySQL via PDO
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Erreur de connexion : " . $e->getMessage());
}

// Traitement du formulaire
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Récupérer les champs email et mot de passe depuis le formulaire
    $email = $_POST['email'] ?? '';
    $mot_de_passe = $_POST['mot_de_passe'] ?? '';

    if (!empty($email) && !empty($mot_de_passe)) {
        // Préparer une requête SQL pour vérifier si l'utilisateur existe via l'email
        $sql = "SELECT id, username, password FROM users WHERE username = :email"; // Utiliser l'email comme username
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':email', $email);
        $stmt->execute();

        // Vérifier si un utilisateur existe
        if ($stmt->rowCount() === 1) {
            // Récupérer les informations de l'utilisateur
            $user = $stmt->fetch(PDO::FETCH_ASSOC);

            // Vérifier si le mot de passe correspond
            if ($mot_de_passe === $user['password']) { // Il est préférable d'utiliser password_hash/password_verify pour plus de sécurité
                // Vérifier l'ID de l'utilisateur
                if ($user['id'] == 1) {
                    // Rediriger si l'ID est 1
                    header('Location: page_admin.php');
                    exit();
                } elseif ($user['id'] == 0) {
                    // Rediriger si l'ID est 0
                    header('Location: page_utilisateur.php');
                    exit();
                } else {
                    // Rediriger pour d'autres ID
                    header('Location: page_autre.php');
                    exit();
                }
            } else {
                // Si le mot de passe est incorrect
                echo "Mot de passe incorrect.";
            }
        } else {
            // Aucun utilisateur trouvé avec cet email
            echo "Aucun utilisateur trouvé avec cet email.";
        }
    } else {
        // Si les champs ne sont pas remplis
        echo "Veuillez remplir tous les champs.";
    }
} else {
    echo "Méthode de requête non valide.";
}
?>
