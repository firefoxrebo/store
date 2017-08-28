<div class="rightColumn">
    <div class="block">
        <header class="white">
            <h2><?= $text_main_header ?></h2>
        </header>
        <div class="contentBox clearfix">
            <a href="/expenseslist/add" class="button"><i class="fa fa-plus"></i>
                <?= $text_new_button ?></a>
            <div class="statTable">
                <table class="tablesorter">
                    <thead>
                    <tr>
                        <th><?= $text_table_name; ?></th>
                        <th><?= $text_table_price; ?></th>
                        <th><?= $text_table_created; ?></th>
                        <th style="width: 50px"><?= $text_table_control; ?></th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                    if($list !== false) {
                        foreach($list as $listItem) {
                            ?>
                            <tr>
                                <td><?= $listItem->name === null ? $listItem->description : $listItem->name; ?></td>
                                <td><?= round($listItem->payment); ?></td>
                                <td><?= $listItem->created; ?></td>
                                <td class="controls_td">
                                    <a href="javascript:;" class="open_controls"><i class="fa fa-caret-square-o-left"></i></a>
                                    <div class="controls_container">
                                        <a href="/outcomevouchers/view/<?= $listItem->id ?>" ><i class="fa fa-print"></i><?= $text_table_control_print ?></a>
                                        <a href="/expenseslist/edit/<?= $listItem->id ?>" ><i class="fa fa-edit"></i><?= $text_table_control_edit ?></a>
                                        <a href="/expenseslist/delete/<?= $listItem->id ?>/?token=<?= $this->session->CSRFToken ?>" onclick="if(!confirm('<?= $text_table_control_delete_confirm ?>')) return false;"><i class="fa fa-trash"></i><?= $text_table_control_delete ?></a>
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