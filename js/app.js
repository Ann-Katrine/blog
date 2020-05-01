var editor = new EditorJS({
    holder: "editorjs",

    tools: {
        header: Header,
        list: List,
        image: ImageTool,
        link: LinkTool,
        paragraph: Paragraph,
        quote: Quote,
        table: Table
    }
});

document.getElementById("create").onclick = function () {
    editor.save().then((outputData) => {
        console.log(outputData);

        let postData = {
            "title": document.getElementById("title").value,
            "location": document.getElementById("location").value,
            "content": outputData
        };

        console.log(postData);

        axios.post("/php/posts", postData)
            .then(function (response) {
                console.log(response);
            })
            .catch(function (error) {
                console.log(error);
            });
    })
        .catch(reason => {
            console.log(reason);
        });

    editor.save();
};
