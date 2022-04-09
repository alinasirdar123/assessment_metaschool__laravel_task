
/* page loader */
$(window).on('load', function () {
    $("#main-body").removeClass('invisible');
    $("#spinner").fadeOut('fast');
});

/* change password */
$(document).ready(function () {
    $('#change-password-form').validator();
    $("#change-password-form").ajaxForm({
        success: function (res, status, xhr, form) {
            $("#change-password-modal").modal('hide');
            location.reload(true);
        }
    });
});

$(document).ready(function () {

    $(".sidebar-dropdown > a").click(function() {
      $(".sidebar-submenu").slideUp(200);
      if (
        $(this)
          .parent()
          .hasClass("active")
      ) {
        $(".sidebar-dropdown").removeClass("active");
        $(this)
          .parent()
          .removeClass("active");
      } else {
        $(".sidebar-dropdown").removeClass("active");
        $(this)
          .next(".sidebar-submenu")
          .slideDown(200);
        $(this)
          .parent()
          .addClass("active");
      }
    });

    $("#close-sidebar").click(function() {
      $(".page-wrapper").removeClass("toggled");
    });

    $("#show-sidebar").click(function() {
      $(".page-wrapper").addClass("toggled");
    });

    /* global loader for all ajax calls */
    $(document).bind("ajaxStart", function () {
        $("#overlay-body").fadeIn('fast');
        $("#spinner").fadeIn('fast');
    }).bind("ajaxSend", function () {
        $("#overlay-body").fadeIn('fast');
        $("#spinner").fadeIn('fast');
    }).bind("ajaxStop", function () {
        $("#overlay-body").fadeOut('fast');
        $("#spinner").fadeOut('fast');
    }).bind("ajaxComplete", function () {
        $("#overlay-body").fadeOut('fast');
        $("#spinner").fadeOut('fast');
    }).bind("ajaxError", function () {
        $("#overlay-body").fadeOut('fast');
        $("#spinner").fadeOut('fast');
    });


    /* CSRF tokens to validate every ajax request */
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });




});
