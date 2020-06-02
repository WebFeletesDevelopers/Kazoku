export class NewsMain {
    public static handle(): void {
        const isNewNewsPage: boolean = document.querySelector('[data-action="news-creator"') !== null;

        if (isNewNewsPage) {
            this.handleNewsCreator();
        }

    }

    private static handleNewsCreator(): void {
        const form: HTMLFormElement = document.querySelector('div.form-signin');
        const submitButton: HTMLButtonElement = form.querySelector('button#enviar');

        submitButton.addEventListener('click', e => {
            e.preventDefault();
            console.log('me presionaste');
            submitButton.disabled = true;
        });
    }
}
