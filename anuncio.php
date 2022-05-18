<?php 
require 'includes/app.php';

use App\Propiedad;
/////////////////////// VALIDAR ID ///////////
$id = $_GET['id'];
$id = filter_var($id, FILTER_VALIDATE_INT);
if(!$id){
  header('Location: /');
}

$propiedad = Propiedad::find($id);

incluirTemplate('header');

?>


    <main class="contenedor seccion contenido-centrado">
        <h1> <?php echo $propiedad->titulo; ?>  </h1>

        <picture>
            <source srcset="build/img/destacada.webp" type="image/webp" />
            <source srcset="build/img/destacada.jpeg" type="image/jpg" />
            <img src="build/img/destacada.jpg" alt="anuncio" loading="lazy" />
          </picture>

          <div class="resumen-propiedad">
              <p class="precio">$<?php echo $propiedad->precio; ?></p>
              <ul class="iconos-caracteristicas">
                <li>
                  <img class="icono" loading="lazy" src="build/img/icono_wc.svg" alt="icono" />
                  <p><?php echo $propiedad->wc; ?></p>
                </li>
                <li>
                  <img class="icono"
                    loading="lazy"
                    src="build/img/icono_estacionamiento.svg"
                    alt="icono"
                  />
                  <p><?php echo $propiedad->estacionamiento; ?></p>
                </li>
                <li>
                  <img class="icono"
                    loading="lazy"
                    src="build/img/icono_dormitorio.svg"
                    alt="icono"
                  />
                  <p><?php echo $propiedad->habitaciones; ?></p>
                </li>
              </ul>
              <p><?php echo $propiedad->descripcion; ?>?</p>
          </div>
    </main>

    <?php include 'includes/templates/footer.php' ?>
