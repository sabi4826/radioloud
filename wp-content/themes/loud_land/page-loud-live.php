<?php
/**
 * The template for displaying all pages
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site may use a
 * different template.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Abletone
 */

get_header(); ?>

<style>
	@media (min-width: 1000px) {

		/*GRID TIL TOP BANNER*/
		#top_tekst {
			display: grid;
			grid-template-columns: 1fr 1fr 1fr;
			margin: 50px 5vw 100px 5vw;
		}

		.col_2 {
			margin-left: 50px;
		}

		#overskrift {
			margin-left: 5vw;
		}


	}

	/*#podcast_oversigt {
		display: grid;
		grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
		max-width: 100vw;
		grid-gap: 2rem;
		padding-left: 10vw;
		padding-right: 10vw;
		overflow: hidden;
		position: relative;
		margin: 40px 20px;
	}*/

	/*HVID TEKST*/
	#top_tekst p {
		color: white;
	}

	.sendeplan h2 {
		color: white;
	}

	.col_1 {
		grid-column: 1/2;
		margin-bottom: 5vw;
	}

	.col_1 h2,
	h3 {
		color: white;
	}

	.col_1 img {}

	.col_2 {
		grid-column: 2/4;
	}

	.col_2 img {
		width: 100%;
	}

	#overskrift {
		margin-bottom: 5vw;
		margin-top: 4vw;
	}

	.sende_knapper img {
		width: 100%;
		height: auto;
	}

	.sende_knapper {
		width: 100vw;
		padding: 0;
		margin: 20px 0px 0 -30px;
	}

	#sende_oversigt .sendeplan {
		margin: 0 auto;
	}

</style>

<div id="primary" class="content-area">
	<main id="main" class="site-main">
		<h1 id="overskrift">LOUD LIVE - vil du lytte med?</h1>
		<section id="top_tekst">
			<div class="col_1">
				<h2>Lige Nu:</h2>
				<h3>BARE SEX</h3>
				<p>Lige nu kan du høre programmet "BARE SEX", der handler om sex, krop og dating. Værten Alma har været på date med en gammel ven, og det kom der noget akavet sex ud af.</p>
			</div>
			<div class="col_2">
				<img src="http://sabineovesen.dk/radioloud/wp-content/uploads/2021/04/lytLive-1.png" alt="Live podcasten">
			</div>
		</section>

		<nav id="filtrering">
		</nav>

		<section id="sende_oversigt">
			<div class="sende_knapper">
				<img src="http://sabineovesen.dk/radioloud/wp-content/uploads/2021/04/Image-110.png" alt="Sende knapper">
			</div>
			<div class="sendeplan">
				<h2>Sendeplan</h2>
				<img src="http://sabineovesen.dk/radioloud/wp-content/uploads/2021/04/sendeplan_tirsdag.png" class="tirsdag" alt="sendeplan tirsdag">
			</div>

		</section>
	</main><!-- #main -->

	<template>
		<article>
			<div><img src="" alt="" class="billede"></div>
			<div>
				<h3></h3>
				<h4></h4>
				<p class="episode_resume"></p>
			</div>
		</article>
	</template>



	<!-- <script>
     let episoder;
     //let podcasts;
     let categories;
     let filterEpisoder = "alle";


     // container/destination til articles med en episode
     const dest = document.querySelector("#sende_oversigt");

     // select indhold af html skabelon (article)
     const skabelon = document.querySelector("template");

     // url til wp rest api/database
     const url = "http://sabineovesen.dk/radioloud/wp-json/wp/v2/episode?per_page=100";
     const cat_url = "http://sabineovesen.dk/radioloud/wp-json/wp/v2/ugedag";

     async function loadJson() {
         const JsonData = await fetch(url);
         const catData = await fetch(cat_url);
         episoder = await JsonData.json();
         categories = await catData.json();
         console.log("loadJson");
         visEpisoder();
         opretKnapper();
     }

     function opretKnapper() {
         console.log("opretKnapper virker");
         categories.forEach(cat => {
             document.querySelector("#filtrering").innerHTML += `<button class="filter" data-podcast="${cat.id}">${cat.name}</button>`
         })
         addEventListenersToButtons();
     }

     function addEventListenersToButtons() {
         console.log("lytTilKnapper virker");
         document.querySelectorAll("#filtrering button").forEach(elm => {
             elm.addEventListener("click", filtrering);
         })
         filtrering();
     };

     function filtrering() {
         filterEpisoder = this.dataset.episode;
         console.log("filterEpisoder");
         visEpisoder();
     }

     //funktion, der viser episoder i liste view
     function visEpisoder() {
         console.log("visEpisoder-funktion");
         // ryd ekst. indhold:
         dest.innerHTML = "";

         // loop igennem json (lande)
         episoder.forEach(episode => {

             if (filter == podcast.kategori || filter == "alle")
                 //HVAD GØR DET FILTER OVENOVER???

                 if (filterEpisoder == "alle" || episode.categories.includes(parseInt(filterEpisoder))) {
                     const klon = skabelon.cloneNode(true).content;
                     klon.querySelector(".billede").src = episode.billede.guid;
                     klon.querySelector("h3").textContent = episode.title.rendered;
                     klon.querySelector(".episode_resume").textContent = episode.episode_resume;
                     klon.querySelector(".vaerter").textContent = `${"Værter: "}` + episode.vaerter;
                     console.log("klon i visEpisoder kører");

                     dest.appendChild(klon);
                 }
         })
     }

     loadJson();
 </script>-->
</div><!-- #primary -->

<?php get_sidebar();
get_footer();
