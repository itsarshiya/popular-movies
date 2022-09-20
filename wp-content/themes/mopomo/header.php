<div class="header">
    <div class="box"><span></span></div>
    <div class="box">
        <div class="logo">
            <div class="logo-top">
                <div class="logo-mo">mo</div>
                <div class="logo-po">po</div>
                <div class="logo-mo2">mo</div>
            </div>
            <div class="logo-bottom">
                <div class="logo-bottom-text"><?php bloginfo('description'); ?></div>
            </div>
        </div>
    </div>
    <div class="box genre-link">
        <div>
            genres
        </div>
        <div class="tools-dropdown">
            <form id="tool-category-select" class="tool-category-select" method="get">

                <?php
                // Create and display the dropdown menu.
                wp_dropdown_categories(
                    array(
                        'orderby'         => 'NAME', // Order the items in the dropdown menu by their name.
                        'taxonomy'        => 'movie_genre', // Only include posts with the taxonomy of 'tools'.
                        'name'            => 'movie_genre', // Change this to the
                        'show_option_all' => 'all genres', // Text the dropdown will display when none of the options have been selected.
                        'selected'        => get_selected_taxonomy_dropdown_term(), // Set which option in the dropdown menu is the currently selected one.
                    )
                );
                ?>

                <input type="submit" value="View" />
            </form>

        </div>
    </div>
</div>