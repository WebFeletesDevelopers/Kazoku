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
        if (isCenterAdminPage) {
            console.log(isCenterAdminPage);
            this.handleCenterAdmin();
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
            console.log(newCenter);


        });
        createDirection.addEventListener('keyup', () => {
            newCenter.direction = createDirection.value;
            this.validateCreateCenterButton(createCenter, newCenter);
            console.log(newCenter);


        });
        createZip.addEventListener('keyup', () => {
            newCenter.zip = parseInt(createZip.value);
            this.validateCreateCenterButton(createCenter, newCenter);
            console.log(newCenter);


        });
        createPhone.addEventListener('keyup', () => {
            newCenter.phone = parseInt(createPhone.value);
            this.validateCreateCenterButton(createCenter, newCenter);
            console.log(newCenter);

        });

        createCenter.addEventListener('click', e => {
            e.preventDefault();
            CenterMain.createCenter(newCenter);
        });

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
                document.location.replace('/classAdmin');
            }
        });
    }

}
