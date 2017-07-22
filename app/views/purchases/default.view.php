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
                        <th><?= $text_table_added_to_store; ?></th>
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
                                <td><?= (new DateTime($invoice->created))->format('ym-') ?><?= $invoice->id; ?></td>
                                <td><?= $invoice->supplier; ?></td>
                                <td><?= (new DateTime($invoice->created))->format('Y-m-d h:i a'); ?></td>
                                <td><?= ${'text_added_to_store_' . $invoice->addedToStore}; ?></td>
                                <td><?= $invoice->ptotal ?></td>
                                <td><?= round($invoice->total, 2) ?></td>
                                <td><?= ${'text_payment_type_' . $invoice->paymentType}; ?></td>
                                <td><?= $invoice->totalPaid == null ? 0 : $invoice->totalPaid ?></td>
                                <td class="controls_td">
                                    <a href="javascript:;" class="open_controls"><i class="fa fa-caret-square-o-left"></i></a>
                                    <div class="controls_container">
                                        <a href="/purchases/view/<?= $invoice->id ?>"><i class="fa fa-eye"></i> <?= $text_table_control_view ?></a>
                                        <?php if ($invoice->addedToStore != 1): ?>
                                        <a href="/purchases/edit/<?= $invoice->id ?>"><i class="fa fa-edit"></i> <?= $text_table_control_edit ?></a>
                                        <a href="/purchases/delete/<?= $invoice->id ?>/?token=<?= $this->session->CSRFToken ?>" onclick="if(!confirm('<?= $text_table_control_delete_confirm ?>')) return false;"><i class="fa fa-trash"></i> <?= $text_table_control_delete ?></a>
                                        <a href="/purchases/deliverproducts/<?= $invoice->id ?>/?token=<?= $this->session->CSRFToken ?>" onclick="if(!confirm('<?= $text_table_control_deliver_confirm ?>')) return false;"><i class="fa fa-truck"></i> <?= $text_table_control_deposit ?></a>
                                        <?php endif; ?>
                                        <?php if ($invoice->total > $invoice->totalPaid): ?>
                                        <a href="/paymentvoucher/add/<?= $invoice->id ?>"><i class="fa fa-credit-card"></i> <?= $text_table_control_pay ?></a>
                                        <?php endif; ?>
                                        <?php if ($invoice->totalPaid != null): ?>
                                        <a href="/paymentvoucher/default/<?= $invoice->id ?>"><i class="fa fa-list-ul"></i> <?= $text_table_control_payment_list ?></a>
                                        <?php endif; ?>
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