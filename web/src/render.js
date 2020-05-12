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
                break;
            case "header":
                createHeader(paragraph, textObject.blocks[key]);
                break;
            case "list":
                createList(paragraph, textObject.blocks[key]);
                break;
            case "image":
                createImage(paragraph, textObject.blocks[key]);
                break;
        }
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
            break;
        case 2:
            header = document.createElement("h2");
            break;
        case 3:
            header = document.createElement("h3");
            break;
        case 4:
            header = document.createElement("h4");
            break;
        case 5:
            header = document.createElement("h5");
            break;
        case 6:
            header = document.createElement("h6");
            break;
    }

    header.innerText = data.text;

    parent.appendChild(header);
}

function createList(parent, block) {
    if(!block.type === "list")
        return;

    const data = block.data;

    let list;

    switch (data.style) {
        case "ordered":
            list = document.createElement("ol");
            break;
        default:
            list = document.createElement("ul");
    }

    for (let key in data.items) {
        let li = document.createElement("li");
        li.innerText = parseBr(data.items[key]);
        // console.log(data.items[i]);
        list.appendChild(li);
    }

    parent.appendChild(list);
}

function createImage(parent, block) {
    if(!block.type === "image")
        return;

    const data = block.data;

    let img = document.createElement("img");
    img.src = data.file.url;

    parent.appendChild(img);
}

function parseBr(string) {
    string.replace(/(<|&lt;)br\s*\/*(>|&gt;)/g, " ");

    return string;
}


module.exports = {
    createPost: createPost
};
