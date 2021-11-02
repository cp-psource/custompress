<?php if (!defined('ABSPATH')) die('Kein direkter Zugriff erlaubt!'); ?>

<?php

$taxonomies = array();
if(is_multisite()) {

	if($this->display_network_content || is_network_admin() ){
		$cf = get_site_option('ct_custom_taxonomies');
		$taxonomies['net'] = (empty($cf)) ? array() : $cf;
	}
	if($this->enable_subsite_content_types && ! is_network_admin() ){
		$cf = get_option('ct_custom_taxonomies');
		$taxonomies['local'] = (empty($cf)) ? array() : $cf;
	}
} else {
	$cf = get_option('ct_custom_taxonomies');
	$taxonomies['local'] = (empty($cf)) ? array() : $cf;
}

?>

<?php $this->render_admin('update-message'); ?>

<form action="#" method="post" class="ct-form-single-btn">
	<input type="submit" class="button-secondary" name="redirect_add_taxonomy" value="<?php esc_attr_e('Taxonomie hinzufügen', $this->text_domain); ?>" />
</form>
<table class="widefat">
	<thead>
		<tr>
			<th><?php esc_html_e('Taxonomie', $this->text_domain); ?></th>
			<th><?php esc_html_e('Name', $this->text_domain); ?></th>
			<th><?php esc_html_e('Beitragstypen', $this->text_domain); ?></th>
			<th><?php esc_html_e('Öffentlich', $this->text_domain); ?></th>
			<th><?php esc_html_e('Hierarchisch', $this->text_domain); ?></th>
			<th><?php esc_html_e('Umschreiben', $this->text_domain); ?></th>
		</tr>
	</thead>
	<tfoot>
		<tr>
			<th><?php esc_html_e('Taxonomie', $this->text_domain); ?></th>
			<th><?php esc_html_e('Name', $this->text_domain); ?></th>
			<th><?php esc_html_e('Beitragstypen', $this->text_domain); ?></th>
			<th><?php esc_html_e('Öffentlich', $this->text_domain); ?></th>
			<th><?php esc_html_e('Hierarchisch', $this->text_domain); ?></th>
			<th><?php esc_html_e('Umschreiben', $this->text_domain); ?></th>
		</tr>
	</tfoot>
	<tbody>

		<?php
		foreach($taxonomies as $source => $tax):
		$flag = ($source == 'net') && ! is_network_admin();
		?>
		<?php $i = 0; foreach ( $tax as $name => $taxonomy ): ?>
		<?php $class = ( $i % 2) ? 'ct-edit-row alternate' : 'ct-edit-row'; $i++; ?>
		<tr class="<?php echo ( $class ); ?>">
			<td>
				<strong>
					<?php
					if($flag):
					echo $name;
					else:
					?>

					<a href="<?php echo esc_url( self_admin_url('admin.php?page=' . $_GET['page'] . '&ct_content_type=taxonomy&ct_edit_taxonomy=' . $name) ); ?>"><?php echo esc_html( $name ); ?></a>
					<?php endif; ?>

				</strong>
				<div class="row-actions" id="row-actions-<?php echo $name; ?>">
					<?php if(! $flag): ?>

					<span class="edit">
						<a title="<?php esc_attr_e('Bearbeite diese Taxonomie', $this->text_domain); ?>" href="<?php echo esc_url(self_admin_url( 'admin.php?page=' . $_GET['page'] . '&ct_content_type=taxonomy&ct_edit_taxonomy=' . $name ) ); ?>" ><?php esc_attr_e('Bearbeiten', $this->text_domain); ?></a> |
					</span>
					<?php endif; ?>

					<span>
						<a title="<?php esc_attr_e('Einbettungscode anzeigen', $this->text_domain); ?>" href="" onclick="javascript:content_types.toggle_embed_code('<?php echo esc_html( $name ); ?>'); return false;"><?php esc_attr_e('Einbettungscode', $this->text_domain); ?></a>
					</span>

					<?php if($flag): ?>
					<span class="description"><?php esc_html_e('In Netzwerkadministration bearbeiten.', $this->text_domain); ?></span>
					<?php endif; ?>

					<?php if(! $flag): ?>
					<span class="trash">
						| <a class="submitdelete" href="" onclick="javascript:content_types.toggle_delete('<?php echo esc_html( $name ); ?>'); return false;"><?php esc_html_e('Löschen', $this->text_domain); ?></a>
					</span>
					<?php endif; ?>
				</div>
				<form action="#" method="post" id="form-<?php echo( $name ); ?>" class="del-form">
					<?php wp_nonce_field('delete_taxonomy'); ?>
					<input type="hidden" name="taxonomy_name" value="<?php echo esc_html( $name ); ?>" />
					<input type="submit" class="button confirm" value="<?php esc_attr_e( 'Bestätigen', $this->text_domain ); ?>" name="submit" />
					<input type="submit" class="button cancel"  value="<?php esc_attr_e( 'Abbrechen', $this->text_domain ); ?>" onClick="content_types.cancel('<?php echo( $name ); ?>'); return false;" />
				</form>
			</td>
			<td><?php if ( isset( $taxonomy['args']['labels']['name'] ) ) echo esc_html( $taxonomy['args']['labels']['name'] ); ?></td>
			<td>
				<?php foreach( $taxonomy['object_type'] as $object_type ): ?>
				<?php echo esc_html( $object_type ); ?>
				<?php endforeach; ?>
			</td>
			<td class="ct-tf-icons-wrap">
				<?php if ( ! isset( $taxonomy['args']['public'] ) ): ?>
				<img class="ct-tf-icons" src="<?php echo esc_attr( $this->plugin_url . 'ui-admin/images/advanced.png' ); ?>" alt="<?php esc_attr_e('Erweitert', $this->text_domain); ?>" title="<?php esc_attr_e('Erweitert', $this->text_domain); ?>" />
				<?php elseif ( $taxonomy['args']['public'] ): ?>
				<img class="ct-tf-icons" src="<?php echo esc_attr( $this->plugin_url . 'ui-admin/images/true.png' ); ?>" alt="<?php esc_attr_e('Wahr', $this->text_domain); ?>" title="<?php esc_attr_e('Wahr', $this->text_domain); ?>" />
				<?php else: ?>
				<img class="ct-tf-icons" src="<?php echo esc_attr( $this->plugin_url . 'ui-admin/images/false.png' ); ?>" alt="<?php esc_attr_e('Falsch', $this->text_domain); ?>" title="<?php esc_attr_e('Falsch', $this->text_domain); ?>" />
				<?php endif; ?>
			</td>
			<td class="ct-tf-icons-wrap">
				<?php if ( $taxonomy['args']['hierarchical'] ): ?>
				<img class="ct-tf-icons" src="<?php echo esc_attr( $this->plugin_url . 'ui-admin/images/true.png' ); ?>" alt="<?php esc_attr_e('Wahr', $this->text_domain); ?>" title="<?php esc_attr_e('Wahr', $this->text_domain); ?>" />
				<?php else: ?>
				<img class="ct-tf-icons" src="<?php echo esc_attr( $this->plugin_url . 'ui-admin/images/false.png' ); ?>" alt="<?php esc_attr_e('Falsch', $this->text_domain); ?>" title="<?php esc_attr_e('Falsch', $this->text_domain); ?>" />
				<?php endif; ?>
			</td>
			<td class="ct-tf-icons-wrap">
				<?php if ( $taxonomy['args']['rewrite'] ): ?>
				<img class="ct-tf-icons" src="<?php echo esc_attr( $this->plugin_url . 'ui-admin/images/true.png' ); ?>" alt="<?php esc_attr_e('Wahr', $this->text_domain); ?>" title="<?php esc_attr_e('Wahr', $this->text_domain); ?>" />
				<?php else: ?>
				<img class="ct-tf-icons" src="<?php echo esc_attr( $this->plugin_url . 'ui-admin/images/false.png' ); ?>" alt="<?php esc_attr_e('Falsch', $this->text_domain); ?>" title="<?php esc_attr_e('Falsch', $this->text_domain); ?>" />
				<?php endif; ?>
			</td>
		</tr>
		<tr id="embed-code-<?php echo( $name ); ?>" class="embed-code <?php echo ( $class ); ?>">
			<td colspan="6">
				<div class="embed-code-wrap">
					<span class="description"><?php esc_html_e('Einbettungscode gibt eine HTML-Zeichenfolge mit Taxonomiebegriffen zurück, die einem Beitrag und einer bestimmten Taxonomie zugeordnet sind.<br />Begriffe sind mit den jeweiligen Seiten der Begriffsliste verknüpft. Verwende es in Vorlagen innerhalb der Schleife.', $this->text_domain ); ?></span>
					<br />
					<code><span style="color:red">&lt;?php</span> echo <strong>do_shortcode('[tax id="<?php echo( $name ); ?>" before="your text before " separator=", " after=" your text after"]')</strong>; <span style="color:red">?&gt;</span></code>
					<br /><br />
					<span class="description"><?php esc_html_e('Der Shortcode gibt eine HTML-Zeichenfolge mit Taxonomiebegriffen zurück, die einem Beitrag und einer bestimmten Taxonomie zugeordnet sind.<br />Begriffe sind mit den jeweiligen Seiten der Begriffsliste verknüpft. Verwende es in der Schleife.', $this->text_domain ); ?></span>
					<br />
					<code><strong>[tax id="<?php echo( $name ); ?>" before="your text before: " separator=", " after=" your text after"]</strong></code>
				</div>
			</td>
		</tr>
		<?php endforeach; ?>
		<?php endforeach; ?>
	</tbody>
</table>
<form action="#" method="post" class="ct-form-single-btn">
	<input type="submit" class="button-secondary" name="redirect_add_taxonomy" value="<?php esc_attr_e('Taxonomie hinzufügen', $this->text_domain); ?>" />
</form>
