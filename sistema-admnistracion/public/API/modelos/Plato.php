<?php
class Plato {
    public $id_plato, $nombre, $descripcion, $precio, $imagen_url,
           $disponible, $hora_desde, $hora_hasta;

    public function __construct($id, $nom, $desc, $precio, $img, $disp, $desde, $hasta) {
        $this->id_plato = $id;
        $this->nombre = $nom;
        $this->descripcion = $desc;
        $this->precio = $precio;
        $this->imagen_url = $img;
        $this->disponible = $disp;
        $this->hora_desde = $desde;
        $this->hora_hasta = $hasta;
    }
}
?>
