/**
 * Autocomplete data class.
 */
export class AddressAutocompleteData {
    private _address: string;

    get address(): string {
        return this._address;
    }

    set address(value: string) {
        this._address = value;
    }
}
