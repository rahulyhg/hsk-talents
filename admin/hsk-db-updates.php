<?php
function hsk_rating_db() {
	global $wpdb;
global $wpdb;
	$charset_collate = $wpdb->get_charset_collate();
	/**
	 * Creating rating tables when we install plugin
	 */
	require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
	$hsk_ratings = $wpdb->prefix. 'hsk_ratings';
	$hsk_rating_sql = "CREATE TABLE $hsk_ratings (
		rating_id INT(11) NOT NULL auto_increment,
		rating_postid INT(11) NOT NULL,
		rating_rating INT(2) NOT NULL,
		comment longtext NULL,
		rating_timestamp datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
		rating_ip VARCHAR(40) NOT NULL,
		rating_userid int(10) NOT NULL default '0',
		PRIMARY KEY (rating_id),
		KEY rating_userid (rating_userid),
		KEY rating_postid_ip (rating_postid, rating_ip)
	 ) $charset_collate;";
	$hsk_rating = dbDelta($hsk_rating_sql);

	/**
	 * Creating rating tables when we install plugin
	 */
	
	$charset_collate = $wpdb->get_charset_collate();
	$hsk_following = $wpdb->prefix . 'hsk_following';
	$sql = "CREATE TABLE $hsk_following (
		id INT(11) NOT NULL AUTO_INCREMENT,
		follow_postid INT(11) NOT NULL ,
		comment longtext NULL,
		text text NOT NULL,
		followers_user_id TEXT NOT NULL,
		following_user_id TEXT NOT NULL,
		PRIMARY KEY  (id)
	) $charset_collate;";
	dbDelta( $sql );
	
}
hsk_rating_db();

// Shortlist registration
function hsk_shortlist_create_db() {
	global $wpdb;
	$charset_collate = $wpdb->get_charset_collate();
	$hsk_shortlist = $wpdb->prefix . 'hsk_shortlist';

	$sql_query = "CREATE TABLE $hsk_shortlist (
		id mediumint(9) NOT NULL AUTO_INCREMENT,
		post_id mediumint(9) NOT NULL,
		user_id mediumint(9) NOT NULL,
		creation_time datetime DEFAULT '0000-00-00 00:00:00' NOT NULL,
		UNIQUE KEY id (id)
	) $charset_collate;";

	require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
	dbDelta( $sql_query );
}
hsk_shortlist_create_db();
?>