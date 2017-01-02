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
        <div class="contentBox clearfix">
            <ul class="dashboard_controls">
                <li><a href="/suppliers" class="<?php if($this->highlightMenu('suppliers')) echo 'selected'; ?>"><i class="material-icons">group</i><?= $text_ctrl_suppliers; ?></a></li>
                <li><a href="/client" class="<?php if($this->highlightMenu('client')) echo 'selected'; ?>"><i class="material-icons">contacts</i><?= $text_ctrl_clients; ?></a></li>
                <li><a href="/store" class="<?php if($this->highlightMenu('store')) echo 'selected'; ?>"><i class="material-icons">store</i><?= $text_ctrl_store; ?></a></li>
                <li><a href="/accounting" class="<?php if($this->highlightMenu('expenses')) echo 'selected'; ?>"><i class="fa fa-money"></i><?= $text_ctrl_accounting; ?></a></li>
                <li><a href="/report" class="<?php if($this->highlightMenu('report')) echo 'selected'; ?>"><i class="fa fa-bar-chart"></i><?= $text_ctrl_stats ?></a></li>
                <li><a href="/employee" class="<?php if($this->highlightMenu('employee')) echo 'selected'; ?>"><i class="fa fa-user"></i><?= $text_ctrl_employees; ?></a></li>
                <li><a href="/mail" class="<?php if($this->highlightMenu('mail')) echo 'selected'; ?>"><i class="fa fa-envelope"></i><?= $text_ctrl_mail ?> (<?= $this->_registry->startup->mailTotal; ?>)</a></li>
                <li><a href="/notification" class="<?php if($this->highlightMenu('notification')) echo 'selected'; ?>"><i class="fa fa-bell"></i><?= $text_ctrl_notifications ?> (<?= ($this->_registry->startup->notificationsTotal === false) ? 0 : count($this->_registry->startup->notificationsTotal) ?>)</a></li>
            </ul>
        </div>
        <footer>
            <p>
                <?= $text_footer ?>
            </p>
        </footer>
    </div>
</div>