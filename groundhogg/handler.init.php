<?php
$class_name = '\WishListMember\Autoresponders\Groundhogg';


add_action( 'wishlistmember_user_registered', array( $class_name, 'NewUserTagsHook' ), 99, 2 );
add_action( 'wishlistmember_add_user_levels', array( $class_name, 'AddUserTagsHook' ), 10, 3 );

add_action( 'wishlistmember_confirm_user_levels', array( $class_name, 'ConfirmApproveLevelsTagsHook' ), 99, 2 );
add_action( 'wishlistmember_approve_user_levels', array( $class_name, 'ConfirmApproveLevelsTagsHook' ), 99, 2 );

add_action( 'wishlistmember_pre_remove_user_levels', array( $class_name, 'RemoveUserTagsHook' ), 99, 2 );
add_action( 'wishlistmember_cancel_user_levels', array( $class_name, 'CancelUserTagsHook' ), 99, 2 );
add_action( 'wishlistmember_uncancel_user_levels', array( $class_name, 'ReregUserTagsHook' ), 99, 2 );

add_action( 'groundhogg/contact/tag_applied', array( $class_name, 'TagsAddedHook' ), 99, 2 );
add_action( 'groundhogg/contact/tag_removed', array( $class_name, 'TagsRemovedHook' ), 99, 2 );

add_action( 'wp_ajax_wishlistmember_groundhogg_delete_tag_action', array( $class_name, 'delete_tag_action' ) );
