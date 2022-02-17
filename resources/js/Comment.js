import Form from "../../vendor/mldanshin/package-comment/resources/js/Form.js";

export default class Comment
{
    /**
     * @param {object} spinner 
     * @param {object} notifier 
     */
    constructor(spinner, notifier)
    {
        let form = new Form();
        document.addEventListener("beforeSubmitComment", () => {
            spinner.on();
        });
        document.addEventListener("afterSubmitComment", () => {
            spinner.off();
            notifier.show(form.message.content);
        });
    }
}
