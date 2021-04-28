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
        /* baggrunds bilelde */

        .podcast_splashbillede {
            background-image: url(http://sabineovesen.dk/radioloud/wp-content/uploads/2021/04/Podcasts_splash.png);
            background-size: cover;
            max-width: none;
            height: 30vh;
            width: auto;
            margin: 0px -0px 0px 0px;
        }
        /*    styling og placering af h1 i første sektion*/

        .podcast_splashbillede h1 {
            margin-top: 0;
            text-align: center;
        }

        #podcast_cat_overskrift h1,
        #lyt_vidre_section h1 {
            margin: 80px 20px 0px 20px;
            padding-left: 5vw;
            padding-right: 5vw;
        }
        /*    mobil grid udgaven på alle podcast oversigten*/

        #podcast_oversigt {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
            max-width: 100vw;
            grid-gap: 2rem;
        }

        #filtrering {
            text-align: center;
            margin-top: 30px;
        }
        /*    lyt vidre styling */

        .image-container {
            overflow-x: scroll;
            scroll-snap-type: x mandatory;
        }

        .image-container .figure_lyt {
            flex-basis: 90%;
            flex-shrink: 0;
            scroll-snap-align: center;
        }

        .image-container img {
            margin-right: 20px;
        }

        #lyt_vidre_section img {
            width: 100%;
            vertical-align: middle;
        }

        .image-container {
            display: flex;
            gap: 20px;
            padding: 20px;
        }

        .image-container figcaption {
            margin-top: 15px;
            color: white;
            font-family: 'Assistant', sans-serif;
        }
        /*    destop grid udgaven på alle podcast oversigten*/

        @media (min-width: 950px) {
            #podcast_oversigt {
                overflow: hidden;
                position: relative;
                margin: 40px 20px;
                padding-left: 5vw;
                padding-right: 5vw;
            }
            .filter,
            .filter_knapper {
                width: auto;
                margin: 2px;
            }
            /*    styling og placering af h1 i første sektion*/
            .podcast_splashbillede h1 {
                padding: 4% 5%;
                text-align: start;
            }
            .image-container {
                margin: 0px 20px;
                padding-left: 5vw;
                padding-right: 5vw;
            }
            .image-container .figure_lyt {
                flex-basis: 20%;
            }
        }
        /*FORSØG PÅ AT FÅ FILTRERING STICKY*/

        .sticky {
            position: fixed;
            top: 0;
            width: 100%;
        }

    </style>

    <div id="primary" class="content-area">



        <main id="main" class="site-main">
            <div class="podcast_splashbillede">
                <h1 id="overskrift">Podcasts</h1>
            </div>

            <nav id="filtrering">
                <button class="filter_knapper" data-podcast="alle">Alle</button>
            </nav>

            <section id="lyt_vidre_section">
                <h1>lyt videre</h1>
                <div class="image-container">
                    <figure class="figure_lyt">
                        <img src="http://sabineovesen.dk/radioloud/wp-content/uploads/2021/04/bare_sex-1.jpg" alt="bare sex">
                        <figcaption>Bare sex</figcaption>
                    </figure>

                    <figure class="figure_lyt">
                        <img src="http://sabineovesen.dk/radioloud/wp-content/uploads/2021/04/kontur.jpg" alt="kontur">
                        <figcaption>Kontur</figcaption>
                    </figure>
                    <figure class="figure_lyt">
                        <img src="http://sabineovesen.dk/radioloud/wp-content/uploads/2021/04/frekvens.jpg" alt="frekvens">
                        <figcaption>Frekvens</figcaption>
                    </figure>

                    <figure class="figure_lyt">
                        <img src="http://sabineovesen.dk/radioloud/wp-content/uploads/2021/04/live_fortiden.jpg" alt="live fra fortiden">
                        <figcaption>Live fra fortiden</figcaption>
                    </figure>

                    <figure class="figure_lyt">
                        <img src="http://sabineovesen.dk/radioloud/wp-content/uploads/2021/04/s_p_k-1.jpg" alt="sp.k">
                        <figcaption>S, P eller K</figcaption>
                    </figure>
                    <figure class="figure_lyt">
                        <img src="http://sabineovesen.dk/radioloud/wp-content/uploads/2021/04/i-faar-boern-jeg-faar-kemo.jpg" alt="i faa vores jeg faar kemo">
                        <figcaption>I får børn - jeg får kemo</figcaption>
                    </figure>
                </div>
            </section>

            <section id="podcast_cat_overskrift">
                <h1>Alle podcast</h1>
            </section>

            <section id="podcast_oversigt"></section>

        </main>
        <!-- #main -->


        <template>
            <article>
                <img src="" alt="" class="billede">
                <div class="podcast_baggrund">
                    <h3></h3>
                    <p class="podcast_resume"></p>
                    <p class="vaerter"></p>
                </div>
                <div class="doble_knap">
                    <button class="afspil_knap">Afspil</button>
                    <button class="gea_til_podcast_knap">Gå til podcast</button>
                </div>
            </article>
        </template>



        <script>
            let podcasts;
            let categories;
            let filterPodcast = "alle";

            // kalder overskriften som skal skifte alt efter katagori
            const header = document.querySelector("#podcast_cat_overskrift h1");


            // container/destination til articles med en podcast
            const dest = document.querySelector("#podcast_oversigt");
            // select indhold af html skabelon (article)
            const skabelon = document.querySelector("template");
            // url til wp rest api/database
            const url = "http://sabineovesen.dk/radioloud/wp-json/wp/v2/podcast?per_page=100";
            const cat_url = "http://sabineovesen.dk/radioloud/wp-json/wp/v2/categories";

            /*FORSØG PÅ AT FÅ FILTRERING STICKY*/
            window.onscroll = function() {
                stickyNav()
            };

            let navbar = document.querySelector("#filtrering");
            let sticky = navbar.offsetTop;

            function stickyNav() {
                if (window.pageYOffset >= sticky) {
                    navbar.classList.add("sticky")
                } else {
                    navbar.classList.remove("sticky");
                }
            }


            /*Filtrering af podcast-funktion begynder*/
            async function loadJson() {
                const JsonData = await fetch(url);
                const catData = await fetch(cat_url);
                podcasts = await JsonData.json();
                categories = await catData.json();
                console.log("loadJson");
                visPodcasts();
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
            };



            function filtrering() {
                filterPodcast = this.dataset.podcast;

                console.log("filterPodcast");
                visPodcasts();

                //skriften skifter alt efter valgte catagi
                header.textContent = this.textContent;
            }





            //funktion, der viser podcasts i liste view
            function visPodcasts() {
                console.log("visPodcasts-funktion");
                // ryd ekst. indhold:
                dest.innerHTML = "";

                // loop igennem json (lande)
                podcasts.forEach(podcast => {

                    //if (filter == podcast.kategori || filter == "alle")
                    if (filterPodcast == "alle" || podcast.categories.includes(parseInt(filterPodcast))) {

                        const klon = skabelon.cloneNode(true).content;
                        klon.querySelector(".billede").src = podcast.billede.guid;
                        klon.querySelector("h3").innerHTML = podcast.title.rendered;
                        klon.querySelector(".podcast_resume").innerHTML = podcast.podcast_resume;
                        klon.querySelector(".vaerter").innerHTML = `${"Værter: "}` + podcast.vaerter;

                        // eventlisteners på hver enkelt artikel
                        klon.querySelector(".afspil_knap").addEventListener("click", () => {
                            location.href = podcast.link;
                        })

                        klon.querySelector(".gea_til_podcast_knap").addEventListener("click", () => {
                            location.href = podcast.link;
                        })
                        dest.appendChild(klon);
                    }
                })
            }

            loadJson();

        </script>

    </div>
    <!-- #primary -->
    <?php get_sidebar();

get_footer();
