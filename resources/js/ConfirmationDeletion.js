"use strict";

export default class ConfirmationDeletion
{
    #messages;

    /**
     * @param {object} messages 
     */
    constructor(messages)
    {
        this.#messages = messages;
        document.querySelectorAll(".button-delete")
            .forEach((item) => item.addEventListener("click", this));
    }

    handleEvent(event) {
        switch(event.type) {
            case "click":
                this.#confirm(event);
                break;
        }
    }

    #confirm(event)
    {
        if (!confirm(this.#messages.confirmationDeletion)) {
            event.preventDefault();
        }
    }
}
