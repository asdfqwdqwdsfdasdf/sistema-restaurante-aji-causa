-- Tabla: platos
CREATE TABLE platos (
    id_plato INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(255) NOT NULL,
    descripcion TEXT,
    precio DECIMAL(10, 2) NOT NULL,
    imagen_url VARCHAR(255),
    disponible BOOLEAN DEFAULT TRUE,
    hora_disponible_desde TIME,
    hora_disponible_hasta TIME,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

-- Tabla: ordenes
CREATE TABLE ordenes (
    id_orden INT AUTO_INCREMENT PRIMARY KEY,
    comentarios_cliente TEXT,
    estado_pago ENUM('no pagado', 'pagado', 'cancelado') NOT NULL DEFAULT 'no pagado',
    estado_entrega ENUM('pendiente', 'en preparación', 'listo', 'entregado') NOT NULL DEFAULT 'pendiente',
    metodo_pago ENUM('yape', 'plin', 'tarjeta', 'paypal') NOT NULL,
    total DECIMAL(10, 2) NOT NULL,
    fecha_hora_creacion TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    fecha_hora_actualizacion TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

-- Tabla: detalle_orden
CREATE TABLE detalle_orden (
    id_detalle INT AUTO_INCREMENT PRIMARY KEY,
    id_orden INT NOT NULL,
    id_plato INT NOT NULL,
    cantidad INT NOT NULL,
    precio_unitario DECIMAL(10, 2) NOT NULL,
    FOREIGN KEY (id_orden) REFERENCES ordenes(id_orden) ON DELETE CASCADE,
    FOREIGN KEY (id_plato) REFERENCES platos(id_plato) ON DELETE CASCADE
);

-- Tabla: usuarios_administracion
CREATE TABLE usuarios_administracion (
    id_usuario INT AUTO_INCREMENT PRIMARY KEY,
    nombre_usuario VARCHAR(255) NOT NULL,
    email VARCHAR(255) UNIQUE NOT NULL,
    password_hash VARCHAR(255) NOT NULL,
    rol ENUM('administrador', 'editor') NOT NULL DEFAULT 'editor',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);
-- Inserts para la tabla platos
INSERT INTO platos (nombre, descripcion, precio, imagen_url, disponible, hora_disponible_desde, hora_disponible_hasta)
VALUES
('Lomo Saltado', 'Delicioso plato peruano con carne, cebolla, tomate y papas fritas.', 25.50, 'https://example.com/images/lomo_saltado.jpg', TRUE, '11:00:00', '22:00:00'),
('Ceviche Clásico', 'Pescado fresco marinado en limón con cebolla y ají.', 30.00, 'https://example.com/images/ceviche_clasico.jpg', TRUE, '10:00:00', '20:00:00'),
('Ají de Gallina', 'Guiso de pollo deshilachado en salsa cremosa de ají amarillo.', 22.00, 'https://example.com/images/aji_de_gallina.jpg', TRUE, '11:00:00', '21:00:00'),
('Tiradito', 'Filetes de pescado crudo con salsa de ají y limón.', 28.00, 'https://example.com/images/tiradito.jpg', FALSE, '12:00:00', '19:00:00');

-- Inserts para la tabla ordenes
INSERT INTO ordenes (comentarios_cliente, estado_pago, estado_entrega, metodo_pago, total)
VALUES
('Por favor, sin cebolla.', 'pagado', 'listo', 'tarjeta', 51.50),
('Entregar rápido, por favor.', 'no pagado', 'en preparación', 'yape', 30.00),
(NULL, 'pagado', 'entregado', 'paypal', 22.00);

-- Inserts para la tabla detalle_orden
INSERT INTO detalle_orden (id_orden, id_plato, cantidad, precio_unitario)
VALUES
(1, 1, 1, 25.50),
(1, 3, 1, 22.00),
(2, 2, 1, 30.00),
(3, 3, 1, 22.00);

-- Inserts para la tabla usuarios_administracion
INSERT INTO usuarios_administracion (nombre_usuario, email, password_hash, rol)
VALUES
('admin', 'admin@example.com', 'hashed_password_1', 'administrador'),
('editor1', 'editor1@example.com', 'hashed_password_2', 'editor'),
('editor2', 'editor2@example.com', 'hashed_password_3', 'editor');