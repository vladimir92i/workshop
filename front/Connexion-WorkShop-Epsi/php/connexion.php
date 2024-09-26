<?php
session_start();

$host = 'localhost';
$dbname = 'workshop';
$username = 'root';
$password = ''; 

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Erreur de connexion : " . $e->getMessage());
}


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'] ?? '';
    $password = $_POST['password'] ?? '';

    if (!empty($email) && !empty($password)) {
        $sql = "SELECT id, username, password FROM users WHERE username = :email";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':email', $email);
        $stmt->execute();
        if ($stmt->rowCount() === 1) {
            $user = $stmt->fetch(PDO::FETCH_ASSOC);
            if ($password === $user['password']) { 
                if ($user['id'] == 1) {
                    header('Location: /ugo/Calendrier-WorkShop-EPSI/');
                    exit();
                } elseif ($user['id'] == 0) {
                    header('Location: ../refuse.html');
                    exit();
                } else {
                    header('Location: page_autre.php');
                    exit();
                }
            } else {
                echo "Mot de passe incorrect.";
            }
        } else {
            echo "Aucun utilisateur trouvé avec cet email.";
        }
    } else {
        echo "Veuillez remplir tous les champs.";
    }
} else {
    echo "Méthode de requête non valide.";
}
?>
