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
        const isClassDetailPage: boolean = !! document.querySelector('[data-action="class-detail"]');
        if (isClassAdminPage) {
            this.handleClassAdmin();
        }
        if (isClassDetailPage){
            this.handleClassDetail();
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
                switch (name) {
                    case "deleteClass":
                        e.preventDefault();
                        ClassMain.deleteClass(parseInt(classId));
                        break;
                }
            });
        });

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

    }

    private static handleClassDetail(): void {
        const allButtons: NodeListOf<Element> = document.querySelectorAll('button.classes');
        allButtons.forEach(function (button) {
            button.addEventListener('click', e => {
                const classId = button.getAttribute("data-id");
                const name = button.getAttribute("data-name");
                switch (name) {
                    case "deleteClass":
                        e.preventDefault();
                        ClassMain.deleteClass(parseInt(classId));
                        break;
                }
            });
        });

        // Buttons
        const modifyClass: HTMLButtonElement  = document.querySelector('button#modifyClass');
        const seeJudokas: HTMLButtonElement   = document.querySelector('button#seeJudokas');
        const addJudoka: HTMLButtonElement    = document.querySelector('button#addJudoka');
        const deleteClass: HTMLButtonElement  = document.querySelector('button#deleteClass');



        // Create form
        const modifyName: HTMLInputElement =      document.querySelector('#modify-name');
        const modifyMinAge: HTMLInputElement =    document.querySelector('#modify-minAge');
        const modifyMaxAge: HTMLInputElement =    document.querySelector('#modify-maxAge');
        const modifyStartTime: HTMLInputElement = document.querySelector('#modify-startTime');
        const modifyEndTime: HTMLInputElement =   document.querySelector('#modify-endTime');
        const modifyTrainer: HTMLSelectElement =  document.querySelector('#modify-trainer');
        const modifyCenter: HTMLSelectElement =   document.querySelector('#modify-center');
        const modifyMon: HTMLInputElement =       document.querySelector('#modify-l');
        const modifyTue: HTMLInputElement =       document.querySelector('#modify-m');
        const modifyWen: HTMLInputElement =       document.querySelector('#modify-x');
        const modifyThu: HTMLInputElement =       document.querySelector('#modify-j');
        const modifyFri: HTMLInputElement =       document.querySelector('#modify-v');
        const modifyDays: NodeListOf<Element> =      document.querySelectorAll('.modify-check');

        let days = 0;

        const editedClass: Classes = new Classes(
            modifyName.value,
            modifyTrainer.value,
            days,
            (modifyStartTime.value+'-'+modifyEndTime.value),
            parseInt(modifyMinAge.value),
            parseInt(modifyMaxAge.value)

        );

        days = ClassMain.dayChecked(
            modifyMon.checked,
            modifyTue.checked,
            modifyWen.checked,
            modifyThu.checked,
            modifyFri.checked);
        editedClass.days = days;
        editedClass.centerId = parseInt(modifyCenter.value);

        modifyName.addEventListener('keyup', () => {
            editedClass.name = modifyName.value;
            this.validateModifyClassButton(modifyClass, editedClass);

        });
        modifyMinAge.addEventListener('keyup', () => {
            editedClass.minAge = parseInt(modifyMinAge.value);
            this.validateModifyClassButton(modifyClass, editedClass);

        });
        modifyMaxAge.addEventListener('keyup', () => {
            editedClass.maxAge = parseInt(modifyMaxAge.value);
            this.validateModifyClassButton(modifyClass, editedClass);

        });
        modifyStartTime.addEventListener('keyup', () => {
            editedClass.schedule = modifyStartTime.value+'-'+modifyEndTime;
            this.validateModifyClassButton(modifyClass, editedClass);

        });
        modifyEndTime.addEventListener('keyup', () => {
            editedClass.schedule = modifyStartTime.value+'-'+modifyEndTime.value;
            this.validateModifyClassButton(modifyClass, editedClass);

        });

        modifyDays.forEach(function (day) {
            day.addEventListener('click', e => {
                days = ClassMain.dayChecked(
                    modifyMon.checked,
                    modifyTue.checked,
                    modifyWen.checked,
                    modifyThu.checked,
                    modifyFri.checked);
                editedClass.days = days;
            });

        });

        modifyTrainer.addEventListener('change', () => {
            editedClass.trainer = modifyTrainer.value ;
        });

        modifyCenter.addEventListener('change', () => {
            editedClass.centerId = parseInt(modifyCenter.value);
        });
        modifyClass.addEventListener('click', e => {
            e.preventDefault();
            const $classId = parseInt(modifyClass.getAttribute("data-id"));
            alert($classId);
            ClassMain.modifyClass(editedClass,$classId);
        });

    }



    private static validateCreateClassButton(button: HTMLButtonElement, classes: Classes): void {
        if (classes.validate()) {
            button.disabled = false;
            return;
        }
        button.disabled = true;
    }
    private static validateModifyClassButton(button: HTMLButtonElement, classes: Classes): void {
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
     * send the request to modify a class
     * @param classes
     * @param classId
     */
    private static modifyClass(classes: Classes, classId: number): void  {
        console.log(classes);
        ClassRequest.modifyClass(classes,classId).then(res => {
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
