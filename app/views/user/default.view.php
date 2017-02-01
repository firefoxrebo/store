<div class="rightColumn">
    <div class="block">
        <header class="white">
            <h2><?= $text_main_header ?></h2>
        </header>
        <div class="contentBox clearfix">
            <a href="/user/add" class="button"><i class="fa fa-plus"></i>
                <?= $text_new_button ?></a>
            <div class="statTable">
                <table class="tablesorter">
                    <thead>
                    <tr>
                        <th><?= $text_table_name; ?></th>
                        <th><?= $text_table_joindate; ?></th>
                        <th><?= $text_table_privilege; ?></th>
                        <th style="width: 80px"><?= $text_table_status; ?></th>
                        <th style="width: 100px"><?= $text_table_control; ?></th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                    if ($users !== false) {
                        $dictionary = $this->_registry->lang->get('user|add');
                        foreach ($users as $user) {
                            ?>
                            <tr>
                                <td><?= $user->ucname; ?></td>
                                <td><?= $user->joined; ?></td>
                                <td><?= $user->getPrivilege($dictionary) ?></td>
                                <td style="width: 80px"><?= $user->getStatus($dictionary) ?></td>
                                <td>
                                    <a title="<?= $text_table_control_view ?>" href="/user/view/<?= $user->id ?>"><i
                                            class="fa fa-eye"></i></a>
                                    <a href="/user/edit/<?= $user->id ?>" title="<?= $text_table_control_edit ?>"><i
                                            class="fa fa-edit"></i></a>
                                    <a title="<?= $text_table_control_delete ?>"
                                       href="/user/delete/<?= $user->id ?>/?token=<?= $this->_registry->session->CSRFToken ?>"
                                       onclick="if(!confirm('<?= $text_table_control_delete_confirm ?>')) return false;"><i
                                            class="fa fa-trash"></i></a>
                                    <a title="<?= $text_table_control_reset ?>"
                                       href="/user/resetpassword/<?= $user->id ?>/?token=<?= $this->_registry->session->CSRFToken ?>"
                                       onclick="if(!confirm('<?= $text_table_control_reset_confirm ?>')) return false;"><i
                                            class="fa fa-key"></i></a>
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