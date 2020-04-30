axios.get('/php/hent_posts.php', {params: {posts: 'getallpost'}})
    .then(function (response) {
        console.log(response.data);
		let data = response.data;

        // Sorts the posts to contain the newest first.
        data.sort((a, b) => (a.idBlogPost < b.idBlogPost) ? 1 : -1);

        console.log(data);

		for(let i = 0; i < data.length; i++) {
		    console.log(data[i]);
            createPost(document.getElementById("posts"), data[i]);
        }

    })
    .catch(function (error) {
        console.log(error);
    });

