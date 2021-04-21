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

            <section id="podcast_oversigt1">
                <h1>Episoder</h1>
            </section>

            <!--NYT!!-->
            <template class="template1">
                <article>
                    <img src="" alt="" class="billede">
                    <h2></h2>
                    <p class="dato"></p>
                    <p class="episode_resume"></p>
                    <p class="vaerter"></p>
                </article>
            </template>


        </main>
        <!-- #main -->

        <script>
            let podcast;

            //Konstanten sættes til at lede efter "podcast" - herefter laves et echo-kald, hvor der beder om den pågældende podcasts' ID, alt efter hvilken der klikkes på
            const dbUrl = "http://sabineovesen.dk/radioloud/wp-json/wp/v2/podcast/" + <?php echo get_the_ID() ?>;


            async function getJson() {
                const data = await fetch(dbUrl);
                podcast = await data.json();
                visPodcasts();
            }


            function visPodcasts() {
                document.querySelector(".billede").src = podcast.billede.guid;
                document.querySelector("h2").textContent = podcast.title.rendered;
                document.querySelector(".podcast_resume").textContent = podcast.podcast_resume;
                document.querySelector(".vaerter").textContent = `${"Værter: "}` + podcast.vaerter;

            }

            getJson();

            //NYT!!!!!

            let podcasts1;
            let categories1;

            // container/destination til articles med en podcast
            const dest = document.querySelector("#podcast_oversigt1");
            // select indhold af html skabelon (article)
            const skabelon = document.querySelector("template1");
            // url til wp rest api/database
            const url = "http://sabineovesen.dk/radioloud/wp-json/wp/v2/podcast?per_page=100";
            const cat_url = "http://sabineovesen.dk/radioloud/wp-json/wp/v2/categories";

            async function loadJson() {
                const JsonData = await fetch(url);
                const catData = await fetch(cat_url);
                podcasts1 = await JsonData.json();
                categories1 = await catData.json();
                console.log("loadJson");
                visPodcasts1();
            }

            //funktion, der viser podcasts i liste view
            function visPodcasts1() {
                console.log("visPodcasts-funktion");
                // ryd ekst. indhold:
                dest.innerHTML = "";

                // loop igennem json (lande)
                podcasts1.forEach(podcast => {

                    //if (filter == podcast.kategori || filter == "alle")

                    const klon = skabelon.cloneNode(true).content;
                    klon.querySelector(".billede").src = podcast.billede.guid;
                    klon.querySelector("h2").textContent = podcast.title.rendered;
                    klon.querySelector(".episode_resume").textContent = podcast.episode_resume;
                    klon.querySelector(".dato").textContent = podcast.dato;
                    klon.querySelector(".vaerter").textContent = `${"Værter: "}` + podcast.vaerter;

                    // eventlisteners på hver enkelt artikel
                    klon.querySelector("article").addEventListener("click", () => {
                        location.href = podcast.link;
                    })

                    dest.appendChild(klon);

                })
            }

            loadJson();

        </script>


    </div>
    <!-- #primary -->

    <?php get_sidebar();

get_footer();
