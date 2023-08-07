    // funcao para visualizar
    function visuNoti(xn,idn,id_usun) {
    var noti = document.getElementById('ni-'+xn);
    var mb = document.getElementById('mb-'+xn);
    noti.innerHTML = "remove_red_eye";
    noti.style.color = '#ccc';
    mb.style.backgroundColor = '#fff';
    nant_v_antes = $('.n-notification').html();
    nant_visu = nant_v_antes - 1;
    // btn.setAttribute('onclick', 'removeFav('+x+','+id+','+id_usu+');'); $('.n-notification').html(nant_visu - 1)

    // após add no front, usar ajax ou outro qualquer para acessar codigo php e add ao usuario no banco
      $.ajax({
      type: "POST",
      url: "assets/php/visualizei.php",
      data: 'id='+idn+'&id_usu='+id_usun,
      success: (function(){ 
        $('.n-notification').html(nant_visu);
        changeTitle();
        })
      });
    }
    // funcao para excluir
    function exNoti(xnx,idnx,id_usunx) {
    var mb = document.getElementById('mb-'+xnx);
    // btn.setAttribute('onclick', 'removeFav('+x+','+id+','+id_usu+');');

    // após add no front, usar ajax ou outro qualquer para acessar codigo php e add ao usuario no banco
      $.ajax({
      type: "POST",
      url: "assets/php/excluiNoti.php",
      data: 'id='+idnx+'&id_usu='+id_usunx,
      success:  mb.style.display = 'none'
      });
    }

/* EXECUTA AS FUNÇÔES NECESSÁRIAS */
$(document).ready(function() {
  pegaantes();
  changeTitle();
  // atualiza();
// setInterval('atualiza()', 5000);  
setInterval(pegaantes, 700);
setInterval(changeTitle, 900);

auto_load(); //Call auto_load() function when DOM is Ready
//Refresh auto_load() function after 10000 milliseconds
// setInterval(auto_load,3000); 

$('.n-notification-a').click(function(){ 
  auto_load(); 
});

});

//var vazia, para armazenar o resultado 
var nant = "";
// nagora = "";
var title = document.title;
var nnoti = $('.n-notification');

/* FUNÇÃO ATUALIZA QUE BUSCA A PÁGINA BUSCA_N PARA IMPRIMIR NA CLASS NOTIFICAÇÃO */

// function atualiza(){
    
//   $.get("../assets/php/busca_n.php", function(resultado){

//     if(resultado == ""){
//         $('.n-notification').html(resultado);

//     }else{
//         $('.n-notification').html(resultado);
        
// 	// nagora = resultado;
	
//         // if (nagora > nant){
//         // $('#alert-notification').css({ display: "block" });
//         // }else{
//         // $('#alert-notification').css({ display: "none" });
//         // }

//     }

//   })  

// /* FUNÇÃO E TEMPO DE ATUALIZAÇÃO DA ID NOTIFICAÇÃO */
//   // setInterval('atualiza()', 5000);
  
// }

/* FUNÇÃO PARA O TITULO */
  
  function changeTitle() {
    $.get("../assets/php/busca_n.php", function(resultado){
    if (resultado == "") {
    var newTitle = ''+ title;
     document.title = newTitle;

     if( nnoti.length ){
     document.getElementById("n-notification").style.display = "none";
     document.getElementById("n-notification2").style.display = "none";
     }

    }else{
    var newTitle = '(' + resultado + ') ' + title;
    document.title = newTitle;
    if( nnoti.length ){
    document.getElementById("n-notification").style.display = "inline";
    document.getElementById("n-notification2").style.display = "inline";
    }
    $('.n-notification').html(resultado);

    nagora = resultado;
    if ( (nagora > nant) && (nagora != 0) && (nagora != nant) ){
    var audio = new Audio('assets/js/src/notification.mp3');
    audio.play();
    $('#alert-notification').css({ display: "block" });
    }

    }

  })
}

// function newUpdate() {
//     update = setInterval(changeTitle, 5000);
// }
// var docBody = document.getElementById('b_n');
// docBody.onload = newUpdate;

/* FUNÇÃO PARA PEGAR O NUMERO ANTES DE ATUALIZAR */

function pegaantes() {
nant = $('.n-notification').html();

// alert("antes: " + nant);

}
function auto_load(){
        $.ajax({
          url: "assets/php/notificacao.php",
          success: function(data){
             $("#Modalnoti").html(data);
          } 
        });
}