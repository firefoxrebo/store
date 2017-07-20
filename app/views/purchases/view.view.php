<div class="rightColumn">
    <div class="block">
        <div class="contentBox clearfix">
            <div class="bill">
                <div class="title">
                    <span>فاتورة</span>
                    <span>Invoice</span>
                </div>
                <div class="paymentType">
                    <div class="paymentTypeContainer">
                        <span class="paymentTypeBox <?= $invoice->paymentType == 1 ? 'selected' : '' ?>"></span> نقدا Cash
                        <span class="paymentTypeBox <?= $invoice->paymentType == 2 ? 'selected' : '' ?>"></span>آجل Credit
                    </div>
                    <div class="date">
                        <span>التاريخ Date: <?= (new DateTime($invoice->created))->format('Y/m/d') ?></span>
                    </div>
                </div>
                <h1>
                    <span>السيد / السادة: </span><?= $invoice->supplier ?> <span>Mr./ Mes.</span>
                </h1>
                <table class="bill">
                    <tr>
                        <th>م</th>
                        <th>رقم الصنف</th>
                        <th>البيان</th>
                        <th>الكمية</th>
                        <th>سعر الوحدة</th>
                        <th>الاجمالي</th>
                    </tr>
                    <?php if (false !== $details): $total = 0; foreach ($details as $detail): $i = 0; ?>
                        <tr>
                            <td>
                                <?= ++$i ?>
                            </td>
                            <td>
                                P<?= $detail->productId ?>
                            </td>
                            <td>
                                <?= $detail->name ?>
                            </td>
                            <td>
                                <?= (int) $detail->quantity ?>
                            </td>
                            <td>
                                <?= (int) $detail->price ?>
                            </td>
                            <td>
                                <?= (int) $detail->quantity * (int) $detail->price ?>
                                <?php $total += (int) $detail->quantity * (int) $detail->price ?>
                            </td>
                        </tr>
                    <?php endforeach; endif; ?>
                        <tr>
                            <td colspan="5">إجمالي القيمة</td>
                            <td colspan="1"><?= $total ?></td>
                        </tr>
                </table>
                <h1>
                    <span>فقط: </span><input autofocus type="text"><span>Only: </span>
                </h1>
                <div class="signatures">
                    <div class="salesman">
                        <p>توقيع البائع Salesman Signature</p>
                    </div>
                    <div class="buyer">
                        <p>اسم المستلم و توقيعه Receiver Name & Signature</p>
                    </div>
                </div>
                <div class="footer">
                    <p>الرياض: شارع هارون الرشيد، حي المشاعل، مستودعات التويجري مستودع رقم ١</p>
                    <p>ص.ب: ٨٧٣٩ - الرمز البريدي: ١١٩٤٢ - جوال: ٠٥٨٠٠٨٨٤١٦ - سجل تجاري: ١٠١١٠١١٤٠٢</p>
                </div>
            </div>
        </div>
        <footer>
            <p><?= $text_footer ?></p>
        </footer>
    </div>
</div>