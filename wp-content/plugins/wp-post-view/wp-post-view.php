<?php

/*
  Plugin Name: WP-post-view
  Plugin URI:
  Description: Easily display the views visited of each post. Tracks the views in each posts visited, views number are also display in each row of the post in the admin area. Simply add this code echo_post_views(get_the_ID()); anywhere to display AFTER <?php if (have_posts ()) : while (have_posts ()) : the_post(); ?> in single.php file.
  Version: 1.0
  Author: Towards Technology
  Author URI: http://answer2me.com/
 */
/*
  Copyright 2011  Towards Technology  (email : sales@towardstech.com)

  This program is free software; you can redistribute it and/or modify
  it under the terms of the GNU General Public License as published by
  the Free Software Foundation; either version 2 of the License, or
  (at your option) any later version.

  This program is distributed in the hope that it will be useful,
  but WITHOUT ANY WARRANTY; without even the implied warranty of
  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
  GNU General Public License for more details.

  You should have received a copy of the GNU General Public License
  along with this program; if not, write to the Free Software
  Foundation, Inc., 59 Temple Place, Suite 330, Boston, MA  02111-1307  USA
 */
 
//Activation
register_activation_hook(__FILE__, wpp_init());
Register_uninstall_hook(__FILE__, wpp_destroy());
add_action('admin_head', 'post_view_style');
add_action('manage_posts_custom_column', 'show_post_row_views', 10, 2);
add_filter('manage_posts_columns', 'show_post_header_views');

// Hook into the 'wp_dashboard_setup' action to register our other functions
add_action('wp_dashboard_setup', 'example_add_dashboard_widgets' );

define("BLOG", 12);
define("PRODUCT", 3);

/**
 * When plugin activated, table is created.

 * @global  $wpdb
 */
function wpp_init() {
    global $wpdb;
    $table = $wpdb->prefix . "postview";
    if ($wpdb->get_var("SHOW TABLES LIKE '$table'") != $table) {
        $sql = "CREATE TABLE " . $table .
                " ( UNIQUE KEY id (post_id), post_id int(10) NOT NULL,
             view int(10),
            view_datetime date NOT NULL default '0000-00-00',
			prev_view int(10),
			cat_id int(10));";
        require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
        dbDelta($sql);
    }
}

/**
 * When plugin deleted, table is deleted.
 * @global $wpdb $wpdb
 */
function wpp_destroy() {
    global $wpdb;
    $table = $wpdb->prefix . "postview";
    if ($wpdb->get_var("SHOW TABLES LIKE '$table'") != $table) {
        $sql = "DROP TABLE " . $table;
        require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
        dbDelta($sql);
    }
}

/**
 * Some css adjustment.
 */
function post_view_style() {

    echo
    '<style type="text/css">
	.column-views {
		width: 60px;
		text-align: right;
	}
	</style>';
}

/**
 * Display the views header column name.

 *  * @param array $columns
 * @return <type> 
 */
function show_post_header_views($columns) {
    $columns['views'] = __('Views');
    return $columns;
}

/**
 *
 * Display the views amount in each row of the posts admin panel.
 *
 * @param <type> $column_name
 * @param <type> $post_id
 * @return <type> 
 */
function show_post_row_views($column_name, $post_id) {
    if ($column_name != 'views')
        return;
    echo wp_get_post_views($post_id);
}

if (!function_exists('echo_post_views')) {

    /**
     * Echo, print or display the views of the post.
     * @param <type> $post_id
     */
    function echo_post_views($post_id) {
		
		$post = get_post($post_id);
		$cat = get_the_category($post_id);
		//var_dump($cat);
		$cat_id = intval($cat[0]->category_parent);
		if($cat_id == 0) 
			$cat_id = intval($cat[0]->term_id);
		//var_dump($cat_id);
		if($cat_id == BLOG || $cat_id == PRODUCT) {
			if (wp_update_post_views($post_id) == 1) {
				$views[0] = wp_get_post_views($post_id);
				$views[1] = wp_get_prev_views($post_id);
				return 	$views;
			} else {
				$views[0] = 1;
				$views[1] = 0;
				return 	$views;
			}
		}
    }
}


/**
 * Returns 1 if successfully updated post views.

 *  * @global $wpdb $wpdb
 * @param <type> $views
 * @param <type> $post_id
 * @return <type> 
 */
