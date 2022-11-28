<?php 

namespace App;

class Patinete {

    protected static $db;
    protected static $datosDB = ['id', 'marca', 'modelo', 'caracteristicas', 'precio', 'imagen', 'potencia', 'velocidad', 'fecha']; // creo el array de datos

    // ERRORES DE LA VALIDACIÓN
    protected static $validacion = [];


    public $id;
    public $marca;
    public $modelo;
    public $caracteristicas;
    public $precio;
    public $imagen;
    public $potencia;
    public $velocidad;
    public $fecha;

     // definir la conexión a la bbdd
     public static function setDB($database) {
     self::$db = $database;
    }

    public function __construct($args = [])
    {
        $this->id = $args['id'] ?? '';
        $this->marca = $args['marca'] ?? '';
        $this->modelo = $args['modelo'] ?? '';
        $this->caracteristicas = $args['caracteristicas'] ?? '';
        $this->precio = $args['precio'] ?? '';
        $this->imagen = $args['imagen'] ?? '';
        $this->potencia = $args['potencia'] ?? '';
        $this->velocidad = $args['velocidad'] ?? '';
        $this->fecha = date('Y/m/d');
    }

    public function guardar() {
       
        // LLAMADA A LA FUNCIÓN QUE VALIDA LOS DATOS    
        $atributos = $this->validarDatos();

        // Inserción en la BBDD
        $query = " INSERT INTO patinetes ( ";
        $query .= join(', ', array_keys($atributos));
        $query .= " ) VALUES (' ";
        $query .= join("', '", array_values($atributos));
        $query .= " ') ";
              
        $resultado = self::$db->query($query);

        return $resultado;
              
    }

    // IDENTIFICAR Y UNIR LOS DATOS O ATRIBUTOS DE LA BASE DE DATOS
    public function atributos() {
        $atributos = [];
        foreach(self::$datosDB as $datos) {
            // Ignoramos ID ya que aún no existe
            if($datos === 'id') continue;
            $atributos[$datos] = $this->$datos;
        }
        return $atributos;

    }
    // VALIDA LOS DATOS
    public function validarDatos() {
        $atributos = $this->atributos(); // obtenemos los atributos
        $validado = [];

        foreach($atributos as $key => $value ) { // recorremos los atributos
            $validado[$key] = self::$db->escape_string($value);// validamos los datos. escape_string es la funcion de PHP que valida los datos 
        }

        return $validado;
    }
    // VALIDACIÓN
    public static function getErrores() {
        return self::$validacion;
    }

    public function validar() {
            // if de comprobación
    if(!$this->marca) {
        self::$validacion[] = "La marca es obligatoria!!";    
    }
    if(!$this->modelo) {
        self::$validacion[] = "El modelo es obligatorio!!";   
    }
    if(!$this->caracteristicas) {
        self::$validacion[] = "Las características son obligatorias!!";    
    }
    if(!$this->precio) {
        self::$validacion[] = "El precio es obligatorio!!";    
    }
    if(!$this->potencia) {
        self::$validacion[] = "La potencia es obligatoria!!";    
    }
    if(!$this->velocidad) {
        self::$validacion[] = "La velocidad es obligatoria!!";    
    }
    if(!$this->imagen) {
        self::$validacion[] = "Debes seleccionar una imagen!!";    
    }


    
    return self::$validacion;

    }
    // SUBIDA DE IMAGEN 
    public function setImagen($imagen) {
        // asigna al atributo imagen el nobre de la imagen 
        if($imagen) {
            $this->imagen = $imagen;
        }
    }
  
}