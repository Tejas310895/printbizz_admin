<?php
$images = $settings[array_search('images', array_column($settings, 'name'))];
$charges = $settings[array_search('charges', array_column($settings, 'name'))];
$gateway = $settings[array_search('gateway', array_column($settings, 'name'))];
$banner_images = json_decode($images['parameters'], true);
$available_positions = array_diff([1, 2, 3, 4, 5], array_keys($banner_images));
$charges = json_decode($charges['parameters'], true);
$gateway = json_decode($gateway['parameters'], true);
?>
<section class="content">
    <div class="body_scroll">
        <div class="block-header">
            <div class="row">
                <div class="col-lg-7 col-md-6 col-sm-12">
                    <h2>Settings</h2>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="index.html"><i class="zmdi zmdi-home"></i> Home</a></li>
                        <li class="breadcrumb-item">Settings</li>
                    </ul>
                    <button class="btn btn-primary btn-icon mobile_menu" type="button"><i class="zmdi zmdi-sort-amount-desc"></i></button>
                </div>
                <div class="col-lg-5 col-md-6 col-sm-12">
                    <button class="btn btn-primary btn-icon float-right right_icon_toggle_btn" type="button"><i class="zmdi zmdi-arrow-right"></i></button>
                    <?php if (!empty($available_positions)) : ?>
                        <button class="btn btn-success btn-icon float-right" type="button" data-toggle="modal" data-target="#defaultModal"><i class="zmdi zmdi-upload"></i></button>
                    <?php endif ?>
                </div>
            </div>
        </div>
        <div class="container-fluid">
            <div class="row clearfix">
                <div class="col-md-12">
                    <div class="card">
                        <div class="header">
                            <h2>Front page images</h2>
                        </div>
                        <div class="body">
                            <div class="row clearfix">
                                <?php foreach ($banner_images as $position => $value) : ?>
                                    <div class="col-lg-4 col-md-4 col-sm-12">
                                        <div class="card">
                                            <a href="javascript:void(0);" class="file">
                                                <div class="hover">
                                                    <button type="button" onclick="delete_banner($(this))" data-position="<?= $position ?>" data-image="<?= $value ?>" class="btn btn-icon btn-icon-mini btn-round btn-danger">
                                                        <i class="zmdi zmdi-delete"></i>
                                                    </button>
                                                </div>
                                                <div class="image">
                                                    <img src="writable/<?= $value ?>" alt="img" class="img-fluid">
                                                </div>
                                            </a>
                                        </div>
                                    </div>
                                <?php endforeach; ?>
                            </div>
                        </div>
                    </div>
                    <div class="card">
                        <div class="header">
                            <h2><strong>Settings</h2>
                        </div>
                        <div class="body">
                            <?= form_open('', ['onsubmit' => 'submit_settings($(this));']) ?>
                            <div class="row clearfix">
                                <div class="col-lg-4 col-md-12">
                                    <div class="form-group">
                                        <input type="number" name="charges[gst]" class="form-control" value="<?= $charges['gst'] ?>" placeholder="GST CHARGES" required>
                                    </div>
                                </div>
                                <div class="col-lg-4 col-md-12">
                                    <div class="form-group">
                                        <input type="number" name="charges[del_charge]" class="form-control" value="<?= $charges['del_charge'] ?>" placeholder="DELIVERY CHARGES" required>
                                    </div>
                                </div>
                                <div class="col-lg-4 col-md-12">
                                    <div class="form-group">
                                        <input type="number" name="charges[limit]" class="form-control" value="<?= $charges['limit'] ?>" placeholder="ORDER LIMIT" required>
                                    </div>
                                </div>
                                <div class="col-lg-4 col-md-12">
                                    <select class="form-control show-tick" name="gateway[payment]" required>
                                        <option value="">Select Payment Gateway</option>
                                        <option value="1" <?= ($gateway['payment'] == 1) ? 'selected' : '' ?>>Paytm</option>
                                    </select>
                                </div>
                                <div class="col-lg-4 col-md-12">
                                    <select class="form-control show-tick" name="gateway[sms]" value="<?= $gateway['sms'] ?>" required>
                                        <option value="">Select SMS Gateway</option>
                                        <option value="1" <?= ($gateway['payment'] == 1) ? 'selected' : '' ?>>MSG91</option>
                                    </select>
                                </div>
                                <div class="col-md-12">
                                    <button type="submit" class="btn btn-primary">Save Changes</button>
                                </div>
                            </div>
                            <?= form_close() ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<div class="modal fade" id="defaultModal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="title" id="defaultModalLabel">Upload Image</h4>
            </div>
            <?= form_open('', ['onsubmit' => 'submit_images($(this));']) ?>
            <div class="modal-body">
                <input type="file" name="banner_images" class="dropify" data-allowed-file-extensions="jpg png" required>
                <select class="form-control show-tick" name="position" required>
                    <option value="">Select Position</option>
                    <?php foreach ($available_positions as $value) : ?>
                        <option value="<?= $value ?>"><?= $value ?></option>
                    <?php endforeach ?>
                </select>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-default btn-round waves-effect">SAVE CHANGES</button>
                    <button type="button" class="btn btn-danger waves-effect banner_close" data-dismiss="modal">CLOSE</button>
                </div>
            </div>
            <?= form_close() ?>
        </div>
    </div>
</div>

<script>
    function submit_images(element) {
        var formData = new FormData(element[0]);
        formData.append("image_upload", "");
        $.ajax({
            type: "post",
            url: window.location.href,
            data: formData,
            cache: false,
            contentType: false,
            processData: false,
            success: function(response) {
                if (response.data == 1) {
                    $('.banner_close').trigger('click');
                    showNotification('bg-green', 'Added Successfully', 'top', 'right', '', '');
                } else {
                    showNotification('bg-red', 'Failed !Try Again', 'top', 'right', '', '');
                }
                $('input[name="csrf_test_name"]').val(response.csrf);
                // fetch_data();
            }
        });
    }

    function submit_settings(element) {
        var formData = new FormData(element[0]);
        formData.append("settings_update", "");
        $.ajax({
            type: "post",
            url: window.location.href,
            data: formData,
            cache: false,
            contentType: false,
            processData: false,
            success: function(response) {
                if (response.data == 1) {
                    showNotification('bg-green', 'Updated Successfully', 'top', 'right', '', '');
                } else {
                    showNotification('bg-red', 'Failed !Try Again', 'top', 'right', '', '');
                }
                $('input[name="csrf_test_name"]').val(response.csrf);
                // fetch_data();
            }
        });
    }

    function delete_banner(element) {
        var data = {};
        data.delete_id = element.data('position');
        data.image = element.data('image');
        data.csrf_test_name = '<?= csrf_hash() ?>';
        $.ajax({
            type: "post",
            url: window.location.href,
            data: data,
            success: function(response) {
                if (response.data == 1) {
                    $('.banner_close').trigger('click');
                    showNotification('bg-green', 'Deleted Successfully', 'top', 'right', '', '');
                } else {
                    showNotification('bg-red', 'Failed !Try Again', 'top', 'right', '', '');
                }
                $('input[name="csrf_test_name"]').val(response.csrf);
                // fetch_data();
            }
        });
    }
</script>