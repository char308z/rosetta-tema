<?php
/**
 * The site's entry point.
 *
 * Loads the relevant template part,
 * the loop is executed (when needed) by the relevant template part.
 *
 * @package HelloElementor
 */


get_header();
?>

<main>
	<h1>Menukort</h1>
	 <nav id="knapper">
        <button data-category="alle" class="valgt">Alle</button>
        <button data-category="sideorders">Side orders</button>
        <button data-category="slices">slices</button>
        <button data-category="sandwich">Sandwich</button>
        
      </nav>
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

<script>
	let retter = [];
	let filter = "alle";
	const loop = document.querySelector("main section");
    const template = document.querySelector("template").content;
	const url = ("http://charlottefranciska.dk/kea/rosetta/wp-json/wp/v2/menukort");
	
	document.addEventListener("DOMContentLoaded", start);
	
	function start(){
	console.log("nu er vi i start");
	const filterKnapper = document.querySelectorAll("main nav button");
        filterKnapper.forEach((knap) => {
          knap.classList.add(knap.dataset.kategori);
          knap.addEventListener("click", filtrerRetter);
        });
	getJson();
}
async function getJson (){
	let response = await fetch(url);
	retter = await response.json(); 
	visRetter ();	
}

function filtrerRetter() {
        filter = this.dataset.category;
        document.querySelector(".valgt").classList.remove("valgt");
        this.classList.add("valgt");
        visRetter();
      }

function visRetter (){
	console.log(retter);
	loop.textContent = "";
        retter.forEach((ret) => {
          if (filter == ret.kategori || filter == "alle") {
            let klon = template.cloneNode(true);
            klon.querySelector(".navn").textContent = ret.navn;
            klon.querySelector(".beskrivelse").textContent =
              ret.fyld;
            klon.querySelector(".pris").textContent =
              "Pris: " + ret.pris + " kr.";
            klon.querySelector("img").src =
              ret.billede.guid;
            klon
              .querySelector("article")
              .addEventListener("click", () => visDetaljer(ret));
            klon.querySelector("article").classList.add(ret.category);
            loop.appendChild(klon);
          }
        });

}

</script>
<?php
get_footer();

