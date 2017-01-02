<div class="app_content_wrapper">
    <div class="window">
        <a class="side_icon" href="/mail"><i class="fa fa-envelope"></i></a>
        <header>
            <h1><i class="fa fa-envelope"></i> <?= $text_header ?></h1>
        </header>
        <form class="appForm" method="post" enctype="multipart/form-data">
            <div class="input_container full">
                <table>
                    <tr>
                        <td>
                            <label for="title"><?= $text_title_label ?></label>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <input type="text" id="title" name="title" />
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label for="receiverId"><?= $text_name_label ?></label>
                            <p><?= $text_name_guide ?></p>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <input type="text" id="receiverId" name="receiverId" />
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label for="content"><?= $text_content_label ?></label>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <textarea required name="content" id="content" cols="30" rows="10"></textarea>
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
        </form>
    </div>
</div>