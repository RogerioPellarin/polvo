        </div>
        <!-- end: MAIN CONTAINER -->
        <!-- start: FOOTER -->
        <div class="footer clearfix">
            <div class="footer-inner">
                <?=date("Y")?> &copy; Rogerio Pellarin Barbeiro.
            </div>
            <div class="footer-items">
                <span class="go-top"><i class="clip-chevron-up"></i></span>
            </div>
        </div>
        <!-- end: FOOTER -->
        <div id="event-management" class="modal fade" tabindex="-1" data-width="760" style="display: none;">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                            &times;
                        </button>
                        <h4 class="modal-title">Event Management</h4>
                    </div>
                    <div class="modal-body"></div>
                    <div class="modal-footer">
                        <button type="button" data-dismiss="modal" class="btn btn-light-grey">
                            Close
                        </button>
                        <button type="button" class="btn btn-danger remove-event no-display">
                            <i class='fa fa-trash-o'></i> Delete Event
                        </button>
                        <button type='submit' class='btn btn-success save-event'>
                            <i class='fa fa-check'></i> Save
                        </button>
                    </div>
                </div>
            </div>
        </div>
        <!-- start: MAIN JAVASCRIPTS -->
        <!--[if lt IE 9]>
        <script src="assets/plugins/respond.min.js"></script>
        <script src="assets/plugins/excanvas.min.js"></script>
        <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
        <![endif]-->
        <!--[if gte IE 9]><!-->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.0.3/jquery.min.js"></script>        
        <!--<![endif]-->
        <script src="<?=base_url()?>assets/plugins/jquery-ui/jquery-ui-1.10.2.custom.min.js"></script>
        <script src="<?=base_url()?>assets/plugins/bootstrap/js/bootstrap.min.js"></script>
        <script src="<?=base_url()?>assets/plugins/bootstrap-hover-dropdown/bootstrap-hover-dropdown.min.js"></script>
        <script src="<?=base_url()?>assets/plugins/blockUI/jquery.blockUI.js"></script>
        <script src="<?=base_url()?>assets/plugins/iCheck/jquery.icheck.min.js"></script>
        <script src="<?=base_url()?>assets/plugins/perfect-scrollbar/src/jquery.mousewheel.js"></script>
        <script src="<?=base_url()?>assets/plugins/perfect-scrollbar/src/perfect-scrollbar.js"></script>
        <script src="<?=base_url()?>assets/plugins/less/less-1.5.0.min.js"></script>
        <script src="<?=base_url()?>assets/plugins/jquery-cookie/jquery.cookie.js"></script>
        <script src="<?=base_url()?>assets/plugins/bootstrap-colorpalette/js/bootstrap-colorpalette.js"></script>
        <script src="<?=base_url()?>assets/js/main.js"></script>
        <!-- end: MAIN JAVASCRIPTS -->
        <script>
            jQuery(document).ready(function () {
                Main.init();
            });
        </script>
        <? if (isset($js_include)) print_r($js_include); ?>
    </body>
    <!-- end: BODY -->

</html>