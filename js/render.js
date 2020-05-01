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

    const textObject = JSON.parse(postObject.tekst);

    Object.keys(textObject.blocks).forEach(key => {

        switch (textObject.blocks[key].type) {
            case "paragraph":
                createParagraph(paragraph, textObject.blocks[key]);
        }

        console.log(key + ": " + textObject.blocks[key].type);
    });

    // Appends all elements to be childs of their parents.
    post.appendChild(header);
    post.appendChild(tags);
    post.appendChild(paragraph);

    parent.appendChild(post);
}

function createParagraph(parent, block) {
    if(!block.type === "paragraph")
        return;

    const data = block.data;

    let paragraph = document.createElement("p");

    paragraph.innerText = parseBr(data.text);

    parent.appendChild(paragraph);
}

function createHeader(parent, block) {
    if(!block.type === "header")
        return;

    const data = block.data;

    let header;

    switch (data.level) {
        case 1:
            header = document.createElement("h1");
    }
}

function parseBr(string) {
    string.replace("<br>", "\r\n");

    return string;
}
