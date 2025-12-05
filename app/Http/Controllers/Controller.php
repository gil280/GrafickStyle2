<?php

namespace App\Http\Controllers;
/**
 * @OA\Info(
 *   title="API ",
 *   version="1.0",
 *   description="Listado de los productos extras"
 * )
 *
 * @OA\Server(url="http://localhost:8000")
 *
 * @OA\SecurityScheme(
 *   securityScheme="bearerAuth",
 *   type="http",
 *   scheme="bearer",
 *   bearerFormat="Bearer",
 *   description="Use: Bearer {token}"
 * )
 */



abstract class Controller
{
    //
}