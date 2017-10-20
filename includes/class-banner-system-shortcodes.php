<?php
/**
 * Created by PhpStorm.
 * User: smp
 * Date: 26/08/17
 * Time: 11:38 AM
 */

class BSSMP_Banner_System_shortcodes
{

	public $pagePay;
	public $url_pay;
	public $member_data;
	public $rec__medium_src_pay;
	public $leaderboard_src_pay;
	public $mediapage_src_pay;
	public $mediobanner_src_pay;
	public $movilbanner_src_pay;
	private $_event_medium;
	private $_event_leaderboard;
	private $_event_media_page;
	private $_event_medio_banner;
	private $_event_movil_banner;
	public $upload_dir;
	public $upload_url;

	public function __construct()
	{

		add_shortcode( 'rec_medium_banner', array( $this,'banner_system_rec_medium' ));
		add_shortcode( 'leaderboard_banner', array( $this,'banner_system_leaderboard' ));
		add_shortcode( 'media_page_banner', array( $this,'banner_system_media_page' ));
		add_shortcode( 'medio_banner_banner', array( $this,'banner_system_medio_banner' ));
		add_shortcode( 'movil_banner_banner', array( $this,'banner_system_movil_banner' ));
		add_shortcode( 'banner_system_payment', array( $this,'banner_system_payment' ));

		$this->pagePay = get_page_by_title(__('Pago sistema de banners','bannersystem'));
		$this->member_data = get_post_meta($this->pagePay->ID,'member_banner_system', true);
		$this->url_pay = isset($this->pagePay) ?  get_permalink($this->pagePay->ID) . '?' : home_url('?notPageBanner=create&');
		$this->rec__medium_src_pay = get_option('banner_system_rec_medium_banner_src_pay');
		$this->leaderboard_src_pay = get_option('banner_system_leaderboard_banner_src_pay');
		$this->mediapage_src_pay = get_option('banner_system_media_page_banner_src_pay');
		$this->mediobanner_src_pay = get_option('banner_system_medio_banner_banner_src_pay');
		$this->movilbanner_src_pay = get_option('banner_system_movil_banner_banner_src_pay');
		$this->_event_medium = (empty($this->rec__medium_src_pay)) ? null  : "data-control='rec_medium'";
		$this->_event_leaderboard = (empty($this->leaderboard_src_pay)) ? null : "data-control='leaderboard'";
		$this->_event_media_page = (empty($this->mediapage_src_pay)) ? null : "data-control='media_page'";
		$this->_event_medio_banner = (empty($this->mediobanner_src_pay)) ? null : "data-control='medio_banner'";
		$this->_event_movil_banner = (empty($this->movilbanner_src_pay)) ? null : "data-control='movil_banner'";
		$this->upload_dir = wp_upload_dir();
		$this->upload_url = $this->upload_dir['baseurl'] . '/bannersystem/img/';

	}

	public function banner_system_rec_medium($atts = [])
	{

			$rec__medium_pay = get_option('banner_system_rec_medium_banner_url_pay');
			$rec__medium = (empty($rec__medium_pay)) ? $this->url_pay . 'banner_rec_medium=300x250' : $rec__medium_pay;
			$rec__medium_src = get_option('rec_medium_bannersystem');
			$rec__medium_src = (empty($this->rec__medium_src_pay)) ? $this->upload_url.$rec__medium_src  : $this->upload_url.$this->rec__medium_src_pay;

			$html = "<div id='
			300x250_bannerSys' class='bannerSys' $this->_event_medium>
			<a href='$rec__medium'><img src='$rec__medium_src' alt=''></a>
			</div>";

			$price = $this->member_data["rec_medium_price"];
			$duration = bssmp_index_bannersystem()->banner_system_update_banner_days(false,false,'rec_medium');

			if (isset($atts['data']) && isset($this->_event_medium) && !empty($price) && !empty($duration)){
				$html = sprintf( '<p>' . __( 'El precio del banner es de %s y le restan %s días para estar disponible.', 'bannersystem' ).'</p>', $price, $duration );
				return $html;
			}

			if (isset($atts['url']) && isset($atts['src'])){
				$html = "<div id='
			300x250_bannerSys' class='bannerSys' $this->_event_medium>
			<a href='{$atts['url']}'><img src='{$atts['src']}' alt=''></a>
			</div>";
				return $html;
			}

			return $html;
	}

