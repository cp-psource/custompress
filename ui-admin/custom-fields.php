<?php if (!defined('ABSPATH')) die('Kein direkter Zugriff erlaubt!'); ?>

<?php

$custom_fields = array();
if(is_multisite()) {

	if($this->display_network_content || is_network_admin() ){
		$cf = get_site_option('ct_custom_fields');
		$custom_fields['net'] = (empty($cf)) ? array() : $cf;
	}
	if($this->enable_subsite_content_types && ! is_network_admin() ){
		$cf = get_option('ct_custom_fields');
		$custom_fields['local'] = (empty($cf)) ? array() : $cf;
	}
} else {
	$cf = get_option('ct_custom_fields');
	$custom_fields['local'] = (empty($cf)) ? array() : $cf;
}

//Nonce for reorder
$nonce = wp_create_nonce('reorder_custom_fields');

?>

<?php $this->render_admin('update-message'); ?>

<div class="embed-code-wrap">
	<h3><?php esc_html_e('Benutzerdefinierte Felder einbetten', $this->text_domain); ?></h3>
	<span class="description"><?php _e( '<b>Einbettungscodes</b> werden in Vorlagen verwendet, um den Wert der benutzerdefinierten Felder des aktuellen Beitrags zurückzugeben. Codes können für einzelne Felder verwendet werden, indem Du die unten stehenden Links zum Einbetten von Code für jedes Feld verwendest.<br />Du kannst auch den gesamten Block benutzerdefinierter Felder für eine Liste mithilfe des Einbettungscodes anzeigen:', $this->text_domain ); ?></span>
	<br />
	<code><span style="color:red">&lt;?php</span> echo <strong>do_shortcode('[custom_fields_block]')</strong>; <span style="color:red">?&gt;</span></code>
	<br /><br />
	<span class="description"><?php _e( '<b>Shortcodes</b> werden in Beiträgen, Seiten und Widgets verwendet, um den Wert der benutzerdefinierten Felder des aktuellen Posts zurückzugeben. Verwende sie innerhalb der Schleife in Posts und Widgets', $this->text_domain ); ?></span>
	<br />
	<code><strong>[custom_fields_block]</strong></code>
</div>

<form action="#" method="post" class="ct-form-single-btn">
	<input type="submit" class="button-secondary" name="redirect_add_custom_field" value="<?php esc_html_e('Benutzerdefiniertes Feld hinzufügen', $this->text_domain); ?>" />
