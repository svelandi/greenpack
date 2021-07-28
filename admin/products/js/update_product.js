jQuery.event.special.touchstart = {
  setup: function (_, ns, handle) {
    this.addEventListener("touchstart", handle, {
      passive: !ns.includes("noPreventDefault"),
    });
  },
};
jQuery.event.special.touchmove = {
  setup: function (_, ns, handle) {
    this.addEventListener("touchmove", handle, {
      passive: !ns.includes("noPreventDefault"),
    });
  },
};

jQuery.event.special.wheel = {
  setup: function (_, ns, handle) {
    this.addEventListener("wheel", handle, {
      passive: !ns.includes("noPreventDefault"),
    });
  },
};

if (parseInt($("#category").val()) == 6) {
  $(".length").css("display", "none");
  $(".window").css("display", "none");
}

$(() => {
  $(".sidebar div.sidebar-wrapper ul.nav li:first").removeClass("active");
  $("#product-item").addClass("active");
  $(".imagen").height($(".imagen").parent().height());
  $(".imagen").width($(".imagen").parent().width());
  $(".imagen .info").height($(".imagen").parent().height());
  $(".imagen div.info").width($(".imagen").parent().width());
});

/* validacion valores cantidades a vender */

$("#e1_max").focusout(function (e) {
  e1min = $("#e1_min").val();
  e1max = $("#e1_max").val();

  e.preventDefault();
  if (e1max <= e1min) {
    $.notify(
      {
        message: "La cantidad máxima no debe ser menor a la mínima en E1",
        icon: "fas fa-check-circle",
      },
      {
        type: "danger",
      }
    );
    return false;
  }
});

$("#e2_min").focusout(function (e) {
  e1max = $("#e1_max").val();
  e2min = $("#e2_min").val();

  e.preventDefault();
  if (e2min <= e1max) {
    $.notify(
      {
        message:
          "La cantidad máxima en E1 no debe ser menor a la mínima en E2",
        icon: "fas fa-check-circle",
      },
      {
        type: "danger",
      }
    );
    return false;
  }
});

$("#e2_max").focusout(function (e) {
  e2min = $("#e2_min").val();
  e2max = $("#e2_max").val();

  e.preventDefault();
  if (e2max <= e2min) {
    $.notify(
      {
        message: "La cantidad máxima no debe ser menor a la mínima en E2",
        icon: "fas fa-check-circle",
      },
      {
        type: "danger",
      }
    );
    return false;
  }
});

$("#e3_min").focusout(function (e) {
  e2max = $("#e2_max").val();
  e3min = $("#e3_min").val();

  e.preventDefault();
  if (e3min <= e2max) {
    $.notify(
      {
        message:
          "La cantidad máxima en E2 no debe ser mayor o igual a la mínima en E3",
        icon: "fas fa-check-circle",
      },
      {
        type: "danger",
      }
    );
    return false;
  }
});

$("#e3_max").focusout(function (e) {
  e2max = $("#e2_max").val();
  e3min = $("#e3_min").val();

  e.preventDefault();
  if (e3min <= e2max) {
    $.notify(
      {
        message:
          "La cantidad mínima en E3 no puede ser menor a la máxima en E2",
        icon: "fas fa-check-circle",
      },
      {
        type: "danger",
      }
    );
    return false;
  }
});
