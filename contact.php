<div class="col-12">
    <div class="row justify-content-center">
        <div class="card card-outline card-primary col-md-5 my-5">
            <div class="card-header">
                <h4 class="card-title text-center">Contact Us</h4>
            </div>
            <div class="card-body">
                <dl class="row">
                    <dt class="col-sm-4 text-muted"><i class="fa fa-envelope"></i> Email:</dt>
                    <dd class="col-sm-8 pr-4"><?= $_settings->info('email') ?></dd>

                    <dt class="col-sm-4 text-muted"><i class="fa fa-phone"></i> Contact #:</dt>
                    <dd class="col-sm-8 pr-4"><?= $_settings->info('contact') ?></dd>

                    <dt class="col-sm-4 text-muted"><i class="fa fa-map-marked-alt"></i> Location:</dt>
                    <dd class="col-sm-8 pr-4"><?= $_settings->info('address') ?></dd>

                    <dt class="col-sm-4 text-muted"><i class="fa fa-clock"></i> Open Time:</dt>
                    <dd class="col-sm-8 pr-4"><?= date("h:i A",strtotime($_settings->info('from_time'))) . " - " . date("h:i A",strtotime($_settings->info('to_time'))) ?></dd>
                </dl>
            </div>
        </div>
    </div>
</div>
