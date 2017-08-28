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
                            <label for="payment_type"><?= $text_payment_type_label ?></label>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label class="sameRow"><input required type="radio" name="payment_type" <?= $this->radioCheckedIf('paymentType', 1, $voucher) ?> value="1"> <?= $text_payment_type_1 ?></label>
                            <label class="sameRow"><input required type="radio" name="payment_type" <?= $this->radioCheckedIf('paymentType', 2, $voucher) ?> value="2"> <?= $text_payment_type_2 ?></label>
                            <label class="sameRow"><input required type="radio" name="payment_type" <?= $this->radioCheckedIf('paymentType', 3, $voucher) ?> value="3"> <?= $text_payment_type_3 ?></label>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label for="payment"><?= $text_payment_label ?></label>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <input required type="number" step="1" min="1" id="payment" name="payment" value="<?= $this->showValue('payment', $voucher) ?>" />
                            <p class="error error_<?= @$this->messenger->statusOf('text_error_payment') ?>">
                                <?= @$this->messenger->get('text_error_payment') ?>
                            </p>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label for="payment_number"><?= $text_payment_number_label ?></label>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <input type="text" id="payment_number" name="payment_number" value="<?= $this->showValue('paymentNumber', $voucher) ?>" />
                            <p class="error error_<?= @$this->messenger->statusOf('text_error_payment_number') ?>">
                                <?= @$this->messenger->get('text_error_payment_number') ?>
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