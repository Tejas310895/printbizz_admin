<section class="content">
    <div class="body_scroll">
        <div class="block-header">
            <div class="row">
                <div class="col-lg-7 col-md-6 col-sm-12">
                    <h2>Partners</h2>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="index.html"><i class="zmdi zmdi-home"></i> Home</a></li>
                        <li class="breadcrumb-item"><a href="javascript:void(0);">Partners</a></li>
                        <li class="breadcrumb-item active">List</li>
                    </ul>
                    <button class="btn btn-primary btn-icon mobile_menu" type="button"><i class="zmdi zmdi-sort-amount-desc"></i></button>
                </div>
                <div class="col-lg-5 col-md-6 col-sm-12">
                    <button class="btn btn-primary btn-icon float-right right_icon_toggle_btn" type="button"><i class="zmdi zmdi-arrow-right"></i></button>
                    <button href="products-view" class="btn btn-success btn-icon float-right" data-toggle="modal" data-target="#itemnaryModal" type="button"><i class="zmdi zmdi-plus"></i></button>
                </div>
            </div>
        </div>

        <div class="container-fluid">
            <!-- Basic Examples -->
            <div class="row clearfix">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="body">
                            <div class="table-responsive">
                                <table id="mainTable" class="table table-striped c_table">
                                    <thead>
                                        <tr>
                                            <th>Name</th>
                                            <th>Type</th>
                                            <th>Discount Price</th>
                                            <th>Minimum Order</th>
                                            <th>Upto Limit</th>
                                            <th>Status</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php

                                        use App\Models\Coupon;

                                        foreach ($coupons as $value) : ?>
                                            <tr>
                                                <td data-column="name" data-id="<?= $value['id'] ?>"><?= $value['name'] ?></td>
                                                <td data-column="type" data-id="<?= $value['id'] ?>"><?= Coupon::$types[$value['type']] ?></td>
                                                <td data-column="discount_price" data-id="<?= $value['id'] ?>"><?= $value['discount_price'] ?></td>
                                                <td data-column="minimum_order" data-id="<?= $value['id'] ?>"><?= $value['minimum_order'] ?></td>
                                                <td data-column="minimum_order" data-id="<?= $value['id'] ?>"><?= $value['upto_limit'] ?></td>
                                                <td data-column="status" data-id="<?= $value['id'] ?>"><?= Coupon::$statuses[$value['status']] ?></td>
                                            </tr>
                                        <?php endforeach ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
</section>

<!-- Large Size -->
<div class="modal fade" id="itemnaryModal" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <?= form_open('', ['id' => "coupon_form", 'onsubmit' => 'coupon_submit($(this));return false;']); ?>
            <input type="hidden" name="id" disabled>
            <div class="modal-header">
                <h4 class="title" id="largeModalLabel"></h4>
            </div>
            <div class="modal-body py-1">
                <div class="container-fluid">
                    <!-- Color Pickers -->
                    <div class="row clearfix">
                        <div class="col-lg-12 col-md-12 col-sm-12">
                            <div class="card mb-0">
                                <div class="body">
                                    <div class="row clearfix">
                                        <div class="col-sm-6">
                                            <div class="form-group has-success">
                                                <label for="exampleFormControlInput1" class="form-label">Coupon Name</label>
                                                <input type="text" name="name" class="form-control" required aria-required="true">
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="form-group has-success">
                                                <label for="exampleFormControlInput1" class="form-label">Coupon Type</label>
                                                <select class="form-control" name="type" aria-required="true" onchange="check_type($(this))">
                                                    <option value="" selected disabled>Select Type</option>
                                                    <?php foreach (Coupon::$types as $key => $value) : ?>
                                                        <option value="<?= $key ?>"><?= $value ?></option>
                                                    <?php endforeach ?>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="form-group has-success">
                                                <label for="exampleFormControlInput1" class="form-label">Discount Price</label>
                                                <input type="number" name="discount_price" class="form-control" required aria-required="true">
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="form-group has-success">
                                                <label for="exampleFormControlInput1" class="form-label">Minimum Order</label>
                                                <input type="number" name="minimum_order" class="form-control" required aria-required="true">
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="form-group has-success">
                                                <label for="exampleFormControlInput1" class="form-label">Upto Limit</label>
                                                <input type="number" name="upto_limit" class="form-control" required aria-required="true">
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="form-group has-success">
                                                <label for="exampleFormControlInput1" class="form-label">Status</label>
                                                <select class="form-control" name="status" aria-required="true">
                                                    <option value="" selected disabled>Select Status</option>
                                                    <?php foreach (Coupon::$statuses as $key => $value) : ?>
                                                        <option value="<?= $key ?>"><?= $value ?></option>
                                                    <?php endforeach ?>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- #END# Input Slider -->
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger btn-round waves-effect coupon_close" data-dismiss="modal">CLOSE</button>
                <button type="submit" class="btn btn-success btn-round waves-effect">SAVE CHANGES</button>
            </div>
        </div>
        <?= form_close() ?>
    </div>
