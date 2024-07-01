
function search(element, body, needle) {
    var search_text = element.val();
    body.find('tr').each(function () {
        if ($(this).find(needle).text().toUpperCase().indexOf(search_text.toUpperCase()) != -1) {
            $(this).show();
        } else {
            $(this).hide();
        }
    })
}
