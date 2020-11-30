$(document).ready(function(){
    $("#searchFilter").on("keyup", function() {
        var value = $(this).val().toLowerCase();
        $("#tableEmployes tr").filter(function() {
            $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
        });
    });
});
