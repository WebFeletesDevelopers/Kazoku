import { News } from "./News";
import {NewsRequest} from "./NewsRequest";

/**
 * News processing class.
 */
export class NewsMain {
    public static handle(): void {
        const isNewNewsPage: boolean = !! document.querySelector('[data-action="news-creator"]');

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

        this.validateCreateNewsButton(submitButton, news);

        titleInput.addEventListener('keyup', () => {
            news.title = titleInput.value;
            this.validateCreateNewsButton(submitButton, news);
        });
        bodyInput.addEventListener('keyup', () => {
            news.body = bodyInput.value;
            this.validateCreateNewsButton(submitButton, news);
        });
        isPrivateInput.addEventListener('change', () => {
            news.public = parseInt(isPrivateInput.value) === 1;
        });

        submitButton.addEventListener('click', e => {
            e.preventDefault();
            NewsRequest.addNews(news);
        });
    }

    private static validateCreateNewsButton(button: HTMLButtonElement, news: News): void {
        if (news.validate()) {
            button.disabled = false;
            return;
        }
        button.disabled = true;
    }
}
