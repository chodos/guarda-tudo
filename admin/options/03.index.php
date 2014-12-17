<?php
/**
 * Index config Functions.
 *
 * @package InkID
 */

function show_sections_index() {
	global $opt_layout_sections_home;

	$layout = $opt_layout_sections_home['enabled'];

	if ($layout): foreach ($layout as $key=>$value) {
		if ($key == 'whatvideo') {
			echo "<div class='line-block'>";
			show_main_what_video_home();
			echo "</div>";
		}
	}
	endif;
}

function show_main_what_video_home() {
	global $opt_layout_sections_what_video;

	$number_enable = count($opt_layout_sections_what_video['enabled']);

	if (($number_enable == 3) && (!empty($opt_layout_sections_what_video['enabled']['selo']))) {
		$number_enable = 5;
	}

	$layout = $opt_layout_sections_what_video['enabled'];

	if ($layout): foreach ($layout as $key=>$value) {
		if ($key == 'what') {
			show_main_post_home($number_enable);
		}
		else {
			if ($key == 'video') {
				show_video_home($number_enable);
			}
			else {
				if ($key == 'selo') {
					echo "<img class='selo-home$number_enable' src='" . get_template_directory_uri() . "/images/selo.png' />";
				}
			}
		}
	}
	endif;
}

function show_main_post_home($enables) {
	global $opt_select_main_post_home;
	
	$args = array(
				'p' => $opt_select_main_post_home,
				'posts_per_page' => 1
			);
	$main_post = new WP_Query($args);

	if( $main_post->have_posts() ):  
		$main_post->the_post();
		echo "<div class='box-what size$enables'>";
		get_template_part( 'main-post-home', get_post_format() );	
		echo "</div>";
	endif;

	//echo "<div class='box-what size$enables'>Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat. Ut wisi enim ad minim veniam, quis nostrud exerci tation ullamcorper suscipit lobortis nisl ut aliquip ex ea commodo consequat. Duis autem vel eum iriure dolor in hendrerit in vulputate velit esse molestie consequat, vel illum dolore eu feugiat nulla facilisis at vero eros et accumsan et iusto odio dignissim qui blandit praesent luptatum zzril delenit augue duis dolore te feugait nulla facilisi.</div>";
}

function show_video_home($enables){
	echo "<div class='box-what size$enables' style='max-width:48%'>
				<iframe width='100%' height='215px' src='//www.youtube.com/embed/w-KKTS8sXEw?rel=0&amp;showinfo=0' frameborder='0' allowfullscreen></iframe>
			</div>";
}



?>