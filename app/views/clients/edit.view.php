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
                            <label for="name"><?= $text_name_label ?></label>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <input maxlength="50" required type="text" id="name" name="name" value="<?= (isset($_POST['name'])) ? $_POST['name'] : $client->name; ?>"/>
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
                                    <option
                                        value="<?= $key ?>" <?php if ((isset($_POST['city']) && $_POST['city'] == $key) || $client->city == $key) echo 'selected' ?>><?= $city ?></option>
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
                            <input maxlength="12" required type="text" id="mobile" name="mobile" value="<?= (isset($_POST['mobile'])) ? $_POST['mobile'] : $client->mobile ?>"/>
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
                            <input type="email" id="email" name="email" value="<?= (isset($_POST['email'])) ? $_POST['email'] : $client->email ?>"/>
                            <p class="error error_<?= @$this->messenger->statusOf('text_error_email') ?>">
                                <?= @$this->messenger->get('text_error_email') ?>
                            </p>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label for="address"><?= $text_address_label ?></label>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <input required type="text" id="address" name="address" value="<?= (isset($_POST['address'])) ? $_POST['address'] : $client->address ?>"/>
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
                            <input required type="date" id="subscribed" name="subscribed" value="<?= (isset($_POST['subscribed'])) ? $_POST['subscribed'] : $client->subscribed ?>" max="<?= date('Y-m-d') ?>"/>
                            <p class="error error_<?= @$this->messenger->statusOf('text_error_subscribed') ?>">
                                <?= @$this->messenger->get('text_error_subscribed') ?>
                            </p>
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