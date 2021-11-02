<?php if (!defined('ABSPATH')) die('Kein direkter Zugriff erlaubt!'); ?>

<?php
$post_types = get_post_types('','names');

if ( isset( $_GET['ct_add_taxonomy'] ) ) {
	$action = 'add';
	$taxonomy = $_POST;
}
elseif ( isset ( $_GET['ct_edit_taxonomy'] ) ) {
	$action = 'edit';
	$taxonomy = $this->taxonomies[$_GET['ct_edit_taxonomy']]['args'];
	$taxonomy['taxonomy'] = $_GET['ct_edit_taxonomy'];
}

//var_dump( $taxonomy );
?>

<h3><?php _e('Add Taxonomy', $this->text_domain); ?></h3>
<form action="#" method="post" class="ct-taxonomy">
	<div class="ct-wrap-left">
		<div class="ct-table-wrap">
			<div class="ct-arrow"><br></div>
			<h3 class="ct-toggle"><?php _e('Taxonomie', $this->text_domain) ?></h3>
			<table class="form-table <?php do_action('ct_invalid_field_taxonomy'); ?>">
				<tr>
					<th>
						<label for="post_type"><?php _e('Taxonomie', $this->text_domain) ?> <span class="ct-required">( <?php _e('erforderlich', $this->text_domain); ?> )</span></label>
					</th>
					<td>
						<input type="text" name="taxonomy" value="<?php if ( isset( $taxonomy['taxonomy'] ) ) echo $taxonomy['taxonomy']; ?>">
						<span class="description"><?php _e('Der Systemname der Taxonomie. Nur alphanumerische Zeichen und Unterstriche. Min. 2 Buchstaben. Nach dem Hinzufügen kann der Name des Taxonomiesystems nicht mehr geändert werden.', $this->text_domain); ?></span>
					</td>
				</tr>
			</table>
		</div>
		<div class="ct-table-wrap">
			<div class="ct-arrow"><br></div>
			<h3 class="ct-toggle"><?php _e('Beitragstyp', $this->text_domain) ?></h3>
			<table class="form-table <?php do_action('ct_invalid_field_object_type'); ?>">
				<tr>
					<th>
						<label for="object_type"><?php _e('Beitragstyp', $this->text_domain) ?> (<span class="ct-required"> <?php _e('erforderlich', $this->text_domain); ?> </span>)</label>
					</th>
					<td>
						<select name="object_type[]" multiple="multiple" class="ct-object-type">
							<?php if ( is_array( $post_types ) ): ?>
							<?php foreach( $post_types as $post_type ): ?>
							<option value="<?php echo ( $post_type ); ?>"
								<?php if ( $action == 'add' ): ?>
								<?php if ( isset( $taxonomy['object_type'] ) && is_array( $taxonomy['object_type'] ) ): ?>
								<?php foreach ( $taxonomy['object_type'] as $post_value ): ?>
								<?php if ( $post_value == $post_type ) echo 'selected="selected"'; ?>
								<?php endforeach; ?>
								<?php endif; ?>
								<?php elseif ( $action == 'edit' ): ?>
								<?php if ( is_object_in_taxonomy( $post_type, $_GET['ct_edit_taxonomy'] ) ) echo 'selected="selected"'; ?>
								<?php endif; ?>
							><?php echo( $post_type ); ?></option>
							<?php endforeach; ?>
							<?php endif; ?>
						</select>
						<span class="description"><?php _e('Wähle einen oder mehrere Beitragstypen aus, zu denen diese Taxonomie hinzugefügt werden soll.', $this->text_domain); ?></span>
					</td>
				</tr>
			</table>
		</div>
		<div class="ct-table-wrap">
			<div class="ct-arrow"><br></div>
			<h3 class="ct-toggle"><?php _e('Labels', $this->text_domain) ?></h3>
			<table class="form-table">
				<tr>
					<th>
						<label for="name"><?php _e('Name', $this->text_domain) ?></label>
					</th>
					<td>
						<input type="text" name="labels[name]" value="<?php if ( isset( $taxonomy['labels']['name'] ) ) echo $taxonomy['labels']['name']; ?>">
						<span class="description"><?php _e('Allgemeiner Name für die Taxonomie, normalerweise Plural.', $this->text_domain); ?></span>
					</td>
				</tr>
				<tr>
					<th>
						<label for="singular_name"><?php _e('Singular Name', $this->text_domain) ?></label>
					</th>
					<td>
						<input type="text" name="labels[singular_name]" value="<?php if ( isset( $taxonomy['labels']['singular_name']  ) ) echo $taxonomy['labels']['singular_name']; ?>">
						<span class="description"><?php _e('Name für ein Objekt dieser Taxonomie. Der Standardwert ist der Wert des Namens.', $this->text_domain); ?></span>
					</td>
				</tr>
				<tr>
					<th>
						<label for="add_new_item"><?php _e('Füge neues Element hinzu', $this->text_domain) ?></label>
					</th>
					<td>
						<input type="text" name="labels[add_new_item]" value="<?php if ( isset( $taxonomy['labels']['add_new_item'] ) ) echo $taxonomy['labels']['add_new_item']; ?>">
						<span class="description"><?php _e('Text für "Neues Element hinzufügen". Die Standardeinstellung ist "Neues Tag hinzufügen" oder "Neue Kategorie hinzufügen".', $this->text_domain); ?></span>
					</td>
				</tr>
				<tr>
					<th>
						<label for="new_item_name"><?php _e('Neues Element Name', $this->text_domain) ?></label>
					</th>
					<td>
						<input type="text" name="labels[new_item_name]" value="<?php if ( isset( $taxonomy['labels']['new_item_name'] ) ) echo $taxonomy['labels']['new_item_name']; ?>">
						<span class="description"><?php _e('Text für neues Element. Die Standardeinstellung ist "Neuer Tag-Name" oder "Neuer Kategoriename".', $this->text_domain); ?></span>
					</td>
				</tr>
				<tr>
					<th>
						<label for="edit_item"><?php _e('Element bearbeiten', $this->text_domain) ?></label>
					</th>
					<td>
						<input type="text" name="labels[edit_item]" value="<?php if ( isset( $taxonomy['labels']['edit_item'] ) ) echo $taxonomy['labels']['edit_item']; ?>">
						<span class="description"><?php _e('Text für Elementbearbeitung. Die Standardeinstellung ist "Tag bearbeiten" oder "Kategorie bearbeiten".', $this->text_domain); ?></span>
					</td>
				</tr>
				<tr>
					<th>
						<label for="update_item"><?php _e('Element aktualisieren', $this->text_domain) ?></label>
					</th>
					<td>
						<input type="text" name="labels[update_item]" value="<?php if ( isset( $taxonomy['labels']['update_item'] ) ) echo $taxonomy['labels']['update_item']; ?>">
						<span class="description"><?php _e('Text für Elementaktualisierung. Die Standardeinstellung ist "Tag aktualisieren" oder "Kategorie aktualisieren".', $this->text_domain); ?></span>
					</td>
				</tr>
				<tr>
					<th>
						<label for="search_items"><?php _e('Suche Elemente', $this->text_domain) ?></label>
					</th>
					<td>
						<input type="text" name="labels[search_items]" value="<?php if ( isset( $taxonomy['labels']['search_items'] ) ) echo $taxonomy['labels']['search_items']; ?>">
						<span class="description"><?php _e('Text für Elementsuche. Die Standardeinstellung ist "Such-Tags" oder "Suchkategorien".', $this->text_domain); ?></span>
					</td>
				</tr>
				<tr>
					<th>
						<label for="popular_items"><?php _e('Beliebte Elemente', $this->text_domain) ?></label>
					</th>
					<td>
						<input type="text" name="labels[popular_items]" value="<?php if ( isset( $taxonomy['labels']['popular_items'] ) ) echo $taxonomy['labels']['popular_items']; ?>">
						<span class="description"><?php _e('Der beliebte Elemente Text. Die Standardeinstellung ist "Beliebte Tags" oder null.', $this->text_domain); ?></span>
					</td>
				</tr>
				<tr>
					<th>
						<label for="all_items"><?php _e('Alle Elemente', $this->text_domain) ?></label>
					</th>
					<td>
						<input type="text" name="labels[all_items]" value="<?php if ( isset( $taxonomy['labels']['all_items'] ) ) echo $taxonomy['labels']['all_items']; ?>">
						<span class="description"><?php _e('Text für alle Elemente. Die Standardeinstellung ist "Alle Tags" oder "Alle Kategorien".', $this->text_domain); ?></span>
					</td>
				</tr>
				<tr>
					<th>
						<label for="parent_item"><?php _e('Eltern Element', $this->text_domain) ?></label>
					</th>
					<td>
						<input type="text" name="labels[parent_item]" value="<?php if ( isset( $taxonomy['labels']['parent_item'] ) ) echo $taxonomy['labels']['parent_item']; ?>">
						<span class="description"><?php _e('Der übergeordnete Elementtext. Diese Zeichenfolge wird nicht für nicht hierarchische Taxonomien wie Post-Tags verwendet. Die Standardeinstellung ist null oder "Übergeordnete Kategorie".', $this->text_domain); ?></span>
					</td>
				</tr>
				<tr>
					<th>
						<label for="parent_item_colon"><?php _e('Übergeordnetes Element Doppelpunkt', $this->text_domain) ?></label>
					</th>
					<td>
						<input type="text" name="labels[parent_item_colon]" value="<?php if ( isset( $taxonomy['labels']['parent_item_colon'] ) ) echo $taxonomy['labels']['parent_item_colon']; ?>">
						<span class="description"><?php _e('Das gleiche wie parent_item, jedoch mit Doppelpunkt: am Ende null "Elternkategorie:".', $this->text_domain); ?></span>
					</td>
				</tr>
				<tr>
					<th>
						<label for="add_or_remove_items"><?php _e('Elemente hinzufügen oder entfernen', $this->text_domain) ?></label>
					</th>
					<td>
						<input type="text" name="labels[add_or_remove_items]" value="<?php if ( isset( $taxonomy['labels']['add_or_remove_items'] ) ) echo $taxonomy['labels']['add_or_remove_items']; ?>">
						<span class="description"><?php _e('Text zum Hinzufügen oder Entfernen von Elementen wird im Meta-Feld verwendet, wenn JavaScript deaktiviert ist. Diese Zeichenfolge wird in hierarchischen Taxonomien nicht verwendet. Die Standardeinstellung ist "Tags hinzufügen oder entfernen" oder null.', $this->text_domain); ?></span>
					</td>
				</tr>
				<tr>
					<th>
						<label for="separate_items_with_commas"><?php _e('Trenne Elemente mit Kommas', $this->text_domain) ?></label>
					</th>
					<td>
						<input type="text" name="labels[separate_items_with_commas]" value="<?php if ( isset( $taxonomy['labels']['separate_items_with_commas'] ) ) echo $taxonomy['labels']['separate_items_with_commas']; ?>">
						<span class="description"><?php _e('Text für separates Element mit Komma, das im Metafeld Taxonomie verwendet wird. Diese Zeichenfolge wird in hierarchischen Taxonomien nicht verwendet. Die Standardeinstellung ist "Tags durch Kommas trennen" oder null.', $this->text_domain); ?></span>
					</td>
				</tr>
				<tr>
					<th>
						<label for="choose_from_most_used"><?php _e('Wähle aus den am häufigsten verwendeten', $this->text_domain) ?></label>
					</th>
					<td>
						<input type="text" name="labels[choose_from_most_used]" value="<?php if ( isset( $taxonomy['labels']['choose_from_most_used'] ) ) echo $taxonomy['labels']['choose_from_most_used']; ?>">
						<span class="description"><?php _e('Wähle aus dem am häufigsten verwendeten Text, der im Metafeld Taxonomie verwendet wird. Diese Zeichenfolge wird in hierarchischen Taxonomien nicht verwendet. Die Standardeinstellung ist "Aus den am häufigsten verwendeten Tags auswählen" oder null.', $this->text_domain); ?></span>
					</td>
				</tr>
			</table>
		</div>
	</div>
	<div class="ct-wrap-right">
		<div class="ct-table-wrap">
			<div class="ct-arrow"><br></div>
			<h3 class="ct-toggle"><?php _e('Öffentlich', $this->text_domain) ?></h3>
			<table class="form-table publica">
				<tr>
					<th>
						<label for="public"><?php _e('Öffentlich', $this->text_domain) ?></label>
					</th>
					<td>
						<span class="description"><?php _e('Soll diese Taxonomie in der Admin-Benutzeroberfläche verfügbar gemacht werden?', $this->text_domain); ?></span>
					</td>
				</tr>
				<tr>
					<th></th>
					<td>
						<input type="radio" name="public" value="1" <?php if ( isset( $taxonomy['public'] ) && !empty( $taxonomy['public'] ) ) echo 'checked="checked"'; elseif ( !isset( $taxonomy['public'] ) ) echo( 'checked="checked"' ); ?>>
						<span class="description"><strong><?php _e('WAHR', $this->text_domain); ?></strong></span>
						<br />
						<input type="radio" name="public" value="0" <?php if ( isset( $taxonomy['public'] ) && $taxonomy['public'] === '0' ) echo( 'checked="checked"' ); ?>>
						<span class="description"><strong><?php _e('FALSCH', $this->text_domain); ?></strong></span>
						<br />
						<input type="radio" name="public" value="advanced" <?php if ( isset( $taxonomy['public'] ) && $taxonomy['public'] == 'advanced' ) echo( 'checked="checked"' ); ?>>
						<span class="description"><strong><?php _e('ERWEITERT', $this->text_domain); ?></strong></span>
					</td>
				</tr>
			</table>
		</div>
		<div class="ct-table-wrap">
			<div class="ct-arrow"><br></div>
			<h3 class="ct-toggle"><?php _e('Zeige Benutzerinterface', $this->text_domain) ?></h3>
			<table class="form-table show-ui">
				<tr>
					<th>
						<label for="show_ui"><?php _e('Zeige UI', $this->text_domain) ?></label>
					</th>
					<td>
						<span class="description"><?php _e('Gibt an, ob eine Standardbenutzeroberfläche zum Verwalten dieser Taxonomie generiert werden soll.', $this->text_domain); ?></span>
					</td>
				</tr>
				<tr>
					<th></th>
					<td>
						<input type="radio" name="show_ui" value="1" <?php if ( isset( $taxonomy['public'] ) && $taxonomy['public'] == 'advanced' && isset( $taxonomy['show_ui'] ) && $taxonomy['show_ui'] === '1' ) echo( 'checked="checked"' ); ?>>
						<span class="description"><strong><?php _e('WAHR', $this->text_domain); ?></strong></span>
						<br />
						<input type="radio" name="show_ui" value="0" <?php if ( isset( $taxonomy['public'] ) && $taxonomy['public'] == 'advanced' && isset( $taxonomy['show_ui'] ) && $taxonomy['show_ui'] === '0' ) echo( 'checked="checked"' ); ?>>
						<span class="description"><strong><?php _e('FALSCH', $this->text_domain); ?></strong></span>
					</td>
				</tr>
			</table>
		</div>
		<div class="ct-table-wrap">
			<div class="ct-arrow"><br></div>
			<h3 class="ct-toggle"><?php _e('Zeige Tagcloud', $this->text_domain) ?></h3>
			<table class="form-table show_tagcloud">
				<tr>
					<th>
						<label for="show_tagcloud"><?php _e('Zeige Tagcloud', $this->text_domain) ?></label>
					</th>
					<td>
						<span class="description"><?php _e('Gibt an, ob in der Administrator-Benutzeroberfläche eine Tag-Cloud für diese Taxonomie angezeigt werden soll.', $this->text_domain); ?></span>
					</td>
				</tr>
				<tr>
					<th></th>
					<td>
						<input type="radio" name="show_tagcloud" value="1" <?php if ( isset( $taxonomy['public'] ) && $taxonomy['public'] == 'advanced' && isset( $taxonomy['show_tagcloud'] ) && $taxonomy['show_tagcloud'] === '1' ) echo( 'checked="checked"' ); ?>>
						<span class="description"><strong><?php _e('WAHR', $this->text_domain); ?></strong></span>
						<br />
						<input type="radio" name="show_tagcloud" value="0" <?php if ( isset( $taxonomy['public'] ) && $taxonomy['public'] == 'advanced' && isset( $taxonomy['show_tagcloud'] ) && $taxonomy['show_tagcloud'] === '0' ) echo( 'checked="checked"' ); ?>>
						<span class="description"><strong><?php _e('FALSCH', $this->text_domain); ?></strong></span>
					</td>
				</tr>
			</table>
		</div>
		<div class="ct-table-wrap">
			<div class="ct-arrow"><br></div>
			<h3 class="ct-toggle"><?php _e('In Navigationsmenüs anzeigen ', $this->text_domain) ?></h3>
			<table class="form-table show-in-nav-menus">
				<tr>
					<th>
						<label for="show_in_nav_menus"><?php _e('In Navigationsmenüs anzeigen', $this->text_domain) ?></label>
					</th>
					<td>
						<span class="description"><?php _e('Gibt an, ob diese Taxonomie in Navigationsmenüs zur Auswahl gestellt werden soll.', $this->text_domain); ?></span>
					</td>
				</tr>
				<tr>
					<th></th>
					<td>
						<input type="radio" name="show_in_nav_menus" value="1" <?php if ( isset( $taxonomy['public'] ) && $taxonomy['public'] == 'advanced' && isset( $taxonomy['show_in_nav_menus'] ) && $taxonomy['show_in_nav_menus'] === '1' ) echo( 'checked="checked"' ); ?>>
						<span class="description"><strong><?php _e('WAHR', $this->text_domain); ?></strong></span>
						<br />
						<input type="radio" name="show_in_nav_menus" value="0" <?php if ( isset( $taxonomy['public'] ) && $taxonomy['public'] == 'advanced' && isset( $taxonomy['show_in_nav_menus'] ) && $taxonomy['show_in_nav_menus'] === '0' ) echo( 'checked="checked"' ); ?>>
						<span class="description"><strong><?php _e('FALSCH', $this->text_domain); ?></strong></span>
					</td>
				</tr>
			</table>
		</div>
		<div class="ct-table-wrap">
			<div class="ct-arrow"><br></div>
			<h3 class="ct-toggle"><?php _e('Hierarchisch', $this->text_domain) ?></h3>
			<table class="form-table">
				<tr>
					<th>
						<label for="hierarchical"><?php _e('Hierarchisch', $this->text_domain) ?></label>
					</th>
					<td>
						<span class="description"><?php _e('Gibt an, ob der Beitragstyp hierarchisch ist. Ermöglicht die Angabe von Eltern.', $this->text_domain); ?></span>
					</td>
				</tr>
				<tr>
					<th></th>
					<td>
						<input type="radio" name="hierarchical" value="1" <?php if ( isset( $taxonomy['hierarchical'] ) && !empty( $taxonomy['hierarchical'] ) ) echo 'checked="checked"'; ?>>
						<span class="description"><strong><?php _e('WAHR', $this->text_domain); ?></strong></span>
						<br />
						<input type="radio" name="hierarchical" value="0" <?php if ( isset( $taxonomy['hierarchical'] ) && empty( $taxonomy['hierarchical'] ) ) echo 'checked="checked"'; ?>>
						<span class="description"><strong><?php _e('FALSCH', $this->text_domain); ?></strong></span>
					</td>
				</tr>
			</table>
		</div>
		<div class="ct-table-wrap">
			<div class="ct-arrow"><br></div>
			<h3 class="ct-toggle"><?php _e('Umschreiben', $this->text_domain) ?></h3>
			<table class="form-table">
				<tr>
					<th>
						<label for="rewrite"><?php _e('Umschreiben', $this->text_domain) ?></label>
					</th>
					<td>
						<span class="description"><?php _e('Setze diesen Wert auf Falsch, um ein erneutes Schreiben zu verhindern, oder auf Wahr, um ihn anzupassen.', $this->text_domain); ?></span>
					</td>
				</tr>
				<tr>
					<th></th>
					<td>
						<input type="radio" name="rewrite" value="1" <?php if ( isset( $taxonomy['rewrite'] ) && !empty( $taxonomy['rewrite'] ) ) echo 'checked="checked"'; ?>>
						<span class="description"><strong><?php _e('WAHR', $this->text_domain); ?></strong></span>
						<br />
						<span class="description"><?php _e('Standardmäßig wird die Abfrage var verwendet.', $this->text_domain); ?></span>
						<br />
						<input type="radio" name="rewrite" value="0" <?php if ( isset( $taxonomy['rewrite'] ) && empty( $taxonomy['rewrite'] ) ) echo 'checked="checked"'; ?>>
						<span class="description"><strong><?php _e('FALSCH', $this->text_domain); ?></strong></span>
						<br />
						<span class="description"><?php _e('Umschreiben verhindern.', $this->text_domain); ?></span>
						<br /><br />

						<input type="checkbox" name="rewrite_use_slug" value="1" <?php if ( !empty( $taxonomy['rewrite_use_slug'] ) ) echo 'checked="checked"'; ?>>
						<span class="description"><strong><?php _e('Benutzerdefiniertr Slug', $this->text_domain); ?></strong></span>
						<br />
						<input type="text" name="rewrite_slug" value="<?php if ( isset( $taxonomy['rewrite_slug'] ) ) echo $taxonomy['rewrite_slug']; ?>" />
						<br />
						<span class="description"><?php _e('Stelle Beiträgen diesen Slug voran.', $this->text_domain); ?></span>
						<br /><br />
						<input type="checkbox" name="rewrite_disallow_with_front" value="1" <?php if ( !empty( $taxonomy['rewrite_disallow_with_front'] ) ) echo 'checked="checked"'; ?>>
						<span class="description"><strong><?php _e('Front Base nicht zulassen', $this->text_domain); ?></strong></span>
						<br />
						<span class="description"><?php _e('Permalinks dürfen nicht mit der Front Base vorangestellt werden.', $this->text_domain); ?></span>
						<br /><br />
						<input type="checkbox" name="rewrite_hierarchical" value="1" <?php if ( !empty( $taxonomy['rewrite_hierarchical'] ) ) echo 'checked="checked"'; ?>>
						<span class="description"><strong><?php _e('Hierarchische URLs', $this->text_domain); ?></strong></span>
						<br />
						<span class="description"><?php _e('Hierarchische URLs zulassen. Anwendbar für hierarchische Taxonomien.', $this->text_domain); ?></span>
					</td>
				</tr>
			</table>
		</div>
		<div class="ct-table-wrap">
			<div class="ct-arrow"><br></div>
			<h3 class="ct-toggle"><?php _e('Abfrage var', $this->text_domain) ?></h3>
			<table class="form-table">
				<tr>
					<th>
						<label for="query_var"><?php _e('Abfrage var', $this->text_domain) ?></label>
					</th>
					<td>
						<span class="description"><?php _e('Falsch, um Abfragen zu verhindern. Standardmäßig wird der Name des Taxonomiesystems als Abfragevariable verwendet.', $this->text_domain); ?></span>
					</td>
				</tr>
				<tr>
					<th></th>
					<td>
						<input type="radio" name="query_var" value="1" <?php if ( isset( $taxonomy['query_var'] ) && !empty( $taxonomy['query_var'] ) ) { echo( 'checked="checked"' ); } ?>>
						<span class="description"><strong><?php _e('WAHR', $this->text_domain); ?></strong></span>
						<br />
						<input type="radio" name="query_var" value="0" <?php if ( isset( $taxonomy['query_var'] ) && empty( $taxonomy['query_var'] ) ) echo( 'checked="checked"' ); ?>>
						<span class="description"><strong><?php _e('FALSCH', $this->text_domain); ?></strong></span>
					</td>
				</tr>
			</table>
		</div>
	</div>
	<div class="clear"></div>
	<p class="submit">
		<?php wp_nonce_field('submit_taxonomy'); ?>
		<input type="submit" class="button-primary" name="submit" value="Taxonomie hinzufügen">
	</p>
	<br /><br /><br /><br />
</form>
