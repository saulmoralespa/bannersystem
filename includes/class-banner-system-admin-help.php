<?php
/**
 * Created by PhpStorm.
 * User: smp
 * Date: 15/09/17
 * Time: 02:57 PM
 */

class BSSMP_Banner_System_Admin_Help
{
	public function configInit()
	{

		bssmp_index_bannersystem()->tabsMenu->page();
	}

	public function content()
	{
		?>
        <div class="wrap about-wrap">
            <div class="about-text">
                <h3><?php _e( 'Primeros pasos','bannersystem' ); ?></h3>
                <p>1. Ir al menú General y asegurarse de que se haya completado la creación de las páginas.</p>
                <p>2. Ir al menú Banners y subir las imágenes defecto para los banners, cuando esten disponibles estas son las que aparecerán. Formatos aceptados jpg, png y gif.</p>
                <p>3. Ir al menú flow y completar la configuración para los dos entornos prueba y de producción, recuerde que los datos pueden ser diferentes y en especial el certificado. No se olvide de subirlos.
                    <a href="https://www.flow.cl/pagos-web-sistema.php">Ver documentación de flow</a></p>
                <p>4. Ir al menú membresia y asignar tanto los precios y los días de duración que tendra cada banner después que se activen. El cambio de duración de días no afecta a los que se encuentren actualmente activos.</p>
                <h3><?php _e( 'Shortcodes','bannersystem' ); ?></h3>
                <p>1. Para el banner de tamaño 350x250px use <strong>[rec_medium_banner]</strong></p>
                <p>2. Para el banner de tamaño 728x90px use <strong>[leaderboard_banner]</strong></p>
                <p>3. Para el banner de tamaño 300x600px use <strong>[media_page_banner]</strong></p>
                <p>4. Para el banner de tamaño 234x60px use <strong>[medio_banner_banner]</strong></p>
                <p>5. Para el banner de tamaño 320x100px use <strong>[movil_banner_banner]</strong></p>
                <h3><?php _e( 'Shortcodes para mostrar precio y días que le restan al banner','bannersystem' ); ?></h3>
                <p>1. Para el banner de tamaño 350x250px use <strong>[rec_medium_banner data='show']</strong></p>
                <p>2. Para el banner de tamaño 728x90px use <strong>[leaderboard_banner data='show']</strong></p>
                <p>3. Para el banner de tamaño 300x600px use <strong>[media_page_banner data='show']</strong></p>
                <p>4. Para el banner de tamaño 234x60px use <strong>[medio_banner_banner data='show']</strong></p>
                <p>5. Para el banner de tamaño 320x100px use <strong>[movil_banner_banner data='show']</strong></p>
                <h3><?php _e( 'Shortcode con url e imágen diferente','bannersystem' ); ?></h3>
                <p>Ejemplo si se ha contratado el banner 320x100px por defecto el shortcode es <strong>[movil_banner_banner]</strong></p>
                <p>Para hacer uso de este mismo shortcode pero con diferente url e imágen use de esta forma <strong>[movil_banner_banner url='https://google.com' src='http://www.smartnfinal.com.mx/wp-content/uploads/2017/06/banner-invencibles-img-movil-320X100.jpg']</strong></p>
                <p><strong>Nota: </strong>Podrá replicarlo cuanta veces desee, pero este shortcode seguirá siendo el mismo del tipo de banner rentado.</p>
                <h3><?php _e( 'Aspectos a tener en cuenta','bannersystem' ); ?></h3>
                <p>1. Para un un usuario tanto que este registrado y nuevo se asigna al perfil 'Usuario banner'</p>
                <p>2. Prevenga y asegúrese de que el envio de email funciona correctamente y no este llegando a la carpeta de spam.</p>
                <p>3. Al usuario nuevo se le envia un email con los accesos para ingresar a su panel, estos son email y contraseña.</p>
            </div>
        </div>
		<?php
	}
}