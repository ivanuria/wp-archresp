<?php get_header() ?>
    <main>
      <article class='container'>
        <?php
          if(have_posts()) {
            while(have_posts()){
              the_post();
              ?>
              <h1><?php the_title() ?></h1>
              <?php
              the_content();
            }
          }
        ?>
      </article>
<?php get_footer() ?>
