<h1 class="text-center text-primary">Welcome to <?php echo $_settings->info('name') ?></h1>
<hr class="border-info">
<div class="row text-center">
    <div class="col-12 col-sm-12 col-md-6 col-lg-3 mb-4">
        <div class="info-box" style="background-color: #4caf50; color: white;">
            <span class="info-box-icon" style="background-color: #388e3c;"><i class="fas fa-th-list"></i></span>
            <div class="info-box-content">
                <span class="info-box-text">All Services</span>
                <span class="info-box-number">
                    <?php 
                        echo $conn->query("SELECT * FROM `service_list` where status = 1")->num_rows;
                    ?>
                </span>
            </div>
            <!-- /.info-box-content -->
        </div>
        <!-- /.info-box -->
    </div>
    
    <div class="col-12 col-sm-12 col-md-6 col-lg-3 mb-4">
        <div class="info-box" style="background-color: #ff9800; color: white;">
            <span class="info-box-icon" style="background-color: #f57c20;"><i class="fas fa-calendar-day"></i></span>
            <div class="info-box-content">
                <span class="info-box-text">Pending Request</span>
                <span class="info-box-number">
                    <?php 
                        echo $conn->query("SELECT * FROM `appointment_list` where `status` = 0")->num_rows;
                    ?>
                </span>
            </div>
            <!-- /.info-box-content -->
        </div>
        <!-- /.info-box -->
    </div>
    
    <div class="col-12 col-sm-12 col-md-6 col-lg-3 mb-4">
        <div class="info-box" style="background-color: #2196f3; color: white;">
            <span class="info-box-icon" style="background-color: #1976d2;"><i class="fas fa-calendar-check"></i></span>
            <div class="info-box-content">
                <span class="info-box-text">Verified Appointment</span>
                <span class="info-box-number">
                    <?php 
                        echo $conn->query("SELECT * FROM `appointment_list` where `status` = 1")->num_rows;
                    ?>
                </span>
            </div>
            <!-- /.info-box-content -->
        </div>
        <!-- /.info-box -->
    </div>
</div>
