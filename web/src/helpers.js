
export function getLastPosts(max)
{

}

export function getPostFromUrl() {
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

export function getUrlValue(key) {
    const urlParams = new URLSearchParams(window.location.search);

    return urlParams.get(key);
}
