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
            <!-- single-view episode -->
            <article>
                <img src="" alt="" class="billede">
                <div>
                    <h2 class="overskrift"></h2>
                    <p class="episode_resume"></p>
                    <p class="dato"></p>
                </div>
            </article>

            <!-- episode-liste -->
            <section id="episoder_section"></section>

        </main>

        <template id="temEpi">
            <article>
                <img src="" alt="" class="epi_billede">
                <div class="podcast_baggrund">
                    <h2 class="epi_overskrift"></h2>
                    <h4 class="epi_dato"></h4>
                    <p class="epi_resume"></p>
                </div>
            </article>
        </template>

        <script>
            let episode;
            let episoder;
            //Henter den episode, der er blevet klikket på
            let aktuelEpisode = <?php echo get_the_ID() ?>;

            //Konstanten sættes til at lede efter podcasten der klikkes på
            const dbUrl = "http://sabineovesen.dk/radioloud/wp-json/wp/v2/episode/" + aktuelEpisode;

            //Henter ud fra slug, det tal som podcasten har + det id, som episoden har - der henvises dermed til podcastens underliggende episoder
            const episodeUrl = "http://sabineovesen.dk/radioloud/wp-json/wp/v2/episode?per_page=100" + aktuelEpisode;

            //container der indeholder sektionen hvor episoderne skal placeres
            const container = document.querySelector("#episoder_section");

            console.log("Alle variabler er kaldt");

            async function getJson() {
                console.log("async function bliver kaldt")

                const data = await fetch(dbUrl);
                episode = await data.json();

                const dataEpisode = await fetch(episodeUrl);
                episoder = await dataEpisode.json();
                console.log("async flere episoder hentet", episoder);

                visEpi();
                visEpisoder();
            }


            //Henter information fra json, og sætter dem ind i episode-sektion
            function visEpi() {
                console.log("visEpi bliver kaldt", episode);

                document.querySelector(".billede").src = episode.billede.guid;
                document.querySelector(".overskrift").textContent = episode.title.rendered;
                document.querySelector(".episode_resume").textContent = episode.episode_resume;
                document.querySelector(".dato").textContent = episode.dato;
            }

            function visEpisoder() {
                console.log("visEpisoder bliver kaldt", episoder);

                let episodeTemplate = document.querySelector("#temEpi");
                episoder.forEach(episode => {
                    console.log("Episode ID:", aktuelEpisode);


                    let podcastId1 = episode.horer_til_episode_1;
                    console.log("horer_til_episode1", episode.horer_til_episode_1);

                    let podcastId2 = episode.horer_til_episode_2;
                    console.log("horer_til_episode2", episode.horer_til_episode_2);

                    let podcastId3 = episode.horer_til_episode_3;
                    console.log("horer_til_episode3", episode.horer_til_episode_3);

                    let podcastId4 = episode.horer_til_episode_4;
                    console.log("horer_til_episode4", episode.horer_til_episode_4);


                    console.log("Alle horer_til_podcast variabler er indlæst");

                    if (podcastId1 == aktuelEpisode && podcastId2 == aktuelEpisode && podcastId3 == aktuelEpisode && podcastId4 == aktuelEpisode && podcastId5 == aktuelEpisode) {
                        console.log("If-sætning kører");

                        let klon = episodeTemplate.cloneNode(true).content;
                        klon.querySelector(".epi_billede").src = episode.billede.guid;
                        klon.querySelector(".epi_overskrift").textContent = episode.title.rendered;
                        klon.querySelector(".epi_dato").innerHTML = episode.dato;
                        klon.querySelector(".epi_resume").textContent = episode.episode_resume;

                        klon.querySelector("article").addEventListener("click", () => {
                            location.href = episode.link;
                        })

                        container.appendChild(klon);
                    }

                })

            }

            getJson();

        </script>

    </div>
    <!-- #primary -->

    <?php get_footer();?>
