import { User } from './User';
import { numberToRank } from './Rank'
import { UserRequest } from "./UserRequest";
import {JudokaRequest} from "../judoka/JudokaRequest";

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

        registerContainer.addEventListener('animationend', e => {
            (e.target as HTMLDivElement).classList.remove('animate');
        });

        //fixme Simplificar
        nameElement.addEventListener('keyup', e => {
            user.name = (e.target as HTMLInputElement).value;
            UserMain.validateRegisterButton(user, buttonElement);
            registerContainer.classList.remove('kazoku-error-shadow');
        });
        surnameElement.addEventListener('keyup', e => {
            user.surname = (e.target as HTMLInputElement).value;
            UserMain.validateRegisterButton(user, buttonElement);
            registerContainer.classList.remove('kazoku-error-shadow');
        });
        secondSurnameElement.addEventListener('keyup', e => {
            user.secondSurname = (e.target as HTMLInputElement).value;
            UserMain.validateRegisterButton(user, buttonElement);
            registerContainer.classList.remove('kazoku-error-shadow');
        });
        usernameElement.addEventListener('keyup', e => {
            user.username = (e.target as HTMLInputElement).value;
            UserMain.validateRegisterButton(user, buttonElement);
            registerContainer.classList.remove('kazoku-error-shadow');
        });
        phoneElement.addEventListener('keyup', e => {
            user.phone = parseInt((e.target as HTMLInputElement).value);
            UserMain.validateRegisterButton(user, buttonElement);
            registerContainer.classList.remove('kazoku-error-shadow');
        });
        emailElement.addEventListener('keyup', e => {
            user.email = (e.target as HTMLInputElement).value;
            UserMain.validateRegisterButton(user, buttonElement);
            registerContainer.classList.remove('kazoku-error-shadow');
        });
        passwordElement.addEventListener('keyup', e => {
            user.password = (e.target as HTMLInputElement).value;
            UserMain.validateRegisterButton(user, buttonElement);
            registerContainer.classList.remove('kazoku-error-shadow');
        });
        repeatedPaswordElement.addEventListener('keyup', e => {
            user.repeatedPassword = (e.target as HTMLInputElement).value;
            UserMain.validateRegisterButton(user, buttonElement);
            registerContainer.classList.remove('kazoku-error-shadow');
        });
        rankElement.addEventListener('change', e => {
            const select = (e.target as HTMLSelectElement);
            const input = parseInt(select.options[select.selectedIndex].value);
            user.rank = numberToRank(input);
            UserMain.validateRegisterButton(user, buttonElement);
            registerContainer.classList.remove('kazoku-error-shadow');
        });

        buttonElement.addEventListener('click', e => {
            e.preventDefault();
            UserMain.createUser(user, registerContainer, buttonElement);
        });
    }

    private static validateRegisterButton(user: User, button: HTMLButtonElement): void {
        if (user.validate()) {
            button.disabled = false;
            return;
        }
        button.disabled = true;
    }

    private static createUser(
        user: User,
        registerContainer: HTMLDivElement,
        registerButton: HTMLButtonElement
    ): void {
        registerButton.disabled = true;
        if(user.rank == 3){
            JudokaRequest.createFromRegister(user).then(r => {

            });
        }
        UserRequest.register(user).then(res => {
            if (res.statusCode === 201) {
                document.location.replace('/');
            } else {
                registerContainer.classList.add('kazoku-error-shadow', 'animate');
            }
            registerButton.disabled = false;
        });
    }
}