function wp_insert_post_views($views, $post_id) {
	if( !get_post_type($post_id) ){
		return 0;
	}
    global $wpdb;
	
	$post = get_post($post_id);
	$cat = get_the_category($post_id);
	$cat_id = intval($cat[0]->category_parent);
	if($cat_id == 0) 
		$cat_id = intval($cat[0]->term_id);
	
    $table = $wpdb->prefix . "postview";
	$cur_day = date("Y-m-d"); 
    $result = $wpdb->query("INSERT INTO $table VALUES($post_id,$views,'$cur_day',0 ,'$cat_id')");
	//echo "INSERT INTO $table VALUES($post_id,$views,NOW(),0)";
    return ($result);
}

/** Cập nhật lại người xem khi quá 12h đêm **/
function wp_update_all_post_views(){
	global $wpdb;
	$table = $wpdb->prefix . "postview";
	$cur_day = date("Y-m-d", current_time('timestamp'));
	//var_dump($cur_day);
	$wpdb->query("UPDATE $table SET prev_view=view+prev_view, view=0, view_datetime = '$cur_day' WHERE view_datetime < '$cur_day'");
}
/**
 * Returns 1 if successfully updated post views.
 *
 * @global <type> $wpdb
 * @param <type> $post_id
 * @return <type>
 */
function wp_update_post_views($post_id) {
	
    global $wpdb;
	
	$post = get_post($post_id);
	$cat = get_the_category($post_id);
	$cat_id = intval($cat[0]->category_parent);
	//var_dump($cat_id);
	if($cat_id == 0) 
		$cat_id = intval($cat[0]->term_id);
	if($cat_id != BLOG && $cat_id != PRODUCT) 
		return;
	
    $table = $wpdb->prefix . "postview";

    $views = wp_get_post_views($post_id) + 1;
	
	//echo $views;
	
    if ($wpdb->query("SELECT view FROM $table WHERE post_id = '$post_id'") != 1){
        wp_insert_post_views($views, $post_id);
	}
	$cur_day = date("Y-m-d",current_time('timestamp'));
	//var_dump ($cur_day);
	$time_view = date(view_datetime($post_id));
	//var_dump($time_view);
	//var_dump($cur_day == $time_view);
	
	//echo ($cur_day>$time_view);
	//var_dump($cur_day > $time_view);
	//if the current day equal old day
	//update view 
	//echo $cur_day;
	//var_dump($cur_day == $time_view);
	
	if( $cur_day == $time_view ){
		$result = $wpdb->query("UPDATE $table SET view=$views WHERE post_id = '$post_id'");
		//echo "UPDATE $table SET view=$views WHERE post_id = '$post_id'";
	}
	//update pre_view, timedate_view
	//reset view
	if( $cur_day > $time_view ){
		$prev_view = wp_get_prev_views($post_id) + $views;
		$result = $wpdb->query("UPDATE $table SET view=1, prev_view=$prev_view , view_datetime='$cur_day'  WHERE post_id = '$post_id'");
		//echo "UPDATE $table SET view=0, prev_view=$prev_view , view_datetime='$cur_day'  WHERE post_id = '$post_id'";
	}
	//echo $result;
    return ($result);
}

/**
 * Get the post views amount.
 * @global $wpdb $wpdb
 * @param <type> $post_id
 * @return <type> 
 */
function wp_get_post_views($post_id) {
    global $wpdb;
    $table = $wpdb->prefix . "postview";
    $result = $wpdb->get_results("SELECT view FROM $table WHERE post_id = '$post_id'", ARRAY_A);
    if (!is_array($result) || empty($result)) {
        return "0";
    } else {
        return $result[0]['view'];
    }
}

function view_datetime($post_id) {
    global $wpdb;
    $table = $wpdb->prefix . "postview";
    $result = $wpdb->get_results("SELECT view_datetime FROM $table WHERE post_id = '$post_id'", ARRAY_A);
	if (!is_array($result) || empty($result)) {
        return "0000-00-00";
    } else {
        return $result[0]['view_datetime'];
    }
}

