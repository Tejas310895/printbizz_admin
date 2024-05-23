<section class="content">
    <div class="body_scroll">
        <div class="block-header">
            <div class="row">
                <div class="col-lg-7 col-md-6 col-sm-12">
                    <h2>Institutions</h2>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="index.html"><i class="zmdi zmdi-home"></i> Home</a></li>
                        <li class="breadcrumb-item"><a href="javascript:void(0);">Institutions</a></li>
                        <li class="breadcrumb-item active">List</li>
                    </ul>
                    <button class="btn btn-primary btn-icon mobile_menu" type="button"><i class="zmdi zmdi-sort-amount-desc"></i></button>
                </div>
                <div class="col-lg-5 col-md-6 col-sm-12">
                    <button class="btn btn-primary btn-icon float-right right_icon_toggle_btn" type="button"><i class="zmdi zmdi-arrow-right"></i></button>
                    <button href="products-view" class="btn btn-success btn-icon float-right" onclick="open_modal()" type="button"><i class="zmdi zmdi-plus"></i></button>
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
                                <table class="table table-bordered table-striped table-hover js-basic-example dataTable">
                                    <thead>
                                        <tr>
                                            <th>Name</th>
                                            <th>Bank Details</th>
                                            <th>Gst Details</th>
                                            <th>Colleges</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($partners as $value) : ?>
                                            <tr>
                                                <td><?= $value['name'] ?></td>
                                                <?php
                                                $bank_str = '';
                                                foreach (json_decode($value['bank_details'], true) as $key => $det) {
                                                    $bank_str .= ucfirst($key . ' : ' . $det);
                                                    $bank_str .= '</br>';
                                                }

                                                ?>
                                                <td><?= $bank_str ?></td>
                                                <?php
                                                $gst_str = '';
                                                foreach (json_decode($value['gst_details'], true) as $key => $gdet) {
                                                    $gst_str .= ucfirst($key . ' : ' . $gdet);
                                                    $gst_str .= '</br>';
                                                }

                                                ?>
                                                <td><?= $gst_str ?></td>
                                                <?php
                                                $col_str = '';
                                                foreach (json_decode($value['college_assigned_id'], true) as $key => $cdet) {
                                                    $col_str .= $colleges[$cdet]['name'];
                                                    $col_str .= '</br>';
                                                }

                                                ?>
                                                <td><?= $col_str ?></td>
                                                <td>
                                                    <button onclick="open_modal(<?= $value['id'] ?>)" class="btn btn-primary btn-sm"><i class="zmdi zmdi-edit"></i></button>
                                                    <button onclick="delete_product(<?= $value['id'] ?>)" class="btn btn-danger btn-sm"><i class="zmdi zmdi-delete"></i></button>
                                                </td>
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
            <?= form_open('', ['id' => "group_form", 'onsubmit' => 'submit_group($(this));return false;']); ?>
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
                                                <label for="exampleFormControlInput1" class="form-label">Partner Name</label>
                                                <input type="text" name="user[name]" class="form-control" required aria-required="true">
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="form-group has-success">
                                                <label for="exampleFormControlInput1" class="form-label">Partner email</label>
                                                <input type="email" name="user[email]" class="form-control" required aria-required="true">
                                            </div>
                                        </div>
                                        <div class="col-sm-12">
                                            <div class="form-group has-success">
                                                <label for="exampleFormControlInput1" class="form-label">Colleges</label>
                                                <select class="form-control show-tick" name="college_assigned_id[]" id="itemnary_select" multiple required aria-required="true" data-live-search="true">
                                                    <?php foreach ($colleges as $value) : ?>
                                                        <option value="<?= $value['id'] ?>"><?= $value['name'] ?></option>
                                                    <?php endforeach ?>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <p>Bank Details</p>
                                            <ul class="list-group">
                                                <li class="list-group-item p-0 border border-0">
                                                    <input type="text" name="bank_details[bank_name]" class="form-control rounded-0" required aria-required="true" placeholder="Bank Name">
                                                </li>
                                                <li class="list-group-item p-0 border border-0">
                                                    <input type="text" name="bank_details[ifsc_code]" class="form-control rounded-0" required aria-required="true" placeholder="IFSC Code">
                                                </li>
                                                <li class="list-group-item p-0 border border-0">
                                                    <input type="text" name="bank_details[account_number]" class="form-control rounded-0" required aria-required="true" placeholder="Account Number">
                                                </li>
                                            </ul>
                                        </div>
                                        <div class="col-sm-6">
                                            <p>Gst Details</p>
                                            <ul class="list-group">
                                                <li class="list-group-item p-0 border border-0">
                                                    <input type="text" name="gst_details[name]" class="form-control rounded-0" required aria-required="true" placeholder="Company Name">
                                                </li>
                                                <li class="list-group-item p-0 border border-0">
                                                    <input type="text" name="gst_details[address]" class="form-control rounded-0" required aria-required="true" placeholder="Company Address">
                                                </li>
                                                <li class="list-group-item p-0 border border-0">
                                                    <input type="number" name="gst_details[sate_code]" class="form-control rounded-0" required aria-required="true" placeholder="State Code">
                                                </li>
                                                <li class="list-group-item p-0 border border-0">
                                                    <input type="number" name="gst_details[pincode]" class="form-control rounded-0" required aria-required="true" placeholder="Pincode">
                                                </li>
                                                <li class="list-group-item p-0 border border-0">
                                                    <input type="text" name="gst_details[gst_number]" class="form-control rounded-0" required aria-required="true" placeholder="GST NO.">
                                                </li>
                                                <li class="list-group-item p-0 border border-0">
                                                    <input type="text" name="gst_details[pan_number]" class="form-control rounded-0" required aria-required="true" placeholder="PAN NO.">
                                                </li>
                                            </ul>
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
                <button type="button" class="btn btn-danger btn-round waves-effect group_close" data-dismiss="modal">CLOSE</button>
                <button type="submit" class="btn btn-success btn-round waves-effect">SAVE CHANGES</button>
            </div>
        </div>
        <?= form_close() ?>
    </div>
