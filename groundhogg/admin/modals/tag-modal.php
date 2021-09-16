<div data-process="modal" id="groundhogg-tag-modal-template" data-id="groundhogg-tag-modal" data-label="groundhogg-tag-modal"
	data-title="Editing Tag Actions <span></span>" data-show-default-footer="1" data-classes="modal-lg modal-groundhogg-actions" style="display:none">
	<div class="body">
		<div class="row form-group">
			<input type="hidden" name="parent_keys[]" value="groundhogg_settings">
			<input type="hidden" name="parent_keys[]" value="tag">
			<label class="col-auto col-form-label"><?php _e( 'Tag', 'wishlist-member' ); ?></label>
			<div class="col">
				<select id="groundhogg-tag-id-select" class="form-control wlm-select groundhogg-tags-select" name="parent_keys[]" data-placeholder="<?php _e( 'Select a Tag', 'wishlist-member' ); ?>" style="width: 100%;"></select>
			</div>
		</div>
		<div id="groundhogg-tag-actions">
			<ul class="nav nav-tabs">
			<li class="active nav-item"><a class="nav-link" data-toggle="tab" href="#groundhogg-tag-add"><?php _e( 'When this Tag is Applied', 'wishlist-member' ); ?></a></li>
			<li class="nav-item"><a class="nav-link" data-toggle="tab" href="#groundhogg-tag-remove"><?php _e( 'When this Tag is Removed', 'wishlist-member' ); ?></a></li>
			</ul>
			<div class="tab-content">
		<?php $c_actions = array( 'add', 'remove' ); ?>
		<?php foreach ( $c_actions as $action ) : ?>
		<div class="tab-pane <?php echo $action == 'add' ? 'active in' : ''; ?>" id="groundhogg-tag-<?php echo $action; ?>">
			<div class="horizontal-tabs">
				<div class="row no-gutters">
					<div class="col-12 col-md-auto">
						<!-- Nav tabs -->
						<div class="horizontal-tabs-sidebar" style="min-width: 120px;">
							<ul class="nav nav-tabs -h-tabs flex-column" role="tablist">
								<li role="presentation" class="nav-item">
									<a href="#-<?php echo $action; ?>-groundhoggtag-level" class="nav-link pp-nav-link active" aria-controls="level" role="tab" data-type="level" data-title="Levels"
										data-toggle="tab"><?php _e( 'Levels', 'wishlist-member' ); ?></a>
								</li>
								<li role="presentation" class="nav-item">
									<a href="#-<?php echo $action; ?>-groundhoggtag-ppp" class="nav-link pp-nav-link" aria-controls="ppp" role="tab" data-type="ppp" data-title="Pay Per Post"
										data-toggle="tab"><?php _e( 'Pay Per Post', 'wishlist-member' ); ?></a>
								</li>
							</ul>
						</div>
					</div>
					<div class="col">
						<!-- Tab panes -->
						<div class="tab-content">
							<div role="tabpanel" class="tab-pane active" id="-<?php echo $action; ?>-groundhoggtag-level">
								<div class="col-md-12">
									<div class="form-group">
										<label><?php _e( 'Add to Level', 'wishlist-member' ); ?></label>
										<select class="groundhogg-levels-select" multiple="multiple" data-placeholder="Select levels..." style="width:100%" name="<?php echo $action; ?>[add_level][]"></select>
									</div>
								</div>
								<div class="col-md-12">
									<div class="form-group">
										<label><?php _e( 'Cancel from Level', 'wishlist-member' ); ?></label>
										<select class="groundhogg-levels-select" multiple="multiple" data-placeholder="Select levels..." style="width:100%" name="<?php echo $action; ?>[cancel_level][]"></select>
									</div>
								</div>
								<div class="col-md-12">
									<div class="form-group">
										<label><?php _e( 'Remove from Level', 'wishlist-member' ); ?></label>
										<select class="groundhogg-levels-select" multiple="multiple" data-placeholder="Select levels..." style="width:100%" name="<?php echo $action; ?>[remove_level][]"></select>
									</div>
								</div>
							</div>
							<div role="tabpanel" class="tab-pane" id="-<?php echo $action; ?>-groundhoggtag-ppp">
								<div class="col-md-12">
									<div class="form-group">
										<label><?php _e( 'Add Pay Per Post', 'wishlist-member' ); ?></label>
										<select class="groundhogg-levels-select-ppp" multiple="multiple" data-placeholder="Select Pay Per Posts..." style="width:100%" name="<?php echo $action; ?>[add_ppp][]"></select>
									</div>
								</div>
								<div class="col-md-12">
									<div class="form-group">
										<label><?php _e( 'Remove Pay Per Post', 'wishlist-member' ); ?></label>
										<select class="groundhogg-levels-select-ppp" multiple="multiple" data-placeholder="Select Pay Per Posts..." style="width:100%" name="<?php echo $action; ?>[remove_ppp][]"></select>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<?php endforeach; ?>
	</div>
		</div>
	</div>
</div>
