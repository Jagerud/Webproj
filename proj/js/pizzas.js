/**
 * Created by Jaeger on 2017-07-08.
 */
function getPizza() {
    if(document.getElementById("pizza1").innerHTML === "Hello World"){
        document.getElementById("pizza1").innerHTML = "first pizza";
    }else{
        document.getElementById("pizza1").innerHTML = "Hello World";
    }
    //alert("YOOOOOOOO");
    if(document.getElementsByTagName("BODY")[0].style.backgroundColor === "yellow"){
        document.getElementsByTagName("BODY")[0].style.backgroundColor = "#EEF4F4";
    }else {
        document.getElementsByTagName("BODY")[0].style.backgroundColor = "yellow";
    }
}