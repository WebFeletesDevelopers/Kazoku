import {Judoka} from "./Judoka";
import {JudokaRequest} from "./JudokaRequest";
import {ErrorHandler} from "../util/ErrorHandler";
import {ClassRequest} from "../class/ClassRequest";

/**
 * News processing class.
 */
export class JudokaMain {
    /**
     * Main news handler.
     */
    public static handle(): void {
        const isJudokasPage: boolean = !! document.querySelector('[data-action="judokas"]');
        const isJudokaDetailPage: boolean = !! document.querySelector('[data-action="judoka-detail"]');

        if (isJudokasPage) {
            this.handleJudokasPage();
        }
        if (isJudokaDetailPage){
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
        const tableButtons: NodeListOf<Element> =      document.querySelectorAll('.tablaBtn');
        tableButtons.forEach(function (button) {
            button.addEventListener('click', e => {
                const classId = button.getAttribute("data-id");
                const column = button.getAttribute("data-name");
                JudokaMain.sortTable(column);
            });

        });


    }

    private static handleJudokaDetailPage(): void {
        const updateButton: HTMLButtonElement = document.querySelector('button#updateData');

        updateButton.addEventListener('click', e => {
                const judokaId = updateButton.getAttribute("data-id");
                const name = updateButton.getAttribute("data-name");
                if(name == "updatedata"){
                    e.preventDefault();
                    JudokaMain.updateJudoka(parseInt(judokaId));
                };
        });
        const tableButtons: NodeListOf<Element> =      document.querySelectorAll('.tablaBtn');
        tableButtons.forEach(function (button) {
            button.addEventListener('click', e => {
                const classId = button.getAttribute("data-id");
                const column = button.getAttribute("data-name");
                JudokaMain.sortTable(column);
            });

        });


    }


    /**
     * delete a judoka from the database
     * @param judokaId
     */
    private static deleteJudoka(judokaId: number): void  {
        JudokaRequest.deleteJudoka(judokaId).then(res => {
            if (res.statusCode === 400 || res.statusCode === 500) {
                ErrorHandler.handle(res.message['message']);
            } else {
                document.location.replace('/judokas');
            }
        });
    }

    private static updateJudoka(judoka: judoka, judokaId: number): void  {
        JudokaRequest.deleteJudoka(judokaId).then(res => {
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
