<?php

class Carrito
{

    private $productos = [];

    public function agregarProducto(Producto $producto)
    {
        $this->productos[] = $producto;
    }

    public function getProductos()
    {
        return $this->productos;
    }

    public function calcularTotal()
    {
        $total = 0;
        foreach ($this->productos as $producto) {
            $total += $producto->calcularSubtotal();
        }
        return $total;
    }

    public function cantidadProductos()
    {
        return count($this->productos);
    }

    public function Limpiar()
    {
        $this->productos = [];
    }
}
