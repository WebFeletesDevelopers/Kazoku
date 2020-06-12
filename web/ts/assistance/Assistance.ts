/**
 * News data class.
 */
export class Assistance {
    private _userId: number;
    private _classId: number;
    private _date: string;

    constructor(
        userId: number,
        classId: number,
        date: string,
    ) {
        this._userId = userId;
        this._classId = classId;
        this._date = date;
    }


    get userId(): number {
        return this._userId;
    }

    set userId(value: number) {
        this._userId = value;
    }

    get classId(): number {
        return this._classId;
    }

    set classId(value: number) {
        this._classId = value;
    }

    get date(): string {
        return this._date;
    }

    set date(value: string) {
        this._date = value;
    }

    /**
     * Check if the absence has all the params
     */
    public validate(): boolean {
        return this.userId > 0
            && this.classId > 0
            && this.date != '';
    }

    public validateSearch(): boolean {
        return this.date.length > 0
            && this.classId > 0;
    }
}
