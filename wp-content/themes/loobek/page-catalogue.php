<?php
/*
Template Name: Featured Images Page
*/

get_header(); ?>
<style>
    .featured-images-catalogue {
        text-align: center;
        padding: 50px;
        background-color: #f9f9f9;
    }

    .featured-images-catalogue h1 {
        font-size: 36px;
        margin-bottom: 30px;
        color: #333;
    }

    .image-gallery {
        display: grid;
        grid-template-columns: repeat(4, 1fr); /* Display 2 items in a row */
        gap: 30px;
    }

    .gallery-item {
        position: relative;
        overflow: hidden;
        border-radius: 10px;
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        transition: transform 0.3s ease, box-shadow 0.3s ease;
    }

    .gallery-item:hover {
        transform: scale(1.05);
        box-shadow: 0 6px 15px rgba(0, 0, 0, 0.2);
    }

    .gallery-item img {
        width: 100%;
        height: auto;
        display: block;
    }

    .gallery-item a {
        display: block;
        position: relative;
        z-index: 2;
    }

    .gallery-item .image-overlay {
        position: absolute;
        bottom: 0;
        left: 0;
        right: 0;
        height: 50%;
        background: rgba(0, 0, 0, 0.5);
        opacity: 0;
        transition: opacity 0.3s ease;
        z-index: 3;
    }

    .gallery-item:hover .image-overlay {
        opacity: 1;
    }

.gallery-item .image-overlay h2 {
    color: #fff;
    font-size: 17px;
    margin: 0;
    padding: 10px 20px;
    text-align: left;
    line-height: 23px;
}

    /* Media Queries for Responsive Design */
    @media (max-width: 768px) {
        .image-gallery {
            grid-template-columns: 1fr; /* Stack items on smaller screens */
        }
    }
</style>


<div class="featured-images-catalogue">
    <h1>Catalogues</h1>
    <div class="image-gallery">
        <?php
        // Query posts with content-type 'catalogue'
        $args = array(
            'post_type' => 'catalogue', // Custom content type
            'posts_per_page' => -1 // Fetch all posts
        );

        $catalogue_posts = new WP_Query($args);

        if ($catalogue_posts->have_posts()) :
            while ($catalogue_posts->have_posts()) : $catalogue_posts->the_post();
                // Check if the post has a featured image
                if (has_post_thumbnail()) :
                    ?>
                    <div class="gallery-item">
                        <a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>">
                            <?php the_post_thumbnail('large'); // Display large-sized featured image ?>
                            <div class="image-overlay">
                                <h2><?php the_title(); ?></h2>
                            </div>
                        </a>
                    </div>
                    <?php
                endif;
            endwhile;
        else :
            echo '<p>No catalogue posts found.</p>';
        endif;

        // Reset post data
        wp_reset_postdata();
        ?>
    </div>
</div>

<?php get_footer(); ?>
