<div class="rightColumn">
    <div class="block">
        <header class="white">
            <h2><?= $text_header ?></h2>
        </header>
        <div class="contentBox clearfix">
            <form id="client_form" action="" class="appForm" method="post">
                <table>
                    <tr>
                        <td>
                            <label for="name"><?= $text_name_label ?></label>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <input maxlength="50" required type="text" id="name" name="name" value="<?php if (isset($_POST['name'])) echo $_POST['name'] ?>" />
                            <p class="error error_<?= @$this->messenger->statusOf('text_error_name') ?>">
                                <?= @$this->messenger->get('text_error_name') ?>
                            </p>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label for="city"><?= $text_city_label ?></label>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <select required name="city" id="city">
                                <?php
                                foreach ($cities as $key => $city) {
                                    ?>
                                    <option value="<?= $key ?>"><?= $city ?></option>
                                    <?php
                                }
                                ?>
                            </select>
                            <p class="error error_<?= @$this->messenger->statusOf('text_error_city') ?>">
                                <?= @$this->messenger->get('text_error_city') ?>
                            </p>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label for="mobile"><?= $text_mobile_label ?></label>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <input maxlength="15" required type="text" id="mobile" name="mobile" value="<?php if (isset($_POST['mobile'])) echo $_POST['mobile'] ?>"/>
                            <p class="error error_<?= @$this->messenger->statusOf('text_error_mobile') ?>">
                                <?= @$this->messenger->get('text_error_mobile') ?>
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
                            <input type="email" id="email" name="email" value="<?php if (isset($_POST['email'])) echo $_POST['email'] ?>"/>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label for="address"><?= $text_address_label ?></label>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <input required type="text" id="address" name="address" value="<?php if (isset($_POST['address'])) echo $_POST['address'] ?>"/>
                            <p class="error error_<?= @$this->messenger->statusOf('text_error_address') ?>">
                                <?= @$this->messenger->get('text_error_address') ?>
                            </p>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label for="subscribed"><?= $text_subscribed_label ?></label>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <input required type="date" id="subscribed" name="subscribed" value="<?php if (isset($_POST['subscribed'])) echo $_POST['subscribed'] ?>" max="<?= date('Y-m-d') ?>"/>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label for="isSupplier"><?= $text_is_supplier ?></label>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <input type="checkbox" id="isSupplier" name="isSupplier" <?= $this->boxCheckedIf('isSupplier', 1) ?> value="<?= $this->showValue('isSupplier', null, 1) ?>"/>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <input type="hidden" name="token" value="<?= $this->_registry->session->CSRFToken ?>">
                            <input type="submit" name="submit" value="<?= $text_submit ?>"/>
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