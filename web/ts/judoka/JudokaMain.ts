import {Judoka} from "./Judoka";
import {JudokaRequest} from "./JudokaRequest";
import {ErrorHandler} from "../util/ErrorHandler";

/**
 * News processing class.
 */
export class JudokaMain {
    /**
     * Main news handler.
     */
    public static handle(): void {
        const isJudokasPage: boolean = !!document.querySelector('[data-action="judokas"]');
        const isJudokaDetailPage: boolean = !!document.querySelector('[data-action="judoka-detail"]');

        if (isJudokasPage) {
            this.handleJudokasPage();
        }
        if (isJudokaDetailPage) {
            this.handleJudokaDetailPage();
        }
    }


    /**
     * Handle the news creator form.
     */
    private static handleJudokasPage(): void {




        const allButtons: NodeListOf<Element> = document.querySelectorAll('button.judokaBtn');
        allButtons.forEach(function (button) {
            button.addEventListener('click', e => {
                const judokaId = button.getAttribute("data-id");
                const name = button.getAttribute("data-name");
                switch (name) {
                    case "delete-judoka":
                        e.preventDefault();
                        JudokaMain.deleteJudoka(parseInt(judokaId));
                        break;
                }
            });
        });
        const tableButtons: NodeListOf<Element> = document.querySelectorAll('.tablaBtn');
        tableButtons.forEach(function (button) {
            button.addEventListener('click', e => {
                const classId = button.getAttribute("data-id");
                const column = button.getAttribute("data-name");
                JudokaMain.sortTable(column);
            });

        });


    }

    private static handleJudokaDetailPage(): void {
        const updateButton:         HTMLButtonElement = document.querySelector('button#updateData');
        const modifyName:           HTMLInputElement = document.querySelector('#mod-name');
        const modifyLastName1:      HTMLInputElement = document.querySelector('#mod-lastname1');
        const modifyLastName2:      HTMLInputElement = document.querySelector('#mod-lastname2');
        const modifyDni:            HTMLInputElement = document.querySelector('#mod-dni');
        const modifyFanjydaId:      HTMLInputElement = document.querySelector('#mod-fanjydaId');
        const modifyParentId:       HTMLSelectElement = document.querySelector('#mod-parent');
        const modifyBirthDate:      HTMLInputElement = document.querySelector('#mod-birthDate');
        const modifyEmail:          HTMLInputElement = document.querySelector('#mod-email');
        const modifyPhone:          HTMLSelectElement = document.querySelector('#mod-phone');
        const modifyIllness:        HTMLTextAreaElement = document.querySelector('#mod-illness');
        const modifyClassId:        HTMLSelectElement = document.querySelector('#mod-classId');
        const modifySex:            HTMLSelectElement = document.querySelector('#mod-sex');
        const modifyBeltId:         HTMLSelectElement = document.querySelector('#mod-beltId');
        const userId:               HTMLElement = document.querySelector('#userId');
        const updateDataButton:     HTMLButtonElement = document.querySelector('#updateData');
        const updateAddress:        HTMLButtonElement = document.querySelector('#mod-address');



        const editedJudoka: Judoka = new Judoka(
            modifyName.value,
            modifyLastName1.value,
            modifyLastName2.value,
            parseInt(modifySex.value),
            parseInt(modifyFanjydaId.value),
            modifyDni.value,
            modifyBirthDate.value,
            parseInt(modifyPhone.value),
            modifyEmail.value,
            modifyIllness.value,
            parseInt(userId.getAttribute("data-id")),
            parseInt(modifyParentId.value),
            parseInt(updateAddress.getAttribute("data-id")),
            parseInt(modifyBeltId.value),
            parseInt(modifyClassId.value)
        );
        modifyName.addEventListener('keyup', () => {
            editedJudoka.name = modifyName.value;
            this.validateModJudoka(updateDataButton, editedJudoka);
            console.log(editedJudoka);
        });
        modifyLastName1.addEventListener('keyup', () => {
            editedJudoka.lastName1 = modifyLastName1.value;
            this.validateModJudoka(updateDataButton, editedJudoka);
            console.log(editedJudoka);
        });
        modifyLastName2.addEventListener('keyup', () => {
            editedJudoka.lastName2 = modifyLastName2.value;
            this.validateModJudoka(updateDataButton, editedJudoka);
            console.log(editedJudoka);
        });
        modifyDni.addEventListener('keyup', () => {
            editedJudoka.dni = modifyDni.value;
            this.validateModJudoka(updateDataButton, editedJudoka);
            console.log(editedJudoka);
        });
        modifyEmail.addEventListener('keyup', () => {
            editedJudoka.email = modifyEmail.value;
            this.validateModJudoka(updateDataButton, editedJudoka);
            console.log(editedJudoka);
        });
        modifyIllness.addEventListener('keyup', () => {
            editedJudoka.illness = modifyIllness.value;
            this.validateModJudoka(updateDataButton, editedJudoka);
            console.log(editedJudoka);
        });
        modifyFanjydaId.addEventListener('keyup', () => {
            editedJudoka.idFanjyda = parseInt(modifyFanjydaId.value);
            this.validateModJudoka(updateDataButton, editedJudoka);
            console.log(editedJudoka);
        });
        modifyPhone.addEventListener('keyup', () => {
            editedJudoka.phone =   parseInt(modifyPhone.value),
                this.validateModJudoka(updateDataButton, editedJudoka);
            console.log(editedJudoka);
        });
        modifyBirthDate.addEventListener('keyup', () => {
            editedJudoka.birthDate = modifyBirthDate.value;
            this.validateModJudoka(updateDataButton, editedJudoka);
            console.log(editedJudoka);
        });
        modifyClassId.addEventListener('change', () => {
            editedJudoka.codClass = parseInt(modifyClassId.value);
            this.validateModJudoka(updateDataButton, editedJudoka);
            console.log(editedJudoka);
        });
        modifyParentId.addEventListener('change', () => {
            editedJudoka.codTutor = parseInt(modifyParentId.value);
            this.validateModJudoka(updateDataButton, editedJudoka);
            console.log(editedJudoka);
        });
        modifySex.addEventListener('change', () => {
            editedJudoka.sex = parseInt(modifySex.value);
            this.validateModJudoka(updateDataButton, editedJudoka);
            console.log(editedJudoka);
        });


        updateButton.addEventListener('click', e => {
            const judokaId = updateButton.getAttribute("data-id");
            const name = updateButton.getAttribute("data-name");
            alert(name);
            if (name == "updateData") {
                e.preventDefault();
                JudokaMain.updateJudoka(editedJudoka,parseInt(judokaId));
            }
            else if (name == "addJudoka"){
                e.preventDefault();
                JudokaMain.addJudoka(editedJudoka);
            }
            ;
        });
        const tableButtons: NodeListOf<Element> = document.querySelectorAll('.tablaBtn');
        tableButtons.forEach(function (button) {
            button.addEventListener('click', e => {
                const classId = button.getAttribute("data-id");
                const column = button.getAttribute("data-name");
                JudokaMain.sortTable(column);
            });

        });


    }

