<?php
$level_actions = array(
	'add'    => __( 'When Added', 'wishlist-member' ),
	'cancel' => __( 'When Cancelled', 'wishlist-member' ),
	'remove' => __( 'When Removed', 'wishlist-member' ),
	'rereg'  => __( 'When Re-Registered', 'wishlist-member' ),
);
?>
<?php foreach ( $wpm_levels as $level_id => $level ) : ?>
<div data-process="modal" id="groundhogg-levels-<?php echo $level_id; ?>-template" data-id="groundhogg-levels-<?php echo $level_id; ?>" data-label="groundhogg-levels-<?php echo $level_id; ?>"
	data-title="Editing Level Actions for <strong><?php echo $level['name']; ?></strong>" data-show-default-footer="1" data-classes="modal-lg modal-groundhogg-actions" style="display:none">
	<div class="body">
		<ul class="nav nav-tabs">
			<?php foreach ( $level_actions as $key => $value ) : ?>
			<li class="<?php echo $key == 'add' ? 'active' : ''; ?> nav-item"><a class="nav-link" data-toggle="tab" href="#groundhogg-when-<?php echo $key; ?>-<?php echo $level_id; ?>"><?php echo $value; ?></a></li>
			<?php endforeach; ?>
		</ul>
		<div class="tab-content">
			<?php foreach ( $level_actions as $key => $value ) : ?>
			<div class="tab-pane <?php echo $key == 'add' ? 'active in' : ''; ?>" id="groundhogg-when-<?php echo $key; ?>-<?php echo $level_id; ?>">
				<div class="horizontal-tabs">
					<div class="row no-gutters">
						<div class="col-12 col-md-auto">
							<!-- Nav tabs -->
							<div class="horizontal-tabs-sidebar" style="min-width: 120px;">
								<ul class="nav nav-tabs -h-tabs flex-column" role="tablist">
									<li role="presentation" class="nav-item">
										<a href="#<?php echo $level_id; ?>-<?php echo $key; ?>-groundhogg-tag" class="nav-link pp-nav-link active" aria-controls="tag" role="tab" data-type="tag" data-title="Tag Actions" data-toggle="tab">Tag</a>
									</li>
								</ul>
							</div>
						</div>
						<div class="col">
							<!-- Tab panes -->
							<div class="tab-content">
								<div role="tabpanel" class="tab-pane active" id="<?php echo $level_id; ?>-<?php echo $key; ?>-groundhogg-tag">
									<div class="col-md-12">
										<div class="form-group">
											<label><?php _e( 'Add Tags', 'wishlist-member' ); ?></label>
											<select class="groundhogg-tags-select" multiple="multiple" data-placeholder="Select Tags..." style="width:100%" name="groundhogg_settings[level][<?php echo $level_id; ?>][<?php echo $key; ?>][apply_tag][]"></select>
										</div>
									</div>
									<div class="col-md-12">
										<div class="form-group">
											<label><?php _e( 'Remove Tags', 'wishlist-member' ); ?></label>
											<select class="groundhogg-tags-select" multiple="multiple" data-placeholder="Select Tags..." style="width:100%" name="groundhogg_settings[level][<?php echo $level_id; ?>][<?php echo $key; ?>][remove_tag][]"></select>
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
<?php endforeach; ?>
