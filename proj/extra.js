/**
 * Created by Jaeger on 2017-07-08.
 */
//Just nu måste den ligga här för att jquery och validate skall fungera, framtida jobb kan försöka ha den i js/ igen

//Ändrar färg på bakgrunden och byter namnet på länken, bara för skojs skull
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
//Jquery inmatningskontroll
$(document).ready(function () {
    $("#form2").validate({
        rules: {
            pizza: {
                minlength: 2,
                required: true
            }
        },
        wrapper:'li',   // lägger felet under rutan istället för jämte http://jsfiddle.net/ryleyb/aaEFQ/
                        // förstör fortfarande css men bra nog för nu
        messages: {
            pizza: {
                required: "Required",
                minlength: "Atleast 2 chars"
            }
        }
    });
    $("#settingName").validate({
        rules: {
            settingNameInput: {
                minlength: 3,
                required: true,
                email: true
            }
        },
        wrapper:'li',   // lägger felet under rutan istället för jämte http://jsfiddle.net/ryleyb/aaEFQ/
                        // förstör fortfarande css men bra nog för nu
        messages: {
            settingNameInput: {
                email: "Email is required",
                required: "Required",
                minlength: "Atleast 3 chars"
            }
        }
    });


});

//Bra felsökningsscript som gör alla divs röda
//http://css-plus.com/2010/03/6-steps-to-take-if-your-jquery-is-not-working/
/*$(document).ready(function(){

    $("div").css("border", "3px solid red");

});*/