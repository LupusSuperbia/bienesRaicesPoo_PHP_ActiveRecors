<?php

require '../../includes/app.php';

use App\Vendedor;

estaAutenticado();

//----------------------------------------------------------------//
// ---------------- Validar que el id sea un ID valido ------------- //
//----------------------------------------------------------------//
$id = $_GET['id'];

$id = filter_var($id, FILTER_VALIDATE_INT);


if(!$id){
    header('Location: /admin');
}
//----------------------------------------------------------------//
// ---------------- Obtener el arrelgo del vendedor ------------- //
//----------------------------------------------------------------//
$vendedor = Vendedor::find($id);

//----------------------------------------------------------------//
// ---------------- Arreglo con mensajes de errores ------------- //
//----------------------------------------------------------------//

$errores = Vendedor::getErrores();

//----------------------------------------------------------------//
// Ejecutar el código después de que el usuario envia el formulario //
//----------------------------------------------------------------//
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    
    // --------------------- Asginar los valores ----------------//
    $args = $_POST['vendedor'];

    // --- Sincroniar objeto en memoria con lo que el usuario escribio  ----------------//
    $vendedor->sincronizar($args);

    // --------------------- Validacion----------------//
    $errores = $vendedor->validar();

    
    if(empty($errores)){
        $vendedor->guardar();
        
    }
}

incluirTemplate('header');

?>

<main class="contenedor seccion">
    <h1>Actualizar Vendedor(a)</h1>
    <a href="/admin" class="boton boton-verde">Volver</a>


    <?php foreach ($errores as $error) : ?>
        <div class="alerta error">
            <?php echo $error; ?>
        </div>
    <?php endforeach; ?>


    <form action="/admin/vendedores/actualizar.php" method="POST" class="formulario" enctype="multipart/form-data">
    <?php include '../../includes/templates/formulario_vendedores.php' ?>'

        <input type="submit" value="Guardar Cambios" class="boton boton-verde" name="" id="">
    </form>
</main>



<?php incluirTemplate('footer'); ?>