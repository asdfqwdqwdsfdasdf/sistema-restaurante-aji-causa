<?php session_start(); ?>
<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
</head>
<body>
    <h2>Iniciar Sesión</h2>
    <?php if (isset($_SESSION['login_error'])): ?>
        <p style="color:red;"><?php echo $_SESSION['login_error']; unset($_SESSION['login_error']); ?></p>
    <?php endif; ?>
    <form action="login.php" method="post">
        <label>Email:</label><br>
        <input type="email" name="email" required><br><br>
        <label>Contraseña:</label><br>
        <input type="password" name="password" required><br><br>
        <button type="submit">Ingresar</button>
    </form>
    <p>¿No tienes cuenta? <a href="register.php">Regístrate aquí</a></p>

</body>
</html>
