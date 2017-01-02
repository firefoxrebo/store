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
                <li><a href="/moneyin" class="<?php if($this->highlightMenu('moneyin')) echo 'selected'; ?>"><i class="material-icons">move_to_inbox</i><?= $text_ctrl_money_in; ?></a></li>
                <li><a href="/moneyout" class="<?php if($this->highlightMenu('moneyout')) echo 'selected'; ?>"><i class="fa fa-gift"></i><?= $text_ctrl_money_out; ?></a></li>
                <?php if($this->enableMenu($userPrivilege, array(1,2))) { ?>
                    <li><a href="/volunteers" class="<?php if($this->highlightMenu('volunteers')) echo 'selected'; ?>"><i class="material-icons">group</i><?= $text_ctrl_volunteers; ?></a></li>
                <?php } ?>
                <?php if($this->enableMenu($userPrivilege, array(1,2))) { ?>
                    <li><a href="/client" class="<?php if($this->highlightMenu('client')) echo 'selected'; ?>"><i class="material-icons">contacts</i><?= $text_ctrl_clients; ?></a></li>
                <?php } ?>
                <?php if($this->enableMenu($userPrivilege, array(1,2))) { ?>
                    <li><a href="/store" class="<?php if($this->highlightMenu('store')) echo 'selected'; ?>"><i class="material-icons">store</i><?= $text_ctrl_store; ?></a></li>
                <?php } ?>
                <?php if($this->enableMenu($userPrivilege, array(1,2))) { ?>
                    <li><a href="/fillstore" class="<?php if($this->highlightMenu('fillstore')) echo 'selected'; ?>"><i class="material-icons">store</i><i class="fa fa-arrow-down" style="font-size: 100%"></i><?= $text_ctrl_fill_store; ?></a></li>
                <?php } ?>
                <?php if($this->enableMenu($userPrivilege, array(1))) { ?>
                    <li><a href="/employee" class="<?php if($this->highlightMenu('employee')) echo 'selected'; ?>"><i class="fa fa-user"></i><?= $text_ctrl_employees; ?></a></li>
                <?php } ?>
                <?php if($this->enableMenu($userPrivilege, array(1,2))) { ?>
                    <li><a href="/expenses" class="<?php if($this->highlightMenu('expenses')) echo 'selected'; ?>"><i class="fa fa-money"></i><?= $text_ctrl_expenses; ?></a></li>
                <?php } ?>
                <?php if($this->enableMenu($userPrivilege, array(1))) { ?>
                    <li><a href="/report" class="<?php if($this->highlightMenu('report')) echo 'selected'; ?>"><i class="fa fa-bar-chart"></i><?= $text_ctrl_stats ?></a></li>
                <?php } ?>
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