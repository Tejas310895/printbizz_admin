<section class="content">
    <div class="body_scroll">
        <div class="block-header">
            <div class="row">
                <div class="col-lg-7 col-md-6 col-sm-12">
                    <h2>Product List</h2>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="index.html"><i class="zmdi zmdi-home"></i> Aero</a></li>
                        <li class="breadcrumb-item">eCommerce</li>
                        <li class="breadcrumb-item active">Product List</li>
                    </ul>
                    <button class="btn btn-primary btn-icon mobile_menu" type="button"><i class="zmdi zmdi-sort-amount-desc"></i></button>
                </div>
                <div class="col-lg-5 col-md-6 col-sm-12">
                    <button class="btn btn-primary btn-icon float-right right_icon_toggle_btn" type="button"><i class="zmdi zmdi-arrow-right"></i></button>
                    <button href="products-view" class="btn btn-success btn-icon float-right" data-toggle="modal" data-target="#largeModal" type="button"><i class="zmdi zmdi-plus"></i></button>
                </div>
            </div>
        </div>
        <div class="container-fluid">
            <div class="row clearfix">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="table-responsive">
                            <table class="table table-hover product_item_list c_table theme-color mb-0">
                                <thead>
                                    <tr>
                                        <th>Image</th>
                                        <th>Product Name</th>
                                        <th data-breakpoints="sm xs">Detail</th>
                                        <th data-breakpoints="xs">Amount</th>
                                        <th data-breakpoints="xs md">Stock</th>
                                        <th data-breakpoints="sm xs md">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php

                                    use App\Models\Products;

                                    foreach ($products as $product) : ?>
                                        <tr>
                                            <td><img src="public/lab_themes/assets/images/ecommerce/1.png" width="48" alt="Product img"></td>
                                            <td>
                                                <h5><?= $product['name'] ?></h5>
                                            </td>
                                            <td><span class="text-muted"> Total <?= count($product['groups']) ?> Itemnaries</span></td>
                                            <td>₹ <?= $product['default_price'] ?></td>
                                            <td><span class="<?= (($product['status'] == Products::STATUS_ACTIVE) ? 'col-green' : 'col-red') ?>"><?= Products::$status[$product['status']] ?></span></td>
                                            <td>
                                                <a href="" class="btn btn-default waves-effect waves-float btn-sm waves-green"><i class="zmdi zmdi-edit"></i></a>
                                                <a href="javascript:void(0);" class="btn btn-default waves-effect waves-float btn-sm waves-red"><i class="zmdi zmdi-delete"></i></a>
                                            </td>
                                        </tr>
                                    <?php endforeach ?>
                                </tbody>
                            </table>
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
<div class="modal fade" id="largeModal" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="title" id="largeModalLabel">Add New Product</h4>
            </div>
            <div class="modal-body">
                <div class="container-fluid">
                    <form id="form_validation_stats">
                        <!-- Color Pickers -->
                        <div class="row clearfix">
                            <div class="col-lg-12 col-md-12 col-sm-12">
                                <div class="card mb-0">
                                    <div class="body">
                                        <div class="row clearfix">
                                            <div class="col-sm-6">
                                                <div class="form-group has-success">
                                                    <label for="exampleFormControlInput1" class="form-label">Product Name</label>
                                                    <input type="text" value="" class="form-control">
                                                </div>
                                            </div>
                                            <div class="col-sm-6">
                                                <div class="form-group">
                                                    <label for="exampleFormControlInput1" class="form-label">Base Price</label>
                                                    <input type="number" value="" class="form-control">
                                                </div>
                                            </div>
                                            <div class="col-sm-12">
                                                <input type="file" id="dropify-event">
                                            </div>
                                            <div class="col-sm-12 mt-2">
                                                <label for="exampleFormControlInput1" class="form-label">Choose Itemnary</label>
                                                <select class="form-control show-tick" multiple>
                                                    <option>Mustard</option>
                                                    <option>Ketchup</option>
                                                    <option>Relish</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                    <!-- #END# Input Slider -->
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger btn-round waves-effect" data-dismiss="modal">CLOSE</button>
                <button type="button" class="btn btn-success btn-round waves-effect">SAVE CHANGES</button>
            </div>
        </div>
    </div>
</div>