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
        const isJudokasPage: boolean = !! document.querySelector('[data-action="judokas"]');
        const isJudokaPanelPage: boolean = !! document.querySelector('[data-action="judoka-panel"]');

        if (isJudokasPage) {
            this.handleJudokasPage();
        }
        if (isJudokaPanelPage){

        }
    }


    /**
     * Handle the news creator form.
     */
    private static handleJudokasPage(): void {
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
