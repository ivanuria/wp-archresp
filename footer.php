<footer>
  <div class="container">
<?php
  $copyright = get_theme_mod('archresp_footer_copyright');
  if($copyright != "") {
    ?>
    <div class="copyright">
      <p>© <?php echo date("Y")." ".$copyright; ?></p>
    </div>
    <?php
  }
?>
</div>
</footer>

<?php
wp_footer();
?>
</body>
</html>
