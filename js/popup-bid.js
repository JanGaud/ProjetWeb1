// Select modal

const formatter = new Intl.NumberFormat('fr-CA', {
	style: 'currency',
	currency: 'CAD',
});
var mpopup = document.getElementById('mpopupBox');

// Select trigger link
var mpLinks = document.querySelectorAll(".mpopupLink");

for (var i = 0; i < mpLinks.length; i++) {
    mpLinks[i].addEventListener("click", function(event) {
        let idTimbre = event.target.dataset.timbre;
        let inputIdTimbre = document.getElementById("idTimbre");
        let mise = event.target.dataset.mise;
        let miseTimbre = document.getElementById("number");
        let miseAct = document.getElementById("miseAct");
        let encherrisseurs = event.target.dataset.encherrisseurs;
        let encherisseursPre = document.getElementById("encherrisseurs");
        encherisseursPre.innerHTML = encherrisseurs;
        miseAct.innerHTML = formatter.format(Number(mise));
        inputIdTimbre.value = idTimbre;
        miseTimbre.value = Number(mise) + 1;
        mpopup.style.display = "block";
    });
}

// Select close action element
var close = document.getElementsByClassName("close")[0];

// Close modal once close element is clicked
close.onclick = function() {
    mpopup.style.display = "none";
};

// Close modal when user clicks outside of the modal box
window.onclick = function(event) {
    if (event.target == mpopup) {
        mpopup.style.display = "none";
    }
};

/* https://www.codexworld.com/simple-modal-popup-javascript-css/ */