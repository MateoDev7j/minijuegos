<?php
declare(strict_types=1);
//FormRegistroRequest.php
namespace Requests;
use Lib\Pages;
class FormLoginRequest{
    private array $datos = [];
    private array $errores = [];
     public function __construct(array $entrada)
    {
        $this->sanear($entrada);
        $this->validar();
    }
    
    public function esValido():bool{
        return $this->errores === [];
    }
    public function errrores():array{
        return $this->errores;
    }
    public function datos():array{
        return $this->datos;
    }
    public function sanear(array $entrada):void{
        $limpiarEmail = static fn(mixed $v): string => is_string($v) ? filter_var(trim($v), FILTER_SANITIZE_EMAIL) : '';
        $this->datos=[
            'email'=> $limpiarEmail($entrada['email'] ?? ''),
            'password'=>is_string($entrada['password'] ?? '') ? $entrada['password'] : '',
        ];
    }
    public function validar():void{
        if($this->datos['email']===''){
            $this->errores['email']='El correo electronico es obligatorio';
        }
        elseif(!filter_var($this->datos['email'], FILTER_VALIDATE_EMAIL)){
            $this->errores['email']='El formato de correo no es valido.';
        }
        if($this->datos['password']===''){
            $this->errores['password']='Debes introducir una contraseña.';
        }
    }
}