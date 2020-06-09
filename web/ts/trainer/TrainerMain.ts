/**
 * Class for trainer functions.
 */
import { UserRequest } from "../user/UserRequest";

export class TrainerMain {
    /**
     * Main handler
     */
    public static handle(): void {
        const isConfirmPage = !! document.querySelector('[data-action="confirm-users-by-trainer"]');

        if (isConfirmPage) {
            TrainerMain.handleConfirm();
        }
    }

    /**
     * Confirmation page handler.
     * @private
     */
    private static handleConfirm(): void {
        const buttonsRow: NodeListOf<HTMLTableDataCellElement> = document.querySelectorAll('table tr .confirmation-buttons');

        buttonsRow.forEach((row: HTMLTableDataCellElement) => {
            const userId: number = parseInt(row.dataset.id);
            const confirmButton = row.querySelector('#confirmar');
            const deleteButton = row.querySelector('#borrar');

            confirmButton.addEventListener('click', e => {
                e.preventDefault();
                UserRequest.confirmByTrainer(userId).then(res => {
                    if (res.statusCode === 200) {
                        document.location.reload();
                    }
                });
            });

            deleteButton.addEventListener('click', e => {
                e.preventDefault();
                UserRequest.deleteByTrainer(userId).then(res => {
                    if (res.statusCode === 200) {
                        document.location.reload();
                    }
                });
            })
        })
    }
}
