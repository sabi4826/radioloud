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
	/* splachbilelde */
	.spalch_billede {
		background-image: url(http://sabineovesen.dk/radioloud/wp-content/uploads/2021/04/Forside_splash.png);
		max-width: none;
		width: auto;
		height: 46vh;
		background-size: cover;
		background-position: 50%;
		margin: 70px -100px 90px -100px;
	}

	.new_podcast,
	.det_hitter {
		display: grid;
		grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
		max-width: 100vw;
		grid-gap: 2rem;
		grid-auto-flow: dense;
	}



	/* styling af play kanppen */

	.play_knap {
		position: absolute;
		place-self: center center;

	}

	.play_knap {
		position: absolute;
		place-self: center center;
		cursor: pointer;
	}

	/* styling af loud live sektionen*/

	.loud_live_forside .left {
		padding: 9% 10%;
		background-color: rgba(4, 22, 31, 0.68);
	}

	.loud_live_forside .left h3 {
		text-transform: uppercase;
		color: white;
		margin-top: 4%;
	}



	.loud_live_forside .left h2 {
		text-decoration: underline;
		text-transform: uppercase;
		color: white;
	}


	#overskrift {
		text-align: center;
		text-decoration: uppercase;
		margin-top: 30%;
	}

	.veart_nyeste {
		font-weight: bold;
	}

	#det_hitter_overskrift {
		text-align: center;
		text-decoration: uppercase;
		margin-top: 30%;
	}

	#uder_overskrift {
		text-align: center;
		margin: 0px;
		color: white;
	}

	.podcast_baggrund h2 {
		color: black;
	}





	/*    destop grid udgaven på alle podcast oversigten*/
	@media (min-width: 950px) {


		/* splachbilelde */
		.spalch_billede {
			max-width: none;
			height: 100vh;
			background-position: none;

		}

		/*tilføjelser til grid på destop */
		.new_podcast,
		.det_hitter {
			overflow: hidden;
			position: relative;
			margin: 40px 20px;
			padding-left: 5vw;
			padding-right: 5vw;
		}

		/*    styling af loud live sektionen*/

		#live_live_sektion {
			display: grid;
			grid-template-rows: 1fr 2fr;
		}

		.loud_live_forside {
			display: grid;
			grid-template-columns: 1fr 1fr;
			grid-template-rows: 1fr 2fr;
			margin: 0px 20px;
			padding-left: 5vw;
			padding-right: 5vw;
		}





		#live_live_sektion {
			background-image: url(http://sabineovesen.dk/radioloud/wp-content/uploads/2021/04/baggrunds_streger_tydeloig.png);
			width: auto;
			height: 120vh;
			background-size: cover;
		}

		/*        h1 overskrifter og deres margen*/
		#overskrift,
		#det_hitter_overskrift {
			margin-top: 15%;
		}

	}

</style>

