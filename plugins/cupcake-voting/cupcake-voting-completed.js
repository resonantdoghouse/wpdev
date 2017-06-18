(function($){
    $(document).ready(function(){
        // Uses 'one' to only allow one click
        $('.cupcake_vote').one('click', function(event){
            // TODO: Add in display output, spinner, or something
            event.preventDefault();

            // If they double click, don't have the link jump up the page
            $(this).on('click', function(event) { event.preventDefault(); });

            var postId = $(this).attr('data-post-id');
            var el = this;

            $.ajax({
                url: cupcake_voting_data.api_url + 'votes',
                method: 'POST',
                data: {
                    id: postId
                }
            }).done(function(data) {
                $(el).replaceWith(cupcake_voting_data.success_message);
                $('#vote-count-' + postId).text(data);
            }).fail(function(jqXHR, textStatus, errorThrown) {
                if ('undefined' != typeof jqXHR.responseJSON.message) {
                    $(el).replaceWith(jqXHR.responseJSON.message);
                    return;
                }
                $(el).replaceWith(cupcake_voting_data.error_message);
            });
        });
    });
})(jQuery);