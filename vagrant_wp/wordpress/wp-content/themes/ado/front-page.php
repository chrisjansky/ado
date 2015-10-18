<?php get_header(); ?>
<?php if (have_posts()) : while (have_posts()) : the_post(); ?>

<section style="background-image: url('<?php echo get_template_directory_uri() ?>/library/images/bg_top.jpg');" class="m-hero">
  <h1 class="t-head--top m-hero__head">
    <?php echo simple_fields_value("sfg_homepage_title"); ?>
  </h1>
  <a href="#gallery" data-scrollto class="m-hero__arrow link-arrow ion-ios-arrow-down"></a>
</section>

<section id="gallery" data-section data-mixitup class="m-gallery">
  <div class="l-wrap">
    <h2 class="t-head--higher"><?php _e("Selected Projects", "ado") ?></h2>
    <ul class="o-filter">
      <li class="o-filter__item">
        <button data-filter="all" class="o-toggle t-caps"><?php _e("All", "ado") ?></button>
      </li>
      <li class="o-filter__item">
        <button data-filter=".awarded" class="o-toggle t-caps"><?php _e("Awarded", "ado") ?></button>
      </li>
      <li class="o-filter__item">
        <button data-filter=".collaboration" class="o-toggle t-caps"><?php _e("Collaborations", "ado") ?></button>
      </li>
      <li class="o-filter__item">
        <button data-filter=".bachelor" class="o-toggle t-caps"><?php _e("Bachelor’s", "ado") ?></button>
      </li>
      <li class="o-filter__item">
        <button data-filter=".master" class="o-toggle t-caps"><?php _e("Master’s", "ado") ?></button>
      </li>
      <li class="o-filter__item">
        <button data-filter=".finals" class="o-toggle t-caps"><?php _e("Finals", "ado") ?></button>
      </li>
    </ul>
    <div class="m-works">
      <div class="m-works__list">

        <?php
          $projects_args = array(
            "post_type" => "project",
          );
          $projects_posts = get_posts($projects_args);
          foreach ($projects_posts as $post) : setup_postdata($post);

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

          // Get list of project types assigned to current post
          $post_types = wp_get_post_terms($post->ID, "type");

          if ($post_types && ! is_wp_error($post_types)) {
            $types_array = array();

            foreach ($post_types as $type) {
              $types_array[] = $type->slug;
            }

            // Create string separated by spaces, to output in class list
            $types_concat = join(" ", $types_array);
          }
        ?>

        <a href="<?php the_permalink() ?>" data-target class="o-work <?php echo $types_concat ?>">
          <?php if (has_post_thumbnail()): ?>
            <?php the_post_thumbnail("ado_project_thumb", array("class" => "o-work__image")); ?>
          <?php endif; ?>
          <div class="o-work__info">
            <h3 class="o-work__title t-head--bottom"><?php the_title(); ?></h3>
            <span class="o-work__name t-smallcaps"><?php echo $terms_concat ?></span>
          </div>
        </a>

        <?php endforeach; wp_reset_postdata(); ?>

      </div>
      <a id="js-workbutton" href="<?php echo get_post_type_archive_link("project") ?>" class="m-works__link o-textlink t-link--primary"><?php _e("More Projects", "ado") ?></a>
    </div>
  </div>
</section>

<section id="about" data-section class="m-about">
  <div class="l-wrap l-wrap--horizontal">
    <h2 class="m-about__title t-head--higher"><?php _e("About Us", "ado") ?></h2>
    <p class="m-about__text t-paragraph"><?php the_content(); ?></p>
    <a href="http://www.utb.cz/fmk/struktura/design-obuvi" class="o-textlink t-link--primary"><?php _e("More Info", "ado") ?></a>
  </div>
  <div class="m-news l-wrap">
    <h2 class="m-news__title t-head--higher"><?php _e("News", "ado") ?></h2>
    <div class="m-news__list">

      <?php
        $news_args = array("posts_per_page" => 3);
        $news_posts = get_posts($news_args);

        $archive_link = get_permalink(get_page_by_path("archive"));

        foreach ($news_posts as $post) : setup_postdata($post);
          $post_link = $archive_link . "#section-news-" . get_the_ID();
      ?>

        <article class="o-featured">
          <a href="<?php echo $post_link ?>" class="o-featured__link">
            <h4 class="o-featured__title t-head--high">
              <?php the_title() ?>
            </h4>
          </a>
          <?php if (has_post_thumbnail()): ?>
            <a href="<?php echo $post_link ?>" class="o-featured__thumbnail">
              <?php the_post_thumbnail("ado_post_thumb", array("class" => "o-featured__image")); ?>
              <span class="o-featured__overlay ion-chevron-right"></span>
            </a>
          <?php endif; ?>
          <p class="o-featured__text t-paragraph"><?php the_excerpt() ?></p>
          <a href="<?php echo $post_link ?>" class="o-featured__button t-link--light ion-more"></a>
        </article>

      <?php endforeach; wp_reset_postdata(); ?>

    </div>
    <a href="<?php echo $archive_link ?>" class="o-textlink t-link--primary"><?php _e("Archive", "ado") ?></a>
  </div>
</section>
<section id="students" data-section class="m-students">
  <h2 class="t-head--higher"><?php _e("Students & Graduates", "ado") ?></h2>
  <div class="m-students__content">
    <ul data-tabs class="o-tabs">
      <?php
        $group_taxonomies = array("bachelor", "master", "graduate");

        foreach ($group_taxonomies as $key=>$group_taxonomy):

          $terms = get_terms($group_taxonomy, array("hide_empty" => false));

          if (!empty($terms) && !is_wp_error($terms)):

            switch ($group_taxonomy) {
              case "bachelor":
                $group_slug = "bca";
                $group_title = "Bachelors";
                break;
              case "master":
                $group_slug = "mga";
                $group_title = "Masters";
                break;
              case "graduate":
                $group_slug = "grad";
                $group_title = "Graduates";
                break;
            } ?>

            <li class="o-tabs__item o-group o-group--<?php echo $group_slug ?>">
              <button class="o-tabs__link o-toggle t-link--secondary t-caps">
                <?php _e($group_title, "ado") ?>
              </button>
              <div class="o-tabs__content">
                <ul class="o-people">

                  <?php foreach ($terms as $term):
                    $term_link = get_term_link($term);

                    if ($term->count > 0): ?>
                      <li class="o-people__item"><a href="<?php echo esc_url($term_link) ?>" class="o-people__link t-link--primary"><?php echo $term->name ?></a></li>
                    <?php else: ?>
                      <li class="o-people__item"><?php echo $term->name ?></li>
                  <?php endif; endforeach; ?>

                </ul>
              </div>
            </li>
          <?php endif;
        endforeach;
      ?>
    </ul>
  </div>
</section>
<section id="contact" data-section class="m-contact">
  <div class="l-wrap">
    <h2 class="m-contact__title t-head--higher"><?php _e("Contact", "ado") ?></h2>
    <div class="m-contact__list">
      <div class="m-contact__item">
        <?php echo simple_fields_value("sfg_homepage_contact1"); ?>
      </div>
      <div class="m-contact__item">
        <?php echo simple_fields_value("sfg_homepage_contact2"); ?>
      </div>
      <div class="m-contact__item">
        <?php echo simple_fields_value("sfg_homepage_contact3"); ?>
      </div>
    </div>
  </div>
  <div id="js-map" class="o-map"></div>
</section>

<?php endwhile; endif; ?>
<?php get_footer(); ?>
