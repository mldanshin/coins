export default class Messages
{
    #errorDefault;
    #errorForbidden;
    #confirmationDeletion;

    constructor()
    {
        this.#errorDefault = document.getElementById("message-error-default")?.textContent;
        this.#errorForbidden = document.getElementById("message-error-forbidden")?.textContent;
        this.#confirmationDeletion = document.getElementById("message-confirmation-deletion")?.textContent;
    }

    /**
     * @returns {string}
     */
    get errorDefault()
    {
        return this.#errorDefault;
    }

    /**
     * @returns {string}
     */
    get errorForbidden()
    {
        return this.#errorForbidden;
    }

    /**
    * @returns {string}
    */
    get confirmationDeletion()
    {
        return this.#confirmationDeletion;
    }
}
