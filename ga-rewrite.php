<?php
/**
 * Plugin Name: Analytics Cookie Rewrite
 * Plugin URI: https://www.linkedin.com/in/andreasprag/
 * Description: Rewrite your Google Analytics cookie from Wordpress to circumvent ITP. You need to set 'cookieUpdate' to false on all your Google Analytics tags for this method to work.
 * Version: 1.0
 * Author: Andreas Prag
 * Author URI: https://www.linkedin.com/in/andreasprag/
 *
 */
function ga_rewrite() {
	
    if (!isset($_COOKIE['ga_rewrite']) && !isset($_GET["_ga"])) {	
		$domain = $_SERVER['HTTP_HOST'];

		if (!isset($_COOKIE['_ga'])) {
			$random = str_pad(mt_rand(1,9999999),7,'0',STR_PAD_LEFT);
			$timestamp = time();
			$ga = "GA1.2." . $random . "." . $timestamp;
		}
		
		elseif (isset($_COOKIE['_ga'])) {
            $ga = $_COOKIE['_ga'];
        }
		
		setcookie('_ga', $ga, time() + 63113904, '/', '.'.$domain);
		setcookie('ga_rewrite', $ga, time() + 604800, '/', '.'.$domain);	
    } 
    }
	
add_action('init', 'ga_rewrite');
