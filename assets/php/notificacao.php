<?php
//fara a conexao com banco de dados
include_once 'conexao.php';

//chama a cache, para verificar o cache se esta logado iso-8859-1
include_once 'cache.php';

?>

<!-- <div class="modal fade" id="Modalnoti" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true"> -->
  <div id="testeDeus" class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
          <i class="material-icons">clear</i>
        </button>
        <h4 class="modal-title">Notificações</h4>
      </div>
      <div id="mb-noti" class="modal-body mb-noti">

      </div>
<!--      <div class="modal-footer mf-noti">
        <a href="#"><p class="text-center">Ver tudo</p></a>
      </div> -->
    </div>
  </div>
<!-- </div> -->

        <script type="text/javascript">
            var start = 0;
            var limit = 5;
            var reachedMax = false;

            $(".mb-noti").scroll(function () {
            var trueDivHeight = $('.mb-noti')[0].scrollHeight;
            var divHeight = $('.mb-noti').height();
            var scrollLeft = trueDivHeight - divHeight;
                if ($(this).scrollTop() >= ( (trueDivHeight - divHeight) - 40 ) )
                    //alert("Por Favor, funciona pai.. :" + (trueDivHeight - divHeight) );
                    getData();
            });

            $(document).ready(function () {
               getData();
            });

            function getData() {
                if (reachedMax)
                    return;

                $.ajax({
                   url: 'assets/php/resultnoti.php',
                   method: 'POST',
                   data: {
                       getData: 1,
                       start: start,
                       limit: limit
                   },
                   success: function(response) {
                        if (response == "reachedMax")
                            reachedMax = true;
                        else {
                            start += limit;
                            $("#mb-noti").append(response);
                        }
                    }
                });
            }            
        </script>