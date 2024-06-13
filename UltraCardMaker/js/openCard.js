function showCard(){

    var cct = document.getElementById("cct").innerHTML.toString();

    if(cct == "spell" || cct  == "trap"){
        document.getElementById("div-atk-def").style.display = "none";
        document.getElementById("div-atk").style.display = "none";
        document.getElementById("div-def").style.display = "none";
        document.getElementById("div-monster-type").style.display = "none";
        document.getElementById("div-level-attribute").style.display = "none";
        document.getElementById("div-level").style.display = "none";
        document.getElementById("div-attribute").style.display = "none";
        document.getElementById("div-pendulum-text").style.display = "none";
        document.getElementById("div-link-scale").style.display = "none";
        document.getElementById("div-left-scale").style.display = "none";
        document.getElementById("div-right-scale").style.display = "none";
    }

    if(cct  == "monster" ){
        document.getElementById("div-left-scale").style.display = "none";
        document.getElementById("div-right-scale").style.display = "none";
        document.getElementById("div-pendulum-text").style.display = "none";

        if(document.getElementById("card_sub_card").value == "link"){
            document.getElementById("div-link-scale").style.display = "none";
            document.getElementById("div-def").style.display = "none";
            document.getElementById("div-level-attribute").style.display = "none";
            document.getElementById("div-level").style.display = "none";
        }
    }

    if(cct == "pendulum" ){
        document.getElementById("div-link-scale").style.display = "none";
    }

}
/*
    document.getElementById("div-atk-def").style.display = "none";
    document.getElementById("div-atk").style.display = "none";
    document.getElementById("div-def").style.display = "none";
    document.getElementById("div-monster-type").style.display = "none";
    document.getElementById("div-level-attribute").style.display = "none";
    document.getElementById("div-level").style.display = "none";
    document.getElementById("div-pendulum-text").style.display = "none";
    document.getElementById("div-link-scale").style.display = "none";
    document.getElementById("div-left-scale").style.display = "none";
    document.getElementById("div-right-scale").style.display = "none";
*/
