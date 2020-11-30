// var a = 1
// var i =prompt("Saisir un nombre positif ")
// if(a>5){
//     console.log("Le nombre est supérieur à 5");//Sur la console
// }
// else{
//     alert("le nombre est inférieur à 5");//Sur la fenetre
// }

function doGetJson(url){
    const d = $.Deferred();
    $.getJSON(url, function(data){
        maReponse = data;
        $("tbody").empty();
        $.each(data, function(cle, valeur){
            $("<tr>").append($("<td>").html(valeur.noService), $("<td>").html(valeur.libelle), $("<td>").html(valeur.ville)).appendTo($("tbody"));
        });
        d.resolve(maReponse);
    })

    return d.promise(); 
}