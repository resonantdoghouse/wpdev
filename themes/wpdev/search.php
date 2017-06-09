<?php get_header(); ?>

<div class="container">
    <div class="section">

        <div class="row">
            <div class="col s12 m12">
                
                <h4>
                    <?php _e( 'Search', 'wpdev' ); ?>
                </h4>
                
                <?php get_search_form(); ?>

                <h5>
                    <?php _e( 'Search Results For:', 'wpdev' ); ?>
                    <span><?php the_search_query(); ?></span>
                </h5>


                <?php
                
                if( have_posts() ){
                    while( have_posts() ){
                        the_post();

                        ?>

                        <div class="row">
                            <div class="col s12 m12">

                                <div class="card">
                                
                                    <?php if( has_post_thumbnail(  ) ){ ?>
                                        <a href="<?php the_permalink(); ?>">
                                            <div class="card-image">
                                                <?php the_post_thumbnail( 'full' ); ?> 
                                            </div>
                                        </a>
                                    <?php } ?>
                                    
                                    <div class="card-content">
                                        <span class="date-posted">
                                            <?php the_time( 'd M' ); ?>
                                        </span>
                                        <a href="<?php the_permalink(); ?>">
                                            <span class="card-title">
                                                <?php the_title(); ?>
                                            </span>
                                        </a>

                                        
                                        <span class="time">Posted at: <?php the_time( 'g:i a' ); ?></span>

                                        <span class="tag"><?php the_category( ',' ); ?></span>

                                        <span class="post-author">
                                            By: <a href="<?php the_author_link(); ?>">
                                                    <?php the_author();?>
                                                </a>
                                        </span>

                                        <p class="post-excerpt">
                                            <?php the_excerpt(); ?>
                                        </p>

                                    </div>

                                    <div class="card-action">
                                        <a href="<?php the_permalink(); ?>">Read More</a>
                                        
                                        <a href="<?php the_permalink(); ?>/#comments">
                                            <?php comments_number( 'Add Comment', 'one comment', '% comments' ); ?>
                                        </a>
                                    </div>
                                    
                                </div>
                            </div>
                        </div>

                    <?php } ?>

                    <ul class="pagination center-align">
                        <li class="waves-effect blue-grey lighten-5">
                            <?php previous_posts_link( '<i class="material-icons">chevron_left</i>' ); ?>
                        </li>
                        <li class="waves-effect blue-grey lighten-5">
                            <?php next_posts_link( '<i class="material-icons">chevron_right</i>' ); ?>
                        </li>
                    </ul>
                <?php } ?>

                

            </div>
           
        </div>

    </div>
    
    
</div>



<?php get_footer(); ?>