<div id="primary" class="content-area">

	<main id="main" class="site-main">
		<div class="singular-content-wrap"></div> <!-- .singular-content-wrap -->

		<section>
			<div class="spalch_billede"></div>
		</section>

		<section>
			<h1 id="overskrift">Nye podcast episoder fra LOUD</h1>
			<div class="new_podcast"></div>
		</section>


		<section id="live_live_sektion">
			<div class="top">
				<h1 id="overskrift">VIL DU LYTTE MED?</h1>s
			</div>
			<div class="loud_live_forside">
				<div>
					<a href="http://sabineovesen.dk/radioloud/index.php/loud-live/"> <img src="http://sabineovesen.dk/radioloud/wp-content/uploads/2021/04/lytLive-1.png" alt="live billede"></a>
				</div>
				<div class="left">
					<h2>lige nu:</h2>
					<h3>Nu: BARE SEX</h3>
					<h3>Næste: LIVE FRA FORTIDEN </h3>
				</div>
			</div>
		</section>



		<section>
			<h1 id="det_hitter_overskrift">DET HITTER</h1>
			<h2 id="uder_overskrift">Se de mest populære podcasts</h2>
			<div class="det_hitter"></div>
		</section>



	</main><!-- #main -->

	<template>
		<article>
			<img src="" alt="" class="billede">

			<div class="podcast_baggrund">
				<h3></h3>
				<p class="veart_nyeste"></p>
				<p class="podcast_resume"></p>
			</div>
			<button class="gea_til_podcast_knap">Gå til podcast</button>
		</article>
	</template>






	<template id="forside_det_hitter">
		<article>

			<img src="" alt="" class="billede">
			<div class="podcast_baggrund">
				<h3></h3>
				<p class="podcast_resume"></p>
			</div>
			<div class="doble_knap">
				<button class="afspil_knap">Afspil</button>
				<button class="gea_til_podcast_knap">Gå til podcast</button>
			</div>

		</article>
	</template>


	<script>
		let podcasts;

		// url til wp rest api/database
		const url = "http://sabineovesen.dk/radioloud/wp-json/wp/v2/podcast?per_page=100";


		async function loadJson() {
			const JsonData = await fetch(url);
			newEoisoder = await JsonData.json();
			console.log("loadJson", newEoisoder);
			visNewPodcast();
			visDetHitter();


		}
		loadJson();


		//Her i funktioen genereres tre tilfeldeig podcast og sættes ind i HTML under sektionen, nye podcasts episoder
		function visNewPodcast() {
			console.log("visNewPodcast");

			//Genererer et nyt array af tilfældige objekter fra det komplette array
			const other1 = newEoisoder[Math.floor(Math.random() * newEoisoder.length)];
			const other2 = newEoisoder[Math.floor(Math.random() * newEoisoder.length)];
			const other3 = newEoisoder[Math.floor(Math.random() * newEoisoder.length)];
			const randomEpisode = [other1, other2, other3];
			console.log(randomEpisode);

			randomEpisode.forEach(podcast => {
				//Definerer konstanter til senere brug i kloningen af template
				const template = document.querySelector("template");
				const container = document.querySelector(".new_podcast");


				const klon = template.cloneNode(true).content; //Her klones template og udfyldes med data fra de tilfældige objekter
				klon.querySelector(".billede").src = podcast.billede.guid;
				klon.querySelector("h3").textContent = podcast.title.rendered;
				klon.querySelector(".veart_nyeste").innerHTML = podcast.vaerter;
				klon.querySelector(".podcast_resume").textContent = podcast.podcast_resume;
				// eventlisteners på hver enkelt artikel
				klon.querySelector(".gea_til_podcast_knap").addEventListener("click", () => {
					location.href = podcast.link;
				})

				container.appendChild(klon);
			})

		}


		function visDetHitter() {
			console.log("visDetHitter");

			//Genererer et nyt array af tilfældige objekter fra det komplette array
			const other1 = newEoisoder[Math.floor(Math.random() * newEoisoder.length)];
			const other2 = newEoisoder[Math.floor(Math.random() * newEoisoder.length)];
			const other3 = newEoisoder[Math.floor(Math.random() * newEoisoder.length)];
			const randomPodcast = [other1, other2, other3];
			console.log(randomPodcast);

			randomPodcast.forEach(podcast => {
				//Definerer konstanter til senere brug i kloningen af template
				const template = document.querySelector("#forside_det_hitter");
				const container = document.querySelector(".det_hitter");


				const klon = template.cloneNode(true).content; //Her klones template og udfyldes med data fra de tilfældige objekter
				klon.querySelector(".billede").src = podcast.billede.guid;
				klon.querySelector("h3").textContent = podcast.title.rendered;
				klon.querySelector(".podcast_resume").textContent = podcast.podcast_resume;

				// eventlisteners på hver enkelt artikel
				klon.querySelector(".afspil_knap").addEventListener("click", () => {
					location.href = podcast.link;
				})

				klon.querySelector(".gea_til_podcast_knap").addEventListener("click", () => {
					location.href = podcast.link;
				})

				container.appendChild(klon);
			})

		}

	</script>





</div><!-- #primary -->

<?php get_sidebar();

get_footer();
