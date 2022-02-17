"use strict";

export default class Offcanvas
{
    constructor()
    {
        document.querySelectorAll(".collapse-button-show")
            .forEach((item) => item.addEventListener("click", this.#show));
        document.querySelectorAll(".collapse-button-close")
            .forEach((item) => item.addEventListener("click", this.#hide));
    }

    #show(event)
    {
        let idTarget = event.currentTarget.dataset.target;
        document.getElementById(idTarget).classList.remove("collapsing");
        document.getElementById(idTarget).classList.add("collapse-show");
    }

    #hide(event)
    {
        let idTarget = event.currentTarget.dataset.target;
        document.getElementById(idTarget).classList.remove("collapse-show");
        document.getElementById(idTarget).classList.add("collapsing");
    }
}
