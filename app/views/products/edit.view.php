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
                            <input maxlength="50" required type="text" id="name" name="name" value="<?= (isset($_POST['name'])) ? $_POST['name'] : $product->name ?>" />
                            <p class="error error_<?= @$this->messenger->statusOf('text_error_name') ?>">
                                <?= @$this->messenger->get('text_error_name') ?>
                            </p>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label for="unit"><?= $text_unit_label ?></label>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <select required name="unit" id="unit">
                                <option value=""><?= $text_select ?></option>
                                <option <?= (@$_POST['unit'] == 1 || $product->unit == 1) ? 'selected' : '' ?> value="1"><?= $text_unit_1 ?></option>
                                <option <?= (@$_POST['unit'] == 2 || $product->unit == 2) ? 'selected' : '' ?> value="2"><?= $text_unit_2 ?></option>
                                <option <?= (@$_POST['unit'] == 3 || $product->unit == 3) ? 'selected' : '' ?> value="3"><?= $text_unit_3 ?></option>
                                <option <?= (@$_POST['unit'] == 4 || $product->unit == 4) ? 'selected' : '' ?> value="4"><?= $text_unit_4 ?></option>
                                <option <?= (@$_POST['unit'] == 5 || $product->unit == 5) ? 'selected' : '' ?> value="5"><?= $text_unit_5 ?></option>
                            </select>
                            <p class="error error_<?= @$this->messenger->statusOf('text_error_unit') ?>">
                                <?= @$this->messenger->get('text_error_unit') ?>
                            </p>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label for="price"><?= $text_price_label ?></label>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <input type="number" name="price" id="price" step="0.01" min="0.01" value="<?= (isset($_POST['price'])) ? $_POST['price'] : $product->price ?>">
                            <p class="error error_<?= @$this->messenger->statusOf('text_error_price') ?>">
                                <?= @$this->messenger->get('text_error_price') ?>
                            </p>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label for="quantity"><?= $text_quantity_label ?></label>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <input type="number" name="quantity" id="quantity" step="1" min="1" value="<?= (isset($_POST['quantity'])) ? $_POST['quantity'] : $product->quantity ?>">
                            <p class="error error_<?= @$this->messenger->statusOf('text_error_quantity') ?>">
                                <?= @$this->messenger->get('text_error_quantity') ?>
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