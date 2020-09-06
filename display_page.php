<?php
if ( ! defined( 'ABSPATH' ) ) exit; 

echo '<h2>Add Category to Photos</h2>';
include_once('add_cat_to_photo.php');

echo '<br/><div><h2>Link Folder to Category</h2></div>';
include_once('folder_cat_table.php');

/*
GET ALL THE TERMS 
	get_terms(array('hide_empty' => false))

SAMPLE CATEGORY TAX ARRAY
	[term_id] => 38
    [name] => aabbcc
    [slug] => aabbcc
    [term_group] => 0
    [term_taxonomy_id] => 38
    [taxonomy] => media_category
    [description] => 
    [parent] => 0
    [count] => 0
    [filter] => raw

SAMPLE FOLDER TAXONOMY ARRAY
	[term_id] => 12
    [name] => Cars
    [slug] => cars
    [term_group] => 0
    [term_taxonomy_id] => 12
    [taxonomy] => nt_wmc_folder
    [description] => 
    [parent] => 0
    [count] => 10
    [filter] => raw

GET ALL THE TERMS ID OF nt_wmc_folder
	get_terms(array('taxonomy' => 'nt_wmc_folder', 'hide_empty' => false));

GET WALLPAPER FROM FOLDER TERMS
	get_posts( array(
	    'post_type'    => 'attachment',
	    'post_status' => 'inherit',
	    'posts_per_page' => -1,
	    'tax_query' => array(
	    	array(
	    	'taxonomy' => 'nt_wmc_folder',
	    	'field' => 'term_id',
	    	'terms' => 12
	     	)
	  		)
		)
	);

GET media_category TERMS ID OF A POST 282
get_the_terms(282, 'media_category');

REMOVE MANUALLY all the terms
	wp_set_post_terms( 282, array(), 'media_category' );

SET 32(cars) 33(games) media_category CATEGORY TERMS TO A POST 282 add
	$tag = array( 32 ); //new terms here
	wp_set_post_terms( 282, $tag, 'media_category' );

ADD TERMS with exising
	$terms = get_the_terms(282, 'media_category');
	$tags = array();
	foreach ($terms as $term) {
		$tags[] = $term->term_id;
	}
	$tags[] = 33; //new terms here
	wp_set_post_terms( 282, $tags, 'media_category' );

SEARCH ONLY FOR THE WALLPAPERS WHICH DOESN'T HAVE MEDIA CATEGORY APPLIED

	$posts = get_posts( array(
		    'post_type'    => 'attachment',
		    'post_status' => 'inherit',
		    'posts_per_page' => -1,
		    'tax_query' => array(
		    	array(
		    	'taxonomy' => 'media_category',
		    	'operator' => 'NOT EXISTS'
		     	)
		  		)
			)
		);

	foreach ($posts as $post) {
		echo wp_get_attachment_image( $post->ID, 'medium');
	}

PHP SAVE PLUGIN OPTIONS
	update_option('nhn_name');

	echo get_option('nhn_name', 'EMPTY');
	delete_option('nhn_name');

PHP JSON ENCODE DECONDE
	$folder_to_cat = array(32 => 2, 42=>1);

	$json = '{"32":2,"42":1}';
	$folder_to_cat = json_decode($json, true);

	print_r($folder_to_cat);
	echo "<BR>";
	foreach ($folder_to_cat as $key => $value) {
		echo $key." = ".$value."<BR>";
	}

	echo "EXIST: ".array_key_exists(50, $folder_to_cat);

SHOW FROM

*/


