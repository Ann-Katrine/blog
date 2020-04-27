const editor = new EditorJS({
    holderId: "editorjs",

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
