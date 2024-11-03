<style>
    .list-group-item {
        transition: background-color 0.3s ease, color 0.3s ease;
    }
    
    .list-group-item:hover {
        background-color: #007bff; 
        color: white; 
    }

    .list-group-item a {
        color: white; 
        text-decoration: none; 
    }

    .list-group-item a:hover {
        color: white; 
    }
</style>

<h1 class="text-center mb-4">Our Services</h1>
<hr class="border-light">
<div class="container-fluid">
    <div class="row justify-content-center mb-4">
        <div class="col-md-5">
            <div class="input-group mb-2">
                <input type="search" id="search" class="form-control form-control-lg" placeholder="Search for services...">
                <div class="input-group-append">
                    <button type="button" class="btn btn-primary btn-lg">
                        <i class="fa fa-search"></i>
                    </button>
                </div>
            </div>
        </div>
    </div>
    <div class="list-group" id="service-list">
        <?php 
            $service = $conn->query("SELECT * FROM `service_list` WHERE `status` = 1 ORDER BY `name` ASC");
            while($row = $service->fetch_assoc()):
        ?>
        <div class="list-group-item service-item rounded-0">
            <a class="d-flex justify-content-between align-items-center" href="#service_<?= $row['id'] ?>" data-toggle="collapse">
                <h3 class="mb-0"><?= ucwords($row['name']) ?></h3>
                <i class="fa fa-plus collapse-icon"></i>
            </a>
            <div class="collapse" id="service_<?= $row['id'] ?>">
                <hr class="border-light">
                <div class="mx-3"><span class="fa fa-tags"></span> <?= number_format($row['cost'], 2) ?> RON</div>
                <p class="mx-3"><?= $row['description'] ?></p>
            </div>
        </div>
        <?php endwhile; ?>
        <?php if($service->num_rows < 1): ?>
            <center><span class="text-muted">No services available at the moment.</span></center>
        <?php endif; ?>
        <div id="no_result" style="display:none"><center><span class="text-muted">No services available at the moment.</span></center></div>
    </div>
</div>
<script>
    $(function(){
        $('.collapse').on('show.bs.collapse', function () {
            $(this).parent().siblings().find('.collapse').collapse('hide');
            $(this).parent().siblings().find('.collapse-icon').removeClass('fa-plus fa-minus').addClass('fa-plus');
            $(this).parent().find('.collapse-icon').removeClass('fa-plus').addClass('fa-minus');
        });
        $('.collapse').on('hidden.bs.collapse', function () {
            $(this).parent().find('.collapse-icon').removeClass('fa-minus').addClass('fa-plus');
        });

        $('#search').on("input", function() {
            var _search = $(this).val().toLowerCase();
            $('#service-list .service-item').each(function() {
                var _txt = $(this).text().toLowerCase();
                $(this).toggle(_txt.includes(_search));
                $("#no_result").toggle($('#service-list .service-item:visible').length <= 0);
            });
        });
    });
</script>
