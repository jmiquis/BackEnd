function checkNumber(max,number){
        number = parseInt(document.getElementById("puntos").value);

        if (number>max) {alert("El numero "+number+" es mayor que la mayor cantidad de puntos de cualquiera de nuestros clientes");}
        
        document.forms[0].submit();

}
