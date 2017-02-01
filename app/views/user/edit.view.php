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
                            <label for="firstName"><?= $text_firstname_label ?></label>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <input required type="text" id="firstName" name="firstName" value="<?= isset($_POST['firstName']) ? $_POST['firstName'] : $profile->firstname ?>" />
                            <p class="error error_<?= @$this->messenger->statusOf('text_error_firstName_required') ?>">
                                <?= @$this->messenger->get('text_error_firstName_required') ?>
                            </p>
                            <p class="error error_<?= @$this->messenger->statusOf('text_error_firstName_alpha') ?>">
                                <?= @$this->messenger->get('text_error_firstName_alpha') ?>
                            </p>
                            <p class="error error_<?= @$this->messenger->statusOf('text_error_firstName_strbetween') ?>">
                                <?= @$this->messenger->get('text_error_firstName_strbetween') ?>
                            </p>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label for="lastName"><?= $text_lastname_label ?></label>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <input type="text" id="lastName" name="lastName" value="<?= (isset($_POST['lastName'])) ? $_POST['lastName'] : $profile->lastname ?>" />
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label for="dob"><?= $text_dob_label ?></label>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <input type="date" id="dob" name="dob" value="<?= (isset($_POST['dob'])) ? $_POST['dob'] : $profile->dob ?>" />
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label for="address"><?= $text_address_label ?></label>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <input type="text" id="address" name="address" value="<?= (isset($_POST['address'])) ? $_POST['address'] : $profile->address ?>" />
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label for="phone"><?= $text_phone_label ?></label>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <input required type="text" id="phone" name="phone" value="<?= (isset($_POST['phone'])) ? $_POST['phone'] : $profile->phone ?>" />
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label for="privilege"><?= $text_privilege_label ?></label>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <select name="privilege" id="privilege">
                                <option value="1" <?php if($emp->privilege == 1) echo 'selected' ?>><?= $text_privilege_manager ?></option>
                                <option value="2" <?php if($emp->privilege == 2) echo 'selected' ?>><?= $text_privilege_accountant ?></option>
                                <option value="3" <?php if($emp->privilege == 3) echo 'selected' ?>><?= $text_privilege_auditor ?></option>
                                <option value="4" <?php if($emp->privilege == 4) echo 'selected' ?>><?= $text_privilege_store ?></option>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label for="status"><?= $text_status_label ?></label>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <select name="status" id="status">
                                <option value="1" <?php if($emp->status == 1) echo 'selected' ?>><?= $text_status_enabled ?></option>
                                <option value="2" <?php if($emp->status == 2) echo 'selected' ?>><?= $text_status_disabled ?></option>
                            </select>
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