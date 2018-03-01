  </main>
  <script src="../js/jquery-3.3.1.min.js"></script>
  <script src="../js/materialize.min.js"></script>
  <script src="../js/sweetalert2.min.js"></script>
  <script>

    $('#Buscar').keyup(function(event)
    {
      var contenido = new RegExp($(this).val(),'i');
      $('tr').hide();
      $('tr').filter(function()
      {
        return contenido.test($(this).text());
      }).show();
      $('.cabecera').attr('style','');
    });

    $('.button-collpase').sideNav();
    $('select').material_select();
    $('.datepicker').pickadate({
      format: 'yyyy-m-d',
      selectMonths: true, // Creates a dropdown to control month
      selectYears: 15, // Creates a dropdown of 15 years to control year,
      today: 'Hoy',
      clear: 'Limpiar',
      close: 'Ok',
      closeOnSelect: false // Close upon selecting a date,
    });

    function may(obj, id)
    {
        obj = obj.toUpperCase();
        document.getElementById(id).value = obj;
    }

  </script>
