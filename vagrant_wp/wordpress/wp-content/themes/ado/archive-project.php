<?php get_header(); ?>

<div class="l-nudge l-wrap">
  <h1 class="t-head--higher">Všechny práce</h1>

  <ul class="o-filter">
    <li class="o-filter__item">
      <a href="<?php echo get_post_type_archive_link("project") ?>" class="o-filter__link--active t-link--secondary t-caps">Vše</a>
    </li>

    <?php
      $project_terms = get_terms("type", array("hide_empty" => false));

      foreach ($project_terms as $term):
    ?>
      <li class="o-filter__item">
        <a href="<?php echo get_term_link($term) ?>" class="t-link--secondary t-caps"><?php echo $term->name; ?></a>
      </li>
    <?php endforeach; ?>

  </ul>

  <div class="m-works">

    <div class="m-works__list">
      <?php if (have_posts()) : while (have_posts()) : the_post();

        // Get list of authors assigned to current post
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
      ?>

        <a href="<?php the_permalink() ?>" class="o-work">
          <?php if (has_post_thumbnail()): ?>
            <?php the_post_thumbnail("ado_project_thumb", array("class" => "o-work__image")); ?>
          <?php endif; ?>
          <div class="o-work__info">
            <h3 class="o-work__title t-head--bottom"><?php the_title(); ?></h3>
            <span class="o-work__name t-smallcaps"><?php echo $terms_concat ?></span>
          </div>
        </a>

      <?php endwhile; endif; ?>
    </div>

    <ul class="o-pagination">
      <?php
        $project_pagination = paginate_links(array(
          "type" => "array",
          "prev_text" => __("&larr;"),
          "next_text" => __("&rarr;")
        ));

        if ($project_pagination):
          foreach ($project_pagination as $page):
      ?>
        <li class="o-pagination__item"><?php echo $page ?></li>
      <?php endforeach; endif; ?>
    </ul>

  </div>

</div>

<?php get_footer(); ?>