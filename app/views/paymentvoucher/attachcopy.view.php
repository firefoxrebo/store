<div class="rightColumn">
    <div class="block">
        <header class="white">
            <h2><?= $text_header ?></h2>
        </header>
        <div class="contentBox clearfix">
            <form id="client_form" class="appForm" method="post" enctype="multipart/form-data">
                <table>
                    <tr>
                        <td>
                            <label for="file"><?= $text_file_label ?></label>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <input type="file" name="image" id="file">
                        </td>
                    </tr>
                    <?php if ($voucher->file != ''): ?>
                    <tr>
                        <td>
                            <img src="/_uploads/images/<?= $voucher->file ?>" width="70%">
                        </td>
                    </tr>
                    <?php endif; ?>
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