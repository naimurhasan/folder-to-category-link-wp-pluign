<?php
if ( ! defined( 'ABSPATH' ) ) exit;

$posts = get_posts( array(
		    'post_type'    => 'attachment',
		    'post_status' => 'inherit',
		    'posts_per_page' => -1,
		    'tax_query' => array(
		    	array(
		    	'taxonomy' => 'media_category',
		    	'operator' => 'NOT EXISTS'
		     	),
		     	array(
		    	'taxonomy' => 'nt_wmc_folder',
		    	'operator' => 'EXISTS'
		     	),
		  		)
			)
		);


// attach category if update post cat button clicked
if(isset($_POST['update_photos_category'])){
	foreach ($posts as $post) {
		$terms = get_the_terms($post->ID, 'nt_wmc_folder');
		$cat_id = get_option('cat_for_folder_'.$terms[0]->term_id);
		wp_set_post_terms($post->ID, array($cat_id), 'media_category' );	
	}
	$posts = [];
}

$post_show_count = 0;
foreach ($posts as $post) {
		$post_show_count++;
		echo wp_get_attachment_image( $post->ID, 'medium');
		// echo "<PRE>";
		// print_r($terms);
		// echo "</PRE>";

		// echo "NEED TO APPLY THE CATEGORY OF";
		// echo $cat_id;
		// echo "<br>";
		if($post_show_count>1){
			if(count($posts)>2)
				echo "<p>And More Photos...</p>";	
			break;
		}
}

echo "<HR>";
echo "<STRONG>".count($posts). "</STRONG> PHOTOS NEEDED TO BE ADDED CATEGORY";
echo "<br/><br/>";
echo '<form method="POST">';
echo '--&gt;<input type="submit" name="update_photos_category" value="Add Folderwise Category to Photos">&lt;--';
echo '</form>';
