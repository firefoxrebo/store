$(function () {
    $(document).tooltip();
});

var close = document.querySelector('a.close');
if (undefined != close) {
    close.addEventListener('click', function (evt) {
        evt.preventDefault();
        var target = evt.target;
        if (target.tagName == 'A') {
            var notification = target.parentNode;
        } else {
            var notification = target.parentNode.parentNode;
        }
        notification.parentNode.removeChild(notification);
    }, false);
}

$('a.multiple').bind('click', function (e) {
    e.preventDefault();
    $(this).next().slideToggle('normal');
});

// Adding Ckeditor in the required pages
if (typeof CKEDITOR !== 'undefined') {
    var editor = document.querySelector('#ckeditor');
    if (null !== editor) {
        editor = CKEDITOR.replace('ckeditor', {language: 'ar'});
        CKFinder.setupCKEditor(editor, '/ckfinder/');
    }
}

if (typeof CKEDITOR !== 'undefined') {
    var editor = document.querySelector('#ckeditor2');
    if (null !== editor) {
        editor = CKEDITOR.replace('ckeditor2', {language: 'ar'});
        CKFinder.setupCKEditor(editor, '/ckfinder/');
    }
}

if (typeof CKEDITOR !== 'undefined') {
    var editor = document.querySelector('#ckeditormini');
    if (null !== editor) {
        editor = CKEDITOR.replace('ckeditormini', {
            toolbar: [
                {name: 'basicstyles', items: ['Bold', 'Italic']},
                ['Cut', 'Copy', 'Paste', 'PasteText', 'PasteFromWord', '-', 'Undo', 'Redo']
            ],
            language: 'ar'
        });
        CKFinder.setupCKEditor(editor, '/ckfinder/');
    }
}

var printButton = document.querySelector('button.print');
if (printButton !== null) {
    printButton.addEventListener('click', function () {
        window.print();
    }, false);
}

// Add a new instalment and description box
$('a#newInstalment').click(function () {
    $('tr.instalmentTd').last().after('<tr class="instalmentTd">' +
    '<td>' +
    '<input required="required" type="number" name="instalment[]" id="instalment" step="1" />' + "\n" +
    '<input required="required" type="text" name="instalmentDesc[]" id="instalmentDesc" />' +
    '<a class="delInstalment" onclick="deleteInstalment();" href="javascript:void(0);"><i class="fa fa-close"></i></a>' +
    '</td>' +
    '</tr>');
});

function deleteInstalment()
{
    $(event.target).parents('tr').remove();
}

$('select#client_id').selectivity();

$('a#detectLocation').click(function(e)
{
    var output = document.getElementById("out");

    if (!navigator.geolocation){
        output.innerHTML = "<p>Geolocation is not supported by your browser</p>";
        return;
    }

    function success(position) {

        var latitude  = position.coords.latitude;
        var longitude = position.coords.longitude;

        var img = new Image();
        img.src = "https://maps.googleapis.com/maps/api/staticmap?" +
            "center=" + latitude + "," + longitude + "&zoom=16&size=460x220&scale=2" +
            "&markers=color:blue%7Clabel:S%7C" + latitude + "," + longitude + "&sensor=false";

        $('#clat').val(latitude.toString().substring(0,9));
        $('#clong').val(longitude.toString().substring(0,9));

        output.innerHTML = "";
        output.appendChild(img);
    };

    function error(e) {
        output.innerHTML = 'من فضلك تاكد من تشغيل GPS على جهازك';
    };

    output.innerHTML = "<p>يتم تحديد الموقع</p>";

    navigator.geolocation.getCurrentPosition(success, error);
});

function hideConditionValue()
{
    $('tr.conditionValue').hide();
}

function showConditionValue()
{
    $('tr.conditionValue').show();
}

function checkInstalments()
{
    var contractTotal = parseInt($('input#contract_total').val(), 10);
    var deposit = parseInt($('input[name=deposit]').val(), 10);
    var instalmentTotal = 0;
    var instalments = $('tr.instalmentTd input[type=number]');
    for ( var i = 0, ii = instalments.length; i < ii; i++ ) {
        instalmentTotal += parseInt($(instalments[i]).val(), 10);
    }
    if(contractTotal === (deposit + instalmentTotal)) {
        return true;
    } else {
        event.preventDefault();
        alert('عفوا يجب ان يكون مجموع دفعة المقدم و الدفعات المستحقة مساوي لقيمة العقد');
    }
}

