<div class="rightColumn">
    <?php
        if(isset($_SESSION['message'])) {
    ?>
    <div class="message <?= $this->switchTo($_SESSION['message'][1]) ?>">
        <a href="" class="close"><i class="fa fa-times"></i></a>
        <p><?= $_SESSION['message'][0]; unset($_SESSION['message']) ?></p>
    </div>
    <?php 
        }
    ?>
    <div class="block">
        <header class="white">
            <h2><?= $text_header ?></h2>
        </header>
        <div class="contentBox clearfix"></a>
            <p>
                <a class="mail" href="/mail"><i class="fa fa-envelope"></i> <?= $text_inbox_label ?></a>
                <a class="mail" href="/mail/sent"><i class="fa fa-paper-plane"></i> <?= $text_sent_label ?> (<?= ($mail !== false) ? count($mail) : 0 ?>)</a>
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
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                    if($mail !== false) {
                        foreach($mail as $mailObj) {
                            ?>
                            <tr>
                                <td><?= $mailObj->title; ?></td>
                                <td><?= $mailObj->receiver; ?></td>
                                <td><?= $mailObj->created; ?></td>
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
                <?= $text_footer ?>
            </p>
        </footer>
    </div>
</div>