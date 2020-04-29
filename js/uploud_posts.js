axios.get('/php/hent_posts.php', {params: {posts: 'getallpost'}})
    .then(function (response) {
        console.log(response.data);
		let data = response.data;
		document.getElementById("print").innerHTML = data[0].tekst;
    })
    .catch(function (error) {
        console.log(error);
    });