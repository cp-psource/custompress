<?php if (!defined('ABSPATH')) die('Kein direkter Zugriff erlaubt!'); ?>

<?php
if(is_network_admin()){
	$post_type = $this->network_post_types[$_GET['ct_edit_post_type']];
	$custom_fields = get_site_option( 'ct_custom_fields' );
} else {
	$post_type = $this->post_types[$_GET['ct_edit_post_type']];
	$custom_fields = get_option( 'ct_custom_fields' );
}
if( !isset( $post_type['rewrite']['ep_mask'] ) ) {
	$post_type['rewrite']['ep_mask'] = EP_PERMALINK;
}

?>

<h3><?php esc_html_e('Beitragstyp bearbeiten', $this->text_domain); ?></h3>

<form action="#" method="post" class="ct-post-type">
	<div class="ct-wrap-left">
		<div class="ct-table-wrap">
			<div class="ct-arrow"><br></div>
			<h3 class="ct-toggle"><?php esc_html_e('Beitragstyp', $this->text_domain) ?></h3>
			<table class="form-table">
				<tr>
					<th>
						<label><?php esc_html_e('Beitragstyp', $this->text_domain) ?> <span class="ct-required">(<?php esc_html_e('erforderlich', $this->text_domain); ?>)</span></label>
					</th>
					<td>
						<input type="text" value="<?php if ( isset( $_GET['ct_edit_post_type'] ) ) echo esc_attr( $_GET['ct_edit_post_type'] ); ?>" disabled="disabled">
						<input type="hidden" id="post_type" name="post_type" value="<?php if ( isset( $_GET['ct_edit_post_type'] ) ) echo esc_attr( $_GET['ct_edit_post_type'] ); ?>" />
						<br /><span class="description"><?php esc_html_e('Der neue Systemtyp des Posttyps (max. 20 Zeichen). Nur alphanumerische Kleinbuchstaben und Unterstriche. Min 2 Buchstaben. Nach dem Hinzufügen kann der Systemtyp des Post-Typs nicht mehr geändert werden.', $this->text_domain); ?></span>
					</td>
				</tr>
			</table>
		</div>
		<div class="ct-table-wrap">
			<div class="ct-arrow"><br></div>
			<h3 class="ct-toggle"><?php esc_html_e('Unterstützt', $this->text_domain) ?></h3>
			<table class="form-table supports">
				<tr>
					<th>
						<label><?php esc_html_e('Unterstützt', $this->text_domain) ?></label>
					</th>
					<td>
						<p><span class="description"><?php esc_html_e('Registriere die Unterstützung bestimmter Funktionen für einen Beitragstyp.', $this->text_domain); ?></span></p>
						<label>
							<input type="checkbox" name="supports[title]" value="title" <?php checked(in_array('title', $post_type['supports']) ); ?> />
							<span class="description"><strong><?php esc_html_e('Titel', $this->text_domain) ?></strong></span>
						</label>
						<br />
						<label>
							<input type="checkbox" name="supports[editor]" value="editor" <?php checked(in_array('editor', $post_type['supports']) ); ?> />
							<span class="description"><strong><?php esc_html_e('Editor', $this->text_domain) ?></strong> - <?php esc_html_e('Content', $this->text_domain) ?></span>
						</label>
						<br />
						<label>
							<input type="checkbox" name="supports[author]" value="author" <?php checked(in_array('author', $post_type['supports']) ); ?> />
							<span class="description"><strong><?php esc_html_e('Autor', $this->text_domain) ?></strong></span>
						</label>
						<br />
						<label>
							<input type="checkbox" name="supports[thumbnail]" value="thumbnail" <?php checked(in_array('thumbnail', $post_type['supports']) ); ?> />
							<span class="description"><strong><?php esc_html_e('Thumbnail', $this->text_domain) ?></strong> - <?php esc_html_e('Ausgewähltes Bild - Das aktuelle Theme muss auch Post-Thumbnails unterstützen.', $this->text_domain) ?></span>
						</label>
						<br />
						<label>
							<input type="checkbox" name="supports[excerpt]" value="excerpt" <?php checked(in_array('excerpt', $post_type['supports']) ); ?> />
							<span class="description"><strong><?php esc_html_e('Auszug', $this->text_domain) ?></strong></span>
						</label>
						<br />
						<label>
							<input type="checkbox" name="supports[trackbacks]" value="trackbacks" <?php checked(in_array('trackbacks', $post_type['supports']) ); ?> />
							<span class="description"><strong><?php esc_html_e('Trackbacks', $this->text_domain) ?></strong></span>
						</label>
						<br />
						<label>
							<input type="checkbox" name="supports[custom_fields]" value="custom-fields" <?php checked(in_array('custom-fields', $post_type['supports']) ); ?> />
							<span class="description"><strong><?php esc_html_e('Benutzerdefinierte Felder', $this->text_domain) ?></strong></span>
						</label>
						<br />
						<label>
							<input type="checkbox" name="supports[comments]" value="comments" <?php checked(in_array('comments', $post_type['supports']) ); ?> />
							<span class="description"><strong><?php esc_html_e('Kommentare', $this->text_domain) ?></strong> - <?php esc_html_e('Außerdem wird auf dem Bearbeitungsbildschirm eine Sprechblase für die Anzahl der Kommentare angezeigt.', $this->text_domain) ?></span>
						</label>
						<br />
						<label>
							<input type="checkbox" name="supports[revisions]" value="revisions" <?php checked(in_array('revisions', $post_type['supports']) ); ?> />
							<span class="description"><strong><?php esc_html_e('Revisionen', $this->text_domain) ?></strong> - <?php esc_html_e('Speichert Revisionen.', $this->text_domain) ?></span>
						</label>
						<br />
						<label>
							<input type="checkbox" name="supports[page_attributes]" value="page-attributes" <?php checked(in_array('page-attributes', $post_type['supports']) ); ?> />
							<span class="description"><strong><?php esc_html_e('Seitenattribute', $this->text_domain) ?></strong> - <?php esc_html_e('Vorlagen- und Menüreihenfolge - Hierarchisch muss wahr sein!', $this->text_domain) ?></span>
						</label>
						<br />
						<label>
							<input type="checkbox" name="supports[post_formats]" value="post-formats" <?php checked(in_array('post-formats', $post_type['supports']) ); ?> />
							<span class="description"><strong><?php esc_html_e('Beitrags-Formate', $this->text_domain) ?></strong> - <?php esc_html_e('Beitragsformate hinzufügen.', $this->text_domain) ?></span>
						</label>
					</td>
				</tr>
			</table>
		</div>
		<div class="ct-table-wrap">
			<div class="ct-arrow"><br></div>
			<h3 class="ct-toggle"><?php esc_html_e('Unterstützung regulärer Taxonomien', $this->text_domain) ?></h3>
			<table class="form-table supports">
				<tr>
					<th>
						<label><?php esc_html_e('Unterstützung regulärer Taxonomien', $this->text_domain) ?></label>
					</th>
					<td>
						<p><span class="description"><?php esc_html_e('Weise diesem Beitragstyp reguläre Taxonomien zu.', $this->text_domain); ?></span></p>
						<?php if ( taxonomy_exists( 'category' ) ): ?>
						<label>
							<input type="checkbox" name="supports_reg_tax[category]" value="1" <?php checked(empty($post_type['supports_reg_tax']['category']), false); ?> />
							<span class="description"><strong><?php esc_html_e( 'Kategorien', $this->text_domain ) ?></strong></span>
						</label>
						<?php endif; ?>
						<br />
						<?php if ( taxonomy_exists( 'post_tag' ) ): ?>
						<label>
							<input type="checkbox" name="supports_reg_tax[post_tag]" value="1" <?php checked(empty($post_type['supports_reg_tax']['post_tag']), false); ?> />
							<span class="description"><strong><?php esc_html_e( 'Tags', $this->text_domain ) ?></strong></span>
						</label>
						<?php endif; ?>
					</td>
				</tr>
			</table>
		</div>

		<div class="ct-table-wrap">
			<div class="ct-arrow"><br></div>
			<h3 class="ct-toggle"><?php esc_html_e('Berechtigungstyp', $this->text_domain) ?></h3>
			<table class="form-table">
				<tr>
					<th>
						<label><?php esc_html_e('Berechtigungstyp', $this->text_domain) ?></label>
					</th>
					<td>
						<?php
						$capability_type = (isset( $post_type['capability_type'] ) ) ? $post_type['capability_type'] : 'post';
						?>
						<input type="text" name="capability_type" value="<?php echo esc_attr( $capability_type ); ?>" />
						<input type="checkbox" name="capability_type_edit" value="1" />
						<span class="description ct-capability-type-edit"><strong><?php esc_html_e('Bearbeiten' , $this->text_domain); ?></strong> (<?php esc_html_e('fortgeschritten' , $this->text_domain); ?>)</span>
						<br /><span class="description"><?php esc_html_e('Der Beitragstyp, der zum Überprüfen der Lese-, Bearbeitungs- und Löschfunktionen verwendet werden soll. Voreinstellung: "post".' , $this->text_domain); ?></span>
					</td>
				</tr>
			</table>
		</div>

		<div class="ct-table-wrap">
			<div class="ct-arrow"><br></div>
			<h3 class="ct-toggle"><?php esc_html_e('Meta-Funktionen zuordnen', $this->text_domain) ?></h3>
			<table class="form-table">
				<tr>
					<th>
						<label><?php esc_html_e('Meta-Funktionen zuordnen', $this->text_domain) ?></label>
					</th>
					<td>
						<p><span class="description"><?php esc_html_e('Verwende die interne Standardbehandlung für Metafunktionen.', $this->text_domain); ?></span></p>
						<label>
							<input type="radio" name="map_meta_cap" value="1" <?php checked( ! isset($post_type['map_meta_cap']) || $post_type['map_meta_cap'] === true); ?> />
							<span class="description"><strong><?php esc_html_e('WAHR', $this->text_domain); ?></strong></span>
						</label>
						<br />
						<label>
							<input type="radio" name="map_meta_cap" value="0" <?php checked(isset($post_type['map_meta_cap']) && $post_type['map_meta_cap'] === false); ?> />
							<span class="description"><strong><?php esc_html_e('FALSCH', $this->text_domain); ?></strong> (default)</span>
						</label>
					</td>
				</tr>
			</table>
		</div>

		<div class="ct-table-wrap">
			<div class="ct-arrow"><br></div>
			<h3 class="ct-toggle"><?php esc_html_e( 'Einstellungen für Rollenfunktionen', $this->text_domain ) ?></h3>
			<table class="form-table">
				<tr>
					<th>
						<label for="roles"><?php esc_html_e( 'Funktionen zuweisen', $this->text_domain ) ?></label>
						<img id="ajax-loader" alt="ajax-loader" src="<?php echo set_url_scheme(admin_url() ) . 'images/loading.gif' ?>" />
					</th>
					<td>

						<select id="roles" name="roles">
							<?php
							global $wp_roles;
							$role_obj = $wp_roles->get_role( 'administrator' );
							foreach ( $wp_roles->role_names as $role => $name ): ?>
							<option value="<?php echo $role; ?>"><?php echo $name; ?></option>
							<?php endforeach; ?>
						</select>
						<br /><span class="description"><?php echo sprintf(__('Wähle eine Rolle aus, der Du %s Funktionen zuweisen möchtest.', $this->text_domain), $capability_type ); ?></span>
						<br /><br />
						<div id="capabilities">
							<?php

							$all_caps = $this->all_capabilities($_GET['ct_edit_post_type']);
							if( ! empty($all_caps) ){
								sort($all_caps);
								foreach ( $all_caps as $capability ):
									$description = ucfirst(str_replace('_', ' ',$capability));
									?>
									<input type="checkbox" name="capabilities[<?php echo $capability; ?>]" id="<?php echo $capability; ?>" value="1" />
									<label for="<?php echo $capability; ?>"><span class="description"><?php echo $description; ?></span></label>
									<br />
									<?php
								endforeach;
							}
							?>
						</div>
					</td>
				</tr>
				<tr>
					<th>
					</th>
					<td>
						<input type="hidden" name="action" value="ct_save" />
						<input type="hidden" name="key" value="general_settings" />
						<input type="button" class="button" id="save_roles" name="save_roles" value="Speichere die Änderungen dieser Rolle" />
					</td>
				</tr>
			</table>
		</div>


		<div class="ct-table-wrap">
			<div class="ct-arrow"><br></div>
			<h3 class="ct-toggle"><?php esc_html_e('Labels', $this->text_domain) ?></h3>
			<table class="form-table">
				<tr>
					<th>
						<label><?php esc_html_e('Name', $this->text_domain) ?></label>
					</th>
					<td>
						<input type="text" name="labels[name]" value="<?php if ( isset( $post_type['labels']['name'] ) ) echo esc_attr( $post_type['labels']['name'] ); ?>" />
						<br /><span class="description"><?php esc_html_e('Allgemeiner Name für den Beitragstyp, normalerweise Plural.', $this->text_domain); ?></span>
					</td>
				</tr>
				<tr>
					<th>
						<label><?php esc_html_e('Singular Name', $this->text_domain) ?></label>
					</th>
					<td>
						<input type="text" name="labels[singular_name]" value="<?php if ( isset( $post_type['labels']['singular_name'] ) ) echo esc_attr( $post_type['labels']['singular_name'] ); ?>" />
						<br /><span class="description"><?php esc_html_e('Name für ein Objekt dieses Beitragstyps. Der Standardwert ist der Wert des Namens.', $this->text_domain); ?></span>
					</td>
				</tr>
				<tr>
					<th>
						<label><?php esc_html_e('Neu hinzufügen', $this->text_domain) ?></label>
					</th>
					<td>
						<input type="text" name="labels[add_new]" value="<?php if ( isset( $post_type['labels']['add_new'] ) ) echo esc_attr( $post_type['labels']['add_new'] ); ?>" />
						<br /><span class="description"><?php esc_html_e('Das Hinzufügen von neuem Text. Die Standardeinstellung ist Neu hinzufügen für hierarchische und nicht hierarchische Typen.', $this->text_domain); ?></span>
					</td>
				</tr>
				<tr>
					<th>
						<label><?php esc_html_e('Füge neues Element hinzu', $this->text_domain) ?></label>
					</th>
					<td>
						<input type="text" name="labels[add_new_item]" value="<?php if ( isset( $post_type['labels']['add_new_item'] ) ) echo esc_attr( $post_type['labels']['add_new_item'] ); ?>" />
						<br /><span class="description"><?php esc_html_e('Text für neues Element hinzufügen. Standard ist "Neuen Beitrag hinzufügen/Neue Seite hinzufügen".', $this->text_domain); ?></span>
					</td>
				</tr>
				<tr>
					<th>
						<label><?php esc_html_e('Element bearbeiten', $this->text_domain) ?></label>
					</th>
					<td>
						<input type="text" name="labels[edit_item]" value="<?php if ( isset( $post_type['labels']['edit_item'] ) ) echo esc_attr( $post_type['labels']['edit_item'] ); ?>" />
						<br /><span class="description"><?php esc_html_e('Text für Bearbeitung des Elements. Standard ist Beitrag bearbeiten/Seite bearbeiten.', $this->text_domain); ?></span>
					</td>
				</tr>
				<tr>
					<th>
						<label><?php esc_html_e('Neues Element', $this->text_domain) ?></label>
					</th>
					<td>
						<input type="text" name="labels[new_item]" value="<?php if ( isset( $post_type['labels']['new_item'] ) ) echo esc_attr( $post_type['labels']['new_item'] ); ?>" />
						<br /><span class="description"><?php esc_html_e('Text für neues Element. Standard ist Neuer Beitrag/Neue Seite.', $this->text_domain); ?></span>
					</td>
				</tr>
				<tr>
					<th>
						<label><?php esc_html_e('Element anzeigen', $this->text_domain) ?></label>
					</th>
					<td>
						<input type="text" name="labels[view_item]" value="<?php if ( isset( $post_type['labels']['view_item'] ) ) echo esc_attr( $post_type['labels']['view_item'] ); ?>" />
						<br /><span class="description"><?php esc_html_e('Text für Ansicht des Elements. Die Standardeinstellung ist Beitrag anzeigen/Seite anzeigen.', $this->text_domain); ?></span>
					</td>
				</tr>
				<tr>
					<th>
						<label><?php esc_html_e('Element suchen', $this->text_domain) ?></label>
					</th>
					<td>
						<input type="text" name="labels[search_items]" value="<?php if ( isset( $post_type['labels']['search_items'] ) ) echo esc_attr( $post_type['labels']['search_items'] ); ?>" />
						<br /><span class="description"><?php esc_html_e('Text für SElementsuche. Standard ist Suche Beiträge/Suche Seiten.', $this->text_domain); ?></span>
					</td>
				</tr>
				<tr>
					<th>
						<label><?php esc_html_e('Nicht gefunden', $this->text_domain) ?></label>
					</th>
					<td>
						<input type="text" name="labels[not_found]" value="<?php if ( isset( $post_type['labels']['not_found'] ) ) echo esc_attr( $post_type['labels']['not_found'] ); ?>" />
						<br /><span class="description"><?php esc_html_e('Text für nicht gefundene Elemente. Standard ist Keine Beiträge gefunden/Keine Seiten gefunden.', $this->text_domain); ?></span>
					</td>
				</tr>
				<tr>
					<th>
						<label><?php esc_html_e('Nicht im Papierkorb gefunden', $this->text_domain) ?></label>
					</th>
					<td>
						<input type="text" name="labels[not_found_in_trash]" value="<?php if ( isset( $post_type['labels']['not_found_in_trash'] ) ) echo esc_attr( $post_type['labels']['not_found_in_trash'] ); ?>" />
						<br /><span class="description"><?php esc_html_e('Der nicht im Papierkorb gefunden Text. Standard ist Keine Beiträge im Papierkorb gefunden/Keine Seiten im Papierkorb gefunden.', $this->text_domain); ?></span>
					</td>
				</tr>
				<tr>
					<th>
						<label><?php esc_html_e('Übergeordnetes Element Doppelpunkt', $this->text_domain) ?></label>
					</th>
					<td>
						<input type="text" name="labels[parent_item_colon]" value="<?php if ( isset( $post_type['labels']['parent_item_colon'] ) ) echo esc_attr( $post_type['labels']['parent_item_colon'] ); ?>" />
						<br /><span class="description"><?php esc_html_e('Der übergeordnete Text. Diese Zeichenfolge wird bei nicht hierarchischen Typen nicht verwendet. In hierarchischen Fällen ist die Standardeinstellung die übergeordnete Seite', $this->text_domain); ?></span>
					</td>
				</tr>
				<tr>
					<th>
						<label><?php esc_html_e('Benutzerdefinierte Block Felder', $this->text_domain) ?></label>
					</th>
					<td>
						<input type="text" name="labels[custom_fields_block]" value="<?php if ( isset( $post_type['labels']['custom_fields_block'] ) ) echo esc_attr( $post_type['labels']['custom_fields_block'] ); ?>" />
						<br /><span class="description"><?php esc_html_e('Titel des Blocks "Benutzerdefinierte Felder".', $this->text_domain); ?></span>
					</td>
				</tr>
			</table>
		</div>
		<div class="ct-table-wrap">
			<div class="ct-arrow"><br></div>
			<h3 class="ct-toggle"><?php esc_html_e('Beschreibung', $this->text_domain) ?></h3>
			<table class="form-table">
				<tr>
					<th>
						<label><?php esc_html_e('Beschreibung', $this->text_domain) ?></label>
					</th>
					<td>
						<textarea name="description" cols="52" rows="3"><?php if ( isset( $post_type['description'] ) ) echo esc_textarea( $post_type['description'] ); ?></textarea>
						<br /><span class="description"><?php esc_html_e('Eine kurze beschreibende Zusammenfassung des Beitragstyps.', $this->text_domain); ?></span>
					</td>
				</tr>
			</table>
		</div>
		<div class="ct-table-wrap">
			<div class="ct-arrow"><br></div>
			<h3 class="ct-toggle"><?php esc_html_e('Menüposition', $this->text_domain) ?></h3>
			<table class="form-table">
				<tr>
					<th>
						<label><?php esc_html_e('Menüposition', $this->text_domain) ?></label>
					</th>
					<td>
						<input type="text" name="menu_position" value="<?php if ( isset( $post_type['menu_position'] ) ) echo esc_attr( $post_type['menu_position'] ); ?>" />
						<br /><span class="description"><?php esc_html_e('5 - unter Beiträge; 10 - unter Medien; 20 - unter Seiten; 60 - unter dem ersten Abscheider; 100 - unter dem zweiten Separator', $this->text_domain); ?></span>
					</td>
				</tr>
			</table>
		</div>
		<div class="ct-table-wrap">
			<div class="ct-arrow"><br></div>
			<h3 class="ct-toggle"><?php esc_html_e('Menü Icon', $this->text_domain) ?></h3>
			<table class="form-table">
				<tr>
					<th>
						<label><?php esc_html_e('Menü Icon', $this->text_domain) ?></label>
					</th>
					<td>
						<input type="text" name="menu_icon" value="<?php if ( isset( $post_type['menu_icon'] ) ) echo esc_attr( $post_type['menu_icon'] ); ?>" />
						<br /><span class="description"><?php esc_html_e('Die URL zu dem Symbol, das für dieses Menü verwendet werden soll.', $this->text_domain); ?></span>
					</td>
				</tr>
			</table>
		</div>
		<div class="ct-table-wrap">
			<div class="ct-arrow"><br></div>
			<h3 class="ct-toggle"><?php esc_html_e('Spalten für benutzerdefinierte Felder anzeigen', $this->text_domain) ?></h3>
			<table class="form-table supports">
				<tr>
					<th>
						<label><?php esc_html_e('Benutzerdefinierte Felder', $this->text_domain) ?></label>
					</th>
					<td>
						<p><span class="description"><?php esc_html_e('Diese benutzerdefinierten Felder werden als Spalten auf dem Bildschirm für benutzerdefinierte Beitragstypen angezeigt.', $this->text_domain); ?></span></p>
						<?php

						if ( ! empty( $custom_fields ) ) {
							foreach ( $custom_fields as $custom_field ) {
								if ( false !== array_search( $_GET['ct_edit_post_type'], $custom_field['object_type'] ) ) {
									if ( isset( $post_type['cf_columns'][$custom_field['field_id']] ) && 1 == $post_type['cf_columns'][$custom_field['field_id']] )
									$checked = 'checked';
									else
									$checked = '';

									printf( '<label><input type="checkbox" name="cf_columns[%s]" value="1" %s />', esc_attr($custom_field['field_id']), $checked );
									printf( '<span class="description"><strong>%s</strong></span></label><br />', esc_html($custom_field['field_title']) );
								}
							}
						}
						if ( ! isset( $checked ) ) {
							echo '<span class="description"><strong>' . __('Dieser benutzerdefinierte Beitragstyp verwendet keine benutzerdefinierten Felder', $this->text_domain) . '</strong></span><br />';
						}
						?>
					</td>
				</tr>
			</table>
		</div>
	</div>
	<div class="ct-wrap-right">
		<div class="ct-table-wrap">
			<div class="ct-arrow"><br></div>
			<h3 class="ct-toggle"><?php esc_html_e('Öffentlich', $this->text_domain) ?></h3>
			<table class="form-table publica">
				<tr>
					<th>
						<label><?php esc_html_e('Öffentlich', $this->text_domain) ?></label>
					</th>
					<td>
						<p><span class="description"><?php esc_html_e('Meta-Argument zum Definieren von Standardwerten für public_queriable, show_ui, show_in_nav_menus und exclude_from_search.', $this->text_domain); ?></span></p>
						<label>
							<input type="radio" name="public" value="1" <?php checked( isset( $post_type['public']) && $post_type['public'] === true); ?> />
							<span class="description"><strong><?php esc_html_e('WAHR', $this->text_domain); ?></strong></span>
						</label>
						<br />
						<span class="description">
							<?php esc_html_e('Zeige eine Benutzeroberfläche für diesen "post_type" an.', $this->text_domain);?><br /><code>( show_ui = TRUE )</code><br /><br />
							<?php esc_html_e('Zeige "post_type" zur Auswahl in den Navigationsmenüs an', $this->text_domain); ?><br /><code>( show_in_nav_menus = TRUE )</code><br /><br />
							<?php esc_html_e('"post_type" -Abfragen können vom Frontend aus ausgeführt werden', $this->text_domain); ?><br /><code>( publicly_queryable = TRUE )</code><br /><br />
							<?php esc_html_e('Schließe Beiträge mit diesem Beitragstyp aus den Suchergebnissen aus', $this->text_domain); ?><br /><code>( exclude_from_search = FALSE )</code>
						</span>

						<br /><br />
						<label>
							<input type="radio" name="public" value="0" <?php checked( isset( $post_type['public'])  && $post_type['public'] === false); ?> />
							<span class="description"><strong><?php esc_html_e('FALSCH', $this->text_domain); ?></strong></span>
						</label>
						<br />
						<span class="description">
							<?php esc_html_e('Zeige für diesen "post_type" keine Benutzeroberfläche an.', $this->text_domain);?><br /><code>( show_ui = FALSE )</code><br /><br />
							<?php esc_html_e('Blende "post_type" zur Auswahl in den Navigationsmenüs aus', $this->text_domain); ?><br /><code>( show_in_nav_menus = FALSE )</code><br /><br />
							<?php esc_html_e('"post_type" -Abfragen können nicht über das Front-End ausgeführt werden', $this->text_domain); ?><br /><code>( publicly_queryable = FALSE )</code><br /><br />
							<?php esc_html_e('Schließe Beiträge mit diesem Beitragstyp aus den Suchergebnissen aus', $this->text_domain); ?><br /><code>( exclude_from_search = TRUE )</code>
						</span>

						<br /><br />
						<label>
							<input type="radio" name="public" value="advanced" <?php checked( ! isset($post_type['public']) || ($post_type['public'] !== true && $post_type['public'] !== false )); ?> />
							<span class="description"><strong><?php esc_html_e('Erweitert', $this->text_domain); ?></strong></span>
						</label>
						- <span class="description"><?php esc_html_e('Du kannst jede Komponente manuell einstellen.', $this->text_domain); ?></span>

					</td>
				</tr>
			</table>
		</div>
		<div class="ct-table-wrap">
			<div class="ct-arrow"><br></div>
			<h3 class="ct-toggle"><?php esc_html_e('Zeige UI', $this->text_domain) ?></h3>
			<table class="form-table show-ui">
				<tr>
					<th>
						<label><?php esc_html_e('Zeige UI', $this->text_domain) ?></label>
					</th>
					<td>
						<p><span class="description"><?php esc_html_e('Gibt an, ob eine Standardbenutzeroberfläche zum Verwalten dieses Beitragstyps generiert werden soll. Beachte, dass integrierte Beitragstypen wie Beitrag und Seite absichtlich auf falsch gesetzt sind.', $this->text_domain); ?></span></p>
						<label>
							<input type="radio" name="show_ui" value="1" <?php checked( isset( $post_type['show_ui'] ) && $post_type['show_ui'] === true); ?> />
							<span class="description"><strong><?php esc_html_e('WAHR', $this->text_domain); ?></strong></span>
						</label>
						<span class="description"> - <?php esc_html_e('Zeige eine Benutzeroberfläche (Admin-Bereich) für diesen Beitragstyp an.', $this->text_domain); ?></span>

						<br />
						<label>
							<input type="radio" name="show_ui" value="0" <?php checked( isset( $post_type['show_ui'] ) && $post_type['show_ui'] === false); ?> />
							<span class="description"><strong><?php esc_html_e('FALSCH', $this->text_domain); ?></strong></span>
						</label>
						<span class="description"> - <?php esc_html_e('Zeige für diesen Beitragstyp keine Benutzeroberfläche an.', $this->text_domain); ?></span>
					</td>
				</tr>
			</table>
		</div>
		<div class="ct-table-wrap">
			<div class="ct-arrow"><br></div>
			<h3 class="ct-toggle"><?php esc_html_e('In Navigationsmenüs anzeigen ', $this->text_domain) ?></h3>
			<table class="form-table show-in-nav-menus">
				<tr>
					<th>
						<label><?php esc_html_e('In Navigationsmenüs anzeigen', $this->text_domain) ?></label>
					</th>
					<td>
						<p><span class="description"><?php esc_html_e('Gibt an, ob post_type in Navigationsmenüs zur Auswahl steht.', $this->text_domain); ?></span></p>
						<label>
							<input type="radio" name="show_in_nav_menus" value="1" <?php checked( isset( $post_type['show_in_nav_menus'] ) && $post_type['show_in_nav_menus'] === true ); ?> />
							<span class="description"><strong><?php esc_html_e('WAHR', $this->text_domain); ?></strong></span>
						</label>
						<br />
						<label>
							<input type="radio" name="show_in_nav_menus" value="0" <?php checked( isset( $post_type['show_in_nav_menus'] ) && $post_type['show_in_nav_menus'] === false ); ?> />
							<span class="description"><strong><?php esc_html_e('FALSCH', $this->text_domain); ?></strong></span>
						</label>
					</td>
				</tr>
			</table>
		</div>
		<div class="ct-table-wrap">
			<div class="ct-arrow"><br></div>
			<h3 class="ct-toggle"><?php esc_html_e('Öffentlich abfragbar', $this->text_domain) ?></h3>
			<table class="form-table public-queryable">
				<tr>
					<th>
						<label><?php esc_html_e('Öffentlich abfragbar', $this->text_domain) ?></label>
					</th>
					<td>
						<p><span class="description"><?php esc_html_e('Ob post_type-Abfragen vom Frontend aus ausgeführt werden können.', $this->text_domain); ?></span></p>
						<label>
							<input type="radio" name="publicly_queryable" value="1" <?php checked( isset( $post_type['publicly_queryable'] ) && $post_type['publicly_queryable'] === true ); ?> />
							<span class="description"><strong><?php esc_html_e('WAHR', $this->text_domain); ?></strong></span>
						</label>
						<br />
						<label>
							<input type="radio" name="publicly_queryable" value="0" <?php checked( isset( $post_type['publicly_queryable'] ) && $post_type['publicly_queryable'] === false ); ?> />
							<span class="description"><strong><?php esc_html_e('FALSCH', $this->text_domain); ?></strong></span>
						</label>
					</td>
				</tr>
			</table>
		</div>
		<div class="ct-table-wrap">
			<div class="ct-arrow"><br></div>
			<h3 class="ct-toggle"><?php esc_html_e('Von der Suche ausschließen', $this->text_domain) ?></h3>
			<table class="form-table exclude-from-search">
				<tr>
					<th>
						<label><?php esc_html_e('Von der Suche ausschließen', $this->text_domain) ?></label>
					</th>
					<td>
						<p><span class="description"><?php esc_html_e('Gibt an, ob Beiträge mit diesem Beitragstyp aus den Suchergebnissen ausgeschlossen werden sollen.', $this->text_domain); ?></span></p>
						<label>
							<input type="radio" name="exclude_from_search" value="1" <?php checked(isset( $post_type['exclude_from_search'] ) && $post_type['exclude_from_search'] === true ); ?> />
							<span class="description"><strong><?php esc_html_e('WAHR', $this->text_domain); ?></strong></span>
						</label>
						<br />
						<label>
							<input type="radio" name="exclude_from_search" value="0" <?php checked(isset( $post_type['exclude_from_search'] ) && $post_type['exclude_from_search'] === false ); ?> />
							<span class="description"><strong><?php esc_html_e('FALSCH', $this->text_domain); ?></strong></span>
						</label>
					</td>
				</tr>
			</table>
		</div>
		<div class="ct-table-wrap">
			<div class="ct-arrow"><br></div>
			<h3 class="ct-toggle"><?php esc_html_e('Hierarchisch', $this->text_domain) ?></h3>
			<table class="form-table">
				<tr>
					<th>
						<label><?php esc_html_e('Hierarchisch', $this->text_domain) ?></label>
					</th>
					<td>
						<p><span class="description"><?php esc_html_e('Gibt an, ob der Beitragstyp hierarchisch ist. Ermöglicht die Angabe von Eltern.', $this->text_domain); ?></span></p>
						<label>
							<input type="radio" name="hierarchical" value="1" <?php checked(isset( $post_type['hierarchical'] ) && $post_type['hierarchical'] === true ); ?> />
							<span class="description"><strong><?php esc_html_e('WAHR', $this->text_domain); ?></strong></span>
						</label>
						<br />
						<label>
							<input type="radio" name="hierarchical" value="0" <?php checked( isset( $post_type['hierarchical'] ) && $post_type['hierarchical'] === false ); ?> />
							<span class="description"><strong><?php esc_html_e('FALSCH', $this->text_domain); ?></strong></span>
						</label>
					</td>
				</tr>
			</table>
		</div>
		<div class="ct-table-wrap">
			<div class="ct-arrow"><br></div>
			<h3 class="ct-toggle"><?php esc_html_e('Hat Archiv', $this->text_domain) ?></h3>
			<table class="form-table">
				<tr>
					<th>
						<label><?php esc_html_e('Hat Archiv', $this->text_domain) ?></label>
					</th>
					<td>
						<p><span class="description"><?php esc_html_e('Aktiviert Post-Typ-Archive. Verwendet String als Archiv-Slug. Generiert die richtigen Umschreiberegeln, wenn das Umschreiben aktiviert ist.', $this->text_domain); ?></span></p>
						<label>
							<input type="radio" name="has_archive" value="1" <?php checked( isset( $post_type['has_archive'] ) && $post_type['has_archive'] !== false ); ?> />
							<span class="description"><strong><?php esc_html_e('WAHR', $this->text_domain); ?></strong></span>
						</label>
						<br />
						<label>
							<input type="radio" name="has_archive" value="0" <?php checked( isset( $post_type['has_archive'] ) && $post_type['has_archive'] === false ); ?> />
							<span class="description"><strong><?php esc_html_e('FALSCH', $this->text_domain); ?></strong></span>
						</label>
						<br /><br />
						<span class="description"><strong><?php esc_html_e('Benutzerdefinierter Slug', $this->text_domain); ?></strong></span>
						<br />
						<input type="text" name="has_archive_slug" value="<?php if ( is_string( $post_type['has_archive'] ) ) echo esc_attr( $post_type['has_archive'] ); ?>" />
						<br />
						<span class="description"><?php esc_html_e('Benutzerdefinierter Slug für das Post-Type-Archiv.', $this->text_domain); ?></span>
					</td>
				</tr>
			</table>
		</div>
		<div class="ct-table-wrap">
			<div class="ct-arrow"><br></div>
			<h3 class="ct-toggle"><?php esc_html_e('Umschreiben', $this->text_domain) ?></h3>
			<table class="form-table">
				<tr>
					<th>
						<label><?php esc_html_e('Umschreiben', $this->text_domain) ?></label>
					</th>
					<td>
						<p><span class="description"><?php esc_html_e('Schreibe Permalinks mit diesem Format neu.', $this->text_domain); ?></span></p>
						<label>
							<input type="radio" name="rewrite" value="1" <?php checked( isset( $post_type['rewrite'] ) && $post_type['rewrite'] !== false ); ?> />
							<span class="description"><strong><?php esc_html_e('WAHR', $this->text_domain); ?></strong></span>
						</label>
						<br />
						<label>
							<input type="radio" name="rewrite" value="0" <?php checked( isset( $post_type['rewrite'] ) &&  $post_type['rewrite'] === false ); ?> />
							<span class="description"><strong><?php esc_html_e('FALSCH', $this->text_domain); ?></strong></span>
						</label>
						<br /><br />
						<span class="description"><strong><?php esc_html_e('Benutzerdefinierter Slug', $this->text_domain); ?></strong></span>
						<br />
						<input type="text" name="rewrite_slug" value="<?php if ( !empty( $post_type['rewrite']['slug'] ) ) echo esc_attr( $post_type['rewrite']['slug'] ); ?>" />
						<br />
						<span class="description"><?php esc_html_e('Stelle Beiträge diesen Slug voran. Wenn leer, wird die Standardeinstellung verwendet.', $this->text_domain); ?></span>
						<br /><br />
						<label>
							<input type="checkbox" name="rewrite_with_front" value="1" <?php checked( ! empty( $post_type['rewrite']['with_front'] )); ?> />
							<span class="description"><strong><?php esc_html_e('Front Base zulassen', $this->text_domain); ?></strong></span>
						</label>
						<br />
						<span class="description"><?php esc_html_e('Ermöglichen dass Permalinks mit der Front Base vorangestellt werden.', $this->text_domain); ?></span>
						<br /><br />
						<label>
							<input type="checkbox" name="rewrite_feeds" value="1" <?php checked( ! empty( $post_type['rewrite']['feeds'] ) ); ?> />
							<span class="description"><strong><?php esc_html_e('Feeds', $this->text_domain); ?></strong></span>
						</label>
						<br />
						<span class="description"><?php esc_html_e('Standardmäßig wird has_archive verwendet.', $this->text_domain); ?></span>
						<br />
						<label>
							<input type="checkbox" name="rewrite_pages" value="1" <?php checked( ! empty( $post_type['rewrite']['pages'] ) ); ?> />
							<span class="description"><strong><?php esc_html_e('Seiten', $this->text_domain); ?></strong></span>
						</label>
						<br />
						<span class="description"><?php esc_html_e('Der Standardwert ist wahr.', $this->text_domain); ?></span>
					</td>
				</tr>
			</table>
		</div>

		<div class="ct-table-wrap">
			<div class="ct-arrow"><br></div>
			<h3 class="ct-toggle"><?php esc_html_e('EP Maske', $this->text_domain) ?></h3>
			<table class="form-table">
				<tr>
					<th>
						<label><?php esc_html_e('EP Maske', $this->text_domain) ?></label>
					</th>
					<td>
						<span class="description"><?php esc_html_e('Endpunktmaske, die die Orte beschreibt, an denen der Endpunkt hinzugefügt werden soll.', $this->text_domain); ?></span>
					</td>
				</tr>
				<tr>
					<th></th>
					<td>
							<input type="hidden" name="ep_mask[EP_NONE]" value="0" />
						<label>
							<input type="checkbox" name="ep_mask[EP_NONE]" value="<?php echo EP_NONE; ?>" <?php checked( ! (bool) $post_type['rewrite']['ep_mask']); ?> />
							<span class="description"><strong><?php esc_html_e('EP_NONE: Standardmäßig nichts.', $this->text_domain); ?></strong></span>
						</label>
						<br />
							<input type="hidden" name="ep_mask[EP_PERMALINK]" value="0" />
						<label>
							<input type="checkbox" name="ep_mask[EP_PERMALINK]" value="<?php echo EP_PERMALINK; ?>" <?php checked( $post_type['rewrite']['ep_mask'] & EP_PERMALINK, EP_PERMALINK); ?> />
							<span class="description"><strong><?php esc_html_e('EP_PERMALINK: für Permalink.', $this->text_domain); ?></strong></span>
						</label>
						<br />
							<input type="hidden" name="ep_mask[EP_ATTACHMENT]" value="0" />
						<label>
							<input type="checkbox" name="ep_mask[EP_ATTACHMENT]" value="<?php echo EP_ATTACHMENT; ?>" <?php checked( $post_type['rewrite']['ep_mask'] & EP_ATTACHMENT, EP_ATTACHMENT); ?> />
							<span class="description"><strong><?php esc_html_e('EP_ATTACHMENT: für Anhang.', $this->text_domain); ?></strong></span>
						</label>
						<br />
							<input type="hidden" name="ep_mask[EP_DATE]" value="0" />
						<label>
							<input type="checkbox" name="ep_mask[EP_DATE]" value="<?php echo EP_DATE; ?>" <?php checked( $post_type['rewrite']['ep_mask'] & EP_DATE, EP_DATE); ?> />
							<span class="description"><strong><?php esc_html_e('EP_DATE: für Datum.', $this->text_domain); ?></strong></span>
						</label>
						<br />
							<input type="hidden" name="ep_mask[EP_YEAR]" value="0" />
						<label>
							<input type="checkbox" name="ep_mask[EP_YEAR]" value="<?php echo EP_YEAR; ?>" <?php checked( $post_type['rewrite']['ep_mask'] & EP_YEAR, EP_YEAR); ?> />
							<span class="description"><strong><?php esc_html_e('EP_YEAR: für Jahr.', $this->text_domain); ?></strong></span>
						</label>
						<br />
							<input type="hidden" name="ep_mask[EP_MONTH]" value="0" />
						<label>
							<input type="checkbox" name="ep_mask[EP_MONTH]" value="<?php echo EP_MONTH; ?>" <?php checked( $post_type['rewrite']['ep_mask'] & EP_MONTH, EP_MONTH); ?> />
							<span class="description"><strong><?php esc_html_e('EP_MONTH: für Monat.', $this->text_domain); ?></strong></span>
						</label>
						<br />
							<input type="hidden" name="ep_mask[EP_DAY]" value="0" />
						<label>
							<input type="checkbox" name="ep_mask[EP_DAY]" value="<?php echo EP_DAY; ?>" <?php checked( $post_type['rewrite']['ep_mask'] & EP_DAY, EP_DAY); ?> />
							<span class="description"><strong><?php esc_html_e('EP_DAY: für Tag.', $this->text_domain); ?></strong></span>
						</label>
						<br />
							<input type="hidden" name="ep_mask[EP_ROOT]" value="0" />
						<label>
							<input type="checkbox" name="ep_mask[EP_ROOT]" value="<?php echo EP_ROOT; ?>" <?php checked( $post_type['rewrite']['ep_mask'] & EP_ROOT, EP_ROOT); ?> />
							<span class="description"><strong><?php esc_html_e('EP_ROOT: für Root.', $this->text_domain); ?></strong></span>
						</label>
						<br />
							<input type="hidden" name="ep_mask[EP_COMMENTS]" value="0" />
						<label>
							<input type="checkbox" name="ep_mask[EP_COMMENTS]" value="<?php echo EP_COMMENTS; ?>" <?php checked( $post_type['rewrite']['ep_mask'] & EP_COMMENTS, EP_COMMENTS); ?> />
							<span class="description"><strong><?php esc_html_e('EP_COMMENTS: für Kommentare.', $this->text_domain); ?></strong></span>
						</label>
						<br />
							<input type="hidden" name="ep_mask[EP_SEARCH]" value="0" />
						<label>
							<input type="checkbox" name="ep_mask[EP_SEARCH]" value="<?php echo EP_SEARCH; ?>" <?php checked( $post_type['rewrite']['ep_mask'] & EP_SEARCH, EP_SEARCH); ?> />
							<span class="description"><strong><?php esc_html_e('EP_SEARCH: für Suche.', $this->text_domain); ?></strong></span>
						</label>
						<br />
							<input type="hidden" name="ep_mask[EP_CATEGORIES]" value="0" />
						<label>
							<input type="checkbox" name="ep_mask[EP_CATEGORIES]" value="<?php echo EP_CATEGORIES; ?>" <?php checked( $post_type['rewrite']['ep_mask'] & EP_CATEGORIES, EP_CATEGORIES); ?> />
							<span class="description"><strong><?php esc_html_e('EP_CATEGORIES: für Kategorien.', $this->text_domain); ?></strong></span>
						</label>
						<br />
							<input type="hidden" name="ep_mask[EP_TAGS]" value="0" />
						<label>
							<input type="checkbox" name="ep_mask[EPEP_TAGS_DAY]" value="<?php echo EP_TAGS; ?>" <?php checked( $post_type['rewrite']['ep_mask'] & EP_TAGS, EP_TAGS); ?> />
							<span class="description"><strong><?php esc_html_e('EP_TAGS: für Tags.', $this->text_domain); ?></strong></span>
						</label>
						<br />
							<input type="hidden" name="ep_mask[EP_AUTHORS]" value="0" />
						<label>
							<input type="checkbox" name="ep_mask[EP_AUTHORS]" value="<?php echo EP_AUTHORS; ?>" <?php checked( $post_type['rewrite']['ep_mask'] & EP_AUTHORS, EP_AUTHORS); ?> />
							<span class="description"><strong><?php esc_html_e('EP_AUTHORS: für Autoren.', $this->text_domain); ?></strong></span>
						</label>
						<br />
							<input type="hidden" name="ep_mask[EP_PAGES]" value="0" />
						<label>
							<input type="checkbox" name="ep_mask[EP_PAGES]" value="<?php echo EP_PAGES; ?>" <?php checked( $post_type['rewrite']['ep_mask'] & EP_PAGES, EP_PAGES); ?> />
							<span class="description"><strong><?php esc_html_e('EP_PAGES: für Seiten.', $this->text_domain); ?></strong></span>
						</label>
						<br />
							<input type="hidden" name="ep_mask[EP_ALL]" value="0" />
						<label>
							<input type="checkbox" name="ep_mask[EP_ALL]" value="<?php echo EP_ALL; ?>" <?php checked( $post_type['rewrite']['ep_mask'] & EP_ALL, EP_ALL ); ?> />
							<span class="description"><strong><?php esc_html_e('EP_ALL: für alles.', $this->text_domain); ?></strong></span>
						</label>
					</td>
				</tr>
			</table>
		</div>

		<div class="ct-table-wrap">
			<div class="ct-arrow"><br></div>
			<h3 class="ct-toggle"><?php esc_html_e('Abfrage var', $this->text_domain) ?></h3>
			<table class="form-table">
				<tr>
					<th>
						<label><?php esc_html_e('Abfrage var', $this->text_domain) ?></label>
					</th>
					<td>
						<p><span class="description"><?php esc_html_e('Name der Abfragevariablen, die für diesen Beitragstyp verwendet werden soll. Der Standardwert ist der Name des Beitragstyps.', $this->text_domain); ?></span></p>
						<label>
							<input type="radio" name="query_var" value="1" <?php checked( isset($post_type['query_var']) && $post_type['query_var'] !== false); ?> />
							<span class="description"><strong><?php esc_html_e('WAHR', $this->text_domain); ?></strong></span>
						</label>
						<br />
						<label>
							<input type="radio" name="query_var" value="0" <?php checked(isset($post_type['query_var']) && $post_type['query_var'] === false); ?> />
							<span class="description"><strong><?php esc_html_e('FALSCH', $this->text_domain); ?></strong></span>
						</label>
						<br /><br />
						<span class="description"><strong><?php esc_html_e('Benutzerdefinierter Abfrageschlüssel', $this->text_domain); ?></strong></span>
						<br />
						<input type="text" name="query_var_key" value="<?php if ( is_string( $post_type['query_var'] ) ) echo esc_attr( $post_type['query_var'] ); ?>" />
						<br />
						<span class="description"><?php esc_html_e('Benutzerdefinierter Abfrage-Var-Schlüssel.', $this->text_domain); ?></span>
					</td>
				</tr>
			</table>
		</div>
		<div class="ct-table-wrap">
			<div class="ct-arrow"><br></div>
			<h3 class="ct-toggle"><?php esc_html_e('Kann exportieren', $this->text_domain) ?></h3>
			<table class="form-table">
				<tr>
					<th>
						<label><?php esc_html_e('Kann exportieren', $this->text_domain) ?></label>
					</th>
					<td>
						<p><span class="description"><?php esc_html_e('Kann dieser post_type exportiert werden?.', $this->text_domain); ?></span></p>
						<label>
							<input type="radio" name="can_export" value="1" <?php checked( !isset($post_type['can_export']) || $post_type['can_export'] === true); ?> />
							<span class="description"><strong><?php esc_html_e('WAHR', $this->text_domain); ?></strong></span>
						</label>
						<br />
						<label>
							<input type="radio" name="can_export" value="0" <?php checked(isset($post_type['can_export']) && $post_type['can_export'] === false); ?> />
							<span class="description"><strong><?php esc_html_e('FALSCH', $this->text_domain); ?></strong></span>
						</label>
					</td>
				</tr>
			</table>
		</div>
		<div class="ct-table-wrap">
			<div class="ct-arrow"><br></div>
			<h3 class="ct-toggle"><?php esc_html_e('REST API', $this->text_domain) ?></h3>
			<table class="form-table">
				<tr>
					<th>
						<label><?php esc_html_e('REST API', $this->text_domain) ?></label>
					</th>
					<td>
						<p><span class="description"><?php esc_html_e('Aktiviere die REST-API-Unterstützung für diesen Beitragstyp.', $this->text_domain); ?></span></p>
						<label>
							<input type="radio" name="show_in_rest" value="1" <?php checked( !isset($post_type['show_in_rest']) || $post_type['show_in_rest'] === true); ?> />
							<span class="description"><strong><?php esc_html_e('WAHR', $this->text_domain); ?></strong></span>
						</label>
						<br />
						<label>
							<input type="radio" name="show_in_rest" value="0" <?php checked(isset($post_type['show_in_rest']) && $post_type['show_in_rest'] === false); ?> />
							<span class="description"><strong><?php esc_html_e('FALSCH', $this->text_domain); ?></strong></span>
						</label>
						<br /><br />
						<span class="description"><strong><?php esc_html_e('REST API Base', $this->text_domain); ?></strong></span>
						<br />
						<input type="text" name="rest_base" value="<?php echo !empty($post_type['rest_base']) && is_string( $post_type['rest_base'] ) ? esc_attr( $post_type['rest_base'] ) : ''; ?>" />
						<br />
						<span class="description"><?php esc_html_e('Benutzerdefinierter Abfrage-Var-Schlüssel.', $this->text_domain); ?></span>
					</td>
				</tr>
			</table>
		</div>

	</div>
	<p class="submit ct-clear">
		<?php wp_nonce_field('submit_post_type'); ?>
		<input type="submit" class="button-primary" name="submit" value="Änderungen speichern" />
	</p>
	<br /><br /><br /><br />
</form>
