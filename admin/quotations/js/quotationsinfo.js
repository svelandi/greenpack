function eventChangeValuesItem(id) {
  calculateTotal(id);
  verifyDirectCost(id);
}

function verifyDirectCost(id) {
  $.get("api/calculate_cost_item.php", { id }, (data, status) => {
    let cost = parseInt(data);
    if (parseInt($(`#price${id}`).val()) < cost) {
      $(`#priceHelp${id}`)
        .html(`<div class="alert alert-danger fade show mb-0">Estas por debajo del costo del producto, el cual equivale a $${cost} <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                    </button>
                </div>`);
      $(`#priceHelp${id}`).fadeIn();
    } else {
      $(`#priceHelp${id}`).fadeOut();
    }
  });
}

function calculateTotal(id) {
  let quantity = parseInt($(`#quantity${id}`).val());
  let price = parseInt($(`#price${id}`).val());
  let total = quantity * price;
  $(`#total${id}`).html(total);
  formatMoney();
}

function formatMoney() {
  $(".money").formatCurrency({
    region: "es-CO",
  });
}

function viewPdf(id) {
  $("#load_pdf").html("");
  $("#load_pdf").append(
    `<embed src="/services/view-quotation.php?id=${id}#toolbar=0&navpanes=0&scrollbar=0&statusbar=0%zoom=20" type="application/pdf" width="100%" height="600px" />`
  );
}

function recalculate() {
  $.post(
    "api/recalculate_prices.php",
    {
      id: `<?= $_GET["id"]; ?>`,
    },
    (data, status) => {
      if (status == "success") {
        location.reload();
      }
    }
  );
}

var editor = new FroalaEditor(
  "#content",
  {
    language: "es",
    height: 300,
    imageUploadParam: "photo",
    imageUploadURL: "/admin/upload.php",
    imageUploadMethod: "POST",
    videoUploadParam: "video",
    videoUploadURL: "upload-video.php",
    imageUploadMethod: "POST",
    fileUploadParam: "file",
    fileUploadURL: "/admin/upload-file.php",
    fileUploadMethod: "POST",
    events: {
      "image.removed": function ($img) {
        img = $img[0];
        $.post(
          "/admin/image_delete.php",
          {
            src: $img.attr("src"),
          },
          (data, status) => {
            if (status != "success") {
              alert("error");
            }
          }
        );
      },
      "file.removed": function ($file) {
        file = $file[0];
        $.post(
          "/admin/file_delete.php",
          {
            src: $file.attr("src"),
          },
          (data, status) => {
            if (status != "success") {
              alert("error");
            }
          }
        );
      },
      keyup: function (keyupEvent) {
        if (document.domain != "localhost") {
          $(".fr-wrapper>div:first-child").css("visibility", "hidden");
        }
      },
    },
  },
  () => {
    editor.html.set(
      `<html>
        <body>
          <div style="text-align:center">
            <img src="https://greenpack.teenustest.com/images/greenpack_logo_verde.png" alt="Greenpack" style="width:30%">
          </div>   
          <p>Señor(a) ${$("#nameClient").val()}</p>
          <p>De acuerdo con su solicitud, adjuntamos la cotización, la cual podrá leer haciendo clic en el siguiente enlace <a href="${$('#cotiz').html()}" target="_blank"> Clic aquí</a></p>  
          <p>Cualquier inquietud que tenga estamos para servirle</p>
          <p>Cordialmente,</p>
          <b>${$("#vendedor").html()}</b><br>
          <b>${$("#email").html()}</b>
          <p><b>Greenpack S.A.S</b></p>
        </body>
       </html>`
    );
    if (document.domain != "localhost") {
      $(".fr-wrapper>div:first-child").css("visibility", "hidden");
    }
  }
);

$(".select-option-material").change(function () {
  $.post(
    "api/calculate_price_item.php",
    {
      id: $(this).attr("id"),
      material: $(this).val(),
    },
    (data, status) => {
      $(`#price${$(this).attr("id")}`).val(data);
      calculateTotal($(this).attr("id"));
    }
  );
});
