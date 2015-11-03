<?php get_header(); ?>
<?php if (have_posts()) : while (have_posts()) : the_post(); ?>

<div class="l-nudge">
  <mark><?php the_title() ?></mark>
  <p class="t-paragraph"><?php the_content() ?></p>
</div>

<?php endwhile; endif; ?>
<?php get_footer(); ?>
