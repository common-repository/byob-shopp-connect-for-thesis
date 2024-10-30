<?php

// --------------------------------------------------------------------------------------
// CALLBACK FUNCTION FOR: register_uninstall_hook(__FILE__, 'byobscft_delete_plugin_options')
// --------------------------------------------------------------------------------------


// Delete options table entries ONLY when plugin deactivated AND deleted
function byobscft_delete_plugin_options() {
	delete_option('byobscft_options');
}