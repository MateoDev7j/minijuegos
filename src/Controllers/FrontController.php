<?php
declare(strict_types=1);
namespace Controllers;

class FrontController {
    public static function main(): void {
        // 1. Obtenemos la ruta limpia sin parámetros GET (?id=1)
        $uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH) ?? '';

        // 2. Quitamos el prefijo DEFINE_URL ('/miproyecto/')
        if (str_starts_with($uri, DEFINE_URL)) {
            $uri = substr($uri, strlen(DEFINE_URL));
        }

        // 3. Separamos por '/'
        $partes = array_values(array_filter(explode('/', trim($uri, '/'))));

        // 4. Controlador y Acción (índice [0] es controlador, índice [1] es acción)
        $nombreControlador = isset($partes[0]) ? ucfirst(strtolower($partes[0])) : ucfirst(CONTROLLER_DEFAULT);
        $claseControlador = "Controllers\\{$nombreControlador}Controller";
        $accion = isset($partes[1]) ? strtolower($partes[1]) : ACTION_DEFAULT;

        if (class_exists($claseControlador)) {
            $controlador = new $claseControlador();
            if (method_exists($controlador, $accion)) {
                $controlador->$accion();
                return;
            }
        }

        http_response_code(404);
        echo "Error 404: Página no encontrada.";
    }
}
