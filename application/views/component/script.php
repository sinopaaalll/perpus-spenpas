<script src="<?= base_url('assets'); ?>/js/plugins/popper.min.js"></script>
<script src="<?= base_url('assets'); ?>/js/plugins/simplebar.min.js"></script>
<script src="<?= base_url('assets'); ?>/js/plugins/bootstrap.min.js"></script>
<script src="<?= base_url('assets'); ?>/js/fonts/custom-font.js"></script>
<!-- <script src="<?= base_url('assets'); ?>/js/config.js"></script> -->
<script src="<?= base_url('assets'); ?>/js/pcoded.js"></script>
<script src="<?= base_url('assets'); ?>/js/plugins/feather.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="<?= base_url('assets'); ?>/js/plugins/jquery.dataTables.min.js"></script>
<script src="<?= base_url('assets'); ?>/js/plugins/dataTables.bootstrap5.min.js"></script>
<!-- Sweet Alert -->
<script src="<?= base_url('assets'); ?>/js/plugins/sweetalert2.all.min.js"></script>
<script src="https://unpkg.com/html5-qrcode" type="text/javascript"></script>

<!-- Config Warna -->
<script>
    var theme_contrast = 'false'; // [ false , true ]
    var caption_show = 'true'; // [ false , true ]
    var preset_theme = 'preset-2'; // [ preset-1 to preset-10 ]
    var dark_layout = 'false'; // [ false , true , default ]
    var rtl_layout = 'false'; // [ false , true ]
    var box_container = 'false'; // [ false , true ]
    var version = 'v9.0';
</script>



<script>
    $(document).ready(function() {
        $('#dataTable').DataTable({
            "paging": true,
            "searching": true,
            "ordering": false,
            "info": true,
            "lengthChange": true
        });
    });
</script>