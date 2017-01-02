<div class="rightColumn">
	<div class="block">
		<header class="white">
			<h2><?= $text_header ?></h2>
		</header>
		<div class="contentBox clearfix">
            <form action="" class="appForm" method="post">
                <table>
                    <tr>
                        <td>
                            <label for="ucpwd"><?= $text_ucpwd_label ?></label>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <input required type="password" id="ucpwd" name="ucpwd" value="<?php if(isset($_POST['ucpwd'])) echo $_POST['ucpwd'] ?>" />
                            <?php if(isset($error_ucpwd)) { ?>
                            <p class="error"><?= $error_ucpwd ?></p>
                            <?php } ?>
                            <?php if(isset($error_ucpwd_less)) { ?>
                            <p class="error"><?= $error_ucpwd_less ?></p>
                            <?php } ?>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label for="ucpwdc"><?= $text_ucpwdc_label ?></label>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <input required type="password" id="ucpwdc" name="ucpwdc" value="<?php if(isset($_POST['ucpwdc'])) echo $_POST['ucpwdc'] ?>" />
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <input type="hidden" name="token" value="<?= $this->_registry->session->CSRFToken ?>">
                            <input type="submit" name="submit" value="<?= $text_submit ?>" />
                        </td>
                    </tr>
                </table>
            </form>
		</div>
		<footer>
			<p><?= $text_footer ?></p>
		</footer>
	</div>
</div>