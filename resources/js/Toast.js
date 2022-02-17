export default class Toast
{
    #container;
    #messages;

    /**
     * @param {object} messages 
     */
    constructor(messages)
    {
        this.#messages = messages;
        this.#container = document.getElementById("toast-container");
    }

    /**
     * @param {string} message 
     */
    show(message)
    {
        this.#run(message);
    }

    showErrorDefault()
    {
        this.#run(this.#messages.errorDefault);
    }

    /**
     * @param {string} message 
     */
    #run(message)
    {
        let elem = document.getElementById("toast");
        if (elem) {
            elem.remove();
        }

        let elemNew = document.createElement("div");
        elemNew.id = "toast";
        elemNew.classList.add("toast");
        elemNew.innerHTML = message;
        this.#container.append(elemNew);
    }
}
