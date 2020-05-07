var editor = new EditorJS({
    holder: "editorjs",

    tools: {
        header: Header,
        list: List,
        image: {
            class: ImageTool,
            config: {
                uploader: {
                    uploadByFile(file) {
                        let formData = new FormData();
                        formData.append("file", file);

                        return axios.post("/php/billed", formData, {
                            headers: {
                                'Content-Type': 'multipart/form-data'
                            }
                        }).then(response => {
                            return response.data;
                        });
                    }
                }
            }
        },
        link: LinkTool,
        paragraph: Paragraph,
        quote: Quote,
        table: Table
    }
});

delete axios.defaults.headers.common["Content-Type"];

document.getElementById("create").onclick = function () {
    editor.save().then((outputData) => {
        console.log(outputData);

        let postData = {
            "title": document.getElementById("title").value,
            "location": document.getElementById("location").value,
            "content": outputData
        };

        console.log(postData);

        axios({
            url: "https://ak.sebathefox.dk/php/posts",
            method: "post",
            data: postData,
            // headers: {
            //     "Content-Type": "application/json"
            // }
        })
            .then(function (response) {
                console.log(response);
            })
            .catch(function (error) {
                console.log(error);
            });

        alert("Uploadede indlæg");
    })
        .catch(reason => {
            console.log(reason);
        });
};


