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
                            <label for="name"><?= $text_name_label ?></label>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <p><?= $client->name; ?></p>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label for="city"><?= $text_city_label ?></label>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <p><?= $cities[$client->city] ?></p>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label for="mobile"><?= $text_mobile_label ?></label>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <p><?= $client->mobile ?></p>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label for="email"><?= $text_email_label ?></label>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <p><?= $client->email ?></p>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label for="address"><?= $text_address_label ?></label>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <p><?= $client->address ?></p>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label for="subscribed"><?= $text_subscribed_label ?></label>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <p><?= $client->subscribed ?></p>
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