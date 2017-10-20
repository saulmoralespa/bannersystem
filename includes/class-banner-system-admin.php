<?php
/**
 * Created by PhpStorm.
 * User: smp
 * Date: 25/08/17
 * Time: 12:09 PM
 */

class BSSMP_Banner_System_Admin
{
	public function __construct()
	{
		$this->name = bssmp_index_bannersystem()->name;
		$this->plugin_url = bssmp_index_bannersystem()->plugin_url;
		$this->version = bssmp_index_bannersystem()->version;
		add_action('admin_init', array($this, 'add_menu_banner_system'));
		add_action('admin_menu', array($this, 'loadMenuBannerSystem'));
		add_action('wp_ajax_create_pages_banner_sys',array($this,'banner_system_create_pages'));
		add_action('wp_ajax_bannersystem',array($this,'banner_system_ajax'));
	}

	public function add_menu_banner_system()
	{
		$role = get_role( 'user_banner' );
		$role->add_cap( 'cap_user_banner_system' );

	}

	public function loadMenuBannerSystem()
	{
		$configuracion = bssmp_index_bannersystem()->AdminConfiguration;
		$banners = bssmp_index_bannersystem()->bannersAdmin;
		$flow = bssmp_index_bannersystem()->flowAdmin;
		$member = bssmp_index_bannersystem()->memberAdmin;
		$help = bssmp_index_bannersystem()->helpAdmin;
		$menuUserRole = bssmp_index_bannersystem()->memberRole;
	    add_menu_page($this->name, $this->name, 'manage_options', 'menus'. $this->name, array($this,'menu'. $this->name), $this->plugin_url .'icon.png');
	    add_menu_page(__('Banners','bannersystem'), __('Banners','bannersystem'),'cap_user_banner_system','cap_user_'. $this->name, array($menuUserRole,'menu_user_role__banner_system'),$this->plugin_url .'icon.png');
		$config = add_submenu_page('menus' . $this->name, 'Configuración', 'Configuración', 'manage_options', 'config-' . $this->name,array($configuracion,'configInit'));
		$configBanners = add_submenu_page('menus' . $this->name, 'Banners', 'Banners', 'manage_options', 'configbanners-' . $this->name,array($banners,'configInit'));
		$configFlow = add_submenu_page('menus' . $this->name, 'Flow', 'Flow', 'manage_options', 'configflow-' . $this->name,array($flow,'configInit'));
		$configMember = add_submenu_page('menus' . $this->name, 'Membresia', 'Membresia', 'manage_options', 'configmember-' . $this->name,array($member,'configInit'));
		$configHelp = add_submenu_page('menus' . $this->name, 'Ayuda', 'Ayuda', 'manage_options', 'confighelp-' . $this->name,array($help,'configInit'));
		remove_submenu_page('menus'. $this->name, 'menus'.$this->name);
		add_action('admin_head', array($this,'head_menu'));
		add_action('admin_footer', array($this,'footer_menu'));
	}
	public function head_menu()
	{
		wp_enqueue_style('admin_css-banner-system', $this->plugin_url."assets/css/banner-system.css", array(), $this->version, null);
	}
	public function footer_menu()
	{
		wp_enqueue_script('admin_js-banner-system', $this->plugin_url."assets/js/config.js", array('jquery'), $this->version, true);
	}
	public function banner_system_create_pages()
	{
		if(isset($_POST['createpages']) && $_POST['createpages'] == 'all'){
			$idpayment = wp_insert_post( array(
				'post_title'     => __('Pago sistema de banners','bannersystem'),
				'post_type'      => 'page',
				'comment_status' => 'closed',
				'ping_status'    => 'closed',
				'post_content'   => '[banner_system_payment]',
				'post_status'    => 'publish',
				'post_author'    => 1
			) );
			$idbannersystem = wp_insert_post( array(
				'post_title'     => __('Sistema de banners','bannersystem'),
				'post_type'      => 'page',
				'comment_status' => 'closed',
				'ping_status'    => 'closed',
				'post_content'   => '[banner_system]',
				'post_status'    => 'publish',
				'post_author'    => 1
			) );
		}elseif (isset($_POST['createpages']) && $_POST['createpages'] == 'pay'){
			$idpayment = wp_insert_post( array(
				'post_title'     => __('Pago sistema de banners','bannersystem'),
				'post_type'      => 'page',
				'comment_status' => 'closed',
				'ping_status'    => 'closed',
				'post_content'   => '[banner_system_payment]',
				'post_status'    => 'publish',
				'post_author'    => 1
			) );

		}elseif (isset($_POST['createpages']) && $_POST['createpages'] == 'banners'){
			$idbannersystem = wp_insert_post( array(
				'post_title'     => __('Sistema de banners','bannersystem'),
				'post_type'      => 'page',
				'comment_status' => 'closed',
				'ping_status'    => 'closed',
				'post_content'   => '[banner_system]',
				'post_status'    => 'publish',
				'post_author'    => 1
			) );

		}
		if (isset($idbannersystem) && isset($idpayment)){
			echo json_encode(array('status' => true));
		}elseif (isset($idbannersystem)){
			echo json_encode(array('status' => true));
		}elseif (isset($idpayment)){
			echo json_encode(array('status' => true));
		}
		die();
	}
	public function banner_system_ajax()
	{
		if (isset($_FILES)){
			$upload_dir = wp_upload_dir();
			$dir = $upload_dir['basedir'] . '/bannersystem/';
			if(!is_dir($dir)){
				bssmp_index_bannersystem()->createDirUploads($dir);
			}
		}

		if (isset($_FILES) && !isset($_POST['test-banner-system'])){

			$key = '';

			foreach ($_FILES as $FILE => $value){
				$key .= $FILE;
			}

			if(!empty($_FILES[$key]['name'])) {

				// Setup the array of supported file types. In this case, it's just PDF.
				$supported_jpg = array('image/jpeg','image/gif','image/png');

				// Get the file type of the upload
				$arr_file_type = wp_check_filetype(basename($_FILES[$key]['name']));
				$uploaded_type = $arr_file_type['type'];

				// Check if the type is supported. If not, throw an error.
				if(in_array($uploaded_type, $supported_jpg)) {

					$file = $_FILES[$key];
					$this->_uploadImg($file,$key);

				}else {
					wp_die(__("The file type that you've uploaded is not a html.","form-print-pay"));
				} // end if/else

			}

		}

		if (isset($_POST['test-banner-system']) && isset($_FILES)){

			unset($_POST['action']);
			foreach ($_POST as $name => $valop){
				update_option($name,$valop);
			}
			$key = '';
			foreach ($_FILES as $FILE => $value){
				$key .= $FILE;
			}

			if (!empty($_FILES[$key]['name'])){
				$file = $_FILES[$key];
				$this->_uploadImg($file,$key,true);
			}

		}

		if ($_POST['text_name_banner']){
			unset($_POST['action']);
			$idpage = $_POST['idpost'];
			unset($_POST['idpost']);

			$pricebanner = array();
			$duractiobanner = array();
			foreach ($_POST['text_name_banner'] as $keyname => $valuename){
				$pricebanner[$valuename."_price"] = null;
			}
			foreach ($_POST['text_name_banner'] as $keyname => $valuename){
				$duractiobanner[$valuename."_duration"] = null;
			}

			foreach ($_POST['text_price_banner'] as $keyprice => $valprice){

				if (!isset($pricebanner["rec_medium_price"])){
					$pricebanner["rec_medium_price"] = $valprice;
					continue;
				}
				if (!isset($pricebanner["leaderboard_price"])){
					$pricebanner["leaderboard_price"] = $valprice;
					continue;
				}
				if (!isset($pricebanner["media_page_price"])){
					$pricebanner["media_page_price"] = $valprice;
					continue;
				}
				if (!isset($pricebanner["medio_banner_price"])){
					$pricebanner["medio_banner_price"] = $valprice;
					continue;
				}
				if (!isset($pricebanner["movil_banner_price"])){
					$pricebanner["movil_banner_price"] = $valprice;
					continue;
				}
			}

			foreach ($_POST['duration_banner'] as $duractioname => $valduration ) {
				if (!isset($duractiobanner["rec_medium_duration"])){
					$duractiobanner["rec_medium_duration"] = $valduration;
					continue;
				}
				if (!isset($duractiobanner["leaderboard_duration"])){
					$duractiobanner["leaderboard_duration"] = $valduration;
					continue;
				}
				if (!isset($duractiobanner["media_page_duration"])){
					$duractiobanner["media_page_duration"] = $valduration;
					continue;
				}
				if (!isset($duractiobanner["medio_banner_duration"])){
					$duractiobanner["medio_banner_duration"] = $valduration;
					continue;
				}
				if (!isset($duractiobanner["movil_banner_duration"])){
					$duractiobanner["movil_banner_duration"] = $valduration;
					continue;
				}
			}

			$array = array_merge($pricebanner,$duractiobanner);
			update_post_meta($idpage,'member_banner_system',$array);
		}

		if ($_POST['member_role']){
			unset($_POST['action']);
			unset($_POST['member_role']);
			foreach ($_POST as $key => $value){
				update_option($key,$value);
			}
		}

		if (isset($_POST['resetbanner'])){
			bssmp_index_bannersystem()->banner_system_update_banner_days(false,true);
		}

		die();
	}