    /**
     * Validates judoka params
     * @param button
     * @param judoka
     */
    private static validateModJudoka(button: HTMLButtonElement, judoka: Judoka): void {
        if (judoka.validate()) {
            button.disabled = false;
            return;
        }
        else{
            button.disabled = true;
        }
    }

    /**
     * delete a judoka from the database
     * @param judokaId
     */
    private static deleteJudoka(judokaId: number): void {
        JudokaRequest.deleteJudoka(judokaId).then(res => {
            if (res.statusCode === 400 || res.statusCode === 500) {
                ErrorHandler.handle(res.message['message']);
            } else {
                document.location.replace('/judokas');
            }
        });
    }

    /**
     * Updates a judoka
     * @param judoka
     * @param judokaId
     */
    private static updateJudoka(judoka: Judoka, judokaId: number): void {
        JudokaRequest.modifyJudoka(judoka, judokaId).then(res => {
            if (res.statusCode === 400 || res.statusCode === 500) {
                ErrorHandler.handle(res.message['message']);
            } else {
                document.location.replace('/judokas');
            }
        });
    }

    /**
     * Adds a judoka to the database
     * @param judoka
     */
    private static addJudoka(judoka: Judoka): void {
        JudokaRequest.addJudoka(judoka).then(res => {
            if (res.statusCode === 400 || res.statusCode === 500) {
                ErrorHandler.handle(res.message['message']);
            } else {
                document.location.replace('/judokas');
            }
        });
    }

    /**
     * function that sorts a table by the column given
     * @param columna
     */
    private static sortTable(columna) {
        var table, rows, switching, i, x, y, shouldSwitch;
        table = document.getElementById("tablaAlumnos");
        switching = true;
        while (switching) {
            switching = false;
            rows = table.rows;
            for (i = 1; i < (rows.length - 2); i++) {
                shouldSwitch = false;
                x = rows[i].getElementsByTagName("TD")[columna];
                y = rows[i + 1].getElementsByTagName("TD")[columna];
                if (x.innerHTML.toLowerCase() > y.innerHTML.toLowerCase()) {
                    shouldSwitch = true;
                    break;
                }
            }
            if (shouldSwitch) {
                rows[i].parentNode.insertBefore(rows[i + 1], rows[i]);
                switching = true;
            }
        }
    }


}