function wp_get_prev_views($post_id) {
    global $wpdb;
    $table = $wpdb->prefix . "postview";
    $result = $wpdb->get_results("SELECT prev_view FROM $table WHERE post_id = '$post_id'", ARRAY_A);
    if (!is_array($result) || empty($result)) {
        return "0";
    } else {
        return $result[0]['prev_view'];
    }
}

//ham lay nhugn bai viet nhieu nguoi doc nhat
function wp_get_post_by_view() {
    global $wpdb;
    $table = $wpdb->prefix . "postview";
    $result = $wpdb->get_results("SELECT post_id FROM $table where cat_id = 12 ORDER BY prev_view DESC LIMIT 7", ARRAY_A);
	
	$post = get_post($post_id);
	$cat = get_the_category($post_id);
	$cat_id = intval($cat[0]->term_id);
	
    if (!is_array($result) || empty($result)) {
        return NULL;
    } else {
        return $result;
    }
}

// Create the function to output the contents of our Dashboard Widget

function example_dashboard_widget_function() {
	// Display whatever it is you want to show
	global $wpdb;
    $table = $wpdb->prefix . "postview";
	wp_update_all_post_views();
    $result = $wpdb->get_results("SELECT * FROM $table ORDER BY prev_view DESC", ARRAY_A);
	//var_dump($result);
	//foreach($result as $post)
	//var_dump($post["post_id"]);
	//var_dump(date('Y-m-d',current_time('mysql')));
	?>
	<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.4.2/jquery.min.js"></script>
	<script type="text/javascript" src="<?php echo plugin_dir_url(__FILE__); ?>datatables/js/jquery.dataTables.js"></script> 
	
    <script type="text/javascript"> 
		jQuery.noConflict();
        jQuery(document).ready(function() {
            jQuery('#example').dataTable( {
                "sPaginationType": "full_numbers",
				"aLengthMenu": [
					[25, 100, -1],
					[25, 100, "All"]
				],
				"aaSorting": [[ 1, "desc" ]],
				"iDisplayLength": 25
            } );
        } );
    </script> 
	<section class="container_12 clearfix">
		<div class="grid_12">
			<div id="demo" class="clearfix"> 
				<?php 
				//echo current_time('mysql');
				//echo date("Y-m-d"); 
				?>
				<table class="display" id="example"> 
					<thead> 
						<tr> 
							<th>Tên bài viết</th> 
							<th>Xem hôm nay</th>
							<th>Xem trước đây</th>
						</tr> 
					</thead> 
					<tbody> 
						<?php
							foreach($result as $post)
							{
								echo '
									<tr> 
										<td align="center"><a href="'.get_bloginfo('siteurl').'?p='.$post["post_id"].'">'.get_post($post["post_id"])->post_title.'</a></td> 
										<td align="center">'.$post["view"].'</td> 
										<td align="center">'.$post["prev_view"].'</td> 			
									</tr> 
								';
							}
						?>
					</tbody> 
				</table> 
			</div> 
		</div>
	</section>
<?php 	
} 

// Create the function use in the action hook

function example_add_dashboard_widgets() {
	wp_add_dashboard_widget('example_dashboard_widget', 'Bảng thống kê lượt xem', 'example_dashboard_widget_function');	
} 

//load css
function load_custom_wp_admin_style(){
        wp_register_style( 'custom_wp_admin_css1', plugin_dir_url(__FILE__).'datatables/css/cleanslate.css', false, '1.0.0' );
		//wp_register_style( 'custom_wp_admin_css2', get_bloginfo("url").plugin_dir_url(__FILE__).'datatables/css/reset.css', false, '1.0.0' );
		//wp_register_style( 'custom_wp_admin_css3', get_bloginfo("url").plugin_dir_url(__FILE__).'datatables/css/grids.css', false, '1.0.0' );
		//wp_register_style( 'custom_wp_admin_css4', get_bloginfo("url").plugin_dir_url(__FILE__).'datatables/css/style.css', false, '1.0.0' );
		
        wp_enqueue_style( 'custom_wp_admin_css1' );
		//wp_enqueue_style( 'custom_wp_admin_css2' );
		//wp_enqueue_style( 'custom_wp_admin_css3' );
		//wp_enqueue_style( 'custom_wp_admin_css4' );
}
add_action('admin_enqueue_scripts', 'load_custom_wp_admin_style');

?>