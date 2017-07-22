<div class="rightColumn">
    <div class="block">
        <header class="white">
            <h2><?= $text_main_header ?></h2>
        </header>
        <div class="contentBox clearfix">
            <div class="statTable">
                <table class="tablesorter">
                    <thead>
                    <tr>
                        <th><?= $text_table_ref; ?></th>
                        <th><?= $text_table_supplier; ?></th>
                        <th><?= $text_table_created; ?></th>
                        <th><?= $text_table_payment; ?></th>
                        <th><?= $text_table_payment_type; ?></th>
                        <th><?= $text_table_number ?></th>
                        <th style="width: 40px"><?= $text_table_control; ?></th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                    if($vouchers !== false) {
                        foreach($vouchers as $voucher) {
                            ?>
                            <tr>
                                <td>V-<?= (new DateTime($voucher->created))->format('ym-') ?><?= $voucher->id; ?></td>
                                <td><?= $voucher->supplier; ?></td>
                                <td><?= (new DateTime($voucher->created))->format('Y-m-d h:i a'); ?></td>
                                <td><?= $voucher->payment; ?></td>
                                <td><?= ${'text_payment_type_' . $voucher->paymentType}; ?></td>
                                <td><?= $voucher->paymentNumber; ?></td>
                                <td class="controls_td">
                                    <a href="javascript:;" class="open_controls"><i class="fa fa-caret-square-o-left"></i></a>
                                    <div class="controls_container">
                                        <a href="/receiptvoucher/view/<?= $voucher->id ?>"><i class="fa fa-eye"></i> <?= $text_table_control_view ?></a>
                                        <a href="/receiptvoucher/edit/<?= $voucher->id ?>"><i class="fa fa-edit"></i> <?= $text_table_control_edit ?></a>
                                        <a href="/receiptvoucher/delete/<?= $voucher->id ?>/?token=<?= $this->session->CSRFToken ?>" onclick="if(!confirm('<?= $text_table_control_delete_confirm ?>')) return false;"><i class="fa fa-trash"></i> <?= $text_table_control_delete ?></a>
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