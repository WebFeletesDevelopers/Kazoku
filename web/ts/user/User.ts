import { numberToRank, Rank } from "./Rank";

export class User {
    private _name: string;
    private _surname: string;
    private _secondSurname: string;
    private _username: string;
    private _phone: number;
    private _email: string;
    private _password: string;
    private _repeatedPassword: string;
    private _rank: Rank


    constructor(
        name: string,
        surname: string,
        secondSurname: string,
        username: string,
        phone: number,
        email: string,
        password: string,
        repeatedPassword: string,
        rank: number
    ) {
        this.name = name;
        this.surname = surname;
        this.secondSurname = secondSurname;
        this.username = username;
        this.phone = phone;
        this.email = email;
        this.password = password;
        this.repeatedPassword = repeatedPassword;
        this.rank = numberToRank(rank);
    }

    get name(): string {
        return this._name;
    }

    set name(value: string) {
        this._name = value;
    }

    get surname(): string {
        return this._surname;
    }

    set surname(value: string) {
        this._surname = value;
    }

    get secondSurname(): string {
        return this._secondSurname;
    }

    set secondSurname(value: string) {
        this._secondSurname = value;
    }

    get username(): string {
        return this._username;
    }

    set username(value: string) {
        this._username = value;
    }

    get phone(): number {
        return this._phone;
    }

    set phone(value: number) {
        this._phone = value;
    }

    get email(): string {
        return this._email;
    }

    set email(value: string) {
        this._email = value;
    }

    get password(): string {
        return this._password;
    }

    set password(value: string) {
        this._password = value;
    }

    get repeatedPassword(): string {
        return this._repeatedPassword;
    }

    set repeatedPassword(value: string) {
        this._repeatedPassword = value;
    }

    get rank(): Rank {
        return this._rank;
    }

    set rank(value: Rank) {
        this._rank = value;
    }

    public validate(): boolean {
        console.log(Rank);
        console.log(Rank.PUPIL);
        console.log(Rank.INVALID);
        return !! this.name
            && !! this.surname
            && !! this.secondSurname
            && !! this.username
            && !! this.phone
            && !! this.email
            && !! this.password
            && !! this.repeatedPassword
            && this.password === this.repeatedPassword
            && this.rank !== Rank.INVALID;
    }
}
