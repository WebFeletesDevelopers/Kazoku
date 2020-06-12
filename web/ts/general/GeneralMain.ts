import {Cookie} from "../util/Cookie";

export class GeneralMain {
    public static handle(): void {
        const hasLogoutLink: boolean = !! document.querySelector('[data-action="logout-button"]');
        const hasUpdateLanguage: boolean = !! document.querySelector('[data-action="change-language"]');

        if (hasLogoutLink) {
            GeneralMain.handleLogout();
        }

        if (hasUpdateLanguage) {
            GeneralMain.handleUpdateLanguage();
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

    private static handleUpdateLanguage(): void {
        const updateLanguageLink: HTMLAnchorElement = document.querySelector('[data-action="change-language"]');

        updateLanguageLink.addEventListener('click', e => {
            e.preventDefault();
            if (!! Cookie.get('lang')) {
                Cookie.delete('lang');
            } else {
                Cookie.set('lang', '1');
            }
            document.location.reload();
        });
    }
}
