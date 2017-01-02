/**
 * Training JavaScript Document
 */

$(document).ready(function() 
{
    var location = 'http://' + window.location.hostname;
    var ajaxActionToCall = location + window.location.pathname + 'ajax';
	$('table').DataTable(
        {
            "aaSorting": [],
            "stateSave": true
        }
    );
});
