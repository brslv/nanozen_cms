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

if ( ! function_exists('app_back_navigation')) {

	function app_back_navigation() {
		return VIEWS_INCLUDE_FOLDER . 'back_navigation.php';
	}
}

if ( ! function_exists('app_back_navigation_editor')) {

	function app_back_navigation_editor() {
		return VIEWS_INCLUDE_FOLDER . 'back_navigation_editor.php';
	}
}

if ( ! function_exists('app_back_navigation_resolver')) {

	function app_back_navigation_resolver() {
		return VIEWS_INCLUDE_FOLDER . 'back_navigation_resolver.php';
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

if ( ! function_exists('quote')) {

	/**
	 * Returns a random quote.
	 * @return string quote
	 */
	function quote() {
		$quotes = [
			'“Walk as if you are kissing the Earth with your feet.”',
			'“Life is a journey. Time is a river. The door is ajar”',
			'“Man suffers only because he takes seriously what the gods made for fun.”',
			'“To Do Today, 1/17/08
				1. Sit and think
				2. Reach enlightenment
				3. Feed the cats”',
			'“The truth knocks on the door and you say, "Go away, I\'m looking for the truth," and so it goes away. Puzzling.” ',
			'“The way out is through the door. Why is it that no one will use this method?”',
			'“Letting go is the lesson. Letting go is always the lesson. Have you ever noticed how much of our agony is all tied up with craving and loss?”',
			'“Only the hand that erases can write the true thing.”',
			'“It is the power of the mind to be unconquerable.”',
			'“Flow with whatever may happen, and let your mind be free: Stay centered by accepting whatever you are doing. This is the ultimate.”',
			'“It is easy to believe we are each waves and forget we are also the ocean.”',
			'“When the mind is exhausted of images, it invents its own.”',
			'“Haiku is not a shriek, a howl, a sigh, or a yawn; rather, it is the deep breath of life.”',
			'“Consider your own place in the universal oneness of which we are all a part, from which we all arise, and to which we all return.”',
		];

		$randomQuoteIndex = mt_rand(0, count($quotes) - 1);

		return $quotes[$randomQuoteIndex];
	}
}