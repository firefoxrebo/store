<div class="app_content_wrapper">
    <div class="window">
        <a class="side_icon" href="/mail/"><i class="fa fa-envelope"></i></a>
        <header>
            <h1><i class="fa fa-envelope"></i> <?= $text_header ?></h1>
        </header>
        <form class="appForm" method="post" enctype="multipart/form-data">
            <div class="input_container full">
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
            </div>
        </form>
    </div>
</div>