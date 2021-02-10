<div class="row">
    <div class="col-md-12">
        <div class="copyright">
            <p>Copyright © 2020 Inventory System.<br />
            </p>
        </div>
    </div>
</div>
</div>
</div>
<div class="modal" tabindex="-1" id="Modal">
    <div class="modal-dialog">
        <?php include_once($modal); ?>
    </div>
</div>
</div>
<?php $resultado = consul_calendary(); ?>
</div>



</div>
<!-- Jquery JS-->
<script src="vendor/fullcalendar-3.10.0/lib/jquery.min.js"></script>
 <!-- full calendar requires moment along jquery which is included above -->
 <script src="vendor/fullcalendar-3.10.0/lib/moment.min.js"></script>
    <script src="vendor/fullcalendar-3.10.0/fullcalendar.min.js"></script>
    <script src="vendor/fullcalendar-3.10.0/locale/es.js"></script>
    <script src="vendor/fullcalendar-3.10.0/lib/bootstrap-clockpicker.js"></script>
<!-- Bootstrap JS-->
<script src="vendor/bootstrap-4.1/popper.min.js"></script>
<script src="vendor/bootstrap-4.1/bootstrap.min.js"></script>
<!-- Vendor JS       -->
<script src="vendor/slick/slick.min.js">
</script>
<script src="vendor/wow/wow.min.js"></script>
<script src="vendor/animsition/animsition.min.js"></script>
<script src="vendor/bootstrap-progressbar/bootstrap-progressbar.min.js">
</script>
<script src="vendor/counter-up/jquery.waypoints.min.js"></script>
<script src="vendor/counter-up/jquery.counterup.min.js">
</script>
<script src="vendor/circle-progress/circle-progress.min.js"></script>
<script src="vendor/perfect-scrollbar/perfect-scrollbar.js"></script>
<script src="vendor/chartjs/Chart.bundle.min.js"></script>
<script src="vendor/select2/select2.min.js">
</script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>





<!-- Main JS-->
<script src="js/main.js"></script>
<script>
    window.setTimeout(function() {
        $(".alert").alert('close');
    }, 10000);
</script>


<!-- calendario -->


</body>

</html>
<!-- end document-->