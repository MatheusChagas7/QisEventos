
// slide para baixo, menu, botao buscar
function scrollToAnchor(aid){
    var aTag = $("a[name='"+ aid +"']");
    $('html,body').animate({scrollTop: aTag.offset().top},'slow');
}

$("#btn-menu").click(function() {
   scrollToAnchor('buscar');
});

// slide para baixo, saiba mais, em contato
function scrollToAnchor(aid){
    var aTag = $("a[name='"+ aid +"']");
    $('html,body').animate({scrollTop: aTag.offset().top},'slow');
}

$("#btn-us").click(function() {
   scrollToAnchor('nos');
});

// slide para baixo, perfil,seguindo
function scrollToAnchor(aid){
    var aTag = $("a[name='"+ aid +"']");
    $('html,body').animate({scrollTop: aTag.offset().top},'slow');
}

$("#seguindo").click(function() {
   scrollToAnchor('seguindo');
});


$(function() {
  setTimeout(function(){
    $('li[data-img-src]').each(function(){
      var src = $(this).attr('data-img-src');
      $('<img>').attr('src', src).appendTo('ul');
    });
  }, 600);
});

$(document).ready(function() {

setInterval(taaberto, 10000);

});

// fechar a notificacao em primeiro plano
function fechar() {
  document.getElementById("alert-notification").style.display = "none";
}
// verifica se o alert de notificacao ta aberto
function taaberto() {
  if (document.getElementById("alert-notification").style.display = "block") {
    fechar();
  }
}