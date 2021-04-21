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
    .new_podcast,
    .det_hitter {
        max-width: 1000px;
        margin: 40px 20px;
    }

    .new_podcast,
    .det_hitter {
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
        <div class="singular-content-wrap"></div> <!-- .singular-content-wrap -->
        <section>
            <h1 id="overskrift">Nye podcast episoder fra LOUD</h1>
            <div class="new_podcast"></div>
        </section>


        <section>
            <h1 id="overskrift">#LOUDLand</h1>
            <div class="loud_land"></div>
        </section>



        <section>
            <h1 id="overskrift">DET HITTER</h1>
            <h2>Se de mest populære podcasts</h2>
            <div class="det_hitter"></div>
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






    <template id="forside_det_hitter">
        <article>
            <img src="" alt="" class="billede">
            <h2></h2>
            <p class="podcast_resume"></p>
            <button class="afspil_knap">Afspil</button>
            <button class="gea_til_podcast_knap">Gå til podcast</button>
        </article>
    </template>


    <script>
        let podcasts;

        // url til wp rest api/database
        const url = "http://sabineovesen.dk/radioloud/wp-json/wp/v2/podcast?per_page=100";




        async function loadJson() {
            const JsonData = await fetch(url);
            newEoisoder = await JsonData.json();
            console.log("loadJson", newEoisoder);
            visNewPodcast();
            visDetHitter();


        }
        loadJson();


        //Her i funktioen genereres tre tilfeldeig podcast og sættes ind i HTML under sektionen, nye podcasts episoder
        function visNewPodcast() {
            console.log("visNewPodcast");

            //Genererer et nyt array af tilfældige objekter fra det komplette array
            const other1 = newEoisoder[Math.floor(Math.random() * newEoisoder.length)];
            const other2 = newEoisoder[Math.floor(Math.random() * newEoisoder.length)];
            const other3 = newEoisoder[Math.floor(Math.random() * newEoisoder.length)];
            const randomEpisode = [other1, other2, other3];
            console.log(randomEpisode);

            randomEpisode.forEach(podcast => {
                //Definerer konstanter til senere brug i kloningen af template
                const template = document.querySelector("template");
                const container = document.querySelector(".new_podcast");


                const klon = template.cloneNode(true).content; //Her klones template og udfyldes med data fra de tilfældige objekter
                klon.querySelector(".billede").src = podcast.billede.guid;
                klon.querySelector("h2").textContent = podcast.title.rendered;
                klon.querySelector("h4").textContent = podcast.date_gmt;
                klon.querySelector(".podcast_resume").textContent = podcast.podcast_resume;
//                // eventlisteners på hver enkelt artikel
//                klon.querySelector("template").addEventListener("click", () => {
//                    location.href = podcast.link;
//                })

                container.appendChild(klon);
            })

        }


        function visDetHitter() {
            console.log("visDetHitter");

            //Genererer et nyt array af tilfældige objekter fra det komplette array
            const other1 = newEoisoder[Math.floor(Math.random() * newEoisoder.length)];
            const other2 = newEoisoder[Math.floor(Math.random() * newEoisoder.length)];
            const other3 = newEoisoder[Math.floor(Math.random() * newEoisoder.length)];
            const randomPodcast = [other1, other2, other3];
            console.log(randomPodcast);

            randomPodcast.forEach(podcast => {
                //Definerer konstanter til senere brug i kloningen af template
                const template = document.querySelector("#forside_det_hitter");
                const container = document.querySelector(".det_hitter");


                const klon = template.cloneNode(true).content; //Her klones template og udfyldes med data fra de tilfældige objekter
                klon.querySelector(".billede").src = podcast.billede.guid;
                klon.querySelector("h2").textContent = podcast.title.rendered;
                klon.querySelector(".podcast_resume").textContent = podcast.podcast_resume;


//                // eventlisteners på hver enkelt artikel
// klon.querySelector("#forside_det_hitter").addEventListener("click", () => {
// location.href = podcast.link;
// })

                container.appendChild(klon);
            })

        }

    </script>





</div><!-- #primary -->

<?php get_sidebar();

get_footer();
