<?php

class Ordenanzas extends Controller {
    public function __construct(){
        if(!usuarioLogueado()){
            redirect('usuarios/login');
        }

        $this->ordenanzaModel = $this->model('Ordenanza');
    }

    public function index(){
        $ordenanzas = $this->ordenanzaModel->getOrdenanzas();

        $data = [
            'title' => 'Listado de Ordenanzas',
            'ordenanzas' => $ordenanzas
        ];

        $this->view('ordenanzas/index', $data);
    }

    public function alta(){
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            $data = [
                'title' => 'Crear nueva ordenanza',
                'nro' => $_POST['txtNro'],
                'año' => $_POST['txtAño'],
                'descripcion' => $_POST['txtDescripcion'],
                'ordenanza' => $_FILES['pdfOrdenanza'],
                'ruta' => '',
                'nombrePdf' => '',
                'fileName' => '',
                'fileTempName' => '',
                'fileSize' => '',
                'fileError' => '',
                'fileType' => '',
                'fileExtension' => '',
                'nroError' => '',
                'añoError' => '',
                'descripcionError' => '',
                'ordenanzaError' => ''
            ];

            if(empty($data['nro'])){
                $data['nroError'] = 'Debe ingresar el número de la ordenanza.';
            }

            if(empty($data['año'])){
                $data['añoError'] = 'Debe ingresar el año de la ordenanza.';
            }

            if(empty($data['descripcion'])){
                $data['descripcionError'] = 'Debe ingresar la descripción de la ordenanza.';
            }

            if($data['ordenanza']['name'] == ""){
                $data['ordenanzaError'] = 'Debe seleccionar un archivo .PDF';
            }

            /* Variables con información sobre el archivo subido */
            $fileName = $data['ordenanza']['name']; //nombre del archivo
            $fileTempName = $data['ordenanza']['tmp_name']; //ruta temporal
            $fileSize = $data['ordenanza']['size']; //tamaño del archivo
            $fileError = $data['ordenanza']['error']; //si ocurrió algún error
            $fileType = $data['ordenanza']['type']; //tipo del archivo

            $upload_dir = ORDENANZAS_FOLDER;


            /* ========================================
             * Inicio de control de errores del archivo
             * ======================================== */
            if(!$data['fileExtension'] = $this->verificarExtension($fileName)){ // Si el archivo subido no es formato .pdf
                $data['ordenanzasError'] = 'Extensión de archivo no permitida (Sólo se permiten archivos con formato .pdf)';
            }

            if($fileError !== 0){ // Si hubo algún error al subir el archivo
                $data['ordenanzasError'] = 'Ha ocurrido un error al subir el archivo.';
            }

            if($fileSize > 1000000){ // Si el tamaño del archivo es mayor a 1.000.000bytes -> 100megabytes
                $data['ordenanzasError'] = 'Tamaño de archivo excedido. El tamaño máximo es de 100mb.';
            }

            $nombrePdf = $this->generarNombrePdf($data['nro'], $data['año'], $data['fileExtension']); // Genero un nombre de archivo único -> Ord 134-2020 (YzQ).pdf

            $fileRuta = $data['año'] . "/" . $nombrePdf; // Ruta del archivo -> 2020/Ord 134-2020 (YzQ).pdf
            
            //Variable que almacena la ruta de destino donde se va a almacenar el archivo. -> dovada_mvc/ordenanzasDigitales/2020/Ord 134-2020.pdf
            $fileDestination = $upload_dir . $fileRuta;

            if(!is_dir($upload_dir . $data['año'])){ //Si no existe la carpeta ordenanzas/año
                mkdir($upload_dir . $data['año'], 0777, true); //Crear la carpeta ordenanzas/año con todos los permisos
            }

            if (!is_dir($upload_dir . $data['año']) || !is_writable($upload_dir . $data['año'])){ //Si la carpeta de destino no existe o no tiene permisos para escribir
                $data['ordenanzasError'] = 'El directorio de destino no existe, o no tiene permisos de escritura.';
            }
            /* ========================================
             * Fin de control de errores del archivo
             * ======================================== */



            
            // Si no hay errores
            if(empty($data['nroError']) && empty($data['añoError']) && empty($data['descripcionError']) && empty($data['ordenanzaError'])){
                // Acá se empieza a subir el archivo

                // Crear registro en la base de datos con la ruta final del archivo
                $resultInsertOrdenanza = $this->ordenanzaModel->altaOrdenanza($data['nro'], $data['año'], $data['descripcion'], $fileRuta, $nombrePdf, $_SESSION['usrId']);
                
                if($resultInsertOrdenanza){ // Si se creó exitosamente el registro en la base de datos
                    // Mover el archivo
                    if(move_uploaded_file($fileTempName, $fileDestination)){ // Si se movió el archivo
                        notificar('ordenanzasAltaExito', 'Se ha registrado la información de la ordenanza en la base de datos, y se ha almacenado exitosamente el archivo digital en el servidor.', 'success');
                        redirect('ordenanzas');
                    }else{ // Si no se pudo mover el archivo
                        $data['ordenanzasError'] = 'Ha ocurrido un error al intentar mover el archivo.';
                        $this->view('ordenanzas', $data);
                    }
                }else{ // Si hubo un error al crear el registro en la base de datos
                    $data['ordenanzasError'] = 'No se pudo crear el registro de ordenanza en la base de datos. (No se subió el archivo)';
                    $this->view('ordenanzas', $data);
                }

            }else{
                $this->view('ordenanzas/alta', $data);
            }
        }else{
            $data = [
                'title' => 'Crear nueva ordenanza',
                'nro' => '',
                'año' => '',
                'descripcion' => '',
                'ruta' => '',
                'nombrePdf' => '',
                'ordenanza' => '',
                'nroError' => '',
                'añoError' => '',
                'descripcionError' => '',
                'ordenanzaError' => ''
            ];
    
            $this->view('ordenanzas/alta', $data);
        }
    }

    public function verificarExtension($fileName){
        $nombreyextension = explode('.', $fileName); //tomar el nombre del archivo (ej: archivo.jpg), y separar las dos palabras en el punto
        $fileExtension = strtolower(end($nombreyextension)); //tomar la segunda palabra y pasarla a letra minúscula (de JPG a jpg)

        $allowedExtensions = array('pdf'); //array('pdf', 'jpg', 'jpeg', 'png'); //Array con los tipos de extensión de archivos permitidos

        if(in_array($fileExtension, $allowedExtensions)){ //Si el archivo tiene una extensión permitida
            return $fileExtension;
        }else{
            return false;
        }
    }

    public function generarNombrePdf($nroOrdenanza, $año, $fileExtension){
        // Inicio de algoritmo para generar un string aleatorio de length 3
        $length = 3;
    
        $range = array_merge(range('A', 'Z'), range('a', 'z'));
    
        $randomString = '';
    
        for($i = 0; $i < $length; $i++){
            //mt_rand(from, to) => mt_rand(0, <longitud del array $range - 1>)
            $randomString .= $range[mt_rand(0, count($range) - 1)];
        }
        // Fin de algoritmo para generar un string aleatorio de length 3
    
        // Creo un nombre de archivo único -> ord134-20_YzQ.pdf
        $nombrePdf = "Ord " . $nroOrdenanza . "-" . $año . " (" . $randomString . ")." . $fileExtension;

        return $nombrePdf;
    }
}