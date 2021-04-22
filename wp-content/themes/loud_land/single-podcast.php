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

    <div id="primary" class="content-area">
        <main id="main" class="site-main">

            <!-- single-view podcast -->
            <article>
                <img src="" alt="" class="billede">
                <div>
                    <h2 class="overskrift"></h2>
                    <p class="podcast_resume"></p>
                    <p class="vaerter"></p>
                </div>
            </article>

            <!-- episode-liste -->
            <section id="episoder_section">
                <template id="temEpi">
                    <article>
                        <img src="" alt="" class="epi_billede">
                        <h2 class="epi_overskrift"></h2>
                        <h4 class="epi_dato"></h4>
                        <p class="epi_resume"></p>
                    </article>
                </template>
            </section>

        </main>

        <script>
            let podcast;
            let episoder;

            //Henter den podcasts der klikeks på
            let aktuelPodcast = <?php echo get_the_ID() ?>;


            //Konstanten sættes til at lede efter podcasten der klikkes på
            const dbUrl = "http://sabineovesen.dk/radioloud/wp-json/wp/v2/podcast/" + aktuelPodcast;

            //Henter ud fra slug, det tal som podcasten har + det id, som episoden har - der henvises dermed til podcastens underliggende episoder
            const episodeUrl = "http://sabineovesen.dk/radioloud/wp-json/wp/v2/episode?per_page=100/";

            //container der indeholder sektionen hvor episoderne skal placeres
            const container = document.querySelector("#episoder");

            console.log("Alle variabler er kaldt");


            async function getJson() {
                console.log("async function bliver kaldt")

                const data = await fetch(dbUrl);
                podcast = await data.json();

                const dataEpisode = await fetch(episodeUrl);
                episoder = await dataEpisode.json();

                visPodcasts();
                visEpisoder();
            }


            //Henter information fra json, og sætter dem ind i podcast-sektion
            function visPodcasts() {
                console.log("visPodcasts bliver kaldt")

                document.querySelector(".billede").src = podcast.billede.guid;
                document.querySelector(".overskrift").textContent = podcast.title.rendered;
                document.querySelector(".podcast_resume").textContent = podcast.podcast_resume;
                document.querySelector(".vaerter").textContent = `${"Værter: "}` + podcast.vaerter;
            }

            function visEpisoder() {
                console.log("visEpisoder bliver kaldt");

                let episodeTemplate = document.querySelector("#temEpi");
                episoder.forEach(episode => {
                    console.log("Loop ID:", aktuelPodcast);

                    if (episode.horer_til_podcast[0].id == aktuelPodcast);
                    console.log("Loop kører ID:", aktuelPodcast);

                    let klon = episodeTemplate.cloneNode(true).content;
                    klon.querySelector(".epi_billede").src = episode.billede.guid;
                    klon.querySelector("epi_overskrift").textContent = episode.title.rendered;
                    klon.querySelector("epi_dato").innerHTML = episode.dato;
                    klon.querySelector(".epi_resume").textContent = episode.episode_resume;

                    klon.querySelector("#episoder_section").addEventListener("click", () => {
                        location.href = episode.link;
                    })

                    container.appendChild(klon);
                })

            }

            getJson();

        </script>


    </div>
    <!-- #primary -->

    <?php get_sidebar();

get_footer();
