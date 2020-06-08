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
        codAddress: number
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
    }

    /**
     * Check if the email is ok
     */
    public validateEmail(): boolean {
        return this._email.includes('@')
            && this._email.includes('.')
            && this._email.length > 5
            && !(this._email.includes(' '))

    }

    /**
     * Validates data format
     */
    public validateBirtday(): boolean {
        return this._birthDate.length == 10
            && this._birthDate.includes('/', 2)
            && this._birthDate.includes('/', 5)
    }

    /**
     * Validates the judoka
     */
    public validate(): boolean {
        return this._name !== ''
            && this._lastName1 !== ''
            && this._sex <= 1
            && this._sex >= 0
            && this._phone > 0
            && this._codAddress > 0
            ;
    }
}
