<?php
/**
 * Created by PhpStorm.
 * User: smp
 * Date: 20/09/17
 * Time: 09:02 PM
 */

class BSSMP_Banner_System_Admin_Member
{
	public function configInit()
	{

		bssmp_index_bannersystem()->tabsMenu->page();
	}

	public function content()
	{

	    ?>
        <div class="wrap about-wrap">
        <?php
	    if (get_page_by_title('Pago sistema de banners') === null){
			echo "<p><strong>".__('Faltan páginas por crear')."</strong></p>";
		}else{
			$page = get_page_by_title(__('Pago sistema de banners','bannersystem'));
			$meta = get_post_meta($page->ID,'member_banner_system', true);

			?>
            <form id="form-member-banner-system">
			<table>
			<thead>
			<tr>
				<th>Tipo de banner</th>
				<th>Precio</th>
				<th>Duración días</th>
			</tr>
			</thead>
			<tbody id="template">
                    <tr>
                        <input type="hidden" name="idpost" data-banner-system="data" value="<?php echo $page->ID; ?>">
                        <td><input type="text" class="form-control" name="text_name_banner[]" data-banner-system="data" value="rec_medium" readonly></td>
                        <td><input type="number" class="form-control" name="text_price_banner[]" data-banner-system="data" value="<?php if (isset($meta['rec_medium_price'])) echo $meta['rec_medium_price']; ?>" required></td>
                        <td><input type="number" class="form-control" min="30"  name="duration_banner[]" data-banner-system="data" value="<?php if (isset($meta['rec_medium_duration'])) echo $meta['rec_medium_duration']; ?>" required></td>
                    </tr>
                    <tr>
                        <td><input type="text" class="form-control" name="text_name_banner[]" data-banner-system="data" value="leaderboard" readonly></td>
                        <td><input type="number" class="form-control" name="text_price_banner[]" data-banner-system="data" value="<?php if (isset($meta['leaderboard_price'])) echo $meta['leaderboard_price']; ?>" required></td>
                        <td><input type="number" class="form-control" min="30"  name="duration_banner[]" data-banner-system="data" value="<?php if (isset($meta['leaderboard_duration'])) echo $meta['leaderboard_duration']; ?>" required></td>
                    </tr>
                    <tr>
                        <td><input type="text" class="form-control" name="text_name_banner[]" data-banner-system="data" value="media_page" readonly></td>
                        <td><input type="number" class="form-control" name="text_price_banner[]" data-banner-system="data" value="<?php if (isset($meta['media_page_price'])) echo $meta['media_page_price']; ?>" required></td>
                        <td><input type="number" class="form-control" min="30"  name="duration_banner[]" data-banner-system="data" value="<?php if (isset($meta['media_page_duration'])) echo $meta['media_page_duration']; ?>" required></td>
                    </tr>
                    <tr>
                        <td><input type="text" class="form-control" name="text_name_banner[]" data-banner-system="data" value="medio_banner" readonly></td>
                        <td><input type="number" class="form-control" name="text_price_banner[]" data-banner-system="data" value="<?php if (isset($meta['medio_banner_price'])) echo $meta['medio_banner_price']; ?>" required></td>
                        <td><input type="number" class="form-control" min="30"  name="duration_banner[]" data-banner-system="data" value="<?php if (isset($meta['medio_banner_duration'])) echo $meta['medio_banner_duration']; ?>" required></td>
                    </tr>
                    <tr>
                        <td><input type="text" class="form-control" name="text_name_banner[]" data-banner-system="data" value="movil_banner" readonly></td>
                        <td><input type="number" class="form-control" name="text_price_banner[]" data-banner-system="data" value="<?php if (isset($meta['movil_banner_price'])) echo $meta['movil_banner_price']; ?>" required></td>
                        <td><input type="number" class="form-control" min="30"  name="duration_banner[]" data-banner-system="data" value="<?php if (isset($meta['movil_banner_duration'])) echo $meta['movil_banner_duration']; ?>" required></td>
                    </tr>
				</tbody>
				</table>
	            <?php submit_button(); ?>
            </form>
            <div class="overlay-banner-system" style="display: none;">
                <div class="overlay-content-banner-system">
                    <img src="<?php echo bssmp_index_bannersystem()->plugin_url . 'assets/img/loading.gif';?>" alt="">
                    <div class="message"><strong></strong></div>
                </div>
            </div>
			<?php
		}
        $dias = bssmp_index_bannersystem()->banner_system_update_banner_days(true);
		?>
            <h1><?php _e( 'información de banners','bannersystem' ); ?> </h1>
            <?php if (!empty($dias)){echo $dias;}else{echo __('No hay banners rentados','bannersystem');} ?>
        </div>
            <?php
	}
}