	public function banner_system_leaderboard($atts = [])
	{
		$leaderboard_pay = get_option('banner_system_leaderboard_banner_url_pay');
		$leaderboard = (empty($leaderboard_pay)) ? $this->url_pay . 'banner_leaderboard=728x90' : $leaderboard_pay;
		$leaderboard_src = get_option('leaderboard_bannersystem');
		$leaderboard_src = (empty($this->leaderboard_src_pay)) ? $this->upload_url.$leaderboard_src : $this->upload_url.$this->leaderboard_src_pay;

		$price = $this->member_data["leaderboard_price"];
		$duration = bssmp_index_bannersystem()->banner_system_update_banner_days(false,false,'leaderboard');

		if (isset($atts['data']) && isset($this->_event_leaderboard) && !empty($price) && !empty($duration)){
			$html = sprintf( '<p>' . __( 'El precio del banner es de %s y le restan %s días para estar disponible.', 'bannersystem' ).'</p>', $price, $duration );
			return $html;
		}

		$html = "<div id='728x250_bannerSys' class='bannerSys' $this->_event_leaderboard>
			<a href='$leaderboard'><img src='$leaderboard_src' alt=''></a>
			</div>";
		if (isset($atts['url']) && isset($atts['src'])){
			$html = "<div id='728x250_bannerSys' class='bannerSys' $this->_event_leaderboard>
			<a href='{$atts['url']}'><img src='{$atts['src']}' alt=''></a>
			</div>";
			return $html;
		}

		return $html;
	}

	public function banner_system_media_page($atts = [])
	{
		$mediapage_pay = get_option('banner_system_media_page_banner_url_pay');
		$mediapage = (empty($mediapage_pay)) ? $this->url_pay . 'banner_media_page=300x600' : $mediapage_pay;
		$mediapage_src = get_option('media_page_bannersystem');
		$mediapage_src = (empty($this->mediapage_src_pay)) ? $this->upload_url.$mediapage_src : $this->upload_url.$this->mediapage_src_pay;

		$price = $this->member_data["media_page_price"];
		$duration = bssmp_index_bannersystem()->banner_system_update_banner_days(false,false,'media_page');

		if (isset($atts['data']) && isset($this->_event_media_page) && !empty($price) && !empty($duration)){
			$html = sprintf( '<p>' . __( 'El precio del banner es de %s y le restan %s días para estar disponible.', 'bannersystem' ).'</p>', $price, $duration );
			return $html;
		}

		$html = "<div id='300x600_bannerSys' class='bannerSys' $this->_event_media_page>
			<a href='$mediapage'><img src='$mediapage_src' alt=''></a>
			</div>";
		if (isset($atts['url']) && isset($atts['src'])){
			$html = "<div id='300x600_bannerSys' class='bannerSys' $this->_event_media_page>
			<a href='{$atts['url']}'><img src='{$atts['src']}' alt=''></a>
			</div>";
			return $html;
		}
		return $html;
	}

	public function banner_system_medio_banner($atts = [])
	{
		$mediobanner_pay = get_option('banner_system_medio_banner_banner_url_pay');
		$mediobanner = (empty($mediobanner_pay)) ? $this->url_pay . 'banner_medio_banner=234x60' : $mediobanner_pay;
		$mediobanner_src = get_option('medio_banner_bannersystem');
		$mediobanner_src = (empty($this->mediobanner_src_pay)) ? $this->upload_url.$mediobanner_src : $this->upload_url.$this->mediobanner_src_pay;

		$price = $this->member_data["medio_banner_price"];
		$duration = bssmp_index_bannersystem()->banner_system_update_banner_days(false,false,'medio_banner');

		if (isset($atts['data']) && isset($this->_event_medio_banner) && !empty($price) && !empty($duration)){
			$html = sprintf( '<p>' . __( 'El precio del banner es de %s y le restan %s días para estar disponible.', 'bannersystem' ).'</p>', $price, $duration );
			return $html;
		}

		$html = "<div id='234x60_bannerSys' class='bannerSys' $this->_event_medio_banner>
			<a href='$mediobanner'><img src='$mediobanner_src' alt=''></a>
			</div>";
		if (isset($atts['url']) && isset($atts['src'])){
			$html = "<div id='234x60_bannerSys' class='bannerSys' $this->_event_medio_banner>
			<a href='{$atts['url']}'><img src='{$atts['src']}' alt=''></a>
			</div>";
			return $html;
		}
		return $html;
	}

