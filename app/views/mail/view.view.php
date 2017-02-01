<div class="rightColumn">
    <div class="block">
        <header class="white">
            <h2><?= $text_header ?></h2>
        </header>
        <div class="contentBox clearfix">
            <form action="" class="appForm" method="post">
                <div class="messageContainer clearfix">
                    <h3><?= $sender->ucname ?> : <?= $mail->title ?></h3>
                    <div class="message_tools">
                        <a href="/mail" title="عودة لصندوق البريد"><i class="fa fa-arrow-circle-o-up"></i></a>
                        <a href="/mail/reply/<?= $mail->id ?>" title="<?= $text_table_control_reply ?>"><i class="fa fa-reply"></i></a>
                        <a href="/mail/forward/<?= $mail->id ?>" title="<?= $text_table_control_forward ?>"><i class="fa fa-location-arrow"></i></a>
                        <a href="/mail/delete/<?= $mail->id ?>/?token=<?= $this->session->CSRFToken ?>" title="<?= $text_table_control_delete ?>" onclick="if(!confirm('<?= $text_table_control_delete_confirm ?>')) return false;"><i class="fa fa-trash"></i></a>
                    </div>
                    <div class="message_body">
                        <p><?= nl2br($mail->content) ?></p>
                    </div>
                </div>
            </form>
        </div>
        <footer>
            <p><?= $text_footer ?></p>
        </footer>
    </div>
</div>