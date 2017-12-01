$('document').ready(function(){
    
  function carregaAjax(url){
      
      var $modal = $('.js-loading-bar'),
      $bar = $modal.find('.progress-bar');
      $bar.removeClass('animate');
      $modal.modal('show');
      $bar.addClass('animate'); 
      setTimeout(function() {
        $bar.removeClass('animate');
        $modal.modal('hide');
      }, 1500);
      $("#carregaAjax").load(url, function(responseTxt, statusTxt, xhr){
          
         
       });
  }
  
  $("body").on('submit','.addRegistro, .editRegistro',function(event){
    event.preventDefault();
  //alert();
    var url =$(this).attr('data-url');
    if($("#terminal").val() == '')
    {alert('O terminal não pode ser vazio!');
       
    }if($("#data_inicio").val() == ''){
       alert('A data início não pode ser vazio!');
    }else if($("#data_fim").val() == ''){
      alert('A data fim não pode ser vazio!');       
    }else{
      
      var $modal = $('.js-loading-bar'),
      $bar = $modal.find('.progress-bar');
      $bar.removeClass('animate');
      $modal.modal('show');
      $bar.addClass('animate'); 
      
      setTimeout(function() {
        $bar.removeClass('animate');
        $modal.modal('hide');
      }, 1500);
       
      $.ajax({
          url: url,
          type: "POST",
          data: $('.formData').serialize(),
          dataType: "json"

      }).done(function(resposta) {
          
          if(resposta=='sucesso'){
            alert('O registro foi salvo!');
            carregaAjax('terminal/index');
          }

      }).fail(function(jqXHR, textStatus ) {
          console.log("Request failed: " + textStatus);

      }).always(function() {
          console.log("completou");
      });
    }
    
  });
  
  $("body").on('click','.paginatorNumber',function(event){
    event.preventDefault();
    var url =$(this).attr('href');
    carregaAjax(url);
    
  });
  
  $("body").on('click','.load-page',function(event){
    var url =$(this).attr('data-url');
    carregaAjax(url);  
  });
  
   $("body").on('click','.deleteRegistro',function(event){
      event.preventDefault();
     if (confirm("Tem Certeza que deseja apagar esse registro?") == true) 
     {
       var url =$(this).attr('data-url');
       $.ajax({
            url: url,
            type: "POST",
            dataType: "json"

        }).done(function(resposta) {

            if(resposta=='sucesso'){
              alert('O registro foi apagado!');
              carregaAjax('terminal/index');
            }else{
              alert('Falha ao apagar o registro');
            }

        }).fail(function(jqXHR, textStatus ) {
            console.log("Request failed: " + textStatus);

        }).always(function() {
            console.log("completou");
        }); 
      }
   });
});