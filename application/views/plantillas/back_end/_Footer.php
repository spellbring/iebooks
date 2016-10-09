


<!-- bottom footer -->
    <footer class="content-footer">

      <nav class="footer-right">
        <ul class="nav">
          <li>
            <a href="javascript:;">Feedback</a>
          </li>
          <li>
            <a href="javascript:;" class="scroll-up">
              <i class="fa fa-angle-up"></i>
            </a>
          </li>
        </ul>
      </nav>

      <nav class="footer-left">
        <ul class="nav">
          <li>
            <a href="javascript:;">Copyright <i class="fa fa-copyright"></i> <span>iebooks.com</span> 2015. All rights reserved</a>
          </li>
          <li>
            <a href="javascript:;">Careers</a>
          </li>
          <li>
            <a href="javascript:;">
                Privacy Policy
            </a>
          </li>
        </ul>
      </nav>

    </footer>
    <!-- /bottom footer -->

    <!-- CHAT -->
  </div>

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
  
</body>

</html>