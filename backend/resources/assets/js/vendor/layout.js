function getCookie(name) {
    let value = "; " + document.cookie;
    let parts = value.split("; " + name + "=");
    if (parts.length == 2) return parts.pop().split(";").shift();
}


$(function() {
    let body = $('body');
    let sidebar = $('.page-sidebar');
    let sidebarMenu = $('.page-sidebar-menu');
    $(".sidebar-search", sidebar).removeClass("open");

    if (getCookie('sidebar_closed') == "1") {
        body.addClass("page-sidebar-closed");
        sidebarMenu.addClass("page-sidebar-menu-closed");
        if (body.hasClass("page-sidebar-fixed")) {
            sidebarMenu.trigger("mouseleave");
        }
    } else if (getCookie('sidebar_closed') == "0") {
        body.removeClass("page-sidebar-closed");
        sidebarMenu.removeClass("page-sidebar-menu-closed");
    }

    // handle sidebar show/hide
    body.on('click', '.sidebar-toggler', function(e) {
        let sidebar = $('.page-sidebar');
        let sidebarMenu = $('.page-sidebar-menu');
        $(".sidebar-search", sidebar).removeClass("open");

        if (body.hasClass("page-sidebar-closed")) {
            body.removeClass("page-sidebar-closed");
            sidebarMenu.removeClass("page-sidebar-menu-closed");
            document.cookie = "sidebar_closed=0"
        } else {
            body.addClass("page-sidebar-closed");
            sidebarMenu.addClass("page-sidebar-menu-closed");
            if (body.hasClass("page-sidebar-fixed")) {
                sidebarMenu.trigger("mouseleave");
            }
            document.cookie = "sidebar_closed=1"
        }
        $(window).trigger('resize');
    });

    // Get Active nav-item
    let loc = location.pathname.match(/\/(\w+)/g)[0]
    $('.nav-item a[href*="' + loc + '"]').parent().addClass('active start open')

    // Get Tab Panel Active
    if (encodeURI(location.hash)) {
        let tabid = encodeURI(location.hash.substr(1));
        $('a[href="#' + tabid + '"]').parents('.tab-pane:hidden').each(function() {
            let tabid = $(this).attr("id");
            $('a[href="#' + tabid + '"]').click();
        });
        $('a[href="#' + tabid + '"]').click();
    }
    
});