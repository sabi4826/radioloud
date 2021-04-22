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
    #podcast_oversigt {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
        max-width: 100vw;
        grid-gap: 2rem;
        padding-left: 10vw;
        padding-right: 10vw;
        overflow: hidden;
        position: relative;
        margin: 40px 20px;
    }

</style>

<div id="primary" class="content-area">
    <main id="main" class="site-main">
        <h1 id="overskrift">Podcasts</h1>
        <nav id="filtrering">
            <button data-podcast="alle">Alle</button>
        </nav>
        <section id="podcast_oversigt"></section>
    </main><!-- #main -->

    <template>
        <article>
            <img src="" alt="" class="billede">
            <div class="podcast_baggrund">
                <h2></h2>
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
        // container/destination til articles med en podcast
        const dest = document.querySelector("#podcast_oversigt");
        // select indhold af html skabelon (article)
        const skabelon = document.querySelector("template");
        // url til wp rest api/database
        const url = "http://sabineovesen.dk/radioloud/wp-json/wp/v2/podcast?per_page=100";
        const cat_url = "http://sabineovesen.dk/radioloud/wp-json/wp/v2/categories";

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
                    klon.querySelector("h2").textContent = podcast.title.rendered;
                    klon.querySelector(".podcast_resume").textContent = podcast.podcast_resume;
                    klon.querySelector(".vaerter").textContent = `${"Værter: "}` + podcast.vaerter;

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

</div><!-- #primary -->

get_footer();
