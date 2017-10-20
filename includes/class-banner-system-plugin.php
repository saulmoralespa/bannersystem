<?php
/**
 * Created by PhpStorm.
 * User: smp
 * Date: 25/08/17
 * Time: 10:36 AM
 */
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}
class BSSMP_Banner_System_Plugin
{
	/**
	 * @var string
	 */
	public $file;

	/**
	 * @var string
	 */
	public $version;

	/**
	 * @var string
	 */
	public $name;

	/**
	 * @var string
	 */
	public $plugin_path;

	/**
	 * @var string
	 */
	public $plugin_url;

	/**
	 * @var string
	 */
	public $includes_path;

	/**
	 * @var bool
	 */
	private $_bootstrapped = false;

	/**
	 * @var
	 */
	public $settings;

	public function __construct($file, $version, $name)
	{

		$this->file = $file;
		$this->version = $version;
		$this->name = $name;

		// Path.
		$this->plugin_path   = trailingslashit( plugin_dir_path( $this->file ) );
		$this->plugin_url    = trailingslashit( plugin_dir_url( $this->file ) );
		$this->includes_path = $this->plugin_path . trailingslashit( 'includes' );
		if (current_user_can('cap_user_banner_system') && is_user_logged_in() && is_plugin_active( 'woocommerce/woocommerce.php' )) {
			add_filter( 'woocommerce_prevent_admin_access', '__return_false' );
			add_filter( 'woocommerce_disable_admin_bar', '__return_false' );
		}
		add_filter( 'plugin_action_links_' . plugin_basename( $this->file ), array( $this, 'plugin_action_links' ) );
		add_filter( 'login_redirect', array($this,'dashboard_redirect_banner_system' ),10,3);
		add_action( 'wp_enqueue_scripts', array( $this, 'enqueue_scripts' ) );
		add_action('wp_ajax_form_banner_system',array($this,'form_frontend_banner_system'));
		add_action('wp_ajax_nopriv_form_banner_system',array($this,'form_frontend_banner_system'));
		add_action('wp_ajax_register_click_banner_system',array($this,'register_click_banner_system'));
		add_action('wp_ajax_nopriv_register_click_banner_system',array($this,'register_click_banner_system'));
		add_action('bssmp_user_banner_days',array($this, 'banner_system_update_banner_days'));
	}

	public function banner_run()
	{
		try{
			if ($this->_bootstrapped){
				throw new Exception( __( 'Banner System can only be called once', 'bannersystem' ));
			}
			$this->_run();
			$this->_bootstrapped = true;
		}catch (Exception $e){
			if ( is_admin() && ! defined( 'DOING_AJAX' ) ) {
				do_action('notices_action_tag_banner', $e->getMessage());
			}
		}
	}

	protected function _run()
	{
		$this->_load_handlers();
	}
	protected function _load_handlers()
	{
		require_once ($this->includes_path . 'class-banner-system-admin.php');
		require_once ($this->includes_path . 'class-banner-system-admin-configuration.php');
		require_once ($this->includes_path . 'class-banner-system-admin-banners.php');
		require_once ($this->includes_path . 'class-banner-system-admin-flow.php');
		require_once ($this->includes_path . 'class-banner-system-admin-member.php');
		require_once ($this->includes_path . 'class-banner-system-admin-member-role.php');
		require_once ($this->includes_path . 'class-banner-system-admin-help.php');
		require_once ($this->includes_path . 'class-banner-system-admin-tabs.php');
		require_once ($this->includes_path . 'class-banner-system-shortcodes.php');
		require_once ($this->includes_path . 'flow/kpf/flowAPI.php');
		$this->Admin = new BSSMP_Banner_System_Admin();
		$this->AdminConfiguration = new BSSMP_Banner_System_Admin_Configuration();
		$this->bannersAdmin = new BSSMP_Banner_System_Admin_Banners();
		$this->flowAdmin = new BSSMP_Banner_System_Admin_Flow();
		$this->memberAdmin = new BSSMP_Banner_System_Admin_Member();
		$this->memberRole = new BSSMP_Banner_System_Admin_Menu_Role();
		$this->helpAdmin = new BSSMP_Banner_System_Admin_Help();
		$this->tabsMenu = new BSSMP_Banner_System_Admin_Tabs();
		$this->banners = new BSSMP_Banner_System_shortcodes();
		$this->flowAPI = new flowAPI();

	}

	public function plugin_action_links($links)
	{
		$plugin_links = array();

		$plugin_links[] = '<a href="'.admin_url('admin.php?page=config-Banner+System').'">' . esc_html__( 'Ajustes', 'bannersystem' ) . '</a>';
		return array_merge( $plugin_links, $links );
	}

	public function dashboard_redirect_banner_system($url, $request, $user)
	{

		if( $user && is_object( $user ) && is_a( $user, 'WP_User' ) ) {
			if( $user->has_cap( 'cap_user_banner_system' ) ) {
				add_filter( 'woocommerce_prevent_admin_access', '__return_false' );
				$url = admin_url('admin.php?page=cap_user_Banner+System');
			}
		}
		return $url;
	}

