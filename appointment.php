<style>
    #service-list tbody tr {
        cursor: pointer;
        transition: background-color 0.3s;
    }
    
    #service-list tbody tr:hover {
        background-color: #f0f8ff;
        color: black;
    }

    .form-group label {
        font-weight: bold;
        color: white;
    }

    .form-control {
        border-radius: 5px;
    }

    .btn-primary {
        background-color: #007bff;
        border: none;
        border-radius: 5px;
        padding: 10px 20px;
    }

    .btn-primary:hover {
        background-color: #0056b3;
    }

    .pop-msg {
        margin: 15px 0;
    }
</style>

<div class="py-3">
    <div class="card card-outline card-primary">
        <div class="card-header">
            <h5 class="card-title">Book an Appointment</h5>
            <div class="card-tools">
                <button class="btn btn-primary" type="button" onclick="location.replace(document.referrer)">
                    <i class="fa fa-angle-left"></i> Back
                </button>
            </div>
        </div>
        <div class="card-body">
            <div class="container-fluid">
                <form action="" id="appointment-form">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="fullname">Fullname</label>
                                <input type="text" name="fullname" id="fullname" class="form-control" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="contact">Contact #</label>
                                <input type="text" name="contact" id="contact" class="form-control" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="email">Email</label>
                                <input type="email" name="email" id="email" class="form-control" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="date">Schedule Date</label>
                                <input type="date" name="schedule" id="date" class="form-control" required>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <table class="table table-striped table-hover table-bordered" id="service-list">
                            <colgroup>
                                <col width="10%">
                                <col width="45%">
                                <col width="45%">
                            </colgroup>
                            <thead>
                                <tr>
                                    <th class=""></th>
                                    <th class="text-center">Service</th>
                                    <th class="text-center">Cost</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php 
                                    $service = $conn->query("SELECT * FROM `service_list` WHERE `status` = 1 ORDER BY `name` ASC");
                                    while($row = $service->fetch_assoc()):
                                ?>
                                <tr>
                                    <td class="text-center">
                                        <div class="form-check">
                                            <input class="form-check-input service_id" name="service_id[<?= $row['id'] ?>]" value="<?= $row['id'] ?>" type="checkbox">
                                            <input type="hidden" name="cost[<?= $row['id'] ?>]" value="<?= $row['cost'] ?>">
                                        </div>
                                    </td>
                                    <td><?= $row['name'] ?></td>
                                    <td class="text-right"><?= number_format($row['cost'], 2) ?></td>
                                </tr>
                                <?php endwhile; ?>
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th class="text-right" colspan="2">Total <input type="hidden" name="total" value="0"></th>
                                    <th class="text-right" id="total_amount">0.00</th>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                    <div class="col-12 text-center">
                        <button class="btn btn-primary btn-lg" type="submit">Book Now</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    function calc() {
        let total = 0;
        $('.service_id:checked').each(function() {
            const cost = $('input[name="cost[' + $(this).val() + ']"]').val();
            total += parseFloat(cost);
        });
        $('#total_amount').text(total.toLocaleString('en-US', { style: "decimal", minimumFractionDigits: 2, maximumFractionDigits: 2 }));
        $('[name="total"]').val(total);
    }

    $(function() {
        $('#service-list tbody tr').click(function() {
            const checkbox = $(this).find('.service_id');
            checkbox.prop("checked", !checkbox.is(":checked")).trigger("change");
            calc();
        });

        $('#appointment-form').submit(function(e) {
            e.preventDefault();
            const _this = $(this);
            if ($('.service_id:checked').length <= 0) {
                alert_toast("Please select at least 1 service first.", "warning");
                return false;
            }
            $('.pop-msg').remove();
            const el = $('<div>').addClass("pop-msg alert").hide();
            start_loader();
            $.ajax({
                url: _base_url_ + "classes/Master.php?f=save_appointment",
                data: new FormData($(this)[0]),
                cache: false,
                contentType: false,
                processData: false,
                method: 'POST',
                dataType: 'json',
                error: function(err) {
                    console.log(err);
                    alert_toast("An error occurred", 'error');
                    end_loader();
                },
                success: function(resp) {
                    if (resp.status === 'success') {
                        uni_modal("Success", "message.php");
                        $('#uni_modal').on('hide.bs.modal', function(e) {
                            location.reload();
                        });
                        $('#uni_modal').on('shown.bs.modal', function(e) {
                            end_loader();
                        });
                    } else if (resp.msg) {
                        el.addClass("alert-danger").text(resp.msg);
                        _this.prepend(el);
                    } else {
                        el.addClass("alert-danger").text("An error occurred due to an unknown reason.");
                        _this.prepend(el);
                    }
                    el.show('slow');
                    end_loader();
                    $('html, body').animate({ scrollTop: _this.offset().top }, 'fast');
                }
            });
        });
    });
</script>
