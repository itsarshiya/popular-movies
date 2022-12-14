<!DOCTYPE html>
<html>

<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?php wp_title('|', true, 'right'); ?></title>
    <link rel="stylesheet" href="<?php echo esc_url(get_stylesheet_uri()); ?>" type="text/css" />
    <script type="text/javascript" src="https://livejs.com/live.js"></script>
    <?php wp_head(); ?>
</head>

<body>
    <div class="page">
        <?php get_header(); ?>
        <div class="container">

            <input class="search" type="text" id="input" onkeyup="search()" placeholder="search movies..">
            <ul id="list">
                <?php

                $currentPage = get_query_var('paged');

                $movies_in_taxonomy = get_popular_movies_page($currentPage);

                if ($movies_in_taxonomy->have_posts()) :

                    while ($movies_in_taxonomy->have_posts()) : $movies_in_taxonomy->the_post(); ?>

                        <li class="movie-card">
                            <h1 class="movie-title"><?php the_title(); ?></h1>
                            <p class="movie-overview"><?php echo apply_filters('the_content', $post->overview); ?></p>
                        </li>

                <?php endwhile;
                endif;
                ?>
            </ul>
            <?php

            echo "<div class='page-nav-container'>" . paginate_links(array(
                'total' => $movies_in_taxonomy->max_num_pages,
                'prev_text' => __('<'),
                'next_text' => __('>')
            )) . "</div>";

            ?>
            <?php wp_reset_postdata(); ?>
            <?php wp_footer(); ?>
        </div>
    </div>
</body>

</html>