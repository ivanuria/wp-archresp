<!doctype html>
<html>
  <head>
    <!-- Meta -->
    <meta charset="<?php bloginfo( 'charset' ); ?>">
		<meta name="viewport" content="width=device-width, initial-scale=1.0" >
    <!-- Bootstrap CSS -->
    <?php
      wp_head();
    ?>
  </head>
  <body <?php echo body_class() ?>>
    <?php
		wp_body_open();
		?>
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
