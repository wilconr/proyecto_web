$('#Departamento').change(function()
{
  $.post('ajax_muni.php',
  {
    departamento:$('#Departamento').val(),

    beforeSend: function()
    {
      $('.resultadoDep').html("Espere un momento por favor...");
    }
  }, function(respuesta)
  {
    $('.resultadoDep').html(respuesta);
  });
});
