<?php
include 'conexion.php'; // Incluye el archivo de conexión a la base de datos

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Recibir los datos del formulario
    $nombre = $_POST['nombre'];
    $apellidos = $_POST['apellidos'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $confirmar_password = $_POST['confirmar_password'];

    // Verificar que las contraseñas coinciden
    if ($password === $confirmar_password) {
        // Hashear la contraseña
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);

        // Preparar la consulta SQL
        $stmt = $conexion->prepare("INSERT INTO usuarios (nombre, apellidos, email, password) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("ssss", $nombre, $apellidos, $email, $hashed_password);

        // Ejecutar la consulta y verificar si fue exitosa
        if ($stmt->execute()) {
            // Redirigir al usuario después del registro exitoso usando JavaScript
            echo '<script>window.location.href = "index2.html";</script>';
            exit();
        } else {
            echo "Error: " . $stmt->error;
        }

        // Cerrar la declaración
        $stmt->close();
    } else {
        echo "Las contraseñas no coinciden.";
    }

    // Cerrar la conexión
    $conexion->close();
}
?>
