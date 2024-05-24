<?php

use App\Models\ProductItemnaryGroup;
?>
<section class="content">
    <div class="body_scroll">
        <div class="block-header">
            <div class="row">
                <div class="col-lg-7 col-md-6 col-sm-12">
                    <h2>Product List</h2>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="index.html"><i class="zmdi zmdi-home"></i> Home</a></li>
                        <li class="breadcrumb-item">Product</li>
                        <li class="breadcrumb-item active">Product List</li>
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
            <div class="row clearfix">
                <div class="col-lg-12" id="itemnary_body">
                    <div class="card">
                        <div class="table-responsive">

                        </div>
                    </div>
                    <!-- <div class="card">
                        <div class="body">
                            <ul class="pagination pagination-primary m-b-0">
                                <li class="page-item"><a class="page-link" href="javascript:void(0);"><i class="zmdi zmdi-arrow-left"></i></a></li>
                                <li class="page-item active"><a class="page-link" href="javascript:void(0);">1</a></li>
                                <li class="page-item"><a class="page-link" href="javascript:void(0);">2</a></li>
                                <li class="page-item"><a class="page-link" href="javascript:void(0);">3</a></li>
                                <li class="page-item"><a class="page-link" href="javascript:void(0);">4</a></li>
                                <li class="page-item"><a class="page-link" href="javascript:void(0);"><i class="zmdi zmdi-arrow-right"></i></a></li>
                            </ul>
                        </div>
                    </div> -->
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Large Size -->
<div class="modal fade" id="itemnaryModal" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <?= form_open('', ['id' => "group_form", 'onsubmit' => 'submit_group($(this));return false;', 'enctype' => 'multipart/form-data']); ?>
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
                                                <label for="exampleFormControlInput1" class="form-label">Product Name</label>
                                                <input type="text" name="name" class="form-control" required aria-required="true">
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="form-group has-success">
                                                <label for="exampleFormControlInput1" class="form-label">Product Base Price</label>
                                                <input type="number" name="default_price" class="form-control" required aria-required="true">
                                            </div>
                                        </div>
                                        <div class="col-sm-12">
                                            <div class="form-group">
                                                <label for="exampleFormControlInput1" class="form-label">Product Image</label>
                                                <input type="file" id="dropify-event" name="img" data-default-file="" required aria-required="true">
                                            </div>
                                        </div>
                                        <div class="col-sm-12">
                                            <p>Select the itemnary required</p>
                                            <div class="mb-3">
                                                <select class="form-control show-tick" name="itemnary[]" id="itemnary_select" multiple required aria-required="true" data-live-search="true">
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
                <button type="button" class="btn btn-danger btn-round waves-effect group_close" data-dismiss="modal">CLOSE</button>
                <button type="submit" class="btn btn-success btn-round waves-effect">SAVE CHANGES</button>
            </div>
        </div>
        <?= form_close() ?>
    </div>
</div>

<script>
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
                fetch_data();
            }
        });

    }

    function open_modal(id = null) {
        if (id == null) {
            var edit_body = $('#itemnaryModal');
            edit_body.find('input[name="name"]').val('');
            edit_body.find('#largeModalLabel').text('Add New Product');
            edit_body.find('input[name="default_price"]').val('');
            edit_body.find('select[name="itemnary[]"]').selectpicker('deselectAll');
            edit_body.find('input[name="id"]').val('');
            edit_body.find('input[name="id"]').attr('disabled', 'disabled');
            edit_body.find('input[name="img"]').attr('required', 'required');
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
                    console.log(product_data.itemnary);
                    edit_body.find('input[name="name"]').val(product_data.name);
                    edit_body.find('#largeModalLabel').text('Edit Product');
                    edit_body.find('input[name="default_price"]').val(product_data.default_price);
                    $('#itemnary_select').selectpicker('deselectAll');
                    $('#itemnary_select').selectpicker('val', product_data.itemnary);
                    $('#itemnary_select').selectpicker('refresh');
                    edit_body.find('input[name="img"]').removeAttr('required');
                    edit_body.find('input[name="id"]').removeAttr('disabled');
                    edit_body.find('input[name="id"]').val(product_data.id);
                    $('input[name="csrf_test_name"]').val(response.csrf);
                    $('#itemnaryModal').modal('show');
                }
            });
        }
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
                fetch_data();
            }
        });
    }

    function fetch_data() {
        img_path = <?= json_encode([WRITEPATH]) ?>;
        pre_temp = '';
        pre_temp += '<button class="btn btn-info" type="button" disabled>';
        pre_temp += '<span class="spinner-border spinner-border-sm" aria-hidden="true"></span>';
        pre_temp += '<span role="status">Loading...</span>';
        pre_temp += '</button>';
        $('#itemnary_body').html(pre_temp);
        $.ajax({
            type: "post",
            url: window.location.href,
            data: {
                'csrf_test_name': $('input[name="csrf_test_name"]').val(),
                'fetch_data': '1'
            },
            success: function(response) {
                post_temp = '';
                post_temp = '<div class="card project_list">';
                post_temp = '<div class="table-responsive">';
                post_temp += '<table class="table table-hover product_item_list c_table theme-color">';
                post_temp += '<thead>';
                post_temp += '<tr>';
                post_temp += '<th>Image</th>';
                post_temp += '<th>Product Name</th>';
                post_temp += '<th data-breakpoints="sm xs">Detail</th>';
                post_temp += '<th data-breakpoints="xs">Amount</th>';
                post_temp += '<th data-breakpoints="xs md">Status</th>';
                post_temp += '<th data-breakpoints="sm xs md">Action</th>';
                post_temp += '</tr>';
                post_temp += '</thead>';
                post_temp += '<tbody>';

                $.each(response.data.products, function(itmi, itmv) {
                    post_temp += '<tr>';
                    post_temp += '<td><img src="writable/' + JSON.parse(itmv.img)[0] + '" width="48" alt="Product img"></td>';
                    post_temp += '<td>' + itmv.name + '</td>';
                    post_temp += '<td><span class="text-muted">' + (itmv.groups).length + ' Main Itemnaries</span></td>';
                    post_temp += '<td>' + itmv.default_price + '</td>';
                    post_temp += '<td><span class="' + ((itmv.status == 1) ? "col-green" : "col-red") + '">' + ((itmv.status == 1) ? "Active" : "Inactive") + '</span></td>';
                    post_temp += '<td>';
                    post_temp += '<button onclick="open_modal(' + itmv.id + ')" class="btn btn-default waves-effect waves-float btn-sm waves-green"><i class="zmdi zmdi-edit"></i></button>'
                    if (itmv.status == <?= ProductItemnaryGroup::STATUS_ACTIVE ?>) {
                        post_temp += '<button onclick="delete_product(' + itmv.id + ')" class="btn btn-default waves-effect waves-float btn-sm waves-red"><i class="zmdi zmdi-delete"></i></button>';
                    }
                    post_temp += '</td>';
                    post_temp += '</tr>';
                });
                post_temp += '</tbody>';
                post_temp += '</table>';
                post_temp += '</div>';
                post_temp += '</div>';
                $('#itemnary_body').html(post_temp);
                $('#itemnary_select').empty();
                $.each(response.data.groups, function(itgi, itgv) {
                    $('#itemnary_select').append('<option value="' + itgv.id + '">' + itgv.name + '</option>');
                });
                $('#itemnary_select').selectpicker('refresh');
                $('.product_item_list').footable();
                $('input[name="csrf_test_name"]').val(response.csrf);
            }
        });
    }
    $(document).ready(function() {
        fetch_data();
    });
</script>