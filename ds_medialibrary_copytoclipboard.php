<?php
/*
Plugin Name: DS Media Library CopyToClipboard Button
Plugin URI:
Description: This plugin adds a flash button to the Media library so you can copy the image url to the clipboard.
Version: 1.0
Author: Davie Schoots
Author URI: http://www.davieschoots.nl/
*/

	add_filter('attachment_fields_to_edit', 'ds_medialibrary_ctc_init', 2, 2);
	function ds_medialibrary_ctc_init($form_fields, $post)
	{
		$swfMovieURL = plugin_dir_url( __FILE__ ) . 'swf/button.swf';
		$flashObj = '<object type="application/x-shockwave-flash" data="'.$swfMovieURL.'" style="width:100%; height:32px;">
			<param name="movie" value="'.$swfMovieURL.'">
			<param name="allowScriptAccess" value="sameDomain"/>
			<param name="allowFullScreen" value="false" />
			<param name="wmode" value="transparent">
			<param name="scale" value="noscale" />
			<param name="play" value="true">
			<param name="loop" value="true">
			<param name="quality" value="high">
			<param name="menu" value="false">
			<param name="FlashVars" value="imageURL='.wp_get_attachment_url($post->ID).'&buttontxt='.__('Copy Image URL').'" />
				<embed type="application/x-shockwave-flash" scale="exactfit" allowFullScreen="false" allowScriptAccess="sameDomain" 									wmode="transparent" play="true" loop="true" quality="high" menu="false" pluginspage="https://www.macromedia.com/go/		getflashplayer"
src="'.$swfMovieURL.'" width="100%" height="32px"></embed>
<noembed>'.__('Flash is not available, please install a (new) version.').'</noembed></object>';

		$formf = array(
		'copy_button'   => array(
			'label'      => __('Image location'),
			'input'      => 'html',
			'html'       => $flashObj
		));
		
		$form_fields = array_merge($form_fields, $formf);	
		return $form_fields;
	}

?>