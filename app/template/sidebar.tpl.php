<div class="leftColumn">
	<div class="block">
		<div class="box">
            <?php $userPrivilege = $this->_registry->session->u->privilege; ?>
            <ul class="mainNav">
                <li>
                    <a href="/suppliers" class="<?php if($this->highlightMenu('suppliers')) echo 'selected'; ?>">
                        <i class="material-icons">group</i>
                    </a>
                    <span><?= $text_ctrl_suppliers; ?></span>
                </li>

                <li>
                    <a href="/clients" class="<?php if($this->highlightMenu('clients')) echo 'selected'; ?>">
                        <i class="material-icons">contacts</i>
                    </a>
                    <span><?= $text_ctrl_clients; ?></span>
                </li>

                <li>
                    <a href="/store" class="<?php if($this->highlightMenu(array('store', 'categories', 'products', 'supplierstransactions', 'clientstransactions'))) echo 'selected'; ?>">
                        <i class="material-icons">store</i>
                    </a>
                    <span><?= $text_ctrl_store; ?></span>
                </li>

                <li>
                    <a href="/expenses" class="<?php if($this->highlightMenu('expenses')) echo 'selected'; ?>">
                        <i class="fa fa-money"></i>
                    </a>
                    <span><?= $text_ctrl_expenses; ?></span>
                </li>

                <li>
                    <a href="/banktransactions" class="<?php if($this->highlightMenu('banktransactions')) echo 'selected'; ?>">
                        <i class="fa fa-bank"></i>
                    </a>
                    <span><?= $text_ctrl_bank; ?></span>
                </li>

                <li>
                    <a href="/report" class="<?php if($this->highlightMenu('report')) echo 'selected'; ?>">
                        <i class="fa fa-bar-chart"></i>
                    </a>
                    <span><?= $text_ctrl_stats; ?></span>
                </li>

                <li>
                    <a href="/user" class="<?php if($this->highlightMenu('user')) echo 'selected'; ?>">
                        <i class="fa fa-user"></i>
                    </a>
                    <span><?= $text_ctrl_employees; ?></span>
                </li>

                <li>
                    <a href="/mail" class="<?php if($this->highlightMenu('mail')) echo 'selected'; ?>">
                        <i class="fa fa-envelope"></i>
                    </a>
                    <span><?= $text_ctrl_mail; ?></span>
                </li>

                <li>
                    <a href="/notification" class="<?php if($this->highlightMenu('notification')) echo 'selected'; ?>">
                        <i class="fa fa-bell"></i>
                    </a>
                    <span><?= $text_ctrl_notifications; ?></span>
                </li>
            </ul>
		</div>
	</div>
</div>