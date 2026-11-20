<?php
//contenido juegoController
declare(strict_types=1);
namespace Controllers;
//AuthController
use Models\JuegoModel;
use Lib\Pages;
USE Requests\FormSubirJuegoRequest;


class JuegoController{

    private Pages $pages;
    private JuegoModel $juegoModel;
     public function __construct()
    {
        $this->pages = new Pages();
        $this->juegoModel= new JuegoModel(RUTA_JUEGOS, RUTA_UPLOADS);
    }//En el constructor de nuestro juego se inicializa con 
    //la ruta de los juegos, y la ruta de las uploads json
    public function index():void{
        $juegos = $this->juegoModel->todos();
        $this->pages->render('juegos/index',[
            'juegos' =>$juegos,
        ]);
    }
    public function subir():void{
        if(!isset($_SESSION['usuario'])){
            $this->redirigir('auth/login');
        }
        $errores=[];
        $datos=[];
        if($_SERVER['REQUEST_METHOD']==='POST'){
            $request = new FormSubirJuegoRequest($_POST['juego'],$_FILES);
            $datos = $request->datos();
            if($request->esValido()){
                $datos['autor']= $_SESSION['usuario']['username'];
                $this->juegoModel->guardar($datos, $datos['ruta_temporal']);
                $this->redirigir('juego/index');
            }
            else{
                $errores= $request->errrores();
            }
        }
        $this->pages->render('juegos/subir',[
            'errores'=>$errores,
            'datos'=>$datos,
        ]);
    }
    /**FUNCION REDIRIGIR */
    private function redirigir(string $ruta): never {
        header('Location: ' . DEFINE_URL . $ruta);
        exit;
    }
}