<div class="rightColumn">
    <div class="block">
        <header class="white">
            <h2><?= $text_header ?></h2>
        </header>
        <div class="contentBox clearfix">
            <ul class="dashboard_controls clearfix">
                <li><a href="/expensescategories" class="<?php if($this->highlightMenu('expensescategories')) echo 'selected'; ?>"><i class="fa fa-list-ol"></i><?= $text_ctrl_expenses_categories; ?></a></li>
                <li><a href="/expenseslist" class="<?php if($this->highlightMenu('expenseslist')) echo 'selected'; ?>"><i class="fa fa-money"></i><?= $text_ctrl_expenses_list; ?></a></li>
            </ul>
            <div class="quick_actions">
                <ul class="statistics">
                    <h1><i class="fa fa-bar-chart"></i> <?= $text_chart_expenses ?> - <?= date('Y') ?></h1>
                    <div class="chart">
                        <canvas id="canvas" height="350" width="600"></canvas>
                    </div>
                </ul>
                <ul class="actions">
                    <h1><i class="fa fa-list"></i> <?= $text_quick_actions ?></h1>
                    <li><a href="/suppliers/add"><i class="material-icons">group</i> <?= $text_shortcut_suppliers_add ?></a></li>
                    <li><a href="/clients/add"><i class="material-icons">contacts</i> <?= $text_shortcut_clients_add ?></a></li>
                    <li><a href="/products/add"><i class="fa fa-tag"></i> <?= $text_shortcut_products_add ?></a></li>
                    <li><a href="/banktransactions/add"><i class="fa fa-bank"></i> <?= $text_shortcut_bank_transaction ?></a></li>
                    <li><a href="/purchases/add"><i class="fa fa-gift"></i> <?= $text_shortcut_supplyـtransaction ?></a></li>
                    <li><a href="/clientstransactions/add"><i class="fa fa-shopping-cart"></i> <?= $text_shortcut_store_invoice ?></a></li>
                    <li><a href="/expense/add"><i class="fa fa-money"></i> <?= $text_shortcut_expense_add ?></a></li>
                    <li><a href="/mail/new"><i class="fa fa-envelope"></i> <?= $text_shortcut_mail_add ?></a></li>
                    <li><a href="/user/add"><i class="fa fa-user"></i> <?= $text_shortcut_employee_add ?></a></li>
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