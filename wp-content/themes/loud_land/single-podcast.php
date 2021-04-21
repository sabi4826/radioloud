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
                <img class="pic" src="" alt="">
                <div>
                    <h2></h2>
                    <p class="text"></p>
                    <p class="pris"></p>
                </div>
            </article>

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

        </script>

    </div>
    <!-- #primary -->

    <?php get_sidebar();

get_footer();
