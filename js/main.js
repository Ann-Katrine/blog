function createPost(parent, postObject) {
    let post = document.createElement("div");
    post.classList.add("post");

    let header = document.createElement("h1");
    header.innerText = postObject.title;

    let tags = document.createElement("small");
    tags.innerText = "DUMMYDATA";

    let paragraph = document.createElement("p");
    paragraph.innerText = postObject.tekst;

    post.appendChild(header);
    post.appendChild(tags);
    post.appendChild(paragraph);

    parent.appendChild(post);
}
