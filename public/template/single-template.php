<?php
/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package WordPress
 * @subpackage Twenty_Twenty
 * @since 1.0.0
 */

get_header();
if (isset( $_SESSION['csv'] ) ) {
	$_SESSION['csv'] = $_SESSION['csv'];
} else {
	$_SESSION['csv'] = array();
}
$count       = 0;
$postcontent = '';
$posttitle   = '';
?>
<div class="entry-content" style="background-color:bisque">

<?php
/* Start the Loop */
while ( have_posts() ) :

	the_post();
	echo '<center><h1>';
	echo the_title();
	echo '</h1></center>';
	$options = get_option( 'wporg_options' );
	// $_SESSION['csv'] = array();
	// $_SESSION['xml'] = array();
	// $file = fopen( 'MOCK_DATA.csv', 'r' );
	// while ( ! feof( $file ) ) {
	// 	$csv = fgetcsv( $file );
	// 	array_push( $_SESSION['csv'], $csv );
	// }
	// fclose( $file );

	// $v = file_get_contents( 'dataset.xml' );

	// $xml = simplexml_load_string( $v ) or die( "Error: Cannot create object" );
	// $_SESSION['xml'] = $xml;






	// $postarray = array(
	// 	'post_type'   => 'product_key',
	// 	'post_status' => 'publish',
	// );
	// $postinfoarray = array();
	// $postquery = new WP_Query( $postarray );
	// if ( $postquery->have_posts() ) {
	// 	$file = fopen( 'newcsv.csv', 'w', ',' );
	// 	while ( $postquery->have_posts() ) {
	// 		$postinfo = array(
	// 			'id'      => get_the_ID(),
	// 			'title'   => get_the_title(),
	// 			'content' => get_the_content(),
	// 		);
	// 		print_r( $postinfo );
	// 		fputcsv( $file, $postinfo );
	// 		//array_push( $postinfoarray, $postinfo );
	// 	}
	// 	// print_r( $postinfoarray );
	// 	// $file = fopen( 'newcsv.csv', 'w', ',' );
	// 	// foreach ( $postinfoarray as $postinfoarraychild ) {
	// 		// fputcsv( $file, $postinfoarraychild );
	// 	// }
	// 	fclose( $file );
	// }





	// $arg = array(
	// 	'post_type' => 'product_key',
	// 	'post_status' => 'publish',
	// );

	// global $post;
	// $arr_post = get_posts($arg);
	// if ($arr_post) {

	// 	header('Content-type: text/csv');
	// 	header('Content-Disposition: attachment; filename="wp-posts.csv"');
	// 	header('Pragma: no-cache');
	// 	header('Expires: 0');

	// 	$file = fopen('newcsv.csv', 'w');

	// 	fputcsv($file, array('ID', 'Post Title', 'Post Content'));

	// 	foreach ($arr_post as $post) {
	// 		setup_postdata($post);
	// 		$id = get_the_ID();
	// 		$title = get_the_title();
	// 		$content = get_the_content();
	// 		fputcsv( $file, array( $id, $title, $content ) );
	// 	}

	// 	exit();
	// }




	// $c = 1;
	// $d = 10;
	// if ( ! get_option( 'initial' ) ) {
	// 	update_option( 'initial', $c );
	// } else {
	// 	$c = get_option( 'initial' );
	// }
	// if ( ! get_option( 'final' ) ) {
	// 	update_option( 'final', $d );
	// } else {
	// 	$d = get_option( 'final' );
	// }

	// for ( $i = $c; $i <= $d; $i++ ) {
	// 	$args = array(
	// 		'post_type'    => 'product_key',
	// 		'post_title'   => strval( $_SESSION['xml']->record[ $i - 1 ]->title ),
	// 		'post_status'  => 'publish',
	// 		'post_content' => strval( $_SESSION['xml']->record[ $i - 1 ]->content ),
	// 	);
	// 	$id_new   = wp_insert_post( $args, true );
	// 	$content1 = get_post( $id_new );
	// 	update_post_meta(
	// 		$content1->ID,
	// 		'price',
	// 		$_SESSION['csv'][$i][0]
	// 	);
	// 	update_post_meta(
	// 		$content1->ID,
	// 		'sku',
	// 		$_SESSION['csv'][$i][1]
	// 	);
	// 	update_post_meta(
	// 		$content1->ID,
	// 		'review',
	// 		$_SESSION['csv'][$i][2]
	// 	);
	// }
	// $c = $c + 10;
	// $d = $d + 10;
	// update_option( 'initial', $c );
	// update_option( 'final', $d );




