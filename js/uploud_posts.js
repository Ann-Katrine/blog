axios.get('/php/posts')
    .then(function (response) {
		let data = response.data;

        // Sorts the posts to contain the newest first.
        data.sort((a, b) => (parseInt(a.idBlogPost) < parseInt(b.idBlogPost)) ? 1 : -1);


		for(let i = 0; i < data.length; i++) {
            createPost(document.getElementById("posts"), data[i]);
        }

    })
    .catch(function (error) {
        console.log(error);
    });

