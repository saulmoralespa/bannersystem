<?php
/**
 * Created by PhpStorm.
 * User: smp
 * Date: 25/08/17
 * Time: 04:45 PM
 */

class BSSMP_Banner_System_Admin_Configuration
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
        if (get_page_by_title(__('Pago sistema de banners','bannersystem')) === NULL && get_page_by_title(__('Sistema de banners','bannersystem')) === NULL) {
		    ?>
            <div id="create-pages">
                <input type="hidden" name="createpages" value="all">
                <img src="<?php echo bssmp_index_bannersystem()->plugin_url .'assets/img/loading.gif'; ?>" style="display: none;">
                <p><strong><?php echo __('Es necesario crear páginas','bannersystem');?></strong></p>
                <button class="button button-primary" id="pages-bansys"><?php echo __('Crear páginas','bannersystem');?></button>
            </div>
            <div id="pages-create" style="display: none;">
                <p><strong><?php echo __('Las páginas han sido creadas','bannersystem');?></strong></p>
            </div>
		    <?php
	    }elseif (get_page_by_title(__('Pago sistema de banners','bannersystem')) === NULL ){
		    ?>
            <div id="create-pages">
                <input type="hidden" name="createpages" value="pay">
                <img src="<?php echo bssmp_index_bannersystem()->plugin_url .'assets/img/loading.gif'; ?>" style="display: none;">
                <p><strong><?php echo __('Es necesario crear páginas','bannersystem');?></strong></p>
                <button class="button button-primary" id="pages-bansys"><?php echo __('Crear páginas','bannersystem');?></button>
            </div>
            <div id="pages-create" style="display: none;">
                <strong><?php echo __('Las páginas han sido creadas','bannersystem');?></strong>
            </div>
		    <?php
	    }elseif (get_page_by_title(__('Sistema de banners','bannersystem')) === NULL){
		    ?>
            <div id="create-pages">
                <input type="hidden" name="createpages" value="banners">
                <img src="<?php echo bssmp_index_bannersystem()->plugin_url .'assets/img/loading.gif'; ?>" style="display: none;">
                <p><strong><?php echo __('Es necesario crear páginas','bannersystem');?></strong></p>
                <button class="button button-primary" id="pages-bansys"><?php echo __('Crear páginas','bannersystem');?></button>
            </div>
            <div id="pages-create" style="display: none;">
                <strong><?php echo __('Las páginas han sido creadas','bannersystem');?></strong>
            </div>
		    <?php
	    }
	    ?>
            <div id="reset_banners">
                <h1><?php _e( 'Resetear banners','bannersystem' ); ?> </h1>
                <button class="button button-primary" data-reset='banners_system'><?php echo __('Resetear','bannersystem');?></button>
            </div>
        </div>
            <?php
    }
}