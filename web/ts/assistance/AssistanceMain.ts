import {Assistance} from "./Assistance";
import {AssistanceRequest} from "./AssistanceRequest";
import {ErrorHandler} from "../util/ErrorHandler";

/**
 * News processing class.
 */
export class AssistanceMain {
    private static search: any;

    /**
     * Main news handler.
     */
    public static handle(): void {
        const isAssistancePage: boolean = !!document.querySelector('[data-action="assistance"]');

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

        if (clase != null && date != null) {
            const dateTime = date.getAttribute("data-name");
            const claseId = clase.getAttribute("data-id");
            const assistance: Assistance = new Assistance(0, parseInt(claseId), dateTime);
            //NewsMain.validateCreateNewsButton(submitButton, news);
            buttons.forEach(function (button) {
                button.addEventListener('change', e => {
                    const $userId = parseInt(button.getAttribute("data-id"));
                    assistance.userId = $userId;
                    AssistanceMain.send(assistance);
                });
            })
        } else {
            const classSearch: HTMLSelectElement = document.querySelector('#allClasses');
            const dateSearch: HTMLInputElement = document.querySelector('#day');
            const buttonSearch: HTMLButtonElement = document.querySelector('#searchCombo');

            const searchClass: Assistance = new Assistance(0,parseInt(classSearch.value),dateSearch.value);

            classSearch.addEventListener('change', () => {
                searchClass.classId = parseInt(classSearch.value);
                this.validateSearch(searchClass, buttonSearch);

            });
            dateSearch.addEventListener('change', () => {
                searchClass.date = dateSearch.value;
                this.validateSearch(searchClass, buttonSearch);
            });
            buttonSearch.addEventListener('click', () => {
                this.newSearch(searchClass);
            });
        }

    }

    private static validateSearch(mySearch, button) {
        if (mySearch.validateSearch()) {
            button.disabled = false;
            return;
        } else {
            button.disabled = true;
        }
    }

    private static newSearch(searchClass) {
        document.location.replace('/assistance/' + searchClass.classId + '/' + Math.floor(new Date(searchClass.date).getTime() / 1000.0));
    }


    private static send(assistance: Assistance): void {
        AssistanceRequest.send(assistance).then(res => {
            if (res.statusCode === 400 || res.statusCode === 500) {
                ErrorHandler.handle(res.message['message']);
            }
        })
    }
}
