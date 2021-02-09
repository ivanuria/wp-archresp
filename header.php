<!doctype html>
<html>
  <head>
    <!-- Meta -->
    <meta charset='utf-8'>
    <!-- Bootstrap CSS -->
    <?php
      wp_head();
    ?>
  </head>
  <body>
    <header>
      <div class='container'>
        <div class='row'>
          <div class='col-sm-4'>
            <a href="<?php echo get_bloginfo( 'url' ); ?>">
              <?php
              $logo = get_theme_mod('archresp_title_logo');
              if($logo != '') {
                $logo_id = attachment_url_to_postid($logo);
                $logo_alt = get_post_meta($logo_id, '_wp_attachment_image_alt', true);
                ?>
                <img class="logo" src="<?php echo $logo; ?>" alt="<?php echo $logo_alt; ?>" />
                <?php
              } else {
                echo get_bloginfo( 'name' );
              }
              ?>
            </a>
          </div>
          <?php
            if (get_theme_mod('archresp_head_menu', 'true')) {
              wp_nav_menu(
                array(
                  'menu' => 'primary',
                  'theme_location' => 'primary',
                  'menu_id' => 'primary-menu',
                  'menu_class' => 'primary-menu col-sm-8',
                  'container_class' => 'primary-menu-container',
                  'container_id' => 'primary-menu-container'
                )
              );
            }
          ?>
        </div>
      </div>
    </header>