</div>
<script>
    function open_modal(id = null) {
        if (id == null) {
            var edit_body = $('#itemnaryModal');
            edit_body.find('input').each(function(i, v) {
                if ($(this).attr('name') != 'csrf_test_name') {
                    $(this).val('');
                }
            });
            edit_body.find('select[name="college_assigned_id[]"]').selectpicker('deselectAll');
            edit_body.find('input[name="id"]').attr('disabled', 'disabled');
            $('#itemnaryModal').modal('show');
        } else {
            $.ajax({
                type: "post",
                url: window.location.href,
                data: {
                    'csrf_test_name': $('input[name="csrf_test_name"]').val(),
                    'edit_id': id
                },
                success: function(response) {
                    var edit_body = $('#itemnaryModal');
                    var product_data = response.data;
                    let college_assigned_ids = product_data.college_assigned_id;
                    college_assigned_ids = college_assigned_ids.map(e => Number(e));
                    var gst_details = product_data.gst_details;
                    var bank_details = product_data.bank_details;
                    console.log(college_assigned_ids);
                    edit_body.find('input[name="user[name]"]').val(product_data.name);
                    edit_body.find('input[name="user[email]"]').val(product_data.secret);
                    edit_body.find('select[name="college_assigned_id[]"]').selectpicker('deselectAll');
                    edit_body.find('select[name="college_assigned_id[]"]').selectpicker('val', college_assigned_ids);
                    edit_body.find('select[name="college_assigned_id[]"]').selectpicker('refresh');
                    edit_body.find('input[name="bank_details[bank_name]"]').val(bank_details.bank_name);
                    edit_body.find('input[name="bank_details[ifsc_code]"]').val(bank_details.ifsc_code);
                    edit_body.find('input[name="bank_details[account_number]"]').val(bank_details.account_number);
                    edit_body.find('input[name="gst_details[name]"]').val(gst_details.name);
                    edit_body.find('input[name="gst_details[address]"]').val(gst_details.address);
                    edit_body.find('input[name="gst_details[sate_code]"]').val(gst_details.sate_code);
                    edit_body.find('input[name="gst_details[pincode]"]').val(gst_details.pincode);
                    edit_body.find('input[name="gst_details[gst_number]"]').val(gst_details.gst_number);
                    edit_body.find('input[name="gst_details[pan_number]"]').val(gst_details.pan_number);
                    edit_body.find('input[name="id"]').removeAttr('disabled');
                    edit_body.find('input[name="id"]').val(product_data.id);
                    $('input[name="csrf_test_name"]').val(response.csrf);
                    $('#itemnaryModal').modal('show');
                }
            });
        }
    }

    function submit_group(element) {
        var formData = new FormData(element[0]);
        formData.append("submit_product", "");
        $.ajax({
            type: "post",
            url: window.location.href,
            data: formData,
            cache: false,
            contentType: false,
            processData: false,
            success: function(response) {
                if (response.data == 1) {
                    $('.group_close').trigger('click');
                    showNotification('bg-green', 'Added Successfully', 'top', 'right', '', '');
                } else {
                    showNotification('bg-red', 'Failed !Try Again', 'top', 'right', '', '');
                }
                $('input[name="csrf_test_name"]').val(response.csrf);
            }
        });

    }

    function delete_product(id) {
        $.ajax({
            type: "post",
            url: window.location.href,
            data: {
                'csrf_test_name': $('input[name="csrf_test_name"]').val(),
                'delete_id': id
            },
            success: function(response) {
                if (response.status == 1) {
                    showNotification('bg-green', 'Deleted Successfully', 'top', 'right', '', '');
                } else {
                    showNotification('bg-red', 'Failed !Try Again', 'top', 'right', '', '');
                }
                $('input[name="csrf_test_name"]').val(response.csrf);
            }
        });
    }
</script>