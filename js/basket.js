let basketContainer = document
  .getElementsByClassName("basket-container")
  .item(0);
document.getElementById("btn-basket").onclick = () => {
  basketContainer.setAttribute("class", "basket-container show");
};
document.getElementsByClassName("close-basket").item(0).onclick = () => {
  basketContainer.setAttribute("class", "basket-container");
  basketContainer.style.zIndex = 100000000;
};
renderCart();

$("#submit-order").click(() => {
  hideCart();
  $("#modal-oder").modal();
});

function renderCart() {
  $.get("/services/fill-basket.php", (data, status) => {
    $(".basket-body").html(data);
  });
}

function showCart() {
  basketContainer.setAttribute("class", "basket-container show");
}

function hideCart() {
  basketContainer.setAttribute("class", "basket-container");
}

function deleteItem(idItem) {
  $.post(
    "/shop/api/remove_item.php",
    {
      id_item: idItem,
    },
    (data, status) => {
      if (status == "success") {
        $.notify(
          {
            icon: "fas fa fa-bell",
            message: "Borrado",
          },
          {
            type: "success",
            timer: 50,
          }
        );
        renderCart();
      }
    }
  );
}

function subtractQty(id) {
  let num = $.number($(`#qty${id}`).html(), 0, "", "");
  console.log(num);
  $.post(
    "/shop/api/change_quantity.php",
    {
      id_item: id,
      quantity: parseInt(num) - 1,
    },
    (data, status) => {
      if (status == "success") {
        renderCart();
      }
    }
  );
}

function sumQty(id) {
  let num = $.number($(`#qty${id}`).html(), 0, "", "");
  $.post(
    "/shop/api/change_quantity.php",
    {
      id_item: id,
      quantity: parseInt(num) + 1,
    },
    (data, status) => {
      if (status == "success") {
        renderCart();
      }
    }
  );
}

function changeQuantity(id) {
  let num = $.number($(`#${id}`).html(), 0, "", "");
  $.post(
    "/shop/api/change_quantity.php",
    {
      id_item: id.replace("qty", ""),
      quantity: parseInt(num),
    },
    (data, status) => {
      if (status == "success") {
        renderCart();
      }
    }
  );
}

function cleanCart() {
  $.get("/services/clean_basket.php", (data, status) => {
    //console.log("cleaned");
  });
}