</form>
<table class="widefat">
	<thead>
		<tr>
			<th><?php esc_html_e('Sortierung', $this->text_domain); ?></th>
			<th><?php esc_html_e('Feldname', $this->text_domain); ?></th>
			<th><?php esc_html_e('Feld ID', $this->text_domain); ?></th>
			<th><?php esc_html_e('WP/Plugins', $this->text_domain); ?></th>
			<th><?php esc_html_e('Feldtyp', $this->text_domain); ?></th>
			<th><?php esc_html_e('Beschreibung', $this->text_domain); ?></th>
			<th><?php esc_html_e('Beitragstypen', $this->text_domain); ?></th>
		</tr>
	</thead>
	<tfoot>
		<tr>
			<th><?php esc_html_e('Sortierung', $this->text_domain); ?></th>
			<th><?php esc_html_e('Feldname', $this->text_domain); ?></th>
			<th><?php esc_html_e('Feld ID', $this->text_domain); ?></th>
			<th><?php esc_html_e('WP/Plugins', $this->text_domain); ?></th>
			<th><?php esc_html_e('Feldtyp', $this->text_domain); ?></th>
			<th><?php esc_html_e('Beschreibung', $this->text_domain); ?></th>
			<th><?php esc_html_e('Beitragstypen', $this->text_domain); ?></th>
		</tr>
	</tfoot>
	<tbody>

		<?php
		foreach($custom_fields as $source => $cf):

		$flag = ($source == 'net') && ! is_network_admin();
		$last = count($cf);
		$i = 0;
		foreach ( $cf as $custom_field ): ?>

		<?php

		$prefix = ( empty( $custom_field['field_wp_allow'] ) ) ? '_ct_' : 'ct_';
		$fid = $prefix . $custom_field['field_id'];
		?>

		<?php $class = ( $i % 2) ? 'ct-edit-row alternate' : 'ct-edit-row'; $i++; ?>
		<tr class="<?php echo ( $class ); ?>">
			<td>

				<?php if($flag): ?>
				<span class="description"><?php esc_html_e('network', $this->text_domain); ?></span>
				<?php endif; ?>
				<?php if($i != 1 && ! $flag): ?>
				<span class="ct-up"><a href="<?php echo esc_url( self_admin_url( 'admin.php?page=' . $_GET['page'] . "&ct_content_type=custom_field&direction=up&_wpnonce=$nonce&ct_reorder_custom_field=" . $custom_field['field_id'] )); ?>"><img src="<?php echo $this->plugin_url . 'ui-admin/images/up.png'; ?>" alt="<?php echo esc_attr('Nach Oben', $this->text_domain); ?>" title="<?php echo esc_attr('Nach Oben', $this->text_domain); ?>"/></a> </span>
				<?php endif; ?>
				<?php if($i != $last && ! $flag): ?>
				<span class="ct-down"><a href="<?php echo esc_url( self_admin_url( 'admin.php?page=' . $_GET['page'] . "&ct_content_type=custom_field&direction=down&_wpnonce=$nonce&ct_reorder_custom_field=" . $custom_field['field_id'] )); ?>"><img src="<?php echo $this->plugin_url . 'ui-admin/images/down.png'; ?>" alt="<?php echo esc_attr('Nach Unten', $this->text_domain); ?>" title="<?php echo esc_attr('Nach Unten', $this->text_domain); ?>"/></a></span>
				<?php endif; ?>
			</td>
			<td>
				<strong>
					<?php
					if($flag):
					echo esc_html( $custom_field['field_title'] );
					else:
					?>
					<a href="<?php echo esc_url( self_admin_url( 'admin.php?page=' . $_GET['page'] . '&ct_content_type=custom_field&ct_edit_custom_field=' . $custom_field['field_id'] )); ?>"><?php echo esc_html( $custom_field['field_title'] ); ?></a>
					<?php endif; ?>

				</strong>
				<div class="row-actions" id="row-actions-<?php echo esc_attr( $custom_field['field_id'] ); ?>" >
					<?php if(! $flag): ?>
					<span class="edit">
						<a title="<?php esc_html_e('Bearbeite dieses benutzerdefinierte Feld', $this->text_domain); ?>" href="<?php echo esc_url( self_admin_url( 'admin.php?page=' . $_GET['page'] . '&ct_content_type=custom_field&ct_edit_custom_field=' . $custom_field['field_id'] ) ); ?>"><?php esc_html_e( 'Bearbeiten', $this->text_domain ); ?></a> |
					</span>
					<?php endif; ?>
					<span>
						<a title="<?php esc_html_e('Einbettungscode anzeigen', $this->text_domain); ?>" href="#" onclick="javascript:content_types.toggle_embed_code('<?php echo esc_js( $custom_field['field_id'] ); ?>'); return false;"><?php esc_html_e('Einbettungscode', $this->text_domain); ?></a>
					</span>

					<?php if($flag): ?>
					<span class="description"><?php esc_html_e('In Netzwerkadministration bearbeiten.', $this->text_domain); ?></span>
					<?php endif; ?>

					<?php if(! $flag): ?>
					<span class="trash">
						| <a class="submitdelete" href="#" onclick="javascript:content_types.toggle_delete('<?php echo esc_js( $custom_field['field_id'] ); ?>'); return false;"><?php esc_html_e( 'Löschen', $this->text_domain ); ?></a>
					</span>
					<?php endif; ?>
				</div>

				<form action="#" method="post" id="form-<?php echo esc_attr( $custom_field['field_id'] ); ?>" class="del-form">
					<?php wp_nonce_field('delete_custom_field'); ?>
					<input type="hidden" name="custom_field_id" value="<?php echo esc_attr( $custom_field['field_id'] ); ?>" />
					<input type="submit" class="button confirm" value="<?php esc_html_e( 'Feld und Werte', $this->text_domain ); ?>" name="delete_cf_values" />
					<input type="submit" class="button cancel"  value="<?php esc_html_e( 'Abbrechen', $this->text_domain ); ?>" onClick="content_types.cancel('<?php esc_js( $custom_field['field_id'] ); ?>'); return false;" />
					<input type="submit" class="button confirm" value="<?php esc_html_e( 'Nur Feld', $this->text_domain ); ?>" name="submit" />
				</form>
			</td>
			<td><?php echo esc_html( $prefix . $custom_field['field_id'] ); ?></td>
			<td><?php echo ( isset( $custom_field['field_wp_allow'] ) && 1 == $custom_field['field_wp_allow'] ) ? __( 'Erlauben', $this->text_domain ) : __( 'Verweigern', $this->text_domain ); ?></td>
			<td><?php echo esc_html( $custom_field['field_type'] ); ?></td>
			<td><?php echo esc_html( $custom_field['field_description'] ); ?></td>
			<td>
				<?php foreach( $custom_field['object_type'] as $object_type ): ?>
				<?php echo esc_html( $object_type ); ?>
				<?php endforeach; ?>
			</td>
		</tr>
		<tr id="embed-code-<?php echo esc_attr( $custom_field['field_id'] ); ?>" class="embed-code <?php echo ( $class ); ?>">
			<td colspan="7">
				<div class="embed-code-wrap">
					<span class="description"><?php esc_html_e( 'Der eingebettete Code gibt die Werte des benutzerdefinierten Felds mit dem angegebenen Schlüssel aus dem angegebenen Beitrag zurück. Die Eigenschaft kann "title", "description", "value", "link" oder "image" sein. Die Eigenschaften "link" und "image" können nur für Upload-Feldtypen verwendet werden. Wenn die Eigenschaft nicht verwendet wird, wird "value" zurückgegeben. Verwendung innerhalb der Schleife in Vorlagen und PHP-Code ', $this->text_domain ); ?></span>
					<br />
					<code><span style="color:red">&lt;?php</span> echo <strong>do_shortcode('[ct id="<?php echo esc_html( $prefix . $custom_field['field_id'] ); ?>" property="title | description | value | link | image"]')</strong>; <span style="color:red">?&gt;</span></code>
					<br /><br />
					<span class="description"><?php esc_html_e( 'Der Shortcode gibt die Werte des benutzerdefinierten Felds mit dem angegebenen Schlüssel aus dem angegebenen Beitrag zurück. Die Eigenschaft kann "title", "description", "value", "link" oder "image" sein. Die Eigenschaften "Link" und "Bild" können nur für Upload-Feldtypen verwendet werden. Wenn die Eigenschaft nicht verwendet wird, wird "value" zurückgegeben. Verwende sie innerhalb der Schleife in Posts und Widgets', $this->text_domain ); ?></span>
					<br />
					<code><strong>[ct id="<?php echo esc_html( $prefix . $custom_field['field_id'] ); ?>" property="title | description | value | link | image"]</strong></code>
				</div>
			</td>
		</tr>
		<?php endforeach; ?>
		<?php endforeach; ?>

	</tbody>
</table>
<form action="#" method="post" class="ct-form-single-btn">
	<input type="submit" class="button-secondary" name="redirect_add_custom_field" value="<?php esc_html_e('Benutzerdefiniertes Feld hinzufügen', $this->text_domain); ?>" />
</form>
