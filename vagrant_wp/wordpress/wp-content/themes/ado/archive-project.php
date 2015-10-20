<?php
// Projects Listing
get_header();
?>

<div class="l-nudge l-wrap">
  <h1 class="t-head--higher">
    <?php
      $current_term = get_query_var("term");

      if ($current_term == null) {
        // First item is active.
        $link_class = "o-filter__link--active";

        _e("All Projects", "ado");
      } else {
        // Assign in the other foreach loop.
        $link_class = "";

        printf(__("%s Projects", "ado"), single_term_title("", false));
      }
    ?>
  </h1>

  <ul class="o-filter">
    <li class="o-filter__item">
      <a href="<?php echo get_post_type_archive_link("project") ?>" class="<?php echo $link_class ?> t-link--secondary t-caps"><?php _e("All", "ado") ?></a>
    </li>

    <?php
      $project_terms = get_terms("type", array("orderby" => "id", "hide_empty" => false));

      foreach ($project_terms as $term):

        if ($term->name == single_term_title("", false)) {
          $link_class = "o-filter__link--active";
        } else {
          $link_class = "";
        }
    ?>
      <li class="o-filter__item">
        <a href="<?php echo get_term_link($term) ?>" class="<?php echo $link_class ?> t-link--secondary t-caps"><?php _e($term->name, "ado") ?></a>
      </li>
    <?php endforeach; ?>

  </ul>

  <div class="m-works">

    <div class="m-works__list">
      <?php
        if (have_posts()) : while (have_posts()) : the_post();

        // Get list of authors assigned to current post
        $post_taxonomies = array('author');
        // wp_get_post_terms for array of taxonomies, get_the_terms for just one
        $post_terms = wp_get_post_terms($post->ID, $post_taxonomies);

        if ($post_terms && ! is_wp_error($post_terms)) {
          $terms_array = array();

          foreach ($post_terms as $term) {
            $terms_array[] = $term->name;
          }

          $terms_concat = join(", ", $terms_array);
        } else {
          $terms_concat = null;
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
          "prev_text" => "&larr;",
          "next_text" => "&rarr;"
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
