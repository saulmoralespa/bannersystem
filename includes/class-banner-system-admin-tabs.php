<?php
/**
 * Created by PhpStorm.
 * User: smp
 * Date: 25/08/17
 * Time: 10:46 PM
 */

class ECPT_Banner_System_Admin_Tabs
{
	public function page()
	{

		if ($_GET['page'] == "config-Banner System") {
			$this->tab = 'general';
		}elseif ($_GET['page'] == "configbanners-Banner System") {
			$this->tab = 'banners';
		}elseif($_GET['page'] == "configflow-Banner System") {
			$this->tab = 'flow';
		}elseif($_GET['page'] == "configmember-Banner System") {
			$this->tab = 'member';
		}elseif($_GET['page'] == "confighelp-Banner System") {
			$this->tab = 'ayuda';
		}

		$this->page_tabs($this->tab);

		if($this->tab == 'general' ) {
			$config = ecpt_bansystem()->AdminConfiguration;
			$config->content();
		}

		if($this->tab == 'banners') {
			$paypal = ecpt_bansystem()->bannersAdmin;
			$paypal->content();
		}
		if ($this->tab == 'flow') {
			$email = ecpt_bansystem()->flowAdmin;
			$email->content();
		}
		if ($this->tab == 'member') {
			$email = ecpt_bansystem()->memberAdmin;
			$email->content();
		}
		if ($this->tab == 'ayuda') {
			$pdf = ecpt_bansystem()->helpAdmin;
			$pdf->content();

		}
	}

	public function page_tabs($current = 'general')
	{
		$name = ecpt_bansystem()->name;
		$tabs = array(
			'general'   => array('config-' . $name, __("General", 'bannersystem')),
			'banners'  => array('configbanners-' . $name, __("Banners", 'bannersystem')),
			'flow'  => array('configflow-' . $name, __("Flow", 'bannersystem')),
			'member'  => array('configmember-' . $name, __("Membresia", 'bannersystem')),
			'ayuda'  => array('confighelp-' . $name, __("Ayuda", 'bannersystem')),
		);
		$html =  '<h2 class="nav-tab-wrapper">';
		foreach( $tabs as $tab => $name ){
			$class = ($tab == $current) ? 'nav-tab-active' : '';
			$html .=  '<a class="nav-tab ' . $class . '" href="?page='.$name[0].'&tab=' . $tab . '">' . $name[1] . '</a>';
		}
		$html .= '</h2>';
		echo $html;
	}
}