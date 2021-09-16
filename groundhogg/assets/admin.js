WLM3ThirdPartyIntegration.groundhogg.fxn = {
	/**
	 * check if groundhogg plugin exists
	 */
	check_plugin: function() {
		var c = $('#thirdparty-provider-container-groundhogg');
		c.find('.plugin-status').html('<div class="text-warning"><p><em>Checking Groundhogg Platform plugin...</em></p></div>');
		$.post(
			WLM3VARS.ajaxurl, {
				action: 'wlm3_groundhogg_check_plugin',
			},
			function(result) {
				if (result.status) {
					c.removeClass('api-fail');
					c.find('.plugin-status').html('<div class="text-success"><p>' + result.message + '</p></div>');

					WLM3ThirdPartyIntegration.groundhogg.tags = result.tags;
					WLM3ThirdPartyIntegration.groundhogg.fxn.prep_options();
					c.find('.plugin-status').hide();
				} else {
					c.addClass('api-fail');
					c.find('.plugin-status').html('<div class="text-danger"><p>' + result.message + '</p></div>');
				}
			},
			'json'
		);
	},
	/**
	 * prepare dropdown options
	 */
	prep_options: function() {
		var tags = WLM3ThirdPartyIntegration.groundhogg.tags;
		var levels = all_levels.__levels__ ? all_levels.__levels__ : [];

		WLM3ThirdPartyIntegration.groundhogg.tags_options = '';
		$.each(tags, function(index, tag) {
			WLM3ThirdPartyIntegration.groundhogg.tags_options += '<option value="' + index + '">' + tag + '</option>';
		});

		WLM3ThirdPartyIntegration.groundhogg.levels_options = '';
		$.each(levels, function(index, lvl) {
			WLM3ThirdPartyIntegration.groundhogg.levels_options += '<option value="' + index + '">' + lvl.name + '</option>';
		});
	},
	/**
	 * Set dropdown options
	 * @param  object t DOM object
	 */
	set_options: function(t) {
		var selects_tags = $(t).find('select.groundhogg-tags-select');
		selects_tags.html(WLM3ThirdPartyIntegration.groundhogg.tags_options);
		var selects_levels = $(t).find('select.groundhogg-levels-select');
		selects_levels.html(WLM3ThirdPartyIntegration.groundhogg.levels_options);

		$(t).set_form_data(WLM3ThirdPartyIntegration.groundhogg);

		selects_tags.select2({theme: 'bootstrap' });
		selects_levels.select2({theme: 'bootstrap' });

		var selects = $(t).find('.groundhogg-levels-select-ppp');
		selects.empty();
		$.each(all_levels, function(index, lvls) {
			if (index != '__levels__') {
				$.each(lvls, function(index, lvl) {
						selects.append($('<option />', {
							value: lvl.ID,
							text: lvl.name
						}));
				});
			}
		});

		$(t).find('select.groundhogg-levels-select-ppp').select2({
			ajax: {
				url: WLM3VARS.ajaxurl,
				dataType: 'json',
				delay: 500,
				type: 'POST',
				data: function(params) {
					return {
						search: params.term || '',
						page: params.page || 0,
						page_limit: 16,
						action: 'admin_actions',
						WishListMemberAction: 'payperpost_search',
					};
				},
				processResults: function(data) {
					var arr = []
					$.each(data.posts, function(index, value) {
						arr.push({
							id: value.ID,
							text: value.post_title
						})
					})
					var more = (data.page * data.page_limit) < data.total;
					return {
						results: arr,
						pagination: {
							more: more
						}
					};
				},
				cache: true
			},
			minimumInputLength: 1,
			placeholder: wlm.translate('Search for Pay Per Post Content'),
			theme: 'bootstrap',
		});
	},
	/**
	 * set all event handlers
	 */
	set_event_handlers: function() {
		this.tag_action_events();
	},
	/**
	 * set events for tag actions
	 */
  tag_action_events: function() {
		var t = $('#groundhogg-tag-table');

    // tag action delete button
		$(t).find('.popover.-confirm-popover').remove();
    $(t).find('.-del-tag-btn').removeClass('do-confirm-set');
    $(t).find('.-del-tag-btn').do_confirm({
      confirm_message: wlm.translate('Delete tag action?'),
      yes_button: wlm.translate('Delete')
    }).on('yes.do_confirm', {
      that: this
    }, (e) => {
			var tag_id = $(e.target).data('tag-id');
			$.post(
				WLM3VARS.ajaxurl,
				{
					action: 'wishlistmember_groundhogg_delete_tag_action',
					tag_id: tag_id
				},
				(r) => {
					if(r.success) {
						delete WLM3ThirdPartyIntegration.groundhogg.groundhogg_settings.tag[tag_id];
						groundhogg_load_tags_table();
					} else {
						$('.wlm-message-holder').show_message({
	            type: 'error',
	            message: wlm.translate( 'An error occured trying to delete the action.' )
	          });
					}
				}
			);
		} );
		
		// turn off events for our namespace to prevent duplicate event handlers from being set
		$('body').off('.groundhogg-tag-events');
		
		/**
		 * show actions on tag select change
		 * @param  object e Event object
		 */
		$('body').on('change.groundhogg-tag-events', '#groundhogg-tag-id-select', (e) => {
			$('#groundhogg-tag-actions').show();
			$('#groundhogg-tag-modal').data('tag-id', $(e.target).val());
		} );
		
		/**
		 * populate fields and set values on show of tag action modal
		 * @param  object e Event object
		 */
		$('body').on('show.bs.modal.groundhogg-tag-events', (e) => {
			if( !e.target.id.match( /^groundhogg/ ) ) {
				return;
			}
			if( $(e.target)[0].id == 'groundhogg-tag-modal' ) {
				// populate tag action modal values
				this.set_options(e.target);
				var modal = $(e.target);
				var tag_id = $(e.relatedTarget).data('tag-id');
				modal.data('tag-id', tag_id);
				var is_new = tag_id == 'new';
				var tag_id_select = modal.find('#groundhogg-tag-id-select').first();
				if(is_new) {
					tag_id_select.find('option').each((x,o) => {
						try {
							if(o.value in WLM3ThirdPartyIntegration.groundhogg.groundhogg_settings.tag) {
								$(o).remove();
							}
						} catch(e) {}
					});
				}
				tag_id_select.val(tag_id).prop('disabled', !is_new).trigger('change');
				if(!tag_id_select.val()) {
					$('#groundhogg-tag-actions').hide();
				}
				this.set_tag_action_values();
			} else {
				// other modals
				this.set_options(e.target);
			}
		} );
	},
	
	/**
	 * set values for fields inside of tag action modal
	 */
	set_tag_action_values: function() {
		try {
			$('#groundhogg-tag-actions').set_form_data(WLM3ThirdPartyIntegration.groundhogg.groundhogg_settings.tag[$('#groundhogg-tag-modal').data('tag-id')]);
		} catch(e) {}
	}
	
}

/**
 * run stuff before the integration screen is opened
 * @param object obj integration screen DOM object
 */
integration_before_open['groundhogg'] = (obj) => {
	WLM3ThirdPartyIntegration.groundhogg.fxn.check_plugin();
	$(obj).addClass('api-fail');
	$(obj).transformers();
}

/**
 * run stuff after the integration screen is opened
 * @param object obj integration screen DOM object
 */
integration_after_open['groundhogg'] = (obj) => {
	WLM3ThirdPartyIntegration.groundhogg.fxn.check_plugin();
	WLM3ThirdPartyIntegration.groundhogg.fxn.set_event_handlers();
}

/**
 * run stuff when an integration modal is saved
 * @param object obj modal DOM object
 */
integration_modal_save['groundhogg'] = (obj) => {
	// tag actions modal
	if(obj[0].id == 'groundhogg-tag-modal') {
		groundhogg_load_tags_table(); // reload table
		WLM3ThirdPartyIntegration.groundhogg.fxn.set_tag_action_values(); // reload modal values
		$('#groundhogg-tag-id-select').prop('disabled', true).trigger('change'); // disable the tag dropdown
	}
}