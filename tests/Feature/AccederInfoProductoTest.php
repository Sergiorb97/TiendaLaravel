<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class AccederInfoProductoTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testComprobarInfoProductos()
    {
        $inicio = $this->get(route('inicio'));
        $inicio->assertStatus(200);

        $carrito = $this->get(route('carrito'));
        $carrito->assertStatus(200);

        $modificar = $this->get(route('modificarDatos'));
        $modificar->assertStatus(405);

        $comprar = $this->get(route('cancelarPedido'));
        $comprar->assertStatus(405);
    }
}
