<?php
/*
Template Name: Client Diary
*/

get_header(); ?>


<style>
    .row {
    display: -ms-flexbox;
    display: flex;
    -ms-flex-wrap: wrap;
    flex-wrap: wrap;
    margin-right: -15px;
    margin-left: -15px;
}


    .col-sm-3, .col-md-3  {
        -ms-flex: 0 0 25% !important;
        flex: 0 0 25% !important;
        max-width: 25% !important;
    }

</style>
<div class="container">
    <div class="row">
        


    <?php
    $args = array(
        'post_type' => 'client_diary',
        'posts_per_page' => -1,
        'is_published'=>1
    );
    $client_diaries = new WP_Query( $args );

    if ( $client_diaries->have_posts() ) :
        while ( $client_diaries->have_posts() ) : $client_diaries->the_post();
            $product_link = get_post_meta( get_the_ID(), '_client_diary_product_link', true );
            ?>
            <div class="col-md-3">
                
            <div class="client-diary-item">
                <?php if ( has_post_thumbnail() ) : ?>
                    <a href="<?php echo esc_url( $product_link ); ?>">
                        <?php the_post_thumbnail( 'medium' ); ?>
                    </a>
                <?php endif; ?>
                <h4><?php the_title(); ?></h4>
            </div>
        
            </div>
            <?php
        endwhile;
        wp_reset_postdata();
    else :
        echo '<p>No client diaries found.</p>';
    endif;
    ?>

    </div>
    
</div>
<?php get_footer(); ?>
