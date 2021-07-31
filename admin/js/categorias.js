$(".sidebar div.sidebar-wrapper ul.nav li:first").removeClass("active");
$("#text-item").addClass("active");

let $table;
let id = "";
const selectOptions = new Map();

$(document).ready(function () {
  $("tr td:last-child").addClass("text-center");
  $table = $("#dataTable").DataTable({
    language: {
      sProcessing: "Procesando...",
      sLengthMenu: "Mostrar _MENU_ registros",
      sZeroRecords: "No se encontraron resultados",
      sEmptyTable: "Ningún dato disponible en esta tabla",
      sInfo:
        "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
      sInfoEmpty: "Mostrando registros del 0 al 0 de un total de 0 registros",
      sInfoFiltered: "(filtrado de un total de _MAX_ registros)",
      sInfoPostFix: "",
      sSearch: "Buscar:",
      sUrl: "",
      sInfoThousands: ",",
      sLoadingRecords: "Cargando...",
      oPaginate: {
        sFirst: "Primero",
        sLast: "Último",
        sNext: "Siguiente",
        sPrevious: "Anterior",
      },
      oAria: {
        sSortAscending:
          ": Activar para ordenar la columna de manera ascendente",
        sSortDescending:
          ": Activar para ordenar la columna de manera descendente",
      },
    },
    ajax: "api/get_categories.php",
    columnDefs: [
      {
        targets: -1,
        render: function (data, type, row) {
          $("tr td:last-child").addClass("text-center");
          $("td img").parent().addClass("text-center");
          $("td.sorting_1").addClass("text-capitalize");
          return `<a class="text-center" href="javascript:deleteCategory(${data})"><i class="fas fa-trash-alt"></i></a>`;
        },
      },
      {
        targets: 3,
        render: function (data, type, row) {
          $("tr td:nth-child(4)").addClass("text-center");
          $("td img").parent().addClass("text-center");
          $("td.sorting_1").addClass("text-capitalize");
          return `<a class="text-center" href="javascript:modalEdit('${row.name}',${row.id},'${row.description}','${row.image}')"><i class='fas fa-pen'></i></a>`;
        },
      },
      {
        targets: 1,
        render: function (data, type, row) {
          $("td img").parent().addClass("text-center");
          $("td.sorting_1").addClass("text-capitalize");
          return `<img width="120" class="text-center" src="${row.image}">`;
        },
      },
      {
        targets: 2,
        render: function (data, type, row) {
          return `<span class="text-uppercase">${row.description}</span>`;
        },
      },
    ],
    columns: [
      { data: "name" },
      { data: "image" },
      { data: "description" },
      { data: "id" },
      { data: "id" },
    ],
  });
});

$("td img").parent().addClass("text-center");

let categoryId;

function modalEdit(nameCategory, idCategory, description, image) {
  //console.log(image);
  $("#modalEdit").modal();
  $("#nameCategoryLoad").text(nameCategory);
  $("#descriptionCategoryInput").val(description);
  $("#imageCategory").attr("src", image);
  document.getElementById("subcat-listM").innerHTML = "";
  subcatCountE = 0;
  categoryId = idCategory;
  //document.getElementById("select-subcategories").innerHTML = "";
  loadSubcategories(idCategory);
}

/* CARGA SUBCATEGORIAS */

const loadSubcategories = (idCategory) => {
  $.post(
    "api/get_subcategories.php",
    idCategory,
    function (data, textStatus, jqXHR) {
      let j = 0;
      $(".subcategorias").remove();
      $(".deleteSubCategorie").remove();
      array = [];
      for (let i = 0; i < data.data.length; i++) {
        if (data.data[i]["parentCategory"] == idCategory) {
          array = data.data[i]["name"];
          $("#subcategories").append(
            `<div class="mr-5 subcategorias">
                <label for="">Subcategoría ${++j}</label>
                <input type="text" class="form-control" placeholder="nombre" id="${
                  data.data[i]["id"]
                }" value="${array}">
                <button class="btn btn-danger deleteSubCategorie" title="Eliminar Subcategoria" id="${
                  data.data[i]["id"]
                }" onclick="deleteCategory(this.id);"><i class="fas fa-trash"></i></button>
                <button class="btn btn-info cambiarImagenSubCategorie" title="Cambiar Imagen" id="${
                  data.data[i]["id"]
                }" onclick="changeImageSubCategories(${data.data[i]["id"]});"><i class="far fa-images"></i></button>
            </div>`
          );
        }
      }
    }
  );
};

function changeImageSubCategories(id) {
  categoryId = id;
  changeImage();
}

$("#buttonSubmitUpdate").click(() => {
  if (flagImage) {
    if (myDropzone.getAcceptedFiles().length > 0) {
      response = JSON.parse(myDropzone.getAcceptedFiles()[0].xhr.responseText);
      link = response.link;
      ajax(link, categoryId);
    } else {
      $.notify(
        {
          message: "Por favor Suba una Imagen",
          title: "Exito",
          icon: "notification_important",
        },
        { type: "warning" }
      );
    }
  } else {
    ajax($("#imageCategory").attr("src"), categoryId);
  }
});

