<?php


/* Custom tags */

function custom_taxonomies_init()
{
    // create a new taxonomy


    new_register_taxonomy(
        'style',
        'Style',
        'Styles',
        false,
        array(
            'new_song',
            'new_band'
        )
    );

    new_register_taxonomy(
        'member',
        'Member',
        'Members',
        false,
        array(
            'new_band'
        )
    );

    new_register_taxonomy(
        'past_member',
        'Past Member',
        'Past Members',
        false,
        array(
                'new_band'
            )
    );

    new_register_taxonomy(
        'difficulty',
        'Difficulty',
        "Difficulties",
        false,
        array(
            'new_song'
        )
    );
}
add_action('init', 'custom_taxonomies_init');
