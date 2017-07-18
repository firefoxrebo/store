<div class="rightColumn">
    <div class="block">
        <header class="white">
            <h2><?= $text_header ?></h2>
        </header>
        <div class="contentBox clearfix">
            <ul class="dashboard_controls clearfix">
                <li><a href="/suppliers" class="<?php if($this->highlightMenu('suppliers')) echo 'selected'; ?>"><i class="material-icons">group</i><?= $text_ctrl_suppliers; ?></a></li>
                <li><a href="/clients" class="<?php if($this->highlightMenu('clients')) echo 'selected'; ?>"><i class="material-icons">contacts</i><?= $text_ctrl_clients; ?></a></li>
                <li><a href="/store" class="<?php if($this->highlightMenu('store')) echo 'selected'; ?>"><i class="material-icons">store</i><?= $text_ctrl_store; ?></a></li>
                <li><a href="/expenses" class="<?php if($this->highlightMenu('expenses')) echo 'selected'; ?>"><i class="fa fa-money"></i><?= $text_ctrl_expenses; ?></a></li>
                <li><a href="/safetybox" class="<?php if($this->highlightMenu('safetybox')) echo 'selected'; ?>"><i class="fa fa-inbox"></i><?= $text_ctrl_bank; ?></a></li>
                <li><a href="/report" class="<?php if($this->highlightMenu('report')) echo 'selected'; ?>"><i class="fa fa-bar-chart"></i><?= $text_ctrl_stats ?></a></li>
                <li><a href="/user" class="<?php if($this->highlightMenu('user')) echo 'selected'; ?>"><i class="fa fa-user"></i><?= $text_ctrl_employees; ?></a></li>
                <li><a href="/mail" class="<?php if($this->highlightMenu('mail')) echo 'selected'; ?>"><i class="fa fa-envelope"></i><?= $text_ctrl_mail ?> (<?= $this->_registry->startup->mailTotal; ?>)</a></li>
                <li><a href="/notification" class="<?php if($this->highlightMenu('notification')) echo 'selected'; ?>"><i class="fa fa-bell"></i><?= $text_ctrl_notifications ?> (<?= ($this->_registry->startup->notificationsTotal === false) ? 0 : count($this->_registry->startup->notificationsTotal) ?>)</a></li>
            </ul>
            <div class="quick_actions">
                <ul class="statistics">
                    <h1><i class="fa fa-bar-chart"></i> <?= $text_quick_statistics ?></h1>
                    <li class="clearfix">
                        <div class="stat_block">
                            <p><?= $text_suppliers_count; ?> : <span><?= $suppliers ?></span></p>
                        </div>
                        <div class="stat_block">
                            <p><?= $text_clients_count; ?> : <span><?= $clients ?></span></p>
                        </div>
                        <div class="stat_block">
                            <p><?= $text_products_count; ?> : <span><?= $products ?></span></p>
                        </div>
                        <div class="stat_block">
                            <p><?= $text_expense_count; ?> : <span>0</span></p>
                        </div>
                        <div class="stat_block">
                            <p><?= $text_in_count; ?> : <span>0</span></p>
                        </div>
                        <div class="stat_block">
                            <p><?= $text_out_count; ?> : <span>0</span></p>
                        </div>
                    </li>
                    <h1><i class="fa fa-bar-chart"></i> <?= $text_chart_data ?> - <?= date('Y') ?></h1>
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