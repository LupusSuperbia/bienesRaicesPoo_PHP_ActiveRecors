<?php

require '../../includes/app.php';
use App\Propiedad;
use App\Vendedor;
use Intervention\Image\ImageManagerStatic as Image;


estaAutenticado();
//
// ----- VALIDAR ID -
$id = $_GET['id'];
$id = filter_var($id, FILTER_VALIDATE_INT);
if(!$id){
    header('Location: /admin');
}

// 
// ---- BASE DE DATOS 
// Obtener datos de la propiedad
$propiedad = Propiedad::find($id);


// Consultar para obtener los vendedores 
$vendedores = Vendedor::all();
///// ARREGLO CON MENSAJES DE ERRORES ////// 
$errores = Propiedad::getErrores();



////// Ejecutar el código después de que el usuario envia el formulario ////////////
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Asignar los atributos
    $args = $_POST['propiedad'];
    
    $propiedad->sincronizar($args);
    // Validacion 
    $errores = $propiedad->validar();

    // Subida de archivos
    // Genera un nombre único
    $nombreImagen = md5(uniqid(rand(), true)) . ".jpg";

    
    if($_FILES['propiedad']['tmp_name']['imagen']){

        $image = Image::make($_FILES['propiedad']['tmp_name']['imagen'])->fit(800, 600);
        $propiedad->setImagen($nombreImagen);
    }

    if (empty($errores)) {
        if($_FILES['propiedad']['tmp_name']['imagen']){
        $image->save(CARPETA_IMAGENES . $nombreImagen);
        }
        
        if ($resultado) {
            // Redireccionar al usuario
            $resultado = $propiedad->guardar();
            header('Location: /admin?resultado=2');
        }
    }
}

incluirTemplate('header');
?>
<main class="contenedor seccion">
    <h1>Actualizar Propiedad</h1>
    <a href="/admin" class="boton boton-verde">Volver</a>


    <!--------------------- -->
    <!-- Acá usamos un foreach para iterar sobre el arrays de los errores y ponerlos en html  -->
    <?php foreach ($errores as $error) : ?>
        <div class="alerta error">
            <?php echo $error; ?>
        </div>
    <?php endforeach; ?>

        
    <form  method="POST" class="formulario" enctype="multipart/form-data">
        
        <?php include '../../includes/templates//formulario_propiedades.php'; ?>

        <input type="submit" value="Actualizar Propiedad" class="boton boton-verde" name="" id="">
    </form>
</main>



<?php incluirTemplate('footer'); ?>