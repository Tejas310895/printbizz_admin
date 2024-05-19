<?php

use App\Models\ProductItemnaryGroup;

?>
<section class="content">
    <div class="body_scroll">
        <div class="block-header">
            <div class="row">
                <div class="col-lg-7 col-md-6 col-sm-12">
                    <h2>Itemnary List</h2>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="index.html"><i class="zmdi zmdi-home"></i> Home</a></li>
                        <li class="breadcrumb-item">Itemnary</li>
                        <li class="breadcrumb-item active">Itemnary List</li>
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
                <div class="col-lg-12">
                    <div class="card">
                        <div class="table-responsive" id="itemnary_body">

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
            <?= form_open('', ['id' => "group_form", 'onsubmit' => 'submit_group($(this));return false;']); ?>
            <input type="hidden" name="id" disabled>
            <div class="modal-header">
                <h4 class="title" id="largeModalLabel">Add New Itemnary</h4>
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
                                                <label for="exampleFormControlInput1" class="form-label">Itemnary Name</label>
                                                <input type="text" name="name" class="form-control" required aria-required="true">
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label for="exampleFormControlInput1" class="form-label">Choose Type</label>
                                                <select class="form-control" name="type" required aria-required="true">
                                                    <option value="" selected disabled>Select type</option>
                                                    <?php foreach (ProductItemnaryGroup::$types as $key => $value) : ?>
                                                        <option value="<?= $key ?>"><?= $value ?></option>
                                                    <?php endforeach ?>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-sm-12">
                                            <div class="header">
                                                <h6 class="mb-0">Sub Itemnary</h6>
                                            </div>
                                            <div class="body todo_list py-1">
                                                <div class="input-group mb-4">
                                                    <input type="text" id="item_name" class="form-control" placeholder="Enter Name">
                                                    <input type="number" id="item_price" class="form-control" placeholder="Enter Price">
                                                    <div class="input-group-append">
                                                        <button class="btn btn-outline-secondary" type="button" onclick="add_sub_itemnary($(this))" id="button-addon2">Add Sub Itemnary</button>
                                                    </div>
                                                </div>
                                                <ul class="list-group">

                                                </ul>
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
    function add_sub_itemnary(element) {
        var item_body = element.parent().parent();
        var price = item_body.find('#item_price');
        var name = item_body.find('#item_name');
        name.removeClass('form-control-danger');
        price.removeClass('form-control-danger');
        if ((name.val()).length > 1 && (price.val()).length > 0) {
            var item_json = JSON.stringify({
                'name': name.val(),
                'price': price.val(),
            });
            var template = '';
            template += '<li class="list-group-item d-flex justify-content-between align-items-center">';
            template += '<input type="hidden" name="group_items[]" value=\'' + item_json + '\'>';
            template += name.val() + ' for ₹' + price.val();
            template += '<span class="badge badge-primary badge-pill" onclick="delete_sub_itemnary($(this))">x</span>';
            template += '</li>';
            $('.list-group').append(template);
            name.val('');
            price.val('');
        } else {
            name.addClass('form-control-danger');
            price.addClass('form-control-danger');
        }
    }

    function delete_sub_itemnary(element) {
        element.parent().remove();
    }

    function submit_group(element) {
        var formData = new FormData(element[0]);
        var data = {};
        var counter = 0;
        for (let pair of formData.entries()) {
            if (pair[0] == 'group_items[]') {
                data['group_items_' + counter] = pair[1];
            } else {
                data[pair[0]] = pair[1];
            }
            ++counter;
        }
        if (Object.keys(data).length > 3) {
            $.ajax({
                type: "post",
                url: window.location.href,
                data: data,
                success: function(response) {
                    if (response.status == 1) {
                        $('.group_close').trigger('click');
                        showNotification('bg-green', 'Added Successfully', 'top', 'right', '', '');
                    } else {
                        showNotification('bg-red', 'Failed !Try Again', 'top', 'right', '', '');
                    }
                    $('input[name="csrf_test_name"]').val(response.csrf);
                    fetch_data();
                }
            });
        } else {
            element.find('#item_price').addClass('form-control-danger');
            element.find('#item_name').addClass('form-control-danger');
        }

    }

    function open_modal(id = null) {
        if (id == null) {
            console.log('hi');
            var edit_body = $('#itemnaryModal');
            edit_body.find('input[name="name"]').val('');
            edit_body.find('#largeModalLabel').text('Add New Itemnary');
            edit_body.find('select[name="type"]').val('').change();
            edit_body.find('input[name="id"]').val('');
            edit_body.find('input[name="id"]').attr('disabled', 'disabled');
            $('.list-group').empty();
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
                    var groups_data = response.data;
                    console.log(groups_data.name);
                    edit_body.find('input[name="name"]').val(groups_data.name);
                    edit_body.find('#largeModalLabel').text('Edit Itemnary');
                    edit_body.find('select[name="type"]').val(groups_data.type).change();
                    edit_body.find('input[name="id"]').removeAttr('disabled');
                    edit_body.find('input[name="id"]').val(groups_data.id);
                    $('.list-group').empty();
                    $.each(groups_data.items, function(iti, itv) {
                        var edit_item_json = JSON.stringify({
                            'name': itv.name,
                            'price': itv.price,
                        });
                        var template = '';
                        template += '<li class="list-group-item d-flex justify-content-between align-items-center">';
                        template += '<input type="hidden" name="group_items[]" value=\'' + edit_item_json + '\'>';
                        template += itv.name + ' for ₹' + itv.price;
                        template += '<span class="badge badge-primary badge-pill" onclick="delete_sub_itemnary($(this))">x</span>';
                        template += '</li>';
                        $('.list-group').append(template);
                    });
                    $('input[name="csrf_test_name"]').val(response.csrf);
                    $('#itemnaryModal').modal('show');
                }
            });
        }
    }

    function delete_itemnary(id) {
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

    function fetch_data() {
        $pre_temp = '';
        $pre_temp += '<button class="btn btn-info" type="button" disabled>';
        $pre_temp += '<span class="spinner-border spinner-border-sm" aria-hidden="true"></span>';
        $pre_temp += '<span role="status">Loading...</span>';
        $pre_temp += '</button>';
        $('#itemnary_body').html($pre_temp);
        $.ajax({
            type: "post",
            url: window.location.href,
            data: {
                'csrf_test_name': $('input[name="csrf_test_name"]').val(),
                'fetch_data': '1'
            },
            success: function(response) {
                $post_temp = '';
                $post_temp += '<table class="table table-hover product_item_list c_table theme-color mb-0">';
                $post_temp += '<thead>';
                $post_temp += '<tr>';
                $post_temp += '<th>Group Name</th>';
                $post_temp += '<th data-breakpoints="sm xs">Detail</th>';
                $post_temp += '<th data-breakpoints="xs md">Status</th>';
                $post_temp += '<th data-breakpoints="sm xs md">Action</th>';
                $post_temp += '</tr>';
                $post_temp += '</thead>';
                $post_temp += '<tbody>';

                $.each(response.data, function(itmi, itmv) {
                    $post_temp += '<tr>';
                    $post_temp += '<td>' + itmv.name + '</td>';
                    $post_temp += '<td><span class="text-muted">' + (itmv.items).length + 'Sub Itemnaries</span></td>';
                    $post_temp += '<td><span class="' + ((itmv.status == 1) ? "col-green" : "col-red") + '">' + ((itmv.status == 1) ? "Active" : "Inactive") + '</span></td>';
                    $post_temp += '<td>';
                    $post_temp += '<button onclick="open_modal(' + itmv.id + ')" class="btn btn-default waves-effect waves-float btn-sm waves-green"><i class="zmdi zmdi-edit"></i></button>'
                    if (itmv.status == <?= ProductItemnaryGroup::STATUS_ACTIVE ?>) {
                        $post_temp += '<button onclick="delete_itemnary(' + itmv.id + ')" class="btn btn-default waves-effect waves-float btn-sm waves-red"><i class="zmdi zmdi-delete"></i></button>';
                    }
                    $post_temp += '</td>';
                    $post_temp += '</tr>';
                });
                $post_temp += '</tbody>';
                $post_temp += '</table>';
                $('#itemnary_body').html($post_temp);
                $('.product_item_list').footable();
                $('input[name="csrf_test_name"]').val(response.csrf);
            }
        });
    }
    $(document).ready(function() {
        fetch_data();
    });
</script>