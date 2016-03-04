<?php


/* Custom tags */

function custom_taxonomies_init() {
    // create a new taxonomy

    new_register_taxonomy('Style',
        'Styles',
        false,
        array(
            'new_song',
            'new_band'
        )
    );

    new_register_taxonomy('Member',
        'Members',
        false,
        array(
            'new_band'
        )
    );

    new_register_taxonomy('Past Member',
            'Past Members',
            false,
            array(
                'new_band'
            )
    );

    new_register_taxonomy('Difficulty',
        "Difficulties",
        false,
        array(
            'new_song'
        )
    );
}
add_action( 'init', 'custom_taxonomies_init' );
