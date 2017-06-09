<form role="search" method="get" id="searchform" class="searchform row" action="<?php echo home_url( '/' ); ?>">
    <div class="input-field">
        <input type="text" class="validate" name="s" id="search" value="<?php the_search_query(); ?>">
        <label for="search">Search Query</label>
        <button type="submit" class="waves-effect btn blue-grey darken-1">
            Search
            <i class="material-icons right">search</i>
        </button>
    </div>
</form>