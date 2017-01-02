<div class="app_content_wrapper">
    <div class="window">
        <a class="side_icon" href="/user"><i class="fa fa-user"></i></a>
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
                            <?= $employee->firstname ?>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label for="lastName"><?= $text_lastname_label ?></label>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <?= $employee->lastname ?>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label for="email"><?= $text_email_label ?></label>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <?= $employee->email ?>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label for="dob"><?= $text_dob_label ?></label>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <?= $employee->dob ?>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label for="address"><?= $text_address_label ?></label>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <?= $employee->address ?>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label for="phone"><?= $text_phone_label ?></label>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <?= $employee->phone ?>
                        </td>
                    </tr>
                    <?php if(isset($classes) && $classes !== false) { ?>
                    <tr>
                        <td>
                            <label for="classes"><?= $text_classes_label ?></label>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <?php foreach ($classes as $class): ?>
                                <p><?= $getClass($class->classId)->name ?></p>
                            <?php endforeach; ?>
                        </td>
                    </tr>
                    <?php } ?>
                </table>
            </div>
            <div class="image">
                <div class="profile_image_container">
                    <label for="image"><?= $text_profile_image ?></label>
                    <div class="profile_image" style="background: url(<?= $employee->image != '' ? '/store/images/' .$employee->image : '/img/default_profile.jpg' ?>);"></div>
                </div>
            </div>
        </form>
    </div>
</div>