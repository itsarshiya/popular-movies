<?php

/**
 * Plugin Name: Movie custom post type
 * Author: Arshiya
 * Description: add movies from database to movie cpt
 */
function movie_cpt()
{

    $labels = array(
        'name' => 'Movies',
        'singular_name' => 'Movie',
        'menu_name' => 'Movies',
        'name_admin_bar' => 'Movies',
        // 'archives' => __( 'Archivi Movie', 'Movie' ),
        // 'attributes' => __( 'Attributi delle Movie', 'Movie' ),
        // 'parent_item_colon' => __( 'Genitori Movie:', 'Movie' ),
        // 'all_items' => __( 'Tutti le Movie', 'Movie' ),
        // 'add_new_item' => __( 'Aggiungi nuova Movie', 'Movie' ),
        // 'add_new' => __( 'Nuovo', 'Movie' ),
        // 'new_item' => __( 'Movie redigere', 'Movie' ),
        // 'edit_item' => __( 'Modifica Movie', 'Movie' ),
        // 'update_item' => __( 'Aggiorna Movie', 'Movie' ),
        // 'view_item' => __( 'Visualizza Movie', 'Movie' ),
        // 'view_items' => __( 'Visualizza le Movie', 'Movie' ),
        // 'search_items' => __( 'Cerca Movie', 'Movie' ),
        // 'not_found' => __( 'Nessun Movie trovato.', 'Movie' ),
        // 'not_found_in_trash' => __( 'Nessun Movie trovato nel cestino.', 'Movie' ),
        // 'featured_image' => __( 'Immagine in evidenza', 'Movie' ),
        // 'set_featured_image' => __( 'Imposta immagine in evidenza', 'Movie' ),
        // 'remove_featured_image' => __( 'Rimuovi immagine in evidenza', 'Movie' ),
        // 'use_featured_image' => __( 'Usa come immagine in evidenza', 'Movie' ),
        // 'insert_into_item' => __( 'Inserisci nelle Movie', 'Movie' ),
        // 'uploaded_to_this_item' => __( 'Caricato in questo Movie', 'Movie' ),
        // 'items_list' => __( 'Elenco degli Movie', 'Movie' ),
        // 'items_list_navigation' => __( 'Navigazione elenco Movie', 'Movie' ),
        // 'filter_items_list' => __( 'Filtra elenco Movie', 'Movie' ),
    );
    $args = array(
        'label' => 'Movie',
        'description' => 'Movie',
        'labels' => $labels,
        'menu_icon' => 'dashicons-video-alt2',
        'supports' => array(),
        'taxonomies' => array('movie_genre'),
        'public' => true,
        'show_ui' => true,
        'show_in_menu' => true,
        'menu_position' => 5,
        'show_in_admin_bar' => true,
        'show_in_nav_menus' => true,
        'show_admin_column' => true,
        'can_export' => true,
        'has_archive' => true,
        'hierarchical' => false,
        'exclude_from_search' => false,
        'show_in_rest' => true,
        'publicly_queryable' => true,
        'capability_type' => 'post',
    );
    register_post_type('movie', $args);

    //register taxonomy
    register_taxonomy('movie_genre', 'movie', array(
        'hierarchical' => false,
        'label' => 'Genre',
        'show_ui' => true,
        'query_var' => true,
        'show_in_rest' => true,
        'show_admin_column' => true,
        'rewrite' => array('slug' => 'movie_genre')
    ));
}
add_action('init', 'movie_cpt', 0);

function insert_movies_movie_cpt()
{
    global $wpdb;
    $table_name = $wpdb->prefix . 'movies';
    $database_results = $wpdb->get_results("SELECT * FROM $table_name");

    $wpdb->query("TRUNCATE TABLE wp_posts");

    foreach ($database_results as $movie) {
        $movie_post = array(
            'post_title' => $movie->title,
            'meta_input' => array(
                'adult' => $movie->adult,
                'backdrop_path' => $movie->backdrop_path,
                'genre_ids' => $movie->genre_ids,
                'id' => $movie->id,
                'original_language' => $movie->original_language,
                'original_title' => $movie->original_title,
                'overview' => $movie->overview,
                'popularity' => $movie->popularity,
                'poster_path' => $movie->poster_path,
                'release_date' => $movie->release_date,
                'title' => $movie->title,
                'video' => $movie->video,
                'vote_average' => $movie->vote_average,
                'vote_count' => $movie->vote_count,
            ),
            // 'tax_input' => array('movie_genre' => unserialize($movie->genre_ids)),
            'post_type'   => 'movie',
            'post_status' => 'publish',
        );
        $post_id = wp_insert_post($movie_post);
        wp_set_object_terms($post_id,array_map('strval', unserialize($movie->genre_ids)), 'movie_genre');
        // wp_set_object_terms($post_id,unserialize($movie->genre_ids), 'movie_genre');
    }
}
add_action('wp', 'insert_movies_movie_cpt');
