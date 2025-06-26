<?php
// Conexión a la base de datos
$conexion = new mysqli("localhost", "root", "", "restaurante");
$conexion->set_charset("utf8");

if ($conexion->connect_error) {
  die("Error de conexión: " . $conexion->connect_error);
}

$consulta = "SELECT * FROM platos";
$resultado = $conexion->query($consulta);
?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Administrar Platos</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <link href="https://cdn.jsdelivr.net/npm/@tabler/icons-webfont@latest/tabler-icons.min.css" rel="stylesheet">
  <style>
    body { font-family: 'Montserrat', sans-serif; }
  </style>
</head>
<body class="bg-gray-100">
  <div class="flex h-screen">
    <!-- Sidebar -->
    <aside class="w-64 bg-white shadow-md flex flex-col">
      <div class="p-6 text-2xl font-bold text-blue-600">Aji Causa Restaurante</div>
      <nav class="mt-4 flex flex-col gap-2">
        <a href="index.php" class="px-6 py-2 text-gray-600 hover:bg-blue-100 rounded-r-full">Órdenes</a>
        <a href="admin_platos.php" class="px-6 py-2 text-blue-600 bg-blue-100 rounded-r-full font-medium">Platos</a>
      </nav>
    </aside>

    <!-- Main Content -->
    <main class="flex-1 flex flex-col overflow-auto">
      <!-- Top Bar -->
      <div class="flex justify-between items-center bg-white p-4 shadow">
        <h1 class="text-xl font-semibold">Administrar Platos</h1>
        <img src="https://i.pravatar.cc/40" class="rounded-full w-10 h-10" alt="Usuario">
      </div>

      <!-- Tabla de Platos -->
      <div class="p-6 overflow-auto">
        <table class="min-w-full bg-white rounded-xl shadow overflow-hidden">
          <thead class="bg-gray-100">
            <tr class="text-left text-gray-700 font-semibold">
              <th class="px-4 py-3">Nombre</th>
              <th class="px-4 py-3">Descripción</th>
              <th class="px-4 py-3">Precio</th>
              <th class="px-4 py-3">Imagen</th>
              <th class="px-4 py-3">Horario</th>
              <th class="px-4 py-3">Disponible</th>
              <th class="px-4 py-3">Acciones</th>
            </tr>
          </thead>
          <tbody>
<?php while($plato = $resultado->fetch_assoc()): ?>
  <tr class="border-t">
    <!-- Formulario de edición -->
    <form action="actualizar_plato.php" method="POST" class="contents">
      <input type="hidden" name="id_plato" value="<?php echo $plato['id_plato']; ?>">

      <td class="px-4 py-3 font-medium"><?php echo htmlspecialchars($plato['nombre']); ?></td>

      <td class="px-4 py-3 text-sm text-gray-600"><?php echo htmlspecialchars($plato['descripcion']); ?></td>

      <td class="px-4 py-3">
        <input type="number" step="0.01" name="precio" value="<?php echo $plato['precio']; ?>"
               class="w-20 px-2 py-1 border rounded text-sm" required>
      </td>

      <td class="px-4 py-3">
        <img src="<?php echo htmlspecialchars($plato['imagen_url']); ?>" alt="imagen plato"
             class="w-16 h-16 object-cover rounded">
      </td>

      <td class="px-4 py-3 text-sm">
        <div class="flex gap-1 items-center">
          <input type="time" name="hora_desde" value="<?php echo substr($plato['hora_disponible_desde'], 0, 5); ?>"
                 class="border rounded px-2 py-1 text-sm" required>
          <span>–</span>
          <input type="time" name="hora_hasta" value="<?php echo substr($plato['hora_disponible_hasta'], 0, 5); ?>"
                 class="border rounded px-2 py-1 text-sm" required>
        </div>
      </td>

      <td class="px-4 py-3">
        <?php echo $plato['disponible']
          ? '<span class="text-green-600 font-semibold">Sí</span>'
          : '<span class="text-red-600 font-semibold">No</span>'; ?>
      </td>

      <td class="px-4 py-3 flex flex-col gap-2">
        <button type="submit" class="text-green-600 hover:text-green-800 flex items-center gap-1">
          <i class="ti ti-edit"></i> Actualizar
        </button>
    </form>

    <!-- Formulario de disponibilidad -->
    <form action="toggle_disponibilidad.php" method="POST">
      <input type="hidden" name="id_plato" value="<?php echo $plato['id_plato']; ?>">
      <input type="hidden" name="nuevo_estado" value="<?php echo $plato['disponible'] ? 0 : 1; ?>">
      <button type="submit" class="text-blue-600 hover:text-blue-800 flex items-center gap-1">
        <i class="ti ti-refresh"></i>
        <?php echo $plato['disponible'] ? 'Desactivar' : 'Activar'; ?>
      </button>
    </form>
      </td>
  </tr>
<?php endwhile; ?>


          </tbody>
        </table>
      </div>
    </main>
  </div>
</body>
</html>
<?php $conexion->close(); ?>
