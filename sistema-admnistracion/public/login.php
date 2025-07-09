<?php
session_start();
require_once __DIR__ . '/API/conexion/Conexion.php';


$pdo = Conexion::conectar();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'];
    $password = $_POST['password'];

    $stmt = $pdo->prepare('SELECT * FROM usuarios_administracion WHERE email = ?');
    $stmt->execute([$email]);
    $user = $stmt->fetch();

    if ($user && password_verify($password, $user['password_hash'])) {
        $_SESSION['account_loggedin'] = true;
        $_SESSION['user_id'] = $user['id_usuario'];
        $_SESSION['user_name'] = $user['nombre_usuario'];
        $_SESSION['user_role'] = $user['rol'];
        header('Location: views/dashboard.php');
        exit;
    } else {
        $_SESSION['login_error'] = 'Correo o contraseña incorrectos.';
        header('Location: index.php');
        exit;
    }
}
