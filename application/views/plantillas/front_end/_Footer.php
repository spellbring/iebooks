
  <!-- build:js({.tmp,app}) scripts/app.min.js -->
  <script src="<?php echo base_url('assets/scripts/extentions/modernizr.js'); ?>"></script>
  <script src="<?php echo base_url('assets/vendor/jquery/dist/jquery.js'); ?>"></script>
  <script src="<?php echo base_url('assets/vendor/bootstrap/dist/js/bootstrap.js'); ?>"></script>
  <script src="<?php echo base_url('assets/vendor/jquery.easing/jquery.easing.js'); ?>"></script>
  <script src="<?php echo base_url('assets/vendor/fastclick/lib/fastclick.js'); ?>"></script>
  <script src="<?php echo base_url('assets/vendor/onScreen/jquery.onscreen.js'); ?>"></script>
  <script src="<?php echo base_url('assets/vendor/jquery-countTo/jquery.countTo.js'); ?>"></script>
  <script src="<?php echo base_url('assets/vendor/perfect-scrollbar/js/perfect-scrollbar.jquery.js'); ?>"></script>
  <script src="<?php echo base_url('assets/scripts/ui/accordion.js'); ?>"></script>
  <script src="<?php echo base_url('assets/scripts/ui/animate.js'); ?>"></script>
  <script src="<?php echo base_url('assets/scripts/ui/link-transition.js'); ?>"></script>
  <script src="<?php echo base_url('assets/scripts/ui/panel-controls.js'); ?>"></script>
  <script src="<?php echo base_url('assets/scripts/ui/preloader.js'); ?>"></script>
  <script src="<?php echo base_url('assets/scripts/ui/toggle.js'); ?>"></script>
  <script src="<?php echo base_url('assets/scripts/urban-constants.js'); ?>"></script>
  <script src="<?php echo base_url('assets/scripts/extentions/lib.js'); ?>"></script>
  <!-- endbuild -->
  
  <!-- page level scripts -->
  <?php foreach($js as $jsVal) { ?>
  <script src="<?php echo base_url('assets/' . $jsVal); ?>.js"></script>
  <?php } ?>
  <!-- /page level scripts -->
  
  
  <!-- initialize page scripts -->
    <script src="<?php echo base_url('assets/scripts/pages/notifications.js'); ?>"></script>
  <!-- /initialize page scripts -->
  
  
  <?php if($this->session->userdata('sess_error_type')) { ?>
  <script>notifications('<?php echo $this->session->userdata('sess_error_msg'); ?>');</script>
  <?php } ?>
</body>

</html>
