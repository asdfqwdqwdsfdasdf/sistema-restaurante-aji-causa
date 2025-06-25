<!-- registrar_orden.php -->
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Registrar Orden</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 p-6 font-sans">
  <div class="max-w-xl mx-auto bg-white shadow-lg p-6 rounded-lg">
    <h1 class="text-2xl font-bold mb-4 text-blue-600">Nueva Orden</h1>

    <form id="form-orden" class="space-y-4">
      <div>
        <label class="block text-gray-700 font-medium">Comentario del Cliente</label>
        <textarea name="comentario" class="w-full border rounded p-2" rows="3"></textarea>
      </div>

      <div class="grid grid-cols-2 gap-4">
        <div>
          <label class="block text-gray-700 font-medium">Método de Pago</label>
          <select name="metodo_pago" class="w-full border rounded p-2" required>
            <option value="">Seleccionar</option>
            <option value="yape">Yape</option>
            <option value="plin">Plin</option>
            <option value="tarjeta">Tarjeta</option>
            <option value="paypal">PayPal</option>
          </select>
        </div>
        <div>
          <label class="block text-gray-700 font-medium">Estado de Pago</label>
          <select name="estado_pago" class="w-full border rounded p-2" required>
            <option value="">Seleccionar</option>
            <option value="no pagado">No pagado</option>
            <option value="pagado">Pagado</option>
            <option value="cancelado">Cancelado</option>
          </select>
        </div>
      </div>

      <div>
        <label class="block text-gray-700 font-medium">Platos</label>
        <div id="platos-container" class="space-y-2">
          <!-- Aquí se llenarán dinámicamente los platos con JS -->
        </div>
      </div>

      <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded">Registrar Orden</button>
    </form>

    <p id="mensaje" class="mt-4 text-sm"></p>
  </div>

  <script>
    document.addEventListener('DOMContentLoaded', async () => {
      const platosContainer = document.getElementById('platos-container');
      const response = await fetch('../API/api/platos/api_obtener_platos_disponibles.php');
      const platos = await response.json();

      platos.forEach(plato => {
        platosContainer.innerHTML += `
          <div class="flex items-center gap-2">
            <input type="checkbox" name="platos" value="${plato.id_plato}" class="plato-check">
            <label>${plato.nombre} (S/ ${plato.precio})</label>
            <input type="number" min="1" value="1" class="ml-auto w-16 border rounded p-1 cantidad-input" disabled>
          </div>
        `;
      });

      // Activar/desactivar inputs cantidad
      document.querySelectorAll('.plato-check').forEach((checkbox, i) => {
        checkbox.addEventListener('change', (e) => {
          document.querySelectorAll('.cantidad-input')[i].disabled = !e.target.checked;
        });
      });
    });

    document.getElementById('form-orden').addEventListener('submit', async (e) => {
      e.preventDefault();

      const form = e.target;
      const comentario = form.comentario.value;
      const estado_pago = form.estado_pago.value;
      const metodo_pago = form.metodo_pago.value;

      const platosSeleccionados = Array.from(document.querySelectorAll('.plato-check'))
        .map((checkbox, i) => {
          if (checkbox.checked) {
            return {
              id_plato: parseInt(checkbox.value),
              cantidad: parseInt(document.querySelectorAll('.cantidad-input')[i].value),
            };
          }
        })
        .filter(Boolean);

      if (platosSeleccionados.length === 0) {
        return alert('Debes seleccionar al menos un plato');
      }

      const response = await fetch('../API/api/ordenes/api_registrar_orden.php', {
        method: 'POST',
        headers: { 'Content-Type': 'application/json' },
        body: JSON.stringify({ comentario, estado_pago, metodo_pago, platos: platosSeleccionados })
      });

      const data = await response.json();
      document.getElementById('mensaje').textContent = data.success ? 'Orden registrada con éxito' : 'Error al registrar';
      form.reset();
    });
  </script>
</body>
</html>
