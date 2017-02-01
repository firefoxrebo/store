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
                            <p><?= $employee->firstname; ?></p>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label for="lastName"><?= $text_lastname_label ?></label>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <p><?= $employee->lastname; ?></p>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label for="email"><?= $text_email_label ?></label>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <p><?= $employee->email; ?></p>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label for="dob"><?= $text_dob_label ?></label>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <p><?= (new DateTime($employee->dob))->format('d/m/Y'); ?></p>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label for="address"><?= $text_address_label ?></label>
                        </td>
                    </tr>
                    <td>
                        <p><?= $employee->address; ?></p>
                    </td>
                    <tr>
                        <td>
                            <label for="phone"><?= $text_phone_label ?></label>
                        </td>
                    </tr>
                    <td>
                        <p><?= $employee->phone; ?></p>
                    </td>
                </table>
            </form>
		</div>
		<footer>
			<p><?= $text_footer ?></p>
		</footer>
	</div>
</div>