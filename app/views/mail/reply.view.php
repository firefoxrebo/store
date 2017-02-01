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
                            <label
                                for="clientId"><?= $text_title_label ?></label>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <input type="text" id="title" name="title" value="<?= (isset($_POST['title'])) ? $_POST['title'] : $mail->title; ?>" />
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label for="content"><?= $text_content_label ?></label>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <textarea autofocus required name="content" id="content" cols="30" rows="10">&#10;&#10;----------------------------------------------------------&#10;<?= (isset($_POST['content'])) ? $_POST['content'] : $mail->content ?></textarea>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <input type="hidden" name="token" value="<?= $this->_registry->session->CSRFToken ?>">
                            <input type="submit" name="submit" value="<?= $text_submit ?>" />
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