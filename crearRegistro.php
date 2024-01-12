<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registre d'usuari</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            height: 100vh;
        }

        h1 {
            color: #333;
        }

        form {
            width: 25%;
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        label {
            display: block;
            margin-bottom: 10px;
            color: #333;
        }

        input {
            width: 95%;
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }
        input[type="submit"] {
            width: 100%;
        }
        button {
            background-color: #4caf50;
            color: #fff;
            padding: 10px 15px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        a {
            color: #4caf50;
            text-decoration: none;
        }

        button a {
            color: #fff;
            text-decoration: none;
            padding: 10px;
        }
    </style>
</head>

<body>
    <h1>Registre d'Usuari</h1>
    <form method="post">
        <label for="nombre">Nom:</label>
        <input type="text" id="nombre" name="nombre" required>
        <br>
        <label for="password">Contrassenya:</label>
        <input type="password" id="password" name="password" required>
        <br>
        <input type="submit" value="Registrar">
    </form>
    <br>
    <button>
        <a href="formPassword.php">Volver</a>
    </button>
</body>

</html>

<?php
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $nombre = $_POST["nombre"];
    $password = $_POST["password"];
    $hashedPassword = hash('sha512', $password);
    try {

        $dsn = "mysql:host=localhost;dbname=mylogin";
        $pdo = new PDO($dsn, 'tianleyin', 'Sinlove2004_');

        $query = $pdo->prepare("INSERT INTO users (nom, contrasenya) VALUES (:nombre, :contrasena)");
        $query->bindParam(':nombre', $nombre, PDO::PARAM_STR);
        $query->bindParam(':contrasena', $hashedPassword, PDO::PARAM_STR);
        $query->execute();
        header("Location: formPassword.php");

        echo "<h1>Registro exitoso. Ahora puedes iniciar sesión.</h1>";
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
}
?>
