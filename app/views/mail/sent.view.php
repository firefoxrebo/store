<div class="app_content_wrapper">
    <div class="window">
        <a class="side_icon" href="/mail/default"><i class="fa fa-envelope"></i></a>
        <a href="/mail/sent" class="side_icon blue"><i class="fa fa-paper-plane"></i></a>
        <header>
            <h1><i class="fa fa-envelope"></i> <?= $text_header ?></h1>
        </header>
        <form class="appForm" method="post" enctype="multipart/form-data">
            <div class="table_container">
                <a href="/mail/new" class="button blue"><i class="fa fa-plus"></i>
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
        </form>
    </div>
</div>