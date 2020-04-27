class Editor {
    constructor(element, config) {
        if(element === undefined)
            throw new Error("Could not find the element!");

        this.parent = element;

        if(config["width"] !== undefined)
            this.width = config.width;

        if(config["height"] !== undefined)
            this.height = config.height;

        if(config["blocks"] !== undefined)
            this.blocks = config.blocks;

        this.blocks = {};

        this.contextMenu = document.getElementById("context-menu");
        this.menuState = 0;

        //TODO: Parse the config to get capabilities of the text editor.
    }

    createEditor() {
        this.container = document.createElement("DIV");

        this.parent.appendChild(this.container);

        this.setEventListeners();
    }

    setEventListeners() {
        this.container.addEventListener("contextmenu", this.onRightClick, false);
    }

    /**
     * Captures the right click event.
     */
    onRightClick(event) {

        console.log(event);

        return false;
    }

    save() {

    }

    getWidth() {
        return this.width;
    }

    getHeight() {
        return this.height;
    }

    toggleContextMenu() {
        if(this.menuState !== 1) {
            this.menuState = 1;
            this.contextMenu.classList.add("context-menu-active");
        }
        // else {
        //     this.menuState = 0;
        // }
    }

    /*************************
     *                       *
     *        HELPERS        *
     *                       *
     *************************/

    clickInsideElement() {

    }
}

export { Editor };
