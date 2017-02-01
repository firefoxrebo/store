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
                            <label for="firstName"><?= $text_firstname_label ?></label>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <input type="text" id="firstName" name="firstName" value="<?= (isset($_POST['firstName'])) ? $_POST['firstName'] : $employee->firstname ?>" />
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label for="lastName"><?= $text_lastname_label ?></label>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <input type="text" id="lastName" name="lastName" value="<?= (isset($_POST['lastName'])) ? $_POST['lastName'] : $employee->lastname ?>" />
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label for="email"><?= $text_email_label ?></label>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <input type="email" id="email" name="email" value="<?= (isset($_POST['email'])) ? $_POST['email'] : $employee->email ?>" />
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label for="dob"><?= $text_dob_label ?></label>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <input type="date" id="dob" name="dob" value="<?= (isset($_POST['dob'])) ? $_POST['dob'] : $employee->dob ?>" />
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label for="address"><?= $text_address_label ?></label>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <input type="text" id="address" name="address" value="<?= (isset($_POST['address'])) ? $_POST['address'] : $employee->address ?>" />
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label for="phone"><?= $text_phone_label ?></label>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <input type="text" id="phone" name="phone" value="<?= (isset($_POST['phone'])) ? $_POST['phone'] : $employee->phone ?>" />
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