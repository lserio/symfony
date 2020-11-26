$(document).ready(function() {

    $('.toggle-likes').on('click', function(e) {
        e.preventDefault();

        var $link = $(e.currentTarget);

        console.log($link);

        $.ajax({
            method: 'POST',
            url: $link.attr('href')
        }).done(function(data) {
            switch (data.action)
            {
                case 'like':
                    var number_of_likes_str =  $('.number-of-likes-' + data.id);
                    var number_of_likes = parseInt( number_of_likes_str.html()) + 1;
                    number_of_likes_str.html(number_of_likes);

                    $('.like-' + data.id + ' a').attr( "href", "/post/" + data.id + "/unlike" );
                    $('.like-' + data.id + ' i').removeClass( "fa-thumbs-o-up" ).addClass( "fa-thumbs-up" );

                    console.log('like')
    
                break;

                case 'unlike':
                    var number_of_likes_str =  $('.number-of-likes-' + data.id);
                    var number_of_likes = parseInt( number_of_likes_str.html()) - 1;
                    number_of_likes_str.html(number_of_likes);

                    $('.like-' + data.id + ' a').attr( "href", "/post/" + data.id + "/like" );
                    $('.like-' + data.id + ' i').removeClass( "fa-thumbs-up" ).addClass( "fa-thumbs-o-up" );

                    console.log('unlike')
                    
                break;

            }
            
        })
    });

});