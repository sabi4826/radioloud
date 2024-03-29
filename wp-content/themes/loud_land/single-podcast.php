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
    /* margen er tilføjet til første sektions bund*/

    .stor_visning_podcast {
        margin-bottom: 5rem;
    }

    .overskrift {
        padding-top: 7.2rem;
        padding-bottom: 1.2rem;
    }

    /*Fjerner WP-autogenerede overskrifter*/

    .custom-header-content-wrapper {
        display: none;
    }

    .epi-overskrift .epi_dato .epi_resume {
        padding-bottom: 1rem;
    }

    /*grid til venstre side af top sektionen */

    .text_signle {
        display: grid;
        grid-auto-rows: 1fr 0.1fr;
        background-image: url(http://sabineovesen.dk/radioloud/wp-content/uploads/2021/04/splach_single.png);
        background-size: cover;
    }

    /*    texten på venstre siden af top sektionen bliver rykket ind */

    .top,
    .bund {
        margin: 10px;
    }

    /*    top sektionens overskrifter og knapper*/

    .top h3,
    .podcast_resume,
    h2 {
        color: white;
    }

    .bund p {
        color: white;
        margin: 0;
        padding-bottom: 10px;
        text-align: justify;
    }

    .aboner_knapper {
        display: block;
        padding-right: 30px;
        margin-bottom: 10%;
    }

    /*styling af grid til episoderne og deres opsætning*/

    #episoder_section {
        text-align: center;
        margin-bottom: 200px;
    }

    .episode_grid .podcast_baggrund p {
        color: black;
        height: 2rem;
    }

    h1 .h1-episode {
        margin-bottom: 90px 0px 30px 0px;
    }

    /*  mobil Grid opsætningen og styling af; måske du også ville kunne lide */

    .maske_kan_du_lide {
        max-width: 1000px;
        margin: 0 auto;
    }

    .maske_kan_du_lide {
        text-align: center;
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
        max-width: 100vw;
        grid-gap: 2rem;
    }

    .single_podcast_kan_lide .podcast_baggrund p {
        color: black;
    }

    /*Størrelse på hvide bokse + margin mellem sektioner i mobiludgave*/

    .podcast_background .podcast_baggrund_fix {
        max-height: 70vh;
        margin-bottom: 1rem;
    }

    /*hvid tekst*/

    .vaerter p {
        color: white;
    }

    .vaerter {
        cursor: pointer;
    }

    .vaerter:hover {
        color: #DB083A;
    }

    .podcast_resume p {
        color: white;
    }

    p {
        text-align: justify;
    }

    .podcast_baggrund_fix {
        background-color: white;
        padding: 2.2rem;
        max-height: ;
        overflow: hidden;
        margin-bottom: 1rem;
    }

    .epi_billede {
        cursor: pointer;
        width: 100%;
    }

    @media (max-width: 950px) {

        /*Fjerner store podcastbillede fra mobil - virker ikke?*/
        .billede {
            display: none;
        }
    }

    @media (min-width: 950px) {

        /* Grid og styling til første sektion af siden, hvor den pågældende podcast er vist med uddybende text*/
        .stor_visning_podcast {
            display: grid;
            grid-template-columns: 1fr 1fr;
            margin-left: 5%;
            margin-right: 5%;
            grid-gap: 30px;
        }

        /*styling af grid til episoderne og deres opsætning*/
        .episode_grid {
            display: grid;
            grid-gap: 0.5rem;
            grid-template-columns: 0.5fr 1fr;
            margin: 0 auto;
            width: 80vw;
            margin-bottom: 20px;
        }

        /*  destop Grid opsætningen og styling af; måske du også ville kunne lide */
        .maske_kan_du_lide {
            overflow: hidden;
            position: relative;
            margin: 40px 20px;
            padding-left: 5vw;
            padding-right: 5vw;
        }

        .billede-mobil {
            display: none;
        }

        .podcast_baggrund_fix {
            margin-bottom: 0;
        }

        section h1 {
            margin-left: 6.5vw;
        }
    }

</style>


