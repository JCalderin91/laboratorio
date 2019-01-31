jQuery(function ($) {

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

   
});


function copiar(id_elemento) {
  alert(id_elemento)
  var aux = document.createElement("input");
  aux.setAttribute("value", document.getElementById(id_elemento).innerHTML);
  document.body.appendChild(aux);
  aux.select();
  document.execCommand("copy");
  document.body.removeChild(aux);
}
   

$('input.daterange').daterangepicker({
          autoUpdateInput: false,
          locale: {
            "format": "DD/MM/YYYY",
            "separator": " / ",
            "applyLabel": "Aceptar",
            "cancelLabel": "Cancelar",
            "fromLabel": "De",
            "toLabel": "hasta",
            "customRangeLabel": "Personalizar",
            "weekLabel": "W",
            "daysOfWeek": [
              "Dom",
              "Lun",
              "Mar",
              "Mie",
              "Jue",
              "Vie",
              "Sab"
            ],
            "monthNames": [
              "Enero",
              "Febrero",
              "Marzo",
              "Abril",
              "Mayo",
              "Junio",
              "Julio",
              "Augosto",
              "Septiembre",
              "Octubre",
              "Noviembre",
              "Diciembre"
            ],
            "firstDay": 0
          }
        });
      
        $('input.daterange').on('apply.daterangepicker', function (ev, picker) {
          $(this).val(picker.startDate.format('DD/MM/YYYY') + '-' + picker.endDate.format('DD/MM/YYYY'));
        });