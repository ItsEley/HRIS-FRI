    <script>
      var base_url = '<?php echo base_url() ?>';
    </script>

    <!-- Bootstrap Core JS -->
    <script src=<?= base_url("assets/js/bootstrap.bundle.min.js") ?>></script>
    <!-- Slimscroll JS -->
    <script src=<?= base_url("assets/js/jquery.slimscroll.min.js") ?>></script>
    <!-- Chart JS -->
    <script src=<?= base_url("assets/plugins/morris/morris.min.js") ?>></script>
    <script src=<?= base_url("assets/plugins/raphael/raphael.min.js") ?>></script>
    <script src=<?= base_url("assets/js/chart.js") ?>></script>
    <script src=<?= base_url("assets/js/greedynav.js") ?>></script>
    <!-- Theme Settings JS -->
    <script src=<?= base_url("assets/js/layout.js") ?>></script>
    <script src=<?= base_url("assets/js/theme-settings.js") ?>></script>
    <!-- Custom JS -->
    <script src=<?= base_url("assets/js/app.js") ?>></script>
    <script src=<?= base_url("assets/js/ajax.js") ?>></script>
    <script src="<?= base_url("assets/plugins/toastr/toastr.min.js");?>"></script>
    <script src="<?= base_url("assets/plugins/toastr/toastr.js");?>"></script>

    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.js"></script>
<script>
    $(document).ready(function() {
        $('#search-table').DataTable({
            "paging": true, // Enable paging
            "ordering": true, // Enable sorting
            "info": true // Enable table information display
            // You can add more options as needed
        });
    });
</script>

<script src="<?=base_url('assets/js/jquery.dataTables.min.js')?>"></script>
		<script src="<?=base_url('assets/js/dataTables.bootstrap4.min.js')?>"></script>
		
		 <!-- Theme Settings JS -->

		<script src="<?=base_url('assets/js/greedynav.js')?>"></script>
    <script>
      $(document).ready(function() {





      });
    </script>


    </body>

    </html>