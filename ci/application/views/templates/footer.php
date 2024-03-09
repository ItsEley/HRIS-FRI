    <script>
      var base_url = '<?php echo base_url()?>';
    </script>
    <script src= <?=base_url("assets/js/jquery-3.7.1.min.js")?>></script>
      <!-- Bootstrap Core JS -->
      <script src= <?=base_url("assets/js/bootstrap.bundle.min.js")?>></script>
      <!-- Slimscroll JS -->
      <script src= <?=base_url("assets/js/jquery.slimscroll.min.js")?>></script>
      <!-- Chart JS -->
      <script src= <?=base_url("assets/plugins/morris/morris.min.js")?>></script>
      <script src= <?=base_url("assets/plugins/raphael/raphael.min.js")?>></script>
      <script src= <?=base_url("assets/js/chart.js")?>></script>
      <script src= <?=base_url("assets/js/greedynav.js")?>></script>
      <!-- Theme Settings JS -->
      <script src= <?=base_url("assets/js/layout.js")?>></script>
      <script src= <?=base_url("assets/js/theme-settings.js")?>></script>
      <!-- Custom JS -->
      <script src= <?=base_url("assets/js/app.js")?>></script>
		<script src= <?=base_url("assets/js/ajax.js")?>></script>
    <script>
    // function previewFile() {
    //     const preview = document.getElementById('previewImage');
    //     const file = document.getElementById('uploadInput').files[0];
    //     const reader = new FileReader();

    //     reader.onloadend = function () {
    //         preview.src = reader.result;
    //     };

    //     if (file) {
    //         reader.readAsDataURL(file);
    //     } else {
    //         preview.src = "<?php //echo $this->session->userdata('pfp'); ?>";
    //     }
    // }
</script>


</body>
</html>