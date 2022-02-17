export default class Preset
{
    #sender;
    #notifier;
    #spinner;
    #button;

    /**
     * @param {object} sender 
     * @param {object} notifier 
     * @param {object} spinner 
     */
    constructor(sender, notifier, spinner)
    {
        this.#sender = sender;
        this.#notifier = notifier;
        this.#spinner = spinner;

        this.#button = document.getElementById("coin-preset-button");
        if (this.#button) {
            this.#button.addEventListener("click", this);
        }
    }

    handleEvent(event) {
        let elem = event.currentTarget;
        switch (event.type) {
            case "click":
                this.#submit();
                break;
        }
    }

    async #submit()
    {
        this.#spinner.on();

        try {
            let form = document.getElementById("coin-store");
            if (form) {
                let formData = new FormData();
                for (let item of form.elements) {
                    formData.append(item.getAttribute("name"), item.value);
                }
                let response = await this.#sender.sendRequest(this.#button.dataset.url, {method: 'POST', body: formData});
                let json = await response.json();
                this.#notifier.show(json.message);
            }
        } catch (error) {
            this.#sender.sendLog(error);
            this.#notifier.showErrorDefault();
        } finally {
            this.#spinner.off();
        }
    }
}