function showOtherInput()
{
    $('input#othertype').show();
}

function hideOtherInput()
{
    $('input#othertype').val("");
    $('input#othertype').hide();
}

function showOtherTypeInput()
{
    if(event.target.value == 'اخرى') {
        $('input.othermachinetype').show();
    } else {
        $('input.othermachinetype').val("");
        $('input.othermachinetype').hide();
    }
}

function showOtherManufactureInput()
{
    if(event.target.value == 'اخرى') {
        $('input.othermanufacturetype').show();
    } else {
        $('input.othermanufacturetype').val("");
        $('input.othermanufacturetype').hide();
    }
}

function showOtherFloorInput()
{
    $('input#floorother').show();
    $('input#floorother').attr('disabled', false);
}

function hideOtherFloorInput()
{
    $('input#floorother').val("");
    $('input#floorother').hide();
    $('input#floorother').attr('disabled', true);
}

function showOtherStyleInput()
{
    $('input#doordecorationstyle').show();
    $('input#doordecorationstyle').attr('disabled', false);
}

function hideOtherStyleInput()
{
    $('input#doordecorationstyle').val("");
    $('input#doordecorationstyle').hide();
    $('input#doordecorationstyle').attr('disabled', true);
}

function showOtherKnownThrougInput()
{
    console.log(event.target.value);
    if(event.target.value == 'اخرى') {
        $('input#knownThroughText').show();
    } else {
        $('input#knownThroughText').val("");
        $('input#knownThroughText').hide();
    }
}

$('input#savereq').click(function(e)
{
    var totalCabientWidth = parseInt($('input[name=cabient_width]').val(), 10);
    var totalDoorWidth = parseInt($('input[name=cabient_door_width]').val(), 10);
    var totalDoorLeftWidth = parseInt($('input[name=cabient_door_from_left]').val(), 10);
    var totalDoorRightWidth = parseInt($('input[name=cabient_door_from_right]').val(), 10);
    if(totalCabientWidth === (totalDoorWidth + totalDoorLeftWidth + totalDoorRightWidth)) {
        return true;
    } else {
        e.preventDefault();
        alert('عفو يجب ان يكون عرض الكابينة مساوي لعرض الباب و المسافة من اليمين و اليسار');
    }
});

$('a.new_client').click(function(evt)
{
    evt.preventDefault();
    var location = 'http://' + window.location.hostname;
    window.popup = window.open(location + $(this).attr('href'), 'Clients', 'width=740, height=400');
});

window.addEventListener("orientationchange", function() {
    if(window.orientation == 0) {
        $('.dataTables_wrapper .dataTables_filter input').width(200);
        $('div.headerNav ul li ul').width(220);
        $('div.block.login').width(320);
        $('div.contentBox ul.dashboard_controls li a:link, div.contentBox ul.dashboard_controls li a:visited').css(
        {
            padding: '10px',
            fontSize: '0.7em',
            width: 80,
            height: 60
        });
    } else {
        $('.dataTables_wrapper .dataTables_filter input').width(350);
        $('div.headerNav ul li ul').width(320);
        $('div.block.login').width(400);
        $('div.contentBox ul.dashboard_controls li a:link, div.contentBox ul.dashboard_controls li a:visited').css(
            {
                padding: '20px',
                fontSize: '0.8em',
                width: 100,
                height: 70
            });
    }
}, false);

function compare(evt) {
    var startDt = document.getElementById("startDate").value;
    var endDt = document.getElementById("dueDate").value;
    console.log( (new Date(startDt).getTime() < new Date(endDt).getTime()));
    if( (new Date(startDt).getTime() > new Date(endDt).getTime()))
    {
        alert('عفوا يجب ان يكون تاريخ البداية اقل من تاريخ النهاية');
        evt.preventDefault();
    }
    return true;
}