<?php
session_start();

if (!isset($_SESSION['usuario'])) {
    header("Location: login.php");
    exit();
}
$usuario = $_SESSION['usuario'];

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $nuevaContrasena = $_POST["nuevaContrasena"];

    try {
        $dsn = "mysql:host=localhost;dbname=mylogin";
        $pdo = new PDO($dsn, 'tianleyin', 'Sinlove2004_');

        $query = $pdo->prepare("UPDATE users SET contrasenya = SHA2(:nuevaContrasena, 512) WHERE nom = :usuario");
        $query->bindParam(':nuevaContrasena', $nuevaContrasena, PDO::PARAM_STR);
        $query->bindParam(':usuario', $usuario, PDO::PARAM_STR);
        $query->execute();

        $mensaje = "Introduzca la nueva Contraseña:";
        $mostrarEnlace = true;
    } catch (PDOException $e) {
        $mensaje = "Error al cambiar la contraseña: " . $e->getMessage();
        $mostrarEnlace = false;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cambiar Contraseña</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
            text-align: center;
        }

        h1 {
            margin-top: 100px;
            color: #333;
        }

        form {
            margin-top: 20px;
        }

        label {
            display: block;
            margin-bottom: 10px;
            color: #333;
        }

        input {
            padding: 8px;
            margin-bottom: 15px;
            width: 25%;
            box-sizing: border-box;
        }

        button {
            background-color: #4caf50;
            color: #fff;
            padding: 10px 15px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 16px;
            margin-bottom: 100px;
        }

        a {
            text-decoration: none;
            color: #333;
        }

        button a {
            color: #fff;
        }
    </style>
</head>
<body>
    <h1>Cambiar Contraseña</h1>
    <p>Bienvenido, <?php echo $usuario; ?>!</p>

    <form method="POST">
        <label for="nuevaContrasena">Nueva Contraseña:</label>
        <input type="password" name="nuevaContrasena" required>
        <br>
        <button type="submit">Cambiar Contraseña</button>
    </form>

    <?php if (isset($mostrarEnlace) && $mostrarEnlace) : ?>
        <a href="DashBoard.php">Volver al Dashboard</a>
    <?php endif; ?></body>
</html>
