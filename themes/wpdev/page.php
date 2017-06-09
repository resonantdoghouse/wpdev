<?php get_header(); ?>

<div class="container">
    <div class="section">
    
        <div class="row">
            <div class="col s12 m9">
                
                <?php
                
                if( have_posts() ){
                    while( have_posts() ){
                        the_post();

                        ?>

                        <div class="row">
                            <div class="col s12 m12">

                                <div class="card">
                                
                                    <?php if( has_post_thumbnail(  ) ){ ?>
                                        <div class="card-image">
                                            <?php the_post_thumbnail( 'full' ); ?> 
                                        </div>
                                    <?php } ?>
                                    
                                    <div class="card-content">
                                        <span class="date-posted">
                                            <?php the_time( 'd M' ); ?>
                                        </span>
                                    
                                        <span class="card-title">
                                            <?php the_title(); ?>
                                        </span>
                                    

                                        
                                        <span class="time">Posted at: <?php the_time( 'g:i a' ); ?></span>

                                        <span class="tag"><?php the_category( ',' ); ?></span>

                                        <span class="post-author">
                                            By: <a href="<?php the_author_link(); ?>">
                                                    <?php the_author();?>
                                                </a>
                                        </span>

                                       <?php the_content(); ?>
                                      
                                       <?php the_tags(); ?>
                                       
                                    </div>
                                    
                                </div>
                            </div>
                        </div>

                       


                        <?php comments_template( ); ?>

                    <?php } ?>

                    
                <?php } ?>

                

            </div>
            <div class="col s12 m3">

                <?php get_sidebar(); ?>

            </div>
        </div>

    </div>
    
    
</div>



<?php get_footer(); ?>