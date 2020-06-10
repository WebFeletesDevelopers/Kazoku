import { Center } from "./Center";
import {CenterRequest} from "./CenterRequest";
import {ErrorHandler} from "../util/ErrorHandler";


/**
 * News processing class.
 */
export class CenterMain {
    /**
     * Main center handler.
     */
    public static handle(): void {
        const isCenterAdminPage: boolean = !! document.querySelector('[data-action="center-admin"]');
        const isCenterDetailPage: boolean = !! document.querySelector('[data-action="center-detail"]');
        if (isCenterAdminPage) {
            console.log(isCenterAdminPage);
            this.handleCenterAdmin();
        }
        if (isCenterDetailPage){
            this.handleCenterDetail();
        }
    }

    /**
     * Handle the center page
     */
    private static handleCenterAdmin(): void {
        const allButtons: NodeListOf<Element> = document.querySelectorAll('button.classes');
        allButtons.forEach(function (button) {
            button.addEventListener('click', e => {
                const classId = button.getAttribute("data-id");
                e.preventDefault();
                alert(classId);
            });
        })

        // Buttons
        const createCenter: HTMLButtonElement  = document.querySelector('button#createCenter');
        const centeDetail: HTMLButtonElement  = document.querySelector('button#centerDetail');
        const modifyCenter: HTMLButtonElement  = document.querySelector('button#modifyCenter');
        const seeClasses: HTMLButtonElement   = document.querySelector('button#seeClasses');
        const addClass: HTMLButtonElement    = document.querySelector('button#addClass');
        const deleteCenter: HTMLButtonElement  = document.querySelector('button#deleteCenter');
        const undefined: HTMLButtonElement    = document.querySelector('button#undefined');



        // Create form
        const createName: HTMLInputElement =      document.querySelector('#create-name');
        const createDirection: HTMLInputElement =    document.querySelector('#create-direction');
        const createZip: HTMLInputElement =    document.querySelector('#create-zip');
        const createPhone: HTMLInputElement = document.querySelector('#create-phone');

        const newCenter: Center = new Center(
            createName.value,
            createDirection.value,
            parseInt(createZip.value),
            parseInt(createPhone.value)
        );
        createName.addEventListener('keyup', () => {
            newCenter.name = createName.value;
            this.validateCreateCenterButton(createCenter, newCenter);
            


        });
        createDirection.addEventListener('keyup', () => {
            newCenter.direction = createDirection.value;
            this.validateCreateCenterButton(createCenter, newCenter);
            


        });
        createZip.addEventListener('keyup', () => {
            newCenter.zip = parseInt(createZip.value);
            this.validateCreateCenterButton(createCenter, newCenter);
            


        });
        createPhone.addEventListener('keyup', () => {
            newCenter.phone = parseInt(createPhone.value);
            this.validateCreateCenterButton(createCenter, newCenter);
            

        });

        createCenter.addEventListener('click', e => {
            e.preventDefault();
            CenterMain.createCenter(newCenter);
        });

    }

    /**
     * Handles center detail page
     */
    private static handleCenterDetail(): void {
        const allButtons: NodeListOf<Element> = document.querySelectorAll('button.classes');
        allButtons.forEach(function (button) {
            button.addEventListener('click', e => {
                const centerId = button.getAttribute("data-id");
                const name = button.getAttribute("data-name");

            });
        });

        // Buttons
        const modifyCenter: HTMLButtonElement  = document.querySelector('button#modifyCenter');
        const seeClasses: HTMLButtonElement   = document.querySelector('button#seeClasses');
        const addClass: HTMLButtonElement    = document.querySelector('button#addClass');
        const deleteCenter: HTMLButtonElement  = document.querySelector('button#deleteCenter');

        // modify form
        const modifyName: HTMLInputElement =      document.querySelector('#modify-name');
        const modifyDirection: HTMLInputElement =    document.querySelector('#modify-direction');
        const modifyZip: HTMLInputElement =    document.querySelector('#modify-zip');
        const modifyPhone: HTMLInputElement = document.querySelector('#modify-phone');

        const modCenter: Center = new Center(
            modifyName.value,
            modifyDirection.value,
            parseInt(modifyZip.value),
            parseInt(modifyPhone.value)
        );
        modifyName.addEventListener('keyup', () => {
            modCenter.name = modifyName.value;
            this.validateModifyCenterButton(modifyCenter, modCenter);
            


        });
        modifyDirection.addEventListener('keyup', () => {
            modCenter.direction = modifyDirection.value;
            this.validateModifyCenterButton(modifyCenter, modCenter);
            


        });
        modifyZip.addEventListener('keyup', () => {
            modCenter.zip = parseInt(modifyZip.value);
            this.validateModifyCenterButton(modifyCenter, modCenter);
            


        });
        modifyPhone.addEventListener('keyup', () => {
            modCenter.phone = parseInt(modifyPhone.value);
            this.validateModifyCenterButton(modifyCenter, modCenter);
            

        });

        modifyCenter.addEventListener('click', e => {
            e.preventDefault();
            const $centerId = parseInt(modifyCenter.getAttribute("data-id"));
            CenterMain.modifyCenter(modCenter,$centerId);
        });

    }

    private static validateModifyCenterButton(button: HTMLButtonElement, center: Center): void {
        if (center.validate()) {
            button.disabled = false;
            return;
        }
        button.disabled = true;
    }
    private static validateCreateCenterButton(button: HTMLButtonElement, center: Center): void {
        if (center.validate()) {
            button.disabled = false;
            return;
        }
        button.disabled = true;
    }
    /**
     * Creates a new center
     * @param centro
     */
    private static createCenter(centro: Center): void  {
        CenterRequest.addCenter(centro).then(res => {
            if (res.statusCode === 400 || res.statusCode === 500) {
                ErrorHandler.handle(res.message['message']);
            } else {
                document.location.replace('/centerAdmin');
            }
        });
    }
    private static modifyCenter(centro: Center, centerId: number): void  {
        CenterRequest.modifyCenter(centro,centerId).then(res => {
            if (res.statusCode === 400 || res.statusCode === 500) {
                ErrorHandler.handle(res.message['message']);
            } else {
                document.location.replace('/centerAdmin');
            }
        });
    }

}
