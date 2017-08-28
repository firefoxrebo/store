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
                            <label for="fixedPayment"><?= $text_price_label ?></label>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <input type="number" step="0.01" min="1" id="fixedPayment" name="fixedPayment" value="<?php if (isset($_POST['fixedPayment'])) echo $_POST['fixedPayment'] ?>" />
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