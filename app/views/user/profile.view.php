<div class="app_content_wrapper">
    <div class="window">
        <a class="side_icon" href=""><i class="fa fa-user"></i></a>
        <header>
            <h1><i class="fa fa-user"></i> <?= $text_profile_header ?></h1>
        </header>
        <form class="appForm" method="post" enctype="multipart/form-data">
            <div class="input_container">
                <table>
                    <tr>
                        <td>
                            <label for="firstName"><?= $text_firstname_label ?></label>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <input required type="text" id="firstName" name="firstName" value="<?= (isset($_POST['firstName'])) ? $_POST['firstName'] : $employee->firstname ?>" />
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label for="lastName"><?= $text_lastname_label ?></label>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <input type="text" id="lastName" name="lastName" value="<?= (isset($_POST['lastName'])) ? $_POST['lastName'] : $employee->lastname ?>" />
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label for="email"><?= $text_email_label ?></label>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <input required type="email" id="email" name="email" value="<?= (isset($_POST['email'])) ? $_POST['email'] : $employee->email ?>" />
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label for="dob"><?= $text_dob_label ?></label>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <input type="date" id="dob" name="dob" value="<?= (isset($_POST['dob'])) ? $_POST['dob'] : $employee->dob ?>" />
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label for="address"><?= $text_address_label ?></label>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <input type="text" id="address" name="address" value="<?= (isset($_POST['address'])) ? $_POST['address'] : $employee->address ?>" />
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label for="phone"><?= $text_phone_label ?></label>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <input required type="text" id="phone" name="phone" value="<?= (isset($_POST['phone'])) ? $_POST['phone'] : $employee->phone ?>" />
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
            <div class="image">
                <div class="profile_image_container">
                    <label for="image"><?= $text_profile_image ?></label>
                    <div class="profile_image" style="background: url(<?= $employee->image != '' ? '/store/images/' .$employee->image : '/img/default_profile.jpg' ?>);"></div>
                </div>
                <a href="javascript:;" class="file_dialog_switch"><?= $text_profile_choose_image ?></a>
                <input type="file" name="image" id="image">
                <span></span>
            </div>
        </form>
    </div>
</div>