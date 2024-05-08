<?php

use App\Models\Orders;
?>
<div class="page-heading">
    <div class="page-title">
        <div class="row">
            <div class="col-12 col-md-6 order-md-1 order-last">
                <h3>Orders Overview</h3>
                <p class="text-subtitle text-muted"></p>
            </div>
            <div class="col-12 col-md-6 order-md-2 order-first">
                <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                    <div class="form-group position-relative has-icon-left">
                        <input type="text" class="form-control" id="search_order" onchange="search_orders($(this))" placeholder="Search Order number">
                        <div class="form-control-icon">
                            <i class="bi bi-search"></i>
                        </div>
                    </div>
                </nav>
            </div>
        </div>
    </div>
</div>
<div class="page-content">
    <section class="row">
        <div class="col-12 col-lg-12">
            <div class="row" id="orders_container">

            </div>
    </section>
</div>

<script>
    $(document).ready(function() {
        load_more();
    });
    $(window).on('scroll', function() {
        if ($(window).scrollTop() >= Math.round($('#main').offset().top + $('#main').outerHeight() - window.innerHeight)) {
            var ids = [];
            const elements = document.querySelectorAll('.order_card');
            Array.from(elements).forEach((element, index) => {
                ids.push(parseInt(element.getAttribute('data-divid')));
            });
            load_more(Math.max.apply(Math, ids));
        }
    });

    function search_orders(element) {
        $('#orders_container').empty();
        load_more();
    }

    function load_more(last_id = 0) {
        var statuses = <?= json_encode(Orders::$status) ?>;
        var search_input = $('#search_order').val();
        $.ajax({
            type: "post",
            url: window.location.href,
            data: {
                'last_id': last_id
            },
            success: function(response) {
                if ((response.data).length > 0) {
                    loadingshow();
                }
                $.each(response.data, function(iele, vele) {
                    var latency = 0;
                    var latency_str = '';
                    var start = new Date(vele.created_at),
                        end = new Date(),
                        diff = new Date(end - start),
                        secs = diff / 1000;
                    minutes = diff / 1000 / 60;
                    hours = diff / 1000 / 60 / 60;
                    days = diff / 1000 / 60 / 60 / 24;
                    if (secs < 60) {
                        latency = secs;
                        latency_str = 'SECONDS';
                    } else if (minutes < 60) {
                        latency = minutes;
                        latency_str = 'MINUTES';
                    } else if (hours < 24) {
                        latency = hours;
                        latency_str = 'HOURS';
                    } else {
                        latency = days;
                        latency_str = 'DAYS';
                    }

                    var template = '';
                    template += '<div class="col-12 col-lg-12 order_card" data-divid="' + vele.id + '">';
                    template += '<div class="card">';
                    template += '<div class="card-body py-4 px-4">';
                    template += '<div class="row">';
                    template += '<div class="col-lg-8 col-md-12">';
                    template += '<div class="avatar avatar-xl text-start">';
                    template += '<div class="avatar bg-danger me-3 rounded-3" style="flex-direction: column;height: 59px;">';
                    template += '<span class="avatar-content">' + Math.round(latency) + '</span>';
                    template += '<small class="text-white" style="font-size:0.6rem;">' + latency_str + '</small>';
                    template += '</div>';
                    template += '<div class="ms-3 name">';
                    template += '<h5 class="font-bold">' + vele.order_no + ' <span class="badge ' + ((vele.partner_id != null) ? 'text-bg-success' : 'text-bg-danger') + '">' + ((vele.partner_id != null) ? 'Assigned' : 'Unassigned') + '</span></h5>';
                    template += '<h6 class="text-muted mb-0">';
                    template += '<nav aria-label="breadcrumb" style="--bs-breadcrumb-divider: \'\';">';
                    template += '<ol class="breadcrumb">';
                    template += '<li class="breadcrumb-item text-capitalize"><i class="bi bi-person-lines-fill"></i> ' + vele.name + '</li>';
                    template += '<li class="breadcrumb-item"><i class="bi bi-phone"></i> ' + vele.secret + '</li>';
                    template += '<li class="breadcrumb-item"><i class="bi bi-cash"></i> ₹ ' + vele.tot_price + '/-</li>';
                    template += '<li class="breadcrumb-item"><span class="badge text-bg-primary">' + statuses[vele.status] + '</span></li>';
                    template += '</ol>';
                    template += '</nav>';
                    template += '</h6>';
                    template += '</div>';
                    template += '</div>';
                    template += '</div>';
                    template += '<div class="col-lg-4 col-md-12 mt-2">';
                    template += '<div class="row">';
                    template += '<div class="col-10 pe-0">';
                    template += '<select class="form-control rounded-0 partner_select" style="height: 45px;">';
                    template += '<option value="" disabled selected>Choose the partner</option>';
                    $.each(response.partners, function(pi, pv) {
                        if ((Object.keys(pv.colleges)).indexOf(vele.college_id) > -1) {
                            template += '<option value="' + pv.id + '">' + pv.name + '</option>';
                        }
                    });
                    template += '</select>';
                    template += '</div>';
                    template += '<div class="col-2 ps-0">';
                    template += '<a href="#" class="btn icon btn-lg btn-primary rounded-0"><i class="bi bi-send"></i></a>';
                    template += '</div>';
                    template += '</div>';
                    template += '';
                    template += '</div>';
                    template += '</div>';
                    template += '</div>';
                    template += '</div>';
                    template += '</div>';
                    if (search_input.length > 3) {
                        if (((vele.order_no).toLowerCase()).indexOf(search_input.toLowerCase()) == 0 || ((vele.name).toLowerCase()).indexOf(search_input.toLowerCase()) == 0 || ((vele.secret).toLowerCase()).indexOf(search_input.toLowerCase()) == 0) {
                            $('#orders_container').append(template);
                        }
                    } else {
                        $('#orders_container').append(template);
                    }
                });
                setTimeout(() => {
                    loadinghide();
                }, 500);
            }
        });
    }
</script>