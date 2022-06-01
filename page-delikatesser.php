<?php
/**
 * The site's entry point.
 *
 * Loads the relevant template part,
 * the loop is executed (when needed) by the relevant template part.
 *
 * @package HelloElementor
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

get_header();
?>
<aside id="popup">
      <button id="lukKnap">X</button>

      <article>
        <img src="" alt="" />
        <h3 id="popupTitle" class="navn"></h3>
        <p class="langbeskrivelse"></p>
        <h4 class="pris"></h4>
		<button>Tilføj</button>
      </article>
    </aside>

<main>
	<h1>Delikatesser</h1>
	 <nav id="knapper">      
		<button data-kategorier="alle" class="valgt"></button>
        <button data-kategorier="balsamico"></button>
        <button data-kategorier="chips"></button>
        <button data-kategorier="dolci"></button>
		<button data-kategorier="fisk"></button>
		<button data-kategorier="kaffe"></button>
		<button data-kategorier="nodder"></button>
		<button data-kategorier="oliven"></button>
		<button data-kategorier="olivenolie"></button>
	</nav>
	<section id="loopView"></section>

</main>

<template>
	<article>
		<img src="" alt="">
		<h3 id="deliTitle" class="navn">Navn</h3>
		<p id="deliBeskrivelse"class="beskrivelse"></p>
		<h4 class="pris"></h4>
		<button>Tilføj</button>
	</article>
</template>

   

	<script>
	let delikatesser = [];
	let filter = "alle";
	let kategorier = [];
	const loop = document.querySelector("#loopView");
    const template = document.querySelector("template").content;
	const knapListe = document.querySelector("#knapper");
	const popup = document.querySelector("#popup");
	const deliUrl = ("http://charlottefranciska.dk/kea/rosetta/wp-json/wp/v2/delikatesse?per_page=100");
	const kateUrl = ("http://charlottefranciska.dk/kea/rosetta/wp-json/wp/v2/kategorier");

	
	document.addEventListener("DOMContentLoaded", start);
	
	function start(){
	console.log("nu er vi i start");
	
	hentData();
}
async function hentData (){
	let response = await fetch(deliUrl);
	let kateResponse = await fetch(kateUrl);

	delikatesser = await response.json(); 
	kategorier = await kateResponse.json();
	visDelikatesser ();	
	opretKnapper ();
}

function opretKnapper (){
	console.log("vi laver knapper")
	knapListe.textContent ="";
	kategorier.forEach(kategori=>{
		knapListe.innerHTML += `<button  data-kategorier="${kategori.id}">${kategori.name}</button>`
	})

	addEventListenerTilKnap();

}

function addEventListenerTilKnap (){
	 document.querySelectorAll("#knapper button").forEach(knap => {
		 knap.addEventListener("click",filtrerDelikatesser)
	 })
}

function filtrerDelikatesser() {
        filter = this.dataset.kategorier;
		console.log(filter)
        visDelikatesser();
      }


function visDelikatesser (){
	console.log(delikatesser);
	loop.innerHTML = "";
        delikatesser.forEach((delikatesse) => {
          if (filter == "alle" || delikatesse.kategorier.includes(parseInt(filter))) {
            let klon = template.cloneNode(true);
            klon.querySelector("h3").textContent = delikatesse.title.rendered;
            klon.querySelector(".beskrivelse").textContent =
              delikatesse.beskrivelse;
            klon.querySelector(".pris").textContent =
              delikatesse.pris + " kr." ;
            klon.querySelector("img").src = delikatesse.billede.guid;
			  klon.querySelector("article").addEventListener("click",()=> visDetaljer(delikatesse));
			loop.appendChild(klon);
          }
        });

		function visDetaljer (delikatesse){
			console.log(this); 
popup.querySelector("h3").textContent = delikatesse.title.rendered;
            popup.querySelector(".langbeskrivelse").textContent =
              delikatesse.lang_beskrivelse;
            popup.querySelector(".pris").textContent = delikatesse.pris + " kr.";
            popup.querySelector("img").src = delikatesse.billede.guid;
			popup.style.display="block";
		}
document.querySelector("#lukKnap").addEventListener("click",() => (popup.style.display = "none"));
}

</script>
<?php
get_footer();
