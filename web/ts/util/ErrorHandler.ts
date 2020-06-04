export class ErrorHandler {
    private static setup = false;

    public static handle(error: string): void {
        const errorElement: HTMLDivElement = document.querySelector('div.kazoku-error');
        const opacityElement: HTMLDivElement = document.querySelector('div.has-error');
        const errorMessageElement: HTMLParagraphElement = errorElement.querySelector('p.error-message');
        const errorButton: HTMLButtonElement = errorElement.querySelector('button');

        if (! ErrorHandler.setup) {
            ErrorHandler.prepare(errorButton, errorElement, opacityElement);
        }

        errorMessageElement.textContent = error;
        errorElement.style.zIndex = '4';
        errorElement.style.opacity = '1';
        errorElement.classList.add('display');
        opacityElement.style.zIndex = '3';
        opacityElement.style.opacity = '0.4';
    }

    private static prepare(
        errorButton: HTMLButtonElement,
        errorElement: HTMLDivElement,
        opacityElement: HTMLDivElement
    ): void {
        errorButton.addEventListener('click', () => {
            errorElement.classList.remove('display');
            errorElement.style.opacity = '0';
            opacityElement.style.opacity = '0';
        });

        opacityElement.addEventListener('transitionend', () => {
            if (errorElement.classList.contains('display')) {
                return;
            }
            errorElement.style.zIndex = '-1';
            opacityElement.style.zIndex = '-1';
        });
    }
}
