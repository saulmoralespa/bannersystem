<?php
/**
 * Created by PhpStorm.
 * User: smp
 * Date: 15/09/17
 * Time: 02:07 PM
 */

class BSSMP_Banner_System_Admin_Banners
{
	public function configInit()
	{

		bssmp_index_bannersystem()->tabsMenu->page();
	}

	public function content()
	{
		$upload_dir = wp_upload_dir();
		$dir = $upload_dir['basedir'] . '/bannersystem/img/';
		$dir_url = $upload_dir['baseurl'] . '/bannersystem/img/';
	    ?>
        <div class="wrap about-wrap">
            <h1><?php _e( 'Banners por defecto','bannersystem' ); ?></h1>
            <div class="about-text">
		        <?php _e('Imágenes para los banners que apareceran cuando esten disponibles.','bannersystem' ); ?>
            </div>
        <table class="form-table">
            <tbody>
            <tr class="rectangulo_mediano_bannersystem">
                <th><?php echo __('Imágen defecto banner 300x250','bannersystem'); ?></th>
                <td><input type="file" name="rec_medium_bannersystem" id="rectangulo_mediano_bannersystem"  accept=".png, .jpg, .jpeg, .gif">
	                <?php wp_nonce_field(plugin_basename( bssmp_index_bannersystem()->file ), 'rectangulo_mediano_bannersystem'); ?></td>
                <?php
                $rectangulo_mediano = get_option('rec_medium_bannersystem');
                if (!empty($rectangulo_mediano) && file_exists($dir . $rectangulo_mediano)){
                    echo "<td><img src='". $dir_url . $rectangulo_mediano . "'></td>";
                }
                ?>
            </tr>
            <tr class="leaderboard_bannersystem">
                <th><?php echo __('Imágen defecto banner 728x90','bannersystem'); ?></th>
                <td><input type="file" name="leaderboard_bannersystem" id="leaderboard_bannersystem"  accept=".png, .jpg, .jpeg, .gif">
		            <?php wp_nonce_field(plugin_basename( bssmp_index_bannersystem()->file ), 'leaderboard_bannersystem'); ?></td>
                <?php
                $leaderboard = get_option('leaderboard_bannersystem');
                if (!empty($leaderboard) && file_exists($dir . $leaderboard)){
	                echo "<td><img src='" . $dir_url . $leaderboard . "'></td>";
                }
                ?>
            </tr>
            <tr class="media_pagina_bannersystem">
                <th><?php echo __('Imágen defecto banner 300x600','bannersystem'); ?></th>
                <td><input type="file" name="media_page_bannersystem" id="media_pagina_bannersystem"  accept=".png, .jpg, .jpeg, .gif">
		            <?php wp_nonce_field(plugin_basename( bssmp_index_bannersystem()->file ), 'media_pagina_bannersystem'); ?></td>
	            <?php
	            $media_pagina = get_option('media_page_bannersystem');
	            if (!empty($media_pagina) && file_exists($dir . $media_pagina)){
		            echo "<td><img src='" . $dir_url . $media_pagina . "'></td>";
	            }
	            ?>
            </tr>
            <tr class="medio_banner_bannersystem">
                <th><?php echo __('Imágen defecto banner 234x60','bannersystem'); ?></th>
                <td><input type="file" name="medio_banner_bannersystem" id="medio_banner_bannersystem"  accept=".png, .jpg, .jpeg, .gif">
		            <?php wp_nonce_field(plugin_basename( bssmp_index_bannersystem()->file ), 'medio_banner_bannersystem'); ?></td>
	            <?php
	            $medio_banner = get_option('medio_banner_bannersystem');
	            if (!empty($medio_banner) && file_exists($dir . $medio_banner)){
		            echo "<td><img src='" . $dir_url . $medio_banner . "'></td>";
	            }
	            ?>
            </tr>
            <tr class="movil_banner_bannersystem">
                <th><?php echo __('Imágen defecto banner 320x100','bannersystem'); ?></th>
                <td><input type="file" name="movil_banner_bannersystem" id="movil_banner_bannersystem"  accept=".png, .jpg, .jpeg, .gif">
		            <?php wp_nonce_field(plugin_basename( bssmp_index_bannersystem()->file ), 'movil_banner_bannersystem'); ?></td>
	            <?php
	            $movil_banner = get_option('movil_banner_bannersystem');
	            if (!empty($movil_banner) && file_exists($dir . $movil_banner)){
		            echo "<td><img src='" . $dir_url . $movil_banner . "'></td>";
	            }
	            ?>
            </tr>
            </tbody>
        </table>
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