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
    /*    styling til første sektion af siden, hvor den pågældende podcast er vist med uddybend text*/
    .stor_visning_podcast {
        display: grid;
        grid-template-columns: 1fr 1fr;
        margin-bottom: 250px;
    }

    .text_signle h2,
    p {
        color: white;
    }

    /*styling af grid til episoderne og deres opsætning*/
    #episoder_section {
        text-align: center;
    }

    .episode_grid {
        display: grid;
        grid-template-columns: 0.5fr 1fr;
        margin: 20px 100px;
    }

    .episode_grid .podcast_baggrund p {
        color: black;
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
        <h1>Episoder</h1>
        <section id="episoder_section"></section>

        <section>
            <h1>Måske du også ville kunne lide</h1>
            <div class="maske_kan_du_lide"></div>
        </section>



    </main>

    <template id="temEpi">
        <article>
            <div class="episode_grid">
                <div><img src="" alt="" class="epi_billede"></div>
                <div class="podcast_baggrund">
                    <h2 class="epi_overskrift"></h2>
                    <h4 class="epi_dato"></h4>
                    <p class="epi_resume"></p>
                </div>
            </div>
        </article>
    </template>


    <template id="single_podcast_kan_lide">
        <article>
            <img src="" alt="" class="billede">
            <div class="podcast_baggrund">

                <h2></h2>
                <p class="podcast_resume"></p>
            </div>
            <div class="doble_knap">
                <button class="afspil_knap">Afspil</button>
                <button class="gea_til_podcast_knap">Gå til podcast</button>
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

        // url til wp rest api/database for alle podcast
        const lideUrl = "http://sabineovesen.dk/radioloud/wp-json/wp/v2/podcast?per_page=100";



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

            const dataLide = await fetch(lideUrl);
            lideMoske = await dataLide.json();
            console.log(lideMoske);

            visPodcasts();
            visEpisoder();
            visMoskeLide();
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

        function visMoskeLide() {
            console.log("visMoskeLide");

            //Genererer et nyt array af tilfældige objekter fra det komplette array
            const other1 = lideMoske[Math.floor(Math.random() * lideMoske.length)];
            const other2 = lideMoske[Math.floor(Math.random() * lideMoske.length)];
            const other3 = lideMoske[Math.floor(Math.random() * lideMoske.length)];
            const randomPodcast = [other1, other2, other3];
            console.log(randomPodcast);

            randomPodcast.forEach(podcast => {
                //Definerer konstanter til senere brug i kloningen af template
                const template = document.querySelector("#single_podcast_kan_lide");
                const container = document.querySelector(".maske_kan_du_lide");


                const klon = template.cloneNode(true).content; //Her klones template og udfyldes med data fra de tilfældige objekter
                klon.querySelector(".billede").src = podcast.billede.guid;
                klon.querySelector("h2").textContent = podcast.title.rendered;
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


        getJson();

    </script>


</div>
<!-- #primary -->

<?php get_sidebar();

get_footer();
