<?php
$properties = json_decode(file_get_contents(
  get_template_directory_uri().'/customize/theme-properties.json'), true);

$css = array();

foreach ($properties as $section=>$props){
  foreach ($props as $name=>$arr){
    if(array_key_exists('selector', $arr) && array_key_exists('property', $arr)) {
      if (array_key_exists('default', $arr)) {
        $default = $arr['default'];
      } else {
        $default = '';
      }
      $selector = $arr['selector'];
      $property = $arr['property'];
      $value = get_theme_mod('archresp_'.$name, $default);

      $css[$selector][] = $property.':'.$value.';';
      
    } elseif (array_key_exists('selector', $arr) && array_key_exists('properties', $arr)) {
      if (array_key_exists('default', $arr)) {
        $default = $arr['default'];
      } else {
        $default = '';
      }
      $selector = $arr['selector'];
      $value = get_theme_mod('archresp_'.$name, $default);
      if ($value == false) {
        $value = 'true';
      } elseif ($value == true) {
        $value == 'true';
      }
      if ($value == $default) {
        continue;
      } else {
        $css[$selector][] = $properties[$value];
      }
    }
  }
}
?>

<style type='text/css'>
  <?php
  foreach($css as $selector=>$values) {
    echo $selector.'{';
    foreach($values as $item) { echo $item; }
    echo '}';
  }
  ?>
</style>
