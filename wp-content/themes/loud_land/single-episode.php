<?php
/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package Abletone
 */

get_header(); ?>

    <style>
    p {
            color: white;
            text-align: justify;
        }

        .billede {
            width: 90%;
        }

        .custom-header-content-wrapper {
            display: none;
        }

        .overskrift {
            padding-bottom: 1.2rem;
        }

        .afspil_knap {
            width: 30%;
        }

        .stor_visning_podcast {
            display: grid;
            grid-template-columns: 1fr 1fr;
            margin-bottom: 220px;
            margin-left: 5%;
            margin-right: 5%;
            grid-gap: 30px;
        }
        /*grid til venstre side af top sektionen */

        .text_signle {
            display: grid;
            grid-auto-rows: 1fr 0.1fr;
        }
        /*    texten på venstre siden af top sektionen bliver rykket ind */

        .top,
        .bund {
            margin: 10px;
        }

        .top h3,
        .podcast_resume,
        h2 {
            color: white;
        }

        .bund p {
            color: white;
            margin: 0;
            padding-bottom: 10px;
        }

        .aboner_knapper {
            display: block;
            padding-right: 30px;
            margin-bottom: 10%;
            cursor: pointer;
        }
    }

    </style>

    <div id="primary" class="content-area">
        <main id="main" class="site-main">
            <!-- single-view episode -->
            <article>
                <div class="stor_visning_podcast">
                    <div class="text_signle">
                        <div class="top">
                            <h3></h3>
                            <h2 class="overskrift"></h2>
                            <p class="episode_resume"></p>
                            <h3 class="dato"></h3>
                            <button class="afspil_knap">Afspil</button>
                        </div>



                        <div class="bund">
                            <p>Abonnér på:</p>
                            <div class="aboner_knapper">
                                <img src="http://sabineovesen.dk/radioloud/wp-content/uploads/2021/04/google_podcast.png" alt="google tjeneste">
                                <img src="http://sabineovesen.dk/radioloud/wp-content/uploads/2021/04/podimo.png" alt="streming tjeneste">
                                <img src="http://sabineovesen.dk/radioloud/wp-content/uploads/2021/04/network-1.png" alt="streming tjeneste">
                                <img src="http://sabineovesen.dk/radioloud/wp-content/uploads/2021/04/loud-logo.png" alt="streming tjeneste">
                                <img src="http://sabineovesen.dk/radioloud/wp-content/uploads/2021/04/apple.png" alt="streming tjeneste">
                                <img src="http://sabineovesen.dk/radioloud/wp-content/uploads/2021/04/spotity.png" alt="streming tjeneste">
                            </div>
                            <a href="javascript:history.back()" class="tilbage_knap"><img src="http://sabineovesen.dk/radioloud/wp-content/uploads/2021/04/Tilbage-knap.png" alt="tilbage knap"></a>
                        </div>

                    </div>

                    <div><img src="" alt="" class="billede"></div>

                </div>


            </article>

            <section>

            </section>

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
            console.log("aktuelEpisode", aktuelEpisode);

            //Konstanten sættes til at lede efter podcasten der klikkes på
            const dbUrl = "http://sabineovesen.dk/radioloud/wp-json/wp/v2/episode/" + aktuelEpisode;

            //Henter ud fra slug, det tal som podcasten har + det id, som episoden har - der henvises dermed til podcastens underliggende episoder
            const episodeUrl = "http://sabineovesen.dk/radioloud/wp-json/wp/v2/episode?per_page=100";

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
                document.querySelector(".overskrift").innerHTML = episode.title.rendered;
                document.querySelector(".episode_resume").innerHTML = episode.episode_resume;
                document.querySelector(".dato").textContent = `${"Udgivelsesdato: "}` + episode.dato;

                document.querySelector("a").addEventListener("click", tilbageKnap);

            }

            function tilbageKnap() {
                history.back();
            }


            function visEpisoder() {
                console.log("visEpisoder bliver kaldt", episoder);

                let episodeTemplate = document.querySelector("#temEpi");
                episoder.forEach(episode => {
                    console.log("Episode ID:", aktuelEpisode);


                    let podcastId = episode.horer_til_podcast;


                    if (podcastId == aktuelEpisode) {
                        console.log("If-sætning kører");

                        let klon = episodeTemplate.cloneNode(true).content;
                        klon.querySelector(".epi_billede").src = episode.billede.guid;
                        klon.querySelector(".epi_overskrift").innerHTML = episode.title.rendered;
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