function modalCreate() {
  if (myDropzone) {
    myDropzone.removeAllFiles(true);
  }
  if (subcatCount) {
    subcatCount = 0;
  }
  (document.getElementById("categoryInput").value = ""),
    (document.getElementById("descriptionCategoryInputC").value = ""),
    $("#imageCategoryC").attr("src", "");
  document.getElementById("subcat-list").innerHTML = "";

  $("#modalCreate").modal();

  (document.getElementById("categoryInput").value = ""),
    $("#descriptionCategoryInputC").val("");
  $("#imageCategoryC").attr("src", "");
}

/* EVENTO QUE MANEJA LA CREACIÓN DE UNA CATEGORÍA */

document
  .getElementById("buttonSubmitCreate")
  .addEventListener("click", (ev) => {
    if (flagImage) {
      if (myDropzone.getAcceptedFiles().length > 0) {
        response = JSON.parse(
          myDropzone.getAcceptedFiles()[0].xhr.responseText
        );
        link = response.link;
        createRequest(link);
      } else {
        $.notify(
          {
            message: "Por favor Suba una Imagen",
            icon: "notification_important",
          },
          { type: "warning" }
        );
      }
    } else {
    }
  });

/* EVENTO QUE MANEJA LA CREACIÓN DE UNA SUBCATEGORÍA */

document
  .getElementById("buttonSubmitCreateS")
  .addEventListener("click", (ev) => {
    if (flagImage) {
      if (myDropzone.getAcceptedFiles().length > 0) {
        response = JSON.parse(
          myDropzone.getAcceptedFiles()[0].xhr.responseText
        );
        link = response.link;
        createSubcategory(link);
      } else {
        $.notify(
          {
            message: "Por favor Suba una Imagen",
            title: "Exito",
            icon: "notification_important",
          },
          { type: "warning" }
        );
      }
    } else {
    }
  });

/* Función que ejecuta un modal cuando se desea crear una subcategoría */
function subcategoriaModal(category) {
  $("#modalSubcategoria").modal();
  document.getElementById("nameCategoryS").textContent = category.name;
  document.getElementById("nameCategoryS").dataset.id = category.id;
}

/*    document.getElementById('select-categories').addEventListener('click', ev => {
         const targetEl = ev.target;
          if(targetEl.tagName === 'SELECT' || targetEl === ev.currentTarget[0] ) return;
          subcategoriaModal({id: targetEl.value, name: targetEl.textContent});
       });
 */

/* Agrega cuantas categorias el usuario desee */
let subcatCount = 0;
document
  .querySelector("#subcategoriesC button")
  .addEventListener("click", (ev) => {
    const subCatList =
      ev.target.closest("#subcategoriesC").lastElementChild.firstElementChild;

    if (subCatList.style.display !== "grid") {
      subCatList.style.display = "grid";
      subCatList.style.gridTemplateColumns = "1fr 1fr 1fr";
    }

    subCatList.insertAdjacentHTML(
      "beforeend",
      `<li class="list-group-item">
            <label for="">Subcategoría ${++subcatCount}</label>
            <input type="text" class="form-control" placeholder="nombre">
        </li>`
    );
  });

/*Editar categoría Agrega cuantas categorias el usuario desee */

let subcatCountE = 0;

document
  .querySelector("#subcategoriesE button")
  .addEventListener("click", (ev) => {
    const subCatList =
      ev.target.closest("#subcategoriesE").lastElementChild.firstElementChild;

    if (subCatList.style.display !== "grid") {
      subCatList.style.display = "grid";
      subCatList.style.gridTemplateColumns = "1fr 1fr";
    }

    subCatList.insertAdjacentHTML(
      "beforeend",
      `<li class="list-group-item">
            <label for="">Subcategoría ${++subcatCountE}</label>
            <input type="text" class="form-control" placeholder="nombre">
          </li>`
    );
  });

/* Eliminar Categoria */

function deleteCategory(id) {
  $.post("api/delete_category.php", { idCategory: id }, (data, status, xhr) => {
    if (status == "success") {
      $("#modalCreate").modal("hide");
      $("#modalEdit").modal("hide");
      $.notify(
        {
          message: "Se ha eliminado la categoría",
          icon: "notification_important",
        },
        { type: "success" }
      );
      $table.ajax.reload();
    } else {
      $("#modalCreate").modal("hide");
      $.notify(
        {
          message: "No se ha eliminado la categoría",
          icon: "notification_important",
        },
        { type: "warning" }
      );
    }
  }).fail((err) => {
    if (err.status === 500) {
      $("#modalCreate").modal("hide");
      $.notify(
        {
          message: "Es posible que esta categoría tenga registros asociados",
          icon: "notification_important",
        },
        { type: "danger" }
      );
    }
  });
}

let flagImage = false;
let myDropzone;

function changeImage() {
  flagImage = true;
  $("#containerImageCategory").fadeOut();
  $("#myId").addClass("dropzone");
  $("#imgUpload").fadeIn();
  myDropzone = new Dropzone("div#myId", {
    url: "/admin/upload.php",
    method: "post",
    paramName: "photo",
    maxFiles: 1,
    acceptedFiles: "image/*",
    dictDefaultMessage:
      "Sube tus archivos, arrastralos o haz click para buscarlos",
    dictMaxFilesExceeded: "Solo se permite subir una imagen",
    dictInvalidFileType: "Solo se permite imagenes",
  });
}

