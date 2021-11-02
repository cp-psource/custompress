<?php if ( !defined('ABSPATH') ) die('Kein direkter Zugriff erlaubt!'); ?>

<div class="wrap ct-wrap ct-content-types">

	<div class="icon32" id="icon-edit"><br></div>
	<h2>&nbsp;
		<a class="nav-tab <?php if ( isset( $_GET['ct_content_type'] ) && $_GET['ct_content_type'] == 'post_type' || !isset( $_GET['ct_content_type'] )) { echo( 'nav-tab-active' ); } ?>" href="<?php echo esc_attr('admin.php?page=ct_content_types&ct_content_type=post_type'); ?>"><?php esc_html_e('Beitragstypen', $this->text_domain); ?></a>
		<a class="nav-tab <?php if ( isset( $_GET['ct_content_type'] ) && $_GET['ct_content_type'] == 'taxonomy' ) { echo( 'nav-tab-active' ); } ?>" href="<?php echo esc_attr('admin.php?page=ct_content_types&ct_content_type=taxonomy'); ?>"><?php esc_html_e('Taxonomien', $this->text_domain); ?></a>
		<a class="nav-tab <?php if ( isset( $_GET['ct_content_type'] ) && $_GET['ct_content_type'] == 'custom_field' ) { echo( 'nav-tab-active' ); } ?>" href="<?php echo esc_attr('admin.php?page=ct_content_types&ct_content_type=custom_field'); ?>"><?php esc_html_e('Benutzerdefinierte Felder', $this->text_domain); ?></a>
		<a class="nav-tab <?php if ( isset( $_GET['ct_content_type'] ) && $_GET['ct_content_type'] == 'shortcodes' ) { echo( 'nav-tab-active' ); } ?>" href="<?php echo esc_attr('admin.php?page=ct_content_types&ct_content_type=shortcodes'); ?>"><?php esc_html_e('Shortcodes', $this->text_domain); ?></a>
	</h2>

</div>
