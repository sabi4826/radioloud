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
    @media (min-width: 1000px) {

        /*GRID TIL TOP BANNER*/
        #top_tekst {
            display: grid;
            grid-template-columns: 1fr 1fr 1fr;
            margin-right: 5vw;
            margin-left: 5vw;
        }
    }

    /*#podcast_oversigt {
		display: grid;
		grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
		max-width: 100vw;
		grid-gap: 2rem;
		padding-left: 10vw;
		padding-right: 10vw;
		overflow: hidden;
		position: relative;
		margin: 40px 20px;
	}*/

    /*HVID TEKST*/
    #top_tekst p {
        color: white;
    }


    .col_1 {
        grid-column: 1/2;
    }

    .col_1 h2,
    h3 {
        color: white;
    }

    .col_1 img {}

    .col_2 {
        grid-column: 2/4;
    }

    .col_2 img {
        width: 100%;
    }

    #overskrift {
        margin-bottom: 5vw;
        margin-top: 0;
    }

</style>

<div id="primary" class="content-area">
    <main id="main" class="site-main">
        <section id="top_tekst">
            <h1 id="overskrift">LOUD LIVE</h1>
            <div class="col_1">
                <h2>Lige Nu:</h2>
                <h3>KONTUR</h3>
                <p>Lige nu kan du høre programmet "KONTUR", der handler om musik, og hvordan musikerne arbejder med inspiration og produktion. I denne episode kan du lytte til Pede B og Pilfinger.</p>
                <img class="play_knap" src="http://sabineovesen.dk/radioloud/wp-content/uploads/2021/04/Group-340.png" alt="play knap">
            </div>
            <div class="col_2">
                <img src="http://sabineovesen.dk/radioloud/wp-content/uploads/2021/04/Image-95.jpg" alt="Live podcasten">
            </div>
        </section>

        <nav id="filtrering"></nav>

        <section id="sende_oversigt"></section>
    </main><!-- #main -->

    <template>
        <article>
            <div><img src="" alt="" class="billede"></div>
            <div>
                <h3></h3>
                <h4></h4>
                <p class="episode_resume"></p>
            </div>
        </article>
    </template>



    <script>
        let episoder;
        //let podcasts;
        let categories;
        let filterEpisoder = "alle";


        // container/destination til articles med en episode
        const dest = document.querySelector("#sende_oversigt");

        // select indhold af html skabelon (article)
        const skabelon = document.querySelector("template");

        // url til wp rest api/database
        const url = "http://sabineovesen.dk/radioloud/wp-json/wp/v2/episode?per_page=100";
        const cat_url = "http://sabineovesen.dk/radioloud/wp-json/wp/v2/ugedag";

        async function loadJson() {
            const JsonData = await fetch(url);
            const catData = await fetch(cat_url);
            episoder = await JsonData.json();
            categories = await catData.json();
            console.log("loadJson");
            visEpisoder();
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
            filtrering();
        };

        function filtrering() {
            filterEpisoder = this.dataset.episode;
            console.log("filterEpisoder");
            visEpisoder();
        }

        //funktion, der viser episoder i liste view
        function visEpisoder() {
            console.log("visEpisoder-funktion");
            // ryd ekst. indhold:
            dest.innerHTML = "";

            // loop igennem json (lande)
            episoder.forEach(episode => {

                if (filter == podcast.kategori || filter == "alle")
                    //HVAD GØR DET FILTER OVENOVER???

                    if (filterEpisoder == "alle" || episode.categories.includes(parseInt(filterEpisoder))) {
                        const klon = skabelon.cloneNode(true).content;
                        klon.querySelector(".billede").src = episode.billede.guid;
                        klon.querySelector("h3").textContent = episode.title.rendered;
                        klon.querySelector(".episode_resume").textContent = episode.episode_resume;
                        klon.querySelector(".vaerter").textContent = `${"Værter: "}` + episode.vaerter;
                        console.log("klon i visEpisoder kører");

                        dest.appendChild(klon);
                    }
            })
        }

        loadJson();

    </script>

</div><!-- #primary -->

<?php get_sidebar();
get_footer();
