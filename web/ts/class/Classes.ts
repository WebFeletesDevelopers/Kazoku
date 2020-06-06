/**
 * class data class.
 */
export class Classes {
    private _name: string;
    private _trainer: string;
    private _days: number;
    private _schedule: string;
    private _minAge: number;
    private _maxAge: number;
    private _centerId: number;

    constructor(
        name: string,
        trainer: string,
        days: number,
        schedule: string,
        minAge: number,
        maxAge: number
    ) {
        this._name = name;
        this._trainer = trainer;
        this._days = days;
        this._schedule = schedule;
        this._minAge = minAge;
        this._maxAge = maxAge;
    }


    get name(): string {
        return this._name;
    }

    set name(value: string) {
        this._name = value;
    }

    get trainer(): string {
        return this._trainer;
    }

    set trainer(value: string) {
        this._trainer = value;
    }

    get days(): number {
        return this._days;
    }

    set days(value: number) {
        this._days = value;
    }

    get schedule(): string {
        return this._schedule;
    }

    set schedule(value: string) {
        this._schedule = value;
    }

    get minAge(): number {
        return this._minAge;
    }

    set minAge(value: number) {
        this._minAge = value;
    }

    get maxAge(): number {
        return this._maxAge;
    }

    set maxAge(value: number) {
        this._maxAge = value;
    }

    get centerId(): number {
        return this._centerId;
    }

    set centerId(value: number) {
        this._centerId = value;
    }

    /**
     * Check if the class has all the params
     */
    public validate(): boolean {
        return this._name !== ''
            && this._trainer !== ''
            && this._maxAge > 0
            && this._minAge > 0
            && this._days > 0
            && this._schedule !== ''
            && this._centerId > 0
            ;
    }
}
