function iformat(icon) 
{
    var originalOption = icon.element;
    return $('<span><i class="fa ' + $(originalOption).data('icon') + '"></i> ' + icon.text + '</span>');
}
$('#icons').select2({
    width: "100%",
    templateSelection: iformat,
    templateResult: iformat,
    allowHtml: true
});

$('.select2').select2({
    dropdownAutoWidth : true,
});

function modals_open(modal_id) 
{
    $("#"+modal_id).modal();
}