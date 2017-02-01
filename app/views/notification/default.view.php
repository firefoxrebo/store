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
                        <th><?= $text_title; ?></th>
                        <th><?= $text_datetime; ?></th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                    if($notifications !== false) {
                        foreach($notifications as $notification) {
                            ?>
                            <tr>
                                <td<?= ($notification->seen == 0) ? ' class="unread"' : ' class="read"' ?>><a title="<?= $text_table_control_view ?>" href="/notification/view/<?= $notification->id ?>"><?= $notification->title; ?></a></td>
                                <td><?= $notification->created; ?></td>
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