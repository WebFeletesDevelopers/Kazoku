import { User } from './User';
import { numberToRank } from './Rank'

export class UserMain {
    public static handle(): void {
        const isRegisterPage: boolean = !! document.querySelector('[data-action="register"]');

        if (isRegisterPage) {
            UserMain.handleRegisterForm();
        }
    }

    private static handleRegisterForm(): void {
        const registerContainer: HTMLDivElement = document.querySelector('div.register-form');
        const formElement: HTMLFormElement = registerContainer.querySelector('form');
        const nameElement: HTMLInputElement = formElement.querySelector('input[name="name"]');
        const surnameElement: HTMLInputElement = formElement.querySelector('input[name="surname"]');
        const secondSurnameElement: HTMLInputElement = formElement.querySelector('input[name="second-surname"]');
        const usernameElement: HTMLInputElement = formElement.querySelector('input[name="username"]');
        const phoneElement: HTMLInputElement = formElement.querySelector('input[name="phone"]');
        const emailElement: HTMLInputElement = formElement.querySelector('input[name="email"]');
        const passwordElement: HTMLInputElement = formElement.querySelector('input[name="password"]');
        const repeatedPaswordElement: HTMLInputElement = formElement.querySelector('input[name="repeated-password"]');
        const rankElement: HTMLSelectElement = formElement.querySelector('select[name="rank"]');
        const buttonElement: HTMLButtonElement = formElement.querySelector('button');
        const user: User = new User(
            nameElement.value,
            surnameElement.value,
            secondSurnameElement.value,
            usernameElement.value,
            parseInt(phoneElement.value),
            emailElement.value,
            passwordElement.value,
            repeatedPaswordElement.value,
            parseInt(rankElement.options[rankElement.selectedIndex].value)
        )

        UserMain.validateRegisterButton(user, buttonElement);

        nameElement.addEventListener('keyup', e => {
            user.name = (e.target as HTMLInputElement).value;
            UserMain.validateRegisterButton(user, buttonElement);
        });
        surnameElement.addEventListener('keyup', e => {
            user.surname = (e.target as HTMLInputElement).value;
            UserMain.validateRegisterButton(user, buttonElement);
        });
        secondSurnameElement.addEventListener('keyup', e => {
            user.secondSurname = (e.target as HTMLInputElement).value;
            UserMain.validateRegisterButton(user, buttonElement);
        });
        usernameElement.addEventListener('keyup', e => {
            user.username = (e.target as HTMLInputElement).value;
            UserMain.validateRegisterButton(user, buttonElement);
        });
        phoneElement.addEventListener('keyup', e => {
            user.phone = parseInt((e.target as HTMLInputElement).value);
            UserMain.validateRegisterButton(user, buttonElement);
        });
        emailElement.addEventListener('keyup', e => {
            user.email = (e.target as HTMLInputElement).value;
            UserMain.validateRegisterButton(user, buttonElement);
        });
        passwordElement.addEventListener('keyup', e => {
            user.password = (e.target as HTMLInputElement).value;
            UserMain.validateRegisterButton(user, buttonElement);
        });
        repeatedPaswordElement.addEventListener('keyup', e => {
            user.repeatedPassword = (e.target as HTMLInputElement).value;
            UserMain.validateRegisterButton(user, buttonElement);
        });
        rankElement.addEventListener('change', e => {
            const select = (e.target as HTMLSelectElement);
            const input = parseInt(select.options[select.selectedIndex].value);
            user.rank = numberToRank(input);
            UserMain.validateRegisterButton(user, buttonElement);
        });

        buttonElement.addEventListener('click', e => {
            e.preventDefault();
            console.log(user);
        });
    }

    private static validateRegisterButton(user: User, button: HTMLButtonElement): void {
        if (user.validate()) {
            button.disabled = false;
            return;
        }
        button.disabled = true;
    }
}
