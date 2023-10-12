        </div>
    </div>
    <!-- Bootstrap core JavaScript-->
    <?php if ($this->uri->segment(1) != 'vendor' || $this->uri->segment(1) != 'laporan'): ?>

        <script src="<?php echo base_url() ?>assets/vendor/jquery/jquery.min.js"></script>
        
        <script src="<?php echo base_url() ?>assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

        <!-- Core plugin JavaScript-->
        <script src="<?php echo base_url() ?>assets/vendor/jquery-easing/jquery.easing.min.js"></script>

        <!-- Custom scripts for all pages-->
        <script src="<?php echo base_url() ?>assets/js/sb-admin-2.min.js"></script>

        <!-- Page level plugins -->
        <script src="<?php echo base_url() ?>assets/vendor/chart.js/Chart.min.js"></script>

        <!-- Page level custom scripts -->
        <script src="<?php echo base_url() ?>assets/js/demo/chart-area-demo.js"></script>
        <script src="<?php echo base_url() ?>assets/js/demo/chart-pie-demo.js"></script>
        <script src="<?php echo base_url() ?>assets/js/demo/datatables-demo.js"></script>
        <script src="<?php echo base_url() ?>assets/js/demo/datatables2-demo.js"></script>
        <script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js" crossorigin="anonymous"></script>
        <script src="https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap4.min.js" crossorigin="anonymous"></script>
    <?php endif ?>
    <!-- Bootstrap core JavaScript-->
        <script type="text/javascript">
            $(document).ready(function() {
                setInterval(function() {
                    $('#show').load('<?= base_url('Auth/notifikasi') ?>')
                }, 10000);
            });

            function notifikasi() {
                $.ajax({
                    type: "POST",
                    url: '<?= base_url('Auth/readAllNotification') ?>',
                    data:{action:'call_this'},
                    success:function(html) {

                    }
                });
            }
        </script>
    
</body>

</html>