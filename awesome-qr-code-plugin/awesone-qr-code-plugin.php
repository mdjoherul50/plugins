<?php
/*
 * Plugin Name:       Awesome QR Code Plugin
 * Plugin URI:        https://example.com/plugins/the-basics/
 * Description:       Display a qr code for current page
 * Version:           1.0.0
 * Requires at least: 5.2
 * Requires PHP:      7.2
 * Author:            Md Jahirul Islam
 * Author URI:        https://author.example.com/
 * License:           GPL v2 or later
 * License URI:       https://www.gnu.org/licenses/gpl-2.0.html
 * Update URI:        https://example.com/my-plugin/
 * Text Domain:       my-basics-plugin
 * Domain Path:       /languages
 */


class AQC_QR_Code {

	private $color = 'FF00FF';
	private $size = 100;
	public function __construct() {
		add_action( 'init', array( $this, 'init' ) );
	}
	public function init() {
		add_filter( 'the_content', array( $this, 'add_qr_code' ),999 );
		$this->color = apply_filters( 'aqc_qr_code_color', $this->color );
		
	}
	public function add_qr_code( $content ) {
		// $current_link = esc_url( get_permalink() );
		// $title        = get_the_title();
		// $current_link = "<img src='https://chart.googleapis.com/chart?cht=qr&chl=$current_link&chs=120x120' alt='{$title}'>";
		// return $content . $current_link;
		$current_link = esc_url(get_permalink());
        $title = get_the_title();
        $custom_content = '<div style="border: 1px solid #ddd; padding: 10px; margin: 20px 0;">';
        // $custom_content .= '<img src="https://chart.googleapis.com/chart?chs=150x150&cht=qr&chl=' . $current_link . '" alt="'.$title.'" />';
        // $custom_content .="<img src='https://chart.googleapis.com/chart?chs=150x150&cht=qr&chl={$current_link}' alt='{$title}' />";
        $custom_content .="<img src='https://api.qrserver.com/v1/create-qr-code/?color={$this->color}&size={$this->size}x{$this->size}&data={$current_link}' alt='{$title}' />";
        $custom_content .= '</div>';
        
        $content .= $custom_content;
        return $content;
	}
	
}
new AQC_QR_Code();

//this code have to add theme function

// add_filter('aqc_qr_code_color', 'change_qr_code_color');

// function change_qr_code_color($color){
	
// 	return 'EE0041';
// }




// <!-- class AQC_Qr_Code{

// add init
// public function __construct(){
// add_action('init',array($this,'init'));
// }
// public function init(){
// add_filter('the_content',array($this,'add_qr_code'))
// }
// } -->