	public function banner_system_movil_banner($atts = [])
	{
		$movilbanner_pay = get_option('banner_system_movil_banner_banner_url_pay');
		$movilbanner = (empty($movilbanner_pay)) ? $this->url_pay . 'banner_movil_banner=320x100' : $movilbanner_pay;
		$movilbanner_src = get_option('movil_banner_bannersystem');
		$movilbanner_src = (empty($this->movilbanner_src_pay)) ? $this->upload_url.$movilbanner_src : $this->upload_url.$this->movilbanner_src_pay;


		$price = $this->member_data["movil_banner_price"];
		$duration = bssmp_index_bannersystem()->banner_system_update_banner_days(false,false,'movil_banner');

		if (isset($atts['data']) && isset($this->_event_movil_banner) && !empty($price) && !empty($duration)){
			$html = sprintf( '<p>' . __( 'El precio del banner es de %s y le restan %s días para estar disponible.', 'bannersystem' ).'</p>', $price, $duration );
			return $html;
		}

		$html = "<div id='320x100_bannerSys' class='bannerSys' $this->_event_movil_banner>
			<a href='$movilbanner'><img src='$movilbanner_src' alt=''></a>
			</div>";
		if (isset($atts['url']) && isset($atts['src'])){
			$html = "<div id='320x100_bannerSys' class='bannerSys' $this->_event_movil_banner>
			<a href='{$atts['url']}'><img src='{$atts['src']}' alt=''></a>
			</div>";
			return $html;
		}
		return $html;
	}