function putImage(typeLetter) {
  flagImage = true;
  $(`#containerImageCategory${typeLetter}`).fadeOut();
  $(`#myId${typeLetter}`).addClass("dropzone");
  $(`#imgUpload${typeLetter}`).fadeIn();
  myDropzone = new Dropzone(`div#myId${typeLetter}`, {
    url: "/admin/upload.php",
    method: "post",
    paramName: "photo",
    maxFiles: 1,
    acceptedFiles: "image/*",
    dictDefaultMessage:
      "Sube tus archivos, arrastralos o haz click para buscarlos",
    dictMaxFilesExceeded: "Solo se permite subir una imagen",
    dictInvalidFileType: "Solo se permite imagenes",
  });
}

function ajax(link, idCategory) {
  const subcatValues = Array.from(
    document.getElementById("subcategoriesE").querySelectorAll("input")
  )
    .map((input) => input.value.trim().toLowerCase())
    .filter((value) => value !== "");

  $.post(
    "api/update_category.php",
    {id: idCategory, description: $("#descriptionCategoryInput").val(), image: link, subcategories: subcatValues},
    (data, status) => {
      if (status == "success") {
        $("#modalEdit").modal("hide");
        $.notify(
          {
            message: "Se ha actualizado la categoría",
            title: "Exito",
            icon: "notification_important",
          },
          { type: "success" }
        );
        //console.log($table)
        $table.ajax.reload();
      } else {
        $("#modalEdit").modal("hide");
        $.notify(
          {
            message: "No se ha actualizado la categoría",
            icon: "notification_important",
          },
          { type: "warning" }
        );
      }
    }
  ).always(() => {
    document.getElementById("subcat-listM").innerHTML = "";
  });
}

function createRequest(linkImage) {
  const subcatValues = Array.from(
    document.getElementById("subcategoriesC").querySelectorAll("input")
  )
    .map((input) => input.value.trim().toLowerCase())
    .filter((value) => value !== "");

  const categoryInfo = {
    nameCategory: document.getElementById("categoryInput").value,
    description: $("#descriptionCategoryInputC").val(),
    image: linkImage,
  };

  if (subcatValues.length !== 0) {
    categoryInfo.categories = subcatValues;
  }

  $.post("api/create_category.php", categoryInfo, (data, status, xhr) => {
    if (status == "success") {
      $("#modalCreate").modal("hide");
      $.notify(
        {
          message: "Se ha creado la categoría",
          icon: "notification_important",
        },
        { type: "success" }
      );
      $table.ajax.reload();
    } else {
      $("#modalCreate").modal("hide");
      $.notify(
        {
          message: "No se ha creado la categoría",
          icon: "notification_important",
        },
        { type: "warning" }
      );
    }
  })
    .fail((err) => {
      if (err.status === 303) {
        $("#modalCreate").modal("hide");
        $.notify(
          {
            message: "Ya existe una categoría con este nombre",
            icon: "notification_important",
          },
          { type: "danger" }
        );
      }
    })
    .always(() => {
      if (myDropzone) {
        myDropzone.removeAllFiles(true);
      }
      (document.getElementById("categoryInput").value = ""),
        (document.getElementById("descriptionCategoryInputC").value = ""),
        $("#imageCategoryC").attr("src", "");
      /*    document.getElementById('myIdC').classList.remove('dropzone'); */
      /*  $('#myIdC').addClass('dropzone') */
    });
}

function createSubcategory(linkImage) {
  const subcategoryInfo = {
    nameSubcategory: document
      .getElementById("subcategoryInput")
      .value.trim()
      .toLowerCase(),
    description: $("#descriptionSubcategoryInput").val(),
    image: linkImage,
    idCategory: document.getElementById("nameCategoryS").dataset.id,
  };

  $.post("api/create_subcategory.php", subcategoryInfo, (data, status, xhr) => {
    if (status == "success") {
      $("#modalSubcategoria").modal("hide");
      $.notify(
        {
          message: "Se ha creado la subcategoría",
          icon: "notification_important",
        },
        { type: "success" }
      );
      $table.ajax.reload();
    } else {
      $("#modalSubcategoria").modal("hide");
      $.notify(
        {
          message: "No se ha creado la subcategoría",
          icon: "notification_important",
        },
        { type: "warning" }
      );
    }
  })
    .fail((err) => {
      if (err.status === 303) {
        $("#modalCreate").modal("hide");
        $.notify(
          {
            message:
              "Ya existe una subcategoría con este nombre para esta categoría",
            icon: "notification_important",
          },
          { type: "danger" }
        );
      }
    })
    .always(() => {
      if (myDropzone) {
        myDropzone.removeAllFiles(true);
      }
      (document.getElementById("subcategoryInput").value = ""),
        (document.getElementById("descriptionSubcategoryInput").value = ""),
        $("#imageCategoryS").attr("src", "");
    });
}
