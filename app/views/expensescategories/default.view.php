<div class="rightColumn">
    <div class="block">
        <header class="white">
            <h2><?= $text_main_header ?></h2>
        </header>
        <div class="contentBox clearfix">
            <a href="/expensescategories/add" class="button"><i class="fa fa-plus"></i>
                <?= $text_new_button ?></a>
            <div class="statTable">
                <table class="tablesorter">
                    <thead>
                    <tr>
                        <th><?= $text_table_name; ?></th>
                        <th><?= $text_table_price; ?></th>
                        <th style="width: 100px"><?= $text_table_control; ?></th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                    if($categories !== false) {
                        foreach($categories as $category) {
                            ?>
                            <tr>
                                <td><?= $category->name; ?></td>
                                <td><?= round($category->fixedPayment); ?></td>
                                <td>
                                    <a title="<?= $text_table_control_edit ?>" href="/expensescategories/edit/<?= $category->id ?>" ><i class="fa fa-edit"></i></a>
                                    <a title="<?= $text_table_control_delete ?>" href="/expensescategories/delete/<?= $category->id ?>/?token=<?= $this->session->CSRFToken ?>" onclick="if(!confirm('<?= $text_table_control_delete_confirm ?>')) return false;"><i class="fa fa-trash"></i></a>
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