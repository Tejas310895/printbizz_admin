<section class="content contact">
    <div class="body_scroll">
        <div class="block-header">
            <div class="row">
                <div class="col-lg-7 col-md-6 col-sm-12">
                    <h2>Contact</h2>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="index.html"><i class="zmdi zmdi-home"></i> Home</a></li>
                        <li class="breadcrumb-item"><a href="javascript:void(0);">Customers</a></li>
                        <li class="breadcrumb-item active">List</li>
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
                <div class="col-lg-12">
                    <div class="card">
                        <div class="table-responsive">
                            <table class="table table-hover mb-0 c_list c_table">
                                <thead>
                                    <tr>
                                        <th>Name</th>
                                        <th data-breakpoints="xs">Phone</th>
                                        <th data-breakpoints="xs sm md">Orders</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php

                                    use App\Models\Orders;

                                    foreach ($customers_list as $customers) : ?>
                                        <?php if (empty($customers->groups)) : ?>
                                            <tr>
                                                <td>
                                                    <p class="c_name"><?= $customers->identities[0]->name ?></p>
                                                </td>
                                                <td>
                                                    <span class="phone"><i class="zmdi zmdi-whatsapp mr-2"></i><?= $customers->identities[0]->secret ?></span>
                                                </td>
                                                <td>
                                                    <?php
                                                    $orders_str = '';
                                                    if (isset($orders[$customers->id])) {
                                                        foreach ($orders[$customers->id] as $status => $orders) {
                                                            $orders_str .= '<span class="badge badge-info ml-2">';
                                                            $orders_str .= count($orders) . ' ' . Orders::$status[$status];
                                                            $orders_str .= '</span>';
                                                        }
                                                    }
                                                    echo $orders_str;
                                                    ?>
                                                </td>
                                            </tr>
                                        <?php endif; ?>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>