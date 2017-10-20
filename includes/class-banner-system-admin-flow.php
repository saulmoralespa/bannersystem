<?php
/**
 * Created by PhpStorm.
 * User: smp
 * Date: 15/09/17
 * Time: 02:27 PM
 */

class BSSMP_Banner_System_Admin_Flow
{
	public function configInit()
	{

		bssmp_index_bannersystem()->tabsMenu->page();
	}

	public function content()
	{
		$test_flow = get_option('test-banner-system');
		$emailComercio = get_option('form-email-comercio-banner-system');
		$medioPago = get_option('medio-pago-banner-system');
		$acceso = get_option('acceso-banner-system');
		$certificado = get_option('certificado-banner-system');
		$sandbox_emailComercio = get_option('sandbox-form-email-comercio-banner-system');
		$sandbox_medioPago = get_option('sandbox-medio-pago-banner-system');
		$sandbox_acceso = get_option('sandbox-acceso-banner-system');
		$sandbox_certificado = get_option('sandbox-certificado-banner-system');
		$upload_dir = wp_upload_dir();
		$dir = $upload_dir['basedir'] . '/bannersystem/flow/';
	    ?>
        <div class="wrap about-wrap">
            <h1><?php _e( 'Configurar medio de pago Flow','bannersystem' ); ?></h1>
        <form id="form-flow-banner-sytem">
            <table class="form-table">
                <tbody>
                <tr>
                    <th><?php echo __('Modo pruebas','bannersytem');?></th>
                    <td>
                        <select name="test-banner-system" id="test-banner-system">
                            <option value=""><?php echo __('Seleccione','bannersytem');?></option>
                            <option value="sandbox" <?php if ($test_flow == 'sandbox') echo 'selected'; ?>><?php echo __('SI','bannersytem');?></option>
                            <option value="live" <?php if ($test_flow == 'live') echo 'selected'; ?>><?php echo __('NO','bannersytem');?></option>
                        </select>
                    </td>
                </tr>
                    <tr class="live-flow-banner-system" style="display: none;">
                        <th><?php echo __('Email comercio','bannersytem');?></th>
                        <td>
                            <input type="email" name="form-email-comercio-banner-system" value="<?php echo $emailComercio; ?>" required>
                        </td>
                    </tr>
                    <tr class="live-flow-banner-system" style="display: none;">
                        <th><?php echo __('Medio de pago','bannersytem');?></th>
                        <td>
                            <select name="medio-pago-banner-system" id="medio-pago-banner-system" required>
                                <option value=""><?php echo __('Seleccione','bannersytem');?></option>
                                <option value="9" <?php if ($medioPago == '9') echo 'selected'; ?>><?php echo __('Todos los medios de pago','bannersytem');?></option>
                                <option value="1" <?php if ($medioPago == '1') echo 'selected'; ?>><?php echo __('Solo Webpay','bannersytem');?></option>
                                <option value="2" <?php if ($medioPago == '2') echo 'selected'; ?>><?php echo __('Solo Servipag','bannersytem');?></option>
                                <option value="3" <?php if ($medioPago == '3') echo 'selected'; ?>><?php echo __('Solo Multicaja','bannersytem');?></option>
                            </select>
                        </td>
                    </tr>
                    <tr class="live-flow-banner-system" style="display: none;">
                        <th><?php echo __('Modo de acceso','bannersytem');?></th>
                        <td>
                            <select name="acceso-banner-system" id="acceso-banner-system" required>
                                <option value=""><?php echo __('Seleccione','bannersytem');?></option>
                                <option value="f" <?php if ($acceso === 'f') echo 'selected'; ?>><?php echo __('Mostrar pasarela Flow','bannersytem');?></option>
                                <option value="d" <?php if ($acceso === 'd') echo 'selected'; ?>><?php echo __('Directamente medio de pago','bannersytem');?></option>
                            </select>
                        </td>
                    </tr>
                    <tr class="live-flow-banner-system" style="display: none;">
                        <th><?php echo __('Certficado digital','bannersytem');?></th>
                        <td>
	                        <?php
	                        if (!empty($certificado) && file_exists($dir . $certificado)){
		                        echo "<p><strong>".__('Actualmente hay subido un certificado para produccción')."</strong></p>";
	                        }else{
		                        echo "<p style='color: red;'><strong>".__('Es requerido que suba el certificado para produccción')."</strong></p>";
                            }
	                        ?>
                            <input type="file" name="certificado-banner-system" id="certificado-banner-system" required accept=".pem">
                        </td>
                    </tr>
                    <tr class="sandbox-flow-banner-system" style="display: none;">
                        <th><?php echo __('Email comercio','bannersytem');?></th>
                        <td>
                            <input type="email" name="sandbox-form-email-comercio-banner-system" value="<?php echo $sandbox_emailComercio; ?>" required>
                        </td>
                    </tr>
                    <tr class="sandbox-flow-banner-system" style="display: none;">
                        <th><?php echo __('Medio de pago','bannersytem');?></th>
                        <td>
                            <select name="sandbox-medio-pago-banner-system" id="sandbox-medio-pago-banner-system" required>
                                <option value=""><?php echo __('Seleccione','bannersytem');?></option>
                                <option value="9" <?php if ($sandbox_medioPago == '9') echo 'selected'; ?>><?php echo __('Todos los medios de pago','bannersytem');?></option>
                                <option value="1" <?php if ($sandbox_medioPago == '1') echo 'selected'; ?>><?php echo __('Solo Webpay','bannersytem');?></option>
                                <option value="2" <?php if ($sandbox_medioPago == '2') echo 'selected'; ?>><?php echo __('Solo Servipag','bannersytem');?></option>
                                <option value="3" <?php if ($sandbox_medioPago == '3') echo 'selected'; ?>><?php echo __('Solo Multicaja','bannersytem');?></option>
                            </select>
                        </td>
                    </tr>
                    <tr class="sandbox-flow-banner-system" style="display: none;">
                        <th><?php echo __('Modo de acceso','bannersytem');?></th>
                        <td>
                            <select name="sandbox-acceso-banner-system" id="sandbox-acceso-banner-system" required>
                                <option value=""><?php echo __('Seleccione','bannersytem');?></option>
                                <option value="f" <?php if ($sandbox_acceso == 'f') echo 'selected'; ?>><?php echo __('Mostrar pasarela Flow','bannersytem');?></option>
                                <option value="d" <?php if ($sandbox_acceso == 'd') echo 'selected'; ?>><?php echo __('Directamente medio de pago','bannersytem');?></option>
                            </select>
                        </td>
                    </tr>
                    <tr class="sandbox-flow-banner-system" style="display: none;">
                        <th><?php echo __('Certficado digital','bannersytem');?></th>
                        <td>
	                        <?php
	                        if (!empty($sandbox_certificado) && file_exists($dir . $sandbox_certificado)){
		                        echo "<p><strong>".__('Actualmente hay subido un certificado para pruebas')."</strong></p>";
	                        }else{
		                        echo "<p style='color: red;'><strong>".__('Es requerido que suba el certificado para pruebas')."</strong></p>";
                            }
	                        ?>
                            <input type="file" name="sandbox-certificado-banner-system" id="sandbox-certificado-banner-system" required accept=".pem">
                        </td>
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
        </div>
		<?php
	}
}