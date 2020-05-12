module.exports = {
    getLastPosts: function(max)
    {

    },

    getPostFromUrl: function () {
        let postId = getUrlValue("post");

        axios.get('/php/posts/' + postId)
            .then(function (response) {
                let data = response.data;

                createPost(document.getElementById("post"), data);
            })
            .catch(function (error) {
                console.log(error);
            });
    },

    getUrlValue: function (key) {
        const urlParams = new URLSearchParams(window.location.search);

        return urlParams.get(key);
    }
};
