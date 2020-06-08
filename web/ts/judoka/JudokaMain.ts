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


    }


}
