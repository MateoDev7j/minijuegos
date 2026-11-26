<?php
declare(strict_types=1);
//FormRegistroRequest.php
namespace Requests;
use Lib\Pages;
class FormRegistroRequest{
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
        $limpiarText = static fn(mixed $v): string => is_string($v) ? trim(strip_tags($v)) : '';
        $limpiarEmail = static fn(mixed $v): string => is_string($v) ? filter_var(trim($v), FILTER_SANITIZE_EMAIL) : '';
        $this->datos=[
            'username'=>$limpiarText($entrada['username'] ?? ''),
            'email'=>$limpiarEmail($entrada['email'] ?? ''),
            'password'=>is_string($entrada['password'] ?? '') ? $entrada['password'] : '', // No hacemos trim ni strip_tags a la contraseña
        ];
    }
    public function validar():void{
        if($this->datos['username']===''){
            $this->errores['username']='El nombre de usuario es obligatorio';
        }
        elseif(strlen($this->datos['username'])<3) {
            $this->errores['username']='El usuario debe tener al menos 3 caracteres.';
        }
        if($this->datos['email']===''){
            $this->errores['email']='El correo electronico es obligatorio.';
        }
        elseif(!filter_var($this->datos['email'], FILTER_VALIDATE_EMAIL)){
            $this->errores['email']='El formato del correo no es válido.';
        }
        if($this->datos['password']===''){
            $this->errores['password']='La contraseña es obligatoria.';
        }
        elseif(strlen($this->datos['password']) < 6){
            $this->errores['password']='La contraseña debe tener almenos 6 caracteres.';
        }
    }
}