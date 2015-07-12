$(document).delegate(".modal", "dialog2.content-update", function() { 
    var e = $(this);

    var autoclose = e.find("a.auto-close");
    if (autoclose.length > 0) {
        e.find(".modal-body").dialog2("close");

        var href = autoclose.attr('href');
        if (href) {
            window.location.href = href;
        }
    }
});
