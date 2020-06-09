/**
 * News data class.
 */
export class Judoka {
    private _name: string;
    private _lastName1: string;
    private _lastName2: string;
    private _sex: number;
    private _idFanjyda: number;
    private _dni: string;
    private _birthDate: string;
    private _phone: number;
    private _email: string;
    private _illness: string;
    private _codUsu: number;
    private _codTutor: number;
    private _codAddress: number;
    private _codBelt: number;
    private _codClass: number;

    constructor(
        name: string,
        lastName1: string,
        lastName2: string,
        sex: number,
        idFanjyda: number,
        dni: string,
        birthDate: string,
        phone: number,
        email: string,
        illness: string,
        codUsu: number,
        codTutor: number,
        codAddress: number,
        codBelt: number,
        codClass: number
    ) {
        this._name = name;
        this._lastName1 = lastName1;
        this._lastName2 = lastName2;
        this._sex = sex;
        this._idFanjyda = idFanjyda;
        this._dni = dni;
        this._birthDate = birthDate;
        this._phone = phone;
        this._email = email;
        this._illness = illness;
        this._codUsu = codUsu;
        this._codTutor = codTutor;
        this._codAddress = codAddress;
        this._codBelt = codBelt;
        this._codClass = codClass;
    }

    get codBelt(): number {
        return this._codBelt;
    }

    set codBelt(value: number) {
        this._codBelt = value;
    }

    get codClass(): number {
        return this._codClass;
    }

    set codClass(value: number) {
        this._codClass = value;
    }

    get name(): string {
        return this._name;
    }

    set name(value: string) {
        this._name = value;
    }

    get lastName1(): string {
        return this._lastName1;
    }

    set lastName1(value: string) {
        this._lastName1 = value;
    }

    get lastName2(): string {
        return this._lastName2;
    }

    set lastName2(value: string) {
        this._lastName2 = value;
    }

    get sex(): number {
        return this._sex;
    }

    set sex(value: number) {
        this._sex = value;
    }

    get idFanjyda(): number {
        return this._idFanjyda;
    }

    set idFanjyda(value: number) {
        this._idFanjyda = value;
    }

    get dni(): string {
        return this._dni;
    }

    set dni(value: string) {
        this._dni = value;
    }

    get birthDate(): string {
        return this._birthDate;
    }

    set birthDate(value: string) {
        this._birthDate = value;
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

    get illness(): string {
        return this._illness;
    }

    set illness(value: string) {
        this._illness = value;
    }

    get codUsu(): number {
        return this._codUsu;
    }

    set codUsu(value: number) {
        this._codUsu = value;
    }

    get codTutor(): number {
        return this._codTutor;
    }

    set codTutor(value: number) {
        this._codTutor = value;
    }

    get codAddress(): number {
        return this._codAddress;
    }

    set codAddress(value: number) {
        this._codAddress = value;
    }

    /**
     * Check if the email is ok
     */
    public validateEmail(): boolean {
        return (this._email.includes('@')
              && this._email.includes('.')
             && this._email.length > 5
            && !(this._email.includes(' ')))
            || this._email == null

    }

    /**
     * Validates data format
     */
    public validateBirthData(): boolean {
        return this._birthDate.length == 10
            && this._birthDate.includes('-', 4)
            && this._birthDate.includes('-', 7)
    }

    /**
     * Validates the judoka
     */
    public validate(): boolean {
        return this._name !== ''
            && this._lastName1 !== ''
            && this._sex <= 1
            && this._sex >= 0
            && this._codBelt > 0
            ;
    }
}
