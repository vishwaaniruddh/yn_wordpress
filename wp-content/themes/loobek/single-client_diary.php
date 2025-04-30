<?php get_header(); ?>

<div class="client-diary-single">
    <style>
        .row {
            display: -ms-flexbox;
            display: flex;
            -ms-flex-wrap: wrap;
            flex-wrap: wrap;
            margin-right: -15px;
            margin-left: -15px;
        }

        .col-md-6 {
            -ms-flex: 0 0 50%;
            flex: 0 0 50%;
            max-width: 50%;
            padding: 15px;
        }

        .client-diary-single {
            margin: 0 auto;
            padding: 20px;
        }

        .client-diary-content h1 {
            text-align: center;
            font-size: 2em;
            margin-bottom: 20px;
        }

        .client-diary-description {
            margin-bottom: 20px;
            line-height: 1.6;
        }

        .client-diary-images img {
            margin-bottom: 20px;
            display: block;
            margin: 0 auto;
            max-width: 100%;
            height: auto;
        }

        .client-diary-videos video {
            max-width: 100%;
            height: auto;
        }
    </style>

    <div class="container">
        <div class="row">
            <?php
            if (have_posts()) :
                while (have_posts()) : the_post();
                    $product_link = get_post_meta(get_the_ID(), '_client_diary_product_link', true);
                    $images = get_post_meta(get_the_ID(), '_client_diary_images', true);
                    ?>
                    <div class="client-diary-content">
                        <h1><?php the_title(); ?></h1>
                        <div class="client-diary-description">
                            <div class="row">
                                <div class="col-md-6">
                                    <?php the_post_thumbnail('medium'); ?>
                                </div>
                                <div class="col-md-6">
                                    <h6 style="text-align: center;"><?php the_content(); ?></h6>
                                </div>
                            </div>
                        </div>
                        <?php if (!empty($images)) : ?>
                            <div class="row">
                                <?php foreach ($images as $image) :
                                    $ext = pathinfo($image, PATHINFO_EXTENSION);
                                    if ($ext == 'mp4') :
                                        ?>
                                        <div class="col-md-6">
                                            <div class="client-diary-videos">
                                                <video controls>
                                                    <source src="<?php echo esc_url($image); ?>" type="video/mp4">
                                                    Your browser does not support the video tag.
                                                </video>
                                            </div>
                                        </div>
                                    <?php else : ?>
                                        <div class="col-md-6">
                                            <div class="client-diary-images">
                                                <img src="<?php echo esc_url($image); ?>" alt="Client Diary Image">
                                            </div>
                                        </div>
                                    <?php endif; ?>
                                <?php endforeach; ?>
                            </div>
                        <?php endif; ?>
                    </div>
                <?php
                endwhile;
            else :
                echo '<p>No client diary found.</p>';
            endif;
            ?>
        </div>
    </div>
</div>

<?php get_footer(); ?>
