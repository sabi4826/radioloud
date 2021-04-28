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
    }

    h1 {
        color: white;
        margin-bottom: 10px;
    }

    article {
        margin-top: 30px;
    }

    element.style {
        padding: 0;
    }

    @media (min-width: 950px) {
        article {
            display: grid;
            grid-template-columns: 1fr 1fr;
            grid-gap: 2rem;
        }
    }

</style>


<div id="primary" class="content-area">

    <main id="main" class="site-main">
        <a href="javascript:history.back()" class="tilbage_knap"><img src="http://sabineovesen.dk/radioloud/wp-content/uploads/2021/04/Tilbage-knap.png" alt="tilbage knap"></a>
        <section id="enkelt_vært"></section>
    </main><!-- #main -->

    <template>
        <article>
            <div class="tekst">
                <h1></h1>
                <p></p>
            </div>
            <img src="" alt="" class="vært-billede">
        </article>
    </template>

    <script>
        let vært;
        let aktuelVært = <?php echo get_the_ID() ?>;

        console.log("id på vært", aktuelVært);
        // url til wp rest api/database
        const restdbUrl = "http://sabineovesen.dk/radioloud/wp-json/wp/v2/vaert/" + aktuelVært;

        // container/destination til articles med en episode
        const destination = document.querySelector("#enkelt_vært");
        // select indhold af html skabelon (article)
        const skabelon = document.querySelector("template");

        async function loadJson() {
            const JsonData = await fetch(restdbUrl);
            vært = await JsonData.json();
            console.log("loadJson");
            visVært();
        }

        loadJson();

        //funktion, der viser episoden
        function visVært() {
            console.log("visVært-funktion");


            const klon = skabelon.cloneNode(true).content;
            klon.querySelector("img").src = vært.billede.guid;
            klon.querySelector("h1").textContent = vært.title.rendered;
            klon.querySelector("p").innerHTML = vært.vaert_resume;

            destination.appendChild(klon);

        }

        function tilbageKnap() {
            history.back();
        }

    </script>
</div><!-- #primary -->

<?php
get_footer();
?>
