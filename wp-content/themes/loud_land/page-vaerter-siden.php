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
    #vært_oversigt {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(300px, 10fr));
        max-width: 100vw;
        grid-gap: 3rem;
        overflow: hidden;
        position: relative;
    }

    img {
        width: 100%;
    }

    article {
        margin-bottom: 5vw;
        cursor: pointer;
        transition: 0.5s;
    }

    article:hover {
        transform: scale(1.1);
    }

    #overskrift {
        padding: 5vw 0 5vw 0;
    }

    h2 {
        color: white;
        margin: 1vw 0 0 0;
    }

    #jobAnnonce {}

    .job_container {
        display: grid;
        background-color: #FA5E5E;
        grid-template-columns: 1fr 1fr;
        margin-top: 10vw;
    }

    .col_tekst {
        text-align: center;
        display: inline-grid;
        padding: 5vh 0 5vh 0;
        grid-gap: 10px;
    }

    .col_tekst button {
        background-color: #53A27D;
        margin: 1vw auto;
        width: auto;
    }

    .col_tekst h1 {
        text-align: center;
    }

    .col_img {
        background-image: url(http://sabineovesen.dk/radioloud/wp-content/uploads/2021/04/Rectangle-31.jpg);
        background-size: cover;
    }

</style>

<div id="primary" class="content-area">
    <main id="main" class="site-main">

        <img src="http://sabineovesen.dk/radioloud/wp-content/uploads/2021/04/vearter-scaled.jpg" alt="Vært_splash">

        <h1 id="overskrift">Værter</h1>

        <section id="vært_oversigt"></section>

        <section id="jobAnnonce">
            <div class="job_container">
                <div class="col_tekst">
                    <h1>Job på LOUD</h1>
                    <h2>Vil du være en del af LOUD <br>send en ansøgning</h2>
                    <button>Ansøg nu</button>
                </div>
                <div class="col_img">
                </div>
            </div>
        </section>

    </main><!-- #main -->

    <template>
        <article>
            <img src="" alt="" class="billede">
            <h2 class="vært_navn"></h2>
        </article>
    </template>

    <script>
        let værter;

        // container/destination til articles med en vært
        const destination = document.querySelector("#vært_oversigt");

        // select indhold af html skabelon (article)
        const skabelon = document.querySelector("template");

        // url til wp rest api/database
        const vaertUrl = "http://sabineovesen.dk/radioloud/wp-json/wp/v2/vaert?per_page=100";

        async function loadJson() {
            const JsonData = await fetch(vaertUrl);
            værter = await JsonData.json();
            console.log("loadJson");
            visVærter();
        }

        /*
                function filtrering() {
                    filterPodcast = this.dataset.podcast;
                    console.log("filterPodcast");
                    visPodcasts();
                }*/

        //funktion, der viser værter i liste view
        function visVærter() {
            console.log("visVærter-funktion");

            // ryd ekst. indhold:
            destination.innerHTML = "";

            // loop igennem json (lande)
            værter.forEach(vært => {

                const klon = skabelon.cloneNode(true).content;
                klon.querySelector(".billede").src = vært.billede.guid;
                klon.querySelector("h2").textContent = vært.title.rendered;

                // eventlisteners på hver enkelt artikel
                klon.querySelector("article").addEventListener("click", () => {
                    location.href = vært.link;
                })
                destination.appendChild(klon);

            })
        }

        loadJson();

    </script>

</div><!-- #primary -->

<?php get_sidebar();

get_footer();
