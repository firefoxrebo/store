<div class="rightColumn">
    <div class="block">
        <header class="white">
            <h2><?= $text_main_header ?></h2>
        </header>
        <div class="contentBox clearfix">
            <a href="/suppliers/add" class="button"><i class="fa fa-plus"></i>
                <?= $text_new_button ?></a>
            <div class="statTable">
                <table class="tablesorter">
                    <thead>
                    <tr>
                        <th><?= $text_table_name; ?></th>
                        <th><?= $text_table_city; ?></th>
                        <th><?= $text_table_mobile; ?></th>
                        <th style="width: 100px"><?= $text_table_control; ?></th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                    if($clients !== false) {
                        $cities = $this->_registry->lang->get('suppliers|cities');
                        foreach($clients as $client) {
                            ?>
                            <tr>
                                <td><?= $client->name; ?></td>
                                <td><?= $cities[$client->city]; ?></td>
                                <td><?= $client->mobile; ?></td>
                                <td><a title="<?= $text_table_control_view ?>" href="/suppliers/view/<?= $client->id ?>"><i class="fa fa-eye"></i></a><a
                                        href="/suppliers/edit/<?= $client->id ?>" title="<?= $text_table_control_edit ?>"><i class="fa fa-edit"></i></a><a
                                        title="<?= $text_table_control_delete ?>" href="/suppliers/delete/<?= $client->id ?>/?token=<?= $this->session->CSRFToken ?>" onclick="if(!confirm('<?= $text_table_control_delete_confirm ?>')) return false;"><i class="fa fa-trash"></i></a>
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