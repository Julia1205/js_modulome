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



$('#bedroomSizes').change(function(){
    liste = document.getElementById("bedroomSizes");
    texte = liste.options[liste.selectedIndex].value;
    lien = document.getElementById("lienImgBed").value;
    console.log(lien+"bedroom"+texte+'squarefeet.jpg');
    $('#imgForm').attr('src', lien+"bedroom"+texte+'squarefeet.png');
});

$('.radio').click(function(){
    var radios = document.getElementsByName('livingroomType');
    var valeur;
    for(var i = 0; i < radios.length; i++){
        if(radios[i].checked){
            valeur = radios[i].value;
            console.log(valeur);
        }
    }
});

$('#livingroomType').click(function(){
    lien = document.getElementById("lienImg").value;
    type = document.getElementById("livingroomType").value;
    if(type === 'open'){

        $('#imgForm').attr('src', lien+"livingroom30sqft.png");
    }else{
        $('#imgForm').attr('src', lien+"30sqftliving10kitchen.png");
    }
});