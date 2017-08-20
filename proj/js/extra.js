/**
 * Created by Jaeger on 2017-07-08.
 */
//lite onödig men rolig js
//TODO något vettigt med detta
function changeColor() {
    if(document.getElementById("pizza1").innerHTML === "Go yellow!"){
        document.getElementById("pizza1").innerHTML = "Go boring";
    }else{
        document.getElementById("pizza1").innerHTML = "Go yellow!";
    }
    //alert("YOOOOOOOO");
    if(document.getElementsByTagName("BODY")[0].style.backgroundColor === "yellow"){
        document.getElementsByTagName("BODY")[0].style.backgroundColor = "#EEF4F4";
    }else {
        document.getElementsByTagName("BODY")[0].style.backgroundColor = "yellow";
    }
}