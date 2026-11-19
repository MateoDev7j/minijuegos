<?php
declare(strict_types=1);
namespace Controllers;
//AuthController
use Models\JugadorModel;
use Lib\Pages;
use Requests\FormRegistroRequest;
use Requests\FormLoginRequest;


class AuthController{

    private Pages $pages;
    private JugadorModel $jugadorModel;
     public function __construct()
    {
        $this->pages = new Pages();
        $this->jugadorModel= new JugadorModel(RUTA_JUGADORES);
    }

    /** Metodo registro */
    public function registro(){
        $errores=[];
        $datos=[];
        if($_SERVER['REQUEST_METHOD'] === 'POST'){
            $request= new FormRegistroRequest($_POST['usuario']);
            $datos= $request->datos();
            if($request->esValido()){
                if($this->jugadorModel->existeUsername($datos['username'])){
                    $errores['username']='Ese nombre de usuario ya esta en uso.';
                }
                if($this->jugadorModel->existeEmail($datos['email'])){
                    $errores['email']='Ese correo ya esta registrado.';
                }
                if($errores===[]){
                    $this->jugadorModel->crear($datos['username'],$datos['email'],$datos['password']);
                    $this->redirigir('auth/login');
                }
            }
            else{
                $errores = $request->errrores();
            }
        }
        $this->pages->render('auth/registro',[
            'errores'=>$errores,
            'datos'=>$datos,
        ]);
    }
    public function login():void{
        $erroes=[];
        $datos=[];
        if($_SERVER['REQUEST_METHOD']==='POST') {
            $request = new FormLoginRequest($_POST['usuario']);
            $datos= $request->datos();
            if($request->esValido()){
                $jugador= $this->jugadorModel->verificarCredenciales($datos['email'],$datos['password']);
                if($jugador!==null){
                    $_SESSION['usuario']= $jugador;
                    $this->redirigir('juego/index');
                }
                $errores['general']='Contraseña o correo electronico incorrectos.';
            }
            else{
                $errores = $request->errrores();
            }
        }
        $this->pages->render('auth/login',[
            'errores'=> $errores,
            'datos' =>$datos,
        ]);
    }
    public function logout():void{
        $_SESSION=[];
        session_destroy();
        header('Location:'.DEFINE_URL);
    }
    //private function redirigir(string $accion): void 
    //{
        //header('Location: index.php?controller=usuario&action=' . $accion);
        //redirigimos a la accion o funcion que tenemos en el controlador
        //UsuarioController y la funcion/accion sera el parametro que le pasamos
        //ejemplo login() que renderiza nuestra vista de login
        //exit;
        //las cabezeras obligatoriamente tiene que tener exi; si no
        //el programa no sale de la accion
    //}
    private function redirigir(string $ruta): never {
        header('Location: ' . DEFINE_URL . $ruta);
        exit;
    }
}