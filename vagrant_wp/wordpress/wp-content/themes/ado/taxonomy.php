<?php get_header(); ?>

<div class="m-profile l-nudge l-wrap">
  <h1 class="t-head--higher"><?php single_term_title() ?></h1>
</div>
<div class="m-works">
  <div class="m-works__list">
    <?php if (have_posts()) : while (have_posts()) : the_post(); ?>

      <a href="<?php the_permalink() ?>" class="o-work">
        <?php if (has_post_thumbnail()): ?>
          <?php the_post_thumbnail("ado_project_thumb", array("class" => "o-work__image")); ?>
        <?php endif; ?>
        <div class="o-work__info">
          <h3 class="o-work__title t-head--bottom"><?php the_title(); ?></h3>
        </div>
      </a>

    <?php endwhile; else: ?>
      <mark class="o-error"><span class="o-error__icon ion-alert"></span><span class="o-error__text"> Nenalezeny žádné práce.</span></mark>
    <?php endif; ?>
  </div>
</div>

<section id="students" data-section class="m-students">
  <h2 class="t-head--high"><?php _e("Students & Graduates", "ado") ?></h2>
  <div class="m-students__content">
    <ul data-tabs class="o-tabs">
      <?php
        $args = array("hide_empty" => false);

        $group_taxonomies = array("bachelor", "master", "graduate");

        foreach ($group_taxonomies as $key=>$group_taxonomy):

          $terms = get_terms($group_taxonomy, $args);

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

<?php get_footer(); ?>
