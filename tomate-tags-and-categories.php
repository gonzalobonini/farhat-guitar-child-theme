<?php


/* Custom tags */

function custom_taxonomies_init() {
    // create a new taxonomy

    tomate_register_taxonomy('Style',
        'Styles',
        false,
        array(
            'tomate_song',
            'tomate_band'
        )
    );

    tomate_register_taxonomy('Member',
        'Members',
        false,
        array(
            'tomate_band'
        )
    );

    tomate_register_taxonomy('Past Member',
            'Past Members',
            false,
            array(
                'tomate_band'
            )
    );

    tomate_register_taxonomy('Difficulty',
        "Difficulties",
        false,
        array(
            'tomate_song'
        )
    );
}
add_action( 'init', 'custom_taxonomies_init' );
