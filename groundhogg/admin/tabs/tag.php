<div id="groundhogg-tag-table" class="table-wrapper">
	<table class="table table-striped">
		<tbody/>
		<thead>
			<tr>
				<th><?php _e( 'Tags', 'wishlist-member' ); ?></th>
				<th width="80px"></th>
			</tr>
		</thead>
		<tfoot>
		  <tr>
				<td colspan="10">
				  <p><?php _e( 'No tag actions found.', 'wishlist-member' ); ?></p>
				</td>
		  </tr>
		  <tr>
				<td colspan="10" class="text-center pt-3">
				  <a href="#groundhogg-tag-modal" data-toggle="modal" data-tag-id="new" class="btn -success -condensed"><i class="wlm-icons">add</i><?php _e( 'Add Tag Action', 'wishlist-member' ); ?></a>
				</td>
		  </tr>
		</tfoot>
	</table>
</div>
<script type="text/template" id="groundhogg-tag-template">
	{% _.each(data.tag_ids || [], function(tag_id) { %}
		<tr class="button-hover">
			<td><a href="#" data-toggle="modal" data-target="#groundhogg-tag-modal" data-tag-id="{%- tag_id %}">{%= data.tags[tag_id].title %}</a></td>
			<td class="text-right">
				<div class="btn-group-action">
					<a href="#" data-toggle="modal" data-target="#groundhogg-tag-modal" data-tag-id="{%- tag_id %}" class="btn -tag-btn" title="<?php _e( 'Edit Tag Actions', 'wishlist-member' ); ?>"><i class="wlm-icons md-24">edit</i></a>
					<a href="#" data-tag-id="{%- tag_id %}" class="btn -del-tag-btn" title="<?php _e( 'Delete Tag Actions', 'wishlist-member' ); ?>"><i class="wlm-icons md-24">delete</i></a>
				</div>
			</td>
		</tr>
	{% }); %}
</script>

<script type="text/javascript">
function groundhogg_load_tags_table() {
	var tmpl = _.template($('script#groundhogg-tag-template').html(), {variable: 'data'});
	var data = {
		tags : <?php echo wp_json_encode( $tags ); ?>,
		tag_ids : Object.keys( WLM3ThirdPartyIntegration.groundhogg.groundhogg_settings.tag || [] )
	}
	$('#groundhogg-tag-table table tbody').empty().append(tmpl(data).trim());
	WLM3ThirdPartyIntegration.groundhogg.fxn && WLM3ThirdPartyIntegration.groundhogg.fxn.tag_action_events();
}
groundhogg_load_tags_table();
</script>