<div id="primary" class="content-area">
    <main id="main" class="site-main">

        <!-- single-view podcast -->
        <article>
            <div class="stor_visning_podcast">
                <div class="text_signle">
                    <div class="top">
                        <h2 class="overskrift"></h2>
                        <div><img src="" alt="" class="billede-mobil"></div>
                        <p class="podcast_resume"></p>
                        <h3 class="vaerter"></h3>
                    </div>
                    <div class="bund">
                        <p>Abonnér på:</p>
                        <div class="aboner_knapper">
                            <img src="http://sabineovesen.dk/radioloud/wp-content/uploads/2021/04/Intersection-4.png" alt="google tjeneste">
                            <img src="http://sabineovesen.dk/radioloud/wp-content/uploads/2021/04/Intersection-5.png" alt="streming tjeneste">
                            <img src="http://sabineovesen.dk/radioloud/wp-content/uploads/2021/04/Intersection-6.png" alt="streming tjeneste">
                            <img src="http://sabineovesen.dk/radioloud/wp-content/uploads/2021/04/Intersection-1.png" alt="streming tjeneste">
                            <img src="http://sabineovesen.dk/radioloud/wp-content/uploads/2021/04/Intersection-2.png" alt="streming tjeneste">
                            <img src="http://sabineovesen.dk/radioloud/wp-content/uploads/2021/04/Intersection-3.png" alt="streming tjeneste">
                        </div>
                        <a href="javascript:history.back()" class="tilbage_knap"><img src="http://sabineovesen.dk/radioloud/wp-content/uploads/2021/04/Tilbage-knap.png" alt="tilbage knap"></a>
                    </div>
                </div>
                <div><img src="" alt="" class="billede podcast_billede"></div>
            </div>
        </article>

        <!-- episode-liste -->
        <h1 class="h1-episode"></h1>
        <section id="episoder_section">
        </section>

        <section>
            <h1>Måske vil du også kunne lide</h1>
            <div class="maske_kan_du_lide"></div>
        </section>



    </main>

    <template id="temEpi">
        <article>
            <div class="episode_grid">
                <div><img src="" alt="" class="epi_billede"></div>
                <div class="podcast_baggrund_fix">
                    <h3 class="epi_overskrift"></h3>
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
                <h3></h3>
                <p></p>
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
            document.querySelector(".billede-mobil").src = podcast.billede.guid;
            document.querySelector(".overskrift").innerHTML = podcast.title.rendered;
            document.querySelector(".podcast_resume").innerHTML = podcast.podcast_resume;
            document.querySelector(".vaerter").innerHTML = `${"Værter: "}` + podcast.vaerter;


            document.querySelector(".vaerter").addEventListener("click", geaTilVeart)
            document.querySelector("a").addEventListener("click", tilbageKnap);
        }

        function geaTilVeart() {
            location.href = "http://sabineovesen.dk/radioloud/index.php/vaerter-siden/";
        }


        function tilbageKnap() {
            history.back();
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

                    document.querySelector(".h1-episode").innerHTML = "Episoder";


                    let klon = episodeTemplate.cloneNode(true).content;


                    klon.querySelector(".epi_billede").src = episode.billede.guid;
                    klon.querySelector(".epi_overskrift").innerHTML = episode.title.rendered;
                    klon.querySelector(".epi_dato").innerHTML = episode.dato;
                    klon.querySelector(".epi_resume").innerHTML = episode.episode_resume;
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
            const other4 = lideMoske[Math.floor(Math.random() * lideMoske.length)];
            const other5 = lideMoske[Math.floor(Math.random() * lideMoske.length)];
            const other6 = lideMoske[Math.floor(Math.random() * lideMoske.length)];
            const randomPodcast = [other1, other2, other3, other4, other5, other6];
            console.log(randomPodcast);

            randomPodcast.forEach(podcast => {
                //Definerer konstanter til senere brug i kloningen af template
                const template = document.querySelector("#single_podcast_kan_lide");
                const container = document.querySelector(".maske_kan_du_lide");


                const klon = template.cloneNode(true).content; //Her klones template og udfyldes med data fra de tilfældige objekter
                klon.querySelector(".billede").src = podcast.billede.guid;
                klon.querySelector("h3").textContent = podcast.title.rendered;
                klon.querySelector("p").textContent = podcast.podcast_resume;

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
