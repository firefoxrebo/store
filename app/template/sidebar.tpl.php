<div class="leftColumn">
	<div class="block">
		<div class="box">
            <?php $userPrivilege = $this->_registry->session->u->privilege; ?>
            <ul class="mainNav">
                <li><a href="/moneyin" class="<?php if($this->highlightMenu('moneyin')) echo 'selected'; ?>"><i class="material-icons">move_to_inbox</i></a></li>
                <li><a href="/moneyout" class="<?php if($this->highlightMenu('moneyout')) echo 'selected'; ?>"><i class="fa fa-gift"></i></a></li>
                <?php if($this->enableMenu($userPrivilege, array(1,2))) { ?>
                    <li><a href="/volunteers" class="<?php if($this->highlightMenu('volunteers')) echo 'selected'; ?>"><i class="material-icons">group</i></a></li>
                <?php } ?>
                <?php if($this->enableMenu($userPrivilege, array(1,2))) { ?>
                <li><a href="/client" class="<?php if($this->highlightMenu('client')) echo 'selected'; ?>"><i class="material-icons">contacts</i></a></li>
                <?php } ?>
                <?php if($this->enableMenu($userPrivilege, array(1,2))) { ?>
                    <li><a href="/store" class="<?php if($this->highlightMenu('store')) echo 'selected'; ?>"><i class="material-icons">store</i></a></li>
                <?php } ?>
                <?php if($this->enableMenu($userPrivilege, array(1,2))) { ?>
                    <li><a href="/fillstore" class="<?php if($this->highlightMenu('fillstore')) echo 'selected'; ?>"><i class="material-icons">store</i><i class="fa fa-arrow-down"></i></a></li>
                <?php } ?>
                <?php if($this->enableMenu($userPrivilege, array(1))) { ?>
                <li><a href="/employee" class="<?php if($this->highlightMenu('employee')) echo 'selected'; ?>"><i class="fa fa-user"></i></a></li>
                <?php } ?>
                <?php if($this->enableMenu($userPrivilege, array(1,2))) { ?>
                    <li><a href="/expenses" class="<?php if($this->highlightMenu('expenses')) echo 'selected'; ?>"><i class="fa fa-money"></i></a></li>
                <?php } ?>
                <?php if($this->enableMenu($userPrivilege, array(1))) { ?>
                    <li><a href="/report" class="<?php if($this->highlightMenu('report')) echo 'selected'; ?>"><i class="fa fa-bar-chart"></i></a></li>
                <?php } ?>
                <li><a href="/mail" class="<?php if($this->highlightMenu('mail')) echo 'selected'; ?>"><i class="fa fa-envelope"></i></a></li>
                <li><a href="/notification" class="<?php if($this->highlightMenu('notification')) echo 'selected'; ?>"><i class="fa fa-bell"></i></a></li>
            </ul>
		</div>
	</div>
</div>