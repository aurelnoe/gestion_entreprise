// $(document).ready(function(){
//     $("#searchFilter").on("keyup", function() {
//         var value = $(this).val().toLowerCase();
//         $("#tableEmployes tr").filter(function() {
//             $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
//         });
//     });
// });

// $("#searchName").on("keyup", function(e){
//     const nomSelectionnee = $("#searchName :input").val().toLowerCase();
//     let url = nomSelectionnee ? "../Controller/list-EmployesController.php?nom=" + nomSelectionnee : "../Controller/list-EmployesController.php";
//     $("#tableEmploye tbody").on("change",function(data){
//         doGetJson(url, true);
//     });
// })

// $("#searchFirstName").on("keyup", function(e){
//     const prenomSelectionnee = $("#searchFirstName :input").val().toLowerCase();
//     let url = prenomSelectionnee ? "../Controller/list-EmployesController.php?prenom=" + prenomSelectionnee : "../Controller/list-EmployesController.php";
//     doGetJson(url, true);
// })

// $("#searchJob").on("keyup", function(e){
//     const emploiSelectionnee = $("#searchJob :input").val().toLowerCase();
//     let url = emploiSelectionnee ? "../Controller/list-EmployesController.php?emploi=" + emploiSelectionnee : "../Controller/list-EmployesController.php";
//     doGetJson(url, true);
// })

// $("#searchNameService").on("keyup", function(e){
//     const libelleSelectionnee = $("#searchNameService :input").val().toLowerCase();
//     let url = libelleSelectionnee ? "../Controller/list-EmployesController.php?libelle=" + libelleSelectionnee : "../Controller/list-EmployesController.php";
//     doGetJson(url, true);
// })

// function doGetJson(url, isSelect){
//     const d = $.Deferred();
//     $.getJSON(url, function(data){
//         maReponse = data;
//         $("tbody").empty();
//         $.each(data, function(cle, valeur){
//             $("<tr>").append(
//                 $("<td>").html(valeur.noEmploye),
//                 $("<td>").html(valeur.nom), 
//                 $("<td>").html(valeur.prenom), 
//                 $("<td>").html(valeur.emploi),
//                 $("<td>").html(valeur.embauche),
//                 $("<td>").html(valeur.salaire),
//                 $("<td>").html(valeur.commission),
//                 $("<td>").html(valeur.sup),
//                 $("<td>").html(valeur.no_service)), 
//                 $("<td>").html(valeur.noProj)
//             .appendTo($("tbody"));
//         });
//         d.resolve(maReponse);
//     })
//     return d.promise(); 
// }

$("#searchName").on('input', function(e) {
    e.preventDefault();
    let searchedJson = JSON.stringify($(this).val().toUpperCase());
    console.log(searchedJson);

    $.ajax({
        url: "../Controller/list-EmployesController.php",
        type: "POST",
        data: {prenom:searchedJson},
        success: function(data) {
            console.log(data);
        },
        error: function(e) {
            console.log(e.message);
        }
    });

    let url = "../Controller/list-EmployesController.php?nom=" + search ;

    $.getJSON(url, function(data) {
        const d = $.Deferred();
        let response = data;
        $("tbody").empty();
        $.each(data, function(cle, valeur) {
            $("<tr>").append(
                $("<td>").html(valeur.noEmploye),
                $("<td>").html(valeur.nom), 
                $("<td>").html(valeur.prenom), 
                $("<td>").html(valeur.emploi),
                $("<td>").html(valeur.embauche),
                $("<td>").html(valeur.salaire),
                $("<td>").html(valeur.commission),
                $("<td>").html(valeur.sup),
                $("<td>").html(valeur.no_service), 
                $("<td>").html(valeur.noProj),
                $("<td>").append($("<a>").attr({type:'button', class:'btn btn-primary',href:'#'}).html('Modifier')),
                $("<td>").append($("<a>").attr({type:'button', class:'btn btn-danger', href:'#'}).html('Supprimer'))).appendTo($("tbody"));
        });
        d.resolve(response);
    });
});