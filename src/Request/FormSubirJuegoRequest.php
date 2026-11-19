<?php
declare(strict_types=1);
//FormRegistroRequest.php
namespace Requests;
class FormSubirJuegoRequest{
    private array $datos = [];
    private array $errores = [];
     public function __construct(array $entrada, array $archivos)
    {
        $this->sanear($entrada,$archivos);
        $this->validar($archivos);
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
    public function sanear(array $entrada, array $archivos):void{
        $limpiarText = static fn(mixed $v): string => is_string($v) ? trim(strip_tags($v)) : '';
        $this->datos=[
            'titulo'          => $limpiarText($entrada['titulo'] ?? ''),
            'descripcion'     => $limpiarText($entrada['descripcion'] ?? ''),
            'categoria'       => $limpiarText($entrada['categoria'] ?? ''),
            'nombre_original' => $archivos['archivo']['name'] ?? '',
            'ruta_temporal'   => $archivos['archivo']['tmp_name'] ?? '',
        ];
    }
    public function validar(array $archivos):void{
        if($this->datos['titulo']===''){
            $this->errores['titulo']='El titulo es obligatorio.';
        }
        if($this->datos['descripcion']===''){
            $this->errores['descripcion']='Debes poner una descripcion.';
        }
        if(!in_array($this->datos['categoria'], CATEGORIAS, true)){
            $this->errores['categoria']='Debes seleccionar una categoría válida.';
        }
        //VALIDACION DEL ZIP
        if(!isset($archivos['archivo']) || $archivos['archivo']['error']!==UPLOAD_ERR_OK) {
            $this->errores['archivo']='Debes subir un archivo ZIP válido.';
        }
        else{//usamos ['size'] para que nos devuelva el tamaño
        //del archivo mediante funciones base de php
            if($archivos['archivo']['size']>MAX_ZIP){
                $this->errores['archivo']='El archivo supera el tamaño máximo permitido (10MB).';
            }//y usamos el valor ['name'] al archivo,para tener
            //el nombre completo del archivo ejemplo: documento.pdf
            $ext=strtolower(pathinfo($archivos['archivo']['name'], PATHINFO_EXTENSION));
            //guardamos en ext la extencion del archivo en minuscula, pathinfo() 
            //devuelve solo la extension del archivo sin el punto
            if($ext!=='zip'){
                //verificamos si el archivo es zip
                $this->errores['archivo']='El archivo debe tener extensión .zip.';
            }
        }
    }
}