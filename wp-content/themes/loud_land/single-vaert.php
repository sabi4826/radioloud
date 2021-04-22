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

    h2 {
        color: white;
    }

    article {
        display: grid;
        grid-template-columns: 1fr 1fr;
    }

</style>


<div id="primary" class="content-area">
    <main id="main" class="site-main">
        <h1 id="overskrift">Enkelt vært</h1>
        <a href="http://sabineovesen.dk/radioloud/index.php/vaerter-siden/"><button class="tilbage">tilbage</button></a>
        <section id="enkelt_vært"></section>
    </main><!-- #main -->

    <template>
        <article>
            <div class="tekst">
                <h2></h2>
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
            klon.querySelector("h2").textContent = vært.title.rendered;
            klon.querySelector("p").textContent = vært.vaert_resume;

            destination.appendChild(klon);

        }

    </script>
</div><!-- #primary -->

<?php
get_footer();
?>
