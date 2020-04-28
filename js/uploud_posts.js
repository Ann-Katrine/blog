axios.get('/php/hent_bolgpost.php', {params: {posts: 'getallpost'}})
    .then(function (response) {
        console.log(response);
    })
    .catch(function (error) {
        console.log(error);
    });
