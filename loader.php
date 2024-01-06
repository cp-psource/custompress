<?php
/*
Plugin Name: CustomPress
Plugin URI: https://n3rds.work/piestingtal_source/psource-custompress-plugin/
Description: CustomPress - Benutzerdefinierter Post-, Taxonomie- und Feldmanager.
Version: 1.4.2
Author: WMS N@W
Author URI: https://n3rds.work
Text Domain: custompress
Domain Path: languages
License: GNU General Public License (Version 2 - GPLv2)
Network: false
*/
require 'psource/psource-plugin-update/psource-plugin-updater.php';
use Psource\PluginUpdateChecker\v5\PucFactory;
$MyUpdateChecker = PucFactory::buildUpdateChecker(
	'https://n3rds.work//wp-update-server/?action=get_metadata&slug=custompress', 
	__FILE__, 
	'custompress' 
);

$plugin_header_translate = array(
__('CustomPress - Benutzerdefinierter Post-, Taxonomie- und Feldmanager.', 'custompress'),
__('DerN3rd (WMS N@W)', 'custompress'),
__('https://n3rds.work', 'custompress'),
__('CustomPress', 'custompress'));

/*
Copyright 2020 WMS N@W, (https://n3rds.work)

This program is free software; you can redistribute it and/or modify
it under the terms of the GNU General Public License (Version 2 - GPLv2) as published by
the Free Software Foundation.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with this program; if not, write to the Free Software
Foundation, Inc., 59 Temple Place, Suite 330, Boston, MA  02111-1307  USA
*/


/* Define plugin version */
if( !defined('CPT_VERSION') ) define ( 'CPT_VERSION', '1.4.2' );
/* define the plugin folder url */
if( !defined('CPT_PLUGIN_URL') ) define ( 'CPT_PLUGIN_URL', plugin_dir_url(__FILE__) );
/* define the plugin folder dir */
if( !defined('CPT_PLUGIN_DIR') ) define ( 'CPT_PLUGIN_DIR', plugin_dir_path(__FILE__) );
/* define the text domain for CustomPress */
if( !defined('CPT_TEXT_DOMAIN') ) define ( 'CPT_TEXT_DOMAIN', 'custompress' );

//define('CT_ALLOW_IMPORT', true);


/* include CustomPress files */
include_once 'core/core.php';
include_once 'core/content-types.php';
include_once 'core/functions.php';

if ( is_admin() ) include_once 'core/admin.php';


