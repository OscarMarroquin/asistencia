
function BuscaGrupo(llaveabuscar){
  var url = 'Configuracion/AjaxDibujaGrupo.php';
  var pars = ("llaveabuscar=" + llaveabuscar);
  var myAjax = new Ajax.Updater( 'AjaxDibujaGrupo', url, { method: 'get', parameters: pars});
}
function BuscaMaterias(llaveabuscar){
  var url = 'Configuracion/AjaxDibujaMateria.php';
  var pars = ("llaveabuscar=" + llaveabuscar);
  var myAjax = new Ajax.Updater( 'AjaxDibujaMaterias', url, { method: 'get', parameters: pars});
}


