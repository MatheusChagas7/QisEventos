function visuNoti(xn,idn,id_usun){var noti=document.getElementById('ni-'+xn);var mb=document.getElementById('mb-'+xn);noti.innerHTML="remove_red_eye";noti.style.color='#ccc';mb.style.backgroundColor='#fff';nant_v_antes=$('.n-notification').html();nant_visu=nant_v_antes-1;$.ajax({type:"POST",url:"assets/php/visualizei.php",data:'id='+idn+'&id_usu='+id_usun,success:(function(){$('.n-notification').html(nant_visu);changeTitle()})})}
function exNoti(xnx,idnx,id_usunx){var mb=document.getElementById('mb-'+xnx);$.ajax({type:"POST",url:"assets/php/excluiNoti.php",data:'id='+idnx+'&id_usu='+id_usunx,success:mb.style.display='none'})}
$(document).ready(function(){pegaantes();changeTitle();setInterval(pegaantes,700);setInterval(changeTitle,900);auto_load();$('.n-notification-a').click(function(){auto_load()})});var nant="";var title=document.title;var nnoti=$('.n-notification');function changeTitle(){$.get("../assets/php/busca_n.php",function(resultado){if(resultado==""){var newTitle=''+title;document.title=newTitle;if(nnoti.length){document.getElementById("n-notification").style.display="none";document.getElementById("n-notification2").style.display="none"}}else{var newTitle='('+resultado+') '+title;document.title=newTitle;if(nnoti.length){document.getElementById("n-notification").style.display="inline";document.getElementById("n-notification2").style.display="inline"}
$('.n-notification').html(resultado);nagora=resultado;if((nagora>nant)&&(nagora!=0)&&(nagora!=nant)){var audio=new Audio('assets/js/src/notification.mp3');audio.play();$('#alert-notification').css({display:"block"})}}})}
function pegaantes(){nant=$('.n-notification').html()}
function auto_load(){$.ajax({url:"assets/php/notificacao.php",success:function(data){$("#Modalnoti").html(data)}})}