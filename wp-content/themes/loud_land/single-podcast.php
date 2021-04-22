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
    .stor_visning_podcast {
        display: grid;
        grid-template-columns: 1fr 1fr;
    }

    .text_signle h2,
    p {
        color: white;
    }


    #episoder_section {
        text-align: center;
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
        max-width: 100vw;
        grid-gap: 2rem;
        padding-left: 10vw;
        padding-right: 10vw;
        overflow: hidden;
        position: relative;
    }

</style>


<div id="primary" class="content-area">
    <main id="main" class="site-main">

        <!-- single-view podcast -->
        <article>
            <div class="stor_visning_podcast">
                <div class="text_signle">
                    <h2 class="overskrift"></h2>
                    <p class="podcast_resume"></p>
                    <p class="vaerter"></p>
                </div>
                <div><img src="" alt="" class="billede"></div>
            </div>
        </article>

        <!-- episode-liste -->
        <section id="episoder_section">

        </section>


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
        let podcast;
        let episoder;

        //Henter den podcasts der klikeks på
        let aktuelPodcast = <?php echo get_the_ID() ?>;


        //Konstanten sættes til at lede efter podcasten der klikkes på
        const dbUrl = "http://sabineovesen.dk/radioloud/wp-json/wp/v2/podcast/" + aktuelPodcast;

        //Henter ud fra slug, det tal som podcasten har + det id, som episoden har - der henvises dermed til podcastens underliggende episoder
        const episodeUrl = "http://sabineovesen.dk/radioloud/wp-json/wp/v2/episode?per_page=100";

        //container der indeholder sektionen hvor episoderne skal placeres
        const container = document.querySelector("#episoder_section");

        console.log("Alle variabler er kaldt");


        async function getJson() {
            console.log("async function bliver kaldt")

            const data = await fetch(dbUrl);
            podcast = await data.json();

            const dataEpisode = await fetch(episodeUrl);
            episoder = await dataEpisode.json();
            console.log(episoder);

            visPodcasts();
            visEpisoder();
        }


        //Henter information fra json, og sætter dem ind i podcast-sektion
        function visPodcasts() {
            console.log("visPodcasts bliver kaldt", podcast);

            document.querySelector(".billede").src = podcast.billede.guid;
            document.querySelector(".overskrift").textContent = podcast.title.rendered;
            document.querySelector(".podcast_resume").textContent = podcast.podcast_resume;
            document.querySelector(".vaerter").textContent = `${"Værter: "}` + podcast.vaerter;
        }

        function visEpisoder() {
            console.log("visEpisoder bliver kaldt", episoder);

            let episodeTemplate = document.querySelector("#temEpi");
            episoder.forEach(episode => {
                console.log("Loop ID:", aktuelPodcast);

                console.log("horer_til_podcast bliver kaldt", episode.horer_til_podcast);

                let podcastId = episode.horer_til_podcast;

                console.log("podcastId", podcastId);

                if (podcastId == aktuelPodcast) {
                    console.log("Loop kører ID:", aktuelPodcast);

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

<?php get_sidebar();

get_footer();