	public function enqueue_scripts()
	{
		wp_enqueue_style('css-banner-system', $this->plugin_url."assets/css/banner-system.css", array(), $this->version, null);
		wp_enqueue_script('frontend-banner-system',$this->plugin_url . 'assets/js/frontend-banner-system.js', array( 'jquery' ), $this->version, true);
		wp_localize_script('frontend-banner-system','banner_system', array(
			'ajaxurl' => admin_url( 'admin-ajax.php' ),
			'before_flow' => __('Generando orden...','bannersystem'),
			'flow_message' => __('Redireccionando a Flow...','bannersystem')
		));
	}

	public function form_frontend_banner_system()
	{
		if (isset($_POST['email_user_banner'])){

			$password = null;

			$email = $_POST['email_user_banner'];
			$user = get_user_by( 'email', $email );

		if ( !empty( $user ) ) {
			$id = $user->ID;
			if ( !in_array( 'user_banner', $user->roles ) ) {
				$u = new WP_User( $user->ID );
				$u->add_role( 'user_banner' );
			}
		}else{
			$password = wp_generate_password( 12, true );
			$id = wp_create_user ( $email, $password, $email );

			if(!is_wp_error($id)){
				wp_insert_user(array(
					'ID'       => $id,
					'nickname' => $email
				));
				$user = new WP_User( $id );
				$user->set_role( 'user_banner' );
			}else{
				return json_encode(array('status' => false, 'message' => __('not_register_user','bannersystem') ));
			}

		}
		if (isset($id)){

			$iduser = $id;

			$isshop = (string)mt_rand($iduser,99999);

			$keybanner = str_replace('status_order_','',$_POST['process']);

			$orden_compra = "$keybanner N° $isshop-$iduser";

			$concepto = "Banner $keybanner";

			$page = get_page_by_title(__('Pago sistema de banners','bannersystem'));
			$databanner = get_post_meta($page->ID,'member_banner_system', true);

			$durationBanner = $keybanner."_duration";
			$price = $keybanner."_price";

			$monto = $databanner[$price];

			$dias = $databanner[$durationBanner];

			$register = date('d-m-Y');
			$mod_date = strtotime($register."+ $dias days");
			$endregister = date("d-m-Y",$mod_date);

			update_post_meta($iduser,'order_banner_system', array($_POST['process'] => array('name' => $_POST['name_user_banner'], 'email' => $email, 'password' => $password, 'endregister' => $endregister)));
			update_option($_POST['process'],$iduser);

			$flow = bssmp_index_bannersystem()->flowAPI->new_order($orden_compra, $monto, $concepto, $email);

			die(wp_json_encode($flow));

		}
		}
		die();
	}


	public function register_click_banner_system()
	{

		if($_POST['banner_click'] == 'rec_medium'){

			$this->UpdateClick($_POST['banner_click'],true,true);
		}
		if($_POST['banner_click'] == 'leaderboard'){

			$this->UpdateClick($_POST['banner_click'],true,true);
		}
		if($_POST['banner_click'] == 'media_page'){

			$this->UpdateClick($_POST['banner_click'],true,true);
		}
		if($_POST['banner_click'] == 'medio_banner'){

			$this->UpdateClick($_POST['banner_click'],true,true);
		}
		if($_POST['banner_click'] == 'movil_banner'){

			$this->UpdateClick($_POST['banner_click'],true,true);
		}

		die();
	}

	public function compararFechas($primera, $segunda)
	{
		$valoresPrimera = explode ("-", $primera);
		$valoresSegunda = explode ("-", $segunda);

		$diaPrimera    = $valoresPrimera[0];
		$mesPrimera  = $valoresPrimera[1];
		$anyoPrimera   = $valoresPrimera[2];

		$diaSegunda   = $valoresSegunda[0];
		$mesSegunda = $valoresSegunda[1];
		$anyoSegunda  = $valoresSegunda[2];

		$diasPrimeraJuliano = gregoriantojd($mesPrimera, $diaPrimera, $anyoPrimera);
		$diasSegundaJuliano = gregoriantojd($mesSegunda, $diaSegunda, $anyoSegunda);

		if(!checkdate($mesPrimera, $diaPrimera, $anyoPrimera)){
			// "La fecha ".$primera." no es v&aacute;lida";
			return 0;
		}elseif(!checkdate($mesSegunda, $diaSegunda, $anyoSegunda)){
			// "La fecha ".$segunda." no es v&aacute;lida";
			return 0;
		}else{
			return $diasPrimeraJuliano - $diasSegundaJuliano;
		}

	}