</div>

<script>
    $('table td').on('change', function(evt, newValue) {
        var column = $(this).data('column');
        var id = $(this).data('id');
        if (column == 'name' || column == 'type' || column == 'status') {
            if (column == 'name') {
                edit_ajax(id, column, newValue);
            } else if (column == 'type') {
                if (newValue == 'Percent') {
                    edit_ajax(id, column, <?= Coupon::TYPE_PERCENT ?>);
                } else if (newValue == 'Amount') {
                    edit_ajax(id, column, <?= Coupon::TYPE_AMOUNT ?>);
                } else {
                    showNotification('bg-red', 'Invalid Value', 'top', 'right', '', '');
                }
            } else if (column == 'status') {
                if (newValue == 'Active') {
                    edit_ajax(id, column, <?= Coupon::STATUS_ACTIVE ?>);
                } else if (newValue == 'Inactive') {
                    edit_ajax(id, column, <?= Coupon::STATUS_INACTIVE ?>);
                } else {
                    showNotification('bg-red', 'Invalid Value', 'top', 'right', '', '');
                }
            }
        } else {
            if ($.isNumeric(newValue)) {
                edit_ajax(id, column, newValue);
            } else {
                showNotification('bg-red', 'Invalid Value', 'top', 'right', '', '');
            }
        }
    });

    function edit_ajax(id, column, newValue) {
        var csrf = $('input[name="csrf_test_name"]').val();
        $.ajax({
            type: "post",
            url: window.location.href,
            data: {
                'csrf_test_name': csrf,
                'id': id,
                [column]: newValue
            },
            success: function(response) {
                if (response.data == 1) {
                    $('.coupon_close').trigger('click');
                    showNotification('bg-green', 'Added Successfully', 'top', 'right', '', '');
                    setTimeout(() => {
                        location.reload();
                    }, 1000);
                } else {
                    showNotification('bg-red', 'Failed !Try Again', 'top', 'right', '', '');
                }
                $('input[name="csrf_test_name"]').val(response.csrf);
            }
        });
    }

    function coupon_submit(element) {
        var formData = new FormData(element[0]);
        formData.append("submit_coupon", "");
        $.ajax({
            type: "post",
            url: window.location.href,
            data: formData,
            cache: false,
            contentType: false,
            processData: false,
            success: function(response) {
                if (response.data == 1) {
                    $('.coupon_close').trigger('click');
                    showNotification('bg-green', 'Added Successfully', 'top', 'right', '', '');
                    setTimeout(() => {
                        location.reload();
                    }, 1000);
                } else {
                    showNotification('bg-red', 'Failed !Try Again', 'top', 'right', '', '');
                }
                $('input[name="csrf_test_name"]').val(response.csrf);
            }
        });

    }

    function check_type(element) {
        console.log(element.val() == <?= Coupon::TYPE_PERCENT ?>);
        if (element.val() == <?= Coupon::TYPE_PERCENT ?>) {
            $('input[name="discount_price"]').attr('max', '90');
        } else {
            $('input[name="discount_price"]').removeAttr('max');
        }
    }
</script>