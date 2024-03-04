<?php if (!defined('ABSPATH')) die('Kein direkter Zugriff erlaubt!'); ?>

<?php
$enable_subsite_content_types = get_site_option('allow_per_site_content_types');
$display_network_content_types   = get_site_option('display_network_content_types') == 1;

if ( is_network_admin() )
$post_types = get_site_option('ct_custom_post_types');
else
$post_types = $this->post_types;

wp_enqueue_style('jquery-ui-datepicker');
wp_enqueue_script('jquery-ui-datepicker');
wp_enqueue_script('jquery-ui-datepicker-lang');

if ( $enable_subsite_content_types && $display_network_content_types )
$network_post_types = get_site_option('ct_custom_post_types');

$options = $this->get_options();

//Get or initialize post type display
$cp_post_type = empty($options['display_post_types']) ?
	array(
		'home' => array('post_type' => array()),
		'front_page' => array('post_type' => array() ),
		'archive' => array('post_type' => array() ),
		'search' => array('post_type' => array() )
	)
	: $options['display_post_types'];
	// Define $date_format if it's not defined
	$date_format = !empty($options['date_format']) ? $options['date_format'] : 'mm/dd/yy';
?>

<div class="wrap">
	<h2><?php echo sprintf(__('CustomPress-Einstellungen %s', $this->text_domain), CPT_VERSION);?></h2>

	<?php $this->render_admin('message'); ?>

	<form action="#" method="post" class="cp-main">

		<?php if ( is_multisite() && is_super_admin() && is_network_admin() ): ?>
		<h3><?php esc_html_e( 'Allgemein', $this->text_domain );  ?></h3>
		<table class="form-table">
			<tr>
				<th>
					<label for="enable_subsite_content_types"><?php esc_html_e('Aktiviere Inhaltstypen für Unterwebseiten.', $this->text_domain) ?></label>
				</th>
				<td>
					<input type="checkbox" id="enable_subsite_content_types" name="enable_subsite_content_types" value="1" <?php checked( ! empty( $enable_subsite_content_types )); ?>  />
					<span class="description"><?php esc_html_e('Wenn Du diese Option aktivierst, können Unterseiten in Deinem Netzwerk ihre eigenen Inhaltstypen definieren. Wenn diese Option nicht aktiviert ist (Standard), müssen alle Webseiten in Deinem Netzwerk die von Dir, dem Superadministrator, definierten netzwerkweiten Inhaltstypen verwenden.', $this->text_domain); ?></span>
					<br /><br />
					<input type="checkbox" id="display_network_content_types" name="display_network_content_types" value="1" <?php checked( ! empty( $display_network_content_types )); ?>  />
					<span class="description"><?php esc_html_e('Wenn Du diese Option aktivierst, verwenden alle Unterwebsites die auf Netzwerkebene definierten Inhaltstypen und zeigen sie an. ', $this->text_domain); ?></span>
					<br /><br />

					<!--
					<input type="radio" name="display_network_content_types" value="1" <?php checked(empty( $display_network_content_types ), false ); ?> />
					<span class="description"><?php esc_html_e('Zeige die netzwerkweiten Inhaltstypen auf Unterseiten an.', $this->text_domain); ?></span>
					<br />
					<input type="radio" name="display_network_content_types" value="0" <?php checked( empty($display_network_content_types ), true ); ?> />
					<span class="description"><?php esc_html_e('Zeige die netzwerkweiten Inhaltstypen nicht auf Unterseiten an.', $this->text_domain); ?></span>
					-->
				</td>
			</tr>
		</table>
		<?php endif; ?>


		<?php if ( is_admin() && !is_network_admin() ): ?>
		<h3><?php esc_html_e( 'Beitragstypen', $this->text_domain ); ?></h3>
		<table class="form-table">
			<tr>
				<th>
					<label><?php esc_html_e('Zeige auf der Seite "Blog/Home" die folgenden Beitragstypen an: ', $this->text_domain) ?></label>
				</th>
				<td>
					<input type="checkbox" name="cp_post_type[home][]" value="post" <?php checked(is_array($cp_post_type['home']['post_type']) && in_array('post',$cp_post_type['home']['post_type'])); ?> />
					<span class="description"><strong>post</strong></span>
					<br />
					<input type="checkbox" name="cp_post_type[home][]" value="page" <?php checked(is_array($cp_post_type['home']['post_type']) && in_array('page',$cp_post_type['home']['post_type'])); ?> />
					<span class="description"><strong>page</strong></span>
					<br />
					<input type="checkbox" name="cp_post_type[home][]" value="attachment" <?php checked(is_array($cp_post_type['home']['post_type']) && in_array('attachment',$cp_post_type['home']['post_type'])); ?> />
					<span class="description"><strong>attachment</strong></span>
					<br />
					<?php if ( !empty( $post_types ) ): ?>
					<?php foreach ( $post_types as $post_type => $args ): ?>
					<input type="checkbox" name="cp_post_type[home][]" value="<?php echo( $post_type ); ?>" <?php checked(is_array($cp_post_type['home']['post_type']) && in_array($post_type,$cp_post_type['home']['post_type'])); ?> />
					<span class="description"><strong><?php echo $post_type; ?></strong></span>
					<br />
					<?php endforeach; ?>
					<?php endif; ?>
					<?php if ( $enable_subsite_content_types && $display_network_content_types ): ?>
					<?php if ( !empty( $network_post_types ) ): ?>
					<?php foreach ( $network_post_types as $post_type => $args ): ?>
					<input type="checkbox" name="cp_post_type[home][]" value="<?php echo( $post_type ); ?>" <?php checked(is_array($cp_post_type['home']['post_type']) && in_array($post_type,$cp_post_type['home']['post_type'])); ?> />
					<span class="description"><strong><?php echo $post_type; ?></strong></span>
					<br />
					<?php endforeach; ?>
					<?php endif; ?>
					<?php endif; ?>

					<span class="description"><?php esc_html_e('Wähle die benutzerdefinierten Beitragstypen, die auf der Seite "Blog/Home" angezeigt werden sollen.', $this->text_domain); ?></span>
					<br /><br />
					<input type="checkbox" name="cp_post_type[home][]" value="default" <?php checked(empty($cp_post_type['home']['post_type']) || (is_array($cp_post_type['home']['post_type']) && in_array('default', $cp_post_type['home']['post_type']))); ?> />
					<span class="description"><strong>default</strong></span><br />
					<span class="description"><?php esc_html_e('Wenn "default" aktiviert ist, wird die obige Liste deaktiviert und nur die Standard-Post_Typen angezeigt.', $this->text_domain); ?></span>
				</td>
			</tr>
		</table>

		<table class="form-table">
			<tr>
				<th>
					<label><?php esc_html_e('Zeige auf der "Startseite" die folgenden Beitragstypen an: ', $this->text_domain) ?></label>
				</th>
				<td>
					<input type="checkbox" name="cp_post_type[front_page][]" value="post" <?php checked(is_array($cp_post_type['front_page']['post_type']) && in_array('post',$cp_post_type['front_page']['post_type'])); ?> />
					<span class="description"><strong>post</strong></span>
					<br />
					<input type="checkbox" name="cp_post_type[front_page][]" value="page" <?php checked(is_array($cp_post_type['front_page']['post_type']) && in_array('page',$cp_post_type['front_page']['post_type'])); ?> />
					<span class="description"><strong>page</strong></span>
					<br />
					<input type="checkbox" name="cp_post_type[front_page][]" value="attachment" <?php checked(is_array($cp_post_type['front_page']['post_type']) && in_array('attachment',$cp_post_type['front_page']['post_type'])); ?> />
					<span class="description"><strong>attachment</strong></span>
					<br />
					<?php if ( !empty( $post_types ) ): ?>
					<?php foreach ( $post_types as $post_type => $args ): ?>
					<input type="checkbox" name="cp_post_type[front_page][]" value="<?php echo( $post_type ); ?>" <?php checked(is_array($cp_post_type['front_page']['post_type']) && in_array($post_type,$cp_post_type['front_page']['post_type'])); ?> />
					<span class="description"><strong><?php echo $post_type; ?></strong></span>
					<br />
					<?php endforeach; ?>
					<?php endif; ?>
					<?php if ( $enable_subsite_content_types && $display_network_content_types ): ?>
					<?php if ( !empty( $network_post_types ) ): ?>
					<?php foreach ( $network_post_types as $post_type => $args ): ?>
					<input type="checkbox" name="cp_post_type[front_page][]" value="<?php echo( $post_type ); ?>" <?php checked(empty($cp_post_type['front_page']['post_type']) || (is_array($cp_post_type['front_page']['post_type']) && in_array($post_type,$cp_post_type['front_page']['post_type']))); ?> />
					<span class="description"><strong><?php echo $post_type; ?></strong></span>
					<br />
					<?php endforeach; ?>
					<?php endif; ?>
					<?php endif; ?>

					<span class="description"><?php esc_html_e('Überprüfe die benutzerdefinierten Beitragstypen, die auf der statischen Seite "Vorderseite" angezeigt werden sollen.', $this->text_domain); ?></span>
					<br /><br />
					<input type="checkbox" name="cp_post_type[front_page][]" value="default" <?php checked(empty($cp_post_type['front_page']['post_type']) || (is_array($cp_post_type['front_page']['post_type']) && in_array('default', $cp_post_type['front_page']['post_type']))); ?> />
					<span class="description"><strong>default</strong></span><br />
					<span class="description"><?php esc_html_e('Wenn "default" aktiviert ist, wird die obige Liste deaktiviert und nur die Standard-Post_Typen angezeigt.', $this->text_domain); ?></span>
				</td>
			</tr>
		</table>

		<table class="form-table">
			<tr>
				<th>
					<label><?php esc_html_e('Zeige in "Archiven" die folgenden Beitragstypen an:  ', $this->text_domain) ?></label>
				</th>
				<td>
					<input type="checkbox" name="cp_post_type[archive][]" value="post" <?php checked(is_array($cp_post_type['archive']['post_type']) && in_array('post',$cp_post_type['archive']['post_type'])); ?> />
					<span class="description"><strong>post</strong></span>
					<br />
					<input type="checkbox" name="cp_post_type[archive][]" value="page" <?php checked(is_array($cp_post_type['archive']['post_type']) && in_array('page',$cp_post_type['archive']['post_type'])); ?> />
					<span class="description"><strong>page</strong></span>
					<br />
					<input type="checkbox" name="cp_post_type[archive][]" value="attachment" <?php checked(is_array($cp_post_type['archive']['post_type']) && in_array('attachment',$cp_post_type['archive']['post_type'])); ?> />
					<span class="description"><strong>attachment</strong></span>
					<br />
					<?php if ( !empty( $post_types ) ): ?>
					<?php foreach ( $post_types as $post_type => $args ): ?>
					<input type="checkbox" name="cp_post_type[archive][]" value="<?php echo( $post_type ); ?>" <?php checked(is_array($cp_post_type['archive']['post_type']) && in_array($post_type,$cp_post_type['archive']['post_type'])); ?> />
					<span class="description"><strong><?php echo $post_type; ?></strong></span>
					<br />
					<?php endforeach; ?>
					<?php endif; ?>
					<?php if ( $enable_subsite_content_types && $display_network_content_types ): ?>
					<?php if ( !empty( $network_post_types ) ): ?>
					<?php foreach ( $network_post_types as $post_type => $args ): ?>
					<input type="checkbox" name="cp_post_type[archive][]" value="<?php echo( $post_type ); ?>" <?php checked(is_array($cp_post_type['archive']['post_type']) && in_array($post_type,$cp_post_type['archive']['post_type'])); ?> />
					<span class="description"><strong><?php echo $post_type; ?></strong></span>
					<br />
					<?php endforeach; ?>
					<?php endif; ?>
					<?php endif; ?>

					<span class="description"><?php esc_html_e('Überprüfe die benutzerdefinierten Beitragstypen, die in "Archiven" angezeigt werden sollen.', $this->text_domain); ?></span>
					<br /><br />
					<input type="checkbox" name="cp_post_type[archive][]" value="default" <?php checked(empty($cp_post_type['archive']['post_type']) || (is_array($cp_post_type['archive']['post_type']) && in_array('default', $cp_post_type['archive']['post_type']))); ?> />
					<span class="description"><strong>default</strong></span><br />
					<span class="description"><?php esc_html_e('Wenn "default" aktiviert ist, wird die obige Liste deaktiviert und nur die Standard-Post_Typen angezeigt.', $this->text_domain); ?></span>
				</td>
			</tr>
		</table>

		<table class="form-table">
			<tr>
				<th>
					<label><?php esc_html_e('Zeige in "Suchen" die folgenden Beitragstypen an:  ', $this->text_domain) ?></label>
				</th>
				<td>
					<input type="checkbox" name="cp_post_type[search][]" value="post" <?php checked(is_array($cp_post_type['search']['post_type']) && in_array('post',$cp_post_type['search']['post_type'])); ?> />
					<span class="description"><strong>post</strong></span>
					<br />
					<input type="checkbox" name="cp_post_type[search][]" value="page" <?php checked(is_array($cp_post_type['search']['post_type']) && in_array('page',$cp_post_type['search']['post_type'])); ?> />
					<span class="description"><strong>page</strong></span>
					<br />
					<input type="checkbox" name="cp_post_type[search][]" value="attachment" <?php checked(is_array($cp_post_type['search']['post_type']) && in_array('attachment',$cp_post_type['search']['post_type'])); ?> />
					<span class="description"><strong>attachment</strong></span>
					<br />
					<?php if ( !empty( $post_types ) ): ?>
					<?php foreach ( $post_types as $post_type => $args ): ?>
					<input type="checkbox" name="cp_post_type[search][]" value="<?php echo( $post_type ); ?>" <?php checked(is_array($cp_post_type['search']['post_type']) && in_array($post_type,$cp_post_type['search']['post_type'])); ?> />
					<span class="description"><strong><?php echo $post_type; ?></strong></span>
					<br />
					<?php endforeach; ?>
					<?php endif; ?>
					<?php if ( $enable_subsite_content_types && $display_network_content_types ): ?>
					<?php if ( !empty( $network_post_types ) ): ?>
					<?php foreach ( $network_post_types as $post_type => $args ): ?>
					<input type="checkbox" name="cp_post_type[search][]" value="<?php echo( $post_type ); ?>" <?php checked(is_array($cp_post_type['search']['post_type']) && in_array($post_type,$cp_post_type['search']['post_type'])); ?> />
					<span class="description"><strong><?php echo $post_type; ?></strong></span>
					<br />
					<?php endforeach; ?>
					<?php endif; ?>
					<?php endif; ?>

					<span class="description"><?php esc_html_e('Überprüfe die benutzerdefinierten Beitragstypen, die in "Suchen" angezeigt werden sollen.', $this->text_domain); ?></span>
					<br /><br />
					<input type="checkbox" name="cp_post_type[search][]" value="default" <?php checked(empty($cp_post_type['search']['post_type']) || (is_array($cp_post_type['search']['post_type']) && in_array('default', $cp_post_type['search']['post_type']))); ?> />
					<span class="description"><strong>default</strong></span><br />
					<span class="description"><?php esc_html_e('Wenn "default" aktiviert ist, wird die obige Liste deaktiviert und nur die Standard-Post_Typen angezeigt.', $this->text_domain); ?></span>
				</td>
			</tr>
		</table>

		<?php endif; ?>

		<?php if ( is_admin() && !is_network_admin() ): ?>
		<h3><?php esc_html_e( 'Datumsauswahleinstellungen', $this->text_domain );  ?></h3>
		<table class="form-table">
			<tr>
				<th>
				</th>
				<td style="vertical-align:top; width:240px;">
					<?php
					$date_format = $this->get_options('date_format');
					$date_format = (is_array($date_format)) ? 'mm/dd/yy' : $date_format;

					$datepicker_theme = $this->get_options('datepicker_theme');
					$datepicker_theme = (is_array($datepicker_theme)) ? 'flick' : $datepicker_theme;

					//					$this->jquery_ui_css($datepicker_theme); //Load the current ui theme css

					$themes = glob($this->plugin_dir . 'datepicker/css/*', GLOB_ONLYDIR);
					?>
					<select id="datepicker_theme" name="datepicker_theme" style="width:230px" onchange="jQuery('#custom_date_format').val(''); jQuery('#jquery-ui-datepicker-css').prop('href', '<?php echo $this->plugin_url . 'datepicker/css/'; ?>' + this.options[this.selectedIndex].value + '/datepicker.css'); " >
						<?php
						foreach($themes as $theme){
							$theme = basename($theme);
							$selected = ($theme == $datepicker_theme) ? 'selected="selected"' : '';
							echo "<option value=\"$theme\" $selected >" . ucwords(str_replace('-',' ', $theme)) . "</option>\n";
						}
						?>
					</select><br />
					<span class="description"><?php esc_html_e('Wähle Datumsauswahl Design.', $this->text_domain) ?></span>
					<br /><br />
					<div class="pickdate"></div>
				</td>
				<td style="vertical-align:top;">
					<input type="text" id="date_format" name="date_format" size="38" value="<?php echo esc_attr( $date_format ); ?>" onchange="jQuery('.pickdate').datepicker( 'option', 'dateFormat', this.value );"/><br />
					<span class="description"><?php esc_html_e('Wähle die Option Datumsformat oder gib Deine eigene ein', $this->text_domain) ?></span>
					<br /><br />
					<input class="pickdate" id="datepicker" type="text" size="38" value="" /><br />
					<span class="description"><?php esc_html_e('Datumsauswahl Beispiel', $this->text_domain) ?></span>
				</td>
			</tr>
		</table>
		<?php endif; ?>

		<?php if ( ( is_super_admin() && is_network_admin() ) || !is_multisite() ): ?>
		<h3><?php esc_html_e( 'Templatedateien', $this->text_domain ); ?></h3>
		<table class="form-table">
			<tr>
				<th>
					<label><?php esc_html_e('Erstelle ein Template für: ', $this->text_domain) ?></label>
				</th>
				<td>
					<?php if ( !empty( $post_types )): ?>
					<?php foreach ( $post_types as $post_type => $args ): ?>
					<input type="checkbox" name="post_type_file[]" value="<?php echo $post_type; ?>" <?php if ( file_exists( TEMPLATEPATH . '/single-' .  strtolower( $post_type ) . '.php' )) echo( 'checked="checked" disabled="disabled"' ); ?> />
					<span class="description"><strong><?php echo $post_type; ?></strong></span>
					<br />
					<?php endforeach; ?>
					<?php else: ?>
					<span class="description"><strong><?php esc_html_e('Keine benutzerdefinierten Beitragstypen verfügbar', $this->text_domain); ?></strong></span>
					<?php endif; ?>
					<br />
					<span class="description"><?php esc_html_e('Dadurch wird die Datei "single- [post_type] .php" in Deinem aktiven Themenverzeichnis erstellt, indem Du Deine aktuelle single.php-Vorlage kopierst. Diese Datei ist die benutzerdefinierte Vorlage für Deinen benutzerdefinierten Beitragstyp. Du kannst es dann bearbeiten und anpassen', $this->text_domain); ?></span><br />
					<span class="description"><?php esc_html_e('In einigen Fällen möchtest Du dies möglicherweise nicht tun. Wenn Du beispielsweise keine Vorlage für Deinen benutzerdefinierten Beitragstyp hast, wird die Standardeinstellung "single.php" verwendet.', $this->text_domain); ?></span><br />
					<span class="description"><?php esc_html_e('Deine aktiven Themenordnerberechtigungen müssen auf 777 festgelegt sein, damit diese Option funktioniert. Nachdem die Datei erstellt wurde, kannst Du Deine Aktive Theme-Verzeichnisberechtigungen auf 755 zurücksetzen.', $this->text_domain); ?></span>
				</td>
			</tr>
		</table>
		<?php endif; ?>

		<p class="submit">
			<?php wp_nonce_field('verify'); ?>
			<input type="hidden" name="key" value="general_settings" />
			<input type="submit" class="button-primary" name="save" value="Änderungen speichern">
		</p>

	</form>
</div>

<script type="text/javascript">
    jQuery(document).ready(function ($) {
        //Make em pickers
        $('.pickdate').datepicker({ dateFormat: '<?php echo esc_js($date_format); ?>' });
        //Default date for display
        $('#datepicker').val($.datepicker.formatDate('<?php echo esc_js( $date_format ); ?>', new Date()));
    });
</script>