	private function _uploadImg($file,$key,$pem = false)
	{
		$upload_dir = wp_upload_dir();
		$dir = $upload_dir['basedir'] . '/bannersystem/';
		$pathImg = $dir . "img/";
		$pathKeys = $dir . "flow/";
		if (!is_writable($dir)){
			$array = array('status' => false, 'message' => 'Se necesitan permisos de escritura');
			die(json_encode($array));
		}
		if ($pem){
			$ext = 'txt';
			$objFile = $pathKeys . "$key.$ext";
			$file_up = $pathKeys . "{$key}_tmp.$ext";
			$saveOption = "$key.$ext";
			move_uploaded_file($file['tmp_name'],$file_up);
			$filetmp = $file_up;
			$file_up = "$key.$ext";
		}else{
			$file_up = $file['name'];
			$ext = pathinfo($file['name'], PATHINFO_EXTENSION);
			$objFile  = $pathImg . "$key.$ext";
			$saveOption = "$key.$ext";
			$filetmp = $file['tmp_name'];

		}
		// Use the WordPress API to upload the file
		$upload = wp_upload_bits($file_up, null, file_get_contents($filetmp));
			if(rename($upload['file'],$objFile)===true && file_exists($objFile)){
				unlink($filetmp);
				update_option($key,$saveOption);
				$array = array('status' => true);
				die(json_encode($array));
			}else{
				$array = array('status' => false, 'message' => "No se ha podido subir intente de nuevo");
				die(json_encode($array));
			}
	}
}