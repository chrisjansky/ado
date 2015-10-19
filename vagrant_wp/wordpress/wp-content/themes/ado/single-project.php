<?php
// Project Detail
get_header();
?>
<?php if (have_posts()) : while (have_posts()) : the_post(); ?>

<div class="l-nudge l-wrap">
  <h1 class="t-head--higher"><?php the_title() ?></h1>
  <div class="o-bar">
    <div class="o-bar__title">
      <span class="t-caps">
        <?php
          $post_taxonomies = array ("bachelor", "master", "graduate");
          // wp_get_post_terms for array of taxonomies, get_the_terms for just one
          $post_terms = wp_get_post_terms($post->ID, $post_taxonomies);

          if ($post_terms && ! is_wp_error($post_terms)) {
            $terms_array = array();

            foreach ($post_terms as $term) {
              $terms_array[] = $term->name;
            }

            $terms_concat = join(", ", $terms_array);
          }

          echo $terms_concat;
        ?>
      </span>
    </div>
    <div class="l-inline">
      <div class="l-inline__cell">
        <a href="<?php echo get_post_type_archive_link("project") ?>" class="o-iconlink">
          <i class="o-iconlink__icon--left ion-ios-arrow-left"></i>
          <span class="t-caps"> <?php _e("All Projects", "") ?></span>
        </a>
      </div>
      <div class="l-inline__cell">
        <?php
          $term_link = get_term_link($post_terms[0]);
        ?>
        <a href="<?php echo esc_url($term_link) ?>" class="o-iconlink">
          <span class="t-caps"><?php _e("More from this Student", "ado") ?> </span>
          <i class="o-iconlink__icon--right ion-ios-arrow-right"></i>
        </a>
      </div>
    </div>
  </div>
</div>

<?php $project_photos = simple_fields_values("sfg_images_item");
  if ($project_photos):
?>
  <div data-swiper class="o-carousel swiper-container l-wrap l-wrap--horizontal">
    <ul class="o-carousel__list swiper-wrapper">
      <?php foreach ($project_photos as $photo): ?>
        <li class="o-carousel__item o-carousel__item--large swiper-slide">
          <?php echo wp_get_attachment_image($photo["id"], "ado_project_full", false, array("class" => "o-carousel__image")) ?>
        </li>
      <?php endforeach; ?>
    </ul>
  </div>
<?php else: ?>
  <mark class="o-error"><span class="o-error__icon ion-alert"></span><span class="o-error__text"><?php _e("No Photos Found.", "ado") ?></span></mark>
<?php endif; ?>

<?php if (get_the_content()): ?>
  <div class="l-wrap o-description">
    <h2 class="t-head--low"><?php _e("About This Project", "ado") ?></h2>
    <p class="t-paragraph"><?php the_content(); ?></p>
  </div>
<?php endif; ?>

<?php endwhile; endif; ?>
<?php get_footer(); ?>
