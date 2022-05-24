<?php
/**
 * The template for displaying singular post-types: posts, pages and user-defined custom post types.
 *
 * @package HelloElementor
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}
?>
<?php
while ( have_posts() ) :
	the_post();
	?>

<main id="content" <?php post_class( 'site-main' ); ?> role="main">
	<?php if ( apply_filters( 'hello_elementor_page_title', true ) ) : ?>
		<header class="page-header">
			<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>
		</header>
	<?php endif; ?>
	<div class="page-content">
	</div>

</main>
<script>
	let retter = []
	const url = "http://charlottefranciska.dk/kea/rosetta/wp-json/wp/v2/retter";
async function getJson (){
	let response = await fetch(url);
	retter = await response.json(); 
		visRetter ();
}

function visRetter (){
	console.log(retter)
}

</script>
	<?php
endwhile;
