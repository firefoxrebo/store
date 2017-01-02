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
                            <label for="classId"><?= $text_classes_label ?></label>
                        </td>
                    </tr>
                    <tr>
                        <td style="background: #f0f0f0; padding: 0px 20px;border-radius: 5px">
                            <?php if($classes !== false): foreach ($classes as $class): ?>
                                <label style="display: inline-block; margin: 5px"><input type="checkbox" name="classId[]" value="<?= $class->id ?>"> <?= $class->name ?></label>
                            <?php endforeach; endif; ?>
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