//print_r ( $_SESSION['xml'] );
//print_r( $_SESSION['csv'] );











































































































































































































































































































































































































































































		// $postcontent = '';
		// $posttitle   = '';
		// $postid      = '';
		// $c = 1;
		// $d = 10;
		// if ( ! get_option( 'initial' ) ) {
		// 	update_option( 'initial', $c );
		// } else {
		// 	$c = get_option( 'initial' );
		// }
		// if ( ! get_option( 'final' ) ) {
		// 	update_option( 'final', $d );
		// } else {
		// 	$d = get_option( 'final' );
		// }


		// for ( $i = $c; $i <= $d; $i++ ) {
		// 	$args = array(
		// 		'post_type'    => 'product_key',
		// 		'post_title'   => strval( $_SESSION['xml']->record[ $i - 1 ]->title ),
		// 		'post_status'  => 'publish',
		// 		'post_content' => strval( $_SESSION['xml']->record[ $i - 1 ]->content ),
		// 	);
		// 	$id_new   = wp_insert_post( $args, true );
		// 	$content1 = get_post( $id_new );
		// 	update_post_meta(
		// 		$content1->ID,
		// 		'price',
		// 		$_SESSION['csv'][$i][0]
		// 	);
		// 	update_post_meta(
		// 		$content1->ID,
		// 		'sku',
		// 		$_SESSION['csv'][$i][1]
		// 	);
		// 	update_post_meta(
		// 		$content1->ID,
		// 		'review',
		// 		$_SESSION['csv'][$i][2]
		// 	);
		// }
		// $c = $c + 10;
		// $d = $d + 10;
		// update_option( 'initial', $c );
		// update_option( 'final', $d );

		// $postcontent = '';
		// $posttitle   = '';
		// $postid      = '';
		// foreach ( $_SESSION['xml'] as $key => $value ) {
		// 	foreach ( $value as $value1 => $a ) {
		// 		if ( 'title' === $value1 ) {
		// 			$posttitle = $a;
		// 		} elseif ( 'content' === $value1 ) {
		// 			$postcontent = $a;
		// 		} elseif ( 'id' === $value1 ) {
		// 			$postid = $a;
		// 		}
		// 		if ( '' !== $posttitle && '' !== $postcontent && '' !== $postid ) {
		// 			foreach ( $_SESSION['csv'] as $key => $value ) {
		// 				if ( 'price' !== $value[0] ) {
		// 					$c = 1;
		// 					$d = 10;
		// 					if ( ! get_option( 'initial' ) ) {
		// 						update_option( 'initial', $c );
		// 					} else {
		// 						$c = get_option( 'initial' );
		// 					}
		// 					if ( ! get_option( 'final' ) ) {
		// 						update_option( 'final', $d );
		// 					} else {
		// 						$d = get_option( 'final' );
		// 					}
		// 					$args = array(
		// 						'post_type'    => 'product_key',
		// 						'post_title'   => $posttitle,
		// 						'post_status'  => 'publish',
		// 						'post_content' => $postcontent,
		// 					);
		// 					$args1 = array(
		// 						'post_type'    => 'product_key',
		// 						'post_status'  => 'publish',
		// 					);
		// 					$q = new WP_Query( $args1 );
		// 					if ( $c <= 100 && $d <= 100 ) {
		// 						for ( $i = $c; $i <= $d; $i++ ) {
		// 							$id_new   = wp_insert_post( $args, true );
		// 							$content1 = get_post( $id_new );
		// 							update_post_meta(
		// 								$content1->ID,
		// 								'price',
		// 								$value[0]
		// 							);
		// 							update_post_meta(
		// 								$content1->ID,
		// 								'sku',
		// 								$value[1]
		// 							);
		// 							update_post_meta(
		// 								$content1->ID,
		// 								'review',
		// 								$value[2]
		// 							);
		// 							$postcontent = '';
		// 							$posttitle   = '';
		// 							$postid      = '';
		// 						}
		// 						$c = $c + 10;
		// 						$d = $d + 10;
		// 						update_option( 'initial', $c );
		// 						update_option( 'final', $d );
		// 					}
		// 				}
		// 			}
		// 		}
		// 	}
		// }
	//print_r($options);
	// $file = fopen( 'MOCK_DATA.csv', 'r' );
	// while ( ! feof( $file ) ) {
	// 	$csv = fgetcsv( $file );
	// 	array_push( $_SESSION['csv'], $csv );
	// }
	// fclose( $file );

	// $v = file_get_contents( 'dataset.xml' );

	// $xml = simplexml_load_string( $v ) or die( "Error: Cannot create object" );
	// $_SESSION['xml'] = $xml;
	// print_r($_SESSION['csv']);
	//print_r($_SESSION['xml']);

	// foreach ( $_SESSION['xml'] as $key => $value ) {
	// 	foreach ( $value as $value1 => $a ) {
	// 		if ( 'title' === $value1 ) {
	// 			$posttitle = $a;
	// 		} elseif ( 'content' === $value1 ) {
	// 			$postcontent = $a;
	// 		}
	// 		if ( '' !== $posttitle && '' !== $postcontent ) {
	// 			$args = array(
	// 				'post_type'    => 'product_key',
	// 				'post_title'   => $posttitle,
	// 				'post_status'  => 'publish',
	// 				'post_content' => $postcontent,
	// 			);
	// 			wp_insert_post( $args, true );
	// 			$count++;
	// 			$postcontent = '';
	// 			$posttitle   = '';
	// 		}
	// 	}
	// }

	// foreach ( $_SESSION['csv'] as $key => $value ) {
	// 	if ( 'price' !== $value[0] ) {
	// 		update_post_meta(
	// 			$post_id,
	// 			'price',
	// 			$value[0]
	// 		);
	// 		update_post_meta(
	// 			$post_id,
	// 			'sku',
	// 			$value[1]
	// 		);
	// 		update_post_meta(
	// 			$post_id,
	// 			'review',
	// 			$value[2]
	// 		);
	// 	}
	// }
	// foreach ( $_SESSION['xml'] as $key => $value ) {
	// 	foreach ( $value as $value1 => $a ) {
	// 		if ( 'title' === $value1 ) {
	// 			$posttitle = $a;
	// 		} elseif ( 'content' === $value1 ) {
	// 			$postcontent = $a;
	// 		} elseif ( 'id' === $value1 ) {
	// 			$postid = $a;
	// 			//echo $postid;
	// 		}
	// 		if ( '' !== $posttitle && '' !== $postcontent && '' !== $postid ) {
	// 				$args = array(
	// 					//'ID'           => $postid,
	// 					'post_type'    => 'product_key',
	// 					'post_title'   => $posttitle,
	// 					'post_status'  => 'publish',
	// 					'post_content' => $postcontent,
	// 				);
	// 				$id_new   = wp_insert_post( $args, true );
	// 				$content1 = get_post( $id_new );
	// 				update_post_meta(
	// 					$content1->ID,
	// 					'price',
	// 					$value[0]
	// 				);
	// 				update_post_meta(
	// 					$content1->ID,
	// 					'sku',
	// 					$value[1]
	// 				);
	// 				update_post_meta(
	// 					$content1->ID,
	// 					'review',
	// 					$value[2]
	// 				);
	// 				$postcontent = '';
	// 				$posttitle   = '';
	// 				$postid      = '';
	// 				$count++;
	// 				//echo 'hello';
	// 		}
	// 	}
	// }
	// echo $count;



	the_content();
	if ( has_post_thumbnail() ) {
		the_post_thumbnail();
	}
	if ( '' != get_post_meta( get_the_ID(), 'price', true ) ) {
		echo '<center><h4>Price: </h4>' . esc_attr( get_post_meta( get_the_ID(), 'price', true ) ) . '</center>';
	}
	if ( '' != get_post_meta( get_the_ID(), 'sku', true ) ) {
		echo '<center><h4>Sku: </h4>' . esc_attr( get_post_meta( get_the_ID(), 'sku', true ) ) . '</center>';
	}
	if ( '' != get_post_meta( get_the_ID(), 'review', true ) ) {
		echo '<center><h4>Review: </h4>' . esc_attr( get_post_meta( get_the_ID(), 'review', true ) ) . '</center>';
	}


	if ( '' !== $options ) {
		$rating = get_post_meta( get_the_ID(), 'rating', true );
		if ( ! empty( $rating ) ) {
			echo '<center><h4>Rating : </h4>';
			for ( $x = 1; $x <= $rating; $x++ ) {
				?>
<i class="fa fa-star" aria-hidden="true"></i>
				<?php
			}
		}
		echo '</center>';
	}


endwhile; // End of the loop.

?>
</div>
<?php

get_footer();
