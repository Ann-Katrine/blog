// import 'normalize.css';
import './styles/style.scss';

// import axios from "./dist/axios.min";

// import EditorJS from "./dist/editor";
//
// import Header from "./dist/header";
// import List from "./dist/list";
// import ImageTool from"./dist/image";
// import LinkTool from "./dist/link";
// import Paragraph from "./dist/paragraph";
// import Quote from "./dist/quote";
// import Table from "./dist/table";

// import { getLastPosts, getPostFromUrl, getUrlValue } from "./helpers";

import axios, * as others from "./dist/axios.min";

import EditorJS from "./dist/editor";

import Header from "./dist/header";
import List from "./dist/list";
import ImageTool from"./dist/image";
import LinkTool from "./dist/link";
import Paragraph from "./dist/paragraph";
import Quote from "./dist/quote";
import Table from "./dist/table";

if(document.getElementById("editorjs") != undefined) {

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

                            console.log("Haj");

                            return axios.post("/php/billed", formData, {
                                headers: {
                                    'Content-Type': 'multipart/form-data'
                                }
                            }).then(response => {
                                console.log("Hej");
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

// TODO: Figure out if the delete statement can be removed?
    delete axios.defaults.headers.common["Content-Type"];
    console.log("YEET");
// Sets the function to the 'create' element.
    document.getElementById("create").onclick = function () {
        console.log("L69");

        editor.save().then((outputData) => {

            // Creates the POST body that should be sent along with the request.
            let postData = {
                "title": document.getElementById("title").value,
                "location": document.getElementById("location").value,
                "content": outputData
            };

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

}

import {createPost} from "./render";

if(document.getElementById("posts") != undefined) {

    axios.get('/php/posts')
        .then((response) => {
            let data = response.data;

            // Sorts the posts to contain the newest first.
            data.sort((a, b) => (parseInt(a.idBlogPost) < parseInt(b.idBlogPost)) ? 1 : -1);


            for (let i = 0; i < data.length; i++) {
                createPost(document.getElementById("posts"), data[i]);
            }

        })
        .catch(function (error) {
            console.log(error);
        });
}

function getPostFromUrl() {
    let postId = getUrlValue("post");

    axios.get('/php/post/onePost/' + postId)
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

if(document.getElementById("post") != undefined) {
    getPostFromUrl();
}


function updateImg(date, target) {

    let dte = document.getElementById(date);
    let tgt = document.getElementById(target);

    tgt.src = "https://ak.sebathefox.dk/php/post/follows/" + dte.value;
}

document.getElementById("search-date").onclick = function () {
    updateImg('date', 'stat-follows');
};
