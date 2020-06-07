import { Classes } from "./Classes";
import {ClassRequest} from "./ClassRequest";
import {ErrorHandler} from "../util/ErrorHandler";
import {News} from "../news/News";
import {NewsRequest} from "../news/NewsRequest";

/**
 * News processing class.
 */
export class ClassMain {
    /**
     * Main class handler.
     */
    public static handle(): void {
        const isClassAdminPage: boolean = !! document.querySelector('[data-action="class-admin"]');
        if (isClassAdminPage) {

            this.handleClassAdmin();
        }
    }

    /**
     * Handle the news creator form.
     */
    private static handleClassAdmin(): void {
        const allButtons: NodeListOf<Element> = document.querySelectorAll('button.classes');
        allButtons.forEach(function (button) {
            button.addEventListener('click', e => {
                const classId = button.getAttribute("data-id");
                const name = button.getAttribute("data-name");
                e.preventDefault();
                switch (name) {
                    case "deleteClass":
                        alert("Borrar");
                        ClassMain.deleteClass(parseInt(classId));
                        break;
                }
            });
        })

        // Buttons
        const createClass: HTMLButtonElement  = document.querySelector('button#createClass');
        const classDetail: HTMLButtonElement  = document.querySelector('button#classDetail');
        const modifyClass: HTMLButtonElement  = document.querySelector('button#modifyClass');
        const seeJudokas: HTMLButtonElement   = document.querySelector('button#seeJudokas');
        const addJudoka: HTMLButtonElement    = document.querySelector('button#addJudoka');
        const deleteClass: HTMLButtonElement  = document.querySelector('button#deleteClass');
        const undefined: HTMLButtonElement    = document.querySelector('button#undefined');



        // Create form
        const createName: HTMLInputElement =      document.querySelector('#create-name');
        const createMinAge: HTMLInputElement =    document.querySelector('#create-minAge');
        const createMaxAge: HTMLInputElement =    document.querySelector('#create-maxAge');
        const createStartTime: HTMLInputElement = document.querySelector('#create-startTime');
        const createEndTime: HTMLInputElement =   document.querySelector('#create-endTime');
        const createTrainer: HTMLSelectElement =  document.querySelector('#create-trainer');
        const createCenter: HTMLSelectElement =   document.querySelector('#create-center');
        const createMon: HTMLInputElement =       document.querySelector('#create-l');
        const createTue: HTMLInputElement =       document.querySelector('#create-m');
        const createWen: HTMLInputElement =       document.querySelector('#create-x');
        const createThu: HTMLInputElement =       document.querySelector('#create-j');
        const createFri: HTMLInputElement =       document.querySelector('#create-v');
        const createDays: NodeListOf<Element> =      document.querySelectorAll('.create-check');

        let days = 0;
        const newClass: Classes = new Classes(
            createName.value,
            createTrainer.value,
            days,
            (createStartTime.value+'-'+createEndTime.value),
            parseInt(createMinAge.value),
            parseInt(createMaxAge.value)

        );
        createName.addEventListener('keyup', () => {
            newClass.name = createName.value;
            this.validateCreateClassButton(createClass, newClass);

        });
        createMinAge.addEventListener('keyup', () => {
            newClass.minAge = parseInt(createMinAge.value);
            this.validateCreateClassButton(createClass, newClass);

        });
        createMaxAge.addEventListener('keyup', () => {
            newClass.maxAge = parseInt(createMaxAge.value);
            this.validateCreateClassButton(createClass, newClass);

        });
        createStartTime.addEventListener('keyup', () => {
            newClass.schedule = createStartTime.value+'-'+createEndTime;
            this.validateCreateClassButton(createClass, newClass);

        });
        createEndTime.addEventListener('keyup', () => {
            newClass.schedule = createStartTime.value+'-'+createEndTime.value;
            this.validateCreateClassButton(createClass, newClass);

        });

        createDays.forEach(function (day) {
            day.addEventListener('click', e => {
                 days = ClassMain.dayChecked(
                    createMon.checked,
                    createTue.checked,
                    createWen.checked,
                    createThu.checked,
                    createFri.checked);
                newClass.days = days;
            });

        });

        createTrainer.addEventListener('change', () => {
            newClass.trainer = createTrainer.value ;
        });

        createCenter.addEventListener('change', () => {
            newClass.centerId = parseInt(createCenter.value);
        });
        createClass.addEventListener('click', e => {
            e.preventDefault();
            ClassMain.createClass(newClass);
        });

        deleteClass.addEventListener('click', e => {
            e.preventDefault();
            ClassMain.createClass(newClass);
        });
    }

    private static validateCreateClassButton(button: HTMLButtonElement, classes: Classes): void {
        if (classes.validate()) {
            button.disabled = false;
            return;
        }
        button.disabled = true;
    }

    /**
     * Returns the days that are gonna be classes converted.
     * @param mon
     * @param tus
     * @param wen
     * @param thu
     * @param fri
     */
    private static dayChecked(mon: boolean, tus: boolean, wen: boolean, thu: boolean, fri: boolean): number{
        var result = 0;
        if(mon){
            result +=1;
        }
        if(tus){
            result +=2;
        }
        if(wen){
            result +=4;
        }
        if(thu){
            result +=8;
        }
        if(fri){
            result +=16;
        }
        return  result;
    }

    /**
     * send the request to add a class
     * @param classes
     */
    private static createClass(classes: Classes): void  {
        console.log(classes);
        ClassRequest.addClass(classes).then(res => {
            if (res.statusCode === 400 || res.statusCode === 500) {
                ErrorHandler.handle(res.message['message']);
            } else {
                document.location.replace('/classAdmin');
            }
        });
    }

    /**
     * send the request to delete a class
     * @param classId
     */
    private static deleteClass(classId: number): void  {
        ClassRequest.deleteClass(classId).then(res => {
            if (res.statusCode === 400 || res.statusCode === 500) {
                ErrorHandler.handle(res.message['message']);
            } else {
                document.location.replace('/classAdmin');
            }
        });
    }

}
