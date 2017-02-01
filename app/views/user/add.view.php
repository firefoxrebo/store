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
                            <input required type="text" id="firstName" name="firstName" value="<?= @$_POST['firstName'] ?>" />
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
                            <input type="text" id="lastName" name="lastName" value="<?= (isset($_POST['lastName'])) ? $_POST['lastName'] : '' ?>" />
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label for="dob"><?= $text_dob_label ?></label>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <input type="date" id="dob" name="dob" value="<?= (isset($_POST['dob'])) ? $_POST['dob'] : '' ?>" />
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label for="address"><?= $text_address_label ?></label>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <input type="text" id="address" name="address" value="<?= (isset($_POST['address'])) ? $_POST['address'] : '' ?>" />
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label for="phone"><?= $text_phone_label ?></label>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <input required type="text" id="phone" name="phone" value="<?= (isset($_POST['phone'])) ? $_POST['phone'] : '' ?>" />
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label for="ucname"><?= $text_ucname_label ?></label>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <input required type="text" id="ucname" name="ucname" value="<?= @$_POST['ucname'] ?>" />
                            <p class="error error_<?= @$this->messenger->statusOf('text_error_ucname_required') ?>">
                                <?= @$this->messenger->get('text_error_ucname_required') ?>
                            </p>
                            <p class="error error_<?= @$this->messenger->statusOf('text_error_ucname_alphanumeric') ?>">
                                <?= @$this->messenger->get('text_error_ucname_alphanumeric') ?>
                            </p>
                            <p class="error error_<?= @$this->messenger->statusOf('text_error_ucname_strbetween') ?>">
                                <?= @$this->messenger->get('text_error_ucname_strbetween') ?>
                            </p>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label for="ucpwd"><?= $text_ucpwd_label ?></label>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <input required type="password" id="ucpwd" name="ucpwd" value="<?= @$_POST['ucpwd'] ?>" />
                            <p class="error error_<?= @$this->messenger->statusOf('text_error_ucpwd_required') ?>">
                                <?= @$this->messenger->get('text_error_ucpwd_required') ?>
                            </p>
                            <p class="error error_<?= @$this->messenger->statusOf('text_error_ucpwd_alphanumeric') ?>">
                                <?= @$this->messenger->get('text_error_ucpwd_alphanumeric') ?>
                            </p>
                            <p class="error error_<?= @$this->messenger->statusOf('text_error_ucpwd_equals') ?>">
                                <?= @$this->messenger->get('text_error_ucpwd_equals') ?>
                            </p>
                            <p class="error error_<?= @$this->messenger->statusOf('text_error_ucpwd_gt') ?>">
                                <?= @$this->messenger->get('text_error_ucpwd_gt') ?>
                            </p>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label for="ucpwdc"><?= $text_ucpwdc_label ?></label>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <input required type="password" id="ucpwdc" name="ucpwdc" value="<?= @$_POST['ucpwdc'] ?>" />
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label for="email"><?= $text_email_label ?></label>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <input required type="email" id="email" name="email" value="<?= @$_POST['email'] ?>" />
                            <p class="error error_<?= @$this->messenger->statusOf('text_error_email_required') ?>">
                                <?= @$this->messenger->get('text_error_email_required') ?>
                            </p>
                            <p class="error error_<?= @$this->messenger->statusOf('text_error_email_email') ?>">
                                <?= @$this->messenger->get('text_error_email_email') ?>
                            </p>
                            <p class="error error_<?= @$this->messenger->statusOf('text_error_email_strbetween') ?>">
                                <?= @$this->messenger->get('text_error_email_strbetween') ?>
                            </p>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label for="joined"><?= $text_joined_label ?></label>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <input required type="date" id="joined" name="joined" value="<?= @$_POST['joined'] ?>" max="<?= date('Y-m-d') ?>" />
                            <p class="error error_<?= @$this->messenger->statusOf('text_error_joined_required') ?>">
                                <?= @$this->messenger->get('text_error_joined_required') ?>
                            </p>
                            <p class="error error_<?= @$this->messenger->statusOf('text_error_joined_date') ?>">
                                <?= @$this->messenger->get('text_error_joined_date') ?>
                            </p>
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
                                <option value="1" <?= @$_POST['privilege'] == 1 ? 'selected' : '' ?>><?= $text_privilege_manager ?></option>
                                <option value="2" <?= @$_POST['privilege'] == 2 ? 'selected' : '' ?>><?= $text_privilege_accountant ?></option>
                                <option value="3" <?= @$_POST['privilege'] == 3 ? 'selected' : '' ?>><?= $text_privilege_auditor ?></option>
                                <option value="4" <?= @$_POST['privilege'] == 4 ? 'selected' : '' ?>><?= $text_privilege_store ?></option>
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