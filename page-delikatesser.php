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
		<p class="beskrivelse"></p>
		<p class="pris"></p>
		<button>Bestil</button>
	</article>
</template>

	<script>
	let delikatesser = [];
	let filter = "alle";
	let kategorier = [];
	const loop = document.querySelector("#loopView");
    const template = document.querySelector("template").content;
	const knapListe = document.querySelector("#knapper");
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
              "Pris: " + delikatesse.pris ;
            klon.querySelector("img").src = delikatesse.billede.guid;
			  klon.querySelector("article").addEventListener("click",()=>{location.href = delikatesse.link});
			loop.appendChild(klon);
          
          }
        });

}

</script>
<?php
get_footer();
