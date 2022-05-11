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
    liste = document.getElementById("bedroomSize");
    texte = liste.options[liste.selectedIndex].value;
    console.log(texte);
});

