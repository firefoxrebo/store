<div class="rightColumn">
    <div class="block">
        <header class="white">
            <h2><?= $text_main_header ?></h2>
        </header>
        <div class="contentBox clearfix">
            <a href="/products/add" class="button"><i class="fa fa-plus"></i>
                <?= $text_new_button ?></a>
            <div class="statTable">
                <table class="tablesorter">
                    <thead>
                    <tr>
                        <th><?= $text_table_name; ?></th>
                        <th><?= $text_table_category; ?></th>
                        <th><?= $text_table_unit; ?></th>
                        <th><?= $text_table_price; ?></th>
                        <th><?= $text_table_created; ?></th>
                        <th style="width: 100px"><?= $text_table_control; ?></th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                    if($products !== false) {
                        foreach($products as $product) {
                            ?>
                            <tr>
                                <td><?= $product->name; ?></td>
                                <td><?= $product->category; ?></td>
                                <td><?= ${'text_unit_' . $product->unit}; ?></td>
                                <td><?= round($product->price,2); ?></td>
                                <td><?= $product->created; ?></td>
                                <td>
                                    <a title="<?= $text_table_control_edit ?>" href="/products/edit/<?= $product->id ?>" ><i class="fa fa-edit"></i></a>
                                    <a title="<?= $text_table_control_delete ?>" href="/products/delete/<?= $product->id ?>/?token=<?= $this->session->CSRFToken ?>" onclick="if(!confirm('<?= $text_table_control_delete_confirm ?>')) return false;"><i class="fa fa-trash"></i></a>
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