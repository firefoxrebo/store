<div class="app_content_wrapper">
    <div class="window">
        <a class="side_icon" href="/schools"><i class="fa fa-university"></i></a>
        <header>
            <h1><i class="fa fa-university"></i> <?= $text_header ?></h1>
        </header>
        <form class="appForm" method="post" enctype="multipart/form-data">
            <div class="input_container full">
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
                            <label for="ucname"><?= $text_ucname_label ?></label>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <input required type="text" id="ucname" name="ucname" value="<?= isset($_POST['ucname']) ? $_POST['ucname'] : $emp->ucname ?>" />
                            <p class="error error_<?= @$this->messenger->statusOf('text_error_ucname_required') ?>">
                                <?= @$this->messenger->get('text_error_ucname_required') ?>
                            </p>
                            <p class="error error_<?= @$this->messenger->statusOf('text_error_ucname_alphanumeric') ?>">
                                <?= @$this->messenger->get('text_error_ucname_alphanumeric') ?>
                            </p>
                            <p class="error error_<?= @$this->messenger->statusOf('text_error_ucname_strbetween') ?>">
                                <?= @$this->messenger->get('text_error_ucname_strbetween') ?>
                            </p>
                            <p class="error error_<?= @$this->messenger->statusOf('error_ucname_exists') ?>">
                                <?= @$this->messenger->get('error_ucname_exists') ?>
                            </p>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label for="email"><?= $text_email_label ?></label>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <input required type="email" id="email" name="email" value="<?= isset($_POST['email']) ? $_POST['email'] : $profile->email ?>" />
                            <p class="error error_<?= @$this->messenger->statusOf('text_error_email_required') ?>">
                                <?= @$this->messenger->get('text_error_email_required') ?>
                            </p>
                            <p class="error error_<?= @$this->messenger->statusOf('text_error_email_email') ?>">
                                <?= @$this->messenger->get('text_error_email_email') ?>
                            </p>
                            <p class="error error_<?= @$this->messenger->statusOf('text_error_email_strbetween') ?>">
                                <?= @$this->messenger->get('text_error_email_strbetween') ?>
                            </p>
                            <p class="error error_<?= @$this->messenger->statusOf('error_email_exists') ?>">
                                <?= @$this->messenger->get('error_email_exists') ?>
                            </p>
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
            </div>
        </form>
    </div>
</div>