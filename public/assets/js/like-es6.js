const toggle = document.querySelectorAll(".toggle-likes");

for (let i = 0; i < toggle.length; i++) {
    toggle[i].addEventListener("click", e => { 

        e.preventDefault();

        let link = e.currentTarget.href;
        let number_of_likes_str, number_of_likes;
    
        fetch(link, {'method': 'POST'})
        .then(result => {
            return result.json()
        })
        .then(data => {

            switch (data.action)
            {
                case 'like':
                    number_of_likes_str = document.querySelector('.number-of-likes-' + data.id);
                    number_of_likes = parseInt( number_of_likes_str.innerHTML) + 1;
                    number_of_likes_str.innerHTML = number_of_likes;
    
                    document.querySelector('.like-' + data.id + ' a').href = "/post/" + data.id + "/unlike";
    
                    document.querySelector('.like-' + data.id + ' i').classList.remove('fa-thumbs-o-up');    
                    document.querySelector('.like-' + data.id + ' i').classList.add('fa-thumbs-up');  
    
                    console.log('like')
    
                break;
    
                case 'unlike':
                    number_of_likes_str = document.querySelector('.number-of-likes-' + data.id);
                    number_of_likes = parseInt( number_of_likes_str.innerHTML) - 1;
                    number_of_likes_str.innerHTML = number_of_likes;
    
                    document.querySelector('.like-' + data.id + ' a').href = "/post/" + data.id + "/like";
    
                    document.querySelector('.like-' + data.id + ' i').classList.remove('fa-thumbs-up');    
                    document.querySelector('.like-' + data.id + ' i').classList.add('fa-thumbs-o-up');  
    
                    console.log('unlike')
                    
                break;
    
            }
        })
        .catch(error => {
            console.log(error)
        })

    });
}
