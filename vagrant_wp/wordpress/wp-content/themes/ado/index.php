<?php get_header(); ?>
<?php if (have_posts()) : while (have_posts()) : the_post(); ?>

<div class="l-nudge l-wrap">
  <mark><?php the_title() ?></mark>
  <p><?php the_content() ?></p>
</div>

<?php endwhile; endif; ?>
<?php get_footer(); ?>
