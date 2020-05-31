class Main {
    private _prueba: number;

    constructor(prueba: number) {
        this._prueba = prueba;
    }

    get prueba(): number {
        return this._prueba;
    }
}

const a = new Main(123);

console.log(a.prueba);
