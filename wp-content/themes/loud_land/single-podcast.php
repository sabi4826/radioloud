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
            <article>
                <img src="" alt="" class="billede">
                <div>
                    <h2></h2>
                    <p class="podcast_resume"></p>
                    <p class="vaerter"></p>
                </div>
            </article>

            <section>
                <h1>Episoder</h1>
                <div class="episode-section"></div>
            </section>

        </main>
        <!-- #main -->

        <template id="episode-afsnit">
            <article>
                <img src="" alt="" class="episode-billede">
                <h2></h2>
                <h4></h4>
                <p></p>
            </article>
        </template>

        <script>
            let podcast;

            //Konstanten sættes til at lede efter "podcast" - herefter laves et echo-kald, hvor der beder om den pågældende podcasts' ID, alt efter hvilken der klikkes på
            const dbUrl = "http://sabineovesen.dk/radioloud/wp-json/wp/v2/podcast/" + <?php echo get_the_ID() ?>;

            //EPISODE
            const epiUrl = "http://sabineovesen.dk/radioloud/wp-json/wp/v2/episode?per_page=100";


            async function getJson() {
                const data = await fetch(dbUrl);
                podcast = await data.json();
                visPodcasts();


                //EPISODE
                const epiData = await fetch(epiUrl);
                episode = await epiData.json();
                visEpisoder();
            }


            function visPodcasts() {
                document.querySelector(".billede").src = podcast.billede.guid;
                document.querySelector("h2").textContent = podcast.title.rendered;
                document.querySelector(".podcast_resume").textContent = podcast.podcast_resume;
                document.querySelector(".vaerter").textContent = `${"Værter: "}` + podcast.vaerter;

            }

            function visEpisoder() {
                console.log("visEpisoder-funktion");

                // loop igennem json (epsidoer)
                episoder.forEach(episode => {

                    const skabelon = document.querySelector("template");
                    const dest = document.querySelector("#episode-afsnit");

                    const klon = skabelon.cloneNode(true).content;
                    klon.querySelector(".billede").src = episode.billede.guid;
                    klon.querySelector("h2").textContent = episode.title.rendered;
                    klon.querySelector("h4").textContent = episode.dato;
                    klon.querySelector("p").textContent = episode.episode_resume;


                    dest.appendChild(klon);

                })



            }

            getJson();

        </script>


    </div>
    <!-- #primary -->

    <?php get_sidebar();

get_footer();
