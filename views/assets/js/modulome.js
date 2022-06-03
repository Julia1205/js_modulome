function targett() {
    alert('hello!');
}

$("#nbBedrooms[val='1']").click(function(){
    alert('hello');
});

$('.radio').click(function(){
    var radios = document.getElementsByName('nbBedrooms');
    var valeur;
    for(var i = 0; i < radios.length; i++){
        if(radios[i].checked){
            valeur = radios[i].value;
            console.log(valeur);
        }
    }
});



$('#bedroomSize').change(function(){
    liste = document.getElementById("bedroomSizes");
    texte = liste.options[liste.selectedIndex].value;
    console.log(texte);
});


function saveBDD(id_commentaire){
    var newcomm = document.getElementById('newname-'+id_commentaire).value;
    $.ajax({
        type : 'POST',
        url : modulome,
        dataType : 'JSON',
        data:{
            ajax: true,
            action : 'UpdateComm',
            id_commentaire : id_commentaire,
            newcomm : newcomm
        },
        success: function(data){
            var oldcomm = document.getElementById('message-'+id_commentaire);
            console.log(data);
            oldcomm.innerText = data;
        },
        error: function(XMLHttpRequest, textStatus, errorThrown){
            console.log(textStatus, errorThrown);
        }
    });
}
