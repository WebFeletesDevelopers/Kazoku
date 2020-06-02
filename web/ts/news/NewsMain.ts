import { News } from "./News";

/**
 * News processing class.
 */
export class NewsMain {
    public static handle(): void {
        const isNewNewsPage: boolean = document.querySelector('[data-action="news-creator"]') !== null;

        if (isNewNewsPage) {
            this.handleNewsCreator();
        }

    }

    private static handleNewsCreator(): void {
        const form: HTMLFormElement = document.querySelector('div.form-signin');
        const titleInput: HTMLTextAreaElement = form.querySelector('textarea#titulo');
        const bodyInput: HTMLTextAreaElement = form.querySelector('textarea#mensaje');
        const isPrivateInput: HTMLSelectElement = form.querySelector('select#publica');
        const submitButton: HTMLButtonElement = form.querySelector('button#enviar');
        const news: News = new News(
            titleInput.value,
            bodyInput.value,
            parseInt(isPrivateInput.value) === 1
        );

        titleInput.addEventListener('keyup', () => {
            news.title = titleInput.value;
        });
        bodyInput.addEventListener('keyup', () => {
            news.body = bodyInput.value;
        })
        isPrivateInput.addEventListener('change', () => {
            news.public = parseInt(isPrivateInput.value) === 1;
        })

        submitButton.addEventListener('click', e => {
            e.preventDefault();
            console.log(news);
        });
    }
}
