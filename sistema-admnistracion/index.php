<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Dashboard Restaurante</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <link href="https://cdn.jsdelivr.net/npm/@tabler/icons-webfont@latest/tabler-icons.min.css" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@500;600&display=swap" rel="stylesheet">
  <style>
    body {
      font-family: 'Montserrat', sans-serif;
    }
  </style>
</head>
<body class="bg-gray-100">
  <div class="flex h-screen">
    <!-- Sidebar -->
    <aside class="w-64 bg-white shadow-md flex flex-col">
      <div class="p-6 text-2xl font-bold text-blue-600">Aji Causa Restaurante</div>
      <nav class="mt-4 flex flex-col gap-2">
        <a href="#" class="px-6 py-2 text-blue-600 bg-blue-100 rounded-r-full font-medium">Órdenes</a>
        <a href="#" class="px-6 py-2 text-gray-600 hover:bg-blue-100 rounded-r-full">Platos</a>
      </nav>
    </aside>

    <!-- Main content -->
    <main class="flex-1 flex flex-col overflow-auto">
      <!-- Top Bar -->
      <div class="flex justify-between items-center bg-white p-4 shadow">
        <h1 class="text-xl font-semibold">Panel principal</h1>
        <div class="flex items-center gap-4">
          <div class="relative">
            <input type="text" placeholder="Buscar Orden por ID o código" class="pl-10 pr-4 py-2 border rounded-lg w-64">
            <span class="absolute left-3 top-2.5 text-gray-400"><i class="ti ti-search"></i></span>
          </div>
          <img src="https://i.pravatar.cc/40" class="rounded-full w-10 h-10" alt="Usuario">
        </div>
      </div>

      <!-- Stats Cards -->
      <div class="grid grid-cols-3 gap-4 p-4">
        <div class="bg-white p-4 rounded-xl shadow flex items-center gap-4">
          <div class="bg-[#C3F4F0] p-3 rounded-full">
            <i class="ti ti-box text-xl text-gray-700"></i>
          </div>
          <div>
            <p class="text-sm text-gray-500">Total Órdenes</p>
            <p class="text-xl font-bold">124</p>
          </div>
        </div>
        <div class="bg-white p-4 rounded-xl shadow flex items-center gap-4">
          <div class="bg-[#C3F4F0] p-3 rounded-full">
            <i class="ti ti-check text-xl text-gray-700"></i>
          </div>
          <div>
            <p class="text-sm text-gray-500">Completadas</p>
            <p class="text-xl font-bold">98</p>
          </div>
        </div>
        <div class="bg-white p-4 rounded-xl shadow flex items-center gap-4">
          <div class="bg-[#C3F4F0] p-3 rounded-full">
            <i class="ti ti-alert-triangle text-xl text-gray-700"></i>
          </div>
          <div>
            <p class="text-sm text-gray-500">Pendientes</p>
            <p class="text-xl font-bold">26</p>
          </div>
        </div>
      </div>

      <!-- Orders Section -->
      <div class="flex flex-1 p-4 gap-4 overflow-hidden">
        <!-- Orders List -->
        <div class="w-1/3 overflow-y-auto">
          <h2 class="text-lg font-semibold mb-2">Todas las órdenes</h2>
          <div id="orders-list" class="flex flex-col gap-4"></div>
        </div>

        <!-- Order Details -->
        <div class="flex-1 overflow-auto">
          <div id="order-details" class="space-y-4"></div>
        </div>
      </div>
    </main>
  </div>

<script>
  const ordersList = document.getElementById('orders-list');
  const orderDetails = document.getElementById('order-details');

  function renderOrders(orders) {
    ordersList.innerHTML = ''; // limpiar
    orders.forEach((order, index) => {
      const card = document.createElement('div');
      card.className = 'bg-white rounded-lg shadow p-4 cursor-pointer relative hover:ring-2 ring-blue-300';
      card.innerHTML = `
        <span class="absolute top-2 right-2 bg-yellow-300 text-xs font-semibold px-2 py-1 rounded-full">${order.status}</span>
        <p class="text-sm text-gray-500">Orden</p>
        <p class="text-lg font-bold">${order.id}</p>
        <p class="text-sm text-gray-400">${order.time}</p>
      `;
      card.addEventListener('click', () => renderOrderDetails(order));
      ordersList.appendChild(card);
      if (index === 0) renderOrderDetails(order); // Mostrar la primera por defecto
    });
  }

  function renderOrderDetails(order) {
    orderDetails.innerHTML = `
      <div class="bg-white rounded-xl shadow p-6 mb-4">
        <h3 class="text-xl font-semibold mb-4">Orden ${order.id}</h3>
        <div class="flex gap-2 mb-4">
          <span class="px-3 py-1 text-sm font-medium rounded-full bg-[#DAFCDD] text-[#1F982A]">${order.pago}</span>
          <span class="px-3 py-1 text-sm font-medium rounded-full bg-[#8121A0] text-white">${order.metodo}</span>
          <span class="px-3 py-1 text-sm font-medium rounded-full bg-[#FFD9D9] text-[#DE4444]">${order.entrega}</span>
        </div>
        <div class="flex items-start gap-4">
          <i class="ti ti-tools-kitchen-2 text-2xl text-[#2D60FF]"></i>
          <div>
            <p class="font-semibold">Comentario del cliente</p>
            <p class="font-medium text-gray-700">${order.comment}</p>
          </div>
        </div>
      </div>

      <div class="grid grid-cols-2 gap-4">
        <div class="bg-white rounded-xl shadow p-4">
          <h4 class="text-lg font-semibold mb-2">Detalles de la factura</h4>
          ${order.factura.map(item => `
            <div class="flex justify-between py-1">
              <span>${item.item}</span>
              <span>S/ ${item.precio.toFixed(2)}</span>
            </div>
          `).join('')}
          <hr class="my-2">
          <div class="flex justify-between font-semibold">
            <span>Pago Total</span>
            <span>S/ ${order.factura.reduce((sum, i) => sum + i.precio, 0).toFixed(2)}</span>
          </div>
        </div>

        <div class="bg-white rounded-xl shadow p-4">
          <h4 class="text-lg font-semibold mb-2">Platos de la orden</h4>
          ${order.platos.map(p => `
            <div class="flex items-center gap-2 mb-2">
              <i class="ti ti-tools-kitchen-2 text-xl text-[#2D60FF]"></i>
              <span class="font-medium">${p.nombre}</span>
              <span class="ml-auto text-sm text-green-600 font-medium">${p.estado}</span>
            </div>
          `).join('')}
        </div>
      </div>
    `;
  }

  async function fetchOrders() {
    try {
      const response = await fetch('obtener_ordenes.php');
      const data = await response.json();
      renderOrders(data);
    } catch (err) {
      console.error('Error al cargar órdenes:', err);
    }
  }

  fetchOrders();
</script>

</body>
</html>
