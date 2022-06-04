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
      <article>
        <a href="#" id="lukKnap"></a>
        <img src="" alt="" />
        <div id="popupIndhold">
          <h3 id="popupTitle" class="navn"></h3>
          <p class="langbeskrivelse"></p>
          <h4 class="pris"></h4>
          <button>Tilføj</button>
        </div>
      </article>
    </aside>

    <main>
      <h1 id="delikatesser-overskrift">Delikatesser</h1>
      <div class="delikatesser-grid">
        <nav id="knapper">
          <div class="dropdown">
            <!-- <option value="">Vælg</option> -->
            <button onclick="toggleDropdown()" class="dropbtn">
              Vælg en kategori
            </button>
            <div id="myDropdown" class="dropdown-content">
              <button></button>
            </div>
          </div>
        </nav>
        </div>
        <section id="loopView"></section> 
 <div id="deliDetalje"></div>
    </main>

    <template>
      <article>
        <img src="" alt="" />
        <div id="deliIndhold">
          <h3 id="deliTitle" class="navn">Navn</h3>
          <p id="deliBeskrivelse" class="beskrivelse"></p>
          <div class="pristilfoej">
            <h4 class="pris"></h4>
            <button>Tilføj</button>
          </div>
        </div>
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
      const deliUrl =
        "http://charlottefranciska.dk/kea/rosetta/wp-json/wp/v2/delikatesse?per_page=100";
      const kateUrl =
        "http://charlottefranciska.dk/kea/rosetta/wp-json/wp/v2/kategorier";

      document.addEventListener("DOMContentLoaded", start);

      function start() {
        console.log("nu er vi i start");
        hentData();
      }

      async function hentData() {
        let response = await fetch(deliUrl);
        let kateResponse = await fetch(kateUrl);

        delikatesser = await response.json();
        kategorier = await kateResponse.json();

        visDelikatesser();
        opretKnapper();
      }

      function opretKnapper() {
        console.log("vi laver knapper");
        // knapListe.textContent = "";
        kategorier.forEach((kategori) => {
          document.querySelector(
            "#myDropdown"
          ).innerHTML += `<button class="filter" data-kategorier="${kategori.id}">${kategori.name}</button>`;
        });

        addEventListenerTilKnap();
      }

      function addEventListenerTilKnap() {
        document.querySelectorAll("#myDropdown button").forEach((elm) => {
          elm.addEventListener("click", filtrerDelikatesser);
        });
      }

      function filtrerDelikatesser() {
        document.getElementById("myDropdown").classList.toggle("show");
        filter = this.dataset.kategorier;
        console.log(filter);
        visDelikatesser();
      }

      function visDelikatesser() {
        console.log(delikatesser);
        loop.innerHTML = "";
        delikatesser.forEach((delikatesse) => {
          if (
            filter == "alle" ||
            delikatesse.kategorier.includes(parseInt(filter))
          ) {
            let klon = template.cloneNode(true);
            klon.querySelector("h3").textContent = delikatesse.title.rendered;
            klon.querySelector(".beskrivelse").textContent =
              delikatesse.beskrivelse;
            klon.querySelector(".pris").textContent = delikatesse.pris + " kr.";
            klon.querySelector("img").src = delikatesse.billede.guid;
            klon
              .querySelector("article")
              .addEventListener("click", () => visDetaljer(delikatesse));
            loop.appendChild(klon);
          }
        });

        function visDetaljer(delikatesse) {
          console.log(this);
          popup.querySelector("h3").textContent = delikatesse.title.rendered;
          popup.querySelector(".langbeskrivelse").textContent =
            delikatesse.lang_beskrivelse;
          popup.querySelector(".pris").textContent = delikatesse.pris + " kr.";
          popup.querySelector("img").src = delikatesse.billede.guid;
          popup.style.display = "block";
        }
        document
          .querySelector("#lukKnap")
          .addEventListener("click", () => (popup.style.display = "none"));
      }

      function toggleDropdown() {
        document.getElementById("myDropdown").classList.toggle("show");
      }
    </script>
 

<?php
get_footer();
