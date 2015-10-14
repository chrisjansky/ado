<?php
/*
Template Name: Archive
*/
get_header(); ?>

<div class="l-nudge l-wrap">
  <h1 class="t-head--higher">Všechny aktuality</h1>
</div>

<div class="m-archive">
  <div class="m-archive__list">

    <?php
      $news_paged = (get_query_var("paged")) ? get_query_var("paged") : 1;

      query_posts(array(
        "category_name" => "news",
        "posts_per_page" => 5,
        "paged" => $news_paged
      ));
      if (have_posts()) : while (have_posts()) : the_post();
    ?>
      <article id="news-<?php the_ID(); ?>" class="o-archived">
        <h2 class="o-archived__title t-head--high"><?php the_title() ?></h2>
        <span class="o-archived__date t-smallcaps"><?php the_date() ?></span>

        <?php $news_photos = simple_fields_values("sfg_images_item");
          if ($news_photos):
        ?>
          <div data-swiper class="o-carousel swiper-container">
            <ul class="o-carousel__list swiper-wrapper">
              <?php foreach ($news_photos as $photo): ?>
                <li class="o-carousel__item o-carousel__item--small swiper-slide">
                  <?php echo wp_get_attachment_image($photo["id"], "ado_post_full", false, array("class" => "o-carousel__image")) ?>
                </li>
              <?php endforeach; ?>
            </ul>
          </div>
        <?php endif; ?>

        <div class="o-archived__content">
          <p class="p-text"><?php the_content() ?></p>
        </div>
      </article>
    <?php endwhile; ?>
  </div>

  <div class="l-wrap">
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

<?php endif; ?>
<?php get_footer(); ?>
