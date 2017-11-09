$('document').ready(function(url){
    function carregaAjax(){
        $("#carregaAjax").load(url, function(responseTxt, statusTxt, xhr){
            /*if(statusTxt == "success")
                alert("External content loaded successfully!");
            if(statusTxt == "error")
                alert("Error: " + xhr.status + ": " + xhr.statusText);*/
        });
    }
});