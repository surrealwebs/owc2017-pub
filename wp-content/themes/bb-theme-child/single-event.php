<?php get_header(); ?>

<div class="container">
	<div class="row">

		<?php FLTheme::sidebar('left'); ?>

		<div class="fl-content <?php FLTheme::content_class(); ?>">
			<?php if(have_posts()) : while(have_posts()) : the_post(); ?>
				<?php get_template_part('content', 'single-event'); ?>
			<?php endwhile; endif; ?>
		</div>

		<?php FLTheme::sidebar('right'); ?>

	</div>
</div>

<?php get_footer(); ?>
