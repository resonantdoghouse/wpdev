<?php

function r_filter_recipe_content( $content ){
    if( !is_singular( 'recipe' ) ){
        return $content;
    }

    global $post;
    $recipe_data                = get_post_meta( $post->ID, 'recipe_data', true );
    $recipe_html                = file_get_contents( 'recipe-template.php', true );
    $recipe_html                = str_replace( "INGREDIENT_PH", $recipe_data['ingredients'], $recipe_html );
    $recipe_html                = str_replace( "COOKING_TIME_PH", $recipe_data['time'], $recipe_html );
    $recipe_html                = str_replace( "UTENSILS_PH", $recipe_data['utensils'], $recipe_html );
    $recipe_html                = str_replace( "LEVEL_PH", $recipe_data['level'], $recipe_html );
    $recipe_html                = str_replace( "TYPE_PH", $recipe_data['meal_type'], $recipe_html );

    return $recipe_html . $content;
}
