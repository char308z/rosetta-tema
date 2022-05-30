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
	<h1>Menukort</h1>
	 <nav id="knapper">
        <button data-kategorier="alle" class="valgt"></button>
        <button data-kategorier="balsamico"></button>
        <button data-kategorier="chips"></button>
        <button data-kategorier="dolci"></button>
		<button data-kategorier="fisk"></button>
		<button data-kategorier="kaffe"></button>
		<button data-kategorier="nodder"></button>
		<button data-kategorier="oliven"></button>
		<button data-kategorier="olivenolie"></button>        </nav>
	<section></section>

</main>

<template>
	<article>
		<img src="" alt="">
		<h3 class="navn">Navn</h3>
		<p class="beskrivelse"></p>
		<p class="pris"></p>
		<button>Bestil</button>
	</article>
</template>

<main>
	Hello
</main>

	<script>
	let delikatesser = [];
	let filter = "alle";
	let kategorier =[];
	let knapper = document.querySelector("main nav"); 
	const loop = document.querySelector("main section");
    const template = document.querySelector("template").content;
	const url = ("http://charlottefranciska.dk/kea/rosetta/wp-json/wp/v2/delikatesse");
		const katUrl = ("http://charlottefranciska.dk/kea/rosetta/wp-json/wp/v2/kategorier");

	
	document.addEventListener("DOMContentLoaded", start);
	
	function start(){
	console.log("nu er vi i start");
	// knapper.textContent = "";
	kategorier.forEach(kategori => {
	knapper.innerHTML +=`<button  data-kategorier="${kategori.name}">${kategori.name}</button>`
	})
	const filterKnapper = document.querySelectorAll("main nav button");
        filterKnapper.forEach((knap) => {
          knap.classList.add(knap.dataset.kategorier);
		  knap.textContent = knap.dataset.kategorier.name;
          knap.addEventListener("click", filtrerDelikatesser);
        });
	hentData();
}
async function hentData (){
	let response = await fetch(url);
	let katResponse = await fetch(katUrl);

	delikatesser = await response.json(); 
	kategorier = await katResponse.json();
	visDelikatesser ();	
}

function filtrerDelikatesser() {
        filter = this.dataset.kategorier;
        document.querySelector(".valgt").classList.remove("valgt");
        this.classList.add("valgt");
        visDelikatesser();
      }


function visDelikatesser (){
	console.log(delikatesser);
	loop.textContent = "";
        delikatesser.forEach((delikatesse) => {
          if (filter == delikatesse.kategorier || filter == "alle") {
            let klon = template.cloneNode(true);
            klon.querySelector(".navn").textContent = delikatesse.navn;
            klon.querySelector(".beskrivelse").textContent =
              delikatesse.beskrivelse;
            klon.querySelector(".pris").textContent =
              "Pris: " + delikatesse.pris ;
            klon.querySelector("img").src =
              delikatesse.billede.guid;
          
          }
        });

}

</script>
<?php
get_footer();
