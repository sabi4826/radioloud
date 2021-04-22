<?php
/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package Abletone
 */

get_header(); ?>

<div id="primary" class="content-area">
	<main id="main" class="site-main">
		<h1 id="overskrift">Episode??? HVAD SKAL DER STÅ HER?</h1>
		<!--
		<nav id="filtrering">
			<button data-podcast="alle">Alle</button>
		</nav>
-->
		<section id="enkelt_episode"></section>
	</main><!-- #main -->

	<template>
		<article>
			<img src="" alt="" class="episode-billede">
			<h2></h2>
			<h4></h4>
			<p></p>
		</article>
	</template>

	<script>
		let episode;
		let aktuelEpisode = <?php echo get_the_ID() ?>;

		console.log("id på episode", aktuelEpisode);
		// url til wp rest api/database
		const dbUrl = "http://sabineovesen.dk/radioloud/wp-json/wp/v2/episode/" + aktuelEpisode;

		// container/destination til articles med en episode
		const dest = document.querySelector("#enkelt_episode");
		// select indhold af html skabelon (article)
		const skabelon = document.querySelector("template");

		async function loadJson() {
			const JsonData = await fetch(dbUrl);
			episode = await JsonData.json();
			console.log("loadJson");
			visEpisode();
			opretKnapper();
		}

		//funktion, der viser episoden
		function visEpisode() {
			console.log("visEpisode-funktion");
			// ryd ekst. indhold - ER DEN NØDVENDIG?:
			//dest.innerHTML = "";

			const klon = skabelon.cloneNode(true).content;
			klon.querySelector(".episode-billede").src = episode.billede.guid;
			klon.querySelector("h2").textContent = episode.title.rendered;
			klon.querySelector("h4").textContent = episode.episode_resume;
			klon.querySelector("p").textContent = episode.dato;

			// eventlisteners på hver enkelt artikel
			klon.querySelector(".afspil_knap").addEventListener("click", () => {
				location.href = episode.link;
			})

			klon.querySelector(".gea_til_podcast_knap").addEventListener("click", () => {
				location.href = episode.link;
			})
			dest.appendChild(klon);

		}

		loadJson();

	</script>
</div><!-- #primary -->


get_footer();
