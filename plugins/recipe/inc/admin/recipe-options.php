<?php

function r_recipe_options_mb( $post ){

    $recipe_data              = get_post_meta( $post->ID, 'recipe_data', true );

    if(!$recipe_data){
        $recipe_data          =  array(
            'ingredients'     => '',
            'time'            => '',
            'utensils'        => '',
            'level'           => 'Beginner',
            'meal_type'       => ''
        );
    }

    ?>
    <div class="form-group">
        <label>Ingredients</label>
        <input type="text" class="form-control" name="r_inputIngredients"
               value="<?php echo $recipe_data['ingredients']; ?>">
    </div>
    <div class="form-group">
        <label>Cooking Time</label>
        <input type="text" class="form-control" name="r_inputTime"
               value="<?php echo $recipe_data['time']; ?>">
    </div>
    <div class="form-group">
        <label>Cooking Utensils</label>
        <input type="text" class="form-control" name="r_inputUtensils"
               value="<?php echo $recipe_data['utensils']; ?>">
    </div>
    <div class="form-group">
        <label>Cooking Level</label>
        <select class="form-control" name="r_inputLevel">
            <option value="Beginner">Beginner</option>
            <option value="Intermediate" <?php echo $recipe_data['level'] == "Intermediate" ? 'SELECTED' : ''; ?>>Intermediate</option>
            <option value="Expert" echo $recipe_data['level'] == "Expert" ? 'SELECTED' : '';>Expert</option>
        </select>
    </div>
    <div class="form-group">
        <label>Meal Type</label>
        <input type="text" class="form-control" name="r_inputMealType"
               value="<?php echo $recipe_data['meal_type']; ?>">
    </div>
    <?php
}