	public function banner_system_update_banner_days($admin = false, $reset = false, $front = null)
	{
		$users = get_users('role=user_banner');
		$dataBanner = '';
		$date = date('d-m-Y');
		foreach( $users as $user ) {

				$meta = get_post_meta($user->ID,'order_banner_system',true);
				if(isset($meta['status_order_rec_medium'])){
					$endregister = $meta['status_order_rec_medium']['endregister'];
					$dia = bssmp_index_bannersystem()->compararFechas($endregister,$date);
					if (isset($front) && $front == 'rec_medium'){
						return $dia;
					}
					$opt = "bssmp_rec_medium_bannersystem";
					$clicks = empty(get_option($opt)) ? 0 : get_option($opt);
					if ($dia == 0 || $reset){
						delete_option('banner_system_rec_medium_banner_url_pay');
						delete_option('banner_system_rec_medium_banner_src_pay');
						update_post_meta($user->ID,'order_banner_system',array('status_order_rec_medium' => null));
						$this->UpdateClick('rec_medium');
					}else{
						$dataBanner .= sprintf( '<p>' . __( 'Banner 300x250 le quedan %s días y ha recibido %s clicks', 'bannersystem' ).'</p>', $dia, $clicks );
					}
				}

				if (isset($meta['status_order_leaderboard'])){
					$endregister = $meta['status_order_leaderboard']['endregister'];
					$dia = bssmp_index_bannersystem()->compararFechas($endregister,$date);
					if (isset($front) && $front == 'leaderboard'){
						return $dia;
					}
					$opt = "bssmp_leaderboard_bannersystem";
					$clicks = empty(get_option($opt)) ? 0 : get_option($opt);
					if ($dia == 0 || $reset){
						delete_option('banner_system_leaderboard_banner_url_pay');
						delete_option('banner_system_leaderboard_banner_src_pay');
						update_post_meta($user->ID,'order_banner_system',array('status_order_leaderboard' => null));
						$this->UpdateClick('leaderboard');
					}else{
						$dataBanner .= sprintf( '<p>' . __( 'Banner 728x90 le quedan %s días y ha recibido %s clicks', 'bannersystem' ).'</p>', $dia, $clicks );
					}
				}

				if (isset($meta['status_order_media_page'])){
					$endregister = $meta['status_order_media_page']['endregister'];
					$dia = bssmp_index_bannersystem()->compararFechas($endregister,$date);
					if (isset($front) && $front == 'media_page'){
						return $dia;
					}
					$opt = "bssmp_media_page_bannersystem";
					$clicks = empty(get_option($opt)) ? 0 : get_option($opt);
					if ($dia == 0 || $reset){
						delete_option('banner_system_media_page_banner_url_pay');
						delete_option('banner_system_media_page_banner_src_pay');
						update_post_meta($user->ID,'order_banner_system',array('status_order_media_page' => null));
						$this->UpdateClick('media_page');
					}else{
						$dataBanner .= sprintf( '<p>' . __( 'Banner 300x600 le quedan %s días y ha recibido %s clicks', 'bannersystem' ).'</p>', $dia, $clicks );
					}
				}

				if (isset($meta['status_order_medio_banner'])){
					$endregister = $meta['status_order_medio_banner']['endregister'];
					$dia = bssmp_index_bannersystem()->compararFechas($endregister,$date);
					if (isset($front) && $front == 'medio_banner'){
						return $dia;
					}
					$opt = "bssmp_medio_banner_bannersystem";
					$clicks = empty(get_option($opt)) ? 0 : get_option($opt);
					if ($dia == 0 || $reset){
						delete_option('banner_system_medio_banner_banner_url_pay');
						delete_option('banner_system_medio_banner_banner_src_pay');
						update_post_meta($user->ID,'order_banner_system',array('status_order_medio_banner' => null));
						$this->UpdateClick('medio_banner');
					}else{
						$dataBanner .= sprintf( '<p>' . __( 'Banner 234x60 le quedan %s días y ha recibido %s clicks', 'bannersystem' ).'</p>', $dia, $clicks );
					}
				}

				if (isset($meta['status_order_movil_banner'])){
					$endregister = $meta['status_order_movil_banner']['endregister'];
					$dia = bssmp_index_bannersystem()->compararFechas($endregister,$date);
					if (isset($front) && $front == 'movil_banner'){
						return $dia;
					}
					$opt = "bssmp_movil_banner_bannersystem";
					$clicks = empty(get_option($opt)) ? 0 : get_option($opt);
					if ($dia == 0 || $reset){
						delete_option('banner_system_movil_banner_banner_url_pay');
						delete_option('banner_system_movil_banner_banner_src_pay');
						update_post_meta($user->ID,'order_banner_system',array('status_order_movil_banner' => null));
						$this->UpdateClick('movil_banner');
					}else{
						$dataBanner .= sprintf( '<p>' . __( 'Banner 320x100 le quedan %s días y ha recibido %s clicks', 'bannersystem' ).'</p>', $dia, $clicks );
					}
				}

		}

		if ($admin){
			return $dataBanner;
		}

	}

	public function UpdateClick($opt, $click = false, $increase = false)
	{

		$count = '';
		$opt = "bssmp_$opt"."_bannersystem";
		$clicks = empty(get_option($opt)) ? false : get_option($opt);


		if ($click && $increase){

			if ($clicks === false && $increase) {
				$count = 1;
			}
			if ($clicks !== false && $increase){
				$count = $clicks + 1;
			}

		}

		update_option($opt,$count);

	}

	public function createDirUploads($dir)
	{
		mkdir($dir,0755);
		mkdir($dir . 'img',0755);
		mkdir($dir . 'flow',0755);
	}

}