<?php
/**
 * Plugin Name: WCP Contact Form
 * Plugin URI: https://wordpress.org/plugins/wcp-contact-form/ 
 * Description: The contact form plugin with dynamic fields, CAPTCHA and other features that makes it easy to add custom contact form on your site in a few clicks
 * Version: 2.4.1
 * Author: Webcodin
 * Author URI: https://profiles.wordpress.org/webcodin/
 * License: GPL2
 * 
 * @package SCFP
 * @category Core
 * @author webcodin
 */
/*  Copyright 2015 Webcodin (email : info@webcodin.com)

    This program is free software; you can redistribute it and/or modify
    it under the terms of the GNU General Public License, version 2, as 
    published by the Free Software Foundation.

    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License
    along with this program; if not, write to the Free Software
    Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
*/

if ( !defined( 'SCFP_MIN_PHP_VERSION' ) ) {
    define( 'SCFP_MIN_PHP_VERSION', '5.3.0');    
}

if ( !defined( 'SCFP_CUR_PHP_VERSION' ) ) {
    if ( function_exists( 'phpversion' ) ) {
        define( 'SCFP_CUR_PHP_VERSION', phpversion() );        
    } else {
        define( 'SCFP_CUR_PHP_VERSION', SCFP_MIN_PHP_VERSION );        
    }
}


/**
 * Check for minimum required PHP version
 */
if ( function_exists( 'version_compare' ) && version_compare( SCFP_CUR_PHP_VERSION , SCFP_MIN_PHP_VERSION) == -1 ) {
    add_action( 'admin_notices', 'SCFP_PHPVersion_AdminNotice' , 0 );

/**
 * Initialize
 */    
} else {
    include_once (dirname(__FILE__) . '/wcp-contact-form-init.php' );    
}

function SCFP_PHPVersion_AdminNotice() {
    $name = get_file_data( __FILE__, array ( 'Plugin Name' ), 'plugin' );

    printf(
        '<div class="error">
            <p><strong>%s</strong> plugin can\'t work properly. Your current PHP version is <strong>%s</strong>. Minimum required PHP version is <strong>%s</strong>.</p>
        </div>',
        $name[0],
        SCFP_CUR_PHP_VERSION,
        SCFP_MIN_PHP_VERSION
    );
}