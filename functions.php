<?php

// Adds dynamic things from Wordpress
add_theme_support('title-tag');

// Register CSS
function archresp_register_styles() {
  $version = wp_get_theme()->get('Version');
  wp_enqueue_style(
    'archresp-main-style',
    get_template_directory_uri().'/style.css',
    array('archresp-bootstrap'),
    $version,
    'all');
  wp_enqueue_style(
    'archresp-bootstrap',
    'https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css',
    array(),
    '5.0.0',
    'all');
  wp_enqueue_style(
    'archresp-bootstrap-icons',
    'https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css',
    array(),
    '1.3.0',
    'all');
}
add_action('wp_enqueue_scripts', 'archresp_register_styles');

// Register Javascript
function archresp_register_scripts() {
  $version = wp_get_theme()->get('Version');
  wp_enqueue_script(
    'archresp-main',
    get_template_directory_uri().'/assets/javascript/main.js',
    array('archresp-bootstrap'),
    $version,
    true
  );
  wp_enqueue_script(
    'archresp-bootstrap',
    'https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js',
    array(),
    '5.0.0',
    true
  );
}
add_action('wp_enqueue_scripts', 'archresp_register_scripts');

// Register Menus
function archresp_register_menus() {
  $locations = array(
    'primary' => 'Header Menu',
    'left' => 'Left Sidebar',
    'right' => 'Right Sidebar',
    'footer' => 'Footer Menu'
  );
  register_nav_menus($locations);
}
add_action('init', 'archresp_register_menus');

function archresp_customize_register( $wp_customize ) {
  $sections = json_decode(file_get_contents(
    get_template_directory_uri().'/customize/theme-sections.json'), true);
  $properties = json_decode(file_get_contents(
    get_template_directory_uri().'/customize/theme-properties.json'), true);
  $selects = json_decode(file_get_contents(
    get_template_directory_uri().'/customize/css-configuration.json'), true);
  foreach ($sections as $name=>$label) {
    $wp_customize->add_section(
      'archresp_'.$name,
      array(
        'title' => __($label, 'wp-archresp')
      )
    );
  }

  $obj_controls = array(
    'color' => 'WP_Customize_Color_Control',
    'image' => 'WP_Customize_Image_Control',
    'media' => 'WP_Customize_Media_Control',
  );
  $default_sections = array(
    'title_tagline',
    'colors',
    'header_image',
    'background_image',
    'menus',
    'widgets',
    'static_front_page'
  );

  foreach ($properties as $section=>$props){
    foreach ($props as $name=>$arr){
      if (array_key_exists('control', $arr)) {
        $control = $arr['control'];
      } else {
        $control = 'text';
      }
      if (array_key_exists('label', $arr)) {
        $label = $arr['label'];
      } else {
        $label = $name;
      }
      if (array_key_exists('default', $arr)) {
        $default = $arr['default'];
      } else {
        $default = '';
      }
      if (array_key_exists('transport', $arr)) {
        $transport = $arr['transport'];
      } else {
        $transport = 'refresh';
      }
      if (array_key_exists('property', $arr)) {
        $property = $arr['property'];
      } else {
        $property = '';
      }
      if (!array_key_exists($section, $default_sections)) {
        $section_name = 'archresp_'.$section;
      } else {
        $section_name = $section;
      }


      $wp_customize->add_setting(
        'archresp_'.$name,
        array(
          'type' => 'theme_mod',
          'default' => $default,
          'transport' => $transport,
          )
        );

      if (array_key_exists($control, $obj_controls)) {
        $wp_customize->add_control(
          new $obj_controls[$control](
             $wp_customize,
             'archresp_'.$name,
             array(
              	'label' => __($label, 'wp-archresp'),
              	'section' => $section_name,
              	'settings' => 'archresp_'.$name,
            )
          )
        );
      } elseif ($control == 'select') {
        if (array_key_exists('choices', $arr)) {
          $choices = $arr['choices'];
        } elseif (array_key_exists($property, $selects)) {
          $choices = $selects[$property];
        } else {
          $choices = array('No Definido'=>'undefined');
        }
        $wp_customize->add_control(
          'archresp_'.$name,
          array(
            'type' => $control,
          	'label' => __($label, 'wp-archresp'),
          	'section' => $section_name,
          	'settings' => 'archresp_'.$name,
            'choices' => $choices
          )
        );
      } else {
        $wp_customize->add_control(
          'archresp_'.$name,
          array(
            'type' => $control,
          	'label' => __($label, 'wp-archresp'),
          	'section' => $section_name,
          	'settings' => 'archresp_'.$name,
          )
        );
      }
    }
  }
}

add_action( 'customize_register', 'archresp_customize_register' );


// CSS Bindings
function archresp_customize_css() {
  include 'customize/theme-css.php';
}
add_action('wp_head', 'archresp_customize_css');

?>
