(function($){
    $(document).ready(function(){
        $.ajax({
            url: cupcake_voting_data.base_url + 'votes',
            method: 'POST',
            // beforeSend: function (xhr) {
            //     xhr.setRequestHeader( 'X-WP-Nonce', cupcake_voting_data.nonce );
            // },
            data: {
                id: 521
            }
        });
    });
})(jQuery);