	public function banner_system_payment()
	{

		$status_order_rec_medium = get_option('status_order_rec_medium');
		$status_order_leaderboard = get_option('status_order_leaderboard');
		$status_order_media_page = get_option('status_order_media_page');
		$status_order_medio_banner = get_option('status_order_medio_banner');
		$status_order_movil_banner = get_option('status_order_movil_banner');

		$test_flow = get_option('test-banner-system');

		$html = '';

		if(empty($test_flow)){
			$html .= __('No se ha configurado el medio de pago flow.','bannersystem');
		}

		if (empty($this->member_data)){
			$html .= __('No se han establecidos el precio y la duración de los banners.','bannersystem');
		}

		if (isset($_GET['banner_rec_medium']) && !isset($this->_event_medium) && empty($status_order_rec_medium)){
			$html .= "<div id='container_form_banner_system'><form id='form_user_banner_system'><input type='hidden' name='process' value='status_order_rec_medium'><label>" . __('Nombre','bannersystem') . "</label><input type='text' name='name_user_banner' required><label>" . __('Email','bannersystem') . "</label><input type='email' name='email_user_banner' required><button type='submit' class='submit_fom_user_banner'>" . __('Rentar','bannersystem') . "</button></form></div><div class='overlay-banner-system' style='display: none;'>
            <div class='overlay-content-banner-system'>
                <img src='".$this->upload_url . "assets/img/loading51.gif'"." alt=''>
                <div class='message'><strong></strong></div>
            </div>
        </div>";
		}elseif (isset($_GET['banner_rec_medium']) && isset($this->_event_medium) && empty($status_order_rec_medium)){
			$html .= __('Uff lo sentimos, este banner ya esta rentado','bannersystem');
		}elseif (isset($_GET['banner_rec_medium']) && !isset($this->_event_medium) && !empty($status_order_rec_medium)){
			$html .= __('Este banner se encuentra en proceso de solicitud. Verifica de nuevo en unos minutos, quizás no se haya tomado :)','bannersystem');
		}

		if (isset($_GET['banner_leaderboard']) && !isset($this->_event_leaderboard) && empty($status_order_leaderboard)){
			$html .= "<div id='container_form_banner_system'><form id='form_user_banner_system'><input type='hidden' name='process' value='status_order_leaderboard'><label>" . __('Nombre','bannersystem') . "</label><input type='text' name='name_user_banner' required><label>" . __('Email','bannersystem') . "</label><input type='email' name='email_user_banner' required><button type='submit' class='submit_fom_user_banner'>" . __('Rentar','bannersystem') . "</button></form></div><div class='overlay-banner-system' style='display: none;'>
            <div class='overlay-content-banner-system'>
                <img src='".$this->upload_url . "assets/img/loading51.gif'"." alt=''>
                <div class='message'><strong></strong></div>
            </div>
        </div>";
		}elseif (isset($_GET['banner_leaderboard']) && isset($this->_event_leaderboard) && empty($status_order_leaderboard)){
			$html .= __('Uff lo sentimos, este banner ya esta rentado','bannersystem');
		}elseif (isset($_GET['banner_leaderboard']) && !isset($this->_event_leaderboard) && !empty($status_order_leaderboard)){
			$html .= __('Este banner se encuentra en proceso de solicitud. Verifica de nuevo en unos minutos, quizás no se haya tomado :)','bannersystem');
		}

		if (isset($_GET['banner_media_page']) && !isset($this->_event_media_page) && empty($status_order_media_page)){
			$html .= "<div id='container_form_banner_system'><form id='form_user_banner_system'><input type='hidden' name='process' value='status_order_media_page'><label>" . __('Nombre','bannersystem') . "</label><input type='text' name='name_user_banner' required><label>" . __('Email','bannersystem') . "</label><input type='email' name='email_user_banner' required><button type='submit' class='submit_fom_user_banner'>" . __('Rentar','bannersystem') . "</button></form></div><div class='overlay-banner-system' style='display: none;'>
            <div class='overlay-content-banner-system'>
                <img src='".$this->upload_url . "assets/img/loading51.gif'"." alt=''>
                <div class='message'><strong></strong></div>
            </div>
        </div>";
		}elseif (isset($_GET['banner_media_page']) && isset($this->_event_media_page) && empty($status_order_media_page)){
			$html .= __('Uff lo sentimos, este banner ya esta rentado','bannersystem');
		}elseif (isset($_GET['banner_media_page']) && !isset($this->_event_media_page) && !empty($status_order_media_page)){
			$html .= __('Este banner se encuentra en proceso de solicitud. Verifica de nuevo en unos minutos, quizás no se haya tomado :)','bannersystem');
		}

		if (isset($_GET['banner_medio_banner']) && !isset($this->_event_medio_banner) && empty($status_order_medio_banner)){
			$html .= "<div id='container_form_banner_system'><form id='form_user_banner_system'><input type='hidden' name='process' value='status_order_medio_banner'><label>" . __('Nombre','bannersystem') . "</label><input type='text' name='name_user_banner' required><label>" . __('Email','bannersystem') . "</label><input type='email' name='email_user_banner' required><button type='submit' class='submit_fom_user_banner'>" . __('Rentar','bannersystem') . "</button></form></div><div class='overlay-banner-system' style='display: none;'>
            <div class='overlay-content-banner-system'>
                <img src='".$this->upload_url . "assets/img/loading51.gif'"." alt=''>
                <div class='message'><strong></strong></div>
            </div>
        </div>";
		}elseif (isset($_GET['banner_medio_banner']) && isset($this->_event_medio_banner) && empty($status_order_medio_banner)){
			$html .= __('Uff lo sentimos, este banner ya esta rentado','bannersystem');
		}elseif (isset($_GET['banner_medio_banner']) && !isset($this->_event_medio_banner) && !empty($status_order_medio_banner)){
			$html .= __('Este banner se encuentra en proceso de solicitud. Verifica de nuevo en unos minutos, quizás no se haya tomado :)','bannersystem');
		}

		if (isset($_GET['banner_movil_banner']) && !isset($this->_event_movil_banner) && empty($status_order_movil_banner)){
			$html .= "<div id='container_form_banner_system'><form id='form_user_banner_system'><input type='hidden' name='process' value='status_order_movil_banner'><label>" .__('Nombre','bannersystem') . "</label><input type='text' name='name_user_banner' required><label>" . __('Email','bannersystem') . "</label><input type='email' name='email_user_banner' required><button type='submit' class='submit_fom_user_banner'>" . __('Rentar','bannersystem') . "</button></form></div><div class='overlay-banner-system' style='display: none;'>
            <div class='overlay-content-banner-system'>
                <img src='".$this->upload_url . "assets/img/loading51.gif'"." alt=''>
                <div class='message'><strong></strong></div>
            </div>
        </div>";
		}elseif (isset($_GET['banner_movil_banner']) && isset($this->_event_movil_banner) && empty($status_order_movil_banner)){
			$html .= __('Uff lo sentimos, este banner ya esta rentado','bannersystem');
		}elseif (isset($_GET['banner_movil_banner']) && !isset($this->_event_movil_banner) && !empty($status_order_movil_banner)){
			$html .= __('Este banner se encuentra en proceso de solicitud. Verifica de nuevo en unos minutos, quizás no se haya tomado :)','bannersystem');
		}


		if(isset($_GET['flowcon']) && isset($_POST['response'])) {
			try {

				// Lee los datos enviados por Flow
				bssmp_index_bannersystem()->flowAPI->read_confirm();



			} catch (Exception $e) {
				// Si hay un error responde false
				$html .= bssmp_index_bannersystem()->flowAPI->build_response(false);

				return $html;
			}

		}

		if (isset($_GET['flowsu'])){
			try {
				// Lee los datos enviados por Flow
				bssmp_index_bannersystem()->flowAPI->read_result();

			} catch (Exception $e) {
				header($_SERVER['SERVER_PROTOCOL'] . ' 500 Ha ocurrido un error interno', true, 500);
			}
			$html .= bssmp_index_bannersystem()->flowAPI->updataConfirm(true);

		}
		return $html;
	}
}