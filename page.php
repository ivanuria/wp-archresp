<?php get_header() ?>
    <main>
      ?>
      <div class='hero_container'>
        <?php
          if (get_theme_mod('archresp_hero_page_active')) {
        ?>
        <div class='hero_image' style="background-image:url('<?php if(has_post_thumbnail()){the_post_thumbnail();} ?>')">
        </div>
        <?php
          }
        ?>
        <div class='hero_title container'>
          <h1><?php the_title() ?></h1>
        </div>
      </div>
      <article class='container'>
        <?php
          if(have_posts()) {
            while(have_posts()){
              the_post();
              the_content();
            }
          }
        ?>
      </article>
    </main>
<?php get_footer() ?>
