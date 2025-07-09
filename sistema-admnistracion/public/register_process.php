<?php
session_start();
require_once __DIR__ . '/API/conexion/Conexion.php';


$pdo = Conexion::conectar();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nombre_usuario = trim($_POST['nombre_usuario']);
    $email = trim($_POST['email']);
    $password = $_POST['password'];
    $rol = $_POST['rol'] === 'administrador' ? 'administrador' : 'editor';

    // Verificar si ya existe el email
    $stmt = $pdo->prepare('SELECT id_usuario FROM usuarios_administracion WHERE email = ?');
    $stmt->execute([$email]);

    if ($stmt->fetch()) {
        $_SESSION['register_error'] = 'El correo ya está registrado.';
        header('Location: register.php');
        exit;
    }

    // Insertar usuario con contraseña hasheada
    $password_hash = password_hash($password, PASSWORD_DEFAULT);

    $stmt = $pdo->prepare('INSERT INTO usuarios_administracion (nombre_usuario, email, password_hash, rol) VALUES (?, ?, ?, ?)');
    $stmt->execute([$nombre_usuario, $email, $password_hash, $rol]);

    $_SESSION['login_error'] = 'Registro exitoso. Inicia sesión.';
    header('Location: index.php');
    exit;
}
