<div class="rightColumn">
    <div class="block">
        <header class="white">
            <h2><?= $text_main_header ?></h2>
        </header>
        <div class="contentBox clearfix">
            <a href="/purchases/add" class="button"><i class="fa fa-plus"></i>
                <?= $text_new_button ?></a>
            <div class="statTable">
                <table class="tablesorter">
                    <thead>
                    <tr>
                        <th><?= $text_table_ref; ?></th>
                        <th><?= $text_table_supplier; ?></th>
                        <th><?= $text_table_created; ?></th>
                        <th><?= $text_table_approved; ?></th>
                        <th><?= $text_table_products_total ?></th>
                        <th><?= $text_table_total ?></th>
                        <th><?= $text_table_payment_type; ?></th>
                        <th><?= $text_table_paid; ?></th>
                        <th style="width: 40px"><?= $text_table_control; ?></th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                    if($invoices !== false) {
                        foreach($invoices as $invoice) {
                            ?>
                            <tr>
                                <td>SI<?= (new DateTime($invoice->created))->format('Y') ?><?= $invoice->id; ?></td>
                                <td><?= $invoice->supplier; ?></td>
                                <td><?= (new DateTime($invoice->created))->format('Y-m-d H:i'); ?></td>
                                <td><?= ${'text_approved_' . $invoice->approved}; ?></td>
                                <td><?= $invoice->ptotal ?></td>
                                <td><?= round($invoice->total, 2) ?></td>
                                <td><?= ${'text_payment_type_' . $invoice->paymentType}; ?></td>
                                <td><?= ${'text_paid_' . $invoice->paid}; ?></td>
                                <td class="controls_td">
                                    <a href="javascript:;" class="open_controls"><i class="fa fa-caret-square-o-left"></i></a>
                                    <div class="controls_container">
                                        <a href="/purchases/view/<?= $invoice->id ?>"><i class="fa fa-eye"></i> <?= $text_table_control_view ?></a>
                                        <a href="/purchases/edit/<?= $invoice->id ?>"><i class="fa fa-edit"></i> <?= $text_table_control_edit ?></a>
                                        <a href="/purchases/delete/<?= $invoice->id ?>/?token=<?= $this->session->CSRFToken ?>" onclick="if(!confirm('<?= $text_table_control_delete_confirm ?>')) return false;"><i class="fa fa-trash"></i> <?= $text_table_control_delete ?></a>
                                        <a href="/purchases/deliverproducts/<?= $invoice->id ?>"><i class="fa fa-truck"></i> <?= $text_table_control_deposit ?></a>
                                        <a href="/safetybox/receipt/<?= $invoice->id ?>"><i class="fa fa-credit-card"></i> <?= $text_table_control_pay ?></a>
                                    </div>
                                </td>
                            </tr>
                            <?php
                        }
                    }
                    ?>
                    </tbody>
                </table>
            </div>
        </div>
        <footer>
            <p>
                <?= $text_main_footer ?>
            </p>
        </footer>
    </div>
</div>