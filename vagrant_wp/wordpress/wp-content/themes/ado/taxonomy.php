<?php
// Student Detail
get_header();
?>

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
        // Get only top-level terms.
        $author_term = 'person';
        $author_groups = get_terms($author_term, array(
          "orderby" => "id",
          "hide_empty" => false,
          "parent" => 0
        ));

        if (!empty($author_groups) && !is_wp_error($author_groups)):

          foreach ($author_groups as $author_group):
            $group_items = get_terms($author_term, array(
              "hide_empty" => false,
              "parent" => $author_group->term_id
            ));

            if(!empty($group_items) && !is_wp_error($group_items)):
      ?>
        <li class="o-tabs__item o-group o-group--<?php echo $author_group->slug ?>">
          <button class="o-tabs__link o-toggle t-link--secondary t-caps">
            <?php echo $author_group->name ?>
          </button>
          <div class="o-tabs__content">
            <ul class="o-people">
              <?php
                foreach ($group_items as $item):
                  $item_link = get_term_link($item);

                  if ($item->count > 0):
              ?>
                <li class="o-people__item"><a href="<?php echo esc_url($item_link) ?>" class="o-people__link t-link--primary"><?php echo $item->name ?></a></li>
              <?php else: ?>
                <li class="o-people__item"><?php echo $item->name ?></li>
              <?php endif; endforeach; ?>
          </div>
        </li>

      <?php endif; endforeach; endif; ?>
    </ul>
  </div>
</section>

<?php get_footer(); ?>
