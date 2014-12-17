<?php

/**
 * Template Main Post Home.
 *
 * @package InkID
 */

?>

	<article class="main-post-index">
		<header>
			<h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
		</header>
		<div>
			<p><?php the_excerpt(); ?></p>
		</div>
		<a href="<?php the_permalink(); ?>" class=""><button>Leia mais</button></a>
	</article>