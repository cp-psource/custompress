<?php if (!defined('ABSPATH')) die('Kein direkter Zugriff erlaubt!'); 

$post_types = get_post_types('','names'); 

?>

<h3><?php esc_html_e('Taxonomie hinzufügen', $this->text_domain); ?></h3>
<form action="#" method="post" class="ct-taxonomy">
	<div class="ct-wrap-left">
		<div class="ct-table-wrap">
			<div class="ct-arrow"><br></div>
			<h3 class="ct-toggle"><?php esc_html_e('Taxonomie', $this->text_domain) ?></h3>
			<table class="form-table <?php do_action('ct_invalid_field_taxonomy'); ?>" >
				<tr>
					<th>
						<label><?php esc_html_e('Taxonomie', $this->text_domain) ?>
						<br /><span class="ct-required">( <?php esc_html_e('required', $this->text_domain); ?> )</span></label>
					</th>
					<td>
						<input type="text" name="taxonomy" value="<?php if ( isset( $_POST['taxonomy'] ) ) echo esc_attr( $_POST['taxonomy'] ); ?>" />
						<br /><span class="description"><?php esc_html_e('Der Systemname der Taxonomie. Nur alphanumerische Kleinbuchstaben und Unterstriche. Min 2 Buchstaben. Nach dem Hinzufügen kann der Name des Taxonomiesystems nicht mehr geändert werden.', $this->text_domain); ?></span>
					</td>
				</tr>
			</table>
		</div>
		<div class="ct-table-wrap">
			<div class="ct-arrow"><br></div>
			<h3 class="ct-toggle"><?php esc_html_e('Beitragstyp', $this->text_domain) ?></h3>
			<table class="form-table <?php do_action('ct_invalid_field_object_type'); ?>" >
				<tr>
					<th>
						<label><?php esc_html_e('Beitragstyp', $this->text_domain) ?> (<span class="ct-required"> <?php esc_html_e('erforderlich', $this->text_domain); ?> </span>)</label>
					</th>
					<td>

						<select name="object_type[]" multiple="multiple" class="ct-object-type">
							<?php if ( is_array( $post_types )): ?>
							<?php foreach( $post_types as $post_type ): ?>
							<option value="<?php echo ( $post_type ); ?>" <?php if ( isset( $_POST['object_type'] ) && is_array( $_POST['object_type'] )) { foreach ( $_POST['object_type'] as $post_value ) { selected( $post_value == $post_type ); }} ?> ><?php echo esc_html( $post_type ); ?></option>
							<?php endforeach; ?>
							<?php endif; ?>
						</select>

						<br /><span class="description"><?php esc_html_e('Wähle einen oder mehrere Beitragstypen aus, denen diese Taxonomie hinzugefügt werden soll.', $this->text_domain); ?></span>
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
						<input type="text" name="labels[name]" value="<?php if ( isset( $_POST['labels']['name'] ) ) echo esc_attr( $_POST['labels']['name'] ); ?>" />
						<br /><span class="description"><?php esc_html_e('Allgemeiner Name für die Taxonomie, normalerweise Plural.', $this->text_domain); ?></span>
					</td>
				</tr>
				<tr>
					<th>
						<label><?php esc_html_e('Singular Name', $this->text_domain) ?></label>
					</th>
					<td>
						<input type="text" name="labels[singular_name]" value="<?php if ( isset( $_POST['labels']['singular_name']  ) ) echo esc_attr( $_POST['labels']['singular_name'] ); ?>" />
						<br /><span class="description"><?php esc_html_e('Name für ein Objekt dieser Taxonomie. Der Standardwert ist der Wert des Namens.', $this->text_domain); ?></span>
					</td>
				</tr>
				<tr>
					<th>
						<label><?php esc_html_e('Füge neues Element hinzu', $this->text_domain) ?></label>
					</th>
					<td>
						<input type="text" name="labels[add_new_item]" value="<?php if ( isset( $_POST['labels']['add_new_item'] ) ) echo esc_attr( $_POST['labels']['add_new_item'] ); ?>" />
						<br /><span class="description"><?php esc_html_e('Text für "Neues Element hinzufügen". Die Standardeinstellung ist "Neues Tag hinzufügen" oder "Neue Kategorie hinzufügen".', $this->text_domain); ?></span>
					</td>
				</tr>
				<tr>
					<th>
						<label><?php esc_html_e('Neues Element Name', $this->text_domain) ?></label>
					</th>
					<td>
						<input type="text" name="labels[new_item_name]" value="<?php if ( isset( $_POST['labels']['new_item_name'] ) ) echo esc_attr( $_POST['labels']['new_item_name'] ); ?>" />
						<br /><span class="description"><?php esc_html_e('Text für neues Element. Die Standardeinstellung ist "Neuer Tag-Name" oder "Neuer Kategoriename".', $this->text_domain); ?></span>
					</td>
				</tr>
				<tr>
					<th>
						<label><?php esc_html_e('Element bearbeiten', $this->text_domain) ?></label>
					</th>
					<td>
						<input type="text" name="labels[edit_item]" value="<?php if ( isset( $_POST['labels']['edit_item'] ) ) echo esc_attr( $_POST['labels']['edit_item'] ); ?>" />
						<br /><span class="description"><?php esc_html_e('Text für Elementbearbeitung. Die Standardeinstellung ist "Tag bearbeiten" oder "Kategorie bearbeiten".', $this->text_domain); ?></span>
					</td>
				</tr>
				<tr>
					<th>
						<label><?php esc_html_e('Element aktualisieren', $this->text_domain) ?></label>
					</th>
					<td>
						<input type="text" name="labels[update_item]" value="<?php if ( isset( $_POST['labels']['update_item'] ) ) echo esc_attr( $_POST['labels']['update_item'] ); ?>" />
						<br /><span class="description"><?php esc_html_e('Text für Elementaktualisierung. Die Standardeinstellung ist "Tag aktualisieren" oder "Kategorie aktualisieren".', $this->text_domain); ?></span>
					</td>
				</tr>
				<tr>
					<th>
						<label><?php esc_html_e('Suche Elemente', $this->text_domain) ?></label>
					</th>
					<td>
						<input type="text" name="labels[search_items]" value="<?php if ( isset( $_POST['labels']['search_items'] ) ) echo esc_attr( $_POST['labels']['search_items'] ); ?>" />
						<br /><span class="description"><?php esc_html_e('Text für Elementsuche. Die Standardeinstellung ist "Such-Tags" oder "Suchkategorien".', $this->text_domain); ?></span>
					</td>
				</tr>
				<tr>
					<th>
						<label><?php esc_html_e('Beliebte Elemente', $this->text_domain) ?></label>
					</th>
					<td>
						<input type="text" name="labels[popular_items]" value="<?php if ( isset( $_POST['labels']['popular_items'] ) ) echo esc_attr( $_POST['labels']['popular_items'] ); ?>" />
						<br /><span class="description"><?php esc_html_e('Der beliebte Elemente Text. Die Standardeinstellung ist "Beliebte Tags" oder null.', $this->text_domain); ?></span>
					</td>
				</tr>
				<tr>
					<th>
						<label><?php esc_html_e('Alle Elemente', $this->text_domain) ?></label>
					</th>
					<td>
						<input type="text" name="labels[all_items]" value="<?php if ( isset( $_POST['labels']['all_items'] ) ) echo esc_attr( $_POST['labels']['all_items'] ); ?>" />
						<br /><span class="description"><?php esc_html_e('Text für alle Elemente. Die Standardeinstellung ist "Alle Tags" oder "Alle Kategorien".', $this->text_domain); ?></span>
					</td>
				</tr>
				<tr>
					<th>
						<label><?php esc_html_e('Übergeordnetes Element', $this->text_domain) ?></label>
					</th>
					<td>
						<input type="text" name="labels[parent_item]" value="<?php if ( isset( $_POST['labels']['parent_item'] ) ) echo esc_attr( $_POST['labels']['parent_item'] ); ?>" />
						<br /><span class="description"><?php esc_html_e('Der übergeordnete Elementtext. Diese Zeichenfolge wird nicht für nicht hierarchische Taxonomien wie Post-Tags verwendet. Die Standardeinstellung ist null oder "Übergeordnete Kategorie".', $this->text_domain); ?></span>
					</td>
				</tr>
				<tr>
					<th>
						<label><?php esc_html_e('Übergeordnetes Element Doppelpunkt', $this->text_domain) ?></label>
					</th>
					<td>
						<input type="text" name="labels[parent_item_colon]" value="<?php if ( isset( $_POST['labels']['parent_item_colon'] ) ) echo esc_attr( $_POST['labels']['parent_item_colon'] ); ?>" />
						<br /><span class="description"><?php esc_html_e('Das gleiche wie parent_item, jedoch mit Doppelpunkt: am Ende null "Elternkategorie:.', $this->text_domain); ?></span>
					</td>
				</tr>
				<tr>
					<th>
						<label><?php esc_html_e('Elemente hinzufügen oder entfernen', $this->text_domain) ?></label>
					</th>
					<td>
						<input type="text" name="labels[add_or_remove_items]" value="<?php if ( isset( $_POST['labels']['add_or_remove_items'] ) ) echo esc_attr( $_POST['labels']['add_or_remove_items']); ?>" />
						<br /><span class="description"><?php esc_html_e('Text zum Hinzufügen oder Entfernen von Elementen wird im Meta-Feld verwendet, wenn JavaScript deaktiviert ist. Diese Zeichenfolge wird in hierarchischen Taxonomien nicht verwendet. Die Standardeinstellung ist "Tags hinzufügen oder entfernen" oder null.', $this->text_domain); ?></span>
					</td>
				</tr>
				<tr>
					<th>
						<label><?php esc_html_e('Trenne Elemente mit Kommas', $this->text_domain) ?></label>
					</th>
					<td>
						<input type="text" name="labels[separate_items_with_commas]" value="<?php if ( isset( $_POST['labels']['separate_items_with_commas'] ) ) echo esc_attr( $_POST['labels']['separate_items_with_commas'] ); ?>" />
						<br /><span class="description"><?php esc_html_e('Text für separates Element mit Komma, das im Metafeld Taxonomie verwendet wird. Diese Zeichenfolge wird in hierarchischen Taxonomien nicht verwendet. Die Standardeinstellung ist "Tags durch Kommas trennen" oder null.', $this->text_domain); ?></span>
					</td>
				</tr>
				<tr>
					<th>
						<label><?php esc_html_e('Wähle aus den am häufigsten verwendeten', $this->text_domain) ?></label>
					</th>
					<td>
						<input type="text" name="labels[choose_from_most_used]" value="<?php if ( isset( $_POST['labels']['choose_from_most_used'] ) ) echo esc_attr( $_POST['labels']['choose_from_most_used'] ); ?>" />
						<br /><span class="description"><?php esc_html_e('Wähle aus dem am häufigsten verwendeten Text, der im Metafeld Taxonomie verwendet wird. Diese Zeichenfolge wird in hierarchischen Taxonomien nicht verwendet. Die Standardeinstellung ist "Aus den am häufigsten verwendeten Tags auswählen" oder null.', $this->text_domain); ?></span>
					</td>
				</tr>
			</table>
		</div>
		<div class="ct-table-wrap">
			<div class="ct-arrow"><br></div>
			<h3 class="ct-toggle"><?php esc_html_e('Admin-Spalte anzeigen', $this->text_domain) ?></h3>
			<table class="form-table show_admin_column">
				<tr>
					<th>
						<label><?php esc_html_e('Admin-Spalte anzeigen', $this->text_domain) ?></label>
					</th>
					<td>
						<span class="description"><?php esc_html_e('Gibt an, ob die automatische Erstellung von Taxonomiespalten für zugeordnete Posttypen zulässig ist.', $this->text_domain); ?></span>
					</td>
				</tr>
				<tr>
					<th></th>
					<td>
						<label>
							<input type="radio" name="show_admin_column" value="1" <?php checked( isset( $_POST['public'] ) && $_POST['public'] == 'advanced' && isset( $_POST['show_admin_column'] ) && $_POST['show_admin_column'] === '1' ); ?> />
							<span class="description"><strong><?php esc_html_e('WAHR', $this->text_domain); ?></strong></span>
						</label>
						<br />
						<label>
							<input type="radio" name="show_admin_column" value="0" <?php checked( isset( $_POST['public'] ) && $_POST['public'] == 'advanced' && isset( $_POST['show_admin_column'] ) && $_POST['show_admin_column'] === '0' ); ?> />
							<span class="description"><strong><?php esc_html_e('FALSCH', $this->text_domain); ?></strong></span>
						</label>
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
						<span class="description"><?php esc_html_e('Soll diese Taxonomie in der Admin-Benutzeroberfläche verfügbar gemacht werden?', $this->text_domain); ?></span>
					</td>
				</tr>
				<tr>
					<th></th>
					<td>
						<label>
							<input type="radio" name="public" value="1" <?php checked(!isset($_POST['public']) || isset( $_POST['public'] ) && $_POST['public'] === '1' ); ?> />
							<span class="description"><strong><?php esc_html_e('WAHR', $this->text_domain); ?></strong></span>
						</label>
						<br />
						<label>
							<input type="radio" name="public" value="0" <?php checked( isset( $_POST['public'] ) && $_POST['public'] === '0' ); ?> />
							<span class="description"><strong><?php esc_html_e('FALSCH', $this->text_domain); ?></strong></span>
						</label>
						<br />
						<label>
							<input type="radio" name="public" value="advanced" <?php checked( isset( $_POST['public'] ) && $_POST['public'] == 'advanced' ); ?> />
							<span class="description"><strong><?php esc_html_e('ERWEITERT', $this->text_domain); ?></strong></span>
						</label>
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
						<span class="description"><?php esc_html_e('Gibt an, ob eine Standardbenutzeroberfläche zum Verwalten dieser Taxonomie generiert werden soll.', $this->text_domain); ?></span>
					</td>
				</tr>
				<tr>
					<th></th>
					<td>
						<label>
							<input type="radio" name="show_ui" value="1" <?php checked( isset( $_POST['public'] ) && $_POST['public'] == 'advanced' && isset( $_POST['show_ui'] ) && $_POST['show_ui'] === '1'); ?> />
							<span class="description"><strong><?php esc_html_e('WAHR', $this->text_domain); ?></strong></span>
						</label>
						<br />
						<label>
							<input type="radio" name="show_ui" value="0" <?php checked( isset( $_POST['public'] ) && $_POST['public'] == 'advanced' && isset( $_POST['show_ui'] ) && $_POST['show_ui'] === '0' ); ?> />
							<span class="description"><strong><?php esc_html_e('FALSCH', $this->text_domain); ?></strong></span>
						</label>
					</td>
				</tr>
			</table>
		</div>
		<div class="ct-table-wrap">
			<div class="ct-arrow"><br></div>
			<h3 class="ct-toggle"><?php esc_html_e('Zeige Tagcloud', $this->text_domain) ?></h3>
			<table class="form-table show_tagcloud">
				<tr>
					<th>
						<label><?php esc_html_e('Zeige Tagcloud', $this->text_domain) ?></label>
					</th>
					<td>
						<span class="description"><?php esc_html_e('Gibt an, ob in der Administrator-Benutzeroberfläche eine Tag-Cloud für diese Taxonomie angezeigt werden soll.', $this->text_domain); ?></span>
					</td>
				</tr>
				<tr>
					<th></th>
					<td>
						<label>
							<input type="radio" name="show_tagcloud" value="1" <?php checked( isset( $_POST['public'] ) && $_POST['public'] == 'advanced' && isset( $_POST['show_tagcloud'] ) && $_POST['show_tagcloud'] === '1' ); ?> />
							<span class="description"><strong><?php esc_html_e('WAHR', $this->text_domain); ?></strong></span>
						</label>
						<br />
						<label>
							<input type="radio" name="show_tagcloud" value="0" <?php checked( isset( $_POST['public'] ) && $_POST['public'] == 'advanced' && isset( $_POST['show_tagcloud'] ) && $_POST['show_tagcloud'] === '0' ); ?> />
							<span class="description"><strong><?php esc_html_e('FALSCH', $this->text_domain); ?></strong></span>
						</label>
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
						<span class="description"><?php esc_html_e('Gibt an, ob diese Taxonomie in Navigationsmenüs zur Auswahl gestellt werden soll.', $this->text_domain); ?></span>
					</td>
				</tr>
				<tr>
					<th></th>
					<td>
						<label>
							<input type="radio" name="show_in_nav_menus" value="1" <?php checked( isset( $_POST['public'] ) && $_POST['public'] == 'advanced' && isset( $_POST['show_in_nav_menus'] ) && $_POST['show_in_nav_menus'] === '1' ); ?> />
							<span class="description"><strong><?php esc_html_e('WAHR', $this->text_domain); ?></strong></span>
						</label>
						<br />
						<label>
							<input type="radio" name="show_in_nav_menus" value="0" <?php checked( isset( $_POST['public'] ) && $_POST['public'] == 'advanced' && isset( $_POST['show_in_nav_menus'] ) && $_POST['show_in_nav_menus'] === '0' ); ?> />
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
						<span class="description"><?php esc_html_e('Gibt an, ob der Beitragstyp hierarchisch ist. Ermöglicht die Angabe von Eltern.', $this->text_domain); ?></span>
					</td>
				</tr>
				<tr>
					<th></th>
					<td>
						<label>
							<input type="radio" name="hierarchical" value="1" <?php checked( ! empty($_POST['hierarchical']) || (isset( $_POST['hierarchical'] ) && $_POST['hierarchical'] === '1') ); ?> />
							<span class="description"><strong><?php esc_html_e('WAHR', $this->text_domain); ?></strong></span>
						</label>
						<br />
						<label>
							<input type="radio" name="hierarchical" value="0" <?php checked( empty($_POST['hierarchical']) || (isset( $_POST['hierarchical'] ) && $_POST['hierarchical'] === '0') ); ?> />
							<span class="description"><strong><?php esc_html_e('FALSCH', $this->text_domain); ?></strong></span>
						</label>
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
						<span class="description"><?php esc_html_e('Setze diesen Wert auf Falsch, um ein erneutes Schreiben zu verhindern, oder auf Wahr, um ihn anzupassen.', $this->text_domain); ?></span>
					</td>
				</tr>
				<tr>
					<th></th>
					<td>
						<label>
							<input type="radio" name="rewrite" value="1" <?php checked(empty($_POST['rewrite']) || (isset( $_POST['rewrite'] ) && $_POST['rewrite'] === '1') ); ?> />
							<span class="description"><strong><?php esc_html_e('WAHR', $this->text_domain); ?></strong></span>
						</label>
						<br />
						<span class="description"><?php esc_html_e('Standardmäßig wird die Abfrage var verwendet.', $this->text_domain); ?></span>
						<br />
						<label>
							<input type="radio" name="rewrite" value="0" <?php checked( isset( $_POST['rewrite'] ) &&  $_POST['rewrite'] === '0' ); ?> />
							<span class="description"><strong><?php esc_html_e('FALSCH', $this->text_domain); ?></strong></span>
						</label>
						<br />
						<span class="description"><?php esc_html_e('Umschreiben verhindern.', $this->text_domain); ?></span>
						<br /><br />

						<span class="description"><strong><?php esc_html_e('Benutzerdefinierter Slug', $this->text_domain); ?></strong></span>
						<br />

						<input type="text" name="rewrite_slug" value="<?php if ( ! empty($_POST['rewrite_slug'])) echo esc_attr( $_POST['rewrite_slug'] ); ?>" />
						<br />
						<span class="description"><?php esc_html_e('Stelle Beiträgen diesen Slug voran. Wenn leer, wird die Standardeinstellung verwendet.', $this->text_domain); ?></span>
						<br /><br />
						<label>
							<input type="checkbox" name="rewrite_with_front" value="1" <?php checked( ! isset($_POST['rewrite_with_front']) || ! empty( $_POST['rewrite_with_front'] )); ?> />
							<span class="description"><strong><?php esc_html_e('Front Base zulassen', $this->text_domain); ?></strong></span>
						</label>
						<br />
						<span class="description"><?php esc_html_e('Ermöglichen dass Permalinks mit der Front Base vorangestellt werden.', $this->text_domain); ?></span>
						<br /><br />
						<label>
							<input type="checkbox" name="rewrite_hierarchical" value="1" <?php checked( !empty( $_POST['rewrite_hierarchical'] ) ); ?> />
							<span class="description"><strong><?php esc_html_e('Hierarchische URLs', $this->text_domain); ?></strong></span>
						</label>
						<br />
						<span class="description"><?php esc_html_e('Hierarchische URLs zulassen. Anwendbar für hierarchische Taxonomien.', $this->text_domain); ?></span>
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
							<input type="checkbox" name="ep_mask[EP_NONE]" value="<?php echo EP_NONE; ?>" <?php checked( $_POST['ep_mask']['EP_NONE'] & EP_NONE, EP_NONE); ?> />
							<span class="description"><strong><?php esc_html_e('EP_NONE: Standardmäßig nichts.', $this->text_domain); ?></strong></span>
						</label>
						<br />
							<input type="hidden" name="ep_mask[EP_PERMALINK]" value="0" />
						<label>
							<input type="checkbox" name="ep_mask[EP_PERMALINK]" value="<?php echo EP_PERMALINK; ?>" <?php checked( $_POST['ep_mask']['EP_PERMALINK'] & EP_PERMALINK, EP_PERMALINK ); ?> />
							<span class="description"><strong><?php esc_html_e('EP_PERMALINK: für Permalink.', $this->text_domain); ?></strong></span>
						</label>
						<br />
							<input type="hidden" name="ep_mask[EP_ATTACHMENT]" value="0" />
						<label>
							<input type="checkbox" name="ep_mask[EP_ATTACHMENT]" value="<?php echo EP_ATTACHMENT; ?>" <?php checked( $_POST['ep_mask']['EP_ATTACHMENT'] & EP_ATTACHMENT, EP_ATTACHMENT); ?> />
							<span class="description"><strong><?php esc_html_e('EP_ATTACHMENT: für Anhänge.', $this->text_domain); ?></strong></span>
						</label>
						<br />
							<input type="hidden" name="ep_mask[EP_DATE]" value="0" />
						<label>
							<input type="checkbox" name="ep_mask[EP_DATE]" value="<?php echo EP_DATE; ?>" <?php checked( $_POST['ep_mask']['EP_DATE'] & EP_DATE, EP_DATE); ?> />
							<span class="description"><strong><?php esc_html_e('EP_DATE: für Datum.', $this->text_domain); ?></strong></span>
						</label>
						<br />
							<input type="hidden" name="ep_mask[EP_YEAR]" value="0" />
						<label>
							<input type="checkbox" name="ep_mask[EP_YEAR]" value="<?php echo EP_YEAR; ?>" <?php checked( $_POST['ep_mask']['EP_YEAR'] & EP_YEAR, EP_YEAR); ?> />
							<span class="description"><strong><?php esc_html_e('EP_YEAR: für YJahr.', $this->text_domain); ?></strong></span>
						</label>
						<br />
							<input type="hidden" name="ep_mask[EP_MONTH]" value="0" />
						<label>
							<input type="checkbox" name="ep_mask[EP_MONTH]" value="<?php echo EP_MONTH; ?>" <?php checked( $_POST['ep_mask']['EP_MONTH'] & EP_MONTH, EP_MONTH); ?> />
							<span class="description"><strong><?php esc_html_e('EP_MONTH: für Monat.', $this->text_domain); ?></strong></span>
						</label>
						<br />
							<input type="hidden" name="ep_mask[EP_DAY]" value="0" />
						<label>
							<input type="checkbox" name="ep_mask[EP_DAY]" value="<?php echo EP_DAY; ?>" <?php checked( $_POST['ep_mask']['EP_DAY'] & EP_DAY, EP_DAY); ?> />
							<span class="description"><strong><?php esc_html_e('EP_DAY: für Tag.', $this->text_domain); ?></strong></span>
						</label>
						<br />
							<input type="hidden" name="ep_mask[EP_ROOT]" value="0" />
						<label>
							<input type="checkbox" name="ep_mask[EP_ROOT]" value="<?php echo EP_ROOT; ?>" <?php checked( $_POST['ep_mask']['EP_ROOT'] & EP_ROOT, EP_ROOT); ?> />
							<span class="description"><strong><?php esc_html_e('EP_ROOT: für Root.', $this->text_domain); ?></strong></span>
						</label>
						<br />
							<input type="hidden" name="ep_mask[EP_COMMENTS]" value="0" />
						<label>
							<input type="checkbox" name="ep_mask[EP_COMMENTS]" value="<?php echo EP_COMMENTS; ?>" <?php checked( $_POST['ep_mask']['EP_COMMENTS'] & EP_COMMENTS, EP_COMMENTS); ?> />
							<span class="description"><strong><?php esc_html_e('EP_COMMENTS: für Kommentar.', $this->text_domain); ?></strong></span>
						</label>
						<br />
							<input type="hidden" name="ep_mask[EP_SEARCH]" value="0" />
						<label>
							<input type="checkbox" name="ep_mask[EP_SEARCH]" value="<?php echo EP_SEARCH; ?>" <?php checked( $_POST['ep_mask']['EP_SEARCH'] & EP_SEARCH, EP_SEARCH); ?> />
							<span class="description"><strong><?php esc_html_e('EP_SEARCH: für Suche.', $this->text_domain); ?></strong></span>
						</label>
						<br />
							<input type="hidden" name="ep_mask[EP_CATEGORIES]" value="0" />
						<label>
							<input type="checkbox" name="ep_mask[EP_CATEGORIES]" value="<?php echo EP_CATEGORIES; ?>" <?php checked( $_POST['ep_mask']['EP_CATEGORIES'] & EP_CATEGORIES, EP_CATEGORIES); ?> />
							<span class="description"><strong><?php esc_html_e('EP_CATEGORIES: für Kategorien.', $this->text_domain); ?></strong></span>
						</label>
						<br />
							<input type="hidden" name="ep_mask[EP_TAGS]" value="0" />
						<label>
							<input type="checkbox" name="ep_mask[EPEP_TAGS_DAY]" value="<?php echo EP_TAGS; ?>" <?php checked( $_POST['ep_mask']['EP_TAGS'] & EP_TAGS, EP_TAGS); ?> />
							<span class="description"><strong><?php esc_html_e('EP_TAGS: für Tags.', $this->text_domain); ?></strong></span>
						</label>
						<br />
							<input type="hidden" name="ep_mask[EP_AUTHORS]" value="0" />
						<label>
							<input type="checkbox" name="ep_mask[EP_AUTHORS]" value="<?php echo EP_AUTHORS; ?>" <?php checked( $_POST['ep_mask']['EP_AUTHORS'] & EP_AUTHORS, EP_AUTHORS); ?> />
							<span class="description"><strong><?php esc_html_e('EP_AUTHORS: für Autoren.', $this->text_domain); ?></strong></span>
						</label>
						<br />
							<input type="hidden" name="ep_mask[EP_PAGES]" value="0" />
						<label>
							<input type="checkbox" name="ep_mask[EP_PAGES]" value="<?php echo EP_PAGES; ?>" <?php checked( $_POST['ep_mask']['EP_PAGES'] & EP_PAGES, EP_PAGES); ?> />
							<span class="description"><strong><?php esc_html_e('EP_PAGES: für Seiten.', $this->text_domain); ?></strong></span>
						</label>
						<br />
							<input type="hidden" name="ep_mask[EP_ALL]" value="0" />
						<label>
							<input type="checkbox" name="ep_mask[EP_ALL]" value="<?php echo EP_ALL; ?>" <?php checked( $_POST['ep_mask']['EP_ALL'] & EP_ALL, EP_ALL); ?> />
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
						<p><span class="description"><?php esc_html_e('Name der Abfragevariablen, die für diesen Beitragstyp verwendet werden soll. Falsch, um Abfragen zu verhindern. Standardmäßig wird der Name des Taxonomiesystems als Abfragevariable verwendet.', $this->text_domain); ?></span></p>
						<label>
							<input type="radio" name="query_var" value="1" <?php checked( empty($_POST['query_var']) || (isset( $_POST['query_var'] ) && $_POST['query_var'] === '1')); ?> />
							<span class="description"><strong><?php esc_html_e('WAHR', $this->text_domain); ?></strong></span>
						</label>
						<br />
						<label>
							<input type="radio" name="query_var" value="0" <?php checked( ! empty($_POST['query_var']) || (isset( $_POST['query_var'] ) && $_POST['query_var'] === '0')); ?> />
							<span class="description"><strong><?php esc_html_e('FALSCH', $this->text_domain); ?></strong></span>
						</label>
						<br /><br />
						<span class="description"><strong><?php esc_html_e('Benutzerdefinierter Abfrageschlüssel', $this->text_domain); ?></strong></span>
						<br />
						<input type="text" name="query_var_key" value="<?php if ( !empty( $_POST['query_var_key'] ) ) echo esc_attr( $_POST['query_var_key'] ); ?>" />
						<br />
						<span class="description"><?php esc_html_e('Benutzerdefinierter Abfrage-Var-Schlüssel.', $this->text_domain); ?></span>
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
						<span class="description"><?php esc_html_e('Aktiviere die REST-API-Unterstützung für diese Taxonomie. Dies ist erforderlich, um im Gutenberg-Editor angezeigt zu werden.', $this->text_domain); ?></span>						
					</td>
				</tr>
				<tr>
					<th></th>
					<td>
						<label>
							<input type="radio" name="show_in_rest" value="1" <?php checked( !isset($_POST['show_in_rest']) || ! empty($_POST['show_in_rest'])); ?> />
							<span class="description"><strong><?php esc_html_e('WAHR', $this->text_domain); ?></strong></span>
						</label>
						<br />
						<label>
							<input type="radio" name="show_in_rest" value="0" <?php checked(isset($_POST['show_in_rest']) && empty($_POST['show_in_rest'])); ?> />
							<span class="description"><strong><?php esc_html_e('FALSCH', $this->text_domain); ?></strong></span>
						</label>
						<br /><br />
						<span class="description"><strong><?php esc_html_e('REST API Base', $this->text_domain); ?></strong></span>
						<br />
						<input type="text" name="rest_base" value="<?php if ( !empty( $_POST['rest_base'] ) ) echo esc_attr( $_POST['rest_base'] ); ?>" />
						<br />
						<span class="description"><?php esc_html_e('Benutzerdefinierter Abfrage-Var-Schlüssel.', $this->text_domain); ?></span>
					</td>
				</tr>
			</table>
		</div>

	</div>
	<div class="clear"></div>
	<p class="submit">
		<?php wp_nonce_field('submit_taxonomy'); ?>
		<input type="submit" class="button-primary" name="submit" value="<?php esc_html_e('Taxonomietyp hinzufügen', $this->text_domain); ?>" />
	</p>
	<br /><br /><br /><br />
</form>
