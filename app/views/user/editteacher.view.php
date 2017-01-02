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
                            <label for="classId"><?= $text_classes_label ?></label>
                        </td>
                    </tr>
                    <tr>
                        <td style="background: #f0f0f0; padding: 0px 20px;border-radius: 5px">
                            <?php if($classes !== false): foreach ($classes as $class): ?>
                                <label style="display: inline-block; margin: 5px"><input type="checkbox" name="classId[]" value="<?= $class->id ?>" <?= in_array($class->id, $prevClasses) ? 'checked' : '' ?>> <?= $class->name ?></label>
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