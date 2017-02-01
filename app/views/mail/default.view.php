<div class="rightColumn">
    <div class="block">
        <header class="white">
            <h2><?= $text_main_header ?></h2>
        </header>
        <div class="contentBox clearfix">
            <p>
                <a class="mail" href="/mail"><i class="fa fa-envelope"></i> <?= $text_inbox_label ?> (<?= ($mail !== false) ? count($mail) : 0 ?>)</a>
                <a class="mail" href="/mail/sent"><i class="fa fa-paper-plane"></i> <?= $text_sent_label ?></a>
            </p>
            <a href="/mail/new" class="button"><i class="fa fa-plus"></i>
                <?= $text_new_button ?></a>
            <div class="statTable">
                <table class="tablesorter">
                    <thead>
                    <tr>
                        <th style="width: 300px"><?= $text_title; ?></th>
                        <th><?= $text_sender; ?></th>
                        <th><?= $text_datetime; ?></th>
                        <th style="width: 80px"><?= $text_table_control ?></th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                    if($mail !== false) {
                        foreach($mail as $mailObj) {
                            ?>
                            <tr>
                                <td<?= ($mailObj->seen == 0) ? ' class="unread"' : ' class="read"' ?>><a title="<?= $text_table_control_view ?>" href="/mail/view/<?= $mailObj->id ?>"><?= $mailObj->title; ?></a></td>
                                <td><?= $mailObj->sender; ?></td>
                                <td><?= $mailObj->created; ?></td>
                                <td>
                                    <a href="/mail/reply/<?= $mailObj->id ?>" title="<?= $text_table_control_reply ?>"><i class="fa fa-reply"></i></a>
                                    <a href="/mail/forward/<?= $mailObj->id ?>" title="<?= $text_table_control_forward ?>"><i class="fa fa-location-arrow"></i></a>
                                    <a href="/mail/delete/<?= $mailObj->id ?>/?token=<?= $this->session->CSRFToken ?>" title="<?= $text_table_control_delete ?>" onclick="if(!confirm('<?= $text_table_control_delete_confirm ?>')) return false;"><i class="fa fa-trash"></i></a>
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