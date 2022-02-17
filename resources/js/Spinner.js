export default class Spinner
{
    #elem;
    #lockScreen

    constructor()
    {
        this.#elem = document.getElementById("spinner");
        this.#lockScreen = document.getElementById("lock-screen");
    }

    /**
     * 
     * @param {boolean} isDisabledKeys 
     */
    on(isDisabledKeys = true) {
        this.#elem.classList.remove("spinner-hidden");
        this.#lockScreen.classList.remove("spinner-hidden");
        if (isDisabledKeys === true) {
            document.body.addEventListener("keydown", this.#handlerKeydown);
        }
    }

    off() {
        this.#elem.classList.add("spinner-hidden");
        this.#lockScreen.classList.add("spinner-hidden");
        document.body.removeEventListener("keydown", this.#handlerKeydown);
    }

    #handlerKeydown(event)
    {
        event.preventDefault();
    }
}
