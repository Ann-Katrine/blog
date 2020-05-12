// const axios = require("./editorApp");
//
// import EditorJS from "./dist/editor";
//
// import Header from "./dist/header";
// import List from "./dist/list";
// import ImageTool from"./dist/image";
// import LinkTool from "./dist/link";
// import Paragraph from "./dist/paragraph";
// import Quote from "./dist/quote";
// import Table from "./dist/table";
//
// var editor = new EditorJS({
//     holder: "editorjs",
//
//     tools: {
//         header: Header,
//         list: List,
//         image: {
//             class: ImageTool,
//             config: {
//                 uploader: {
//                     uploadByFile(file) {
//                         let formData = new FormData();
//                         formData.append("file", file);
//
//                         return axios.post("/php/billed", formData, {
//                             headers: {
//                                 'Content-Type': 'multipart/form-data'
//                             }
//                         }).then(response => {
//                             return response.data;
//                         });
//                     }
//                 }
//             }
//         },
//         link: LinkTool,
//         paragraph: Paragraph,
//         quote: Quote,
//         table: Table
//     }
// });
//
// // TODO: Figure out if the delete statement can be removed?
// delete axios.defaults.headers.common["Content-Type"];
//
// // Sets the function to the 'create' element.
// document.getElementById("create").onclick = function () {
//     editor.save().then((outputData) => {
//
//         // Creates the POST body that should be sent along with the request.
//         let postData = {
//             "title": document.getElementById("title").value,
//             "location": document.getElementById("location").value,
//             "content": outputData
//         };
//
//         axios({
//             url: "https://ak.sebathefox.dk/php/posts",
//             method: "post",
//             data: postData,
//             // headers: {
//             //     "Content-Type": "application/json"
//             // }
//         })
//             .then(function (response) {
//                 console.log(response);
//             })
//             .catch(function (error) {
//                 console.log(error);
//             });
//
//         alert("Uploadede indlæg");
//     })
//         .catch(reason => {
//             console.log(reason);
//         });
// };
//
// module.exports = editor;
