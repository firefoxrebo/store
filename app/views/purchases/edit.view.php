<div class="rightColumn">
    <div class="block">
        <header class="white">
            <h2><?= $text_header ?></h2>
        </header>
        <div class="contentBox clearfix">
            <form id="client_form" action="" class="appForm" method="post">
                <table>
                    <tr>
                        <td><label for="paymentType"><?= $text_payment_type_label ?></label></td>
                    </tr>
                    <tr>
                        <td>
                            <label class="sameRow"><input required type="radio" name="paymentType" <?= $this->boxCheckedIf('paymentType', 1, $invoice) ?> value="1"> <?= $text_payment_type_1 ?></label>
                            <label class="sameRow"><input required type="radio" name="paymentType" <?= $this->boxCheckedIf('paymentType', 2, $invoice) ?> value="2"> <?= $text_payment_type_2 ?></label>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label for="supplierId"><?= $text_name_label ?></label>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <select required name="supplierId" id="supplierId">
                                <option value=""><?= $text_select ?></option>
                                <?php if (false !== $suppliers): foreach ($suppliers as $supplier): ?>
                                    <option <?= ($invoice->supplierId == $supplier->id && $supplier->type == $invoice->supplierType) ? 'selected' : '' ?> value='<?= '{' . '"id":' . $supplier->id . ',"type":' . $supplier->type . '}' ?>'><?= $supplier->name ?></option>
                                <?php endforeach;endif; ?>
                            </select>
                            <p class="error error_<?= @$this->messenger->statusOf('text_error_supplierId') ?>">
                                <?= @$this->messenger->get('text_error_supplierId') ?>
                            </p>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label for="products"><?= $text_products_label ?></label>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <select name="products" id="products">
                                <option value=""><?= $text_select ?></option>
                                <?php if (false !== $products): foreach ($products as $product): ?>
                                    <option data-price="<?= $product->price ?>" <?= (@$_POST['products'] == $product->id) ? 'selected' : '' ?> value="<?= $product->id ?>"><?= $product->name ?></option>
                                <?php endforeach;endif; ?>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td>

                        </td>
                    </tr>
                    <tr>
                        <td>
                            <a class="addProduct" href="javascript:void(0);"><i class="fa fa-plus"></i> <?= $text_add_product ?></a>
                            <div class="products_list">
                                <table>
                                    <tr>
                                        <td><?= $text_product_name ?></td>
                                        <td><?= $text_product_quantity ?></td>
                                        <td><?= $text_product_price ?></td>
                                    </tr>
                                    <?php if (false !== $details): foreach ($details as $detail): ?>
                                        <tr>
                                            <td>
                                                <p><?= $detail->name ?></p>
                                            </td>
                                            <td>
                                                <input name="productq[]" type="number" required min="1" value="<?= $detail->quantity ?>">
                                            </td>
                                            <td>
                                                <input name="productp[]" type="number" required min="<?= $detail->price ?>" value="<?= $detail->price ?>">
                                                <input name="productv[]" type="hidden" value="<?= $detail->productId ?>"> <a onclick="removeProduct(this);" href="javascript:void(0);"><i class="fa fa-times"></i></a>
                                            </td>
                                        </tr>
                                    <?php endforeach;endif; ?>
                                </table>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <input type="hidden" name="token" value="<?= $this->_registry->session->CSRFToken ?>">
                            <input class="purchaseBtn" type="submit" name="submit" value="<?= $text_submit ?>"/>
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