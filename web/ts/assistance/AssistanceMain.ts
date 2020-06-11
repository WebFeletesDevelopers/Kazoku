import {Assistance} from "./Assistance";
import {AssistanceRequest} from "./AssistanceRequest";
import {ErrorHandler} from "../util/ErrorHandler";

/**
 * News processing class.
 */
export class AssistanceMain {
    /**
     * Main news handler.
     */
    public static handle(): void {
        const isAssistancePage: boolean = !! document.querySelector('[data-action="assistance"]');

        if (isAssistancePage) {
            this.handleAssistancePage();
        }
    }

    /**
     * Handle the news creator form.
     */
    private static handleAssistancePage(): void {
        const buttons: NodeListOf<Element> = document.querySelectorAll('input.marcar-falta');
        const clase: HTMLTableElement = document.querySelector('table#tablaAlumnos');
        const date: HTMLParagraphElement = document.querySelector('#title');
        const dateTime = date.getAttribute("data-name");
        const claseId = clase.getAttribute("data-id");
        const assistance: Assistance  = new Assistance(0,parseInt(claseId),dateTime);
        //NewsMain.validateCreateNewsButton(submitButton, news);
        buttons.forEach(function (button) {
            button.addEventListener('change', e => {
                const $userId = parseInt(button.getAttribute("data-id"));
                assistance.userId = $userId;
                AssistanceMain.send(assistance);
            });
        })
    }

    private static send(assistance: Assistance):void{
        AssistanceRequest.send(assistance).then(res => {
            if (res.statusCode === 400 || res.statusCode === 500) {
                ErrorHandler.handle(res.message['message']);
            }
        })
    }
}
