$(function () {
    $(document).tooltip();
});

(function() {
    $('a.notification').bind('click', function(evt) {
        evt.preventDefault();
        evt.stopPropagation();
        function hideNotificationPanel() {
            $('.notificationList').hide();
        }
        var notificationPanel = $(this).next();
        hideNotificationPanel();
        notificationPanel.toggle();
        notificationPanel.bind('click', function(e) {
            e.stopPropagation();
        });
        $('html').bind('click', function(evt) {
            hideNotificationPanel();
        });
    });
})();

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

$(function(){
    if (!Modernizr.inputtypes.date) {
        $('input[type=date]').datepicker({
                dateFormat : 'yy-mm-dd'
            },
            $.datepicker.regional['en']
        );
    }
});

setTimeout(function()
{
    $('div.message').fadeOut();
}, 5000);

$('div.select_checkbox a.switch').click(function (evt) {
    evt.preventDefault();
    evt.stopPropagation();
    $('div.options').not($(this).next()).slideUp();
    $(this).next().slideToggle();
});

$('div.select_checkbox, div.options').click(function(evt)
{
    evt.stopPropagation();
})

$(document).click(function()
{
    $('div.select_checkbox div.options').slideUp();
    $('a.open_controls').html('<i class="fa fa-caret-square-o-left"></i>').css({color: '#735602'});
    $('div.controls_container').hide();
    $('div.controls_container').css({top: 6});
});

// $('select').selectivity();

$('a.addProduct').click(function(evt)
{
    evt.preventDefault();
    if($('select[name=products]').val() != '') {
        $('div.products_list table').append('<tr><td>' +
            '' +
            '<p>' + $('select[name=products] option:selected').text() + '</p></td>' +
            '<td><input name="productq[]" type="number" required min="1"></td>' +
            '<td><input name="productp[]" type="number" required min="' +
            $('select[name=products] option:selected').attr('data-price') + '" value="' +
            $('select[name=products] option:selected').attr('data-price') +
            '">' +
            '<input name="productv[]" type="hidden" value="' +
            $('select[name=products]').val() + '"> <a onclick="removeProduct(this);" href="javascript:void(0);"><i class="fa fa-times"></i></a>' +
            '</td></tr>'
        );
        $('select[name=products] option:selected').remove();
    }
});

function removeProduct(t)
{
    var parent = $(t).parent().parent();
    var price = $(parent).find('input[name*=productp]').val();
    var text = $(parent).find('p').text();
    var value = $(parent).find('input[name*=productv]').val();
    $('select[name=products]').append('<option data-price="' + price + '" value="' + value + '">' + text + '</option>');
    $(parent).remove();
}

$('input.purchaseBtn').click(function(evt)
{
    if(document.querySelector('input[name*=product]') == null) {
        evt.preventDefault();
        alert('عفوا يجب عليك اختيار اصناف من القائمة و اضافتها للفاتورة')
    }
});

$('a.open_controls').click(function(evt)
{
    evt.preventDefault();
    evt.stopPropagation();
    var theLink = $(this);
    $('a.open_controls').not(theLink).html('<i class="fa fa-caret-square-o-left"></i>').css({color: '#735602'});
    if(theLink.html() == '<i class="fa fa-caret-square-o-left"></i>') {
        theLink.html('<i class="fa fa-caret-square-o-down"></i>').css({color: '#d2aa37'});;
    } else {
        theLink.html('<i class="fa fa-caret-square-o-left"></i>').css({color: '#735602'});
    }
    var $this = $(this).next('div.controls_container');
    $("div.controls_container").not($this).hide();
    $this.toggle();

    if($this.height() > ($(window).height() - (evt.clientY || evt.screenY))) {
        $this.css({top: ($this.height() - 23) * -1});
    }
});

$('div.controls_container').click(function (evt)
{
    evt.stopPropagation();
});