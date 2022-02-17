export default class Layout
{
    #csrf;
    #urlLog;

    constructor()
    {
        this.#csrf = document.getElementsByName("csrf-token")[0].content;
        this.#urlLog = document.getElementById("log-url").value;
    }

    get csrf()
    {
        return this.#csrf;
    }

    get urlLog()
    {
        return this.#urlLog;
    }
}
