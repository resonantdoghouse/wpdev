<div id="comments">
<?php if ( have_comments() ){ ?>
<div class="comments-wrap">

    <h4>Comments</h4>

    <?php
    foreach($comments as $comment){
    ?>

    <h5>
        <a href="<?php comment_author_url(); ?>">
            <?php comment_author(); ?>
        </a> - <small><?php comment_date(); ?></small>
    </h5>

    <div class="comment-body">
        <p><?php comment_text(); ?></p>
    </div>

    <?php } ?>
</div>
<?php } ?>

<?php 

if( comments_open() ){
?>

<h4>Leave a Comment</h4>

<form action="<?php echo site_url('wp-comments-post.php'); ?>" method="post" id="commentform">
    <input type="hidden" name="comment_post_ID" value="<?php echo $post->ID; ?>" id="comment_post_ID">

    <div class="input-field">
        <input type="text" name="author" id="comment-author" class="validate">
        <label for="comment-author">Name / Alias (required)</label>
    </div>

    <div class="input-field">
        <input type="email" name="email" id="comment-email" class="validate">
        <label for="comment-email">Email (required, not shown)</label>
    </div>

    <div class="input-field">
        <input type="url" name="url" id="comment-website" class="validate">
        <label for="comment-website">Website (optional)</label>
    </div>

    <div class="input-field">
        <textarea type="text" name="comment" id="comment" class="materialize-textarea"></textarea>
        <label for="comment">Comment</label>
        
        <button type="submit" class="waves-effect btn blue-grey darken-1">Add Comment</button>
    </div>

</form>

<?php
} else {
    _e( 'Comments are closed', 'wpdev' );
}
?>

</div>