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
        <div class="singular-content-wrap"></div> <!-- .singular-content-wrap -->
        <section>
            <h1 id="overskrift">Nye podcast episoder fra LOUD</h1>
            <div class="new_podcast"></div>
        </section>


    </main><!-- #main -->

    <template>
        <article>
            <img src="" alt="" class="billede">
            <h2></h2>
            <h4></h4>
            <p class="podcast_resume"></p>
            <button class="red_knap">Gå til podcast</button>
        </article>
    </template>




    <script>
        let podcasts;

        // url til wp rest api/database
        const url = "http://sabineovesen.dk/radioloud/wp-json/wp/v2/podcast?per_page=100";
        const dburl = "http://sabineovesen.dk/radioloud/wp-json/wp/v2/podcast/" + <?php echo get_the_ID()?>;



        // Her hentes json ind fra restdb, og sendes vider til funktionen loadJson
        async function getJson() {
            //Henter json og gemmer det som podcasts
            const data = await fetch(dbUrl);
            podcasts = await data.json();
            console.log(podcasts);

            loadJson();
        }




        async function loadJson() {
            const JsonData = await fetch(url);
            newEoisoder = await JsonData.json();

            console.log("loadJson");
            visNewPodcast();

        }



        //Her i funktioen genereres tre tilfeldeig podcast og sættes ind i HTML
        function visNewPodcast() {
            console.log("visNewPodcast");

            //Genererer et nyt array af tilfældige objekter fra det komplette array
            const other1 = newEoisoder[Math.floor(Math.random() * newEoisoder.length)];
            const other2 = newEoisoder[Math.floor(Math.random() * newEoisoder.length)];
            const other3 = newEoisoder[Math.floor(Math.random() * newEoisoder.length)];
            const randomEpisode = [other1, other2, other3];
            console.log(randomEpisode);

            randomEpisode.forEach(podcasts => {
                //Definerer konstanter til senere brug i kloningen af template
                const template = document.querySelector("template");
                const container = document.querySelector(".new_podcast");


                const klon = skabelon.cloneNode(true).content; //Her klones template og udfyldes med data fra de tilfældige objekter
                klon.querySelector(".billede").src = podcast.billede.guid;
                klon.querySelector("h2").textContent = podcast.title.rendered;
                klon.querySelector("h4").textContent = podcast.title.rendered;
                klon.querySelector(".podcast_resume").textContent = podcast.podcast_resume;


                // eventlisteners på hver enkelt artikel
                klon.querySelector(".red_knap").addEventListener("click", () => {
                    location.href = podcasts.link;
                })

                dest.appendChild(klon);
            })

            getJson();

        }

    </script>





</div><!-- #primary -->

<?php get_sidebar();

get_footer();
