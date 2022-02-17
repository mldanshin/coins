export default class ResettingFilters
{
    constructor()
    {
        document.getElementById("filter-reset")
            .addEventListener("click", this.#reset)
    }

    #reset()
    {
        document.querySelectorAll(".filter-resettable-checkbox")
            .forEach((item) => item.checked = false);
        document.querySelectorAll(".filter-resettable-text")
            .forEach((item) => item.value = "");
    }
}