export default class Photo
{
    #sender;
    #spinner;
    #notifier;

    /**
     * @param {object} sender 
     * @param {object} spinner 
     * @param {object} notifier 
     */
    constructor(sender, spinner, notifier)
    {
        this.#sender = sender;
        this.#spinner = spinner;
        this.#notifier = notifier;
        this.#addEventListenerAdd();
        this.#addEventListenerDelete();
    }

    handleEvent(event) {
        switch(event.type) {
            case "change":
                this.#addItem(event.currentTarget);
                break;
            case "click":
                this.#deleteItem(event.currentTarget);
                break;
        }
    }

    #addEventListenerAdd()
    {
        let buttons = document.querySelectorAll(".picture-file-add");
        for (let button of buttons) {
            button.addEventListener("change", this);
        }
    }
    
    #addEventListenerDelete()
    {
        let buttons = document.querySelectorAll(".picture-button-close");
        for (let button of buttons) {
            button.addEventListener("click", this);
        }
    }

    async #addItem(inputFile)
    {
        this.#spinner.on();
        try {
            if (!inputFile.files[0]) {
                return;
            }

            let url = inputFile.dataset.url;

            let formData = new FormData();
            formData.append(inputFile.getAttribute("name"), inputFile.files[0]);

            let response = await this.#sender.sendRequest(url, {method: 'POST', body: formData});
            if (response && response.status === 200) {
                let text = await response.text();
                this.#deleteById(inputFile.dataset.targetId);
                inputFile.insertAdjacentHTML("beforebegin", text);
                this.#addEventListenerDelete();
            }
        } catch (error) {
            this.#notifier.showErrorDefault();
            this.#sender.sendLog(error);
        } finally {
            inputFile.value = "";
            this.#spinner.off();
        }
    }

    #deleteItem(button)
    {
        try {
            button.parentNode.remove();
        } catch (error) {
            this.#notifier.showErrorDefault();
            this.#sender.sendLog(error);
        }
    }

    /**
     * 
     * @param {string} id 
     */
    #deleteById(id)
    {
        let elem = document.getElementById(id);
        if (elem) {
            elem.remove();
        }
    }
}
