<?php session_start(); ?>
<!DOCTYPE html>
<html>
<head>
    <title>Registrarse</title>
</head>
<body>
    <h2>Registro de Usuario</h2>
    <?php if (isset($_SESSION['register_error'])): ?>
        <p style="color:red;"><?php echo $_SESSION['register_error']; unset($_SESSION['register_error']); ?></p>
    <?php endif; ?>
    <form action="register_process.php" method="post">
        <label>Nombre de Usuario:</label><br>
        <input type="text" name="nombre_usuario" required><br><br>

        <label>Email:</label><br>
        <input type="email" name="email" required><br><br>

        <label>Contraseña:</label><br>
        <input type="password" name="password" required><br><br>

        <label>Rol:</label><br>
        <select name="rol">
            <option value="editor">Editor</option>
            <option value="administrador">Administrador</option>
        </select><br><br>

        <button type="submit">Registrar</button>
    </form>

    <p><a href="index.php">Volver al Login</a></p>
</body>
</html>
