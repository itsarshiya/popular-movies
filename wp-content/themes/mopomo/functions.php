<?php

/**
 * mopomo functions and definitions
 *
 */

add_action('wp_enqueue_scripts', 'get_js');
function get_js() {
    wp_enqueue_script('custom', get_stylesheet_directory_uri().'/scripts.js');
}

function get_popular_movies()
{
	//get 20 most popular movies (api call)
	$response = wp_remote_get('https://api.themoviedb.org/3/movie/popular?api_key=f016cd23c8935f21b46ed635c2cdaee0&language=en-US&page=1');

	//init database connection
	global $wpdb;

	//set tablename with wp prefix
	$table_name = $wpdb->prefix . 'movies';

	//empty table before inserting new data
	$wpdb->query("TRUNCATE TABLE $table_name");

	//decode response to json object
	$json = json_decode($response['body']);

	//for each movie insert in database
	foreach ($json->results as $movie) {
		$wpdb->insert($table_name, array(
			'adult' => $movie->adult,
			'backdrop_path' => $movie->backdrop_path,

			//serialize array of genres
			'genre_ids' => serialize($movie->genre_ids),
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
		));
	}
}
add_action('get_popular_movies_cron', 'get_popular_movies');

function get_genres()
{
	$response = wp_remote_get('https://api.themoviedb.org/3/genre/movie/list?api_key=f016cd23c8935f21b46ed635c2cdaee0&language=en-US ');

	//decode response to json object
	$json = json_decode($response['body']);

	//for each genre insert in taxonomy
	foreach ($json->genres as $genre) {
		wp_insert_term($genre->name, 'movie_genre', array('description' => $genre->name, 'slug' => $genre->id));
	}
}
add_action('get_popular_movies_cron', 'get_genres');

//query the posts of wordpress with ordering taxonomy selection and pagination
function get_popular_movies_page($currentPage)
{
	$search_term = '';
	return new WP_Query(array(
		'post_type'      => 'movie',
		'posts_per_page' => 20,
		'tax_query'      => get_movies_in_taxonomy_term_query(),
		// 'movie_title_like' => 'fall',
		's' => $search_term,
		'meta_key' => 'popularity',
		'orderby' => 'meta_value_num',
		'order' => 'DESC',
		'paged' => $currentPage
	));
}

//query the posts of wordpress with ordering taxonomy selection and pagination
function get_movies_in_taxonomy_term_query()
{

	$selected_term = get_selected_taxonomy_dropdown_term();

	//check selected genre
	if ($selected_term) {
		return array(
			array(
				'taxonomy' => 'movie_genre',
				'field'    => 'term_id',
				'terms'    => $selected_term,
			),
		);
	}
	//get all if nothing is selected
	return array();
}

//get selected genre in dropdown
function get_selected_taxonomy_dropdown_term()
{
	return isset($_GET['movie_genre']) && $_GET['movie_genre'] ? sanitize_text_field($_GET['movie_genre']) : '';
}

// add_filter( 'movies_where', 'title_like_movies_where', 10, 2 );
// function title_like_movies_where( $where, $wp_query ) {
// 	global $wpdb;

// 	//set tablename with wp prefix
// 	$table_name = $wpdb->prefix . 'movies';
//     if ( $movie_title_like = $wp_query->get( 'movie_title_like' ) ) {
//         $where .= ' AND ' . $wpdb->$table_name . '.original_title LIKE \'%' . esc_sql( $wpdb->esc_like( $movie_title_like ) ) . '%\'';
//     }
//     return $where;
// }