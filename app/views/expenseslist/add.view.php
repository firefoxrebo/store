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
                            <label for="categoryId"><?= $text_category_label ?></label>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <select name="categoryId" id="categoryId">
                                <option value=""><?= $text_select_category ?></option>
                                <?php if (false !== $categories): foreach ($categories as $category): ?>
                                <option value="<?= $category->id ?>" <?= $this->selectedIf('categoryId', $category->id) ?>><?= $category->name ?></option>
                                <?php endforeach; endif; ?>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label for="payment"><?= $text_payment_label ?></label>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <input type="number" step="0.01" min="1" id="payment" name="payment" value="<?php if (isset($_POST['payment'])) echo $_POST['payment'] ?>" />
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label for="description"><?= $text_description_label ?></label>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <input required type="text" id="description" name="description" value="<?= $this->showValue('description') ?>" />
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