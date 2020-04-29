axios.get('/php/hent_posts.php', {params: {posts: 'getallpost'}})
    .then(function (response) {
        console.log(response.data);
		let data = response.data;
		// document.getElementById("print").innerHTML = data[0].tekst;

		for(let i = 0; i < data.length; i++) {
		    console.log(data[i]);
            createPost(document.getElementById("posts"), data[i]);
        }

    })
    .catch(function (error) {
        console.log(error);
    });

