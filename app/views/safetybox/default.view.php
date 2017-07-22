<div class="rightColumn">
    <div class="block">
        <header class="white">
            <h2><?= $text_header ?></h2>
        </header>
        <div class="contentBox clearfix">
            <ul class="dashboard_controls clearfix">
                <li><a href="/receiptvoucher" class="receipt_voucher <?php if($this->highlightMenu('receiptvoucher')) echo 'selected'; ?>"><div></div><?= $text_ctrl_receipt_voucher; ?></a></li>
                <li><a href="/paymentvoucher" class="payment_voucher <?php if($this->highlightMenu('paymentvoucher')) echo 'selected'; ?>"><div></div><?= $text_ctrl_payment_voucher; ?></a></li>
            </ul>
            <div class="quick_actions">
                <ul class="statistics">
                    <h1><i class="fa fa-bar-chart"></i> <?= $text_quick_statistics ?></h1>
                    <li class="clearfix">
                        <div class="stat_block">
                            <p><?= $text_in_count; ?> : <span>0</span></p>
                        </div>
                        <div class="stat_block">
                            <p><?= $text_out_count; ?> : <span>0</span></p>
                        </div>
                        <div class="stat_block">
                            <p><?= $text_purchases_count; ?> : <span>0</span></p>
                        </div>
                        <div class="stat_block">
                            <p><?= $text_sales_count; ?> : <span>0</span></p>
                        </div>
                    </li>
                </ul>
                <ul class="actions">
                    <h1><i class="fa fa-list"></i> <?= $text_quick_actions ?></h1>
                    <li><a href="/categories/add"><i class="fa fa-archive"></i> <?= $text_shortcut_categories_add ?></a></li>
                    <li><a href="/products/add"><i class="fa fa-tag"></i> <?= $text_shortcut_products_add ?></a></li>
                    <li><a href="/purchases/add"><i class="fa fa-gift"></i> <?= $text_shortcut_supplyـtransaction ?></a></li>
                    <li><a href="/sales/add"><i class="fa fa-shopping-cart"></i> <?= $text_shortcut_store_invoice ?></a></li>
                    <li><a href="/mail/new"><i class="fa fa-envelope"></i> <?= $text_shortcut_mail_add ?></a></li>
                </ul>
            </div>
        </div>
        <script>
            var canvas = document.getElementById('canvas');
            if (undefined != canvas) {
                var barChartData = {
                    labels: ["يناير", "فبراير", "مارس", "ابريل", "مايو", ],
                    datasets: [
                        {
                            label: "مبيعات",
                            fillColor: "rgba(220,220,220,0.5)",
                            strokeColor: "rgba(220,220,220,0.8)",
                            highlightFill: "rgba(220,220,220,0.75)",
                            highlightStroke: "rgba(220,220,220,1)",
                            data: [
                                10, 20, 0, 0, 0, 0
                            ]
                        },
                        {
                            label: "وارد بضاعة",
                            fillColor: "rgba(177,147,71,0.5)",
                            strokeColor: "rgba(177,147,71,0.5)",
                            highlightFill: "rgba(177,147,71,0.5)",
                            highlightStroke: "rgba(177,147,71,0.5)",
                            data: [
                                15, 25, 0, 0, 0, 0
                            ]
                        }]

                }
                window.onload = function () {
                    var ctx = document.getElementById("canvas").getContext("2d");
                    window.myBar = new Chart(ctx).Bar(barChartData, {
                        responsive: true
                    });
                }
            }
        </script>
        <footer>
            <p>
                <?= $text_footer ?>
            </p>
        </footer>
    </div>
</div>