<?php
declare(strict_types=1);
// Controlador y acción que se ejecutan cuando la URL no indica ninguno
const CONTROLLER_DEFAULT = 'auth';
const ACTION_DEFAULT = 'login';

//Direccion base del proyecto para el navegador
define('DEFINE_URL', '/miproyecto/');
//subimos a raiz
define('RUTA_VIEWS', dirname(__DIR__) . '/Views/');
define('RUTA_JUGADORES', dirname(__DIR__) . '/data/jugadores.json');
define('RUTA_JUEGOS', dirname(__DIR__) . '/data/juegos.json');
define('RUTA_UPLOADS', dirname(__DIR__) . '/public/uploads/juegos');
/*************************************************************** */
define('MAX_ZIP', 10 * 1024 * 1024 );
define('CATEGORIAS',['Aventura', 'Estrategia', 'Puzzle','Arcade']);