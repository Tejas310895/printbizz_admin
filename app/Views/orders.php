<section class="content">
    <div class="body_scroll">
        <div class="block-header">
            <div class="row">
                <div class="col-lg-7 col-md-6 col-sm-12">
                    <h2>Orders list</h2>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="index.html"><i class="zmdi zmdi-home"></i> Aero</a></li>
                        <li class="breadcrumb-item">Project</li>
                        <li class="breadcrumb-item active">list</li>
                    </ul>
                    <button class="btn btn-primary btn-icon mobile_menu" type="button"><i class="zmdi zmdi-sort-amount-desc"></i></button>
                </div>
                <div class="col-lg-5 col-md-6 col-sm-12">
                    <button class="btn btn-primary btn-icon float-right right_icon_toggle_btn" type="button"><i class="zmdi zmdi-arrow-right"></i></button>
                    <button class="btn btn-success btn-icon float-right" type="button"><i class="zmdi zmdi-plus"></i></button>
                </div>
            </div>
        </div>
        <div class="container-fluid">
            <div class="row clearfix">
                <div class="col-md-12 col-sm-12 col-xs-12">
                    <div class="card project_list">
                        <div class="table-responsive">
                            <table class="table table-hover c_table theme-color">
                                <thead>
                                    <tr>
                                        <th style="width:50px;">Name</th>
                                        <th></th>
                                        <th></th>
                                        <th class="hidden-md-down">Assigned</th>
                                        <th class="hidden-md-down" width="150px">Status</th>
                                        <th>Due Date</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    foreach ($data as $order) : ?>
                                        <tr>
                                            <td>
                                                <div class="icon xl-amber text-center rounded ">
                                                    <h5 class="p-1 m-b-0">15</h5>
                                                    <small>MINUTES</small>
                                                </div>
                                            </td>
                                            <td>
                                                <a class="single-user-name" href="javascript:void(0);"><?= ucwords($order['name']) ?></a><br>
                                                <small><?= $order['secret'] ?></small>
                                            </td>
                                            <td>
                                                <strong><?= $order['order_no'] ?></strong><br>
                                                <small> <strong>Amount: ₹<?= $order['tot_price'] ?></strong> </small>
                                            </td>
                                            <?php if ($order['partner_id'] != null) : ?>
                                                <td><span class="badge badge-info">Assigned</span></td>
                                            <?php else : ?>
                                                <td>
                                                    <select class="form-control show-tick ms" data-placeholder="Select">
                                                        <option disabled selected value="">Choose Partner</option>
                                                        <option>Mustard</option>
                                                        <option>Ketchup</option>
                                                        <option>Relish</option>
                                                    </select>
                                                </td>
                                            <?php endif ?>
                                            <td class="hidden-md-down">
                                                <span class="col-green"><?= \App\Models\Orders::$status[$order['status']] ?></span>
                                            </td>
                                            <td>25 Dec 2019</td>
                                        </tr>
                                    <?php endforeach ?>
                                </tbody>
                            </table>
                        </div>
                        <ul class="pagination pagination-primary mt-4">
                            <li class="page-item active"><a class="page-link" href="javascript:void(0);">1</a></li>
                            <li class="page-item"><a class="page-link" href="javascript:void(0);">2</a></li>
                            <li class="page-item"><a class="page-link" href="javascript:void(0);">3</a></li>
                            <li class="page-item"><a class="page-link" href="javascript:void(0);">4</a></li>
                            <li class="page-item"><a class="page-link" href="javascript:void(0);">5</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>