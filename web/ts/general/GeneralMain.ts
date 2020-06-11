import {Cookie} from "../util/Cookie";

export class GeneralMain {
    public static handle(): void {
        const hasLogoutLink: boolean = !! document.querySelector('[data-action="logout-button"]');

        if (hasLogoutLink) {
            GeneralMain.handleLogout();
        }
    }

    private static handleLogout(): void {
        const logoutLink: HTMLAnchorElement = document.querySelector('[data-action="logout-button"]');

        logoutLink.addEventListener('click', e => {
            e.preventDefault();
            Cookie.delete('hash');
            document.location.replace('/');
        });
    }
}
