<?php
session_start();
include 'conexion.php'; // Incluye el archivo de conexión a la base de datos

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Preparar la consulta SQL para buscar el usuario por email
    $stmt = $conexion->prepare("SELECT id, nombre, apellidos, password FROM usuarios WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $stmt->store_result();

    // Verificar si el usuario existe
    if ($stmt->num_rows > 0) {
        $stmt->bind_result($id, $nombre, $apellidos, $hashed_password);
        $stmt->fetch();

        // Verificar la contraseña
        if (password_verify($password, $hashed_password)) {
            // Iniciar sesión
            $_SESSION['user_id'] = $id;
            $_SESSION['user_name'] = $nombre . ' ' . $apellidos;

            // Redirigir a la página principal
            header("Location: index2.html");
            exit();
        } else {
            echo "La contraseña es incorrecta.";
        }
    } else {
        echo "No existe una cuenta asociada a este correo electrónico.";
    }

    // Cerrar la declaración y la conexión
    $stmt->close();
    $conexion->close();
}
?>
