import { AddressAutocompleteData } from "./AddressAutocompleteData";
import { Request } from "../util/Request";
import { Response } from "../util/Response";
import { Address } from "./Address";

export class AddressRequest {
    public static getAutocomplete(autocompleteData: AddressAutocompleteData): Promise<Response> {
        const data = `address=${autocompleteData.address}`;
        return Request.post('/xhr/address/autocomplete', data);
    }

    public static updateAddress(address: Address, userId: number): Promise<Response> {
        const data = `addressId=${address.id}&userId=${userId}&addressAddress=${address.address}&addressZip=${address.zipCode}&addressCity=${address.city}`;
        return Request.post('/xhr/user/updateAddress', data);
    }
}
