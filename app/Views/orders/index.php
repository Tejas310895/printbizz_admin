<section class="content">
    <div class="body_scroll">
        <div class="block-header">
            <div class="row">
                <div class="col-lg-7 col-md-6 col-sm-12">
                    <h2>Orders list</h2>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href=""><i class="zmdi zmdi-home"></i> Home</a></li>
                        <li class="breadcrumb-item">Project</li>
                        <li class="breadcrumb-item active">list</li>
                    </ul>
                    <button class="btn btn-primary btn-icon mobile_menu" type="button"><i class="zmdi zmdi-sort-amount-desc"></i></button>
                </div>
                <div class="col-lg-5 col-md-6 col-sm-12">
                    <button class="btn btn-primary btn-icon float-right right_icon_toggle_btn" type="button"><i class="zmdi zmdi-arrow-right"></i></button>
                </div>
            </div>
        </div>
        <div class="container-fluid">
            <div class="row clearfix">
                <div class="col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="table-responsive">
                            <table class="table table-hover c_table theme-color">
                                <thead>
                                    <tr>
                                        <th style="width:50px;">Duration</th>
                                        <th>Name</th>
                                        <th>Order No</th>
                                        <th data-breakpoints="sm xs md" class="hidden-md-down">Assigned</th>
                                        <th data-breakpoints="sm xs md" class="hidden-md-down" width="150px">Status</th>
                                        <th data-breakpoints="sm xs md">Order Date</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    foreach ($data as $order) : ?>
                                        <tr>
                                            <td>
                                                <?php

                                                $d1 = strtotime(date('Y-m-d H:i:s'));
                                                $d2 = strtotime($order['created_at']);
                                                $diffInSeconds = abs($d1 - $d2); //42600225
                                                $diffInMinutes = $diffInSeconds / 60; //710003.75
                                                $diffInHours   = $diffInSeconds / 60 / 60; //11833.39
                                                $diffInDays    = $diffInSeconds / 60 / 60 / 24; //493.05

                                                if ($diffInSeconds < 60) {
                                                    $latency = $diffInSeconds;
                                                    $latency_str = 'SECONDS';
                                                } else if ($diffInMinutes < 60) {
                                                    $latency = $diffInMinutes;
                                                    $latency_str = 'MINUTES';
                                                } else if ($diffInHours < 24) {
                                                    $latency = $diffInHours;
                                                    $latency_str = 'HOURS';
                                                } else {
                                                    $latency = $diffInDays;
                                                    $latency_str = 'DAYS';
                                                }

                                                ?>
                                                <div class="icon xl-pink text-center rounded ">
                                                    <h5 class="p-1 m-b-0"><?= round($latency) ?></h5>
                                                    <small><?= $latency_str ?></small>
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
                                                        <?php foreach ($partners as $partner) :
                                                            if (in_array($order['college_id'], array_keys($partner['colleges']))) :
                                                        ?>
                                                                <option value="<?= $partner['id'] ?>"><?= $partner['name'] ?></option>
                                                            <?php endif; ?>
                                                        <?php endforeach ?>
                                                    </select>
                                                </td>
                                            <?php endif ?>
                                            <td class="hidden-md-down">
                                                <span class="col-green"><?= \App\Models\Orders::$status[$order['status']] ?></span>
                                            </td>
                                            <td><?= date('d M Y', strtotime($order['created_at'])) ?></td>
                                        </tr>
                                    <?php endforeach ?>
                                </tbody>
                            </table>
                        </div>
                        <!-- <ul class="pagination pagination-primary mt-4">
                            <li class="page-item active"><a class="page-link" href="javascript:void(0);">1</a></li>
                            <li class="page-item"><a class="page-link" href="javascript:void(0);">2</a></li>
                            <li class="page-item"><a class="page-link" href="javascript:void(0);">3</a></li>
                            <li class="page-item"><a class="page-link" href="javascript:void(0);">4</a></li>
                            <li class="page-item"><a class="page-link" href="javascript:void(0);">5</a></li>
                        </ul> -->
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>