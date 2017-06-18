/* my changes */
(function($){
    $(document).ready(function(){
        $('.cupcake_vote').one('click', function(event){
            event.preventDefault();

            var postId = $(this).attr('data-post-id');
            var el = this;

            $.ajax({
                url: cupcake_voting_data.base_url + 'votes',
                method: 'POST',
                beforeSend: function(xhr) {
                    xhr.setRequestHeader( 'X-WP-Nonce', cupcake_voting_data.nonce );
                },
                data: {
                    id: postId
                }
            }).done(function(data){
                $(el).replaceWith(cupcake_voting_data.success_message);
                $('#vote-count-' + postId).text(data);
            }).fail(function(jqXHR, textStatus, errorThrown){
                if ('undefined' != typeof jqXHR.responseJSON.message) {
                    $(el).replaceWith(jqXHR.responseJSON.message);
                    return;
                }
                $(el).replaceWith(cupcake_voting_data.error_message);
            });
        })
    });
})(jQuery);