<div class="wrapper">
	<header class="topHeader">
		<div class="headerNav">
			<ul class="topNavWrapper clearfix">
				<li>
                    <a href="/" title="<?= $header_home_tooltip ?>" class="selected"> <i class="fa fa-home fa-lg"></i></a>
                </li>
                <li><h1><?= APP_HEADER_TITLE ?></h1></li>
                <li><a href="" class="notification"> <i class="fa fa-user"></i>
				</a>
					<ul class="notificationList user">
						<header>
                                                    <strong><?= $header_account_label ?></strong>
							<div class="pointer"></div>
						</header>
						<li><a href="/employee/profile"><?= $header_account_profile ?> <i class="fa fa-user"></i></a></li>
                        <li><a href="/employee/password"><?= $header_account_password ?> <i class="fa fa-key"></i></a></li>
                        <li><a href="/auth/logout"><?= $header_account_logout ?> <i class="fa fa-sign-out"></i></a></li>
					</ul></li>
				<li><a href="" class="notification"> <i class="fa fa-bell"></i>
						<div class="notificationCount"><?= ($this->_registry->startup->notificationsTotal === false) ? 0 : count($this->_registry->startup->notificationsTotal) ?></div>
				</a>
					<ul class="notificationList">
						<header>
                            <strong><?= $header_notifications_label ?></strong></a>
							<div class="pointer"></div>
						</header>
                        <?php
                            if(false !== $this->_registry->startup->notificationsTotal) {
                                $count = count($this->_registry->startup->notificationsTotal);
                                $count = ($count < 4) ? $count : 4;
                                for($i = 0; $i < $count; $i++) {
                        ?>
                                    <li><a href="/notification/view/<?= $this->_registry->startup->notificationsTotal[$i]->id ?>"><?= $this->_registry->startup->notificationsTotal[$i]->title ?><i class="fa fa-clock-o"><?= $this->_registry->startup->notificationsTotal[$i]->created ?></i></a></li>
                        <?php
                                }
                            }
                        ?>
                        <footer>
							<a href="/notification"><?= $header_notifications_seeall ?></a>
						</footer>
					</ul></li>
			</ul>
		</div>
	</header>
	<div class="content clearfix">