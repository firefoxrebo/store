<div class="block login">
    <header class="white">
        <h2><?= $login_header ?></h2>
    </header>
    <div class="contentBox">
        <form action="" class="appForm" method="post">
            <table>
                    <?php if(isset($error_login)) { ?>
                    <tr>
                        <td>
                            <p class="error"><?= $error_login ?></p>
                        </td>
                    </tr>
                    <?php } ?>
                    <tr>
                        <td>
                            <label for="ucname"><?= $login_ucname; ?>:</label>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <input required type="text" id="ucname" name="ucname" />
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label for="ucpwd"><?= $login_ucpwd; ?>:</label>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <input required type="password" id="ucpwd" name="ucpwd" />
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <input type="submit" name="submit" value="<?= $login_button ?>" />
                        </td>
                    </tr>
            </table>
        </form>
    </div>
    <footer>
        <p>
            <?= $login_footer ?>
        </p>
    </footer>
</div>