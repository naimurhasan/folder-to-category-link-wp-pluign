<?php
if ( ! defined( 'ABSPATH' ) ) exit;

$folders = get_terms(array('taxonomy' => 'nt_wmc_folder', 'hide_empty' => false));

// !!!CAREFUL: IF folder_cat map update request submitted
if(isset($_POST['update_folder_cat_link'])){
	foreach ($folders as $folder) {
		if(isset($_POST[$folder->term_id]) && $_POST[$folder->term_id] != ''){

			// sanitizing post data before use
			$cat_id_of_folder = (int)$_POST[$folder->term_id];

			if (!filter_var($cat_id_of_folder, FILTER_VALIDATE_INT)) {
				break;
			}

			update_option('cat_for_folder_'.$folder->term_id, $cat_id_of_folder);
		}else{
			delete_option('cat_for_folder_'.$folder->term_id);
		}
	}
	echo "<div style='background-color: #8ccf8c;padding: 5px;font-size: 14px;max-width: 500px;'>Links Updated Successfully</div>";
}

// Making a function '$nhn_cat_options' to show category select box 
$media_cats = get_terms(array('taxonomy' => 'media_category', 'hide_empty' => false));

$cat_sel_box = '';
foreach ($media_cats as $mcat) {
	$cat_sel_box .= "<option value=\"".$mcat->term_id."\">".$mcat->name." (id:".$mcat->term_id.")</option>";
}

$nhn_cat_options = function($option_name, $selected_id='', $selected_name='') use ($cat_sel_box) {
	
	$cat_sel_box = '<select name="'.$option_name.'"><option value=""selected>Choose Category</option>'.$cat_sel_box;
    
    if($selected_id != ''){
    	return $cat_sel_box."<option value='".$selected_id."' selected hidden>".$selected_name." (id:".$selected_id.")</option></select>";
    }

    return $cat_sel_box."</select>";
};

//SHOW FOLDER TO CATEGORY MAPPING FORM
echo '<form method="post">';
echo '<table class="category_fixing_table">';
echo <<<TABLE
<table class="category_fixing_table">
	<thead>
		<tr>
			<th>Folder Name</th>
			<th>Linked Category</th>
		</tr>
	</thead>
	<tbody>
TABLE;

foreach ($folders as $folder) {
	echo "<tr>";
	echo "<td>".$folder->name." (id:".$folder->term_id.")</td>";
	//show the category if already has for folder
	if(get_option('cat_for_folder_'.$folder->term_id)){
		$mterm_id = get_option('cat_for_folder_'.$folder->term_id);
		$term = get_term($mterm_id, 'media_category');
		echo "<td>".$nhn_cat_options($folder->term_id, $mterm_id, $term->name)."</td>";
	}else{
		echo "<td>".$nhn_cat_options($folder->term_id)."</td>";
	}
	echo "</tr>";	
}

echo '<tbody></table>';
echo '<br>';
echo '<input type="submit" name="update_folder_cat_link" value="Update Linkings">';
echo '</form>';


// add css
echo <<<CSS
<style>
	.category_fixing_table{
	    min-width:300px;
	}
	.category_fixing_table th{
	    text-align:left;
	}
	.category_fixing_table td{
	    padding-top:5px;
	    padding-bottom:5px;
	    padding-left:5px;
	    padding-right:5px;    
	}
	.category_fixing_table,
	.category_fixing_table th,
	.category_fixing_table td {
	  border: 1px solid black;
	  border-collapse:collapse;
	}
</style>
CSS;

