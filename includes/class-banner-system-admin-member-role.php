<?php
/**
 * Created by PhpStorm.
 * User: smp
 * Date: 25/09/17
 * Time: 10:20 PM
 */

class BSSMP_Banner_System_Admin_Menu_Role
{

	public function menu_user_role__banner_system()
	{
		$user = wp_get_current_user();
        $meta = get_post_meta($user->ID,'order_banner_system',true);
		$upload_dir = wp_upload_dir();
		$dir = $upload_dir['basedir'] . '/bannersystem/img/';
		$dir_url = $upload_dir['baseurl'] . '/bannersystem/img/';
	    ?>
		<div class="wrap about-wrap">

			<h1><?php _e( 'Bienvenido a su gestor de banners','bannersystem' ); ?></h1>

			<div class="about-text">
				<?php _e('Podrá cargar imágenes,cambiar urls y llevar una estadisticas de clicks y visualizaciones de los banners.','bannersystem' ); ?>
			</div>
		<?php
        if (!empty($meta)){
        ?>
            <div class="about-text">
		        <?php _e('Suba la imágen y añada la url','bannersystem' ); ?>
            </div>
            <table class="form-table">
                <tbody>
            <?php
            if (isset($meta['status_order_rec_medium'])){
	            $rec_medium = get_option('banner_system_rec_medium_banner_url_pay');
	            $rec_medium = empty($rec_medium) ? home_url() : $rec_medium;
	            $endregister = $meta['status_order_rec_medium']['endregister'];
	            $date = date('d-m-Y');
	            $opt = "bssmp_rec_medium_bannersystem";
	            $clicks = empty(get_option($opt)) ? 0 : get_option($opt);
                echo "<tr class='rectangulo_mediano_bannersystem'>
                    <th>".__('banner 300x250','bannersystem')." " . sprintf( __( 'Días restantes:  %s y ha recibido %s clicks', 'bannersystem' ), bssmp_index_bannersystem()->compararFechas($endregister,$date), $clicks ) ."</th>
                    <td>
                    <label>".__('url del banner','bannersystem')."</label>
                    <input type='url' name='banner_system_rec_medium_banner_url_pay' value='".$rec_medium."'>
                    <button type='submit' class='save_url_banner'>".__('Guardar','bannersystem')."</button> 
                    <input type='file' name='banner_system_rec_medium_banner_src_pay' id='banner_system_rec_medium_banner_src_pay'  accept='.png, .jpg, .jpeg, .gif'></td>";
	            $rectangulo_mediano = get_option('banner_system_rec_medium_banner_src_pay');
	            if (!empty($rectangulo_mediano) && file_exists($dir . $rectangulo_mediano)){
		            echo "<td><a href='".$rec_medium."'><img src='".$dir_url . $rectangulo_mediano."'></a></td>";
	            }
                echo "</tr>";
            }
            if (isset($meta['status_order_leaderboard'])){
	            $leaderboard_url = get_option('banner_system_leaderboard_banner_url_pay');
	            $leaderboard_url = empty($leaderboard_url) ? home_url() : $leaderboard_url;
	            $endregister = $meta['status_order_leaderboard']['endregister'];
	            $date = date('d-m-Y');
	            $opt = "bssmp_leaderboard_bannersystem";
	            $clicks = empty(get_option($opt)) ? 0 : get_option($opt);
	            echo "<tr class='leaderboard_bannersystem'>
                    <th>".__('banner 728x90','bannersystem')." " . sprintf( __( 'Días restantes:  %s y ha recibido %s clicks', 'bannersystem' ), bssmp_index_bannersystem()->compararFechas($endregister,$date), $clicks ) ."</th>
                    <td>
                    <label>".__('url del banner','bannersystem')."</label>
                    <input type='url' name='banner_system_leaderboard_banner_url_pay' value='".$leaderboard_url."'>
                    <button type='submit' class='save_url_banner'>".__('Guardar','bannersystem')."</button> 
                    <input type='file' name='banner_system_leaderboard_banner_src_pay' id='banner_system_leaderboard_banner_src_pay'  accept='.png, .jpg, .jpeg, .gif'></td>";
	            $leaderboard = get_option('banner_system_leaderboard_banner_src_pay');
	            if (!empty($leaderboard) && file_exists($dir . $leaderboard)){
		            echo "<td><a href='".$leaderboard_url."'><img src='".$dir_url . $leaderboard . "'></a></td>";
	            }
	            echo "</tr>";
            }
            if (isset($meta['status_order_media_page'])){
	            $media_page_url = get_option('banner_system_media_page_banner_url_pay');
	            $media_page_url = empty($media_page_url) ? home_url() : $media_page_url;
	            $endregister = $meta['status_order_media_page']['endregister'];
	            $date = date('d-m-Y');
	            $opt = "bssmp_media_page_bannersystem";
	            $clicks = empty(get_option($opt)) ? 0 : get_option($opt);
	            echo "<tr class='media_page_bannersystem'>
                    <th>".__('banner 300x600','bannersystem')." " . sprintf( __( 'Días restantes:  %s y ha recibido %s clicks', 'bannersystem' ), bssmp_index_bannersystem()->compararFechas($endregister,$date), $clicks ) ."</th>
                    <td>
                    <label>".__('url del banner','bannersystem')."</label>
                    <input type='url' name='banner_system_media_page_banner_url_pay' value='".$media_page_url."'>
                    <button type='submit' class='save_url_banner'>".__('Guardar','bannersystem')."</button>
                    <input type='file' name='banner_system_media_page_banner_src_pay' id='banner_system_media_page_banner_src_pay'  accept='.png, .jpg, .jpeg, .gif'></td>";
	            $media_page = get_option('banner_system_media_page_banner_src_pay');
	            if (!empty($media_page) && file_exists($dir . $media_page)){
		            echo "<td><a href='".$media_page_url."'><img src='".$dir_url . $media_page . "'></a></td>";
	            }
	            echo "</tr>";
            }
            if (isset($meta['status_order_medio_banner'])){
	            $medio_banner_url = get_option('banner_system_medio_banner_banner_url_pay');
	            $medio_banner_url = empty($medio_banner_url) ? home_url() : $medio_banner_url;
	            $endregister = $meta['status_order_medio_banner']['endregister'];
	            $date = date('d-m-Y');
	            $opt = "bssmp_medio_banner_bannersystem";
	            $clicks = empty(get_option($opt)) ? 0 : get_option($opt);
	            echo "<tr class='medio_banner_bannersystem'>
                    <th>".__('banner 234x60','bannersystem')." " . sprintf( __( 'Días restantes:  %s y ha recibido %s clicks', 'bannersystem' ), bssmp_index_bannersystem()->compararFechas($endregister,$date), $clicks ) ."</th>
                    <td>
                    <label>".__('url del banner','bannersystem')."</label>
                    <input type='url' name='banner_system_medio_banner_banner_url_pay' value='".$medio_banner_url."'>
                    <button type='submit' class='save_url_banner'>".__('Guardar','bannersystem')."</button>
                    <input type='file' name='banner_system_medio_banner_banner_src_pay' id='banner_system_medio_banner_banner_src_pay'  accept='.png, .jpg, .jpeg, .gif'></td>";
	            $medio_banner = get_option('banner_system_medio_banner_banner_src_pay');
	            if (!empty($medio_banner) && file_exists($dir . $medio_banner)){
		            echo "<td><a href='".$medio_banner_url."'><img src='".$dir_url . $medio_banner . "'></a></td>";
	            }
	            echo "</tr>";
            }
            if (isset($meta['status_order_movil_banner'])){
	            $movil_banner_url = get_option('banner_system_movil_banner_banner_url_pay');
	            $movil_banner_url = empty($movil_banner_url) ? home_url() : $movil_banner_url;
                $endregister = $meta['status_order_movil_banner']['endregister'];
                $date = date('d-m-Y');
	            $opt = "bssmp_movil_banner_bannersystem";
	            $clicks = empty(get_option($opt)) ? 0 : get_option($opt);
	            echo "<tr class='movil_banner_bannersystem'>
                    <th>".__('banner 320x100','bannersystem')." " . sprintf( __( 'Días restantes:  %s y ha recibido %s clicks', 'bannersystem' ), bssmp_index_bannersystem()->compararFechas($endregister,$date), $clicks ) ."</th>
                    <td>
                    <label>".__('url del banner','bannersystem')."</label>
                    <input type='url' name='banner_system_movil_banner_banner_url_pay' value='".$movil_banner_url."'>
                    <button type='submit' class='save_url_banner'>".__('Guardar','bannersystem')."</button>
                    <input type='file' name='banner_system_movil_banner_banner_src_pay' id='banner_system_movil_banner_banner_src_pay'  accept='.png, .jpg, .jpeg, .gif'></td>";
	            $movil_banner = get_option('banner_system_movil_banner_banner_src_pay');
	            if (!empty($movil_banner) && file_exists($dir . $movil_banner)){
		            echo "<td><a href='".$movil_banner_url."'><img src='" . $dir_url . $movil_banner . "'></a></td>";
	            }
	            echo "</tr>";
            }
            ?>
                </tbody>
            </table>
                <?php
        }
        ?>
            <div class="overlay-banner-system" style="display: none;">
                <div class="overlay-content-banner-system">
                    <img src="<?php echo bssmp_index_bannersystem()->plugin_url . 'assets/img/loading.gif';?>" alt="">
                    <div class="message"><strong></strong></div>
                </div>
            </div>
        </div>
        <?php
	}
}