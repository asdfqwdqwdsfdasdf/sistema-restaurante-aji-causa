<?php
// Conexión a la base de datos (opcional, si se necesita alguna consulta en el dashboard)
$conexion = new mysqli("mysql", "user1", "passwd", "restaurante");
$conexion->set_charset("utf8");

if ($conexion->connect_error) {
  die("Error de conexión: " . $conexion->connect_error);
}

// Aquí podrías hacer consultas si deseas mostrar información dinámica en el dashboard (opcional)

// Cerrar la conexión al final si no es necesaria más información
$conexion->close();
?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Dashboard Principal</title>
  <script src="https://cdn.tailwindcss.com"></script>
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
        <a href="index.php" class="px-6 py-2 text-blue-600 bg-blue-100 rounded-r-full font-medium">Dashboard</a>
        <a href="views/index.php" class="px-6 py-2 text-gray-600 hover:bg-blue-100 rounded-r-full">Órdenes</a>
        <a href="views/registrar_orden.php" class="px-6 py-2 text-gray-600 hover:bg-blue-100 rounded-r-full">Registrar Orden</a>
        <a href="views/admin_platos.php" class="px-6 py-2 text-gray-600 hover:bg-blue-100 rounded-r-full">Administrar Platos</a>
      </nav>
    </aside>

    <!-- Main Content -->
    <main class="flex-1 flex flex-col overflow-auto p-6">
      <!-- Top Bar -->
      <div class="flex justify-between items-center bg-white p-4 shadow">
        <h1 class="text-xl font-semibold">Dashboard Principal</h1>
        <img src="https://i.pravatar.cc/40" class="rounded-full w-10 h-10" alt="Usuario">
      </div>

      <!-- Dashboard Content -->
      <div class="mt-6 grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-6">
        <!-- Card 1: Órdenes -->
        <div class="bg-white p-6 rounded-lg shadow-md hover:shadow-xl transition">
          <h2 class="text-xl font-semibold text-gray-700 mb-4">Órdenes</h2>
          <p class="text-gray-600">Revisa las órdenes realizadas por los clientes.</p>
          <a href="views/index.php" class="mt-4 inline-block text-blue-600 hover:text-blue-800">Ver Órdenes</a>
        </div>

        <!-- Card 2: Registrar Orden -->
        <div class="bg-white p-6 rounded-lg shadow-md hover:shadow-xl transition">
          <h2 class="text-xl font-semibold text-gray-700 mb-4">Registrar Orden</h2>
          <p class="text-gray-600">Ingresa los detalles de una nueva orden.</p>
          <a href="views/registrar_orden.php" class="mt-4 inline-block text-blue-600 hover:text-blue-800">Registrar Nueva Orden</a>
        </div>

        <!-- Card 3: Administrar Platos -->
        <div class="bg-white p-6 rounded-lg shadow-md hover:shadow-xl transition">
          <h2 class="text-xl font-semibold text-gray-700 mb-4">Administrar Platos</h2>
          <p class="text-gray-600">Gestiona los platos del menú de tu restaurante.</p>
          <a href="views/admin_platos.php" class="mt-4 inline-block text-blue-600 hover:text-blue-800">Ver Platos</a>
        </div>
      </div>
    </main>
  </div>
</body>
</html>
