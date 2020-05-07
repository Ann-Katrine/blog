/**
 * @description Gets the number of latest uploaded posts.
 * @author Sebastian Davaris
 * @param max The max number of posts to show.
 */
function getLastPosts(max) {

}

function getPostFromUrl() {
    let postId = getUrlValue("post");

    axios.get('/php/posts/' + postId)
        .then(function (response) {
            let data = response.data;

            createPost(document.getElementById("post"), data);
        })
        .catch(function (error) {
            console.log(error);
        });
}

function getUrlValue(key) {
    const urlParams = new URLSearchParams(window.location.search);

    return urlParams.get(key);
}
