/**
 * @description Creates a new Post DOM object to show on the web page.
 * @author Sebastian Davaris
 * @param parent The container that holds all of the posts.
 * @param postObject The JSON object that holds the data from the server.
 */
function createPost(parent, postObject) {

    // Creates the main post element.
    let post = document.createElement("div");
    post.classList.add("post");

    // Creates the header aka title.
    let header = document.createElement("h1");
    header.innerText = postObject.title;

    // Creates the tags element.
    let tags = document.createElement("small");
    tags.innerText = "DUMMYDATA";

    // Creates the paragraph holding all of the text.
    let paragraph = document.createElement("p");
    paragraph.innerText = postObject.tekst;

    // Appends all elements to be childs of their parents.
    post.appendChild(header);
    post.appendChild(tags);
    post.appendChild(paragraph);

    parent.appendChild(post);
}

/**
 * @description Gets the number of latest uploaded posts.
 * @author Sebastian Davaris
 * @param max The max number of posts to show.
 */
function getLastPosts(max) {

}

window.onload = function () {
    getLastPosts(5);
};
