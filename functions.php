<?php

define('VIEWS_INCLUDE_FOLDER', '../Views/includes/');

if ( ! function_exists('app_header')) {
	
	/**
	 * Includes the header of the app.
	 */
	function app_header() {
		return VIEWS_INCLUDE_FOLDER . 'header.php';
	}
}

if ( ! function_exists('app_footer')) {
	
	/**
	 * Includes the footer of the app.
	 */
	function app_footer() {
		return VIEWS_INCLUDE_FOLDER . 'footer.php';
	}
}

if ( ! function_exists('app_navigation')) {
	
	/**
	 * Includes the navigation of the app.
	 */
	function app_navigation() {
		return VIEWS_INCLUDE_FOLDER . 'navigation.php';
	}
}

if ( ! function_exists('app_flash')) {

	/**
	 * Includes the flash messaging view engine of the app.
	 */
	function app_flash() {
		return VIEWS_INCLUDE_FOLDER . 'flash.php';
	}
}